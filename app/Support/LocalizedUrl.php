<?php

namespace App\Support;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route as RouteFacade;

/**
 * URLs for the site's own pages in the current (or a given) locale.
 *
 * Every page route exists twice: "treasures.show" at /treasures/{slug} for the default
 * locale and "localized.treasures.show" at /{locale}/treasures/{slug} for the others.
 * Content files link to pages as 'route:name', optionally followed by '#anchor' or '?query'.
 */
final class LocalizedUrl
{
    public const PREFIX = 'route:';

    /** @param array<string, mixed> $parameters */
    public static function route(string $name, array $parameters = [], ?string $locale = null): string
    {
        $locale ??= App::getLocale();

        if ($locale === self::defaultLocale()) {
            return route($name, $parameters);
        }

        return route('localized.'.$name, ['locale' => $locale, ...$parameters]);
    }

    /** Turns 'route:contact#form' into a URL; any other value is returned unchanged. */
    public static function resolve(string $value, ?string $locale = null): string
    {
        if (! str_starts_with($value, self::PREFIX)) {
            return $value;
        }

        $target = substr($value, strlen(self::PREFIX));
        $suffix = '';

        if (preg_match('/^([^#?]+)([#?].*)$/', $target, $match)) {
            [, $target, $suffix] = $match;
        }

        return self::route($target, [], $locale).$suffix;
    }

    /**
     * Resolves every 'route:' string inside a content array.
     *
     * @param  array<mixed>  $content
     * @return array<mixed>
     */
    public static function resolveAll(array $content, ?string $locale = null): array
    {
        array_walk_recursive($content, function (&$value) use ($locale) {
            if (is_string($value) && str_starts_with($value, self::PREFIX)) {
                $value = self::resolve($value, $locale);
            }
        });

        return $content;
    }

    /**
     * The current page in every locale (hreflang, language switch, canonical).
     *
     * @param  list<string>  $locales
     * @return array<string, string>
     */
    public static function alternates(?Route $route, array $locales): array
    {
        $name = $route?->getName();

        if ($name === null || ! $route->methods() || ! in_array('GET', $route->methods(), true)) {
            $name = 'home';
        }

        $name = preg_replace('/^localized\./', '', $name);
        $name = $name === 'home.localized' ? 'home' : $name;

        // Routes that exist in one language only (sitemap, forms, installer) switch to the home page.
        if ($name !== 'home' && ! RouteFacade::has('localized.'.$name)) {
            $name = 'home';
        }
        $parameters = array_diff_key($route?->parameters() ?? [], ['locale' => true]);

        $urls = [];

        foreach ($locales as $locale) {
            $urls[$locale] = $name === 'home'
                ? ($locale === self::defaultLocale() ? route('home') : route('home.localized', ['locale' => $locale]))
                : self::route($name, $parameters, $locale);
        }

        return $urls;
    }

    private static function defaultLocale(): string
    {
        return (string) array_key_first(config('sildel.locales'));
    }
}
