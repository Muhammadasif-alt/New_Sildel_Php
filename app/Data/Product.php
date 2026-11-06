<?php

namespace App\Data;

/**
 * A piece of the Treasures catalogue (config/treasures.php).
 * Cards use $name, $subtitle, $tag and $image; the product page uses everything.
 */
final readonly class Product
{
    /**
     * @param  list<string>  $description
     * @param  list<string>  $measures
     * @param  list<array{title: string, lines: list<string>}>  $care
     * @param  list<array{src: string, thumb: string}>  $gallery
     */
    public function __construct(
        public string $name,
        public string $slug,
        public string $subtitle,
        public ?string $tag,
        public ?string $image,
        public string $url,
        public string $tagTone = 'gold',
        public string $category = '',
        public string $categoryLabel = '',
        public ?string $family = null,
        public ?string $lead = null,
        public bool $exclusive = false,
        public bool $origin = false,
        public array $description = [],
        public array $measures = [],
        public ?string $weight = null,
        public ?string $includes = null,
        public ?string $variants = null,
        public array $care = [],
        public array $gallery = [],
        public ?string $darkImage = null,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            slug: $data['slug'],
            subtitle: $data['subtitle'] ?? $data['material'] ?? '',
            tag: $data['tag'] ?? null,
            image: $data['image'] ?? null,
            url: $data['url'],
            tagTone: $data['tag_tone'] ?? 'gold',
            category: $data['category'] ?? '',
            categoryLabel: $data['category_label'] ?? '',
            family: $data['family'] ?? null,
            lead: $data['lead'] ?? null,
            exclusive: (bool) ($data['exclusive'] ?? false),
            origin: (bool) ($data['origin'] ?? false),
            description: $data['description'] ?? [],
            measures: $data['measures'] ?? [],
            weight: $data['weight'] ?? null,
            includes: $data['includes'] ?? null,
            variants: $data['variants'] ?? null,
            care: $data['care'] ?? [],
            gallery: $data['gallery'] ?? [],
            darkImage: $data['dark_image'] ?? null,
        );
    }

    /** The photo for the velvet-black home collection, falling back to the white card. */
    public function galleryImage(): ?string
    {
        return $this->darkImage ?? $this->image;
    }
}
