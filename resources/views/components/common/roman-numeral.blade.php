{{--
    common/roman-numeral: italic gold Roman numeral.
    <x-common.roman-numeral :value="3" suffix="." />   renders "III."
--}}
@props(['value', 'suffix' => ''])

<span {{ $attributes->class('roman') }}>{{ \App\Support\Markup::roman((int) $value) }}{{ $suffix }}</span>
