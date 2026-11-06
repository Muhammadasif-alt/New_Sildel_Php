<?php

namespace App\Http\Middleware;

use App\Content\ContentRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resolves the request locale and shares the site-wide settings
 * (navigation, contact, socials, footer, SEO defaults) with every view as $site.
 */
class ShareSiteSettings
{
    public function __construct(private ContentRepository $content) {}

    public function handle(Request $request, Closure $next): Response
    {
        // Pages carry the locale in the URL; forms post it as a hidden field.
        $locale = $request->route('locale') ?? $request->input('locale');

        if (! is_string($locale) || ! in_array($locale, $this->content->locales(), true)) {
            $locale = $this->content->defaultLocale();
        }

        App::setLocale($locale);
        View::share('site', $this->content->settings($locale));

        return $next($request);
    }
}
