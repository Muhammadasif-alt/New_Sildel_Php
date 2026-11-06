import { prefersReducedMotion } from '../lib/motion';

/**
 * Hero product slideshow: crossfades [.hero-slide] every data-interval ms, fills the progress
 * line, updates the caption and counter. The pause button (WCAG 2.2.2) toggles autoplay.
 * With reduced motion the first slide simply stays.
 */
export function initHeroSlideshow() {
    document.querySelectorAll('[data-hero-slideshow]').forEach(setup);
}

function setup(root) {
    const slides = [...root.querySelectorAll('.hero-slide')];
    const caption = root.querySelector('[data-hero-caption]');
    const current = root.querySelector('[data-hero-current]');
    const progress = root.querySelector('[data-hero-progress]');
    const toggle = root.querySelector('[data-hero-toggle]');
    const interval = Number(root.dataset.interval) || 5200;

    if (slides.length < 2) return;

    let index = 0;
    let timer = null;
    let paused = prefersReducedMotion();

    const animateProgress = () => {
        if (!progress) return;
        progress.style.transition = 'none';
        progress.style.transform = 'scaleX(0)';
        if (paused) return;
        // Force a reflow so the next transition starts from 0.
        void progress.offsetWidth;
        progress.style.transition = `transform ${interval}ms linear`;
        progress.style.transform = 'scaleX(1)';
    };

    const show = (next) => {
        slides[index].classList.remove('is-active');
        slides[index].setAttribute('aria-hidden', 'true');
        index = (next + slides.length) % slides.length;
        slides[index].classList.add('is-active');
        slides[index].removeAttribute('aria-hidden');

        if (caption) caption.textContent = slides[index].dataset.caption ?? '';
        if (current) current.textContent = String(index + 1).padStart(2, '0');
        animateProgress();
    };

    const schedule = () => {
        clearInterval(timer);
        if (!paused) timer = setInterval(() => show(index + 1), interval);
    };

    const setPaused = (value) => {
        paused = value;
        if (toggle) {
            toggle.setAttribute('aria-pressed', String(paused));
            toggle.setAttribute('aria-label', paused ? toggle.dataset.labelPlay : toggle.dataset.labelPause);
        }
        animateProgress();
        schedule();
    };

    toggle?.addEventListener('click', () => setPaused(!paused));

    // Do not cycle while the tab is hidden.
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) clearInterval(timer);
        else schedule();
    });

    setPaused(paused);
}
