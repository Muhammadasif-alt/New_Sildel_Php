{{--
    layout/language-switch: "EN  PT", each with a small flag (public/images/sildel/flags/{code}.svg).
    The current locale is highlighted; others link to their URL.
--}}
@props(['site'])

<div {{ $attributes->class('lang') }} role="group" aria-label="{{ $site->ui('language') }}">
    @foreach ($site->locales as $code => $locale)
        @if ($code === $site->locale)
            <span class="lang-item" aria-current="true">
                <img class="lang-flag" src="{{ asset('images/sildel/flags/'.$code.'.svg') }}" alt="" width="21" height="14">{{ $locale['label'] }}
            </span>
        @else
            <a class="lang-item" href="{{ $site->alternateUrls[$code] }}" hreflang="{{ $locale['hreflang'] }}" lang="{{ $locale['hreflang'] }}">
                <img class="lang-flag" src="{{ asset('images/sildel/flags/'.$code.'.svg') }}" alt="" width="21" height="14">{{ $locale['label'] }}
            </a>
        @endif
    @endforeach
</div>
