{{--
    layout/header: fixed frosted dark bar (resources/js/modules/header.js adds .is-solid after
    scrolling, which compacts it). The official logo sits on the left, clearly legible;
    navigation is centred and the language switch sits on the right. Below 1100px the
    navigation moves into layout/mobile-menu behind the burger.
--}}
@props(['site', 'menuId' => 'mobile-menu'])

<header class="site-header" data-header>
    <nav class="site-container grid grid-cols-[auto_1fr_auto] items-center gap-8" aria-label="{{ $site->name }}">
        <a href="{{ $site->homeUrl() }}" class="text-bone transition-opacity duration-500 hover:opacity-75">
            <x-common.logo :label="$site->name.', '.$site->tagline" class="site-logo" />
        </a>

        <ul class="hidden justify-center gap-[clamp(28px,3vw,48px)] lg:flex" role="list">
            @foreach ([...$site->navLeft, ...$site->navRight] as $item)
                <li><a href="{{ $item->url }}" class="nav-link" @if ($site->isCurrent($item->url)) aria-current="page" @endif>{{ $item->label }}</a></li>
            @endforeach
        </ul>

        <div class="col-start-3 flex items-center justify-end gap-[34px]">
            <x-layout.language-switch :site="$site" class="hidden lg:block" />

            <button
                type="button"
                class="burger lg:hidden"
                aria-controls="{{ $menuId }}"
                aria-expanded="false"
                aria-label="{{ $site->ui('menu_open') }}"
                data-sheet-trigger="{{ $menuId }}"
                data-label-open="{{ $site->ui('menu_open') }}"
                data-label-close="{{ $site->ui('menu_close') }}"
            >
                <span></span><span></span>
            </button>
        </div>
    </nav>
</header>
