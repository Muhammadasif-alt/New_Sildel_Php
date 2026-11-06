{{--
    sections/home/editorial-banner: full-bleed image with a slow parallax drift
    (resources/js/modules/parallax.js), a dark veil and a centred headline with CTA.
    Reusable on any page.

    <x-sections.home.editorial-banner image="images/sildel/editorial.webp" kicker="You Think Cork"
        :title-lines="['Interiors with', 'a living *soul*']" :cta="['label' => 'Discover More', 'url' => '...']" />
--}}
@props([
    'image' => null,
    'imageAlt' => '',
    'kicker',
    'titleLines' => [],
    'cta' => null,
])

<section class="relative grid h-[clamp(560px,90vh,860px)] place-items-center overflow-hidden text-center">
    <div class="editorial-media" data-parallax>
        <x-common.cork-image :src="$image" :alt="$imageAlt" variant="dark" class="size-full" sizes="100vw" />
    </div>
    <div class="absolute inset-0 z-[1] bg-veil" aria-hidden="true"></div>

    <div class="relative z-[2] px-6">
        <x-common.kicker lines="both" align="center">{{ $kicker }}</x-common.kicker>
        <x-common.mask-heading :lines="$titleLines" size="text-[clamp(2.8rem,7vw,6.6rem)]" class="mt-[26px] mb-11" />
        @if ($cta)
            <x-ui.button :href="$cta['url']">{{ $cta['label'] }}</x-ui.button>
        @endif
    </div>
</section>
