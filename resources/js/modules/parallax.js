import { onScrollFrame } from '../lib/scroll-progress';
import { prefersReducedMotion } from '../lib/motion';

const DEFAULT_SPEED = -0.12;

/**
 * [data-parallax] layers drift against the scroll while their parent frame is on screen.
 * Optional data-parallax-speed (negative = slower than the page) tunes the strength.
 */
export default function initParallax(layers) {
    if (prefersReducedMotion()) return;

    layers.forEach((layer) => {
        const frame = layer.parentElement;
        const speed = Number(layer.dataset.parallaxSpeed ?? DEFAULT_SPEED);

        onScrollFrame(() => {
            const rect = frame.getBoundingClientRect();
            if (rect.bottom < 0 || rect.top > window.innerHeight) return;
            const centre = rect.top + rect.height / 2 - window.innerHeight / 2;
            layer.style.transform = `translate3d(0, ${centre * speed}px, 0)`;
        });
    });
}
