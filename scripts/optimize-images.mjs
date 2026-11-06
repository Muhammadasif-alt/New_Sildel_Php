/**
 * Converts the original product photography in source-assets/ into the
 * optimised web images used by the site (public/images/sildel/).
 *
 *   npm run images                          (all images)
 *   npm run images -- pages/craft-marlin.webp  (only the outputs named)
 *
 * Edit scripts/images.manifest.json to add or replace an image, then re-run.
 * "fit": "cover" crops to the frame, "contain" pads with the onyx background
 * (best for product shots on black that would otherwise be cut off).
 */
import fs from 'node:fs';
import path from 'node:path';
import sharp from 'sharp';

const root = path.resolve(import.meta.dirname, '..');
const manifest = JSON.parse(fs.readFileSync(process.env.IMAGES_MANIFEST ?? path.join(import.meta.dirname, 'images.manifest.json'), 'utf8'));
const onyx = { r: 13, g: 11, b: 9, alpha: 1 };

async function cornerColour(file) {
    const { data } = await sharp(file).rotate().extract({ left: 4, top: 4, width: 8, height: 8 }).resize(1, 1).raw().toBuffer({ resolveWithObject: true });
    return { r: data[0], g: data[1], b: data[2], alpha: 1 };
}

// "focus": frame the product itself, ignoring thin cables and stray specks. Finds the rows and
// columns that hold a real mass of bright pixels, then crops the ORIGINAL photo around that box at
// the output's aspect ratio, so the product fills `focus` (0-1) of the frame and any cable simply
// runs out of the picture instead of shrinking the product.
async function focusCrop(buffer, outW, outH, fill) {
    const meta = await sharp(buffer).metadata();
    const scale = Math.min(1, 900 / Math.max(meta.width, meta.height));
    const sw = Math.round(meta.width * scale), sh = Math.round(meta.height * scale);
    const { data } = await sharp(buffer).resize(sw, sh).greyscale().raw().toBuffer({ resolveWithObject: true });
    const cols = new Uint32Array(sw), rows = new Uint32Array(sh);
    for (let y = 0; y < sh; y++) for (let x = 0; x < sw; x++) if (data[y * sw + x] > 38) { cols[x]++; rows[y]++; }
    const span = (arr) => {
        const limit = Math.max(4, Math.max(...arr) * 0.06);
        let a = 0, b = arr.length - 1;
        while (a < b && arr[a] < limit) a++;
        while (b > a && arr[b] < limit) b--;
        return [a / scale, (b + 1) / scale];
    };
    const [x0, x1] = span(cols), [y0, y1] = span(rows);
    const bw = x1 - x0, bh = y1 - y0, cx = (x0 + x1) / 2, cy = (y0 + y1) / 2;
    const ratio = outW / outH;
    let cw = Math.max(bw / fill, (bh / fill) * ratio);
    let ch = cw / ratio;
    const left = Math.round(cx - cw / 2), top = Math.round(cy - ch / 2);
    cw = Math.round(cw); ch = Math.round(ch);
    // Extend with black where the crop runs past the photo, then cut the frame.
    const ext = { top: Math.max(0, -top), left: Math.max(0, -left), bottom: Math.max(0, top + ch - meta.height), right: Math.max(0, left + cw - meta.width) };
    const padded = await sharp(buffer).extend({ ...ext, background: { r: 0, g: 0, b: 0, alpha: 1 } }).toBuffer();
    return sharp(await sharp(padded).extract({ left: left + ext.left, top: top + ext.top, width: cw, height: ch }).toBuffer());
}

let failed = 0;

const only = process.argv.slice(2);

for (const image of manifest.images) {
    if (only.length && !only.includes(image.out)) continue;
    const source = path.join(root, manifest.sourceRoot, image.src);
    const target = path.join(root, manifest.outputRoot, image.out);

    if (!fs.existsSync(source)) {
        console.warn(`skip  ${image.out}  (missing source: ${image.src})`);
        failed++;
        continue;
    }

    fs.mkdirSync(path.dirname(target), { recursive: true });

    // "pad" keeps a margin (px) around a trimmed product so it never touches the frame edge.
    const pad = image.focus ? 0 : (image.pad ?? 0);
    let pipeline = sharp(source).rotate();

    // "blacken": crush the studio's near-black backdrop to pure black so the photo melts into
    // the --color-velvet background with no visible box.
    if (image.blacken) {
        pipeline = sharp(await pipeline.linear(1.06, -10).toBuffer());
    }

    if (image.focus) {
        pipeline = await focusCrop(await pipeline.toBuffer(), image.width, image.height, image.focus);
    } else if (image.trim) {
        pipeline = sharp(await pipeline.trim({ threshold: 30 }).toBuffer());
    }

    // Pad with the photo's own backdrop colour (sampled from its corner) so no visible box appears.
    const black = { r: 0, g: 0, b: 0, alpha: 1 };
    // "background": explicit stage colour (hex), e.g. for transparent cut-outs such as the press mock-ups.
    const background = image.background ?? (image.blacken ? black : image.fit === 'contain' ? await cornerColour(source) : onyx);

    pipeline = pipeline
        .resize(image.width - pad * 2, image.height - pad * 2, { fit: image.fit ?? 'cover', position: image.position ?? 'attention', background })
        .extend({ top: pad, bottom: pad, left: pad, right: pad, background })
        .flatten({ background });

    if (target.endsWith('.jpg')) {
        await pipeline.jpeg({ quality: 82, mozjpeg: true }).toFile(target);
    } else {
        await pipeline.webp({ quality: image.quality ?? 78, effort: 6 }).toFile(target);
    }

    const kb = (fs.statSync(target).size / 1024).toFixed(0);
    console.log(`ok    ${image.out}  ${image.width}x${image.height}  ${kb} KB`);
}

process.exitCode = failed ? 1 : 0;
