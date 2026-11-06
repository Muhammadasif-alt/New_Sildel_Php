const FOCUSABLE = 'a[href], button:not([disabled]), input:not([disabled]), [tabindex]:not([tabindex="-1"])';

/**
 * ui/sheet behaviour: any [data-sheet-trigger="id"] toggles the matching [data-sheet].
 * Handles aria-expanded/label, scroll lock, focus trap, Escape, and closing on link click.
 */
export function initSheets() {
    document.querySelectorAll('[data-sheet-trigger]').forEach((trigger) => {
        const sheet = document.getElementById(trigger.dataset.sheetTrigger);
        if (sheet) setupSheet(trigger, sheet);
    });
}

function setupSheet(trigger, sheet) {
    const root = document.documentElement;
    let open = false;

    const setOpen = (value, { restoreFocus = true } = {}) => {
        if (open === value) return;
        open = value;

        sheet.classList.toggle('is-open', open);
        root.classList.toggle('menu-open', open);
        document.body.style.overflow = open ? 'hidden' : '';
        trigger.setAttribute('aria-expanded', String(open));
        trigger.setAttribute('aria-label', open ? trigger.dataset.labelClose : trigger.dataset.labelOpen);

        if (open) {
            sheet.querySelector(FOCUSABLE)?.focus({ preventScroll: true });
        } else if (restoreFocus) {
            trigger.focus({ preventScroll: true });
        }
    };

    trigger.addEventListener('click', () => setOpen(!open));

    sheet.addEventListener('click', (event) => {
        if (event.target.closest('[data-sheet-close]')) setOpen(false, { restoreFocus: false });
    });

    document.addEventListener('keydown', (event) => {
        if (!open) return;

        if (event.key === 'Escape') {
            setOpen(false);
            return;
        }

        // Trap Tab inside the sheet plus its trigger (the burger stays visible above it).
        if (event.key === 'Tab') {
            const items = [trigger, ...sheet.querySelectorAll(FOCUSABLE)];
            const first = items[0];
            const last = items[items.length - 1];

            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
        }
    });

    // Close if the viewport grows past the mobile breakpoint while open.
    window.matchMedia('(min-width: 68.75rem)').addEventListener('change', (event) => {
        if (event.matches) setOpen(false, { restoreFocus: false });
    });
}
