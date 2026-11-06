{{--
    sections/home/collection: the featured treasures on a velvet-black "gallery" background.

    layout: grid (default, 3 per row / 2 on mobile, last row centred, every piece visible)
            slider (horizontal drag/arrow/keyboard carousel, resources/js/modules/slider.js)

    content keys: kicker, title (lines), cta{label,url}
    products: list<App\Data\Product>
--}}
@props([
    'content',
    'products' => [],
    'ui' => [],
    'layout' => 'grid',
    'id' => 'collection',
])

@php
    $slider = $layout === 'slider';
@endphp

<section
    class="overflow-hidden bg-velvet py-[clamp(90px,11vw,150px)]"
    aria-labelledby="{{ $id }}-title"
    @if ($slider) data-slider @endif
>
    <x-common.section-container class="mb-[clamp(48px,6vw,80px)] flex flex-wrap items-end justify-between gap-10">
        <div>
            <x-common.kicker>{{ $content['kicker'] }}</x-common.kicker>
            <x-common.mask-heading :lines="$content['title']" id="{{ $id }}-title" class="mt-[22px]" />
            @if (! empty($content['divider']))
                <x-common.reveal :delay="0.3" :y="0">
                    <img src="{{ asset($content['divider']) }}" alt="" width="1024" height="16" class="mt-7 h-auto w-[min(440px,72vw)]" loading="lazy" decoding="async">
                </x-common.reveal>
            @endif
        </div>

        @if ($slider)
            <x-common.reveal class="flex items-center gap-[26px]">
                <div class="slider-progress hidden sm:block" aria-hidden="true"><span class="slider-progress-bar" data-slider-progress></span></div>
                <button type="button" class="icon-btn" aria-controls="{{ $id }}-track" aria-label="{{ $ui['previous'] ?? 'Previous' }}" data-slider-prev>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true"><path d="M19 12H5M11 6l-6 6 6 6" /></svg>
                </button>
                <button type="button" class="icon-btn" aria-controls="{{ $id }}-track" aria-label="{{ $ui['next'] ?? 'Next' }}" data-slider-next>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                </button>
            </x-common.reveal>
        @else
            <x-common.reveal>
                <x-ui.button variant="ghost" :href="$content['cta']['url']" arrow>{{ $content['cta']['label'] }}</x-ui.button>
            </x-common.reveal>
        @endif
    </x-common.section-container>

    @if ($slider)
        {{-- Focusable so arrow keys scroll it; each card is also a tabbable link. --}}
        <div
            id="{{ $id }}-track"
            class="slider-track"
            role="region"
            tabindex="0"
            aria-roledescription="carousel"
            aria-label="{{ str_replace('*', '', implode(' ', $content['title'])) }}"
            data-slider-track
        >
            @foreach ($products as $product)
                <x-sections.home.product-card :product="$product" :index="$loop->index" class="slider-item" />
            @endforeach
        </div>

        <x-common.section-container class="mt-[70px] text-center">
            <x-ui.button variant="ghost" :href="$content['cta']['url']">{{ $content['cta']['label'] }}</x-ui.button>
        </x-common.section-container>
    @else
        <x-common.section-container as="ul" class="product-grid product-grid-home" role="list">
            @foreach ($products as $product)
                <x-common.reveal as="li" :delay="($loop->index % 3) * 0.12" class="product-grid-item">
                    <x-sections.home.product-card :product="$product" :index="$loop->index" />
                </x-common.reveal>
            @endforeach
        </x-common.section-container>
    @endif
</section>
