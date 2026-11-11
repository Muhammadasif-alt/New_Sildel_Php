<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_renders_every_section_from_config(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('<title>Sildel | We Think Cork</title>', false)
            ->assertSee('Maison of Cork Art')
            ->assertSeeText('We do not sell products. We create treasures.')
            ->assertSee('Shale Coast')
            ->assertSee('We do not kill trees,')
            ->assertSee('Years Between Harvests')
            ->assertSee('l2P1x5BsNg4')
            ->assertSee('The Harvest')
            ->assertSee('Designed for interiors')
            ->assertSee('Send Enquiry')
            ->assertSee('Rua das Ruivas, 108');
    }

    public function test_home_page_has_seo_tags_and_structured_data(): void
    {
        $this->get('/')
            ->assertSee('<link rel="canonical"', false)
            ->assertSee('hreflang="pt-PT"', false)
            ->assertSee('hreflang="x-default"', false)
            ->assertSee('property="og:image"', false)
            ->assertSee('"@type":"Organization"', false)
            ->assertSee('"addressLocality":"Esmoriz"', false);
    }

    public function test_portuguese_route_is_served_with_portuguese_language(): void
    {
        $this->get('/pt')
            ->assertOk()
            ->assertSee('<html lang="pt-PT"', false)
            ->assertSee('Abrir menu');
    }

    public function test_unknown_locale_is_not_found(): void
    {
        $this->get('/fr')->assertNotFound();
    }

    public function test_sitemap_lists_both_locales_with_alternates(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee('<loc>'.url('/').'</loc>', false)
            ->assertSee('<loc>'.url('/pt').'</loc>', false);
    }

    public function test_every_piece_says_what_it_is_in_both_languages(): void
    {
        foreach (config('treasures.products') as $product) {
            $slug = $product['slug'];

            $this->assertArrayHasKey($product['type'] ?? '', config('treasures.types.en'), "$slug has no known type");
            $this->assertArrayHasKey($product['type'], config('treasures.types.pt'), "$slug type has no Portuguese label");
            $this->assertNotEmpty($product['summary'] ?? '', "$slug has no summary");
            $this->assertNotEmpty(config("treasures.translations.pt.products.$slug.summary"), "$slug has no Portuguese summary");
        }
    }

    public function test_cards_and_product_page_show_the_type_of_piece(): void
    {
        $this->get('/')
            ->assertSee('Table lamp')
            ->assertSee('Coffee table')
            ->assertSee('We make lamps, tables, mirrors and sculptural pieces by hand from genuine cork.');

        $this->get('/treasures')->assertOk()->assertSee('Pendant light')->assertSee('Candle holder');

        $this->get('/treasures/hot-spring')
            ->assertOk()
            ->assertSee('Table lamp')
            ->assertSee('A table lamp, 54 cm tall')
            ->assertSee('Price on request');

        $this->get('/pt/treasures/hot-spring')
            ->assertOk()
            ->assertSee('Candeeiro de mesa')
            ->assertSee('Preço sob consulta');
    }

    public function test_robots_txt_is_served(): void
    {
        $this->get('/robots.txt')->assertOk()->assertSee('User-agent: *');
    }
}
