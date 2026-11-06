/**
 * Product gallery: thumbnails switch the large photo; arrow keys move between thumbnails.
 * Without JavaScript the thumbnails are plain links to the full-size photos.
 */
export default function initGalleries(galleries) {
    galleries.forEach((gallery) => {
        const slides = [...gallery.querySelectorAll('[data-gallery-slide]')];
        const thumbs = [...gallery.querySelectorAll('[data-gallery-thumb]')];
        if (thumbs.length < 2) return;

        const show = (index, focus = false) => {
            slides.forEach((slide, i) => slide.classList.toggle('is-active', i === index));
            thumbs.forEach((thumb, i) => {
                const active = i === index;
                thumb.classList.toggle('is-active', active);
                if (active) thumb.setAttribute('aria-current', 'true');
                else thumb.removeAttribute('aria-current');
            });
            if (focus) thumbs[index].focus();
        };

        thumbs.forEach((thumb, index) => {
            thumb.addEventListener('click', (event) => {
                event.preventDefault();
                show(index);
            });

            thumb.addEventListener('keydown', (event) => {
                const keys = { ArrowRight: 1, ArrowDown: 1, ArrowLeft: -1, ArrowUp: -1 };
                if (!(event.key in keys)) return;
                event.preventDefault();
                show((index + keys[event.key] + thumbs.length) % thumbs.length, true);
            });
        });
    });
}
