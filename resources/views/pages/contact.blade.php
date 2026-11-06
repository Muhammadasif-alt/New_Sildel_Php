{{-- Contact: how to reach the atelier, the enquiry form (subject pre-filled from ?subject=) and a few answers. --}}
@php
    $info = $page['info'];
    $contact = $site->contact;
    $subject = request()->query('subject');
@endphp

<x-layouts.site :title="$page['seo']['title']" :description="$page['seo']['description']" :preloader="false">
    <x-common.page-hero
        :kicker="$page['hero']['kicker']"
        :title="$page['hero']['title']"
        :intro="$page['hero']['intro']"
        :breadcrumbs="[[$page['hero']['kicker'], url()->current()]]"
    />

    <section id="atelier" class="bg-paper pb-[clamp(100px,12vw,170px)] text-ink" aria-labelledby="atelier-title">
        <x-common.section-container class="grid items-start gap-[clamp(44px,6vw,90px)] border-t border-line-light pt-[clamp(56px,6vw,90px)] lg:grid-cols-[0.85fr_1.15fr]">
            <div>
                <x-common.kicker tone="bronze">{{ $info['kicker'] }}</x-common.kicker>
                <p class="mt-6 max-w-[460px] text-ink-soft">{{ $info['text'] }}</p>

                <dl class="contact-list mt-10">
                    <div>
                        <dt>{{ $contact->labels['phone'] }}</dt>
                        <dd>
                            @foreach ($info['phones'] as $phone)
                                <a href="{{ $phone['href'] }}" class="block">{{ $phone['label'] }}</a>
                            @endforeach
                            <span class="contact-note">{{ $info['phone_note'] }}. {{ $info['phone_cost'] }}</span>
                        </dd>
                    </div>
                    <div>
                        <dt>{{ $contact->labels['email'] }}</dt>
                        <dd><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></dd>
                    </div>
                    <div>
                        <dt>{{ $contact->labels['address'] }}</dt>
                        <dd>
                            {{ $contact->street }}<br>{{ $contact->cityLine() }}
                            <a href="{{ $contact->mapUrl() }}" class="text-link mt-4 text-ink" target="_blank" rel="noopener">{{ $info['map_label'] }}</a>
                        </dd>
                    </div>
                    <div>
                        <dt>{{ $info['hours_label'] }}</dt>
                        <dd>
                            @foreach ($info['hours'] as $line)
                                <span class="block">{{ $line }}</span>
                            @endforeach
                            <span class="contact-note">{{ $info['visit'] }}</span>
                        </dd>
                    </div>
                </dl>
            </div>

            <div>
                <x-common.kicker tone="bronze">{{ $page['form']['kicker'] }}</x-common.kicker>
                <x-common.mask-heading :lines="$page['form']['title']" id="atelier-title" class="mt-[22px] mb-10 [&_em]:text-bronze" />
                <x-sections.home.enquiry-form :labels="$atelier['form']" :subject="is_string($subject) ? \Illuminate\Support\Str::limit($subject, 180, '') : null" />
            </div>
        </x-common.section-container>
    </section>

    <section class="bg-bone py-[clamp(100px,12vw,160px)] text-ink" aria-labelledby="faq-title">
        <x-common.section-container class="grid gap-[clamp(40px,6vw,96px)] md:grid-cols-[0.8fr_1.2fr]">
            <div>
                <x-common.kicker tone="bronze">{{ $page['faq']['kicker'] }}</x-common.kicker>
                <x-common.mask-heading :lines="$page['faq']['title']" id="faq-title" class="mt-[22px] mb-10 [&_em]:text-bronze" />
                <x-ui.text-link :href="$page['faq']['cta']['url']" class="text-ink">{{ $page['faq']['cta']['label'] }}</x-ui.text-link>
            </div>
            <x-common.accordion :items="$questions" />
        </x-common.section-container>
    </section>
</x-layouts.site>
