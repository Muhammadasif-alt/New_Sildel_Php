import { hasFinePointer, prefersReducedMotion } from '../lib/motion';

/** How quickly each part catches up with the pointer (0-1): the dot stays close, the ring lags. */
const DOT_FOLLOW = 0.45;
const RING_FOLLOW = 0.16;

/** Elements over which the ring grows. */
const INTERACTIVE = 'a, button, [role="button"], summary, label, input, textarea, select';

/**
 * Brand cursor: a bronze dot on the pointer and a ring (solid bronze, with a slowly turning gold
 * dashed outline) that follows behind. The ring grows over links and buttons, and fills with the
 * label of any element with data-cursor="Label". Disabled on touch devices and with reduced motion.
 */
export function initCursor() {
    const dot = document.querySelector('[data-cursor-dot]');
    const ring = document.querySelector('[data-cursor-ring]');
    const label = document.querySelector('[data-cursor-label]');

    if (!dot || !ring || !label || !hasFinePointer() || prefersReducedMotion()) return;

    document.documentElement.classList.add('has-cursor');

    let targetX = -100;
    let targetY = -100;
    const dotPos = { x: targetX, y: targetY };
    const ringPos = { x: targetX, y: targetY };
    let running = false;

    const render = () => {
        dotPos.x += (targetX - dotPos.x) * DOT_FOLLOW;
        dotPos.y += (targetY - dotPos.y) * DOT_FOLLOW;
        ringPos.x += (targetX - ringPos.x) * RING_FOLLOW;
        ringPos.y += (targetY - ringPos.y) * RING_FOLLOW;

        dot.style.transform = `translate3d(${dotPos.x}px, ${dotPos.y}px, 0)`;
        const ringTransform = `translate3d(${ringPos.x}px, ${ringPos.y}px, 0)`;
        ring.style.transform = ringTransform;
        label.style.transform = ringTransform;

        // Sleep once the ring has settled; the next pointer move wakes the loop.
        if (Math.abs(targetX - ringPos.x) < 0.1 && Math.abs(targetY - ringPos.y) < 0.1) {
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
            document.documentElement.classList.remove('cursor-away');
            wake();
        },
        { passive: true },
    );

    document.addEventListener('pointerover', (event) => {
        const labelled = event.target.closest?.('[data-cursor]') ?? null;
        const interactive = labelled ? null : (event.target.closest?.(INTERACTIVE) ?? null);
        const text = labelled?.dataset.cursor ?? '';

        ring.classList.toggle('is-big', Boolean(labelled));
        ring.classList.toggle('is-hover', Boolean(interactive));
        dot.classList.toggle('is-hidden', Boolean(labelled));
        label.classList.toggle('is-visible', Boolean(labelled) && text !== '');
        if (labelled) label.textContent = text;
    });

    // Hide everything while the pointer is outside the window.
    document.documentElement.addEventListener('pointerleave', () => {
        document.documentElement.classList.add('cursor-away');
    });
}
