# Deploying Sildel to cPanel shared hosting

The server needs **PHP 8.2+ and MySQL only**. Node.js is never needed on the server: CSS/JS are
compiled locally into `public/build` and uploaded with the site. Queues run synchronously, and
sessions/cache use files, so no worker or cron is required.

---

## 1. Build locally

From the project folder on your computer:

```powershell
powershell -ExecutionPolicy Bypass -File deploy\package.ps1
```

This runs the three build commands for you:

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

Afterwards run `composer install` again to get your dev tools back locally.

## 2. Zip the project

The script produces **`dist/sildel-deploy.zip`**. It **includes** `vendor/` and `public/build/`.
It **excludes** `node_modules/`, `source-assets/` (original photos), `tests/`, `.env` and local logs/caches.

(No Windows? Run the three commands above, then from the project root:
`zip -r sildel-deploy.zip . -x "node_modules/*" "source-assets/*" "tests/*" ".env" ".git/*" "dist/*" "storage/logs/*.log"`.)

## 3. cPanel: database and upload

1. **cPanel > MySQL® Databases**
   - Create a database, e.g. `acct_sildel` (cPanel adds your account prefix).
   - Create a user with a strong password.
   - **Add user to database** with **ALL PRIVILEGES**.
2. **cPanel > File Manager**: upload `sildel-deploy.zip` to your home folder, then **Extract**.
   - For Method A extract into `~/sildel` (any folder name).
   - For Method B extract into `~/sildel-app`.

## 4. Point the domain at `/public`

### Method A (recommended): change the document root

**cPanel > Domains** > *Manage* `sildel.pt` > set **Document Root** to `sildel/public` (or
`sildel-app/public`). Nothing else changes: `APP_URL`, `asset()`, Vite and images all work because
`/public` is the web root.

### Method B: the document root cannot be changed (must be `public_html`)

```
~/sildel-app/        Laravel core (extracted zip)
~/public_html/       contents of sildel-app/public/
```

1. Move **everything inside** `~/sildel-app/public/` (including the hidden `.htaccess`, plus `build/`,
   `fonts/`, `images/`, favicons) into `~/public_html/`.
   *File Manager: Settings > "Show Hidden Files (dotfiles)".*
2. Replace `~/public_html/index.php` with **`~/sildel-app/deploy/public_html/index.php`**. It loads
   `../sildel-app/vendor/autoload.php` and `../sildel-app/bootstrap/app.php` and tells Laravel that
   `public_html` is the public folder, so the Vite manifest and images resolve correctly.
3. Later updates: upload new `public/build` contents into `public_html/build`.

In both methods leave `ASSET_URL` empty. Set it only if you serve assets from another domain/CDN.

## 5. Create `.env`

In the app folder, copy **`.env.example`** to **`.env`** (File Manager: Copy, then rename) and edit:

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://sildel.pt

DB_DATABASE=acct_sildel
DB_USERNAME=acct_sildeluser
DB_PASSWORD=********

# cPanel > Email Accounts > create e.g. no-reply@sildel.pt > "Connect Devices" shows these values
MAIL_MAILER=smtp
MAIL_SCHEME=smtps
MAIL_HOST=mail.sildel.pt
MAIL_PORT=465
MAIL_USERNAME=no-reply@sildel.pt
MAIL_PASSWORD=********
MAIL_FROM_ADDRESS="no-reply@sildel.pt"
SILDEL_ENQUIRY_TO=sildel@sildel.pt
```

Drivers are already set for shared hosting: `SESSION_DRIVER=file`, `CACHE_STORE=file`, `QUEUE_CONNECTION=sync`.
(If your host uses port 587/STARTTLS instead: `MAIL_SCHEME=smtp`, `MAIL_PORT=587`.)

## 6. Run migrations

### With Terminal (cPanel > Terminal, or SSH)

```bash
cd ~/sildel            # or ~/sildel-app
php artisan migrate --force
```

(If `php` is an old version in the terminal, use the full path cPanel shows, e.g.
`/opt/cpanel/ea-php82/root/usr/bin/php artisan migrate --force`.)

### Without Terminal: one-time web installer

1. In `.env` set a long random value: `INSTALL_TOKEN=paste-a-40-character-random-string`
2. Visit `https://sildel.pt/install?token=paste-a-40-character-random-string`
3. It runs `key:generate` (if empty), `migrate --force`, `storage:link`, `config:cache`, `route:cache`
   and `view:cache`, prints the result, then **locks itself** (`storage/app/installed.lock`).
4. **Delete the `INSTALL_TOKEN` line from `.env`** (or leave it empty). The route returns 404 when empty.

## 7. Key and caches

With Terminal:

```bash
php artisan key:generate --force     # only the first time (APP_KEY empty)
php artisan storage:link             # may be blocked on some hosts: that's fine, see below
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

(The web installer in step 6 already does all of this.)

After every change to `.env` or `config/sildel.php`, run `php artisan config:cache` again. Without a
terminal: temporarily set a new `INSTALL_TOKEN`, delete `storage/app/installed.lock`, visit `/install` again.

**storage:link blocked?** Nothing to do: the site has a fallback route that serves
`storage/app/public/*` at `/storage/*`. (The home page itself does not use storage at all: all images are in `public/images`.)

## 8. Permissions

**File Manager > right-click > Change Permissions**:

| Path | Permission |
|------|------------|
| `storage/` and everything inside | **775** (folders) / 664 (files) |
| `bootstrap/cache/` | **775** |
| everything else | 755 folders / 644 files (cPanel default) |
| `.env` | 640 or 600 |

With Terminal: `chmod -R 775 storage bootstrap/cache`.

## 9. PHP version and extensions

**cPanel > MultiPHP Manager**: select the domain, choose **PHP 8.2** (or 8.3).
**cPanel > Select PHP Version > Extensions**: enable `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`,
`xml`, `ctype`, `json`, `fileinfo`, `intl`, `bcmath`, `curl`, `gd`, `zip`.
Recommended INI (MultiPHP INI Editor): `memory_limit 256M`, `upload_max_filesize 16M`.

## 10. Test

- [ ] `https://sildel.pt` loads; `http://` and `www.` both redirect to `https://sildel.pt` (padlock shown).
      If SSL is not active yet: **cPanel > SSL/TLS Status > Run AutoSSL**.
- [ ] `/pt` loads; the EN / PT switch works.
- [ ] Send the enquiry form: success toast, row in table `enquiries` (phpMyAdmin), e-mail arrives at
      `sildel@sildel.pt`. Submit it empty: errors appear under the fields.
      If no e-mail arrives, check `storage/logs/laravel-*.log` (the enquiry is still saved).
- [ ] Six quick submissions within a minute: the sixth shows "Too many attempts".
- [ ] `https://sildel.pt/sitemap.xml` and `/robots.txt` load.
- [ ] DevTools > Network: files in `/build/` return `Cache-Control: public, max-age=31536000, immutable`
      and `content-encoding: gzip`.
- [ ] `https://sildel.pt/.env` returns **403 Forbidden**.
- [ ] Once HTTPS is confirmed everywhere, optionally enable HSTS in `public/.htaccess`.

## Updating the site later

1. Locally: edit, `npm run build`, test.
2. Upload only what changed (e.g. `config/sildel.php`, `resources/views/...`, `public/build/`,
   `public/images/...`). For PHP dependency changes, re-run `deploy\package.ps1` and upload `vendor/`.
3. Run `php artisan config:cache && php artisan route:cache && php artisan view:cache`
   (or the web installer as described in step 7).

## Troubleshooting

| Symptom | Fix |
|---------|-----|
| 500 error, blank page | Check `storage/logs/`; permissions (step 8); PHP version (step 9). Temporarily `APP_DEBUG=true` to see the error, then set it back. |
| "Vite manifest not found" | `public/build` (Method B: `public_html/build`) was not uploaded. |
| Unstyled page, CSS 404 | Wrong document root or `APP_URL`; with Method B make sure `index.php` is the one from `deploy/public_html`. |
| "No application encryption key" | Run `php artisan key:generate --force` or the web installer. |
| Changes to config not visible | `php artisan config:cache`. |
| 419 Page Expired on forms | Session folder not writable: `storage/framework/sessions` must be 775. |
