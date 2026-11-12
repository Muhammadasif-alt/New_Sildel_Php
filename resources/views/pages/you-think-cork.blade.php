{{-- You Think Cork: partnerships. The Festival Mental trophy leads, then Porcel and Corklux, then how to work with us. --}}
<x-layouts.site :title="$page['seo']['title']" :description="$page['seo']['description']" :preloader="false">
    <x-common.page-hero
        :kicker="$page['hero']['kicker']"
        :title="$page['hero']['title']"
        :intro="$page['hero']['intro']"
        :image="$page['hero']['image']"
        :image-alt="$page['hero']['image_alt']"
        image-ratio="aspect-square"
        :breadcrumbs="[[$page['hero']['kicker'], url()->current()]]"
    >
        <x-ui.button variant="ink" href="#atelier" arrow>{{ $page['form']['kicker'] }}</x-ui.button>
    </x-common.page-hero>

    {{-- A network of forward-thinking companies --}}
    <section class="bg-bone py-[clamp(100px,12vw,170px)] text-ink" aria-labelledby="network-title">
        <x-common.section-container class="grid items-center gap-[clamp(44px,7vw,110px)] md:grid-cols-[1fr_1.1fr]">
            {{-- One photo on a warm stage: the studio white melts into the panel (multiply), so only the cork shows. --}}
            <x-common.reveal as="figure" class="sample-stage">
                <img src="{{ asset($page['intro']['image']) }}" alt="{{ $page['intro']['image_alt'] }}" width="1200" height="1200" loading="lazy" decoding="async">
                <figcaption>{{ $page['intro']['caption'] }}</figcaption>
            </x-common.reveal>
            <div class="max-w-[560px]">
                <x-common.kicker tone="bronze">{{ $page['intro']['kicker'] }}</x-common.kicker>
                <x-common.mask-heading :lines="$page['intro']['title']" id="network-title" class="mt-[22px] mb-8 [&_em]:text-bronze" />
                <div class="grid gap-5 text-ink-soft">
                    @foreach ($page['intro']['paragraphs'] as $paragraph)
                        <x-common.reveal as="p" :delay="0.08 * $loop->index" :y="18">{{ $paragraph }}</x-common.reveal>
                    @endforeach
                </div>
                <ul class="sample-points" role="list">
                    @foreach ($page['intro']['points'] as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>
        </x-common.section-container>
    </section>

    {{-- The Festival Mental trophy: the centrepiece. Intro and facts, then one block per edition. --}}
    <section class="bg-onyx py-[clamp(100px,12vw,170px)] text-bone" id="trophy" aria-labelledby="trophy-title">
        <x-common.section-container>
            <div class="partner-head">
                <div>
                    <x-common.kicker>{{ $page['trophy']['kicker'] }}</x-common.kicker>
                    <x-common.mask-heading :lines="$page['trophy']['title']" id="trophy-title" class="mt-[22px]" />
                </div>
                <div class="partner-lede">
                    @foreach ($page['trophy']['paragraphs'] as $paragraph)
                        <x-common.reveal as="p" :delay="0.08 * $loop->index" :y="18">{{ $paragraph }}</x-common.reveal>
                    @endforeach
                </div>
            </div>

            <dl class="trophy-facts">
                @foreach ($page['trophy']['facts'] as $fact)
                    <x-common.reveal :delay="0.1 * $loop->index" :y="18">
                        <dd class="trophy-fact-value">{{ $fact['value'] }}</dd>
                        <dt class="trophy-fact-label">{{ $fact['label'] }}</dt>
                    </x-common.reveal>
                @endforeach
            </dl>

            {{-- One block per edition: a huge year you can read from across the room, then a photo
                 mosaic (tall lead, one wide photo, three small ones). Even editions mirror the layout. --}}
            @foreach ($page['trophy']['editions'] as $edition)
                <article @class(['edition', 'edition-reverse' => $loop->even])>
                    <header class="edition-head">
                        <x-common.reveal as="p" class="edition-year" :y="20">{{ $edition['year'] }}</x-common.reveal>
                        <x-common.reveal :delay="0.1">
                            <p class="edition-label">{{ $edition['label'] }}</p>
                            <h3 class="edition-title">{{ $edition['title'] }}</h3>
                            <p class="edition-text">{{ $edition['text'] }}</p>
                        </x-common.reveal>
                    </header>

                    <div class="edition-mosaic">
                        <x-common.reveal class="edition-tile edition-tile-lead">
                            <x-common.cork-image :src="$edition['lead']['src']" :alt="$edition['lead']['alt']" variant="dark" class="size-full" sizes="(min-width: 900px) 40vw, 100vw" />
                        </x-common.reveal>
                        <x-common.reveal class="edition-tile edition-tile-wide" :delay="0.1">
                            <x-common.cork-image :src="$edition['feature']['src']" :alt="$edition['feature']['alt']" variant="dark" class="size-full" sizes="(min-width: 900px) 55vw, 100vw" />
                            <p class="edition-caption">{{ $edition['feature']['caption'] }}</p>
                        </x-common.reveal>
                        @foreach ($edition['photos'] as $photo)
                            <x-common.reveal class="edition-tile" :delay="0.15 + 0.08 * $loop->index" :y="20">
                                <x-common.cork-image :src="$photo['src']" :alt="$photo['alt']" variant="dark" class="size-full" sizes="(min-width: 900px) 18vw, 33vw" />
                            </x-common.reveal>
                        @endforeach
                    </div>
                </article>
            @endforeach

            <div class="mt-[clamp(56px,7vw,96px)] text-center">
                <x-ui.button variant="ghost" :href="$page['trophy']['cta']['url']" arrow>{{ $page['trophy']['cta']['label'] }}</x-ui.button>
            </div>
        </x-common.section-container>
    </section>

    {{-- Porcel: porcelain and cork, in the partners' own words, beside photos from the fair. --}}
    <section class="bg-paper py-[clamp(100px,12vw,170px)] text-ink" id="porcel" aria-labelledby="porcel-title">
        <x-common.section-container class="grid items-center gap-[clamp(44px,7vw,110px)] md:grid-cols-[1fr_1.1fr]">
            <div class="max-w-[560px]">
                <x-common.kicker tone="bronze">{{ $page['porcel']['kicker'] }}</x-common.kicker>
                <x-common.mask-heading :lines="$page['porcel']['title']" id="porcel-title" class="mt-[22px] mb-8 [&_em]:text-bronze" />
                <div class="grid gap-5 text-ink-soft">
                    @foreach ($page['porcel']['paragraphs'] as $paragraph)
                        <x-common.reveal as="p" :delay="0.08 * $loop->index" :y="18">{{ $paragraph }}</x-common.reveal>
                    @endforeach
                </div>
                <x-common.reveal as="blockquote" class="partner-quote">{{ $page['porcel']['quote'] }}</x-common.reveal>
                <p class="caps mt-8 text-bronze-ink">{{ $page['porcel']['note'] }}</p>
            </div>
            <div class="porcel-photos">
                @foreach ($page['porcel']['photos'] as $photo)
                    <x-common.reveal :delay="0.1 * $loop->index" :class="'porcel-photo porcel-photo-'.$loop->iteration">
                        <x-common.cork-image :src="$photo['src']" :alt="$photo['alt']" class="size-full" sizes="(min-width: 900px) 40vw, 100vw" />
                    </x-common.reveal>
                @endforeach
            </div>
        </x-common.section-container>
    </section>

    {{-- Corklux: the lighting range made with Lightenjin, one tile per model. --}}
    <section class="bg-velvet py-[clamp(100px,12vw,170px)] text-bone" id="corklux" aria-labelledby="corklux-title">
        <x-common.section-container>
            <div class="partner-head">
                <div>
                    <x-common.kicker>{{ $page['corklux']['kicker'] }}</x-common.kicker>
                    <x-common.mask-heading :lines="$page['corklux']['title']" id="corklux-title" class="mt-[22px]" />
                </div>
                <div class="partner-lede">
                    @foreach ($page['corklux']['paragraphs'] as $paragraph)
                        <x-common.reveal as="p" :delay="0.08 * $loop->index" :y="18">{{ $paragraph }}</x-common.reveal>
                    @endforeach
                </div>
            </div>
            <ul class="corklux-grid" role="list">
                @foreach ($page['corklux']['items'] as $item)
                    <x-common.reveal as="li" :delay="0.08 * $loop->index" class="collab-card">
                        <div class="overflow-hidden">
                            <x-common.cork-image :src="$item['image']" :alt="$item['image_alt']" variant="dark" class="collab-media corklux-media aspect-[4/3] w-full" sizes="(min-width: 900px) 22vw, 45vw" />
                        </div>
                        <h3 class="mt-5 text-[1.5rem]">{{ $item['name'] }}</h3>
                        <p class="mt-2 text-mute-light">{{ $item['text'] }}</p>
                    </x-common.reveal>
                @endforeach
            </ul>
        </x-common.section-container>
    </section>

    {{-- What we can build together --}}
    <section class="bg-bone py-[clamp(100px,12vw,170px)] text-ink" aria-labelledby="services-title">
        <x-common.section-container>
            <div class="mx-auto mb-[clamp(52px,6vw,84px)] max-w-[760px] text-center">
                <x-common.kicker tone="bronze" lines="both" align="center">{{ $page['services']['kicker'] }}</x-common.kicker>
                <x-common.mask-heading :lines="$page['services']['title']" id="services-title" class="mt-[22px] [&_em]:text-bronze" />
            </div>
            <ol class="grid gap-6 md:grid-cols-3" role="list">
                @foreach ($page['services']['items'] as $item)
                    <x-common.reveal as="li" :delay="0.1 * $loop->index" class="service-card">
                        <span class="service-number" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-10 text-[1.9rem] leading-tight">{{ $item['title'] }}</h3>
                        <p class="mt-4 text-ink-soft">{{ $item['text'] }}</p>
                    </x-common.reveal>
                @endforeach
            </ol>
        </x-common.section-container>
    </section>

    <x-sections.shared.split
        :content="[...$page['partners'], 'image' => 'images/sildel/pages/material-bank-table.webp', 'image_alt' => 'Sildel cork samples on a presentation table']"
        tone="paper"
        reverse
        ratio="aspect-square"
        id="partners"
    />

    <x-sections.home.atelier
        :content="[...$atelier, 'kicker' => $page['form']['kicker'], 'title' => $page['form']['title'], 'intro' => $page['hero']['intro']]"
        :contact="$site->contact"
        :subject="$page['form']['subject']"
    />
</x-layouts.site>
