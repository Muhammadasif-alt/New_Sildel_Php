{{--
    common/mask-heading: heading whose lines slide up from a mask, staggered, when scrolled into view.
    Lines are plain text; *word* becomes gold italic emphasis (see App\Support\Markup).

    <x-common.mask-heading :lines="['Fine Arts,', '*curated treasures*']" as="h2" class="mt-6" />

    size: Tailwind text-size class (defaults to the h2 token); pass size="" to size via class instead.
--}}
@props([
    'lines' => [],
    'as' => 'h2',
    'size' => 'text-h2',
])

@php
    $tag = in_array($as, ['h1', 'h2', 'h3'], true) ? $as : 'h2';
@endphp

<{{ $tag }} data-mask {{ $attributes->class($size) }}>
    @foreach ($lines as $line)
        <span class="mask-line" style="--line: {{ $loop->index }}"><span>{{ \App\Support\Markup::inline($line) }}</span></span>
    @endforeach
</{{ $tag }}>
