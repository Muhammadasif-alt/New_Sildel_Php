import { inView } from './lib/in-view';
import { initCursor } from './modules/cursor';
import { initForms } from './modules/forms';
import { initHeader } from './modules/header';
import { initHeroSlideshow } from './modules/hero-slideshow';
import { initPreloader } from './modules/preloader';
import { initReveal } from './modules/reveal';
import { initSheets } from './modules/sheet';
import { initToasts } from './modules/toast';

/**
 * Below-the-fold behaviours are split into their own chunks and only downloaded
 * when their section comes within one viewport of the screen.
 */
const lazyModules = {
    '[data-scrub]': () => import('./modules/scrub'),
    '[data-slider]': () => import('./modules/slider'),
    '[data-counter]': () => import('./modules/counter'),
    '[data-parallax]': () => import('./modules/parallax'),
    '[data-video]': () => import('./modules/video'),
    '[data-gallery]': () => import('./modules/gallery'),
    '[data-filter]': () => import('./modules/filter'),
    '[data-flipbook]': () => import('./modules/flipbook'),
};

function loadWhenNear(selector, loader) {
    const elements = [...document.querySelectorAll(selector)];
    if (elements.length === 0) return;

    let loaded = false;
    const stop = inView(
        elements,
        () => {
            if (loaded) return;
            loaded = true;
            loader().then((module) => module.default(elements));
        },
        { rootMargin: '100% 0px', threshold: 0 },
    );
    void stop;
}

function boot() {
    initHeader();
    initSheets();
    initCursor();
    initHeroSlideshow();
    initToasts();
    initForms();

    Object.entries(lazyModules).forEach(([selector, loader]) => loadWhenNear(selector, loader));

    // Reveal animations start once the intro has lifted, so the hero animates in view.
    initPreloader().then(initReveal);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot, { once: true });
} else {
    boot();
}
