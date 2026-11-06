// Turns a product photo on a pure white studio backdrop into the same photo on pure black:
// flood-fills near-white pixels connected to the border, then feathers the edge so the cut-out
// has no white halo. Interior whites (marble, glass) that are not connected to the border stay.
const sharp = require('sharp');
async function convert(src, out, { tol = 238, w = 760, h = 950, pad = 70 } = {}) {
  const { data, info } = await sharp(src).flatten({ background: '#fff' }).raw().toBuffer({ resolveWithObject: true });
  const { width, height } = info; const n = width * height;
  const bg = new Uint8Array(n); const q = new Int32Array(n); let head = 0, tail = 0;
  const light = (i) => data[i * 3] >= tol && data[i * 3 + 1] >= tol && data[i * 3 + 2] >= tol;
  const push = (i) => { if (!bg[i] && light(i)) { bg[i] = 1; q[tail++] = i; } };
  for (let x = 0; x < width; x++) { push(x); push((height - 1) * width + x); }
  for (let y = 0; y < height; y++) { push(y * width); push(y * width + width - 1); }
  while (head < tail) { const i = q[head++]; const x = i % width, y = (i - x) / width;
    if (x > 0) push(i - 1); if (x < width - 1) push(i + 1); if (y > 0) push(i - width); if (y < height - 1) push(i + width); }
  // alpha mask: background 0, product 255, then blur for a soft edge
  const mask = Buffer.alloc(n); for (let i = 0; i < n; i++) mask[i] = bg[i] ? 0 : 255;
  const soft = await sharp(mask, { raw: { width, height, channels: 1 } }).blur(1.2).extractChannel(0).raw().toBuffer();
  const rgba = Buffer.alloc(n * 4);
  for (let i = 0; i < n; i++) { rgba[i*4] = data[i*3]; rgba[i*4+1] = data[i*3+1]; rgba[i*4+2] = data[i*3+2]; rgba[i*4+3] = soft[i]; }
  await sharp(rgba, { raw: { width, height, channels: 4 } }).flatten({ background: '#000' })
    .resize(w, h, { fit: 'contain', background: '#000' }).webp({ quality: 82 }).toFile(out);
  const share = (bg.reduce((t, v) => t + v, 0) / n * 100).toFixed(1);
  console.log('background share', share + '%');
}
module.exports = convert;
if (require.main === module) {
  const [src, out, pad] = process.argv.slice(2);
  convert(src, out, { pad: pad ? Number(pad) : 70 }).then(() => console.log('ok', out));
}
