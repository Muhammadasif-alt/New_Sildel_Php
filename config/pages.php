<?php

/*
|--------------------------------------------------------------------------
| Sildel | Inner pages
|--------------------------------------------------------------------------
| Copy for every page other than the home page, per locale. Text comes from
| the current sildel.pt pages. Same conventions as config/sildel.php:
|   *word*       gold italic emphasis        \n   line break
|   'route:name' a link to one of the site's own pages (resolved per locale),
|                optionally with '#anchor' or '?query'.
| Untranslated keys fall back to English.
*/

return [

    'en' => [

        'our_story' => [
            'seo' => [
                'title' => 'Our Story | Sildel',
                'description' => 'More than 40 years devoted to genuine cork. Sildel was born in the heart of the Iberian Peninsula to place cork next to a diamond.',
            ],
            'hero' => [
                'kicker' => 'Our Story',
                'title' => ['Cork is a matter', 'of *love*'],
                'intro' => 'More than forty years solely and exclusively in contact with cork, this little wonder of nature, still unknown to so many.',
            ],
            'intro' => [
                'kicker' => 'No secret formula',
                'title' => ['There is no secret,', 'only *devotion*'],
                'paragraphs' => [
                    'We have sparked the curiosity of those who know or come into contact with our products. They often want to know our secret, our magic formula. In fact, there is no secret.',
                    'It has been a knowledge of more than 40 years solely and exclusively in contact with cork, this little wonder of nature, still unknown to so many.',
                    'At a certain point this close involvement becomes so extraordinary that we no longer know if cork is part of us, or if we are the ones who belong to it. The answer is simple: cork is a matter of love.',
                ],
            ],
            'lynx' => [
                'kicker' => 'Our symbol',
                'title' => ['The Iberian *lynx*'],
                'paragraphs' => [
                    'In the heart of the Iberian Peninsula, where cork oak trees stand majestically, Sildel is born: a company dedicated to creating products that honour authentic cork. Here, nature and art intertwine, just like the deep roots of the cork oak and the agility of the Iberian lynx, our symbol and inspiration.',
                    'The Iberian lynx, with its piercing gaze and graceful movements, roams the cork oak forests, a silent guardian of a unique ecosystem. It is in this environment, rich in biodiversity and history, that Sildel finds its essence.',
                    'At Sildel, we believe that true art lies in honouring nature. The Iberian lynx, a symbol of resilience and rarity, reflects our commitment to the preservation and appreciation of natural resources.',
                ],
            ],
            'film' => [
                'kicker' => 'Sildel Film',
                'title' => ['Where the lynx', '*roams free*'],
                'youtube_id' => 'U6N8YkiLSHY',
                'poster' => 'images/sildel/pages/our-story-film.webp',
                'video_title' => 'Sildel: the Iberian lynx and the cork oak forest',
                'play' => 'Play the film',
            ],
            'founder' => [
                'kicker' => 'A dream',
                'quote' => [
                    'More and more cork has been in the news and, as is well known, it is extremely relevant in strengthening Portugal\'s role abroad. Just consider that Portugal is the largest producer and processor of cork in the world. This reality, for me, gave birth to a dream. I have a dream: to position cork next to a diamond.',
                    'A diamond is appreciated for its beauty and rarity. Cork is of transcendent beauty and its natural qualities elevate it to the highest level of rarity. Cork presents the colours of luxury: the golden, the beige and the dark brown. We will turn it into timeless pieces filled with sophistication and refinement.',
                    'Therefore, I will not give up this dream: to position cork next to a *diamond.*',
                ],
                'name' => 'Isabel Silva',
                'role' => 'CEO and Founder',
                'image' => 'images/sildel/pages/isabel-silva.webp',
                'image_alt' => 'Portrait of Isabel Silva, CEO of Sildel',
            ],
            'craft' => [
                'kicker' => 'The craft',
                'title' => ['A celebration of the land', 'and its *fauna*'],
                'paragraphs' => [
                    'Cork, a noble and sustainable material, is extracted with respect and care, maintaining harmony with nature. Each Sildel product is a celebration of the land and its fauna. The skilled hands of our artisans transform cork into pieces that carry the strength and beauty of the forest.',
                    'Just as the lynx glides elegantly among the trees, our creations stand out for their sophistication and commitment to sustainability. We invite you to discover Sildel, where each piece tells a story of respect for the environment and passion for art.',
                ],
                // Whole piece, uncropped (the square manifesto detail cuts off both ends of the bowl).
                'image' => 'images/sildel/pages/craft-marlin.webp',
                'image_alt' => 'Close-up of Marlin: authentic cork cradling a white marble sphere',
            ],
        ],

        'authentic_cork' => [
            'seo' => [
                'title' => 'Authentic Cork | Sildel',
                'description' => 'Authentic cork is harvested by hand from living cork oaks, without harming the tree. Discover the forest behind every Sildel treasure.',
            ],
            'hero' => [
                'kicker' => 'Authentic Cork',
                'title' => ['The truth belongs to nature,', 'the *engineer of creation*'],
                'intro' => 'Authentic cork is a gift from nature, valued for its sustainability and unique beauty.',
                'image' => 'images/sildel/pages/authentic-cork-bark.webp',
                'image_alt' => 'A raw piece of authentic cork bark',
            ],
            'intro' => [
                'paragraphs' => [
                    'Harvested from the outer layers of cork oak trees without causing any harm. Each piece carries the natural markings of the tree, making every piece truly one of a kind.',
                    'At Sildel, we celebrate this incredible material, transforming it into creations that reflect the essence of nature and our commitment to sustainability.',
                ],
                'facts' => [
                    ['value' => '9', 'label' => 'years for the bark to grow back'],
                    ['value' => '20+', 'label' => 'harvests in the life of one tree'],
                    ['value' => '0', 'label' => 'trees cut down'],
                ],
            ],
            'film' => [
                'kicker' => 'The Authentic Cork',
                'title' => ['See where it all', '*begins*'],
                'text' => 'Watch bark lifted by hand from living cork oaks in the forests of Portugal. It is the same rare material we shape into every Sildel treasure.',
                'youtube_id' => 'i2d0ZL1fowg',
                'poster' => 'images/sildel/pages/authentic-cork-film.webp',
                'video_title' => 'The cork harvest in the forests of Portugal',
                'play' => 'Play the film',
            ],
            'biodiversity' => [
                'kicker' => 'A biodiversity sanctuary',
                'title' => ['One of the world\'s 35', '*biodiversity sanctuaries*'],
                'text' => 'The cork oak forest is comparable to the Amazon, the African savanna, the Andes and Borneo. Cork oak forests are home to more than:',
                'stats' => [
                    ['value' => 160, 'label' => 'Bird species', 'text' => 'From golden eagles to black storks, cork oak forests provide critical habitats for diverse bird species.'],
                    ['value' => 24, 'label' => 'Reptile and amphibian species', 'text' => 'Essential breeding grounds for endangered species such as the Mediterranean tree frog.'],
                    ['value' => 37, 'label' => 'Mammal species', 'text' => 'Home to iconic wildlife including the Iberian lynx, Iberian wolves, deer and wild boar, some at high risk of extinction.'],
                ],
            ],
            'climate' => [
                'kicker' => 'A lung for the planet',
                'lead' => 'The cork oak forest is a real lung for the environment. It fixes up to',
                'figure' => '14 million',
                'unit' => 'tons of CO₂ every year',
                'items' => [
                    ['title' => 'Climate guardian', 'text' => 'Combats global warming and desertification.', 'icon' => 'sun'],
                    ['title' => 'Soil protector', 'text' => 'Controls erosion.', 'icon' => 'leaf'],
                    ['title' => 'Water guardian', 'text' => 'Regulates the hydrological cycle.', 'icon' => 'drop'],
                ],
            ],
            'closing' => [
                'kicker' => 'Our tributes',
                'title' => ['Check our tributes', 'to this *noble material*'],
                'text' => 'Every cork piece begins as a living forest. By harvesting cork bark without harming the tree, we enable regeneration, creating timeless treasures that sustain both nature and design.',
                'cta' => ['label' => 'See all Treasures', 'url' => 'route:treasures.index'],
            ],
        ],

        'you_think_cork' => [
            'seo' => [
                'title' => 'You Think Cork | Sildel',
                'description' => 'Partner with Sildel to innovate with authentic cork: product development, sustainable solutions and bespoke projects for brands, designers and architects.',
            ],
            'hero' => [
                'kicker' => 'You Think Cork',
                'title' => ['Do you think', '*cork?*'],
                'intro' => 'As a proud member of Material Bank, Sildel is committed to fostering a collaborative environment where brands and companies come together to innovate and create.',
                'image' => 'images/sildel/pages/material-bank-moodboard.webp',
                'image_alt' => 'Material Bank moodboard with Sildel cork samples, textiles and stone',
            ],
            'intro' => [
                'title' => ['A network of', '*forward-thinking* companies'],
                'paragraphs' => [
                    '"You Think Cork" is not just about partnering with us. It is about building a network of forward-thinking companies dedicated to pushing the boundaries of what is possible with authentic cork.',
                    'We believe in the power of collaboration to drive innovation and create extraordinary pieces. Our dedication to authentic cork has shown us the limitless potential of this sustainable material, and we want to take our passion a step further: we invite you to join us in exploring new horizons.',
                ],
                'images' => [
                    ['src' => 'images/sildel/pages/material-bank-event.webp', 'alt' => 'Sildel cork samples presented at a Material Bank event'],
                    ['src' => 'images/sildel/pages/cork-samples.webp', 'alt' => 'Authentic cork samples in natural and dark tones'],
                ],
            ],
            'services' => [
                'kicker' => 'Let\'s innovate together',
                'title' => ['Together we can develop', '*groundbreaking* solutions'],
                'items' => [
                    ['title' => 'Product development', 'text' => 'Collaborate with our team to create innovative products that leverage the unique benefits of cork.'],
                    ['title' => 'Sustainable solutions', 'text' => 'Work together to develop eco-friendly alternatives to traditional materials.'],
                    ['title' => 'Customised projects', 'text' => 'Bring your unique ideas to life with tailored cork solutions designed to meet your specific needs.'],
                ],
            ],
            'collaborations' => [
                'kicker' => 'Collaborations',
                'title' => ['Made *together*'],
                'intro' => 'We have sculpted a national festival\'s trophy and worked alongside Portuguese porcelain and lighting houses. One piece, one project, one idea at a time.',
                'items' => [
                    [
                        'name' => 'Porcel',
                        'label' => 'Porcelain and cork',
                        'text' => 'Porcelain, precise and luminous, meets genuine cork, patient and resilient. Each piece is conceived and produced in Portugal: not pieces for a season, but for a lifetime.',
                        'image' => 'images/sildel/pages/partner-porcel.webp',
                        'image_alt' => 'Porcel and Sildel pieces at the Ambiente fair in Frankfurt',
                    ],
                    [
                        'name' => 'Festival Mental',
                        'label' => 'The festival trophy',
                        'text' => 'The trophy of Festival Mental, sculpted in authentic cork by Sildel for its ninth and tenth editions, in 2025 and 2026.',
                        'image' => 'images/sildel/pages/partner-festival-mental.webp',
                        'image_alt' => 'The Festival Mental trophy, sculpted in authentic cork',
                    ],
                    [
                        'name' => 'Lightenjin',
                        'label' => 'Corklux lighting',
                        'text' => 'Corklux, the backlit genuine cork lighting range created by Sildel and Lightenjin. Tangram, inspired by the Chinese geometric puzzle, combines its elements into unique, dynamic patterns.',
                        'image' => 'images/sildel/pages/partner-lightenjin.webp',
                        'image_alt' => 'Corklux Tangram light in authentic cork',
                    ],
                ],
            ],
            'partners' => [
                'kicker' => 'Become a partner',
                'title' => ['Let\'s work', '*together?*'],
                'paragraphs' => [
                    'Sildel values quality and service to its customers and provides all its resources to its resellers. Above all, transparency and trust are our main values in a business relationship.',
                    'We will be happy to meet you and present our range of products. If you want to be the new face of our business, write to us.',
                ],
            ],
            'form' => [
                'kicker' => 'Do you think cork?',
                'title' => ['Reach out and join us', 'in shaping the *future*'],
                'subject' => 'You Think Cork: partnership',
            ],
        ],

        'treasures' => [
            'seo' => [
                'title' => 'Treasures | Sildel',
                'description' => 'Sculptural pieces, lighting, furniture and mirrors handcrafted from authentic Portuguese cork. Every piece is unique.',
            ],
            'hero' => [
                'kicker' => 'Treasures',
                'title' => ['We do not sell products.', 'We create *treasures.*'],
                'intro' => 'Cork carries the fissures, grain and scars of the tree it came from, so no two pieces can ever be identical.',
            ],
            'filter_label' => 'Filter by category',
            'all' => 'All pieces',
            'count' => ':count pieces',
            'bespoke' => [
                'kicker' => 'Bespoke',
                'title' => ['Something made', 'for your *space*'],
                'text' => 'Write to us with as much or as little as you have: a room, a sketch, a measurement, or simply an idea. We will reply personally and tell you honestly what cork can do with it.',
                'cta' => ['label' => 'Commission a piece', 'url' => 'route:contact'],
            ],
        ],

        'product' => [
            'exclusive' => 'Unique and Exclusive',
            'enquire' => 'Enquire about this piece',
            'enquiry_subject' => 'Enquiry: :name',
            'one_of_a_kind' => 'No two pieces are alike. Before dispatch we send you photographs of the actual piece, so you know exactly which grain and which markings are yours.',
            'shipping' => 'Handcrafted in Esmoriz, Portugal. Delivered worldwide.',
            'details' => 'Details',
            'specifications' => 'Specifications',
            'material' => 'Raw material',
            'measures' => 'Approx. measures',
            'weight' => 'Weight',
            'includes' => 'Please note',
            'variants' => 'Other sizes',
            'care' => 'Instructions and care',
            'origin' => 'When the tree is cut beyond the cork layer, it becomes permanently marked. This cut later creates a kind of air bubble, and that is where the unique shape of this piece originates.',
            'related' => 'You may also like',
            'back' => 'All Treasures',
            'gallery' => 'Photographs of :name',
            'view_photo' => 'Show photograph :number',
        ],

        'journal' => [
            'seo' => [
                'title' => 'Journal | Sildel',
                'description' => 'Explore the world of cork: sustainable design trends, the art of craftsmanship and the stories behind Sildel.',
            ],
            'hero' => [
                'kicker' => 'Journal',
                'title' => ['Cork stories', '& *inspiration*'],
                'intro' => 'Explore our world of cork, from sustainable design trends to the art of craftsmanship. Discover the insights, stories and innovation that define the Sildel spirit.',
            ],
            'read' => 'Read Article',
            'back' => 'All articles',
            'more' => 'More from the Journal',
            'minutes' => ':count min read',
            'page_title' => 'Page :page',
            'pagination_label' => 'Journal pages',
            'previous' => 'Previous',
            'next' => 'Next',
        ],

        'press' => [
            'seo' => [
                'title' => 'Press | Sildel',
                'description' => 'Sildel in Vogue, Mobiliário em Notícia and Camden House.',
            ],
            'hero' => [
                'kicker' => 'Press',
                'title' => ['Sildel in the', '*press*'],
                'intro' => 'Our treasures, as seen in the pages of the magazines that follow design and interiors.',
            ],
            // pdf (optional, relative to /public): opens as a page-turning flipbook. Without it the clipping opens enlarged.
            'items' => [
                ['publication' => 'Mobiliário em Notícia', 'date' => "April '23", 'image' => 'images/sildel/press/mobiliario-em-noticia-april.webp', 'pdf' => 'files/press/mobiliario-em-noticia-155-april-2023.pdf'],
                ['publication' => 'Camden House', 'date' => "January '23", 'image' => 'images/sildel/press/camden-house.webp', 'pdf' => 'files/press/camden-house-january-2023.pdf'],
                ['publication' => 'Vogue', 'date' => "October '22", 'image' => 'images/sildel/press/vogue-october-2.webp'],
                ['publication' => 'Mobiliário em Notícia', 'date' => "October '22", 'image' => 'images/sildel/press/mobiliario-em-noticia-1.webp'],
                ['publication' => 'Vogue', 'date' => "September '22", 'image' => 'images/sildel/press/vogue-september.webp'],
                ['publication' => 'Vogue', 'date' => "August '22", 'image' => 'images/sildel/press/vogue-august.webp', 'pdf' => 'files/press/vogue-august-2022.pdf'],
                ['publication' => 'Mobiliário em Notícia', 'date' => "June '22", 'image' => 'images/sildel/press/mobiliario-em-noticia-june.webp', 'pdf' => 'files/press/mobiliario-em-noticia-150-june-2022.pdf'],
                ['publication' => 'Mobiliário em Notícia', 'date' => "April '22", 'image' => 'images/sildel/press/mobiliario-em-noticia.webp'],
                ['publication' => 'Mobiliário em Notícia', 'date' => "February '22", 'image' => 'images/sildel/press/mobiliario-em-noticia-february.webp', 'pdf' => 'files/press/mobiliario-em-noticia-148-february-2022.pdf'],
            ],
            'viewer' => [
                'read' => 'Read the feature',
                'view' => 'View the clipping',
                'pages' => ':count pages',
                'loading' => 'Opening the magazine',
                'previous' => 'Previous page',
                'next' => 'Next page',
                'close' => 'Close',
                'fullscreen' => 'Full screen',
                'download' => 'Download PDF',
                'hint' => 'Drag a corner or use the arrows to turn the page',
                'error' => 'The magazine could not be opened. Please try the download link.',
            ],
            'contact' => [
                'title' => ['Press *enquiries*'],
                'text' => 'For interviews, images or samples, write to us and we will reply personally.',
                'cta' => ['label' => 'Contact the atelier', 'url' => 'route:contact'],
            ],
        ],

        'contact' => [
            'seo' => [
                'title' => 'Contact | Sildel',
                'description' => 'Talk to the Sildel atelier in Esmoriz, Portugal: commissions, pieces, partnerships. We reply within one working day.',
            ],
            'hero' => [
                'kicker' => 'Contact',
                'title' => ['Let\'s talk', '*cork*'],
                'intro' => 'Every treasure we make begins with a conversation. Tell us what you have in mind, and our workshop in Esmoriz will take it from there.',
            ],
            'info' => [
                'kicker' => 'Contact info',
                'text' => 'Reach us however suits you: phone, email or the form. Our workshop in Esmoriz answers every message, and you will normally hear back within one working day.',
                'phones' => [
                    ['label' => '+351 911 015 388', 'href' => 'tel:+351911015388'],
                    ['label' => '+351 915 624 709', 'href' => 'tel:+351915624709'],
                ],
                'phone_note' => 'Speak to the workshop directly',
                'phone_cost' => 'Cost of a call to a Portuguese mobile network, according to your tariff.',
                'hours_label' => 'Hours',
                'hours' => ['Monday to Friday: 10:00 to 18:00', 'Saturday and Sunday: closed'],
                'visit' => 'Visits to the atelier by appointment.',
                'map_label' => 'Open in Google Maps',
            ],
            'form' => [
                'kicker' => 'Write to us',
                'title' => ['Tell us what you', 'have in *mind*'],
            ],
            'faq' => [
                'kicker' => 'What people ask us',
                'title' => ['Before you', '*write*'],
                'cta' => ['label' => 'All questions', 'url' => 'route:faqs'],
                'items' => [0, 6, 4],
            ],
        ],

        'faqs' => [
            'seo' => [
                'title' => 'FAQs | Sildel',
                'description' => 'Answers about authentic cork, our pieces, commissions, care and worldwide shipping.',
            ],
            'hero' => [
                'kicker' => 'FAQs',
                'title' => ['What people', '*ask us*'],
                'intro' => 'Answers to the most common questions about Sildel, authentic cork, our craftsmanship and our services.',
            ],
            'groups' => [
                [
                    'title' => 'Cork and our pieces',
                    'items' => [
                        ['q' => 'Does the tree survive?', 'a' => 'Yes. That is the whole point. The cork oak is the only tree on earth that can be stripped of its bark and keep living: it simply grows it back, thicker, over nine years. In Portugal it is protected by law. The tree that gave the cork for your piece is still standing, still growing, still working on the next one.'],
                        ['q' => 'Will I receive exactly the piece in the photograph?', 'a' => 'No, and you would not want to. Cork carries the fissures, grain and scars of the specific tree it came from, so no two pieces can be identical. Your piece will have the same soul as the one you saw, and a body that has never existed before. That is not a flaw in the process. It is the process.'],
                        ['q' => 'Is cork strong enough to be furniture?', 'a' => 'Cork has kept wine sealed for centuries, insulated spacecraft, and lined the walls of buildings that outlived their architects. It is fire-retardant, waterproof and dust-proof, and it does not warp. Our pieces are built to be used: set a glass down, lean on the table, live with it.'],
                        ['q' => 'What does cork feel like to live with?', 'a' => 'Warm. Always. Cork never feels cold to the touch the way stone or steel does, and it weighs almost nothing in the hand. It absorbs sound instead of throwing it back. People who buy our pieces tell us the same thing: they keep touching them.'],
                        ['q' => 'How do I care for it?', 'a' => 'Barely at all. Cork is dust-proof; a dry cloth handles a spill. Avoid chemical cleaners: the bark does not need them and never has. Treat it the way the forest did, and it will keep its beauty for decades. Each piece page lists the care for its other materials.'],
                    ],
                ],
                [
                    'title' => 'Orders and commissions',
                    'items' => [
                        ['q' => 'How do I commission a piece?', 'a' => 'Write to us with as much or as little as you have: a room, a sketch, a measurement, or simply an idea. We will reply personally, ask what we need to know, and tell you honestly what cork can and cannot do with it.'],
                        ['q' => 'Can you make something for my space?', 'a' => 'Often, yes. We have sculpted a national festival\'s trophy and worked alongside Portuguese porcelain and lighting houses. If you have a room, a project or an idea, write to us.'],
                        ['q' => 'Do you work with designers and architects?', 'a' => 'Often. We provide samples, specification support and bespoke development for design projects. If you are working on something and wondering whether cork belongs in it, ask us.'],
                        ['q' => 'How long does a piece take?', 'a' => 'Ready pieces are dispatched within a few days. Commissioned work depends on what you are asking for, usually a few weeks. Cork sets its own pace, and we would rather be honest than fast.'],
                        ['q' => 'Can I see the exact piece before it ships?', 'a' => 'Yes, and we encourage it. Because no two pieces are alike, we send photographs of the actual piece before dispatch, so you know exactly which grain, which markings, which one is yours.'],
                        ['q' => 'Can I visit the atelier?', 'a' => 'We welcome visits by appointment at Rua das Ruivas 108, Esmoriz. Write to us first so Isabel can be there: it makes for a very different conversation when you can hold the cork in your hands.'],
                    ],
                ],
                [
                    'title' => 'Shipping',
                    'items' => [
                        ['q' => 'Do you ship internationally?', 'a' => 'Yes. We ship from Esmoriz, Portugal to clients around the world. Each piece is packed by hand for the journey, by the same hands that made it.'],
                        ['q' => 'What if something arrives damaged?', 'a' => 'Tell us immediately and we will make it right. Cork is far more resilient than people expect, but shipping is shipping, and our responsibility does not end when the piece leaves the atelier.'],
                        ['q' => 'Can I return a piece?', 'a' => 'Yes, within 14 days of receiving it. The full conditions are on our Shipping and Returns page.', 'link' => ['label' => 'Shipping and Returns', 'url' => 'route:legal.shipping']],
                    ],
                ],
            ],
            'contact' => [
                'title' => ['Still have a *question?*'],
                'text' => 'Write to us and the atelier will reply personally, normally within one working day.',
                'cta' => ['label' => 'Contact us', 'url' => 'route:contact'],
            ],
        ],

        'legal' => [
            'shipping-and-returns' => [
                'title' => 'Shipping and Returns',
                'seo' => ['title' => 'Shipping and Returns | Sildel', 'description' => 'How Sildel ships worldwide and how exchanges, returns and refunds work.'],
            ],
            'terms-and-conditions' => [
                'title' => 'Terms and Conditions',
                'seo' => ['title' => 'Terms and Conditions | Sildel', 'description' => 'General conditions of sale of SILDEL - Arte e Conceito no Mobiliário, Lda.'],
            ],
            'privacy-policy' => [
                'title' => 'Privacy Policy',
                'seo' => ['title' => 'Privacy Policy | Sildel', 'description' => 'How Sildel collects, uses and protects your personal data, and our cookies policy.'],
            ],
            'kicker' => 'Client Care',
            'updated' => 'Questions about this page? Write to :email.',
        ],

        'not_found' => [
            'seo' => ['title' => 'Page not found | Sildel', 'description' => 'This page could not be found.'],
            'kicker' => 'Error 404',
            'title' => ['This page has', 'gone back to the *forest*'],
            'text' => 'The page you are looking for does not exist or has moved. Our treasures are still here.',
            'cta' => ['label' => 'Explore Treasures', 'url' => 'route:treasures.index'],
            'home' => 'Back to home',
        ],

        'shared' => [
            'treasures_cta' => [
                'kicker' => 'Treasures',
                'title' => ['We do not sell products.', 'We create *treasures.*'],
                'cta' => ['label' => 'See all Treasures', 'url' => 'route:treasures.index'],
            ],
        ],
    ],

    'pt' => [
        'product' => [
            'enquire' => 'Pedir informações sobre esta peça',
            'specifications' => 'Especificações',
            'material' => 'Matéria-prima',
            'measures' => 'Medidas aproximadas',
            'weight' => 'Peso',
            'care' => 'Instruções e cuidados',
            'related' => 'Também poderá gostar',
            'back' => 'Todos os Tesouros',
        ],
        'treasures' => [
            'all' => 'Todas as peças',
            'filter_label' => 'Filtrar por categoria',
            'count' => ':count peças',
        ],
        'journal' => [
            'read' => 'Ler artigo',
            'back' => 'Todos os artigos',
            'page_title' => 'Página :page',
            'pagination_label' => 'Páginas do diário',
            'previous' => 'Anterior',
            'next' => 'Seguinte',
        ],
    ],
];
