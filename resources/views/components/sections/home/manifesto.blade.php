{{--
    sections/home/manifesto: light (bone) section. Tall photo with a circular detail and an
    outlined watermark word, beside the manifesto copy, quote and CTA.

    content keys: kicker, title (lines), paragraphs_before[], quote, paragraphs_after[], cta{label,url},
                  image, image_alt, detail_image, detail_image_alt, watermark (optional outlined word, off by default)
--}}
@props(['content'])

<section class="relative overflow-hidden bg-bone py-[clamp(110px,13vw,190px)] text-ink" aria-labelledby="manifesto-title">
    <x-common.section-container class="grid items-center gap-[clamp(50px,8vw,130px)] md:grid-cols-[5fr_6fr]">
        <x-common.reveal class="relative mb-[50px] md:mb-0">
            <x-common.cork-image
                :src="$content['image']"
                :alt="$content['image_alt']"
                class="aspect-[4/5.2]"
                sizes="(min-width: 900px) 40vw, 100vw"
            />
            <x-common.cork-image
                :src="$content['detail_image']"
                :alt="$content['detail_image_alt']"
                variant="dark"
                class="absolute -bottom-[40px] -left-[12px] aspect-square w-[46%] border-[10px] border-bone md:-bottom-[60px] md:-left-[40px]"
                sizes="(min-width: 900px) 21vw, 52vw"
            />
            @if (! empty($content['watermark']))
                <span class="manifesto-watermark absolute -top-10 -right-[30px]" aria-hidden="true">{{ $content['watermark'] }}</span>
            @endif
        </x-common.reveal>

        <div class="mt-[60px] md:mt-0">
            <x-common.kicker tone="bronze">{{ $content['kicker'] }}</x-common.kicker>
            <x-common.mask-heading :lines="$content['title']" id="manifesto-title" class="mt-[26px] mb-[38px] text-ink [&_em]:text-bronze" />

            @foreach ($content['paragraphs_before'] as $paragraph)
                <p class="mb-5 max-w-[540px] text-ink-soft">{{ $paragraph }}</p>
            @endforeach

            <blockquote class="manifesto-quote">{{ $content['quote'] }}</blockquote>

            @foreach ($content['paragraphs_after'] as $paragraph)
                <p class="mb-5 max-w-[540px] text-ink-soft">{{ $paragraph }}</p>
            @endforeach

            <div class="mt-10">
                <x-ui.button variant="ink" :href="$content['cta']['url']">{{ $content['cta']['label'] }}</x-ui.button>
            </div>
        </div>
    </x-common.section-container>
</section>
