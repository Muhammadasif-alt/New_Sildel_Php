{{--
    sections/home/statement: large serif statement lit word by word as it scrolls through the viewport.
    Words are split server-side; resources/js/modules/scrub.js lights them. Without JS or with
    reduced motion every word is fully visible.

    content keys: kicker, text, signature
--}}
@props(['content'])

@php
    $words = preg_split('/\s+/', trim($content['text']));
@endphp

<section class="border-t border-line py-[clamp(120px,16vw,220px)] text-center">
    <x-common.section-container>
        <x-common.reveal>
            <x-common.kicker lines="both" align="center">{{ $content['kicker'] }}</x-common.kicker>
        </x-common.reveal>

        {{-- One span per word, separated by single spaces (no template whitespace). --}}
        <p class="mx-auto mt-10 max-w-[1100px] font-serif text-statement font-normal" data-scrub>{!! collect($words)->map(fn ($word) => '<span class="scrub-word">'.e($word).'</span>')->implode(' ') !!}</p>

        <p class="signature mt-[60px]">{{ $content['signature'] }}</p>
    </x-common.section-container>
</section>
