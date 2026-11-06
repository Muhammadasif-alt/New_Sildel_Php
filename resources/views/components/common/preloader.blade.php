{{--
    common/preloader: letter-by-letter wordmark intro with a gold progress line.
    Shown once per browser session (sessionStorage) and never with reduced motion:
    the inline script in the layout <head> adds .no-preloader before first paint.
--}}
@props(['word' => 'SILDEL'])

<div class="loader" data-preloader aria-hidden="true">
    <div class="loader-inner">
        <x-common.emblem class="loader-emblem" />
        <div class="loader-word">
            @foreach (mb_str_split($word) as $letter)
                <span style="--i: {{ $loop->index }}">{{ $letter }}</span>
            @endforeach
        </div>
    </div>
    <div class="loader-bar"></div>
</div>
