{{--
    sections/home/enquiry-form: floating-label enquiry form in a framed walnut panel.
    Posts to /enquiry (validation, honeypot, 5/min rate limit, CSRF). Errors use the "enquiry"
    bag and old input is restored; success is shown as a toast.

    labels: name, email, subject, message, submit, sending
    subject: optional pre-filled subject (e.g. the piece a visitor is enquiring about)
--}}
@props(['labels', 'subject' => null])

@php
    $bag = $errors->enquiry;
    // Only restore old input for this form, never values posted by the newsletter form.
    $old = fn (string $key) => $bag->any() ? old($key) : null;
@endphp

<form
    method="POST"
    action="{{ route('enquiry.store') }}"
    {{ $attributes->class('enquiry-panel grid content-start gap-x-[34px] gap-y-[42px] px-7 py-10 md:grid-cols-2 md:p-[60px]') }}
    data-form
    novalidate
>
    @csrf
    <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
    <div class="hp-field" aria-hidden="true">
        <label for="enquiry-company-website">Company website</label>
        <input type="text" id="enquiry-company-website" name="{{ \App\Http\Middleware\RejectHoneypot::FIELD }}" tabindex="-1" autocomplete="off">
    </div>

    <x-ui.field name="name" :label="$labels['name']" id-prefix="enquiry-" :value="$old('name')" :error="$bag->first('name')" autocomplete="name" maxlength="120" required />
    <x-ui.field name="email" type="email" :label="$labels['email']" id-prefix="enquiry-" :value="$old('email')" :error="$bag->first('email')" autocomplete="email" maxlength="190" required />
    <x-ui.field name="subject" :label="$labels['subject']" id-prefix="enquiry-" :value="$old('subject') ?? $subject" :error="$bag->first('subject')" maxlength="190" field-class="md:col-span-2" />
    <x-ui.field name="message" as="textarea" :label="$labels['message']" id-prefix="enquiry-" :value="$old('message')" :error="$bag->first('message')" maxlength="3000" required field-class="md:col-span-2" />

    <div class="justify-self-start md:col-span-2">
        <x-ui.button variant="ink" type="submit" arrow data-sending-label="{{ $labels['sending'] }}">{{ $labels['submit'] }}</x-ui.button>
    </div>
</form>
