<?php

namespace App\Data;

final readonly class NavItem
{
    public function __construct(
        public string $label,
        public string $url,
    ) {}

    /** @param array{label: string, url: string} $data */
    public static function fromArray(array $data): self
    {
        return new self($data['label'], $data['url']);
    }

    public function isExternal(): bool
    {
        $host = parse_url($this->url, PHP_URL_HOST);

        if (! is_string($host)) {
            return false;
        }

        // Our own hosts: APP_URL, the host serving this request (localhost vs 127.0.0.1 locally) and the live domain.
        $own = array_filter([
            parse_url((string) config('app.url'), PHP_URL_HOST),
            app()->runningInConsole() ? null : request()->getHost(),
            'sildel.pt',
            'www.sildel.pt',
        ]);

        return ! in_array(strtolower($host), array_map('strtolower', $own), true);
    }
}
