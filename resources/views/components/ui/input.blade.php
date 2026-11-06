{{--
    ui/input: underline input. placeholder=" " is required by the floating label
    (:placeholder-shown detects an empty field).
--}}
@props(['name', 'id' => null, 'type' => 'text', 'value' => null, 'invalid' => false])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    value="{{ $value }}"
    placeholder=" "
    @if ($invalid) aria-invalid="true" @endif
    {{ $attributes->class('field-control') }}
>
