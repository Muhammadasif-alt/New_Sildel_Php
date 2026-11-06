{{--
    common/counter: number that counts up from 0 (ease-out) when scrolled into view.
    The final value is rendered server-side, so it is correct without JS and for reduced motion.

    <x-common.counter :to="100" suffix="%" />
--}}
@props(['to', 'suffix' => '', 'duration' => 1800])

<span {{ $attributes }}><span data-counter data-to="{{ (int) $to }}" data-duration="{{ (int) $duration }}">{{ (int) $to }}</span>{{ $suffix }}</span>
