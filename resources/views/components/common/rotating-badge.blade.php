{{--
    common/rotating-badge: circular text slowly rotating around a centre mark.
    The centre is the slot (falls back to the "center" prop text).

    <x-common.rotating-badge text="Handcrafted in Portugal • Genuine Cork •">S</x-common.rotating-badge>
--}}
@props(['text', 'center' => null])

@php
    $pathId = 'badge-path-'.\Illuminate\Support\Str::random(6);
@endphp

<div {{ $attributes->class('badge') }} aria-hidden="true">
    <svg viewBox="0 0 100 100" focusable="false">
        <defs>
            <path id="{{ $pathId }}" d="M50,50 m-42,0 a42,42 0 1,1 84,0 a42,42 0 1,1 -84,0" />
        </defs>
        {{-- textLength = circumference (2 x pi x 42), so any text length wraps the full circle exactly. --}}
        <text textLength="263" lengthAdjust="spacingAndGlyphs"><textPath href="#{{ $pathId }}" textLength="263" lengthAdjust="spacingAndGlyphs">{{ $text }}</textPath></text>
    </svg>
    <div class="badge-center">{{ $slot->isEmpty() ? $center : $slot }}</div>
</div>
