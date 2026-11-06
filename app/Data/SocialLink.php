<?php

namespace App\Data;

final readonly class SocialLink
{
    public function __construct(
        public string $label,
        public string $short,
        public string $url,
        public string $icon = '',
    ) {}

    /** @param array{label: string, short: string, url: string, icon?: string} $data */
    public static function fromArray(array $data): self
    {
        return new self($data['label'], $data['short'], $data['url'], $data['icon'] ?? '');
    }
}
