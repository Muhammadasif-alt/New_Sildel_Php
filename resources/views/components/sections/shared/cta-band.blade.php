{{--
    sections/shared/cta-band: centred closing statement with one button.
    Used at the end of inner pages ("We do not sell products. We create treasures.", "Still have a question?").

    content keys: kicker (optional), title (lines), text (optional), cta{label,url}
    tone: dark (onyx, default) | light (paper) | velvet (pure black, with the lynx emblem)
--}}
@props(['content', 'tone' => 'dark'])

@php
    $light = $tone === 'light';
@endphp

<section {{ $attributes->class([
    'cta-band relative overflow-hidden py-[clamp(100px,12vw,170px)] text-center',
    'bg-paper text-ink' => $light,
    'bg-onyx text-bone' => $tone === 'dark',
    'bg-velvet text-bone' => $tone === 'velvet',
]) }}>
    @if ($tone === 'velvet')
        <x-common.emblem class="cta-band-emblem text-bone" />
    @endif

    <x-common.section-container class="relative max-w-[900px]">
        @if (! empty($content['kicker']))
            <x-common.kicker lines="both" align="center" :tone="$light ? 'bronze' : 'gold'">{{ $content['kicker'] }}</x-common.kicker>
        @endif

        <x-common.mask-heading :lines="$content['title']" :class="Arr::toCssClasses(['mt-6', '[&_em]:text-bronze' => $light])" />

        @if (! empty($content['text']))
            <x-common.reveal as="p" :delay="0.15" :class="Arr::toCssClasses(['mx-auto mt-7 max-w-[560px]', 'text-ink-soft' => $light, 'text-mute-light' => ! $light])">{{ $content['text'] }}</x-common.reveal>
        @endif

        <x-common.reveal :delay="0.25" class="mt-11">
            <x-ui.button :variant="$light ? 'ink' : 'gold'" :href="$content['cta']['url']" arrow>{{ $content['cta']['label'] }}</x-ui.button>
        </x-common.reveal>
    </x-common.section-container>
</section>
