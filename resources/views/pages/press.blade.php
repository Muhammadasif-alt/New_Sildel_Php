{{--
    Press: magazine features on a dark gallery wall. Items with a PDF open as a page-turning
    flipbook (resources/js/modules/flipbook.js: PDF.js renders the pages, StPageFlip turns them);
    the others open the clipping enlarged. Without JavaScript the card links straight to the PDF/image.
--}}
@php
    $viewer = $page['viewer'];
@endphp

<x-layouts.site :title="$page['seo']['title']" :description="$page['seo']['description']" :preloader="false">
    <x-common.page-hero
        tone="dark"
        align="center"
        :kicker="$page['hero']['kicker']"
        :title="$page['hero']['title']"
        :intro="$page['hero']['intro']"
        :breadcrumbs="[[$page['hero']['kicker'], url()->current()]]"
    />

    <section class="bg-onyx pb-[clamp(100px,12vw,160px)] text-bone" data-flipbook>
        <x-common.section-container as="ul" class="press-grid border-t border-line pt-[clamp(56px,7vw,90px)]" role="list">
            @foreach ($page['items'] as $item)
                @php
                    $pdf = $item['pdf'] ?? null;
                    $label = $item['publication'].(! empty($item['date']) ? ', '.$item['date'] : '');
                @endphp
                <x-common.reveal as="li" :delay="($loop->index % 3) * 0.1">
                    <a
                        href="{{ asset($pdf ?? $item['image']) }}"
                        class="press-card group"
                        data-flipbook-open
                        @if ($pdf) data-pdf="{{ asset($pdf) }}" @else data-image="{{ asset($item['image']) }}" @endif
                        data-title="{{ $item['publication'] }}"
                        data-date="{{ $item['date'] ?? '' }}"
                        aria-label="{{ ($pdf ? $viewer['read'] : $viewer['view']).': '.$label }}"
                        aria-haspopup="dialog"
                    >
                        <div class="press-media">
                            <x-common.cork-image :src="$item['image']" alt="" variant="dark" class="size-full" sizes="(min-width: 1100px) 30vw, (min-width: 600px) 45vw, 100vw" />
                            <span class="press-open" aria-hidden="true">
                                @if ($pdf)
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><path d="M12 6.5C10 5 7 4.5 3.5 5v13c3.5-.5 6.5 0 8.5 1.5 2-1.5 5-2 8.5-1.5V5C17 4.5 14 5 12 6.5Zm0 0v13" /></svg>
                                @else
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3"><circle cx="11" cy="11" r="6.5" /><path d="M16 16l4.5 4.5M11 8v6M8 11h6" /></svg>
                                @endif
                                <span>{{ $pdf ? $viewer['read'] : $viewer['view'] }}</span>
                            </span>
                        </div>
                        <div class="press-info">
                            <span class="press-title">{{ $item['publication'] }}</span>
                            @if (! empty($item['date']))
                                <span class="caps text-gold">{{ $item['date'] }}</span>
                            @endif
                        </div>
                    </a>
                </x-common.reveal>
            @endforeach
        </x-common.section-container>

        <dialog class="flipbook" aria-labelledby="flipbook-title" data-flipbook-dialog
            data-label-loading="{{ $viewer['loading'] }}" data-label-error="{{ $viewer['error'] }}" data-label-pages="{{ $viewer['pages'] }}">
            <div class="flipbook-bar">
                <div class="min-w-0">
                    <p id="flipbook-title" class="flipbook-title" data-flipbook-title></p>
                    <p class="caps text-gold" data-flipbook-date></p>
                </div>
                <p class="flipbook-counter" aria-live="polite" data-flipbook-counter></p>
                <div class="flipbook-actions">
                    <a href="#" class="flipbook-icon" download data-flipbook-download aria-label="{{ $viewer['download'] }}" title="{{ $viewer['download'] }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" aria-hidden="true"><path d="M12 4v11M7 10.5l5 5 5-5M5 19.5h14" /></svg>
                    </a>
                    <button type="button" class="flipbook-icon" data-flipbook-fullscreen aria-label="{{ $viewer['fullscreen'] }}" title="{{ $viewer['fullscreen'] }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" aria-hidden="true"><path d="M4 9V4h5M20 9V4h-5M4 15v5h5M20 15v5h-5" /></svg>
                    </button>
                    <button type="button" class="flipbook-icon" data-flipbook-close aria-label="{{ $viewer['close'] }}" title="{{ $viewer['close'] }}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" /></svg>
                    </button>
                </div>
            </div>

            <div class="flipbook-stage" data-flipbook-stage>
                <button type="button" class="flipbook-nav flipbook-prev" data-flipbook-prev aria-label="{{ $viewer['previous'] }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true"><path d="M19 12H5M11 6l-6 6 6 6" /></svg>
                </button>
                <div class="flipbook-book-wrap" data-flipbook-wrap></div>
                <img class="flipbook-image" alt="" data-flipbook-image hidden>
                <div class="flipbook-loading" data-flipbook-loading hidden>
                    <span class="flipbook-spinner" aria-hidden="true"></span>
                    <span data-flipbook-status></span>
                </div>
                <button type="button" class="flipbook-nav flipbook-next" data-flipbook-next aria-label="{{ $viewer['next'] }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                </button>
            </div>

            <p class="flipbook-hint" data-flipbook-hint>{{ $viewer['hint'] }}</p>
        </dialog>
    </section>

    <x-sections.shared.cta-band :content="$page['contact']" />
</x-layouts.site>
