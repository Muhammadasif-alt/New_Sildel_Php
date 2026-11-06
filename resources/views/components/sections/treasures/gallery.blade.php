{{--
    sections/treasures/gallery: product photographs. A large stage with the thumbnails beside it
    (below it on mobile). Thumbnails switch the stage (resources/js/modules/gallery.js); arrow keys
    move between them. Without JavaScript every photo is still reachable as a link.

    product: App\Data\Product      labels: gallery, view_photo
--}}
@props(['product', 'labels' => []])

@php
    /** @var \App\Data\Product $product */
    $photos = $product->gallery ?: [['src' => $product->image, 'thumb' => $product->image]];
@endphp

<div {{ $attributes->class('gallery') }} data-gallery role="group" aria-label="{{ str_replace(':name', $product->name, $labels['gallery'] ?? 'Photographs of :name') }}">
    <div class="gallery-stage relative aspect-[4/5] overflow-hidden">
        @foreach ($photos as $photo)
            <x-common.cork-image
                :src="$photo['src']"
                :alt="$loop->first ? $product->name.', '.$product->subtitle : ''"
                :eager="$loop->first"
                :label="$loop->first ? $product->name : null"
                sizes="(min-width: 900px) 55vw, 100vw"
                :class="Arr::toCssClasses(['gallery-slide absolute inset-0', 'is-active' => $loop->first])"
                data-gallery-slide
            />
        @endforeach
    </div>

    @if (count($photos) > 1)
        <ul class="gallery-thumbs" role="list">
            @foreach ($photos as $photo)
                <li>
                    <a
                        href="{{ asset($photo['src']) }}"
                        @class(['gallery-thumb', 'is-active' => $loop->first])
                        aria-label="{{ str_replace(':number', $loop->iteration, $labels['view_photo'] ?? 'Show photograph :number') }}"
                        @if ($loop->first) aria-current="true" @endif
                        data-gallery-thumb="{{ $loop->index }}"
                    >
                        <img src="{{ asset($photo['thumb']) }}" alt="" width="240" height="300" loading="lazy" decoding="async">
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
