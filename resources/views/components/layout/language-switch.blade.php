{{--
    layout/language-switch: "EN / PT". The current locale is highlighted; others link to their URL.
--}}
@props(['site'])

<div {{ $attributes->class('lang') }} role="group" aria-label="{{ $site->ui('language') }}">
    @foreach ($site->locales as $code => $locale)
        @if ($code === $site->locale)
            <span aria-current="true">{{ $locale['label'] }}</span>
        @else
            <a href="{{ $site->alternateUrls[$code] }}" hreflang="{{ $locale['hreflang'] }}" lang="{{ $locale['hreflang'] }}">{{ $locale['label'] }}</a>
        @endif
        @unless ($loop->last)
            <span aria-hidden="true">&nbsp;/&nbsp;</span>
        @endunless
    @endforeach
</div>
