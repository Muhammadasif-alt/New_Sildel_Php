{{--
    sections/home/ritual-step: one step card. Photo first (zooms on hover), a round numeral
    medallion overlapping its lower edge, then title and text. A gold line links the medallion
    to the next card (hidden on the last one via connect=false); a gold bar grows along the base.

    step: App\Data\RitualStep
--}}
@props(['step', 'variant' => 'light', 'connect' => true])

@php
    /** @var \App\Data\RitualStep $step */
@endphp

<article {{ $attributes->class('ritual-card flex flex-col') }}>
    <div @class(['ritual-media relative', 'has-connector' => $connect])>
        <div class="overflow-hidden">
            <x-common.cork-image
                :src="$step->image"
                :alt="$step->imageAlt"
                :variant="$variant"
                class="aspect-[16/10]"
                sizes="(min-width: 900px) 30vw, 100vw"
            />
        </div>
        <span class="ritual-numeral" aria-hidden="true">{{ str_pad((string) $step->numeral, 2, '0', STR_PAD_LEFT) }}</span>
    </div>

    <div class="flex flex-1 flex-col px-[clamp(26px,2.6vw,38px)] pt-14 pb-[clamp(34px,3.4vw,46px)]">
        <h3 class="text-[1.9rem] text-ink">{{ $step->title }}</h3>
        <p class="mt-3.5 text-[0.96rem] text-ink-soft">{{ $step->text }}</p>
    </div>
</article>
