/**
 * Copies the self-hosted Google Fonts (via @fontsource) into public/fonts/
 * so they can be preloaded and long-term cached on shared hosting.
 *
 *   npm run fonts
 */
import fs from 'node:fs';
import path from 'node:path';

const root = path.resolve(import.meta.dirname, '..');
const out = path.join(root, 'public/fonts');

// Italiana: SILDEL wordmark and large numbers. Cormorant Garamond: headings. Manrope: body and UI.
// The latin subset covers Portuguese accents.
const fonts = [
    ['italiana', 'italiana-latin-400-normal.woff2'],
    ['cormorant-garamond', 'cormorant-garamond-latin-400-normal.woff2'],
    ['cormorant-garamond', 'cormorant-garamond-latin-500-normal.woff2'],
    ['cormorant-garamond', 'cormorant-garamond-latin-500-italic.woff2'],
    ['cormorant-garamond', 'cormorant-garamond-latin-600-normal.woff2'],
    ['manrope', 'manrope-latin-300-normal.woff2'],
    ['manrope', 'manrope-latin-400-normal.woff2'],
    ['manrope', 'manrope-latin-500-normal.woff2'],
    ['manrope', 'manrope-latin-600-normal.woff2'],
];

fs.rmSync(out, { recursive: true, force: true });
fs.mkdirSync(out, { recursive: true });

for (const [pkg, file] of fonts) {
    fs.copyFileSync(path.join(root, 'node_modules/@fontsource', pkg, 'files', file), path.join(out, file));
    console.log(`ok    fonts/${file}`);
}
