{{-- Journal article: header with meta and cover, the Markdown body, questions and answers, then three more articles. --}}
@php
    /** @var \App\Data\Article $article */
    $root = rtrim(route('home'), '/').'/';
    [$coverWidth, $coverHeight] = $article->image ? (\App\Support\PublicImage::size($article->image) ?? [null, null]) : [null, null];
    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => array_values(array_filter([
            array_filter([
                '@type' => 'BlogPosting',
                '@id' => $article->url.'#article',
                'mainEntityOfPage' => $article->url,
                'url' => $article->url,
                'headline' => $article->title,
                'description' => $article->excerpt,
                'inLanguage' => $site->locales[$site->locale]['hreflang'],
                'datePublished' => $article->date->toDateString(),
                'dateModified' => $article->date->toDateString(),
                'articleSection' => $article->topic,
                'keywords' => $article->keywords ? implode(', ', $article->keywords) : null,
                'wordCount' => str_word_count(strip_tags((string) $article->body)),
                'image' => $article->image ? array_filter([
                    '@type' => 'ImageObject',
                    'url' => asset($article->image),
                    'width' => $coverWidth,
                    'height' => $coverHeight,
                    'caption' => $article->imageAlt,
                ]) : null,
                'author' => ['@id' => $root.'#organization'],
                'publisher' => ['@id' => $root.'#organization'],
            ]),
            $article->faq ? [
                '@type' => 'FAQPage',
                'mainEntity' => array_map(fn (array $item) => [
                    '@type' => 'Question',
                    'name' => $item['q'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
                ], $article->faq),
            ] : null,
        ])),
    ];
@endphp

<x-layouts.site
    :title="($article->seoTitle ?? $article->title).' | '.$site->name"
    :description="$article->excerpt"
    :image="$article->image ? asset($article->image) : null"
    :image-width="$coverWidth"
    :image-height="$coverHeight"
    type="article"
    :published="$article->date->toDateString()"
    :section="$article->topic"
    :preloader="false"
>
    @push('structured-data')
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    @endpush

    <article class="bg-paper text-ink" aria-labelledby="page-title">
        <header class="pt-[calc(var(--header-h)+clamp(28px,4vw,48px))]">
            <x-common.section-container class="max-w-[1000px]">
                <x-common.breadcrumbs :items="[[$page['hero']['kicker'], $site->route('journal.index')], [$article->title, $article->url]]" class="mb-[clamp(40px,6vw,80px)]" />
                <p class="journal-meta mt-0">
                    <span>{{ $article->topic }}</span>
                    <i aria-hidden="true"></i>
                    <time datetime="{{ $article->date->toDateString() }}">{{ $article->date->translatedFormat('j F Y') }}</time>
                    <i aria-hidden="true"></i>
                    <span>{{ str_replace(':count', $article->readingMinutes(), $page['minutes']) }}</span>
                </p>
                <h1 id="page-title" class="mt-6 text-[clamp(2.5rem,5.4vw,4.8rem)] leading-[1.05]">{{ $article->title }}</h1>
                <p class="mt-7 max-w-[720px] text-[1.1rem] text-ink-soft">{{ $article->excerpt }}</p>
            </x-common.section-container>

            <x-common.section-container class="mt-[clamp(44px,6vw,80px)] max-w-[1200px]">
                <x-common.reveal :y="0">
                    <x-common.cork-image :src="$article->image" :alt="$article->imageAlt" class="aspect-[16/9] w-full" sizes="(min-width: 1200px) 1200px, 100vw" eager />
                </x-common.reveal>
            </x-common.section-container>
        </header>

        <x-common.section-container class="max-w-[760px] py-[clamp(60px,8vw,110px)]">
            <x-common.prose :html="$article->body" />

            @if ($article->faq)
                {{-- Plain questions and answers: easy to scan, and what search engines and AI assistants quote. --}}
                <section class="mt-16" aria-labelledby="faq-title">
                    <h2 id="faq-title" class="text-[clamp(1.8rem,3vw,2.4rem)] leading-tight">{{ $page['faq'] }}</h2>
                    <x-common.accordion class="mt-8">
                        @foreach ($article->faq as $item)
                            <x-common.accordion-item :question="$item['q']" :open="$loop->first">
                                <p class="text-[1.06rem] leading-relaxed text-ink-soft">{{ $item['a'] }}</p>
                            </x-common.accordion-item>
                        @endforeach
                    </x-common.accordion>
                </section>
            @endif

            <div class="mt-16 flex flex-wrap items-center justify-between gap-6 border-t border-line-light pt-10">
                <x-ui.text-link :href="$site->route('journal.index')" class="text-ink">{{ $page['back'] }}</x-ui.text-link>
                <x-ui.button variant="outline" :href="$site->route('treasures.index')" arrow>{{ $site->ui('explore_treasures') }}</x-ui.button>
            </div>
        </x-common.section-container>
    </article>

    @if ($more)
        <section class="bg-bone py-[clamp(90px,11vw,150px)] text-ink" aria-labelledby="more-title">
            <x-common.section-container>
                <h2 id="more-title" class="mb-[clamp(40px,5vw,64px)] text-h2">{{ $page['more'] }}</h2>
                <ul class="grid gap-x-8 gap-y-16 md:grid-cols-3" role="list">
                    @foreach ($more as $item)
                        <x-common.reveal as="li" :delay="$loop->index * 0.1">
                            <x-sections.home.journal-card :article="$item" :read-label="$page['read']" />
                        </x-common.reveal>
                    @endforeach
                </ul>
            </x-common.section-container>
        </section>
    @endif
</x-layouts.site>
