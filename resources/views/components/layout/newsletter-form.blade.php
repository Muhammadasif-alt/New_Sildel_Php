{{--
    layout/newsletter-form: single email field with an inline Subscribe button.
    Posts to /newsletter (unique email, honeypot, 5/min rate limit). Errors use the "newsletter" bag.

    <x-layout.newsletter-form :content="$site->footer['newsletter']" />
--}}
@props(['content'])

@php
    $error = $errors->newsletter->first('email');
@endphp

<form method="POST" action="{{ route('newsletter.store') }}" {{ $attributes->class('w-full') }} data-form novalidate>
    @csrf
    <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
    <div class="hp-field" aria-hidden="true">
        <label for="newsletter-company-website">Company website</label>
        <input type="text" id="newsletter-company-website" name="{{ \App\Http\Middleware\RejectHoneypot::FIELD }}" tabindex="-1" autocomplete="off">
    </div>

    <div class="flex border-b border-line focus-within:border-gold transition-colors duration-500">
        <label for="newsletter-email" class="sr-only">{{ $content['placeholder'] }}</label>
        <input
            type="email"
            id="newsletter-email"
            name="email"
            value="{{ old('email') && $errors->newsletter->any() ? old('email') : '' }}"
            placeholder="{{ $content['placeholder'] }}"
            autocomplete="email"
            required
            maxlength="190"
            class="newsletter-input"
            @if ($error) aria-invalid="true" aria-describedby="newsletter-error" @endif
        >
        <button type="submit" class="newsletter-button">{{ $content['button'] }}</button>
    </div>

    @if ($error)
        <p id="newsletter-error" class="field-error">{{ $error }}</p>
    @endif
</form>
