import { dragScroll } from '../lib/drag-scroll';
import { prefersReducedMotion } from '../lib/motion';

const GAP = 34;

/**
 * Collection slider: arrows scroll one card, mouse drag, ArrowLeft/ArrowRight/Home/End
 * when the track is focused, progress bar, and arrow buttons disabled at either end.
 */
export default function initSliders(sliders) {
    sliders.forEach(setupSlider);
}

function setupSlider(slider) {
    const track = slider.querySelector('[data-slider-track]');
    const prev = slider.querySelector('[data-slider-prev]');
    const next = slider.querySelector('[data-slider-next]');
    const bar = slider.querySelector('[data-slider-progress]');

    if (!track) return;

    const behavior = prefersReducedMotion() ? 'auto' : 'smooth';
    const step = () => (track.firstElementChild?.offsetWidth ?? 300) + GAP;
    const max = () => track.scrollWidth - track.clientWidth;
    const scrollByCards = (direction) => track.scrollBy({ left: direction * step(), behavior });

    const update = () => {
        const limit = max();
        const ratio = limit > 0 ? track.scrollLeft / limit : 0;

        if (bar) bar.style.width = `${20 + 80 * ratio}%`;
        if (prev) prev.disabled = track.scrollLeft <= 2;
        if (next) next.disabled = track.scrollLeft >= limit - 2;
    };

    prev?.addEventListener('click', () => scrollByCards(-1));
    next?.addEventListener('click', () => scrollByCards(1));

    track.addEventListener('keydown', (event) => {
        if (event.target !== track) return;

        const actions = {
            ArrowLeft: () => scrollByCards(-1),
            ArrowRight: () => scrollByCards(1),
            Home: () => track.scrollTo({ left: 0, behavior }),
            End: () => track.scrollTo({ left: max(), behavior }),
        };

        if (actions[event.key]) {
            event.preventDefault();
            actions[event.key]();
        }
    });

    track.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update, { passive: true });
    dragScroll(track);
    update();
}
