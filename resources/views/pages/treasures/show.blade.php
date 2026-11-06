{{--
    Product page, one template for every piece in config/treasures.php.
    Gallery on the left, a sticky column with the story, the enquiry button and the
    specifications on the right; "You may also like" underneath. No prices: every piece
    is sold through a personal enquiry (the button opens the contact form with the subject filled in).
--}}
@php
    /** @var \App\Data\Product $product */
    $enquiry = $site->route('contact').'?subject='.rawurlencode(str_replace(':name', $product->name, $labels['enquiry_subject'])).'#atelier';
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product->name,
        'description' => implode(' ', $product->description),
        'image' => array_map(fn ($photo) => asset($photo['src']), $product->gallery),
        'material' => $product->subtitle,
        'category' => $product->categoryLabel,
        'brand' => ['@type' => 'Brand', 'name' => $site->name],
        'url' => $product->url,
    ];
@endphp

<x-layouts.site
    :title="$product->name.' | '.$treasures['hero']['kicker'].' | '.$site->name"
    :description="\Illuminate\Support\Str::limit($product->description[0] ?? $product->subtitle, 155)"
    :image="$product->image ? asset($product->image) : null"
    :preloader="false"
>
    @push('structured-data')
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
    @endpush

    <section class="product-page bg-snow pt-[calc(var(--header-h)+clamp(28px,4vw,48px))] pb-[clamp(90px,11vw,150px)] text-ink" aria-labelledby="page-title">
        <x-common.section-container>
            <x-common.breadcrumbs :items="[
                [$treasures['hero']['kicker'], $site->route('treasures.index')],
                [$product->categoryLabel, $site->route('treasures.index').'?category='.$product->category],
                [$product->name, $product->url],
            ]" class="mb-[clamp(24px,3vw,40px)]" />

            <div class="grid gap-[clamp(40px,6vw,90px)] md:grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)]">
                <x-sections.treasures.gallery :product="$product" :labels="$labels" />

                <div class="product-summary">
                    <x-common.kicker tone="bronze">{{ $product->categoryLabel }}</x-common.kicker>
                    <h1 id="page-title" class="mt-5 text-[clamp(2.8rem,5vw,4.6rem)] leading-none">{{ $product->name }}</h1>
                    <p class="caps mt-5 text-ink-soft">{{ $product->subtitle }}</p>

                    @if ($product->exclusive || $product->tag)
                        <div class="mt-6 flex flex-wrap gap-2.5">
                            @if ($product->exclusive)
                                <span class="product-badge">
                                    <x-common.emblem class="size-4" />
                                    {{ $labels['exclusive'] }}
                                </span>
                            @endif
                            @if ($product->tag)
                                <span @class(['product-badge', 'product-badge-sage' => $product->tagTone === 'sage'])>{{ $product->tag }}</span>
                            @endif
                        </div>
                    @endif

                    <div class="product-story mt-9 grid gap-5 text-ink-soft">
                        @if ($product->lead)
                            <p class="font-serif text-[1.6rem] leading-snug text-ink italic">{{ $product->lead }}</p>
                        @endif
                        @foreach ($product->description as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    <div class="mt-10 flex flex-wrap items-center gap-x-8 gap-y-5">
                        <x-ui.button variant="ink" :href="$enquiry" arrow>{{ $labels['enquire'] }}</x-ui.button>
                        <a href="{{ $site->contact->phoneHref }}" class="caps text-ink-soft transition-colors hover:text-bronze-ink">{{ $site->contact->phone }}</a>
                    </div>

                    <ul class="product-assurances mt-9" role="list">
                        <li>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3.5c-3.6 4.2-6 7.3-6 10a6 6 0 0 0 12 0c0-2.7-2.4-5.8-6-10Z" /></svg>
                            <span>{{ $labels['one_of_a_kind'] }}</span>
                        </li>
                        <li>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8.5" /><path d="M3.5 12h17M12 3.5c2.4 2.6 3.5 5.4 3.5 8.5s-1.1 5.9-3.5 8.5c-2.4-2.6-3.5-5.4-3.5-8.5S9.6 6.1 12 3.5Z" /></svg>
                            <span>{{ $labels['shipping'] }}</span>
                        </li>
                    </ul>

                    <x-common.accordion class="mt-10">
                        <x-common.accordion-item :question="$labels['specifications']" open>
                            <dl class="spec-list">
                                <div><dt>{{ $labels['material'] }}</dt><dd>{{ $product->subtitle }}</dd></div>
                                @if ($product->measures)
                                    <div><dt>{{ $labels['measures'] }}</dt><dd>{!! collect($product->measures)->map(fn ($line) => e($line))->implode('<br>') !!}</dd></div>
                                @endif
                                @if ($product->weight)
                                    <div><dt>{{ $labels['weight'] }}</dt><dd>{{ $product->weight }}</dd></div>
                                @endif
                                @if ($product->variants)
                                    <div><dt>{{ $labels['variants'] }}</dt><dd>{{ $product->variants }}</dd></div>
                                @endif
                                @if ($product->includes)
                                    <div><dt>{{ $labels['includes'] }}</dt><dd>{{ $product->includes }}</dd></div>
                                @endif
                            </dl>
                            @if ($product->origin)
                                <p class="mt-6 text-[0.92rem] text-ink-soft italic">{{ $labels['origin'] }}</p>
                            @endif
                        </x-common.accordion-item>

                        @if ($product->care)
                            <x-common.accordion-item :question="$labels['care']">
                                <div class="grid gap-6">
                                    @foreach ($product->care as $group)
                                        <div>
                                            <p class="caps text-bronze-ink">{{ $group['title'] }}</p>
                                            <ul class="care-list mt-3" role="list">
                                                @foreach ($group['lines'] as $line)
                                                    <li>{{ $line }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </x-common.accordion-item>
                        @endif
                    </x-common.accordion>
                </div>
            </div>
        </x-common.section-container>
    </section>

    @if ($related)
        <section class="bg-paper py-[clamp(90px,11vw,150px)] text-ink" aria-labelledby="related-title">
            <x-common.section-container>
                <div class="mb-[clamp(40px,5vw,64px)] flex flex-wrap items-end justify-between gap-6">
                    <h2 id="related-title" class="text-h2">{{ $labels['related'] }}</h2>
                    <x-ui.button variant="outline" :href="$site->route('treasures.index')" arrow>{{ $labels['back'] }}</x-ui.button>
                </div>
                <ul class="grid gap-x-8 gap-y-14 sm:grid-cols-2 lg:grid-cols-3" role="list">
                    @foreach ($related as $item)
                        <li>
                            <x-common.reveal :delay="$loop->index * 0.1" :y="24">
                                <x-sections.treasures.treasure-card :product="$item" />
                            </x-common.reveal>
                        </li>
                    @endforeach
                </ul>
            </x-common.section-container>
        </section>
    @endif
</x-layouts.site>
