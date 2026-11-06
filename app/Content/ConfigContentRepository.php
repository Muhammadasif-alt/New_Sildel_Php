<?php

namespace App\Content;

use App\Data\Article;
use App\Data\ContactInfo;
use App\Data\NavGroup;
use App\Data\NavItem;
use App\Data\Product;
use App\Data\RitualStep;
use App\Data\SiteSettings;
use App\Data\SocialLink;
use App\Data\Stat;
use App\Support\LocalizedUrl;
use App\Support\PublicImage;
use Illuminate\Support\Str;

/**
 * Reads content from config/sildel.php (site and home), config/pages.php (inner pages),
 * config/treasures.php (catalogue), config/journal.php (articles) and the Markdown files in
 * resources/content/{locale}/. Untranslated keys fall back to the default locale, and
 * 'route:' links are resolved to the page in the requested locale.
 */
class ConfigContentRepository implements ContentRepository
{
    /** @var array<string, list<Product>> */
    private array $products = [];

    public function locales(): array
    {
        return array_keys(config('sildel.locales'));
    }

    public function defaultLocale(): string
    {
        return $this->locales()[0];
    }

    public function settings(string $locale): SiteSettings
    {
        $content = LocalizedUrl::resolveAll($this->content($locale), $locale);
        $nav = $content['navigation'];

        return new SiteSettings(
            name: config('sildel.name'),
            tagline: config('sildel.tagline'),
            locale: $locale,
            defaultLocale: $this->defaultLocale(),
            locales: config('sildel.locales'),
            alternateUrls: LocalizedUrl::alternates(request()->route(), $this->locales()),
            navLeft: array_map(NavItem::fromArray(...), $nav['primary_left']),
            navRight: array_map(NavItem::fromArray(...), $nav['primary_right']),
            navMobile: array_map(NavItem::fromArray(...), $nav['mobile']),
            footerNav: array_map(NavGroup::fromArray(...), $nav['footer']),
            contact: ContactInfo::fromArray(config('sildel.contact'), $content['contact_labels']),
            socials: array_map(SocialLink::fromArray(...), config('sildel.socials')),
            ui: $content['ui'],
            footer: $content['footer'],
            seo: $content['seo'],
            ogImage: asset(config('sildel.images.og')),
            emblem: asset(config('sildel.images.emblem')),
        );
    }

    public function home(string $locale): array
    {
        $home = LocalizedUrl::resolveAll($this->content($locale)['home'], $locale);

        $home['products'] = array_values(array_filter(array_map(
            fn (string $slug) => $this->product($slug, $locale),
            $home['featured'],
        )));
        $home['journal']['articles'] = array_slice($this->articles($locale), 0, 3);
        $home['stats'] = array_map(Stat::fromArray(...), $home['stats']);
        $home['ritual']['steps'] = array_map(RitualStep::fromArray(...), $home['ritual']['steps']);

        return $home;
    }

    public function page(string $key, string $locale): array
    {
        return LocalizedUrl::resolveAll($this->localized('pages', $locale)[$key] ?? [], $locale);
    }

    public function products(string $locale): array
    {
        if (isset($this->products[$locale])) {
            return $this->products[$locale];
        }

        $categories = $this->categories($locale);
        $care = config('treasures.care');

        return $this->products[$locale] = array_map(function (array $item) use ($locale, $categories, $care) {
            $folder = 'images/sildel/treasures/'.$item['slug'];
            $dark = 'images/sildel/products/'.$item['slug'].'.webp';

            return Product::fromArray([
                ...$item,
                'url' => LocalizedUrl::route('treasures.show', ['slug' => $item['slug']], $locale),
                'category_label' => $categories[$item['category']] ?? '',
                'image' => $folder.'/card.webp',
                'dark_image' => ! empty($item['featured']) && PublicImage::exists($dark) ? $dark : null,
                'gallery' => $this->gallery($folder),
                'care' => array_values(array_filter(array_map(fn (string $key) => $care[$key] ?? null, $item['care'] ?? []))),
            ]);
        }, config('treasures.products'));
    }

    public function product(string $slug, string $locale): ?Product
    {
        foreach ($this->products($locale) as $product) {
            if ($product->slug === $slug) {
                return $product;
            }
        }

        return null;
    }

    public function relatedProducts(Product $product, string $locale, int $limit = 3): array
    {
        $others = array_filter($this->products($locale), fn (Product $other) => $other->slug !== $product->slug);

        $family = $product->family
            ? array_filter($others, fn (Product $other) => $other->family === $product->family)
            : [];
        $category = array_filter($others, fn (Product $other) => $other->category === $product->category);

        $related = [];

        foreach ([...$family, ...$category, ...$others] as $candidate) {
            $related[$candidate->slug] ??= $candidate;
        }

        return array_slice(array_values($related), 0, $limit);
    }

    public function categories(string $locale): array
    {
        return config("treasures.categories.$locale") ?? config('treasures.categories.'.$this->defaultLocale());
    }

    public function articles(string $locale): array
    {
        return array_map(fn (array $item) => Article::fromArray([
            ...$item,
            'url' => LocalizedUrl::route('journal.show', ['slug' => $item['slug']], $locale),
        ]), config('journal.articles'));
    }

    public function article(string $slug, string $locale): ?Article
    {
        foreach (config('journal.articles') as $item) {
            if ($item['slug'] === $slug) {
                return Article::fromArray([
                    ...$item,
                    'url' => LocalizedUrl::route('journal.show', ['slug' => $slug], $locale),
                    'body' => $this->markdown("journal/$slug.md", $locale),
                ]);
            }
        }

        return null;
    }

    public function legal(string $slug, string $locale): ?array
    {
        $pages = $this->page('legal', $locale);
        $html = $this->markdown("legal/$slug.md", $locale);

        if (! isset($pages[$slug]) || $html === null) {
            return null;
        }

        return [...$pages[$slug], 'html' => $html];
    }

    /** @return array<string, mixed> */
    protected function content(string $locale): array
    {
        return $this->localized('sildel.content', $locale);
    }

    /**
     * A per-locale config tree with the default locale as fallback.
     *
     * @return array<string, mixed>
     */
    protected function localized(string $key, string $locale): array
    {
        $default = config($key.'.'.$this->defaultLocale(), []);

        if ($locale === $this->defaultLocale()) {
            return $default;
        }

        return array_replace_recursive($default, config($key.'.'.$locale, []));
    }

    /**
     * Gallery photos generated by `npm run images:treasures` (01.webp, 02.webp... with t01.webp thumbnails).
     *
     * @return list<array{src: string, thumb: string}>
     */
    protected function gallery(string $folder): array
    {
        $files = glob(public_path($folder).'/[0-9][0-9].webp') ?: [];
        sort($files);

        return array_map(fn (string $file) => [
            'src' => $folder.'/'.basename($file),
            'thumb' => $folder.'/t'.basename($file),
        ], $files);
    }

    /** Renders resources/content/{locale}/{path}, falling back to the default locale. */
    protected function markdown(string $path, string $locale): ?string
    {
        foreach (array_unique([$locale, $this->defaultLocale()]) as $candidate) {
            $file = resource_path("content/$candidate/$path");

            if (is_file($file)) {
                $html = Str::markdown(file_get_contents($file), [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                ]);

                // Site-relative links follow the current locale (/treasures becomes /pt/treasures).
                return $locale === $this->defaultLocale()
                    ? $html
                    : preg_replace('#href="/(?!/)#', 'href="/'.$locale.'/', $html);
            }
        }

        return null;
    }
}
