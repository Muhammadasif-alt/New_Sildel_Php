{{--
    common/marquee: endless italic serif strip separated by gold stars.
    The list is rendered twice so the loop is seamless; the copy is hidden from screen readers.
    Static (no scroll) with reduced motion.

    <x-common.marquee :items="['Fine Arts', 'Genuine Cork']" />
--}}
@props(['items' => [], 'duration' => 52])

<div {{ $attributes->class('marquee') }} style="--marquee-duration: {{ (int) $duration }}s">
    <div class="marquee-track">
        @foreach ([false, true] as $copy)
            <ul class="marquee-list" role="list" @if ($copy) aria-hidden="true" @endif>
                @foreach ($items as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        @endforeach
    </div>
</div>
