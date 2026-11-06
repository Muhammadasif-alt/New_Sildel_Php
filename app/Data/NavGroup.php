<?php

namespace App\Data;

final readonly class NavGroup
{
    /** @param list<NavItem> $links */
    public function __construct(
        public string $title,
        public array $links,
    ) {}

    /** @param array{title: string, links: list<array{label: string, url: string}>} $data */
    public static function fromArray(array $data): self
    {
        return new self($data['title'], array_map(NavItem::fromArray(...), $data['links']));
    }
}
