/**
 * Lite YouTube embeds ([data-video]): swaps the poster for the real player on click.
 */
export default function initVideos(embeds) {
    embeds.forEach((embed) => {
        const button = embed.querySelector('[data-video-play]');

        button?.addEventListener('click', () => {
            const id = encodeURIComponent(embed.dataset.video);
            const iframe = document.createElement('iframe');

            iframe.src = `https://www.youtube-nocookie.com/embed/${id}?autoplay=1&rel=0&modestbranding=1&playsinline=1`;
            iframe.title = embed.dataset.videoTitle ?? '';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
            iframe.allowFullscreen = true;
            iframe.className = 'absolute inset-0 z-[5] size-full border-0';

            embed.append(iframe);
            embed.classList.add('is-playing');
            iframe.focus();
        });
    });
}
