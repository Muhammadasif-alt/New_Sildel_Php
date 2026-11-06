const reducedQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

/** True when the visitor asked the OS for reduced motion: skip preloader, parallax, scrub, cursor. */
export const prefersReducedMotion = () => reducedQuery.matches;

/** True on devices with a precise pointer that can hover (mouse / trackpad), never on touch. */
export const hasFinePointer = () => window.matchMedia('(hover: hover) and (pointer: fine)').matches;

/** Ease-out cubic, used by counters. */
export const easeOutCubic = (t) => 1 - Math.pow(1 - t, 3);
