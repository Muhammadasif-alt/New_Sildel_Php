{{--
    sections/home/product-card: a collection piece, presented gallery-style on velvet black so the
    studio photograph has no visible edges. Hover: warm spotlight, gentle zoom, a gold hairline
    drawn under the name and the arrow circle filling gold.
    Reusable on any page listing products (grid or slider).

    product: App\Data\Product (pieces without a black studio photo show their white card)
    index:   position in the list (0-based, kept for callers; no longer displayed)
--}}
@props(['product', 'index' => 0])

@php
    /** @var \App\Data\Product $product */
    // Badge as on sildel.pt: the piece's own tag, otherwise "Unique & Exclusive" for one-of-a-kind pieces.
    $badge = $product->tag ?? ($product->exclusive ? $site->ui('unique') : null);
@endphp

<a href="{{ $product->url }}" {{ $attributes->class('product-card group block') }}>
    <div class="product-card-media relative aspect-[4/5] overflow-hidden bg-velvet">
        @if ($badge)
            <span @class(['product-tag', 'product-tag-sage' => $product->tag && $product->tagTone === 'sage'])>{{ $badge }}</span>
        @endif
        <x-common.cork-image
            :src="$product->galleryImage()"
            alt=""
            :label="$product->name"
            variant="dark"
            sizes="(min-width: 1100px) 33vw, 50vw"
            class="absolute inset-0 bg-velvet"
        />
    </div>

    <div class="product-card-info mt-6 flex items-center justify-between gap-4 pt-5">
        <div class="min-w-0">
            <h3 class="text-[clamp(1.35rem,2.1vw,2rem)] leading-tight transition-colors duration-500 group-hover:text-gold">{{ $product->name }}</h3>
            <p class="caps mt-2 text-mute-light">{{ $product->subtitle }}</p>
            @if ($badge)
                {{-- Phones: the badge moves under the name so it never covers the piece. --}}
                <p class="product-tag-inline">{{ $badge }}</p>
            @endif
        </div>
        <span class="product-arrow" aria-hidden="true">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
        </span>
    </div>
</a>
