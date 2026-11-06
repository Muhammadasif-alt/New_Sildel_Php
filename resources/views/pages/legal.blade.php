{{-- Legal pages (Shipping and Returns, Terms and Conditions, Privacy Policy): one template, Markdown body. --}}
@php
    $pages = [
        'shipping-and-returns' => 'legal.shipping',
        'terms-and-conditions' => 'legal.terms',
        'privacy-policy' => 'legal.privacy',
    ];
@endphp

<x-layouts.site :title="$legal['seo']['title']" :description="$legal['seo']['description']" :preloader="false">
    <x-common.page-hero
        :kicker="$labels['kicker']"
        :title="[$legal['title']]"
        :breadcrumbs="[[$legal['title'], url()->current()]]"
    />

    <section class="bg-paper pb-[clamp(100px,12vw,160px)] text-ink">
        <x-common.section-container class="grid gap-[clamp(40px,6vw,96px)] border-t border-line-light pt-[clamp(48px,6vw,80px)] md:grid-cols-[240px_1fr]">
            <nav class="legal-nav" aria-label="{{ $labels['kicker'] }}">
                <ul role="list">
                    @foreach ($pages as $key => $route)
                        <li>
                            <a href="{{ $site->route($route) }}" @if ($key === $slug) aria-current="page" @endif>{{ $labels[$key]['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div class="max-w-[760px]">
                <x-common.prose :html="$legal['html']" />
                <p class="mt-14 border-t border-line-light pt-8 text-[0.92rem] text-ink-soft">
                    {!! str_replace(':email', '<a class="underline underline-offset-4" href="mailto:'.e($site->contact->email).'">'.e($site->contact->email).'</a>', e($labels['updated'])) !!}
                </p>
            </div>
        </x-common.section-container>
    </section>
</x-layouts.site>
