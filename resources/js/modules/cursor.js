import { hasFinePointer, prefersReducedMotion } from '../lib/motion';

const FOLLOW = 0.18;

/**
 * Gold follower cursor. Grows and shows the label of any element with data-cursor="Label".
 * Disabled on touch devices and with reduced motion.
 */
export function initCursor() {
    const dot = document.querySelector('[data-cursor-dot]');
    const label = document.querySelector('[data-cursor-label]');

    if (!dot || !label || !hasFinePointer() || prefersReducedMotion()) return;

    document.documentElement.classList.add('has-cursor');

    let targetX = -100;
    let targetY = -100;
    let x = targetX;
    let y = targetY;
    let running = false;

    const render = () => {
        x += (targetX - x) * FOLLOW;
        y += (targetY - y) * FOLLOW;

        const transform = `translate3d(${x}px, ${y}px, 0)`;
        dot.style.transform = transform;
        label.style.transform = transform;

        // Sleep once settled; the next pointer move wakes the loop.
        if (Math.abs(targetX - x) < 0.1 && Math.abs(targetY - y) < 0.1) {
            running = false;
            return;
        }
        requestAnimationFrame(render);
    };

    const wake = () => {
        if (running) return;
        running = true;
        requestAnimationFrame(render);
    };

    window.addEventListener(
        'pointermove',
        (event) => {
            if (event.pointerType !== 'mouse') return;
            targetX = event.clientX;
            targetY = event.clientY;
            wake();
        },
        { passive: true },
    );

    const setActive = (element) => {
        const text = element?.dataset.cursor ?? '';
        dot.classList.toggle('is-big', Boolean(element));
        label.classList.toggle('is-visible', Boolean(element) && text !== '');
        if (element) label.textContent = text;
    };

    document.addEventListener('pointerover', (event) => {
        setActive(event.target.closest?.('[data-cursor]') ?? null);
    });

    document.documentElement.addEventListener('pointerleave', () => setActive(null));
}
