{{--
    ui/field: floating-label form field (input or textarea) with error message.

    <x-ui.field name="email" type="email" label="Email" :error="$errors->enquiry->first('email')" required />
    <x-ui.field name="message" as="textarea" label="Your Message" />

    Extra attributes (required, autocomplete, maxlength...) go to the control;
    field-class styles the wrapper (e.g. field-class="md:col-span-2").
--}}
@props([
    'name',
    'label',
    'as' => 'input',
    'type' => 'text',
    'value' => null,
    'error' => null,
    'idPrefix' => '',
    'fieldClass' => '',
])

@php
    $id = $idPrefix.$name;
    $errorId = $id.'-error';
@endphp

<div @class(['field', 'has-error' => $error, $fieldClass])>
    <div class="relative">
        @if ($as === 'textarea')
            <x-ui.textarea :name="$name" :id="$id" :value="$value" :invalid="(bool) $error" :attributes="$attributes->merge($error ? ['aria-describedby' => $errorId] : [])" />
        @else
            <x-ui.input :name="$name" :id="$id" :type="$type" :value="$value" :invalid="(bool) $error" :attributes="$attributes->merge($error ? ['aria-describedby' => $errorId] : [])" />
        @endif
        <x-ui.label :for="$id">{{ $label }}</x-ui.label>
        <span class="field-line" aria-hidden="true"></span>
    </div>

    @if ($error)
        <p id="{{ $errorId }}" class="field-error">{{ $error }}</p>
    @endif
</div>
