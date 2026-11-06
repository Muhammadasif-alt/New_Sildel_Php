{{--
    ui/toaster: Sonner-style notification stack.
    Server flash messages (session "toast" => ['type' => 'success'|'error', 'message' => '...'])
    are rendered here and animated in by resources/js/modules/toast.js.
    Scripts can also call window.sildelToast('Message', 'success').
--}}
@props(['dismissLabel' => 'Dismiss'])

@php
    $toast = session('toast');
@endphp

<section class="toaster" aria-live="polite" aria-relevant="additions" data-toaster data-dismiss-label="{{ $dismissLabel }}">
    @if (is_array($toast) && filled($toast['message'] ?? null))
        <div @class(['toast', 'toast-error' => ($toast['type'] ?? '') === 'error']) role="status" data-toast>
            <span class="toast-mark" aria-hidden="true"></span>
            <p>{{ $toast['message'] }}</p>
            <button type="button" class="toast-close" aria-label="{{ $dismissLabel }}" data-toast-close>&times;</button>
        </div>
    @endif
</section>
