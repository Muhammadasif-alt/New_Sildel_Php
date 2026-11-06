<?php

namespace App\Data;

use App\Support\LocalizedUrl;

/**
 * Site-wide settings shared with every view as $site (header, footer, SEO, JSON-LD).
 */
final readonly class SiteSettings
{
    /**
     * @param  array<string, array{label: string, hreflang: string, og: string}>  $locales
     * @param  array<string, string>  $alternateUrls  locale => absolute URL of the current page in that locale
     * @param  list<NavItem>  $navLeft
     * @param  list<NavItem>  $navRight
     * @param  list<NavItem>  $navMobile
     * @param  list<NavGroup>  $footerNav
     * @param  list<SocialLink>  $socials
     * @param  array<string, string>  $ui
     * @param  array<string, mixed>  $footer
     * @param  array{title: string, description: string}  $seo
     */
    public function __construct(
        public string $name,
        public string $tagline,
        public string $locale,
        public string $defaultLocale,
        public array $locales,
        public array $alternateUrls,
        public array $navLeft,
        public array $navRight,
        public array $navMobile,
        public array $footerNav,
        public ContactInfo $contact,
        public array $socials,
        public array $ui,
        public array $footer,
        public array $seo,
        public string $ogImage,
        public string $emblem,
    ) {}

    public function ui(string $key): string
    {
        return $this->ui[$key] ?? $key;
    }

    public function homeUrl(): string
    {
        return $this->locale === $this->defaultLocale ? route('home') : route('home.localized', ['locale' => $this->locale]);
    }

    /**
     * URL of one of the site's pages in the current locale.
     *
     * @param  array<string, mixed>  $parameters
     */
    public function route(string $name, array $parameters = []): string
    {
        return $name === 'home' ? $this->homeUrl() : LocalizedUrl::route($name, $parameters, $this->locale);
    }

    /** True when $url is the page being viewed (for aria-current in the navigation). */
    public function isCurrent(string $url): bool
    {
        $path = rtrim((string) parse_url($url, PHP_URL_PATH), '/');
        $current = rtrim(request()->getPathInfo(), '/');

        return $path !== '' && ($current === $path || str_starts_with($current, $path.'/'));
    }
}
