{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach ($entries as $entry)
@foreach ($entry['urls'] as $locale => $url)
    <url>
        <loc>{{ $url }}</loc>
        <lastmod>{{ $lastModified->toDateString() }}</lastmod>
        <priority>{{ $locale === $defaultLocale ? $entry['priority'] : number_format(max(0.1, (float) $entry['priority'] - 0.2), 1) }}</priority>
@foreach ($entry['urls'] as $altLocale => $altUrl)
        <xhtml:link rel="alternate" hreflang="{{ $locales[$altLocale]['hreflang'] }}" href="{{ $altUrl }}" />
@endforeach
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $entry['urls'][$defaultLocale] }}" />
    </url>
@endforeach
@endforeach
</urlset>
