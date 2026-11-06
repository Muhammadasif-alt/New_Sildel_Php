{{--
    common/video-embed: "lite" YouTube embed. Shows the poster and a play button; the real player
    (youtube-nocookie, privacy-friendly) is only loaded when the visitor clicks play
    (resources/js/modules/video.js), so the page stays fast.

    <x-common.video-embed youtube-id="l2P1x5BsNg4" poster="images/sildel/film-poster.webp" title="..." />
--}}
@props(['youtubeId', 'poster' => null, 'title', 'playLabel' => 'Play video'])

<div {{ $attributes->class('video-embed relative aspect-video overflow-hidden bg-velvet') }} data-video="{{ $youtubeId }}" data-video-title="{{ $title }}">
    <x-common.cork-image :src="$poster" alt="" variant="dark" class="absolute inset-0" sizes="(min-width: 1360px) 1360px, 100vw" />
    <span class="video-veil" aria-hidden="true"></span>
    <button type="button" class="video-play" aria-label="{{ $playLabel }}: {{ $title }}" data-video-play>
        <span class="video-play-icon" aria-hidden="true">
            <span class="video-play-ring"></span>
            <svg width="18" height="18" viewBox="0 0 24 24"><path d="M8 5.5v13l10.5-6.5z" fill="currentColor" /></svg>
        </span>
        <span class="video-play-label" aria-hidden="true">{{ $playLabel }}</span>
    </button>
    <noscript>
        <a href="https://www.youtube.com/watch?v={{ $youtubeId }}" class="absolute inset-0 z-[3]" aria-label="{{ $title }}"></a>
    </noscript>
</div>
