{{--
    sections/home/hero: cinematic split hero.
    Left: kicker, the SILDEL wordmark (h1), tagline, intro, CTA, "Our Story" link and collection line.
    Right: full-height product slideshow (resources/js/modules/hero-slideshow.js) bleeding to the edge,
    with a gold frame, live caption, slide counter, pause control and the rotating lynx badge.
    Below 900px the slideshow comes first as a tall banner.

    content keys: kicker, title, tagline, intro, aside, cta{label,url}, link{label,url},
                  collection_number, collection_label, foot_left, foot_right, badge, scroll,
                  pause, play, slides[{image, alt, caption}]
--}}
@props(['content'])

@php
    $slides = $content['slides'];
    $count = count($slides);
@endphp

<section class="hero relative grid overflow-hidden pt-(--header-h) md:min-h-svh md:grid-cols-[1.05fr_1fr]" aria-labelledby="hero-title">

    {{-- Slideshow: full-bleed right half --}}
    <div class="hero-visual relative min-h-[64svh] md:order-2 md:min-h-0" data-hero-slideshow data-interval="5200">
        @foreach ($slides as $slide)
            <div @class(['hero-slide', 'is-active' => $loop->first]) data-caption="{{ $slide['caption'] }}" @unless ($loop->first) aria-hidden="true" @endunless>
                <x-common.cork-image
                    :src="$slide['image']"
                    :alt="$slide['alt']"
                    variant="dark"
                    :eager="$loop->first"
                    class="hero-media absolute inset-0"
                    sizes="(min-width: 900px) 50vw, 100vw"
                />
            </div>
        @endforeach

        <span class="hero-fade" aria-hidden="true"></span>
        <span class="hero-frame" aria-hidden="true"></span>
        <p class="hero-caption" data-hero-caption>{{ $slides[0]['caption'] }}</p>

        @if ($count > 1)
            <div class="hero-controls">
                <span class="hero-counter" aria-hidden="true"><span data-hero-current>01</span>&nbsp;/&nbsp;{{ str_pad((string) $count, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="hero-progress" aria-hidden="true"><span data-hero-progress></span></span>
                <button type="button" class="hero-pause" aria-label="{{ $content['pause'] }}" data-label-pause="{{ $content['pause'] }}" data-label-play="{{ $content['play'] }}" data-hero-toggle>
                    <svg class="icon-pause" width="12" height="12" viewBox="0 0 12 12" aria-hidden="true"><path d="M3 1.5v9M9 1.5v9" stroke="currentColor" stroke-width="1.4" /></svg>
                    <svg class="icon-play" width="12" height="12" viewBox="0 0 12 12" aria-hidden="true"><path d="M3 1.5l7 4.5-7 4.5z" fill="currentColor" /></svg>
                </button>
            </div>
        @endif

        <x-common.rotating-badge :text="$content['badge']" class="absolute right-[clamp(40px,5vw,76px)] bottom-[clamp(76px,8vw,112px)] z-[4] size-[112px] md:size-[150px]">
            <x-common.emblem class="size-9 text-bone md:size-11" />
        </x-common.rotating-badge>
    </div>

    {{-- Copy --}}
    <div class="relative z-[2] flex flex-col justify-center px-(--gutter) pt-12 pb-20 md:py-[clamp(60px,8vw,120px)] md:pr-[clamp(24px,4vw,64px)] md:pl-[max(var(--gutter),(100vw-var(--container-site))/2)]">
        <x-common.reveal>
            <x-common.kicker>{{ $content['kicker'] }}</x-common.kicker>
        </x-common.reveal>

        <h1 id="hero-title" class="hero-wordmark mt-8" data-mask>
            <span class="mask-line"><span>{{ $content['title'] }}</span></span>
        </h1>
        <x-common.reveal :delay="0.15">
            <p class="mt-4 font-serif text-[clamp(1.35rem,2.2vw,1.9rem)] text-gold italic">{{ $content['tagline'] }}</p>
        </x-common.reveal>

        <x-common.reveal :delay="0.25">
            <p class="mt-8 max-w-[470px] text-[1.02rem] text-parchment">{{ $content['intro'] }}</p>
            <p class="mt-4 max-w-[470px] text-[0.95rem] text-mute-light">{{ $content['aside'] }}</p>

            <div class="mt-11 flex flex-wrap items-center gap-x-9 gap-y-5">
                <x-ui.button :href="$content['cta']['url']" arrow>{{ $content['cta']['label'] }}</x-ui.button>
                <x-ui.text-link :href="$content['link']['url']">{{ $content['link']['label'] }}</x-ui.text-link>
            </div>
        </x-common.reveal>

        <x-common.reveal :delay="0.35" class="mt-14 flex flex-wrap items-center gap-x-6 gap-y-3 border-t border-line pt-6">
            <span class="roman">{{ $content['collection_number'] }}&nbsp;&nbsp;{{ $content['collection_label'] }}</span>
            <span class="flex items-center gap-2.5 text-[0.62rem] tracking-[0.32em] text-mute-light uppercase">
                <span class="h-px w-5 bg-gold/60" aria-hidden="true"></span>
                {{ $content['foot_left'] }}
            </span>
            <span class="text-[0.62rem] tracking-[0.32em] text-mute uppercase">{{ $content['foot_right'] }}</span>
        </x-common.reveal>
    </div>
</section>
