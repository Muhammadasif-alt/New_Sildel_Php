{{--
    ui/text-link: uppercase link with an underline that retracts on hover.
    <x-ui.text-link href="/our-story">Our Story</x-ui.text-link>
--}}
@props(['href'])

<a href="{{ $href }}" {{ $attributes->class('text-link') }}>{{ $slot }}</a>
