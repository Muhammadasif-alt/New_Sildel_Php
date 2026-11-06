{{-- Journal article: header with meta and cover, the Markdown body, then three more articles. --}}
@php
    /** @var \App\Data\Article $article */
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $article->title,
        'description' => $article->excerpt,
        'datePublished' => $article->date->toDateString(),
        'image' => $article->image ? asset($article->image) : null,
        'url' => $article->url,
        'author' => ['@type' => 'Organization', 'name' => $site->name],
        'publisher' => ['@type' => 'Organization', 'name' => $site->name, 'logo' => ['@type' => 'ImageObject', 'url' => asset('icon-192.png')]],
    ];
@endphp

<x-layouts.site
    :title="$article->title.' | '.$site->name"
    :description="$article->excerpt"
    :image="$article->image ? asset($article->image) : null"
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

            <div class="mt-16 flex flex-wrap items-center justify-between gap-6 border-t border-line-light pt-10">
                <x-ui.text-link :href="$site->route('journal.index')" class="text-ink">{{ $page['back'] }}</x-ui.text-link>
                <x-ui.button variant="outline" :href="$site->route('treasures.index')" arrow>{{ $site->ui('explore_treasures') }}</x-ui.button>
            </div>
        </x-common.section-container>
    </article>

    @if ($more)
        <section class="bg-snow py-[clamp(90px,11vw,150px)] text-ink" aria-labelledby="more-title">
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
