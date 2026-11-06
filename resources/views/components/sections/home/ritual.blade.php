{{--
    sections/home/ritual: light section with the three steps from forest to home as cards.

    content keys: kicker, title (lines), steps (list<App\Data\RitualStep>)
--}}
@props(['content'])

<section class="bg-bone py-[clamp(110px,13vw,190px)] text-ink" aria-labelledby="ritual-title">
    <x-common.section-container>
        <div class="mx-auto mb-[clamp(56px,7vw,90px)] max-w-[760px] text-center">
            <x-common.kicker lines="both" align="center" tone="bronze">{{ $content['kicker'] }}</x-common.kicker>
            <x-common.mask-heading :lines="$content['title']" id="ritual-title" class="mt-6 text-ink [&_em]:text-bronze" />
        </div>

        <div class="grid gap-[clamp(24px,3vw,40px)] md:grid-cols-3">
            @foreach ($content['steps'] as $step)
                <x-common.reveal :delay="$loop->index * 0.12" class="h-full">
                    <x-sections.home.ritual-step :step="$step" :variant="$loop->index === 1 ? 'dark' : 'light'" :connect="! $loop->last" class="h-full" />
                </x-common.reveal>
            @endforeach
        </div>
    </x-common.section-container>
</section>
