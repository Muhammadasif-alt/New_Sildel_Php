{{-- ui/label: floating label used by ui/field. Must follow its control in the DOM. --}}
@props(['for'])

<label for="{{ $for }}" {{ $attributes->class('field-label') }}>{{ $slot }}</label>
