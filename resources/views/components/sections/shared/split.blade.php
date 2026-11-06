{{--
    sections/shared/split: editorial text beside a photo. The building block of the story pages.

    content keys: kicker, title (lines), paragraphs[], image, image_alt
    tone:    paper (default) | bone | snow | onyx | velvet
    reverse: true puts the photo on the left
    ratio:   aspect class of the photo frame (default aspect-[4/5])
    slot:    optional content under the paragraphs (buttons, lists)
--}}
@props(['content', 'tone' => 'paper', 'reverse' => false, 'ratio' => 'aspect-[4/5]', 'id' => null])

@php
    $dark = in_array($tone, ['onyx', 'velvet'], true);
    $headingId = $id ? $id.'-title' : null;
@endphp

<section {{ $attributes->class([
    'py-[clamp(100px,12vw,170px)]',
    match ($tone) { 'bone' => 'bg-bone', 'snow' => 'bg-snow', 'onyx' => 'bg-onyx', 'velvet' => 'bg-velvet', default => 'bg-paper' },
    'text-bone' => $dark,
    'text-ink' => ! $dark,
]) }} @if ($id) id="{{ $id }}" aria-labelledby="{{ $headingId }}" @endif>
    <x-common.section-container class="grid items-center gap-[clamp(44px,7vw,110px)] md:grid-cols-2">
        <div @class(['max-w-[560px]', 'md:order-2' => $reverse])>
            @if (! empty($content['kicker']))
                <x-common.kicker :tone="$dark ? 'gold' : 'bronze'">{{ $content['kicker'] }}</x-common.kicker>
            @endif
            @if (! empty($content['title']))
                <x-common.mask-heading :lines="$content['title']" :id="$headingId" :class="Arr::toCssClasses(['mt-[22px] mb-8', '[&_em]:text-bronze' => ! $dark])" />
            @endif
            <div @class(['grid gap-5', 'text-mute-light' => $dark, 'text-ink-soft' => ! $dark])>
                @foreach ($content['paragraphs'] ?? [] as $paragraph)
                    <x-common.reveal as="p" :delay="0.08 * $loop->index" :y="18">{{ \App\Support\Markup::inline($paragraph) }}</x-common.reveal>
                @endforeach
            </div>
            @if ($slot->isNotEmpty())
                <div class="mt-10">{{ $slot }}</div>
            @endif
        </div>

        @if (! empty($content['image']))
            <x-common.reveal :class="Arr::toCssClasses(['relative', 'md:order-1' => $reverse])">
                <x-common.cork-image :src="$content['image']" :alt="$content['image_alt'] ?? ''" :variant="$dark ? 'dark' : 'light'" :class="'w-full '.$ratio" sizes="(min-width: 900px) 45vw, 100vw" />
            </x-common.reveal>
        @endif
    </x-common.section-container>
</section>
