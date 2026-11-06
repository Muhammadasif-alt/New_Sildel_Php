{{--
    common/whatsapp-button: round WhatsApp-green button fixed to the bottom-right corner.
    Opens a chat with the number in config/sildel.php ('whatsapp'), pre-filled with a short
    message in the current language. Hidden when the number is empty.

    <x-common.whatsapp-button :site="$site" />
--}}
@props(['site'])

@php
    $whatsapp = config('sildel.whatsapp', []);
    $number = preg_replace('/\D+/', '', (string) ($whatsapp['number'] ?? ''));
    $messages = $whatsapp['message'] ?? [];
    $message = $messages[$site->locale] ?? $messages['en'] ?? '';
    $href = 'https://wa.me/'.$number.($message !== '' ? '?text='.rawurlencode($message) : '');
@endphp

@if ($number !== '')
    <a href="{{ $href }}" class="whatsapp-btn" target="_blank" rel="noopener" aria-label="{{ $site->ui('whatsapp') }}" title="{{ $site->ui('whatsapp') }}">
        <svg viewBox="0 0 32 32" width="30" height="30" aria-hidden="true" focusable="false">
            <path fill="currentColor" d="M16.04 3C8.86 3 3.03 8.82 3.03 16c0 2.3.6 4.53 1.74 6.5L3 29l6.68-1.75A12.96 12.96 0 0 0 16.04 29C23.2 29 29 23.18 29 16S23.2 3 16.04 3Zm0 23.8c-1.98 0-3.92-.53-5.62-1.54l-.4-.24-3.96 1.04 1.06-3.86-.26-.4A10.76 10.76 0 0 1 5.2 16c0-5.97 4.86-10.83 10.84-10.83 5.97 0 10.82 4.86 10.82 10.83 0 5.98-4.85 10.8-10.82 10.8Zm5.94-8.1c-.33-.16-1.93-.95-2.23-1.06-.3-.11-.52-.16-.74.17-.22.32-.85 1.05-1.04 1.27-.19.22-.38.24-.71.08-.33-.16-1.38-.51-2.63-1.62-.97-.87-1.63-1.94-1.82-2.27-.19-.32-.02-.5.14-.66.15-.15.33-.38.49-.57.16-.19.22-.32.33-.54.11-.22.05-.41-.03-.57-.08-.16-.74-1.78-1.01-2.44-.27-.64-.54-.55-.74-.56h-.63c-.22 0-.57.08-.87.41-.3.32-1.14 1.11-1.14 2.71 0 1.6 1.17 3.15 1.33 3.36.16.22 2.3 3.5 5.56 4.91.78.34 1.39.54 1.86.69.78.25 1.49.21 2.05.13.63-.09 1.93-.79 2.2-1.55.27-.76.27-1.41.19-1.55-.08-.14-.3-.22-.63-.38Z"/>
        </svg>
    </a>
@endif
