import { inView } from '../lib/in-view';
import { prefersReducedMotion } from '../lib/motion';

/** Fade-ups ([data-reveal]) and line masks ([data-mask]) play once when 15% visible. */
export function initReveal() {
    const elements = document.querySelectorAll('[data-reveal], [data-mask]');
    const show = (el) => el.classList.add('is-in');

    if (prefersReducedMotion()) {
        elements.forEach(show);
        return;
    }

    inView(elements, show, { threshold: 0.15 });
}
