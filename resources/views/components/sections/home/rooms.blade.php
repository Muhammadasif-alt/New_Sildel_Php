{{--
    sections/home/rooms: large photographs of pieces in a real room, so a visitor sees at a glance
    what a piece is and how big it is. Two tall photos side by side, any further one full width.
    Each photo is a link to its piece, with the type, name and a short caption over the image.

    content keys: kicker, view, items[] {image, alt, caption, product: App\Data\Product}
--}}
@props(['content'])

@if (! empty($content['items']))
    <div class="rooms">
        <x-common.kicker>{{ $content['kicker'] }}</x-common.kicker>

        <ul class="rooms-grid" role="list">
            @foreach ($content['items'] as $room)
                @php
                    /** @var \App\Data\Product $product */
                    $product = $room['product'];
                    $wide = $loop->index >= 2;
                @endphp
                <x-common.reveal as="li" :delay="$wide ? 0 : $loop->index * 0.12" :y="28" :class="$wide ? 'rooms-item rooms-item-wide' : 'rooms-item'">
                    <a href="{{ $product->url }}" class="room-card group">
                        <x-common.cork-image
                            :src="$room['image']"
                            :alt="$room['alt']"
                            variant="dark"
                            :sizes="$wide ? '100vw' : '(min-width: 768px) 50vw, 100vw'"
                            class="room-media"
                        />
                        <div class="room-caption">
                            <p class="room-kind">{{ $product->kind() }}</p>
                            <p class="room-name">{{ $product->name }}</p>
                            <p class="room-text">{{ $room['caption'] }}</p>
                            <span class="room-link">
                                {{ $content['view'] }}
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" /></svg>
                            </span>
                        </div>
                    </a>
                </x-common.reveal>
            @endforeach
        </ul>
    </div>
@endif
