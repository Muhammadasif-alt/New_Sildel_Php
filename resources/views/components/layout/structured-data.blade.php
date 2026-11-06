{{--
    layout/structured-data: Organization + LocalBusiness JSON-LD built from the shared site settings.
--}}
@props(['site'])

@php
    $root = rtrim($site->alternateUrls[$site->defaultLocale], '/').'/';
    $contact = $site->contact;

    $graph = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => $root.'#organization',
                'name' => $site->name,
                'slogan' => $site->tagline,
                'url' => $root,
                'logo' => asset('icon-192.png'),
                'email' => $contact->email,
                'telephone' => $contact->phone,
                'areaServed' => 'Worldwide',
                'sameAs' => array_map(fn ($social) => $social->url, $site->socials),
            ],
            [
                '@type' => ['LocalBusiness', 'Store'],
                '@id' => $root.'#atelier',
                'name' => $site->name,
                'description' => $site->seo['description'],
                'url' => $root,
                'image' => $site->ogImage,
                'email' => $contact->email,
                'telephone' => $contact->phone,
                'areaServed' => 'Worldwide',
                'parentOrganization' => ['@id' => $root.'#organization'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $contact->street,
                    'postalCode' => $contact->postalCode,
                    'addressLocality' => $contact->locality,
                    'addressCountry' => $contact->countryCode,
                ],
                'geo' => [
                    '@type' => 'GeoCoordinates',
                    'latitude' => $contact->latitude,
                    'longitude' => $contact->longitude,
                ],
                'sameAs' => array_map(fn ($social) => $social->url, $site->socials),
            ],
        ],
    ];
@endphp

<script type="application/ld+json">{!! json_encode($graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
