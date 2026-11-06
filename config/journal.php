<?php

/*
|--------------------------------------------------------------------------
| Sildel | Journal
|--------------------------------------------------------------------------
| Articles of the Sildel blog, newest first. Each article's body is a Markdown
| file in resources/content/{locale}/journal/{slug}.md (the English text from
| sildel.pt). Slugs match the old sildel.pt URLs. Cover photos are the client's own.
|
| Adding an article: add an entry here and its .md file; the home page shows the
| three newest automatically.
*/

return [

    'articles' => [
        [
            'slug' => 'portuguese-cork-art-why-portugal-leads-the-world-in-genuine-cork-design',
            'title' => 'Portuguese Cork Art: Why Portugal Leads the World in Genuine Cork Design',
            'excerpt' => 'Around half of the world’s cork grows in Portugal. Discover what makes Portuguese cork the finest, how to recognise genuine cork, and where to find handcrafted cork art.',
            'topic' => 'Authentic Cork',
            'date' => '2026-11-05',
            'image' => 'images/sildel/journal/portuguese-cork-art.webp',
            'image_alt' => 'Porcelain vases on handcrafted Portuguese cork bases',
        ],
        [
            'slug' => 'luxury-cork-home-decor-in-the-usa-bringing-portuguese-cork-art-into-american-interiors',
            'title' => 'Luxury Cork Home Decor in the USA: Bringing Portuguese Cork Art Into American Interiors',
            'excerpt' => 'Why US interior designers are choosing genuine Portuguese cork, how to style handcrafted cork art in American homes, and how to order a piece from Portugal.',
            'topic' => 'Interiors',
            'date' => '2026-11-04',
            'image' => 'images/sildel/journal/cork-decor-usa.webp',
            'image_alt' => 'Porcelain vase on a sculpted cork base over a cork chequerboard floor',
        ],
        [
            'slug' => 'sustainable-luxury-interiors-in-the-uk-why-designers-are-choosing-genuine-cork',
            'title' => 'Sustainable Luxury Interiors in the UK: Why Designers Are Choosing Genuine Cork',
            'excerpt' => 'From London townhouses to country homes, genuine Portuguese cork brings character and sustainability to British interiors. A guide for UK designers and homeowners.',
            'topic' => 'Design Trends',
            'date' => '2026-11-03',
            'image' => 'images/sildel/journal/cork-interiors-uk.webp',
            'image_alt' => 'Classical white staircase hall with a gilded mirror',
        ],
        [
            'slug' => 'natural-cork-decor-for-australian-homes-sustainable-design-for-sunlit-interiors',
            'title' => 'Natural Cork Decor for Australian Homes: Sustainable Design for Sunlit Interiors',
            'excerpt' => 'How genuine Portuguese cork suits Australian coastal and open-plan homes, how to care for it in a sunny climate, and how to bring handcrafted cork art to Australia.',
            'topic' => 'Interiors',
            'date' => '2026-11-02',
            'image' => 'images/sildel/journal/cork-decor-australia.webp',
            'image_alt' => 'Leaf cork table lamp glowing with warm golden light',
        ],
        [
            'slug' => 'cork-furniture-in-2026-the-natural-choice-for-timeless-and-sustainable-interiors',
            'title' => 'Cork Furniture in 2026: The Natural Choice for Timeless and Sustainable Interiors',
            'excerpt' => 'Harvested from Portuguese cork oak forests, genuine cork brings together environmental responsibility and timeless elegance in the furniture of 2026.',
            'topic' => 'Cork Furniture',
            'date' => '2026-09-03',
            'image' => 'images/sildel/journal/cork-furniture-2026.webp',
            'image_alt' => 'Sculpted cork and glass table in a classical marble entrance hall',
        ],
        [
            'slug' => 'cork-design-trends-for-2025-shaping-sustainable-and-timeless-interiors',
            'title' => 'Cork Design Trends for 2025: Shaping Sustainable and Timeless Interiors',
            'excerpt' => 'Why genuine cork has become one of the leading materials in interior design, and how the Sildel collections bring it into the home.',
            'topic' => 'Design Trends',
            'date' => '2026-09-02',
            'image' => 'images/sildel/journal/cork-design-trends.webp',
            'image_alt' => 'Crescent cork pendant light above a gilded mirror in a white hallway',
        ],
        [
            'slug' => 'authentic-cork-as-frontrunner-for-2024-furniture-trends-2',
            'title' => 'Authentic Cork as Frontrunner for 2024 Trends in Furniture',
            'excerpt' => 'Curved furniture, textured fabrics and sustainability defined 2023. Authentic cork is emerging as the leading material for furniture and decor.',
            'topic' => 'Design Trends',
            'date' => '2024-01-02',
            'image' => 'images/sildel/journal/authentic-cork-2024.webp',
            'image_alt' => 'Porcelain vases on sculpted cork bases on a lit display shelf',
        ],
        [
            'slug' => 'trends-in-sustainable-lighting-for-interior-decoration',
            'title' => 'Trends in Sustainable Lighting for Interior Decoration',
            'excerpt' => 'Light shapes how a room feels. A look at sustainable lighting and the natural materials that make a space welcoming and refined.',
            'topic' => 'Lighting',
            'date' => '2023-06-22',
            'image' => 'images/sildel/journal/sustainable-lighting.webp',
            'image_alt' => 'Shale cork table lamp casting a warm glow',
        ],
        [
            'slug' => 'which-materials-is-the-best-choice-for-luxury-home-decor',
            'title' => 'Which Material Is the Best Choice for Luxury Home Decor?',
            'excerpt' => 'Genuine cork, white marble and steel compared with crystal, porcelain and ceramics: the materials that stand out in luxury home decor.',
            'topic' => 'Interiors',
            'date' => '2023-05-17',
            'image' => 'images/sildel/journal/luxury-materials.webp',
            'image_alt' => 'Fireflies cork light glowing against a dark wall',
        ],
        [
            'slug' => 'what-is-genuine-cork',
            'title' => 'What Is Genuine Cork?',
            'excerpt' => 'A renewable, durable and naturally beautiful material: what genuine cork is, how it is harvested and why it makes exceptional decorative pieces.',
            'topic' => 'Authentic Cork',
            'date' => '2023-03-21',
            'image' => 'images/sildel/journal/what-is-genuine-cork.webp',
            'image_alt' => 'A raw piece of authentic cork bark',
        ],
    ],

    /*
    | Per-locale copy merged over the English entries above (title, excerpt, topic,
    | image_alt). The article bodies live in resources/content/{locale}/journal/.
    */
    'translations' => [
        'pt' => [
            'portuguese-cork-art-why-portugal-leads-the-world-in-genuine-cork-design' => [
                'title' => 'Arte em Cortiça Portuguesa: Porque Lidera Portugal o Design em Cortiça Genuína',
                'excerpt' => 'Cerca de metade da cortiça do mundo nasce em Portugal. Descubra o que torna a cortiça portuguesa a melhor, como reconhecer a cortiça genuína e onde encontrar arte em cortiça feita à mão.',
                'topic' => 'Cortiça Autêntica',
                'image_alt' => 'Jarras de porcelana sobre bases de cortiça portuguesa feitas à mão',
            ],
            'luxury-cork-home-decor-in-the-usa-bringing-portuguese-cork-art-into-american-interiors' => [
                'title' => 'Decoração de Luxo em Cortiça nos EUA: Arte em Cortiça Portuguesa nos Interiores Americanos',
                'excerpt' => 'Porque escolhem os designers de interiores norte-americanos a cortiça portuguesa genuína, como decorar com arte em cortiça feita à mão e como encomendar uma peça a partir de Portugal.',
                'topic' => 'Interiores',
                'image_alt' => 'Jarra de porcelana sobre uma base de cortiça esculpida, num pavimento de cortiça em xadrez',
            ],
            'sustainable-luxury-interiors-in-the-uk-why-designers-are-choosing-genuine-cork' => [
                'title' => 'Interiores de Luxo Sustentável no Reino Unido: Porque Escolhem os Designers a Cortiça Genuína',
                'excerpt' => 'Das casas georgianas de Londres às casas de campo, a cortiça portuguesa genuína dá carácter e sustentabilidade aos interiores britânicos. Um guia para designers e proprietários no Reino Unido.',
                'topic' => 'Tendências de Design',
                'image_alt' => 'Átrio clássico com escadaria branca e um espelho dourado',
            ],
            'natural-cork-decor-for-australian-homes-sustainable-design-for-sunlit-interiors' => [
                'title' => 'Decoração em Cortiça Natural para Casas Australianas: Design Sustentável para Interiores Luminosos',
                'excerpt' => 'Como a cortiça portuguesa genuína se adapta às casas costeiras e de plano aberto da Austrália, como cuidar dela num clima soalheiro e como levar arte em cortiça feita à mão até à Austrália.',
                'topic' => 'Interiores',
                'image_alt' => 'Candeeiro de mesa Leaf em cortiça, a brilhar com uma luz dourada e quente',
            ],
            'cork-furniture-in-2026-the-natural-choice-for-timeless-and-sustainable-interiors' => [
                'title' => 'Mobiliário em Cortiça em 2026: A Escolha Natural para Interiores Intemporais e Sustentáveis',
                'excerpt' => 'Extraída dos montados de sobro portugueses, a cortiça genuína une responsabilidade ambiental e elegância intemporal no mobiliário de 2026.',
                'topic' => 'Mobiliário em Cortiça',
                'image_alt' => 'Mesa esculpida em cortiça e vidro num átrio clássico de mármore',
            ],
            'cork-design-trends-for-2025-shaping-sustainable-and-timeless-interiors' => [
                'title' => 'Tendências de Design em Cortiça para 2025: Interiores Sustentáveis e Intemporais',
                'excerpt' => 'Porque se tornou a cortiça genuína um dos materiais de referência no design de interiores, e como as coleções Sildel a trazem para dentro de casa.',
                'topic' => 'Tendências de Design',
                'image_alt' => 'Candeeiro de suspensão Crescent em cortiça, por cima de um espelho dourado num corredor branco',
            ],
            'authentic-cork-as-frontrunner-for-2024-furniture-trends-2' => [
                'title' => 'A Cortiça Genuína como Líder nas Tendências de Móveis para 2024',
                'excerpt' => 'Mobiliário curvo, tecidos texturizados e sustentabilidade marcaram 2023. A cortiça autêntica afirma-se como o material de referência para mobiliário e decoração.',
                'topic' => 'Tendências de Design',
                'image_alt' => 'Jarras de porcelana sobre bases de cortiça esculpida numa prateleira iluminada',
            ],
            'trends-in-sustainable-lighting-for-interior-decoration' => [
                'title' => 'Tendências em Iluminação Sustentável para Decoração de Interiores',
                'excerpt' => 'A luz molda a forma como sentimos um espaço. Um olhar sobre a iluminação sustentável e os materiais naturais que tornam um ambiente acolhedor e requintado.',
                'topic' => 'Iluminação',
                'image_alt' => 'Candeeiro de mesa Shale em cortiça, com uma luz quente',
            ],
            'which-materials-is-the-best-choice-for-luxury-home-decor' => [
                'title' => 'Qual o Material que é a Melhor Escolha para a Decoração de Luxo em Casa?',
                'excerpt' => 'Cortiça genuína, mármore branco e aço comparados com cristal, porcelana e cerâmica: os materiais que se destacam na decoração de luxo.',
                'topic' => 'Interiores',
                'image_alt' => 'Candeeiro Fireflies em cortiça a brilhar contra uma parede escura',
            ],
            'what-is-genuine-cork' => [
                'title' => 'O que é a Cortiça Genuína?',
                'excerpt' => 'Um material renovável, durável e naturalmente bonito: o que é a cortiça genuína, como é extraída e porque dá origem a peças decorativas excecionais.',
                'topic' => 'Cortiça Autêntica',
                'image_alt' => 'Um pedaço de casca de cortiça autêntica em bruto',
            ],
        ],
    ],
];
