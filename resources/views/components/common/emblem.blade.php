{{--
    common/emblem: the Sildel lynx, tinted with the current text colour. Site-wide it is white (text-bone).
    <x-common.emblem class="size-10 text-gold" />
--}}
@props(['src' => null])

<span
    {{ $attributes->class('emblem')->style('--emblem: url('.e($src ?? asset(config('sildel.images.emblem'))).')') }}
    aria-hidden="true"
></span>
