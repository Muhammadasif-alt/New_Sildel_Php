{{--
    common/breadcrumbs: "Home / Treasures / Abyss" trail with BreadcrumbList structured data.
    The last item is the current page (not a link).

    items: list of [label, url]
    tone:  light (default, ink text) | dark (bone text)

    <x-common.breadcrumbs :items="[['Treasures', $site->route('treasures.index')], ['Abyss', url()->current()]]" />
--}}
@props(['items' => [], 'tone' => 'light'])

@php
    $trail = [[$site->ui('home'), $site->homeUrl()], ...$items];
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_map(fn ($item, $i) => [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $item[0],
            'item' => $item[1],
        ], $trail, array_keys($trail)),
    ];
@endphp

<nav {{ $attributes->class(['breadcrumbs', 'breadcrumbs-dark' => $tone === 'dark']) }} aria-label="{{ $site->ui('breadcrumb') }}">
    <ol role="list">
        @foreach ($trail as [$label, $url])
            <li>
                @if ($loop->last)
                    <span aria-current="page">{{ $label }}</span>
                @else
                    <a href="{{ $url }}">{{ $label }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>

@push('structured-data')
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
@endpush
