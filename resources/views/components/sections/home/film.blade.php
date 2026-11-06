{{--
    sections/home/film: centred heading above the brand film (lite YouTube embed in a gold frame).

    content keys: kicker, title (lines), youtube_id, poster, video_title, play
--}}
@props(['content'])

<section class="bg-onyx py-[clamp(100px,12vw,170px)]" aria-labelledby="film-title">
    <x-common.section-container>
        <div class="mx-auto mb-[clamp(48px,6vw,80px)] max-w-[820px] text-center">
            <x-common.kicker lines="both" align="center">{{ $content['kicker'] }}</x-common.kicker>
            <x-common.mask-heading :lines="$content['title']" id="film-title" class="mt-6" />
        </div>

        <x-common.reveal class="film-frame">
            <x-common.video-embed
                :youtube-id="$content['youtube_id']"
                :poster="$content['poster']"
                :title="$content['video_title']"
                :play-label="$content['play']"
            />
        </x-common.reveal>
    </x-common.section-container>
</section>
