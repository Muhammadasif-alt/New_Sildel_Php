{{--
    common/reveal: fades and lifts its content in when scrolled into view.
    delay: seconds    y: starting offset in px    as: wrapper tag

    <x-common.reveal :delay="0.1"> ... </x-common.reveal>
--}}
@props([
    'delay' => 0,
    'y' => 34,
    'as' => 'div',
])

<{{ $as }} data-reveal {{ $attributes->style([
    "--reveal-delay: {$delay}s" => $delay > 0,
    "--reveal-y: {$y}px" => (int) $y !== 34,
]) }}>{{ $slot }}</{{ $as }}>
