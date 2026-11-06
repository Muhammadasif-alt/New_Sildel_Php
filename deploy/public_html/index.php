<?php

/*
|--------------------------------------------------------------------------
| index.php for hosts where the document root CANNOT be changed
|--------------------------------------------------------------------------
|
| Layout on the server (see DEPLOY.md, "Method B"):
|
|   ~/sildel-app/      Laravel core (app, bootstrap, config, vendor, storage...)
|   ~/public_html/     contents of the project's /public folder + THIS file
|
| Copy this file over ~/public_html/index.php.
|
*/

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../sildel-app/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../sildel-app/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../sildel-app/bootstrap/app.php';

// public_html is the public folder: asset(), Vite (build/manifest.json) and images resolve from here.
$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());
