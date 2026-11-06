{{--
    common/logo: official horizontal Sildel logo (lynx + "Sildel / WE THINK CORK"),
    tinted with the current text colour. Size it with the --logo-h variable (width follows the
    1400:463 ratio): <x-common.logo class="text-bone" style="--logo-h: 56px" />
    Built from source-assets/brand by `npm run brand`.
--}}
@props(['label' => config('sildel.name').', '.config('sildel.tagline')])

<span
    {{ $attributes->class('emblem logo-mark')->style('--emblem: url('.e(asset('images/sildel/brand/logo-horizontal.png')).')') }}
    role="img"
    aria-label="{{ $label }}"
></span>
