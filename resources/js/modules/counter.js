import { inView } from '../lib/in-view';
import { easeOutCubic, prefersReducedMotion } from '../lib/motion';

/** Counts each [data-counter] from 0 to data-to (ease-out) once 60% visible. */
export default function initCounters(counters) {
    if (prefersReducedMotion()) return;

    counters.forEach((el) => {
        el.textContent = '0';
    });

    inView(
        counters,
        (el) => {
            const to = Number(el.dataset.to) || 0;
            const duration = Number(el.dataset.duration) || 1800;
            let start = null;

            const tick = (time) => {
                start ??= time;
                const progress = Math.min((time - start) / duration, 1);
                el.textContent = String(Math.round(to * easeOutCubic(progress)));
                if (progress < 1) requestAnimationFrame(tick);
            };

            requestAnimationFrame(tick);
        },
        { threshold: 0.6 },
    );
}
