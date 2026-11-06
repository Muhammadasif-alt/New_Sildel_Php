/**
 * Builds brand assets from the official logo files in source-assets/brand/
 * (downloaded from sildel.pt):
 *   public/images/sildel/brand/lynx.png   white lynx emblem, used as a CSS mask and tinted with the gold token
 *   public/favicon-32.png, apple-touch-icon.png, icon-192.png   the black lynx favicon used on sildel.pt (client files)
 *
 *   npm run brand
 */
import fs from 'node:fs';
import path from 'node:path';
import sharp from 'sharp';

const root = path.resolve(import.meta.dirname, '..');
const logo = path.join(root, 'source-assets/brand/SILDEL-LOGO-branco-01-1024x1024.webp');
const outDir = path.join(root, 'public/images/sildel/brand');
fs.mkdirSync(outDir, { recursive: true });

// The emblem sits in the upper part of the square logo (rows 58-564), the lettering below (606-848).
const SPLIT = 585;
const upper = await sharp(logo).extract({ left: 0, top: 0, width: 1024, height: SPLIT }).png().toBuffer();
const emblem = await sharp(upper).trim().png().toBuffer();
await sharp(emblem).resize({ width: 480 }).png({ compressionLevel: 9 }).toFile(path.join(outDir, 'lynx.png'));
console.log('ok    images/sildel/brand/lynx.png');

// Official horizontal logo (client file, 2048px). Only its alpha channel is used (CSS mask),
// so it can be tinted with any colour token.
const horizontal = await sharp(path.join(root, 'source-assets/brand/SILDEL-LOGO-horizontal-2048x723.png')).trim().resize({ width: 1400 }).png({ compressionLevel: 9 }).toBuffer();
await sharp(horizontal).toFile(path.join(outDir, 'logo-horizontal.png'));
const { width: logoW, height: logoH } = await sharp(horizontal).metadata();
console.log(`ok    images/sildel/brand/logo-horizontal.png  ${logoW}x${logoH} (ratio ${(logoW / logoH).toFixed(4)})`);

// "Fine Arts" swoosh divider used under the collection heading (as on the live site).
await sharp(path.join(root, 'source-assets/brand/SILDEL-FINE-ARTS-19-1024x112.webp')).trim().webp({ quality: 90 }).toFile(path.join(outDir, 'fine-arts-line.webp'));
console.log('ok    images/sildel/brand/fine-arts-line.webp');

// Favicons: the client's own black lynx on a transparent background, exactly as on sildel.pt.
for (const [file, source] of [
    ['favicon-32.png', 'cropped-Logo_Sildel_menu-1-32x32.png'],
    ['apple-touch-icon.png', 'cropped-Logo_Sildel_menu-1-180x180.png'],
    ['icon-192.png', 'cropped-Logo_Sildel_menu-1-192x192.png'],
]) {
    fs.copyFileSync(path.join(root, 'source-assets/brand', source), path.join(root, 'public', file));
    console.log(`ok    ${file}`);
}
