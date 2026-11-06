/**
 * Calls `callback(element)` when each element enters the viewport (useInView equivalent).
 *
 * @param {Iterable<Element>} elements
 * @param {(el: Element) => void} callback
 * @param {{ threshold?: number, rootMargin?: string, once?: boolean }} [options]
 * @returns {() => void} cleanup
 */
export function inView(elements, callback, { threshold = 0.15, rootMargin = '0px', once = true } = {}) {
    const list = [...elements];

    if (!('IntersectionObserver' in window)) {
        list.forEach(callback);
        return () => {};
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                callback(entry.target);
                if (once) observer.unobserve(entry.target);
            });
        },
        { threshold, rootMargin },
    );

    list.forEach((el) => observer.observe(el));

    return () => observer.disconnect();
}
