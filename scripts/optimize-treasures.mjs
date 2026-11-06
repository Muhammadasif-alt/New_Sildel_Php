/**
 * Builds the product photography for /treasures from scripts/treasures.manifest.json.
 * Every product gets, on a pure white stage:
 *   card.webp       900 x 1125   listing card (first gallery photo)
 *   01.webp ...    1200 x 1500   gallery photos (product shots, then close-ups)
 *   t01.webp ...    240 x 300    gallery thumbnails
 *
 *   npm run images:treasures          (all products)
 *   npm run images:treasures abyss    (only the products named)
 */
import fs from 'node:fs';
import path from 'node:path';
import sharp from 'sharp';

const root = path.resolve(import.meta.dirname, '..');
const manifest = JSON.parse(fs.readFileSync(path.join(import.meta.dirname, 'treasures.manifest.json'), 'utf8'));
const only = process.argv.slice(2);
const white = { r: 255, g: 255, b: 255, alpha: 1 };

const sizes = {
    card: { width: 900, height: 1125, pad: 90 },
    photo: { width: 1200, height: 1500, pad: 120 },
    thumb: { width: 240, height: 300, pad: 22 },
};

/** Source files for a product: [{ file, detail }] in gallery order. */
function sources(product) {
    if (product.files) {
        return product.files.map((file) => ({ file: path.join(root, manifest.sourceRoot, file), detail: false }));
    }

    const folder = path.join(root, manifest.sourceRoot, 'live-site/products', product.live);
    const files = fs.readdirSync(folder).sort();
    const pick = (n) => path.join(folder, files[n - 1]);

    return [
        ...(product.gallery ?? []).map((n) => ({ file: pick(n), detail: false })),
        ...(product.details ?? []).map((n) => ({ file: pick(n), detail: true })),
    ];
}

/** Flattens transparency onto white and lifts an off-white studio backdrop to pure white. */
async function prepare(file) {
    const flat = await sharp(file).rotate().flatten({ background: white }).toBuffer();
    const { data } = await sharp(flat).extract({ left: 2, top: 2, width: 6, height: 6 }).resize(1, 1).raw().toBuffer({ resolveWithObject: true });
    const corner = Math.min(data[0], data[1], data[2]);

    // Only whiten light backdrops; a dark corner means the photo has no studio background.
    return corner > 200 && corner < 255 ? sharp(flat).linear(255 / corner, 0).toBuffer() : flat;
}

async function render(buffer, size, detail, target) {
    let pipeline;

    if (detail) {
        pipeline = sharp(buffer).resize(size.width, size.height, { fit: 'cover', position: 'attention' });
    } else {
        const trimmed = await sharp(buffer).trim({ background: '#ffffff', threshold: 22 }).toBuffer();
        pipeline = sharp(trimmed)
            .resize(size.width - size.pad * 2, size.height - size.pad * 2, { fit: 'contain', background: white })
            .extend({ top: size.pad, bottom: size.pad, left: size.pad, right: size.pad, background: white });
    }

    await pipeline.flatten({ background: white }).webp({ quality: size === sizes.thumb ? 70 : 80, effort: 6 }).toFile(target);
}

let failed = 0;

for (const [slug, product] of Object.entries(manifest.products)) {
    if (only.length && !only.includes(slug)) continue;

    const out = path.join(root, manifest.outputRoot, slug);
    fs.rmSync(out, { recursive: true, force: true });
    fs.mkdirSync(out, { recursive: true });

    const list = sources(product);

    for (const [index, { file, detail }] of list.entries()) {
        if (!fs.existsSync(file)) {
            console.warn(`skip  ${slug}  (missing ${file})`);
            failed++;
            continue;
        }

        const n = String(index + 1).padStart(2, '0');
        const buffer = await prepare(file);

        if (index === 0) await render(buffer, sizes.card, detail, path.join(out, 'card.webp'));
        await render(buffer, sizes.photo, detail, path.join(out, `${n}.webp`));
        await render(buffer, sizes.thumb, detail, path.join(out, `t${n}.webp`));
    }

    console.log(`ok    treasures/${slug}  ${list.length} photos`);
}

process.exitCode = failed ? 1 : 0;
