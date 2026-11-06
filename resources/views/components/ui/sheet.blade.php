{{--
    ui/sheet: full-screen panel revealed with a clip-path wipe.
    Opened by any button with data-sheet-trigger="{id}" (see resources/js/modules/sheet.js):
    toggles aria-expanded, traps focus, closes on Escape and on link click.

    <x-ui.sheet id="mobile-menu" label="Menu"> ...links... </x-ui.sheet>
--}}
@props(['id', 'label'])

<div
    id="{{ $id }}"
    role="dialog"
    aria-modal="true"
    aria-label="{{ $label }}"
    data-sheet
    {{ $attributes->class('sheet') }}
>
    {{ $slot }}
</div>
