/**
 * Treasures category filter. Chips are links (?category=lighting) so filtering works without
 * JavaScript; with it, the grid filters in place and the URL is kept in sync.
 */
export default function initFilters(roots) {
    roots.forEach((root) => {
        const chips = [...root.querySelectorAll('[data-filter-chip]')];
        const items = [...root.querySelectorAll('[data-category]')];
        const count = root.querySelector('[data-filter-count]');

        const apply = (category, push) => {
            let visible = 0;

            items.forEach((item) => {
                const show = !category || item.dataset.category === category;
                item.hidden = !show;
                if (show) visible += 1;
            });

            chips.forEach((chip) => {
                const active = chip.dataset.filterChip === category;
                chip.classList.toggle('is-active', active);
                chip.setAttribute('aria-pressed', String(active));
            });

            if (count) count.textContent = count.dataset.template.replace(':count', String(visible));

            if (push) {
                const url = new URL(window.location.href);
                if (category) url.searchParams.set('category', category);
                else url.searchParams.delete('category');
                window.history.replaceState({}, '', url);
            }
        };

        chips.forEach((chip) => {
            chip.addEventListener('click', (event) => {
                event.preventDefault();
                apply(chip.dataset.filterChip, true);
            });
        });
    });
}
