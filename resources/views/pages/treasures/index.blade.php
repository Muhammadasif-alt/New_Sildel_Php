{{-- Treasures: the whole catalogue with category filters (resources/js/modules/filter.js; ?category= works without JS). --}}
<x-layouts.site :title="$page['seo']['title']" :description="$page['seo']['description']" :preloader="false">
    <x-common.page-hero
        tone="dark"
        align="center"
        :kicker="$page['hero']['kicker']"
        :title="$page['hero']['title']"
        :intro="$page['hero']['intro']"
        :breadcrumbs="[[$page['hero']['kicker'], url()->current()]]"
    />

    <section class="treasures-dark bg-onyx pb-[clamp(100px,12vw,160px)] text-bone" data-filter>
        <div class="filter-bar">
            <x-common.section-container class="flex flex-wrap items-center justify-between gap-x-8 gap-y-4">
                <div class="filter-chips" role="group" aria-label="{{ $page['filter_label'] }}">
                    <a href="{{ $site->route('treasures.index') }}" @class(['filter-chip', 'is-active' => ! $active]) data-filter-chip="" @if (! $active) aria-pressed="true" @else aria-pressed="false" @endif>{{ $page['all'] }}</a>
                    @foreach ($categories as $key => $label)
                        <a href="{{ $site->route('treasures.index') }}?category={{ $key }}" @class(['filter-chip', 'is-active' => $active === $key]) data-filter-chip="{{ $key }}" aria-pressed="{{ $active === $key ? 'true' : 'false' }}">{{ $label }}</a>
                    @endforeach
                </div>
                <p class="caps text-mute-light" aria-live="polite" data-filter-count data-template="{{ $page['count'] }}">
                    {{ str_replace(':count', $active ? collect($products)->where('category', $active)->count() : count($products), $page['count']) }}
                </p>
            </x-common.section-container>
        </div>

        <x-common.section-container as="ul" class="treasure-grid" role="list">
            @foreach ($products as $product)
                <li class="treasure-grid-item" data-category="{{ $product->category }}" @if ($active && $product->category !== $active) hidden @endif>
                    <x-common.reveal :delay="($loop->index % 3) * 0.08" :y="24">
                        <x-sections.treasures.treasure-card :product="$product" tone="dark" />
                    </x-common.reveal>
                </li>
            @endforeach
        </x-common.section-container>
    </section>

    <x-sections.shared.cta-band tone="velvet" :content="$page['bespoke']" />
</x-layouts.site>
