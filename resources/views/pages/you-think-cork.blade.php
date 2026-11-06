{{-- You Think Cork: partnerships with brands, designers and architects (Material Bank, collaborations, resellers). --}}
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
    <section class="bg-snow py-[clamp(100px,12vw,170px)] text-ink" aria-labelledby="network-title">
        <x-common.section-container class="grid items-center gap-[clamp(44px,7vw,110px)] md:grid-cols-[1fr_1.1fr]">
            <div class="grid grid-cols-2 gap-4">
                @foreach ($page['intro']['images'] as $image)
                    <x-common.reveal :delay="0.1 * $loop->index" :class="$loop->first ? 'mt-14' : ''">
                        <x-common.cork-image :src="$image['src']" :alt="$image['alt']" class="aspect-[3/4] w-full" sizes="(min-width: 900px) 22vw, 45vw" />
                    </x-common.reveal>
                @endforeach
            </div>
            <div class="max-w-[560px]">
                <x-common.mask-heading :lines="$page['intro']['title']" id="network-title" class="mb-8 [&_em]:text-bronze" />
                <div class="grid gap-5 text-ink-soft">
                    @foreach ($page['intro']['paragraphs'] as $paragraph)
                        <x-common.reveal as="p" :delay="0.08 * $loop->index" :y="18">{{ $paragraph }}</x-common.reveal>
                    @endforeach
                </div>
            </div>
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

    {{-- Collaborations --}}
    <section class="bg-onyx py-[clamp(100px,12vw,170px)] text-bone" aria-labelledby="collaborations-title">
        <x-common.section-container>
            <div class="mb-[clamp(48px,6vw,80px)] grid items-end gap-8 md:grid-cols-2">
                <div>
                    <x-common.kicker>{{ $page['collaborations']['kicker'] }}</x-common.kicker>
                    <x-common.mask-heading :lines="$page['collaborations']['title']" id="collaborations-title" class="mt-[22px]" />
                </div>
                <x-common.reveal as="p" :delay="0.15" class="max-w-[480px] text-mute-light md:justify-self-end">{{ $page['collaborations']['intro'] }}</x-common.reveal>
            </div>
            <ul class="grid gap-x-8 gap-y-14 md:grid-cols-3" role="list">
                @foreach ($page['collaborations']['items'] as $item)
                    <x-common.reveal as="li" :delay="0.1 * $loop->index" class="collab-card">
                        <div class="overflow-hidden">
                            <x-common.cork-image :src="$item['image']" :alt="$item['image_alt']" variant="dark" class="collab-media aspect-[4/5] w-full" sizes="(min-width: 900px) 30vw, 100vw" />
                        </div>
                        <p class="caps mt-6 text-gold">{{ $item['label'] }}</p>
                        <h3 class="mt-2 text-[1.9rem]">{{ $item['name'] }}</h3>
                        <p class="mt-3 text-mute-light">{{ $item['text'] }}</p>
                    </x-common.reveal>
                @endforeach
            </ul>
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
