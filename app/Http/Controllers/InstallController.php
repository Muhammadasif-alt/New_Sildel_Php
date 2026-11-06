<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Throwable;

/**
 * One-time installer for cPanel hosts WITHOUT terminal access.
 *
 * Enabled only while INSTALL_TOKEN is set in .env, and locks itself after a
 * successful run (storage/app/installed.lock). Visit:
 *     https://your-domain/install?token=YOUR_TOKEN
 * Then remove INSTALL_TOKEN from .env. See DEPLOY.md, step 6.
 */
class InstallController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $token = (string) config('sildel.install_token');
        $lock = storage_path('app/installed.lock');

        abort_if($token === '' || is_file($lock), 404);
        abort_unless(hash_equals($token, (string) $request->query('token')), 404);

        $log = [];
        $steps = [
            'key:generate' => ['--force' => true],
            'migrate' => ['--force' => true],
            'storage:link' => [],
            'config:cache' => [],
            'route:cache' => [],
            'view:cache' => [],
        ];

        foreach ($steps as $command => $options) {
            if ($command === 'key:generate' && filled(config('app.key'))) {
                $log[] = "skip  {$command} (APP_KEY already set)";

                continue;
            }

            try {
                Artisan::call($command, $options);
                $log[] = "ok    {$command}\n".trim(Artisan::output());
            } catch (Throwable $e) {
                $log[] = "FAIL  {$command}: {$e->getMessage()}";

                // storage:link is optional: the /storage fallback route covers blocked symlinks.
                if ($command !== 'storage:link') {
                    return response(implode("\n\n", $log), 500)->header('Content-Type', 'text/plain');
                }
            }
        }

        file_put_contents($lock, now()->toIso8601String());
        $log[] = 'Installation complete. Now remove INSTALL_TOKEN from .env and run nothing else here.';

        return response(implode("\n\n", $log))->header('Content-Type', 'text/plain');
    }
}
