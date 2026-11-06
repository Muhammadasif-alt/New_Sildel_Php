<?php

/*
|--------------------------------------------------------------------------
| Sildel site content
|--------------------------------------------------------------------------
|
| Every piece of copy, link, product and image shown on the site lives here.
| Components never hardcode content: they receive it from
| App\Content\ConfigContentRepository, which reads this file. To move the
| content into a database later, add a DatabaseContentRepository and bind it
| in AppServiceProvider. No Blade component needs to change.
|
| Formatting inside headings and quotes:
|   *text*   renders as gold italic emphasis (<em>)
|   \n       renders as a line break
|
| Images are paths relative to /public. When a file is missing the
| component falls back to the CSS cork texture, so the layout never breaks.
|
*/

return [

    'name' => 'Sildel',
    'tagline' => 'We Think Cork',
    'url' => env('APP_URL', 'https://sildel.pt'),

    // Browser UI colour (mobile address bar). Matches the onyx token.
    'theme_color' => '#0d0b09',

    // Locales served by the site. The first is the default (served at "/").
    // Untranslated content falls back to the default locale.
    'locales' => [
        'en' => ['label' => 'EN', 'hreflang' => 'en', 'og' => 'en_GB'],
        'pt' => ['label' => 'PT', 'hreflang' => 'pt-PT', 'og' => 'pt_PT'],
    ],

    'contact' => [
        'phone' => '+351 911 015 388',
        'phone_href' => 'tel:+351911015388',
        'email' => 'sildel@sildel.pt',
        'street' => 'Rua das Ruivas, 108',
        'postal_code' => '3885-494',
        'locality' => 'Esmoriz',
        'country' => 'Portugal',
        'country_code' => 'PT',
        'geo' => ['lat' => 40.95823, 'lng' => -8.64808],
    ],

    // Floating WhatsApp button (bottom right). number: international format, digits only.
    // Set 'number' to '' to hide the button.
    'whatsapp' => [
        'number' => '351911015388',
        'message' => [
            'en' => 'Hello Sildel, I would like to know more about your treasures.',
            'pt' => 'Olá Sildel, gostaria de saber mais sobre os vossos tesouros.',
        ],
    ],

    // Where enquiry e-mails are delivered.
    'enquiry_recipient' => env('SILDEL_ENQUIRY_TO', 'sildel@sildel.pt'),

    // One-time web installer for hosts without a terminal (see DEPLOY.md). Leave empty to disable.
    'install_token' => env('INSTALL_TOKEN', ''),

    'socials' => [
        // icon: facebook | instagram | linkedin (see components/common/social-icon)
        ['label' => 'Facebook', 'short' => 'FB', 'icon' => 'facebook', 'url' => 'https://www.facebook.com/sildel.wethinkcork'],
        ['label' => 'Instagram', 'short' => 'IG', 'icon' => 'instagram', 'url' => 'https://www.instagram.com/sildel.wethinkcork/'],
        ['label' => 'LinkedIn', 'short' => 'IN', 'icon' => 'linkedin', 'url' => 'https://www.linkedin.com/company/sildelwethinkcork/'],
    ],

    'images' => [
        'og' => 'images/sildel/og-image.jpg',
        'emblem' => 'images/sildel/brand/lynx.png',
    ],

    'content' => [

        'en' => [

            'seo' => [
                'title' => 'Sildel | We Think Cork',
                'description' => 'Sustainable intemporal art. Exclusive pieces handcrafted from 100% genuine Portuguese cork.',
            ],

            'navigation' => [
                'primary_left' => [
                    ['label' => 'Our Story', 'url' => 'route:our-story'],
                    ['label' => 'Authentic Cork', 'url' => 'route:authentic-cork'],
                ],
                'primary_right' => [
                    ['label' => 'You Think Cork', 'url' => 'route:you-think-cork'],
                    ['label' => 'Treasures', 'url' => 'route:treasures.index'],
                ],
                'mobile' => [
                    ['label' => 'Our Story', 'url' => 'route:our-story'],
                    ['label' => 'Authentic Cork', 'url' => 'route:authentic-cork'],
                    ['label' => 'You Think Cork', 'url' => 'route:you-think-cork'],
                    ['label' => 'Treasures', 'url' => 'route:treasures.index'],
                    ['label' => 'Contact', 'url' => 'route:contact'],
                ],
                'footer' => [
                    [
                        'title' => 'Maison',
                        'links' => [
                            ['label' => 'Our Story', 'url' => 'route:our-story'],
                            ['label' => 'Authentic Cork', 'url' => 'route:authentic-cork'],
                            ['label' => 'Treasures', 'url' => 'route:treasures.index'],
                            ['label' => 'Blog', 'url' => 'route:journal.index'],
                            ['label' => 'Press', 'url' => 'route:press'],
                        ],
                    ],
                    [
                        'title' => 'Client Care',
                        'links' => [
                            ['label' => 'Contact', 'url' => 'route:contact'],
                            ['label' => 'FAQs', 'url' => 'route:faqs'],
                            ['label' => 'Shipping and Returns', 'url' => 'route:legal.shipping'],
                            ['label' => 'Book of Complaints', 'url' => 'https://www.livroreclamacoes.pt/INICIO/'],
                        ],
                    ],
                    [
                        'title' => 'Legal',
                        'links' => [
                            ['label' => 'Terms and Conditions', 'url' => 'route:legal.terms'],
                            ['label' => 'Privacy Policy', 'url' => 'route:legal.privacy'],
                        ],
                    ],
                ],
            ],

            'ui' => [
                'menu_open' => 'Open menu',
                'home' => 'Home',
                'explore_treasures' => 'Explore Treasures',
                'breadcrumb' => 'Breadcrumb',
                'read_article' => 'Read Article',
                'menu_close' => 'Close menu',
                'skip_to_content' => 'Skip to content',
                'language' => 'Language',
                'previous' => 'Previous',
                'next' => 'Next',
                'cursor_view' => 'View',
                'cursor_discover' => 'Discover',
                'dismiss' => 'Dismiss',
                'whatsapp' => 'Chat with us on WhatsApp',
            ],

            'footer' => [
                'newsletter' => [
                    'heading' => "Be the first to discover\nour *new treasures.*",
                    'placeholder' => 'Your email address',
                    'button' => 'Subscribe',
                ],
                'about' => 'Sustainable intemporal art, handcrafted from genuine Portuguese cork in Esmoriz and delivered worldwide.',
                'copyright' => '© :year Sildel. All rights reserved.',
                'made_in' => 'Handcrafted in Esmoriz, Portugal',
            ],

            'contact_labels' => [
                'phone' => 'Telephone',
                'email' => 'Email',
                'address' => 'Atelier',
            ],

            'home' => [

                'hero' => [
                    'kicker' => 'Maison of Cork Art',
                    'title' => 'SILDEL',
                    'tagline' => 'Sustainable Intemporal Art',
                    'intro' => 'Exclusive pieces handcrafted from 100% genuine Portuguese cork. Born in the forest, made to last a lifetime.',
                    'aside' => 'Sustainable intemporal art, shaped by artisans who honour every grain of the living bark.',
                    'cta' => ['label' => 'Explore Treasures', 'url' => 'route:treasures.index'],
                    'link' => ['label' => 'Our Story', 'url' => 'route:our-story'],
                    'collection_number' => 'Nº I',
                    'collection_label' => 'Fine Arts Collection',
                    'foot_left' => 'Esmoriz, Portugal',
                    'foot_right' => 'Est. Genuine Cork',
                    'badge' => 'Handcrafted in Portugal • Genuine Cork •',
                    'scroll' => 'Scroll',
                    'pause' => 'Pause slideshow',
                    'play' => 'Play slideshow',
                    // Rotating hero photographs (crossfade every few seconds).
                    'slides' => [
                        ['image' => 'images/sildel/hero/leaf-dourado.webp', 'alt' => 'Leaf Dourado cork table lamp glowing gold from within', 'caption' => 'Leaf Dourado, Gold Edition'],
                        ['image' => 'images/sildel/hero/abyss.webp', 'alt' => 'Abyss sculptural cork bowl on a Carrara marble disc', 'caption' => 'Abyss, Carrara Marble'],
                        ['image' => 'images/sildel/hero/crescent.webp', 'alt' => 'Crescent suspended cork light, lit', 'caption' => 'Crescent, 1330 x 300 mm'],
                        ['image' => 'images/sildel/hero/fireflies.webp', 'alt' => 'Fireflies, a tall sculpture of stacked cork pieces', 'caption' => 'Fireflies'],
                        ['image' => 'images/sildel/hero/carre-dor.webp', 'alt' => "Carré d'Or cork and gold lamp", 'caption' => "Carré d'Or, Gold Edition"],
                        ['image' => 'images/sildel/hero/equilibrium.webp', 'alt' => 'Equilibrium sculptural cork shell', 'caption' => 'Equilibrium'],
                        ['image' => 'images/sildel/hero/hot-spring.webp', 'alt' => 'Hot Spring cork table lamp', 'caption' => 'Hot Spring'],
                        ['image' => 'images/sildel/hero/halley.webp', 'alt' => 'Halley, a cork log with a round mirror', 'caption' => 'Halley, 600 x 300 mm'],
                        ['image' => 'images/sildel/hero/shale-coast.webp', 'alt' => 'Shale Coast cork lamp with an amber bulb', 'caption' => 'Shale Coast, New'],
                        ['image' => 'images/sildel/hero/shale-belly-red.webp', 'alt' => 'Shale Belly Red cork lamp, lit, with a red cable', 'caption' => 'Shale Belly Red'],
                    ],
                ],

                'marquee' => ['Fine Arts', 'Handcrafted in Portugal', 'Genuine Cork', 'Shipped Worldwide', 'Timeless Design', 'Living Material'],

                'statement' => [
                    'kicker' => 'We Think Genuine Cork',
                    'text' => 'We do not sell products. We create treasures. Every piece begins as a living forest, harvested without harming a single tree, so nature and design can renew themselves again and again.',
                    'signature' => 'The Sildel Promise',
                ],

                'collection' => [
                    'kicker' => 'The Collection',
                    'title' => ['Fine Arts,', '*curated treasures*'],
                    // White swoosh under the heading, as on the live site (optional).
                    'divider' => 'images/sildel/brand/fine-arts-line.webp',
                    'cta' => ['label' => 'View All Treasures', 'url' => 'route:treasures.index'],
                ],

                // Pieces shown in the home collection, in order (slugs from config/treasures.php).
                'featured' => ['hot-spring', 'crescent', 'alexis', 'leaf-golden', 'halley', 'carre-dor', 'shell', 'shale-coast', 'abyss'],

                'manifesto' => [
                    'kicker' => 'Our Manifesto',
                    'title' => ['We do not kill trees,', 'we give them *life.*'],
                    'paragraphs_before' => [
                        'We never cut down cork oak trees. By harvesting the cork, we set the tree free to regenerate, flourishing with a new layer of life.',
                    ],
                    'quote' => "Each piece is a testament to nature's renewal.",
                    'paragraphs_after' => [
                        'This remarkable natural cycle creates a material that is light, durable and deeply connected to the land it comes from. At Sildel, we transform this living material into objects designed to last.',
                    ],
                    'cta' => ['label' => 'Discover Authentic Cork', 'url' => 'route:authentic-cork'],
                    'image' => 'images/sildel/manifesto.webp',
                    'image_alt' => 'Sildel cork vases displayed on a walnut console',
                    'detail_image' => 'images/sildel/manifesto-detail.webp',
                    'detail_image_alt' => 'Marlin cork bowl with a pearl on a marble base',
                    'watermark' => null, // e.g. 'Cork' shows a large outlined word behind the image
                ],

                'numbers' => [
                    'kicker' => 'Why Sildel',
                    'title' => ['Art that gives back', 'to the *forest*'],
                ],
                'stats' => [
                    ['value' => 100, 'suffix' => '%', 'label' => 'Genuine Cork', 'text' => 'Every piece is made from natural Portuguese cork: light, warm to the touch and endlessly durable.'],
                    ['value' => 9, 'suffix' => '', 'label' => 'Years Between Harvests', 'text' => 'The bark is stripped by hand from the living tree, which slowly grows it back for the next harvest.'],
                    ['value' => 0, 'suffix' => '', 'label' => 'Trees Cut Down', 'text' => 'Harvesting never harms the cork oak, so each treasure gives back to the forest it came from.'],
                    ['value' => null, 'display' => 'PT', 'label' => 'Made in Portugal, Shipped Worldwide', 'text' => 'Handcrafted in Esmoriz and delivered worldwide, each piece packed by the same hands that made it.'],
                ],

                // Brand film (same YouTube video as the live sildel.pt home page).
                'film' => [
                    'kicker' => 'Sildel Treasures',
                    'title' => ['Born in the forest,', 'made to *last a lifetime*'],
                    'youtube_id' => 'l2P1x5BsNg4',
                    'poster' => 'images/sildel/film-poster.webp',
                    'video_title' => 'Sildel Treasures presentation film',
                    'play' => 'Play film',
                ],

                'ritual' => [
                    'kicker' => 'From Forest to Home',
                    'title' => ['The ritual of', '*a treasure*'],
                    'steps' => [
                        ['numeral' => 1, 'title' => 'The Harvest', 'text' => 'Bark is carefully removed by hand from the cork oak, leaving the tree unharmed and free to grow a new layer.', 'image' => 'images/sildel/ritual/harvest.webp', 'image_alt' => 'Close-up of raw cork oak bark'],
                        ['numeral' => 2, 'title' => 'The Craft', 'text' => 'Artisans shape every piece by hand, honouring the natural grain so that no two treasures are ever alike.', 'image' => 'images/sildel/ritual/craft.webp', 'image_alt' => 'Hand-shaped cork table base showing the natural grain'],
                        ['numeral' => 3, 'title' => 'The Treasure', 'text' => 'A finished work of intemporal art arrives at your door, bringing warmth and quiet character to your space.', 'image' => 'images/sildel/ritual/treasure.webp', 'image_alt' => 'Sildel cork pieces styled in a warm interior'],
                    ],
                ],

                'interiors' => [
                    'kicker' => 'You Think Cork',
                    'title' => ['Designed for interiors', 'with a *soul.*'],
                    'text' => 'Discover the natural beauty and unique elegance of genuine cork in interior decoration. Light, warm to the touch and endlessly durable, cork brings a quiet sense of nature into every room.',
                    'features' => [
                        'Exclusive pieces with unique designs',
                        '100% sustainable, renewable material',
                        'Handcrafted in Esmoriz, Portugal',
                        'Delivered worldwide, carefully packed by hand',
                    ],
                    'cta' => ['label' => 'Discover More', 'url' => 'route:you-think-cork'],
                    'image' => 'images/sildel/interiors.webp',
                    'image_alt' => 'Porcelain vase on a sculpted cork base, set on a cork tile table',
                    'detail_image' => 'images/sildel/interiors-detail.webp',
                    'detail_image_alt' => 'Close-up of natural cork surface texture',
                ],

                // Full-bleed parallax banner (EditorialBanner). Not on the home page at the
                // moment; kept for other pages or to swap back in pages/home.blade.php.
                'editorial' => [
                    'kicker' => 'You Think Cork',
                    'title' => ['Interiors with', 'a living *soul*'],
                    'cta' => ['label' => 'Discover More', 'url' => 'route:you-think-cork'],
                    'image' => 'images/sildel/editorial.webp',
                    'image_alt' => 'Sildel cork vases in a softly lit interior',
                ],

                // Journal teaser: the three newest articles from config/journal.php.
                'journal' => [
                    'kicker' => 'Journal',
                    'title' => ['Cork stories', '& *inspiration*'],
                    'intro' => 'Ideas, trends and the craft behind living with genuine cork.',
                    'cta' => ['label' => 'All Articles', 'url' => 'route:journal.index'],
                ],

                'atelier' => [
                    'id' => 'atelier',
                    'kicker' => 'The Atelier',
                    'title' => ['Let us create', 'something *timeless*'],
                    'intro' => 'A question about a piece, a bespoke commission or an order. Our atelier will be delighted to assist you personally.',
                    'form' => [
                        'name' => 'Name',
                        'email' => 'Email',
                        'subject' => 'Subject',
                        'message' => 'Your Message',
                        'submit' => 'Send Enquiry',
                        'sending' => 'Sending',
                    ],
                ],
            ],
        ],

        // Portuguese: add translated keys here (same structure as "en").
        // Anything missing falls back to English automatically.
        'pt' => [
            'ui' => [
                'menu_open' => 'Abrir menu',
                'home' => 'Início',
                'explore_treasures' => 'Explorar Tesouros',
                'breadcrumb' => 'Caminho',
                'read_article' => 'Ler artigo',
                'menu_close' => 'Fechar menu',
                'skip_to_content' => 'Saltar para o conteúdo',
                'language' => 'Idioma',
                'previous' => 'Anterior',
                'next' => 'Seguinte',
                'cursor_view' => 'Ver',
                'cursor_discover' => 'Descobrir',
                'dismiss' => 'Fechar',
                'whatsapp' => 'Fale connosco no WhatsApp',
            ],
        ],
    ],
];
