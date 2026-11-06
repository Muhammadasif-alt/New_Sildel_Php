<?php

namespace App\Data;

final readonly class ContactInfo
{
    /** @param array{phone: string, email: string, address: string} $labels */
    public function __construct(
        public string $phone,
        public string $phoneHref,
        public string $email,
        public string $street,
        public string $postalCode,
        public string $locality,
        public string $country,
        public string $countryCode,
        public float $latitude,
        public float $longitude,
        public array $labels,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     * @param  array{phone: string, email: string, address: string}  $labels
     */
    public static function fromArray(array $data, array $labels): self
    {
        return new self(
            phone: $data['phone'],
            phoneHref: $data['phone_href'],
            email: $data['email'],
            street: $data['street'],
            postalCode: $data['postal_code'],
            locality: $data['locality'],
            country: $data['country'],
            countryCode: $data['country_code'],
            latitude: (float) $data['geo']['lat'],
            longitude: (float) $data['geo']['lng'],
            labels: $labels,
        );
    }

    public function cityLine(): string
    {
        return "{$this->postalCode} {$this->locality}, {$this->country}";
    }

    /** Google Maps search for the atelier address. */
    public function mapUrl(): string
    {
        return 'https://www.google.com/maps/search/?api=1&query='.rawurlencode("{$this->street}, {$this->postalCode} {$this->locality}, {$this->country}");
    }
}
