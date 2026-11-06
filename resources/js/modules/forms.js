/**
 * Server-validated forms ([data-form]):
 *  - on submit, the submit button shows its "sending" label and blocks double submission;
 *  - after a failed submission, focus moves to the first invalid field.
 */
export function initForms() {
    document.querySelectorAll('[data-form]').forEach((form) => {
        form.addEventListener('submit', () => {
            const button = form.querySelector('[type="submit"]');
            if (!button) return;

            button.setAttribute('aria-busy', 'true');
            if (button.dataset.sendingLabel) button.textContent = button.dataset.sendingLabel;
        });
    });

    const invalid = document.querySelector('[data-form] [aria-invalid="true"]');
    invalid?.focus({ preventScroll: true });
}
