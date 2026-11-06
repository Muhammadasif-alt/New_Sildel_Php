{{--
    common/kicker: gold uppercase label with hairlines.
    lines: left (default) | both    align: left (default) | center    tone: gold (default) | bronze (for light surfaces)

    <x-common.kicker lines="both" align="center">From Forest to Home</x-common.kicker>
--}}
@props([
    'lines' => 'left',
    'align' => 'left',
    'tone' => 'gold',
])

<span {{ $attributes->class([
    'kicker',
    'justify-center' => $align === 'center',
])->style(['--kicker-color: var(--color-bronze-ink)' => $tone === 'bronze']) }}>
    <i class="kicker-line" aria-hidden="true"></i>
    <span>{{ $slot }}</span>
    @if ($lines === 'both')
        <i class="kicker-line" aria-hidden="true"></i>
    @endif
</span>
