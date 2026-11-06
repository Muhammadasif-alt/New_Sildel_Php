<?php

namespace App\Providers;

use App\Content\ConfigContentRepository;
use App\Content\ContentRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Swap for a database-backed implementation when an admin panel is added.
        $this->app->singleton(ContentRepository::class, ConfigContentRepository::class);
    }

    public function boot(): void
    {
        // Shared hosting often terminates SSL at a proxy; make every generated URL https in production.
        if ($this->app->isProduction()) {
            URL::forceScheme('https');
        }

        // Enquiry and newsletter forms: 5 submissions per minute per IP.
        RateLimiter::for('forms', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip())->response(function () {
                return redirect()->back()->with('toast', ['type' => 'error', 'message' => __('forms.too_many')]);
            });
        });
    }
}
