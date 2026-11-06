const SESSION_KEY = 'sildel:intro';
const MIN_DURATION = 1700;
const MAX_WAIT = 4000;

/**
 * Plays the letter-by-letter intro once per session, then slides it away.
 * The inline <head> script already skipped it (html.no-preloader) for returning
 * visitors and reduced motion. Resolves when the page is revealed.
 *
 * @returns {Promise<void>}
 */
export function initPreloader() {
    const root = document.documentElement;
    const loader = document.querySelector('[data-preloader]');

    const reveal = () => {
        root.classList.remove('is-loading');
        // Next frame so the hero zoom-out transition actually runs.
        requestAnimationFrame(() => root.classList.add('is-loaded'));
    };

    if (!loader || root.classList.contains('no-preloader')) {
        loader?.remove();
        requestAnimationFrame(reveal);
        return Promise.resolve();
    }

    const started = performance.now();

    return new Promise((resolve) => {
        let finished = false;

        const finish = () => {
            if (finished) return;
            finished = true;

            setTimeout(() => {
                loader.classList.add('is-done');
                reveal();
                try {
                    sessionStorage.setItem(SESSION_KEY, '1');
                } catch {
                    // Private mode: the intro simply plays again next time.
                }
                loader.addEventListener('transitionend', () => loader.remove(), { once: true });
                resolve();
            }, Math.max(0, MIN_DURATION - (performance.now() - started)));
        };

        if (document.readyState === 'complete') {
            finish();
        } else {
            window.addEventListener('load', finish, { once: true });
            // Never hold the page hostage to a slow image.
            setTimeout(finish, MAX_WAIT);
        }
    });
}
