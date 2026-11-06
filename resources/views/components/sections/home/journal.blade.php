{{--
    sections/home/journal: latest articles from the Sildel blog, three cards on a light surface.

    content keys: kicker, title (lines), intro, cta{label,url}
    articles: list<App\Data\Article>
--}}
@props(['content', 'articles' => [], 'ui' => []])

<section class="bg-paper py-[clamp(100px,12vw,170px)] text-ink" aria-labelledby="journal-title">
    <x-common.section-container class="mb-[clamp(44px,5vw,70px)] flex flex-wrap items-end justify-between gap-8">
        <div class="max-w-[680px]">
            <x-common.kicker tone="bronze">{{ $content['kicker'] }}</x-common.kicker>
            <x-common.mask-heading :lines="$content['title']" id="journal-title" class="mt-[22px] text-ink [&_em]:text-bronze" />
            <x-common.reveal as="p" :delay="0.15" class="mt-6 text-ink-soft">{{ $content['intro'] }}</x-common.reveal>
        </div>
        <x-common.reveal>
            <x-ui.button variant="outline" :href="$content['cta']['url']" arrow>{{ $content['cta']['label'] }}</x-ui.button>
        </x-common.reveal>
    </x-common.section-container>

    <x-common.section-container as="ul" class="grid gap-x-8 gap-y-14 md:grid-cols-3" role="list">
        @foreach ($articles as $article)
            <x-common.reveal as="li" :delay="$loop->index * 0.12">
                <x-sections.home.journal-card :article="$article" :read-label="$ui['read_article'] ?? 'Read Article'" />
            </x-common.reveal>
        @endforeach
    </x-common.section-container>
</section>
