{{--
    common/accordion-item: one open/close row of common/accordion. The slot is the answer.
    <x-common.accordion-item question="Does the tree survive?">...</x-common.accordion-item>
--}}
@props(['question', 'open' => false])

<details {{ $attributes->class('accordion-item') }} @if ($open) open @endif>
    <summary class="accordion-summary">
        <span>{{ $question }}</span>
        <span class="accordion-icon" aria-hidden="true"></span>
    </summary>
    <div class="accordion-panel">{{ $slot }}</div>
</details>
