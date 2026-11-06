<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Serves files from storage/app/public on hosts where `php artisan storage:link`
 * (symlinks) is blocked. When the public/storage symlink exists, Apache serves
 * the real file directly and this route is never reached.
 */
class StorageFallbackController extends Controller
{
    public function __invoke(string $path): StreamedResponse
    {
        abort_if(str_contains($path, '..'), 404);
        abort_unless(Storage::disk('public')->exists($path), 404);

        return Storage::disk('public')->response($path, null, [
            'Cache-Control' => 'public, max-age=2592000',
        ]);
    }
}
