{{--
    common/accordion: list of questions that open and close (native <details>, so it works without
    JavaScript and with the keyboard). Pass items, or compose <x-common.accordion-item>s in the slot.

    items: list of ['q' => question, 'a' => answer, 'link' => ['label', 'url'] (optional)]
    tone:  light (default) | dark
    open:  index of the item open on load (null = all closed)

    <x-common.accordion :items="$page['faq']" />
--}}
@props(['items' => [], 'tone' => 'light', 'open' => null])

<div {{ $attributes->class(['accordion', 'accordion-dark' => $tone === 'dark']) }}>
    @foreach ($items as $item)
        <x-common.accordion-item :question="$item['q']" :open="$open === $loop->index">
            <p>{{ $item['a'] }}</p>
            @if (! empty($item['link']))
                <p class="mt-4"><x-ui.text-link :href="$item['link']['url']">{{ $item['link']['label'] }}</x-ui.text-link></p>
            @endif
        </x-common.accordion-item>
    @endforeach
    {{ $slot }}
</div>
