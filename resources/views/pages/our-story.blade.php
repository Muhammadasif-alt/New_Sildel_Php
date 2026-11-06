{{-- Our Story: forty years with cork, the lynx, the founder's dream, the craft. --}}
<x-layouts.site :title="$page['seo']['title']" :description="$page['seo']['description']" :preloader="false">
    <x-common.page-hero
        tone="dark"
        align="center"
        :kicker="$page['hero']['kicker']"
        :title="$page['hero']['title']"
        :intro="$page['hero']['intro']"
        :breadcrumbs="[[$page['hero']['kicker'], url()->current()]]"
    >
        <x-common.emblem class="mx-auto size-16 text-bone" />
    </x-common.page-hero>

    <x-sections.shared.split :content="[...$page['intro'], 'image' => 'images/sildel/pages/our-story-intro.webp', 'image_alt' => 'White porcelain vase on a sculpted cork base, a Sildel and Porcel piece']" id="story" />

    {{-- The lynx: large emblem on velvet beside the text --}}
    <section class="relative overflow-hidden bg-velvet py-[clamp(110px,13vw,190px)] text-bone" aria-labelledby="lynx-title">
        <x-common.section-container class="grid items-center gap-[clamp(48px,8vw,120px)] md:grid-cols-[0.9fr_1.1fr]">
            <x-common.reveal class="lynx-mark" :y="0">
                <x-common.emblem class="aspect-square w-full text-bone" />
            </x-common.reveal>
            <div class="max-w-[600px]">
                <x-common.kicker>{{ $page['lynx']['kicker'] }}</x-common.kicker>
                <x-common.mask-heading :lines="$page['lynx']['title']" id="lynx-title" class="mt-[22px] mb-8" />
                <div class="grid gap-5 text-mute-light">
                    @foreach ($page['lynx']['paragraphs'] as $paragraph)
                        <x-common.reveal as="p" :delay="0.08 * $loop->index" :y="18">{{ $paragraph }}</x-common.reveal>
                    @endforeach
                </div>
            </div>
        </x-common.section-container>
    </section>

    <x-sections.home.film :content="$page['film']" />

    {{-- The founder's dream --}}
    <section class="bg-bone py-[clamp(110px,13vw,190px)] text-ink" aria-labelledby="founder-title">
        <x-common.section-container class="grid items-center gap-[clamp(48px,7vw,110px)] md:grid-cols-[0.8fr_1.2fr]">
            <x-common.reveal class="founder-portrait">
                <x-common.cork-image :src="$page['founder']['image']" :alt="$page['founder']['image_alt']" variant="dark" class="aspect-square w-full" sizes="(min-width: 900px) 36vw, 80vw" />
            </x-common.reveal>
            <figure>
                <x-common.kicker tone="bronze">{{ $page['founder']['kicker'] }}</x-common.kicker>
                <h2 id="founder-title" class="sr-only">{{ $page['founder']['name'] }}</h2>
                <blockquote class="founder-quote mt-8 grid gap-6">
                    @foreach ($page['founder']['quote'] as $paragraph)
                        <x-common.reveal as="p" :delay="0.08 * $loop->index" :y="18">{{ \App\Support\Markup::inline($paragraph) }}</x-common.reveal>
                    @endforeach
                </blockquote>
                <figcaption class="mt-10 flex items-center gap-5">
                    <span class="h-px w-12 bg-bronze" aria-hidden="true"></span>
                    <span>
                        <span class="block font-serif text-[1.5rem] leading-none">{{ $page['founder']['name'] }}</span>
                        <span class="caps mt-2 block text-ink-soft">{{ $page['founder']['role'] }}</span>
                    </span>
                </figcaption>
            </figure>
        </x-common.section-container>
    </section>

    <x-sections.shared.split :content="$page['craft']" tone="paper" reverse ratio="aspect-square" id="craft" />

    <x-sections.shared.cta-band tone="velvet" :content="$shared['treasures_cta']" />
</x-layouts.site>
