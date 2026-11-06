<?php

namespace App\Data;

final readonly class Stat
{
    /**
     * A figure is either animated ($value, counted up from 0) or static text ($display, e.g. "PT").
     */
    public function __construct(
        public string $label,
        public ?int $value = null,
        public string $suffix = '',
        public ?string $display = null,
        public ?string $text = null,
    ) {}

    /** @param array{label: string, value?: ?int, suffix?: string, display?: ?string, text?: ?string} $data */
    public static function fromArray(array $data): self
    {
        return new self(
            label: $data['label'],
            value: $data['value'] ?? null,
            suffix: $data['suffix'] ?? '',
            display: $data['display'] ?? null,
            text: $data['text'] ?? null,
        );
    }

    public function isCounter(): bool
    {
        return $this->value !== null;
    }
}
