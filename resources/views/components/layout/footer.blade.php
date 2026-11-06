{{--
    layout/footer: logo with about text and socials, link columns, giant outline wordmark, legal bar.
    newsletter: true adds the "Be the first to discover" signup row on top (off by client request;
    the form and /newsletter route remain available).
--}}
@props(['site', 'newsletter' => false])

<footer @class(['overflow-hidden bg-velvet', 'pt-[110px]' => $newsletter, 'pt-[40px]' => ! $newsletter])>
    <x-common.section-container>
        @if ($newsletter)
            <div id="newsletter" class="grid items-end gap-[60px] pb-[90px] md:grid-cols-2">
                <x-common.reveal as="h2" class="text-[clamp(2.2rem,4vw,3.6rem)]">
                    {{ \App\Support\Markup::inline($site->footer['newsletter']['heading']) }}
                </x-common.reveal>
                <x-common.reveal :delay="0.1">
                    <x-layout.newsletter-form :content="$site->footer['newsletter']" />
                </x-common.reveal>
            </div>
        @endif

        <div @class(['grid gap-10 py-[70px] sm:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_1fr]', 'border-t border-line' => $newsletter])>
            <div>
                <a href="{{ $site->homeUrl() }}" class="inline-block text-bone transition-opacity duration-500 hover:opacity-75">
                    <x-common.logo :label="$site->name.', '.$site->tagline" style="--logo-h: 58px" />
                </a>
                <p class="mt-[26px] max-w-[320px] text-[0.9rem] text-mute-light">{{ $site->footer['about'] }}</p>
                <ul class="mt-[30px] flex gap-3" role="list">
                    @foreach ($site->socials as $social)
                        <li>
                            <a href="{{ $social->url }}" class="social-link" aria-label="{{ $social->label }}" target="_blank" rel="noopener">
                                <x-common.social-icon :name="$social->icon" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @foreach ($site->footerNav as $group)
                <nav aria-labelledby="footer-nav-{{ $loop->index }}">
                    <h2 id="footer-nav-{{ $loop->index }}" class="footer-heading">{{ $group->title }}</h2>
                    <ul class="grid gap-[13px] text-[0.9rem] text-mute-light" role="list">
                        @foreach ($group->links as $link)
                            <li>
                                <a
                                    href="{{ $link->url }}"
                                    class="transition-colors duration-300 hover:text-bone"
                                    @if ($link->isExternal()) target="_blank" rel="noopener" @endif
                                >{{ $link->label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach
        </div>
    </x-common.section-container>

    <div class="giant-wordmark" aria-hidden="true">{{ mb_strtoupper($site->name) }}</div>

    <x-common.section-container class="flex flex-wrap justify-between gap-[14px] border-t border-line py-6 text-[0.66rem] tracking-[0.2em] text-mute uppercase">
        <span>{{ str_replace(':year', date('Y'), $site->footer['copyright']) }}</span>
        <span>{{ $site->footer['made_in'] }}</span>
    </x-common.section-container>
</footer>
