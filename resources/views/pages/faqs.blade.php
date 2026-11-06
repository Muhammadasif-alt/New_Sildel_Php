{{-- FAQs: grouped questions (heading on the left, answers on the right), then a contact band. --}}
<x-layouts.site :title="$page['seo']['title']" :description="$page['seo']['description']" :preloader="false">
    @push('structured-data')
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($page['groups'])->flatMap(fn ($group) => $group['items'])->map(fn ($item) => [
                '@type' => 'Question',
                'name' => $item['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
            ])->values(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    @endpush

    <x-common.page-hero
        :kicker="$page['hero']['kicker']"
        :title="$page['hero']['title']"
        :intro="$page['hero']['intro']"
        :breadcrumbs="[[$page['hero']['kicker'], url()->current()]]"
    />

    <div class="bg-paper pb-[clamp(100px,12vw,160px)] text-ink">
        @foreach ($page['groups'] as $group)
            <x-common.section-container
                as="section"
                class="grid gap-[clamp(24px,5vw,96px)] border-t border-line-light py-[clamp(48px,6vw,80px)] md:grid-cols-[0.8fr_1.2fr]"
                aria-labelledby="faq-group-{{ $loop->index }}"
            >
                <div>
                    <span class="font-display text-[2.6rem] leading-none text-bronze" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h2 id="faq-group-{{ $loop->index }}" class="mt-4 text-[clamp(2rem,3.4vw,3rem)]">{{ $group['title'] }}</h2>
                </div>
                <x-common.accordion :items="$group['items']" :open="$loop->first ? 0 : null" />
            </x-common.section-container>
        @endforeach
    </div>

    <x-sections.shared.cta-band :content="$page['contact']" />
</x-layouts.site>
