{{--
    sections/home/interiors: light split section. Tall photo (slow parallax drift inside its frame)
    with an overlapping square detail, beside copy, a diamond-bullet feature list and an arrow CTA.

    content keys: kicker, title (lines), text, features[], cta{label,url},
                  image, image_alt, detail_image, detail_image_alt
--}}
@props(['content'])

<section class="bg-paper py-[clamp(110px,13vw,190px)] text-ink" aria-labelledby="interiors-title">
    <x-common.section-container class="grid items-center gap-[clamp(40px,7vw,110px)] md:grid-cols-[1.1fr_1fr]">
        <x-common.reveal class="relative mr-3 mb-10 md:mr-10 md:mb-[60px]">
            <div class="relative aspect-[4/5] overflow-hidden">
                <div class="absolute inset-x-0 -inset-y-[8%]" data-parallax data-parallax-speed="-0.06">
                    <x-common.cork-image :src="$content['image']" :alt="$content['image_alt']" class="size-full" sizes="(min-width: 900px) 50vw, 100vw" />
                </div>
            </div>
            <x-common.cork-image
                :src="$content['detail_image']"
                :alt="$content['detail_image_alt']"
                variant="dark"
                class="absolute -right-3 -bottom-10 aspect-square w-[46%] border-[10px] border-paper md:-right-10 md:-bottom-[60px]"
                sizes="(min-width: 900px) 24vw, 46vw"
            />
        </x-common.reveal>

        <div>
            <x-common.kicker tone="bronze">{{ $content['kicker'] }}</x-common.kicker>
            <x-common.mask-heading :lines="$content['title']" id="interiors-title" class="mt-[22px] mb-7 text-ink [&_em]:text-bronze" />
            <p class="max-w-[500px] text-ink-soft">{{ $content['text'] }}</p>

            <ul class="mt-[30px] mb-11 grid gap-4" role="list">
                @foreach ($content['features'] as $feature)
                    <x-common.reveal as="li" :delay="0.1 + $loop->index * 0.08" :y="16" class="flex items-center gap-4 text-[0.95rem]">
                        <span class="size-2 flex-none rotate-45 border border-sage" aria-hidden="true"></span>
                        {{ $feature }}
                    </x-common.reveal>
                @endforeach
            </ul>

            <x-ui.button variant="ink" :href="$content['cta']['url']" arrow>{{ $content['cta']['label'] }}</x-ui.button>
        </div>
    </x-common.section-container>
</section>
