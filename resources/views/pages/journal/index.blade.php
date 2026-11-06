{{-- Journal: six articles per page in a 3 x 2 grid, with numbered pagination underneath. --}}
@php
    $current = $pagination['current'];
    $last = $pagination['last'];
    $first = $current === 1;
    $rest = $articles;

    $base = $site->route('journal.index');
    $pageUrl = fn (int $n) => $n === 1 ? $base : $base.'?page='.$n;
    $title = $first ? $page['seo']['title'] : str_replace(':page', $current, $page['page_title']).' | '.$page['seo']['title'];
@endphp

@push('head')
    @if ($current > 1)
        <link rel="prev" href="{{ $pageUrl($current - 1) }}">
    @endif
    @if ($current < $last)
        <link rel="next" href="{{ $pageUrl($current + 1) }}">
    @endif
@endpush

<x-layouts.site :title="$title" :description="$page['seo']['description']" :canonical="$pageUrl($current)" :preloader="false">
    <x-common.page-hero
        :kicker="$page['hero']['kicker']"
        :title="$page['hero']['title']"
        :intro="$page['hero']['intro']"
        :breadcrumbs="[[$page['hero']['kicker'], url()->current()]]"
    />

    <section class="bg-snow py-[clamp(70px,9vw,130px)] text-ink">
        @if ($rest)
            <x-common.section-container as="ul" class="grid gap-x-8 gap-y-16 sm:grid-cols-2 lg:grid-cols-3" role="list">
                @foreach ($rest as $article)
                    <x-common.reveal as="li" :delay="($loop->index % 3) * 0.1">
                        <x-sections.home.journal-card :article="$article" :read-label="$page['read']" />
                    </x-common.reveal>
                @endforeach
            </x-common.section-container>
        @endif

        @if ($last > 1)
            <x-common.section-container as="nav" class="pagination" aria-label="{{ $page['pagination_label'] }}">
                @if ($current > 1)
                    <a href="{{ $pageUrl($current - 1) }}" class="pagination-step" rel="prev">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" aria-hidden="true"><path d="M19 12H5M11 6l-6 6 6 6" /></svg>
                        <span>{{ $page['previous'] }}</span>
                    </a>
                @else
                    <span class="pagination-step is-disabled" aria-hidden="true">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M19 12H5M11 6l-6 6 6 6" /></svg>
                        <span>{{ $page['previous'] }}</span>
                    </span>
                @endif

                <ol class="pagination-pages" role="list">
                    @for ($n = 1; $n <= $last; $n++)
                        <li>
                            @if ($n === $current)
                                <span class="pagination-page is-current" aria-current="page">{{ str_pad((string) $n, 2, '0', STR_PAD_LEFT) }}</span>
                            @else
                                <a href="{{ $pageUrl($n) }}" class="pagination-page" aria-label="{{ str_replace(':page', $n, $page['page_title']) }}">{{ str_pad((string) $n, 2, '0', STR_PAD_LEFT) }}</a>
                            @endif
                        </li>
                    @endfor
                </ol>

                @if ($current < $last)
                    <a href="{{ $pageUrl($current + 1) }}" class="pagination-step" rel="next">
                        <span>{{ $page['next'] }}</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                    </a>
                @else
                    <span class="pagination-step is-disabled" aria-hidden="true">
                        <span>{{ $page['next'] }}</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                    </span>
                @endif
            </x-common.section-container>
        @endif
    </section>
</x-layouts.site>
