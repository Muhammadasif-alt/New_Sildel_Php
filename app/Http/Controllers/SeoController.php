<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use App\Support\LocalizedUrl;
use Illuminate\Http\Response;

/**
 * sitemap.xml and robots.txt are generated from the routes so they always
 * use the live APP_URL and include every locale with hreflang alternates.
 */
class SeoController extends Controller
{
    /** Pages listed in the sitemap, with their priority. */
    private const PAGES = [
        'home' => '1.0',
        'treasures.index' => '0.9',
        'our-story' => '0.8',
        'authentic-cork' => '0.8',
        'you-think-cork' => '0.7',
        'journal.index' => '0.7',
        'contact' => '0.7',
        'press' => '0.5',
        'faqs' => '0.5',
        'legal.shipping' => '0.3',
        'legal.terms' => '0.3',
        'legal.privacy' => '0.3',
    ];

    public function sitemap(ContentRepository $content): Response
    {
        $default = $content->defaultLocale();
        $locales = $content->locales();
        $entries = [];

        $add = function (string $name, array $parameters, string $priority) use (&$entries, $locales) {
            $urls = [];
            foreach ($locales as $locale) {
                $urls[$locale] = $name === 'home'
                    ? ($locale === $locales[0] ? route('home') : route('home.localized', ['locale' => $locale]))
                    : LocalizedUrl::route($name, $parameters, $locale);
            }
            $entries[] = ['urls' => $urls, 'priority' => $priority];
        };

        foreach (self::PAGES as $name => $priority) {
            $add($name, [], $priority);
        }

        foreach ($content->products($default) as $product) {
            $add('treasures.show', ['slug' => $product->slug], '0.8');
        }

        foreach ($content->articles($default) as $article) {
            $add('journal.show', ['slug' => $article->slug], '0.6');
        }

        return response()
            ->view('seo.sitemap', [
                'entries' => $entries,
                'locales' => config('sildel.locales'),
                'defaultLocale' => $default,
                'lastModified' => now()->startOfMonth(),
            ])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots(): Response
    {
        $lines = app()->isProduction()
            ? ['User-agent: *', 'Disallow: /install', '', 'Sitemap: '.route('sitemap')]
            : ['User-agent: *', 'Disallow: /'];

        return response(implode("\n", $lines)."\n")->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
