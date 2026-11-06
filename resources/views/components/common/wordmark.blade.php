{{--
    common/wordmark: the typographic "S I L D E L / We Think Cork" signature in Italiana.
    <x-common.wordmark :name="$site->name" :tagline="$site->tagline" class="text-left" />
--}}
@props(['name', 'tagline'])

<span {{ $attributes->class('brand pl-0') }}>{{ mb_strtoupper($name) }}<small>{{ $tagline }}</small></span>
