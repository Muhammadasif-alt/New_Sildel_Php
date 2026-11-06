{{-- 404: shown for unknown URLs (NotFoundController) and for missing pieces or articles (errors/404). --}}
<x-layouts.site :title="$page['seo']['title']" :description="$page['seo']['description']" :preloader="false">
    @push('structured-data')
        <meta name="robots" content="noindex">
    @endpush

    <section class="relative flex min-h-[78vh] items-center overflow-hidden bg-velvet py-[clamp(100px,12vw,160px)] text-center text-bone" aria-labelledby="page-title">
        <x-common.emblem class="cta-band-emblem text-bone" />
        <x-common.section-container class="relative max-w-[860px]">
            <x-common.kicker lines="both" align="center">{{ $page['kicker'] }}</x-common.kicker>
            <x-common.mask-heading :lines="$page['title']" as="h1" id="page-title" size="text-page" class="mt-6" />
            <p class="mx-auto mt-8 max-w-[520px] text-mute-light">{{ $page['text'] }}</p>
            <div class="mt-12 flex flex-wrap items-center justify-center gap-x-10 gap-y-6">
                <x-ui.button :href="$page['cta']['url']" arrow>{{ $page['cta']['label'] }}</x-ui.button>
                <x-ui.text-link :href="$site->homeUrl()">{{ $page['home'] }}</x-ui.text-link>
            </div>
        </x-common.section-container>
    </section>
</x-layouts.site>
