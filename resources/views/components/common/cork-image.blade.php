{{--
    common/cork-image: photo on top of the cork-texture placeholder.
    When src is empty or the file is missing, only the texture (and optional label) shows.

    src:     path relative to /public (e.g. images/sildel/hero.webp)
    variant: light | dark (texture tone)     shape: rect | arch | circle
    label:   italic caption shown on the placeholder only
    eager:   true for above-the-fold images (no lazy loading, high fetch priority)

    The wrapper takes size/position classes; it is position:relative by default.
--}}
@props([
    'src' => null,
    'alt' => '',
    'variant' => 'light',
    'shape' => 'rect',
    'label' => null,
    'eager' => false,
    'sizes' => null,
])

@php
    $hasImage = \App\Support\PublicImage::exists($src);
    [$width, $height] = $hasImage ? (\App\Support\PublicImage::size($src) ?? [null, null]) : [null, null];
@endphp

<div
    {{ $attributes->class([
        'cork',
        'cork-dark' => $variant === 'dark',
        'cork-arch' => $shape === 'arch',
        'cork-circle' => $shape === 'circle',
    ]) }}
    @if (! $hasImage && $alt !== '') role="img" aria-label="{{ $alt }}" @endif
>
    @if ($hasImage)
        <img
            src="{{ asset($src) }}"
            alt="{{ $alt }}"
            @if ($width) width="{{ $width }}" height="{{ $height }}" @endif
            @if ($sizes) sizes="{{ $sizes }}" @endif
            @if ($eager) fetchpriority="high" @else loading="lazy" @endif
            decoding="async"
            class="cork-img"
            draggable="false"
        >
    @elseif ($label)
        <span class="cork-label" aria-hidden="true">{{ $label }}</span>
    @endif
</div>
