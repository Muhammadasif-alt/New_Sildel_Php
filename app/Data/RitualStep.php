<?php

namespace App\Data;

final readonly class RitualStep
{
    public function __construct(
        public int $numeral,
        public string $title,
        public string $text,
        public ?string $image,
        public string $imageAlt,
    ) {}

    /** @param array{numeral: int, title: string, text: string, image?: ?string, image_alt?: string} $data */
    public static function fromArray(array $data): self
    {
        return new self(
            numeral: $data['numeral'],
            title: $data['title'],
            text: $data['text'],
            image: $data['image'] ?? null,
            imageAlt: $data['image_alt'] ?? '',
        );
    }
}
