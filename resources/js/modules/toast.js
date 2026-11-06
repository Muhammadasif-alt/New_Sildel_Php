const DURATION = 6000;

/**
 * Sonner-style toasts. Animates in server-rendered flash toasts and exposes
 * window.sildelToast(message, type) for scripts.
 */
export function initToasts() {
    const toaster = document.querySelector('[data-toaster]');
    if (!toaster) return;

    toaster.querySelectorAll('[data-toast]').forEach(present);

    window.sildelToast = (message, type = 'success') => {
        const toast = document.createElement('div');
        toast.className = `toast${type === 'error' ? ' toast-error' : ''}`;
        toast.setAttribute('role', 'status');
        toast.innerHTML = '<span class="toast-mark" aria-hidden="true"></span><p></p><button type="button" class="toast-close" data-toast-close>&times;</button>';
        toast.querySelector('p').textContent = message;
        toast.querySelector('button').setAttribute('aria-label', toaster.dataset.dismissLabel ?? 'Dismiss');
        toaster.append(toast);
        present(toast);
    };
}

function present(toast) {
    let timer;

    const dismiss = () => {
        clearTimeout(timer);
        toast.classList.remove('is-visible');
        toast.addEventListener('transitionend', () => toast.remove(), { once: true });
        setTimeout(() => toast.remove(), 800);
    };

    const schedule = () => {
        clearTimeout(timer);
        timer = setTimeout(dismiss, DURATION);
    };

    // Two frames: the element must be painted once before the transition can run.
    requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add('is-visible')));

    toast.querySelector('[data-toast-close]')?.addEventListener('click', dismiss);
    // Pause while hovered or focused so the message can be read.
    toast.addEventListener('pointerenter', () => clearTimeout(timer));
    toast.addEventListener('pointerleave', schedule);
    toast.addEventListener('focusin', () => clearTimeout(timer));
    toast.addEventListener('focusout', schedule);
    schedule();
}
