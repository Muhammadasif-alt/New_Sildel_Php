import { onScrollFrame } from '../lib/scroll-progress';

/** Header turns from transparent to blurred solid after 60px of scroll. */
export function initHeader() {
    const header = document.querySelector('[data-header]');
    if (!header) return;

    onScrollFrame(() => header.classList.toggle('is-solid', window.scrollY > 60));
}
