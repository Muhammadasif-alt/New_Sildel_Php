{{--
    sections/home/numbers: "Why Sildel". White section with a centred heading and four columns,
    each a large figure, a title and a short text. Numeric figures count up when in view;
    text figures (display, e.g. "PT") are shown as-is.

    content keys: kicker, title (lines), intro (optional)
    stats: list<App\Data\Stat>
--}}
@props(['content', 'stats' => []])

<section class="bg-paper py-[clamp(100px,12vw,170px)] text-ink" aria-labelledby="numbers-title">
    <x-common.section-container>
        <div class="mx-auto mb-[clamp(56px,7vw,90px)] max-w-[760px] text-center">
            <x-common.kicker tone="bronze" lines="both" align="center">{{ $content['kicker'] }}</x-common.kicker>
            <x-common.mask-heading :lines="$content['title']" id="numbers-title" class="mt-[22px] text-ink [&_em]:text-bronze" />
            @if (! empty($content['intro']))
                <x-common.reveal as="p" :delay="0.15" class="mx-auto mt-7 max-w-[620px] text-ink-soft">{{ $content['intro'] }}</x-common.reveal>
            @endif
        </div>

        <dl @class(['grid gap-x-[clamp(28px,4vw,60px)] gap-y-14', 'md:grid-cols-3' => count($stats) === 3, 'sm:grid-cols-2 lg:grid-cols-4' => count($stats) !== 3])>
            @foreach ($stats as $stat)
                <x-common.reveal :delay="$loop->index * 0.1" class="flex flex-col border-t border-line-light pt-8">
                    <dt class="order-2 mt-7 font-serif text-[1.5rem] leading-tight text-ink">{{ $stat->label }}</dt>
                    <dd class="order-1 font-display text-[clamp(3rem,4.6vw,4.2rem)] leading-none text-bronze">
                        @if ($stat->isCounter())
                            <x-common.counter :to="$stat->value" :suffix="$stat->suffix" />
                        @else
                            {{ $stat->display }}
                        @endif
                    </dd>
                    @if ($stat->text)
                        <dd class="order-3 mt-3 text-[0.95rem] leading-[1.7] text-ink-soft">{{ $stat->text }}</dd>
                    @endif
                </x-common.reveal>
            @endforeach
        </dl>
    </x-common.section-container>
</section>
