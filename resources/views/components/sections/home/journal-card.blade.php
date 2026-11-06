{{--
    sections/home/journal-card: article teaser. The whole card is one link; the image zooms
    slowly on hover and the "Read Article" arrow extends.

    <x-sections.home.journal-card :article="$article" read-label="Read Article" />
--}}
@props(['article', 'readLabel' => 'Read Article'])

<a href="{{ $article->url }}" {{ $attributes->class('journal-card group') }}>
    <div class="journal-media">
        <x-common.cork-image :src="$article->image" :alt="$article->imageAlt" class="size-full" sizes="(min-width: 900px) 30vw, 100vw" />
    </div>
    <p class="journal-meta">
        <span>{{ $article->topic }}</span>
        <i aria-hidden="true"></i>
        <time datetime="{{ $article->date->toDateString() }}">{{ $article->date->translatedFormat('j M Y') }}</time>
    </p>
    <h3 class="journal-title">{{ $article->title }}</h3>
    <p class="journal-excerpt">{{ $article->excerpt }}</p>
    <span class="journal-read">{{ $readLabel }}<span class="btn-arrow" aria-hidden="true"></span></span>
</a>
