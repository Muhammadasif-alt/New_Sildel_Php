{{--
    common/social-icon: brand glyph for a social network (inherits the current text colour).
    name: facebook | instagram | linkedin   (anything else falls back to a link icon)

    <x-common.social-icon name="instagram" class="size-[18px]" />
--}}
@props(['name'])

<svg viewBox="0 0 24 24" {{ $attributes->merge(['width' => 18, 'height' => 18]) }} aria-hidden="true" focusable="false">
    @switch($name)
        @case('facebook')
            <path fill="currentColor" d="M14 8h3V4h-3c-2.8 0-4.5 1.8-4.5 4.6V11H7v4h2.5v9h4v-9h3l.5-4h-3.5V8.9c0-.6.3-.9.9-.9Z" />
            @break
        @case('instagram')
            <rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="1.6" />
            <circle cx="12" cy="12" r="4.1" fill="none" stroke="currentColor" stroke-width="1.6" />
            <circle cx="17.4" cy="6.6" r="1.1" fill="currentColor" />
            @break
        @case('linkedin')
            <path fill="currentColor" d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3 9h4v12H3V9Zm6 0h3.8v1.7h.05c.53-1 1.83-2.05 3.77-2.05 4.03 0 4.78 2.65 4.78 6.1V21h-4v-5.6c0-1.34-.03-3.06-1.86-3.06-1.87 0-2.15 1.46-2.15 2.96V21H9V9Z" />
            @break
        @default
            <path fill="none" stroke="currentColor" stroke-width="1.6" d="M10 14a4 4 0 0 0 5.66 0l3-3a4 4 0 0 0-5.66-5.66l-1 1M14 10a4 4 0 0 0-5.66 0l-3 3a4 4 0 0 0 5.66 5.66l1-1" />
    @endswitch
</svg>
