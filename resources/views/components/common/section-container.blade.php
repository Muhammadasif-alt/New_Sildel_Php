{{--
    common/section-container: centred 1360px max-width wrapper with responsive gutters (16px / 28px).
    <x-common.section-container class="grid gap-10"> ... </x-common.section-container>
--}}
@props(['as' => 'div'])

<{{ $as }} {{ $attributes->class('site-container') }}>{{ $slot }}</{{ $as }}>
