{{-- Authentic Cork: the material, the harvest film, the forest's biodiversity and climate role. --}}
<x-layouts.site :title="$page['seo']['title']" :description="$page['seo']['description']" :preloader="false">
    <x-common.page-hero
        tone="dark"
        layout="stacked"
        :kicker="$page['hero']['kicker']"
        :title="$page['hero']['title']"
        :intro="$page['hero']['intro']"
        :image="$page['hero']['image']"
        :image-alt="$page['hero']['image_alt']"
        :breadcrumbs="[[$page['hero']['kicker'], url()->current()]]"
    />

    {{-- The material, with three key facts --}}
    <section class="bg-onyx pb-[clamp(100px,12vw,170px)] text-bone">
        <x-common.section-container class="grid gap-[clamp(48px,7vw,110px)] border-t border-line pt-[clamp(60px,7vw,100px)] md:grid-cols-[1.1fr_1fr]">
            <div class="grid gap-6 text-[1.05rem] text-mute-light">
                @foreach ($page['intro']['paragraphs'] as $paragraph)
                    <x-common.reveal as="p" :delay="0.08 * $loop->index" :y="18">{{ $paragraph }}</x-common.reveal>
                @endforeach
            </div>
            <dl class="grid grid-cols-3 gap-6">
                @foreach ($page['intro']['facts'] as $fact)
                    <x-common.reveal :delay="0.1 * $loop->index" class="flex flex-col-reverse border-t border-line-strong pt-6">
                        <dt class="caps mt-4 leading-relaxed text-mute-light">{{ $fact['label'] }}</dt>
                        <dd class="font-display text-[clamp(2.6rem,4.4vw,4rem)] leading-none text-gold">{{ $fact['value'] }}</dd>
                    </x-common.reveal>
                @endforeach
            </dl>
        </x-common.section-container>
    </section>

    {{-- The harvest film --}}
    <section class="bg-velvet py-[clamp(100px,12vw,170px)] text-bone" aria-labelledby="film-title">
        <x-common.section-container>
            <div class="mb-[clamp(44px,5vw,72px)] grid items-end gap-8 md:grid-cols-2">
                <div>
                    <x-common.kicker>{{ $page['film']['kicker'] }}</x-common.kicker>
                    <x-common.mask-heading :lines="$page['film']['title']" id="film-title" class="mt-[22px]" />
                </div>
                <x-common.reveal as="p" :delay="0.15" class="max-w-[480px] text-mute-light md:justify-self-end">{{ $page['film']['text'] }}</x-common.reveal>
            </div>
            <x-common.reveal class="film-frame">
                <x-common.video-embed :youtube-id="$page['film']['youtube_id']" :poster="$page['film']['poster']" :title="$page['film']['video_title']" :play-label="$page['film']['play']" />
            </x-common.reveal>
        </x-common.section-container>
    </section>

    <x-sections.home.numbers
        :content="$page['biodiversity'] + ['intro' => $page['biodiversity']['text']]"
        :stats="array_map(\App\Data\Stat::fromArray(...), $page['biodiversity']['stats'])"
    />

    {{-- A lung for the planet --}}
    <section class="climate relative overflow-hidden bg-onyx py-[clamp(110px,13vw,190px)] text-bone" aria-labelledby="climate-title">
        <x-common.section-container>
            <div class="mx-auto max-w-[980px] text-center">
                <x-common.kicker lines="both" align="center">{{ $page['climate']['kicker'] }}</x-common.kicker>
                <x-common.reveal as="p" :delay="0.1" class="mx-auto mt-8 max-w-[560px] text-mute-light">{{ $page['climate']['lead'] }}</x-common.reveal>
                <h2 id="climate-title" class="mt-6">
                    <x-common.reveal as="span" :delay="0.2" class="climate-figure block">{{ $page['climate']['figure'] }}</x-common.reveal>
                    <x-common.reveal as="span" :delay="0.3" class="mt-4 block font-serif text-[clamp(1.6rem,3vw,2.6rem)] text-gold italic">{{ $page['climate']['unit'] }}</x-common.reveal>
                </h2>
            </div>

            <ul class="mt-[clamp(60px,7vw,100px)] grid gap-px overflow-hidden border border-line bg-line md:grid-cols-3" role="list">
                @foreach ($page['climate']['items'] as $item)
                    <x-common.reveal as="li" :delay="0.1 * $loop->index" class="bg-onyx px-8 py-12 text-center">
                        <span class="climate-icon" aria-hidden="true">
                            @switch($item['icon'])
                                @case('sun')
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="4" /><path d="M12 2.5v2.5M12 19v2.5M2.5 12H5M19 12h2.5M5.3 5.3l1.8 1.8M16.9 16.9l1.8 1.8M5.3 18.7l1.8-1.8M16.9 7.1l1.8-1.8" /></svg>
                                    @break
                                @case('leaf')
                                    <svg viewBox="0 0 24 24"><path d="M5 19c0-8 5.5-13 14-14-.5 8.5-5.5 14-14 14Z" /><path d="M5 19 13 11" /></svg>
                                    @break
                                @default
                                    <svg viewBox="0 0 24 24"><path d="M12 3.5c-3.6 4.2-6 7.3-6 10a6 6 0 0 0 12 0c0-2.7-2.4-5.8-6-10Z" /></svg>
                            @endswitch
                        </span>
                        <h3 class="mt-6 text-[1.7rem]">{{ $item['title'] }}</h3>
                        <p class="mt-3 text-mute-light">{{ $item['text'] }}</p>
                    </x-common.reveal>
                @endforeach
            </ul>
        </x-common.section-container>
    </section>

    <x-sections.shared.cta-band tone="velvet" :content="$page['closing']" />
</x-layouts.site>
