<?php

use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;

// Loaded outside the "web" group (no session or cookies) so it works before APP_KEY exists.
// Disabled unless INSTALL_TOKEN is set in .env. See DEPLOY.md, step 6.
Route::get('/install', InstallController::class)->name('install');
