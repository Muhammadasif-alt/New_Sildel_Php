{{--
    layouts/site (SiteLayout): document shell shared by every page.
    Provides SEO <head>, JSON-LD, Preloader, CustomCursor, GrainOverlay, Header, MobileMenu, Footer, Toaster.

    <x-layouts.site :title="..." :description="...">  ...sections...  </x-layouts.site>
    Title/description default to the locale SEO settings in config/sildel.php.
--}}
@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'preloader' => true,
    'canonical' => null,
])

@php
    $title ??= $site->seo['title'];
    $description ??= $site->seo['description'];
    $image ??= $site->ogImage;
    $canonical ??= $site->alternateUrls[$site->locale] ?? url()->current();
    $current = $site->locales[$site->locale];
@endphp

<!DOCTYPE html>
<html lang="{{ $current['hreflang'] }}" class="is-loading">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    {{-- Runs before first paint: enables JS-only animation states and decides whether the intro plays. --}}
    <script>
        (function (root) {
            root.classList.add('js');
            var seen = false;
            try { seen = sessionStorage.getItem('sildel:intro') === '1'; } catch (e) {}
            var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (seen || reduced || {{ $preloader ? 'false' : 'true' }}) {
                root.classList.add('no-preloader');
                root.classList.remove('is-loading');
            }
        })(document.documentElement);
    </script>

    <link rel="preload" href="{{ asset('fonts/italiana-latin-400-normal.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/cormorant-garamond-latin-500-normal.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/manrope-latin-400-normal.woff2') }}" as="font" type="font/woff2" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="description" content="{{ $description }}">
    <meta name="theme-color" content="{{ config('sildel.theme_color') }}">
    <link rel="canonical" href="{{ $canonical }}">
    @foreach ($site->alternateUrls as $code => $url)
        <link rel="alternate" hreflang="{{ $site->locales[$code]['hreflang'] }}" href="{{ $url }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ $site->alternateUrls[$site->defaultLocale] }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $site->name }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="{{ $current['og'] }}">
    @foreach ($site->locales as $code => $locale)
        @if ($code !== $site->locale)
            <meta property="og:locale:alternate" content="{{ $locale['og'] }}">
        @endif
    @endforeach
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $image }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('icon-192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <x-layout.structured-data :site="$site" />
    @stack('structured-data')
    @stack('head')
</head>
<body>
    <a href="#main" class="skip-link">{{ $site->ui('skip_to_content') }}</a>

    @if ($preloader)
        <x-common.preloader :word="mb_strtoupper($site->name)" />
    @endif
    <x-common.custom-cursor />
    <x-common.grain-overlay />

    <x-layout.header :site="$site" />
    <x-layout.mobile-menu :site="$site" />

    <main id="main" tabindex="-1">
        {{ $slot }}
    </main>

    <x-layout.footer :site="$site" />
    <x-common.whatsapp-button :site="$site" />
    <x-ui.toaster :dismiss-label="$site->ui('dismiss')" />
</body>
</html>
