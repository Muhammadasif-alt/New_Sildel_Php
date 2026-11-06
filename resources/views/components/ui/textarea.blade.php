{{-- ui/textarea: underline textarea, pairs with ui/label like ui/input. --}}
@props(['name', 'id' => null, 'value' => null, 'invalid' => false, 'rows' => 4])

<textarea
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    rows="{{ $rows }}"
    placeholder=" "
    @if ($invalid) aria-invalid="true" @endif
    {{ $attributes->class('field-control') }}
>{{ $value }}</textarea>
