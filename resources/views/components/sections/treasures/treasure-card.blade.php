{{--
    sections/treasures/treasure-card: a piece in the Treasures grid and in "You may also like".
    White studio stage with the photo floating in it; on hover the piece lifts slightly and a
    hairline draws under the name.

    product: App\Data\Product
    tone:    light (default, white page) | dark (warm ivory plinth on the dark gallery page)
--}}
@props(['product', 'tone' => 'light'])

@php
    $dark = $tone === 'dark';
@endphp

@php
    /** @var \App\Data\Product $product */
@endphp

<a href="{{ $product->url }}" {{ $attributes->class(['treasure-card group block', 'treasure-card-dark' => $dark]) }}>
    <div class="treasure-media relative aspect-[4/5] overflow-hidden">
        @if ($product->tag)
            <span @class(['product-tag', 'product-tag-sage' => $product->tagTone === 'sage'])>{{ $product->tag }}</span>
        @endif
        <x-common.cork-image :src="$product->image" alt="" :label="$product->name" class="absolute inset-0" sizes="(min-width: 1100px) 30vw, (min-width: 600px) 45vw, 100vw" />
    </div>

    <div class="treasure-info flex items-start justify-between gap-4 pt-5">
        <div class="min-w-0">
            <p @class(['caps', 'text-gold' => $dark, 'text-bronze-ink' => ! $dark])>{{ $product->categoryLabel }}</p>
            <h3 @class(['mt-2 text-[clamp(1.45rem,2vw,1.85rem)] leading-tight transition-colors duration-500', 'text-bone group-hover:text-gold' => $dark, 'text-ink' => ! $dark])>{{ $product->name }}</h3>
            <p @class(['mt-1 text-[0.88rem]', 'text-mute-light' => $dark, 'text-ink-soft' => ! $dark])>{{ $product->subtitle }}</p>
        </div>
        <span class="treasure-arrow" aria-hidden="true">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
        </span>
    </div>
</a>
