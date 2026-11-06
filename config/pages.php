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
                'image' => 'images/sildel/pages/iberian-lynx.webp',
                'image_alt' => 'An Iberian lynx standing on a mossy rock',
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
                'role' => 'CEO',
                'image' => 'images/sildel/pages/isabel-silva.webp',
                'image_alt' => 'Portrait of Isabel Silva, CEO of Sildel',
            ],
            'craft' => [
                'kicker' => 'The craft',
                'title' => ['A celebration of the land', 'and its *fauna*'],
                'paragraphs' => [
                    'Cork, a noble and sustainable material, is extracted with respect and care, maintaining harmony with nature. Each Sildel product is a celebration of the land and its fauna. The skilled hands of our artisans transform cork into pieces that carry the strength and beauty of the forest.',
                    'Just as the lynx glides elegantly among the trees, our creations stand out for their sophistication and commitment to sustainability.',
                    'We invite you to discover Sildel, where each piece tells a story of respect for the environment and passion for art. May the spirit of the Iberian lynx, agile and untamed, inspire every moment of your journey with our treasures, bringing the untouched beauty of nature directly into your daily life.',
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
            'shipping' => 'Handcrafted in Esmoriz, Portugal. Delivered worldwide by DHL; postage depends on the destination.',
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
                'map_title' => 'Map showing the Sildel atelier at Rua das Ruivas 108, Esmoriz',
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
                        ['q' => 'Do you ship internationally?', 'a' => 'Yes. We ship from Esmoriz, Portugal to clients around the world, by DHL. Each piece is packed by hand for the journey, by the same hands that made it.'],
                        ['q' => 'How much does shipping cost?', 'a' => 'Postage depends on the destination country and on the pieces you choose. We confirm the exact cost with you before you pay, together with the expected delivery time for your country.', 'link' => ['label' => 'Shipping and Returns', 'url' => 'route:legal.shipping']],
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

        'our_story' => [
            'seo' => [
                'title' => 'A Nossa História | Sildel',
                'description' => 'Mais de 40 anos dedicados à cortiça autêntica. A Sildel nasceu no coração da Península Ibérica para posicionar a cortiça ao lado de um diamante.',
            ],
            'hero' => [
                'kicker' => 'A Nossa História',
                'title' => ['A cortiça é uma questão', 'de *amor*'],
                'intro' => 'Mais de quarenta anos exclusivamente e unicamente em contacto com a cortiça, esta pequena maravilha da natureza, ainda desconhecida por tantos.',
            ],
            'intro' => [
                'kicker' => 'Sem fórmula secreta',
                'image_alt' => 'Jarra de porcelana branca sobre uma base esculpida em cortiça, uma peça Sildel e Porcel',
                'title' => ['Não há segredo,', 'apenas *dedicação*'],
                'paragraphs' => [
                    'Despertámos a curiosidade daqueles que conhecem ou entram em contacto com os nossos produtos. Frequentemente, querem saber o nosso segredo ou fórmula mágica. Na verdade, não há segredo!',
                    'É um conhecimento de mais de 40 anos, exclusivamente e unicamente em contacto com a cortiça, esta pequena maravilha da natureza, ainda desconhecida por tantos.',
                    'A certa altura, este envolvimento tão próximo é tão extraordinário que já não sabemos se a cortiça faz parte de nós, ou se somos nós que pertencemos a ela. A resposta é simples: a cortiça é uma questão de amor.',
                ],
            ],
            'lynx' => [
                'kicker' => 'O nosso símbolo',
                'title' => ['O *lince-ibérico*'],
                'paragraphs' => [
                    'No coração da Península Ibérica, onde os sobreiros se erguem majestosos, nasce a Sildel: uma empresa dedicada à criação de produtos que honram a cortiça autêntica. Aqui, a natureza e a arte entrelaçam-se, tal como as profundas raízes do sobreiro e a agilidade do lince-ibérico, o nosso símbolo e inspiração.',
                    'O lince-ibérico, com o seu olhar penetrante e movimentos graciosos, vagueia pelas florestas de sobreiros, um guardião silencioso de um ecossistema único. É neste ambiente, rico em biodiversidade e história, que a Sildel encontra a sua essência.',
                    'Na Sildel, acreditamos que a verdadeira arte reside em honrar a natureza. O lince-ibérico, símbolo de resiliência e raridade, reflete o nosso compromisso com a preservação e valorização dos recursos naturais.',
                ],
                'image_alt' => 'Um lince-ibérico de pé sobre uma rocha coberta de musgo',
            ],
            'film' => [
                'kicker' => 'Filme Sildel',
                'title' => ['Onde o lince', '*vagueia em liberdade*'],
                'video_title' => 'Sildel: o lince-ibérico e o montado de sobro',
                'play' => 'Ver o filme',
            ],
            'founder' => [
                'kicker' => 'Um sonho',
                'quote' => [
                    'Cada vez mais, a cortiça tem sido destaque nas notícias e, como é sabido, é extremamente relevante no reforço do papel de Portugal no estrangeiro. Basta considerar que Portugal é o maior produtor e transformador de cortiça do mundo. Esta realidade, para mim, deu origem a um sonho. Eu tenho um sonho: posicionar a cortiça ao lado de um diamante.',
                    'Um diamante é apreciado pela sua beleza e raridade. A cortiça é de uma beleza transcendente e as suas qualidades naturais elevam-na ao mais alto nível de raridade. A cortiça apresenta as cores do luxo: o dourado, o bege e o castanho-escuro. Vamos transformá-la em peças intemporais, repletas de sofisticação e requinte.',
                    'Por isso, não desistirei deste sonho: posicionar a cortiça ao lado de um *diamante.*',
                ],
                'image_alt' => 'Retrato de Isabel Silva, CEO da Sildel',
            ],
            'craft' => [
                'kicker' => 'O ofício',
                'title' => ['Uma celebração da terra', 'e da sua *fauna*'],
                'paragraphs' => [
                    'A cortiça, um material nobre e sustentável, é extraída com respeito e cuidado, mantendo a harmonia com a natureza. Cada produto Sildel é uma celebração da terra e da sua fauna. As mãos habilidosas dos nossos artesãos transformam a cortiça em peças que carregam a força e a beleza da floresta.',
                    'Assim como o lince desliza elegantemente entre as árvores, as nossas criações destacam-se pela sua sofisticação e compromisso com a sustentabilidade.',
                    'Convidamo-lo a descobrir a Sildel, onde cada peça conta uma história de respeito pelo ambiente e paixão pela arte. Que o espírito do lince-ibérico, ágil e indomável, inspire cada momento da sua jornada com os nossos tesouros, trazendo a beleza intocada da natureza diretamente para o seu dia a dia.',
                ],
                'image_alt' => 'Pormenor de Marlin: cortiça autêntica a envolver uma esfera de mármore branco',
            ],
        ],

        'authentic_cork' => [
            'seo' => [
                'title' => 'Cortiça Autêntica | Sildel',
                'description' => 'A cortiça autêntica é retirada à mão de sobreiros vivos, sem danificar a árvore. Descubra a floresta por detrás de cada tesouro Sildel.',
            ],
            'hero' => [
                'kicker' => 'Cortiça Autêntica',
                'title' => ['A verdade pertence à natureza,', 'a *engenheira da criação*'],
                'intro' => 'A cortiça autêntica é um presente da natureza, valorizada pela sua sustentabilidade e beleza única.',
                'image_alt' => 'Um pedaço de casca de cortiça autêntica em bruto',
            ],
            'intro' => [
                'paragraphs' => [
                    'Retirada das camadas externas dos sobreiros sem causar qualquer dano. Cada peça carrega as marcas naturais da árvore, tornando cada peça verdadeiramente única.',
                    'Na Sildel, celebramos este material incrível, transformando-o em criações que refletem a essência da natureza e o nosso compromisso com a sustentabilidade.',
                ],
                'facts' => [
                    ['label' => 'anos para a casca voltar a crescer'],
                    ['label' => 'descortiçamentos na vida de uma árvore'],
                    ['label' => 'árvores abatidas'],
                ],
            ],
            'film' => [
                'kicker' => 'A Cortiça Autêntica',
                'title' => ['Veja onde tudo', '*começa*'],
                'text' => 'Observe a casca retirada à mão de sobreiros vivos nas florestas de Portugal. É o mesmo material raro que moldamos em cada tesouro Sildel.',
                'video_title' => 'O descortiçamento nas florestas de Portugal',
                'play' => 'Ver o filme',
            ],
            'biodiversity' => [
                'kicker' => 'Um santuário de biodiversidade',
                'title' => ['Um dos 35 santuários', '*de biodiversidade* do mundo'],
                'text' => 'O montado de sobro é comparável à Amazónia, à savana africana, aos Andes e a Bornéu. Os montados de sobro albergam mais de:',
                'stats' => [
                    ['label' => 'Espécies de aves', 'text' => 'Das águias douradas às cegonhas pretas, os montados de sobro oferecem habitats críticos para diversas espécies de aves.'],
                    ['label' => 'Espécies de répteis e anfíbios', 'text' => 'Locais de reprodução essenciais para espécies ameaçadas como a rela-meridional.'],
                    ['label' => 'Espécies de mamíferos', 'text' => 'Lar de fauna icónica, incluindo o lince-ibérico, lobos ibéricos, veados e javalis, alguns dos quais estão em elevado risco de extinção.'],
                ],
            ],
            'climate' => [
                'kicker' => 'Um pulmão para o planeta',
                'lead' => 'O montado de sobro é um verdadeiro pulmão para o Ambiente, fixando até',
                'figure' => '14 milhões',
                'unit' => 'de toneladas de CO₂ por ano',
                'items' => [
                    ['title' => 'Guardião do Clima', 'text' => 'Combate o aquecimento global e a desertificação.'],
                    ['title' => 'Protetor do Solo', 'text' => 'Controla a erosão.'],
                    ['title' => 'Guardião da Água', 'text' => 'Regula o ciclo hidrológico.'],
                ],
            ],
            'closing' => [
                'kicker' => 'As nossas homenagens',
                'title' => ['Descubra as nossas homenagens', 'a este *nobre material*'],
                'text' => 'Cada peça de cortiça começa como uma floresta viva. Ao recolher a casca de cortiça sem prejudicar a árvore, permitimos a regeneração, criando tesouros intemporais que sustentam tanto a natureza como o design.',
                'cta' => ['label' => 'Ver todos os Tesouros'],
            ],
        ],

        'you_think_cork' => [
            'seo' => [
                'title' => 'You Think Cork | Sildel',
                'description' => 'Seja parceiro da Sildel para inovar com cortiça autêntica: desenvolvimento de produtos, soluções sustentáveis e projetos por medida para marcas, designers e arquitetos.',
            ],
            'hero' => [
                'kicker' => 'You Think Cork',
                'title' => ['Pensa em', '*cortiça?*'],
                'intro' => 'Como membro orgulhoso do Material Bank, a Sildel está empenhada em promover um ambiente colaborativo onde marcas e empresas possam unir-se para inovar e criar.',
                'image_alt' => 'Moodboard do Material Bank com amostras de cortiça Sildel, têxteis e pedra',
            ],
            'intro' => [
                'title' => ['Uma rede de empresas', '*visionárias*'],
                'paragraphs' => [
                    '"You Think Cork" não se trata apenas de colaborar connosco. É sobre construir uma rede de empresas visionárias dedicadas a ultrapassar os limites do que é possível com a cortiça autêntica.',
                    'Acreditamos no poder da colaboração para impulsionar a inovação e criar peças extraordinárias. A nossa dedicação à cortiça autêntica mostrou-nos o potencial ilimitado deste material sustentável, e queremos levar a nossa paixão um passo além: convidamo-lo a juntar-se a nós na exploração de novos horizontes.',
                ],
                'images' => [
                    ['alt' => 'Amostras de cortiça Sildel apresentadas num evento do Material Bank'],
                    ['alt' => 'Amostras de cortiça autêntica em tons naturais e escuros'],
                ],
            ],
            'services' => [
                'kicker' => 'Inovemos juntos',
                'title' => ['Juntos podemos desenvolver', 'soluções *inovadoras*'],
                'items' => [
                    ['title' => 'Desenvolvimento de produtos', 'text' => 'Colabore com a nossa equipa para criar produtos inovadores que aproveitem os benefícios únicos da cortiça.'],
                    ['title' => 'Soluções sustentáveis', 'text' => 'Trabalhe connosco para desenvolver alternativas ecológicas aos materiais tradicionais.'],
                    ['title' => 'Projetos personalizados', 'text' => 'Dê vida às suas ideias únicas com soluções de cortiça personalizadas, criadas para satisfazer as suas necessidades específicas.'],
                ],
            ],
            'collaborations' => [
                'kicker' => 'Colaborações',
                'title' => ['Feito em *conjunto*'],
                'intro' => 'Esculpimos o troféu de um festival nacional e trabalhámos lado a lado com casas portuguesas de porcelana e de iluminação. Uma peça, um projeto, uma ideia de cada vez.',
                'items' => [
                    [
                        'label' => 'Porcelana e cortiça',
                        'text' => 'A porcelana, precisa e luminosa, encontra a cortiça autêntica, paciente e resiliente. Cada peça é concebida e produzida em Portugal: não são peças para uma estação, mas para uma vida.',
                        'image_alt' => 'Peças Porcel e Sildel na feira Ambiente, em Frankfurt',
                    ],
                    [
                        'label' => 'O troféu do festival',
                        'text' => 'O troféu do Festival Mental, esculpido em cortiça autêntica pela Sildel para a nona e a décima edições, em 2025 e 2026.',
                        'image_alt' => 'O troféu do Festival Mental, esculpido em cortiça autêntica',
                    ],
                    [
                        'label' => 'Iluminação Corklux',
                        'text' => 'Corklux, a gama de iluminação retroiluminada em cortiça autêntica criada pela Sildel e pela Lightenjin. Tangram, inspirado no quebra-cabeças geométrico chinês, combina os seus elementos em padrões únicos e dinâmicos.',
                        'image_alt' => 'Candeeiro Corklux Tangram em cortiça autêntica',
                    ],
                ],
            ],
            'partners' => [
                'kicker' => 'Torne-se um parceiro',
                'title' => ['Vamos trabalhar', '*juntos?*'],
                'paragraphs' => [
                    'A Sildel é uma empresa que preza pela qualidade e atendimento aos seus clientes e fornece todas as suas disposições aos seus revendedores. Acima de tudo, Transparência e Confiança são os nossos principais valores na relação comercial.',
                    'Teremos o maior prazer em conhecê-lo e apresentar a nossa gama de produtos. Se quiser ser a nova cara do nosso negócio, escreva-nos.',
                ],
            ],
            'form' => [
                'kicker' => 'Pensa em cortiça?',
                'title' => ['Entre em contacto e junte-se a nós', 'na construção do *futuro*'],
                'subject' => 'You Think Cork: parceria',
            ],
        ],

        'treasures' => [
            'seo' => [
                'title' => 'Tesouros | Sildel',
                'description' => 'Peças escultóricas, iluminação, mobiliário e espelhos feitos à mão em cortiça portuguesa autêntica. Cada peça é única.',
            ],
            'hero' => [
                'kicker' => 'Tesouros',
                'title' => ['Não vendemos produtos.', 'Criamos *tesouros.*'],
                'intro' => 'A cortiça guarda as fissuras, o veio e as cicatrizes da árvore de onde veio, por isso não existem duas peças iguais.',
            ],
            'filter_label' => 'Filtrar por categoria',
            'all' => 'Todas as peças',
            'count' => ':count peças',
            'bespoke' => [
                'kicker' => 'Por medida',
                'title' => ['Algo feito', 'para o seu *espaço*'],
                'text' => 'Escreva-nos com o que tiver: uma divisão, um esboço, uma medida ou simplesmente uma ideia. Respondemos pessoalmente e dizemos-lhe com honestidade o que a cortiça pode fazer com ela.',
                'cta' => ['label' => 'Encomendar uma peça'],
            ],
        ],

        'product' => [
            'exclusive' => 'Único & Exclusivo',
            'enquire' => 'Pedir informações sobre esta peça',
            'enquiry_subject' => 'Pedido de informação: :name',
            'one_of_a_kind' => 'Não existem duas peças iguais. Antes do envio, enviamos-lhe fotografias da peça real, para que saiba exatamente qual o veio e quais as marcas que são suas.',
            'shipping' => 'Feito à mão em Esmoriz, Portugal. Enviado para todo o mundo pela DHL; os portes dependem do destino.',
            'details' => 'Detalhes',
            'specifications' => 'Especificações',
            'material' => 'Matéria-prima',
            'measures' => 'Medidas aproximadas',
            'weight' => 'Peso',
            'includes' => 'Tenha em atenção',
            'variants' => 'Outras dimensões',
            'care' => 'Instruções e cuidados',
            'origin' => 'Quando a árvore é cortada para além da camada de cortiça, fica marcada para sempre. Esse corte cria mais tarde uma espécie de bolha de ar, e é daí que nasce a forma única desta peça.',
            'related' => 'Também poderá gostar',
            'back' => 'Todos os Tesouros',
            'gallery' => 'Fotografias de :name',
            'view_photo' => 'Mostrar fotografia :number',
        ],

        'journal' => [
            'seo' => [
                'title' => 'Blog | Sildel',
                'description' => 'Explore o mundo da cortiça: tendências de design sustentável, a arte do artesanato e as histórias por detrás da Sildel.',
            ],
            'hero' => [
                'kicker' => 'Blog',
                'title' => ['Histórias de cortiça', '& *inspiração*'],
                'intro' => 'Explore o nosso mundo de cortiça, desde tendências de design sustentável à arte do artesanato. Descubra insights inspiradores, histórias e inovação que definem o espírito Sildel.',
            ],
            'read' => 'Ler artigo',
            'back' => 'Todos os artigos',
            'more' => 'Mais do Blog',
            'minutes' => ':count min de leitura',
            'page_title' => 'Página :page',
            'pagination_label' => 'Páginas do blog',
            'previous' => 'Anterior',
            'next' => 'Seguinte',
        ],

        'press' => [
            'seo' => [
                'title' => 'Imprensa | Sildel',
                'description' => 'A Sildel na Vogue, na Mobiliário em Notícia e na Camden House.',
            ],
            'hero' => [
                'kicker' => 'Imprensa',
                'title' => ['A Sildel na', '*imprensa*'],
                'intro' => 'Os nossos tesouros, nas páginas das revistas que acompanham o design e os interiores.',
            ],
            'items' => [
                ['date' => "Abril '23"],
                ['date' => "Janeiro '23"],
                ['date' => "Outubro '22"],
                ['date' => "Outubro '22"],
                ['date' => "Setembro '22"],
                ['date' => "Agosto '22"],
                ['date' => "Junho '22"],
                ['date' => "Abril '22"],
                ['date' => "Fevereiro '22"],
            ],
            'viewer' => [
                'read' => 'Ler o artigo',
                'view' => 'Ver o recorte',
                'pages' => ':count páginas',
                'loading' => 'A abrir a revista',
                'previous' => 'Página anterior',
                'next' => 'Página seguinte',
                'close' => 'Fechar',
                'fullscreen' => 'Ecrã inteiro',
                'download' => 'Descarregar PDF',
                'hint' => 'Arraste um canto ou use as setas para virar a página',
                'error' => 'Não foi possível abrir a revista. Experimente a ligação de descarga.',
            ],
            'contact' => [
                'title' => ['Contactos de *imprensa*'],
                'text' => 'Para entrevistas, imagens ou amostras, escreva-nos e responderemos pessoalmente.',
                'cta' => ['label' => 'Contactar o atelier'],
            ],
        ],

        'contact' => [
            'seo' => [
                'title' => 'Contactos | Sildel',
                'description' => 'Fale com o atelier Sildel em Esmoriz, Portugal: encomendas, peças, parcerias. Respondemos no prazo de um dia útil.',
            ],
            'hero' => [
                'kicker' => 'Contactos',
                'title' => ['Vamos falar de', '*cortiça*'],
                'intro' => 'Cada tesouro que criamos começa com uma conversa. Diga-nos o que tem em mente e o nosso atelier em Esmoriz tratará do resto.',
            ],
            'info' => [
                'kicker' => 'Informações de Contacto',
                'text' => 'Contacte-nos como preferir: por telefone, email ou pelo formulário. O nosso atelier em Esmoriz responde a todas as mensagens, normalmente no prazo de um dia útil.',
                'phone_note' => 'Fale diretamente com o atelier',
                'phone_cost' => 'Custo de uma chamada para a rede móvel nacional, de acordo com a sua tarifa.',
                'hours_label' => 'Horário de Funcionamento',
                'hours' => ['Segunda a sexta-feira: 10:00 – 18:00', 'Sábado e domingo: fechado'],
                'visit' => 'Visitas ao atelier mediante marcação.',
                'map_label' => 'Abrir no Google Maps',
                'map_title' => 'Mapa com a localização do atelier Sildel na Rua das Ruivas 108, Esmoriz',
            ],
            'form' => [
                'kicker' => 'Escreva-nos',
                'title' => ['Diga-nos o que', 'tem em *mente*'],
            ],
            'faq' => [
                'kicker' => 'O que nos perguntam',
                'title' => ['Antes de nos', '*escrever*'],
                'cta' => ['label' => 'Todas as perguntas'],
            ],
        ],

        'faqs' => [
            'seo' => [
                'title' => 'Perguntas Frequentes | Sildel',
                'description' => 'Respostas sobre a cortiça autêntica, as nossas peças, encomendas, cuidados e envios para todo o mundo.',
            ],
            'hero' => [
                'kicker' => 'Perguntas Frequentes',
                'title' => ['O que nos', '*perguntam*'],
                'intro' => 'Respostas às perguntas mais comuns sobre a Sildel, a cortiça autêntica, o nosso trabalho artesanal e os nossos serviços.',
            ],
            'groups' => [
                [
                    'title' => 'A cortiça e as nossas peças',
                    'items' => [
                        ['q' => 'A árvore sobrevive?', 'a' => 'Sim. É precisamente essa a questão. O sobreiro é a única árvore do mundo que pode ser despida da sua casca e continuar a viver: simplesmente volta a produzi-la, mais espessa, ao longo de nove anos. Em Portugal, está protegido por lei. A árvore que deu a cortiça para a sua peça continua de pé, continua a crescer, continua a trabalhar na próxima.'],
                        ['q' => 'Vou receber exatamente a peça da fotografia?', 'a' => 'Não, e não iria querer. A cortiça guarda as fissuras, o veio e as cicatrizes da árvore de onde veio, por isso não existem duas peças iguais. A sua peça terá a mesma alma daquela que viu, e um corpo que nunca existiu antes. Isso não é uma falha do processo. É o processo.'],
                        ['q' => 'A cortiça é resistente o suficiente para mobiliário?', 'a' => 'A cortiça mantém o vinho selado há séculos, isolou naves espaciais e revestiu as paredes de edifícios que sobreviveram aos seus arquitetos. É retardadora de chama, impermeável e resistente ao pó, e não empena. As nossas peças são feitas para serem usadas: pouse um copo, apoie-se na mesa, viva com ela.'],
                        ['q' => 'Como é viver com cortiça?', 'a' => 'É quente. Sempre. A cortiça nunca é fria ao toque como a pedra ou o aço, e quase não pesa na mão. Absorve o som em vez de o devolver. Quem compra as nossas peças diz-nos sempre o mesmo: não consegue deixar de lhes tocar.'],
                        ['q' => 'Como devo cuidar da peça?', 'a' => 'Quase nada. A cortiça é resistente ao pó; um pano seco resolve um derrame. Evite produtos de limpeza químicos: a casca não precisa deles e nunca precisou. Trate-a como a floresta a tratou, e ela manterá a sua beleza durante décadas. A página de cada peça indica os cuidados a ter com os seus outros materiais.'],
                    ],
                ],
                [
                    'title' => 'Encomendas e peças por medida',
                    'items' => [
                        ['q' => 'Como encomendar uma peça?', 'a' => 'Escreva-nos com o que tiver: uma divisão, um esboço, uma medida ou simplesmente uma ideia. Respondemos pessoalmente, perguntamos o que precisamos de saber e dizemos-lhe com honestidade o que a cortiça pode e não pode fazer com ela.'],
                        ['q' => 'Podem criar algo para o meu espaço?', 'a' => 'Muitas vezes, sim. Esculpimos o troféu de um festival nacional e trabalhámos lado a lado com casas portuguesas de porcelana e de iluminação. Se tem uma divisão, um projeto ou uma ideia, escreva-nos.'],
                        ['q' => 'Trabalham com designers e arquitetos?', 'a' => 'Frequentemente. Fornecemos amostras, apoio técnico e desenvolvimento por medida para projetos de design. Se está a trabalhar em algo e quer saber se a cortiça tem lugar nele, pergunte-nos.'],
                        ['q' => 'Quanto tempo demora uma peça?', 'a' => 'As peças disponíveis são enviadas em poucos dias. O trabalho por encomenda depende do que solicitar, normalmente algumas semanas. A cortiça tem o seu próprio ritmo, e preferimos ser honestos a ser rápidos.'],
                        ['q' => 'Posso ver a peça antes de ser enviada?', 'a' => 'Sim, e encorajamos isso. Como não existem duas peças iguais, enviamos fotografias da peça real antes do envio, para que saiba exatamente qual o veio, quais as marcas, qual é a sua.'],
                        ['q' => 'Posso visitar o atelier?', 'a' => 'Recebemos visitas com marcação prévia na Rua das Ruivas 108, Esmoriz. Escreva-nos primeiro para que a Isabel possa estar presente: a conversa é muito diferente quando pode segurar a cortiça nas mãos.'],
                    ],
                ],
                [
                    'title' => 'Envios',
                    'items' => [
                        ['q' => 'Fazem envios para todo o mundo?', 'a' => 'Sim. Enviamos de Esmoriz, Portugal, para clientes em todo o mundo, pela DHL. Cada peça é embalada à mão para a viagem, pelas mesmas mãos que a criaram.'],
                        ['q' => 'Quanto custam os portes de envio?', 'a' => 'Os portes dependem do país de destino e das peças que escolher. Confirmamos consigo o custo exato antes do pagamento, juntamente com o prazo de entrega previsto para o seu país.', 'link' => ['label' => 'Envios e Devoluções']],
                        ['q' => 'O que acontece se a peça chegar danificada?', 'a' => 'Informe-nos imediatamente e resolveremos. A cortiça é muito mais resistente do que as pessoas pensam, mas o transporte é o transporte, e a nossa responsabilidade não termina quando a peça sai do atelier.'],
                        ['q' => 'Posso devolver uma peça?', 'a' => 'Sim, no prazo de 14 dias após a receção. As condições completas estão na nossa página de Envios e Devoluções.', 'link' => ['label' => 'Envios e Devoluções']],
                    ],
                ],
            ],
            'contact' => [
                'title' => ['Ainda tem alguma *pergunta?*'],
                'text' => 'Escreva-nos e o atelier responderá pessoalmente, normalmente no prazo de um dia útil.',
                'cta' => ['label' => 'Contacte-nos'],
            ],
        ],

        'legal' => [
            'shipping-and-returns' => [
                'title' => 'Envios e Devoluções',
                'seo' => ['title' => 'Envios e Devoluções | Sildel', 'description' => 'Como a Sildel faz envios para todo o mundo e como funcionam as trocas, devoluções e reembolsos.'],
            ],
            'terms-and-conditions' => [
                'title' => 'Termos e Condições',
                'seo' => ['title' => 'Termos e Condições | Sildel', 'description' => 'Condições gerais de venda da SILDEL - Arte e Conceito no Mobiliário, Lda.'],
            ],
            'privacy-policy' => [
                'title' => 'Política de Privacidade',
                'seo' => ['title' => 'Política de Privacidade | Sildel', 'description' => 'Como a Sildel recolhe, utiliza e protege os seus dados pessoais, e a nossa política de cookies.'],
            ],
            'kicker' => 'Apoio ao Cliente',
            'updated' => 'Dúvidas sobre esta página? Escreva para :email.',
        ],

        'not_found' => [
            'seo' => ['title' => 'Página não encontrada | Sildel', 'description' => 'Não foi possível encontrar esta página.'],
            'kicker' => 'Erro 404',
            'title' => ['Esta página voltou', 'para a *floresta*'],
            'text' => 'A página que procura não existe ou mudou de endereço. Os nossos tesouros continuam aqui.',
            'cta' => ['label' => 'Explorar os Tesouros'],
            'home' => 'Voltar ao início',
        ],

        'shared' => [
            'treasures_cta' => [
                'kicker' => 'Tesouros',
                'title' => ['Não vendemos produtos.', 'Criamos *tesouros.*'],
                'cta' => ['label' => 'Ver todos os Tesouros'],
            ],
        ],
    ],
];
