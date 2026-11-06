/**
 * Runs `callback` at most once per animation frame on scroll and resize (useScrollProgress equivalent).
 * The callback also runs once immediately.
 *
 * @param {() => void} callback
 * @returns {() => void} cleanup
 */
export function onScrollFrame(callback) {
    let queued = false;

    const schedule = () => {
        if (queued) return;
        queued = true;
        requestAnimationFrame(() => {
            queued = false;
            callback();
        });
    };

    window.addEventListener('scroll', schedule, { passive: true });
    window.addEventListener('resize', schedule, { passive: true });
    callback();

    return () => {
        window.removeEventListener('scroll', schedule);
        window.removeEventListener('resize', schedule);
    };
}

/**
 * Progress (0..1) of an element travelling through the viewport.
 * 0 when its top reaches `start` (fraction of viewport height from the top),
 * 1 after it has moved a further `distance` (its height + extra viewport fraction).
 */
export function elementProgress(el, { start = 0.85, extra = 0.35 } = {}) {
    const rect = el.getBoundingClientRect();
    const vh = window.innerHeight;
    const progress = (vh * start - rect.top) / (rect.height + vh * extra);

    return Math.min(Math.max(progress, 0), 1);
}
