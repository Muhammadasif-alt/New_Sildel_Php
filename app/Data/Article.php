<?php

namespace App\Data;

use Illuminate\Support\Carbon;

final readonly class Article
{
    public function __construct(
        public string $title,
        public string $excerpt,
        public string $topic,
        public Carbon $date,
        public ?string $image,
        public string $imageAlt,
        public string $url,
        public string $slug = '',
        public ?string $body = null,
    ) {}

    /** @param array{title: string, excerpt: string, topic: string, date: string, image?: ?string, image_alt?: string, url: string, slug?: string, body?: ?string} $data */
    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            excerpt: $data['excerpt'],
            topic: $data['topic'],
            date: Carbon::parse($data['date']),
            image: $data['image'] ?? null,
            imageAlt: $data['image_alt'] ?? '',
            url: $data['url'],
            slug: $data['slug'] ?? '',
            body: $data['body'] ?? null,
        );
    }

    /** Estimated reading time in minutes (220 words a minute). */
    public function readingMinutes(): int
    {
        return max(1, (int) round(str_word_count(strip_tags((string) $this->body)) / 220));
    }
}
