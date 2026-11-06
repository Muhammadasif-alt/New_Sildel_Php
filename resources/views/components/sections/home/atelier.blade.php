{{--
    sections/home/atelier: warm dark section with contact details beside the enquiry form (light paper card).

    content keys: id, kicker, title (lines), intro, form (labels)
    contact: App\Data\ContactInfo
--}}
@props(['content', 'contact', 'subject' => null])

@php
    /** @var \App\Data\ContactInfo $contact */
    $rows = [
        ['label' => $contact->labels['phone'], 'href' => $contact->phoneHref, 'value' => $contact->phone],
        ['label' => $contact->labels['email'], 'href' => 'mailto:'.$contact->email, 'value' => $contact->email],
        ['label' => $contact->labels['address'], 'href' => null, 'value' => $contact->street."\n".$contact->cityLine()],
    ];
@endphp

<section id="{{ $content['id'] }}" class="border-b border-line bg-truffle py-[clamp(110px,12vw,170px)] text-bone" aria-labelledby="{{ $content['id'] }}-title">
    <x-common.section-container class="grid items-center gap-[clamp(50px,8vw,120px)] md:grid-cols-[1fr_1.15fr]">
        <div>
            <x-common.kicker>{{ $content['kicker'] }}</x-common.kicker>
            <x-common.mask-heading :lines="$content['title']" id="{{ $content['id'] }}-title" class="mt-6 mb-[30px]" />
            <p class="max-w-[430px] text-mute-light">{{ $content['intro'] }}</p>

            <address class="mt-14 not-italic">
                <dl>
                    @foreach ($rows as $row)
                        <div class="grid gap-1 border-t border-line py-[22px] last:border-b sm:grid-cols-[120px_1fr] sm:gap-0">
                            <dt class="caps pt-1.5 text-[0.6rem] tracking-[0.34em] text-mute-light">{{ $row['label'] }}</dt>
                            <dd class="font-serif text-[1.35rem] leading-[1.4]">
                                @if ($row['href'])
                                    <a href="{{ $row['href'] }}" class="transition-colors duration-300 hover:text-gold">{{ $row['value'] }}</a>
                                @else
                                    {!! nl2br(e($row['value']), false) !!}
                                @endif
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </address>
        </div>

        <x-common.reveal>
            <x-sections.home.enquiry-form :labels="$content['form']" :subject="$subject" />
        </x-common.reveal>
    </x-common.section-container>
</section>
