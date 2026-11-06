{{--
    common/page-hero: the opening section of every inner page.

    kicker, title (lines with *emphasis*), intro
    tone:       light (paper, default) | dark (onyx)
    imageRatio: aspect class of the split photo frame (default aspect-[4/5]); match it to the photo so nothing is cropped
    image:      optional photo. With layout="split" it sits beside the text;
                with layout="stacked" it runs full width below the heading.
    breadcrumbs list of [label, url] for the trail above the kicker (current page last)
    slot:       optional extra content under the intro (buttons, meta)

    <x-common.page-hero kicker="Treasures" :title="['We create', '*treasures*']" intro="..." :breadcrumbs="[['Treasures', url()->current()]]" />
--}}
@props([
    'kicker' => null,
    'title' => [],
    'intro' => null,
    'tone' => 'light',
    'image' => null,
    'imageAlt' => '',
    'layout' => 'split',
    'breadcrumbs' => [],
    'align' => 'left',
    'imageRatio' => 'aspect-[4/5]',
])

@php
    $dark = $tone === 'dark';
    $split = $image && $layout === 'split';
    $center = $align === 'center' && ! $split;
@endphp

<section {{ $attributes->class([
    'page-hero',
    'bg-onyx text-bone' => $dark,
    'bg-paper text-ink' => ! $dark,
]) }} aria-labelledby="page-title">
    <x-common.section-container :class="Arr::toCssClasses([
        'grid items-center gap-[clamp(40px,6vw,96px)]',
        'md:grid-cols-[1.05fr_1fr]' => $split,
    ])">
        <div @class(['page-hero-copy', 'mx-auto max-w-[860px] text-center' => $center, 'max-w-[760px]' => ! $center && ! $split])>
            @if ($breadcrumbs)
                <x-common.breadcrumbs :items="$breadcrumbs" :tone="$dark ? 'dark' : 'light'" :class="Arr::toCssClasses(['mb-[clamp(34px,5vw,60px)]', 'justify-center' => $center])" />
            @endif

            @if ($kicker)
                <x-common.kicker :tone="$dark ? 'gold' : 'bronze'" :lines="$center ? 'both' : 'left'" :align="$center ? 'center' : 'left'">{{ $kicker }}</x-common.kicker>
            @endif

            <x-common.mask-heading
                :lines="$title"
                as="h1"
                id="page-title"
                size="text-page"
                :class="Arr::toCssClasses(['mt-[22px]', '[&_em]:text-bronze' => ! $dark])"
            />

            @if ($intro)
                <x-common.reveal as="p" :delay="0.25" :class="Arr::toCssClasses([
                    'page-hero-intro mt-7 max-w-[600px]',
                    'mx-auto' => $center,
                    'text-mute-light' => $dark,
                    'text-ink-soft' => ! $dark,
                ])">{{ $intro }}</x-common.reveal>
            @endif

            @if ($slot->isNotEmpty())
                <x-common.reveal :delay="0.35" class="mt-10">{{ $slot }}</x-common.reveal>
            @endif
        </div>

        @if ($split)
            <x-common.reveal :delay="0.15" class="page-hero-media">
                <x-common.cork-image :src="$image" :alt="$imageAlt" :variant="$dark ? 'dark' : 'light'" :class="$imageRatio.' w-full'" sizes="(min-width: 900px) 45vw, 100vw" eager />
            </x-common.reveal>
        @endif
    </x-common.section-container>

    @if ($image && $layout === 'stacked')
        <x-common.section-container class="mt-[clamp(48px,6vw,90px)]">
            <x-common.reveal :delay="0.2" :y="0">
                <x-common.cork-image :src="$image" :alt="$imageAlt" :variant="$dark ? 'dark' : 'light'" class="page-hero-wide w-full" sizes="(min-width: 1360px) 1360px, 100vw" eager />
            </x-common.reveal>
        </x-common.section-container>
    @endif
</section>
