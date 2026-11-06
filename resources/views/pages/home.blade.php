{{-- Home: composes the sections only. All content comes from HomeController (config/sildel.php). --}}
<x-layouts.site>
    <x-sections.home.hero :content="$hero" />
    <x-common.marquee :items="$marquee" />
    <x-sections.home.statement :content="$statement" />
    <x-sections.home.collection :content="$collection" :products="$products" :ui="$site->ui" />
    <x-sections.home.manifesto :content="$manifesto" />
    <x-sections.home.numbers :content="$numbers" :stats="$stats" />
    <x-sections.home.film :content="$film" />
    <x-sections.home.ritual :content="$ritual" />
    <x-sections.home.interiors :content="$interiors" />
    {{-- Dark alternative to the interiors section (full-bleed parallax banner):
    <x-sections.home.editorial-banner :image="$editorial['image']" :image-alt="$editorial['image_alt']"
        :kicker="$editorial['kicker']" :title-lines="$editorial['title']" :cta="$editorial['cta']" /> --}}
    <x-sections.home.journal :content="$journal" :articles="$journal['articles']" :ui="$site->ui" />
    <x-sections.home.atelier :content="$atelier" :contact="$site->contact" />
</x-layouts.site>
