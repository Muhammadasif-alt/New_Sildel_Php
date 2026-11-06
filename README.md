# Sildel | We Think Cork

Home page of [sildel.pt](https://sildel.pt), a Portuguese maison of genuine cork art.
Laravel 12 + Blade components + Tailwind CSS v4 + Vite, with small vanilla JS modules for motion.
No Node.js is needed on the server: assets are built locally (see [DEPLOY.md](DEPLOY.md)).

## Local setup

Requirements: PHP 8.2+ (pdo_mysql, mbstring, intl, gd, fileinfo, openssl), Composer 2, Node 20+, MySQL/MariaDB.

```bash
composer install
npm install
cp .env.example .env          # then set APP_ENV=local, APP_DEBUG=true, APP_URL=http://127.0.0.1:8000, DB_*
php artisan key:generate
php artisan migrate
npm run build                 # or `npm run dev` for hot reload
php artisan serve             # http://127.0.0.1:8000  (Portuguese: /pt)
php artisan test              # 12 feature tests: pages, SEO, forms, honeypot, rate limit
```

With XAMPP: start MySQL from the XAMPP panel and create a `sildel` database (utf8mb4).
In local `.env`, `MAIL_MAILER=log` writes enquiry e-mails to `storage/logs/laravel.log`.

## Project structure

```
config/sildel.php                    ALL content: navigation, contact, socials, products, copy, images
app/Content/ContentRepository.php    content source interface (config today, database later)
app/Content/ConfigContentRepository  reads config/sildel.php (with locale fallback)
app/Data/*                           typed DTOs: Product, Article, NavItem, NavGroup, Stat, RitualStep,
                                     ContactInfo, SocialLink, SiteSettings
app/Http/Middleware/ShareSiteSettings  shares $site (nav, contact, socials, SEO) with every view
app/Http/Middleware/RejectHoneypot     silent honeypot for both forms
app/Http/Controllers/                Home, Enquiry, Newsletter, Seo (sitemap/robots), Install, StorageFallback

resources/views/
  pages/home.blade.php               only composes sections
  components/layouts/site.blade.php  SiteLayout: <head> SEO, JSON-LD, preloader, cursor, grain, header, footer, toaster
  components/ui/                     button (gold|ghost|ink|outline, arrow), text-link, input, textarea, label, field, sheet, toaster
  components/common/                 kicker, mask-heading, reveal, cork-image, roman-numeral, counter, rotating-badge,
                                     section-container, custom-cursor, preloader, grain-overlay, logo, emblem,
                                     wordmark, marquee, video-embed, social-icon
  components/layout/                 header, mobile-menu, footer, newsletter-form, language-switch, structured-data
  components/sections/home/          hero, statement, collection, product-card, manifesto, numbers, film,
                                     ritual, ritual-step, interiors, journal, journal-card, editorial-banner, atelier, enquiry-form

resources/css/
  tokens.css                         THE design tokens (colours, fonts, easings, breakpoints). No hex anywhere else.
  base.css, components/*.css, sections/home.css

resources/js/
  app.js                             boots modules; below-the-fold modules are code-split and lazy-loaded
  lib/                               in-view (useInView), scroll-progress (useScrollProgress), drag-scroll (useDragScroll), motion
  modules/                           preloader, header, sheet, cursor, reveal, hero-slideshow, scrub, slider,
                                     counter, parallax, video, toast, forms

scripts/                             image/font/brand asset pipeline (sharp)
source-assets/                       ORIGINAL client photos and logos (not deployed, not in git)
deploy/                              package.ps1 (zip builder) and public_html/index.php (Method B)
```

Every component documents its props at the top of its file.

## Editing content

All text, links, products and images live in **`config/sildel.php`**.

- Emphasis: wrap words in `*asterisks*` to get the gold italic accent, e.g. `'we give them *life.*'`.
- Line breaks: `\n` inside a string.
- After editing on the server run `php artisan config:cache` (config is cached in production).

### Add or edit a product

Add an entry under `content.en.home.products`:

```php
['name' => 'Olympia', 'slug' => 'olympia', 'subtitle' => 'Genuine Cork', 'tag' => 'New', 'tag_tone' => 'sage',
 'image' => 'images/sildel/products/olympia.webp', 'url' => 'https://sildel.pt/olympia/'],
```

`tag` is optional (`null` hides it); `tag_tone` is `gold` (default) or `sage`. If `image` is empty or the
file is missing, the card shows the cork-texture placeholder with the product name, so nothing breaks.

### Replace or add images

1. Put the original photo anywhere under `source-assets/`.
2. Add/edit its line in `scripts/images.manifest.json` (`src` is relative to `source-assets/`):
   - `"fit": "cover"` crops to the frame; `"contain"` fits the whole piece.
   - `"trim": true` + `"pad": 80` trims the studio backdrop and leaves an even margin.
   - `"blacken": true` makes the studio black pure black so product shots melt into the gallery background.
3. Run `npm run images`. Output goes to `public/images/sildel/` as optimised WebP.

Or simply drop a ready `.webp` into `public/images/sildel/...` and point the config at it.
The hero slideshow images are listed in `content.en.home.hero.slides`.

Logo and favicons are generated from `source-assets/brand/` with `npm run brand`; fonts with `npm run fonts`
(`npm run assets` runs all three).

### Portuguese

`/pt` is live. Add translated keys under `content.pt` in `config/sildel.php` using the same structure as
`content.en`; anything not translated falls back to English. Form messages are in `lang/en|pt/forms.php`.

### Moving content to a database / admin panel later

Create `App\Content\DatabaseContentRepository implements ContentRepository` returning the same DTOs and
arrays, then change the binding in `app/Providers/AppServiceProvider.php`. No Blade component changes.

## Reusing components on new pages (Our Story, Treasures, Authentic Cork)

```blade
{{-- resources/views/pages/treasures.blade.php --}}
<x-layouts.site title="Treasures | Sildel" description="...">
    <x-sections.home.collection :content="$collection" :products="$products" layout="slider" />
    <x-sections.home.editorial-banner image="images/sildel/editorial.webp" kicker="You Think Cork"
        :title-lines="['Interiors with', 'a living *soul*']" :cta="['label' => 'Discover More', 'url' => '/you-think-cork']" />
    <x-sections.home.atelier :content="$atelier" :contact="$site->contact" />
</x-layouts.site>
```

Building blocks for anything new:

```blade
<x-common.section-container>
    <x-common.kicker lines="both" align="center">Our Story</x-common.kicker>
    <x-common.mask-heading :lines="['Born in the forest,', 'made to *last*']" />
    <x-common.reveal :delay="0.1"><p>...</p></x-common.reveal>
    <x-common.cork-image src="images/sildel/manifesto.webp" alt="..." shape="arch" class="aspect-[3/4]" />
    <x-ui.button href="/treasures" arrow>Explore Treasures</x-ui.button>
</x-common.section-container>
```

Add a route + controller that passes content from the `ContentRepository`, exactly like `HomeController`.

## Accessibility and motion

Semantic landmarks, skip link, labelled icon buttons, visible focus rings, keyboard slider, focus-trapped
mobile menu, pausable hero slideshow. `prefers-reduced-motion` disables the preloader, parallax, word scrub,
custom cursor, slideshow autoplay and other animations. Content is fully visible without JavaScript.
