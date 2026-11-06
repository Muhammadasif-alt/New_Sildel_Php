<?php

namespace App\Content;

use App\Data\Article;
use App\Data\Product;
use App\Data\SiteSettings;

/**
 * Source of all site content. The config-backed implementation is bound by
 * default; swap the binding in AppServiceProvider for a database-backed one
 * when an admin panel is added. Views only ever see the returned data.
 */
interface ContentRepository
{
    public function settings(string $locale): SiteSettings;

    /**
     * Content for the home page sections, keyed by section.
     *
     * @return array<string, mixed>
     */
    public function home(string $locale): array;

    /**
     * Copy for an inner page (config/pages.php), with 'route:' links resolved.
     *
     * @return array<string, mixed>
     */
    public function page(string $key, string $locale): array;

    /** @return list<Product> */
    public function products(string $locale): array;

    public function product(string $slug, string $locale): ?Product;

    /**
     * Pieces to suggest under a product: same family first, then same category.
     *
     * @return list<Product>
     */
    public function relatedProducts(Product $product, string $locale, int $limit = 3): array;

    /** @return array<string, string> category key => label */
    public function categories(string $locale): array;

    /** @return list<Article> newest first, without bodies */
    public function articles(string $locale): array;

    /** The article with its body rendered to HTML. */
    public function article(string $slug, string $locale): ?Article;

    /**
     * A legal page: its title, SEO and body rendered to HTML.
     *
     * @return array{title: string, seo: array{title: string, description: string}, html: string}|null
     */
    public function legal(string $slug, string $locale): ?array;

    /** @return list<string> */
    public function locales(): array;

    public function defaultLocale(): string;
}
