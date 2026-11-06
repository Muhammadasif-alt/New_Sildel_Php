{{--
    layout/mobile-menu: full-screen sheet with large serif links, contact line and language switch.
--}}
@props(['site', 'id' => 'mobile-menu'])

<x-ui.sheet :id="$id" :label="$site->ui('menu_open')" class="lg:hidden">
    <nav aria-label="{{ $site->name }}">
        <ul role="list">
            @foreach ($site->navMobile as $item)
                <li class="sheet-item" style="--i: {{ $loop->index }}">
                    <a href="{{ $item->url }}" class="sheet-link" @if ($site->isCurrent($item->url)) aria-current="page" @endif data-sheet-close>{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
    </nav>

    <div class="sheet-item mt-12 flex flex-wrap items-center justify-between gap-6 border-t border-line pt-8" style="--i: {{ count($site->navMobile) }}">
        <a href="mailto:{{ $site->contact->email }}" class="caps text-mute-light hover:text-gold">{{ $site->contact->email }}</a>
        <x-layout.language-switch :site="$site" />
    </div>
</x-ui.sheet>
