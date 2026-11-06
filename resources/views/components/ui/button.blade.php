{{--
    ui/button
    Renders <a> when href is given, otherwise <button>.
    variant: gold (default) | ghost (outlined gold) | ink (onyx) | outline (ink pill, light surfaces)
    arrow:   adds a drawn arrow after the label

    <x-ui.button href="/treasures">Explore Treasures</x-ui.button>
    <x-ui.button variant="ghost" type="submit">Send</x-ui.button>
    <x-ui.button variant="ink" href="/you-think-cork" arrow>Discover More</x-ui.button>
--}}
@props([
    'variant' => 'gold',
    'href' => null,
    'type' => 'button',
    'arrow' => false,
])

@php
    $classes = 'btn btn-'.(in_array($variant, ['gold', 'ghost', 'ink', 'outline'], true) ? $variant : 'gold');
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>{{ $slot }}@if ($arrow)<span class="btn-arrow" aria-hidden="true"></span>@endif</a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>{{ $slot }}@if ($arrow)<span class="btn-arrow" aria-hidden="true"></span>@endif</button>
@endif
