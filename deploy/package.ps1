# =====================================================================
#  Builds the cPanel deploy package: dist/sildel-deploy.zip
#  Run from the project root:   powershell -ExecutionPolicy Bypass -File deploy\package.ps1
#
#  Includes vendor/ (production only) and public/build/ (compiled assets),
#  excludes node_modules, source-assets, tests, .env and local caches/logs.
#  See DEPLOY.md, step 1-2.
# =====================================================================
$ErrorActionPreference = 'Stop'
Set-Location (Split-Path $PSScriptRoot -Parent)

Write-Host '1/4  composer install (production)...'
composer install --no-dev --optimize-autoloader --no-interaction
if ($LASTEXITCODE -ne 0) { throw 'composer install failed' }

Write-Host '2/4  npm ci + build...'
npm ci
if ($LASTEXITCODE -ne 0) { throw 'npm ci failed' }
npm run build
if ($LASTEXITCODE -ne 0) { throw 'npm run build failed' }

Write-Host '3/4  staging files...'
$stage = Join-Path $env:TEMP 'sildel-deploy'
if (Test-Path $stage) { Remove-Item $stage -Recurse -Force }
New-Item -ItemType Directory $stage | Out-Null

$exclude = @('node_modules', 'source-assets', 'tests', 'dist', '.git', '.idea', '.vscode', '.phpunit.cache')
$excludeFiles = @('.env', '.env.backup', '.phpunit.result.cache', 'phpunit.xml')
Get-ChildItem -Force | Where-Object { $exclude -notcontains $_.Name -and $excludeFiles -notcontains $_.Name } |
    ForEach-Object { Copy-Item $_.FullName -Destination $stage -Recurse -Force }

# Empty runtime folders (keep the .gitignore placeholders so the folders exist on the server).
foreach ($dir in 'storage\logs', 'storage\framework\cache\data', 'storage\framework\sessions', 'storage\framework\views', 'bootstrap\cache') {
    Get-ChildItem (Join-Path $stage $dir) -File -Force -ErrorAction SilentlyContinue |
        Where-Object { $_.Name -ne '.gitignore' } | Remove-Item -Force
}
Remove-Item (Join-Path $stage 'public\hot') -Force -ErrorAction SilentlyContinue
Remove-Item (Join-Path $stage 'public\storage') -Force -Recurse -ErrorAction SilentlyContinue

Write-Host '4/4  zipping...'
New-Item -ItemType Directory dist -Force | Out-Null
$zip = Join-Path (Resolve-Path dist) 'sildel-deploy.zip'
if (Test-Path $zip) { Remove-Item $zip -Force }
# bsdtar ships with Windows 10+; -a picks zip from the extension and keeps dotfiles (.htaccess).
tar -a -c -f $zip -C $stage *
if ($LASTEXITCODE -ne 0) { throw 'zip failed' }
Remove-Item $stage -Recurse -Force

Write-Host "Done: $zip"
Write-Host 'Restore dev dependencies afterwards with: composer install'
