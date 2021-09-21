<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Types;

use Inc\MetaBoxes\Inc\MetaboxClass;
use Inc\MetaBoxes\Inc\MetaboxRegisterFields;

/**
* 
*/

class ventuswebstartercore extends MetaboxRegisterFields
{

    public $dir;
    
    public $post;

    public $seoSlug;
    public $linksSlug;
    public $identitySlug;
    public $themeSlug;
    public $iconsSlug;


    public $bottomNavSlug;


    public static function register(){

        $seoSlug = "seo-content";
        $linksSlug = "links-content";
        $identitySlug = "site-content";
        $themeSlug = "theme-content";

        $bottomNavSlug = "bottom-nav-content";
        $iconsSlug = "svg-icons-content";

        $dir = basename(__FILE__);
        $post = str_replace('.php', '', $dir);

/**
 *  Menu Common
 */
 

/**
 *  SEO Content
 */
/* 
*/

//TEXT INPUT FIELD ARRAY

$seo_text_content_object = [

    [
        'title' => [
            'author' => 'autor',
        ],
    ],

    [
        'title' => [
            'default-description' => 'domyślny opis',
        ],
    ],

    [
        'title' => [
            'default-title' => 'domyślny tytuł',
        ],
    ],

    [
        'title' => [
            'legal-name' => 'nazwa prawna',
        ],
    ],

    [
        'title' => [
            'founding-date' => 'data założenia',
        ],
    ],

    [
        'title' => [
            'city' => 'miasto'
        ],
    ],

    [
        'title' => [
            'country' => 'państwo',
        ],
    ],

    [
        'title' => [
            'region' => 'region',
        ],
    ],

    [
        'title' => [
            'zipCode' => 'kod pocztowy',
        ],
    ],

    [
        'title' => [
            'email' => 'email',
        ],
    ],


    [
        'title' => [
            'phone' => 'numer telefonu',
        ],
    ],

];

foreach($seo_text_content_object as $object) {
    $name = key((array)$object['title']);
    self::create_text_test_field_array(
        $name,
        $object['title'][$name],
        $post,
        [$seoSlug]
    );
};

//URL FIELD ARRAY

$seo_url_content_object = [
[
    'title' => [
        'url' => 'adres url do strony przedsiębiorstwa',
    ],
],
[
    'title' => [
        'logo-url' => 'adres url do logo przedsiębiorstwa',
    ],
],
[
    'title' => [
        'facebook' => 'facebook',
    ],
],
[
    'title' => [
        'github' => 'github',
    ],
],
[
    'title' => [
        'instagram' => 'instagram',
    ],
],
[
    'title' => [
        'twitter' => 'twitter',
    ],
],

];

foreach($seo_url_content_object as $object) {
    $name = key((array)$object['title']);
    self::create_url_test_field_array(
        $name,
        $object['title'][$name],
        $post,
        [$seoSlug]
    );
};


//SELECT FIELD ARRAY

$select_field_object = array(
[
    'title' => [
        'lang' => 'domyślny język na stronie',
    ],
    'options' => [
        'PL',
        'EN',
        'DE'
    ]
],
[
    'title' => [
        'dir' => 'domyślna strona czytania tekstu',
    ],
    'options' => [
        'ltr',
        'rtl'
    ]
],
    
);

foreach($select_field_object as $object){
$name = key((array)$object['title']);
self::create_select_field_array(
    $name,
    $object['title'][$name],
    $post,
    $object['options'],
    [$seoSlug]

);
};

//IMAGE FIELD ARRAY

$seo_img_object = [
    [
    'title' => [
        'thumbnail' => 'zdjęcie podglądu dla strony',
    ]
]

];

foreach($seo_img_object as $object) {
    $name = key((array)$object['title']);
    self::create_image_test_field_array(
        $name,
        $object['title'][$name],
        $post,
        [$seoSlug]
    );
};


/**
*  Links Section
*/


//Links Items

$links_items_object = [

[
    'title' => [
        'Numer kontaktowy' => 'phone-footer',
    ],
    'objects' 		=> [


                [
                    'title' => [
                        'kontent' => 'content',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'content',
                   ],
                ],

                [
                    'title' => [
                        'odnośnik' => 'href',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'href',
                   ],
                ],


                [
                    'title' => [
                        'logo' => 'icon',
                    ],
                    'type' => [
                         'image',
                    ],
                    'field' => [
                        'icon',
                   ],
                ],



            ],
   
],

[
    'title' => [
        'Email' => 'mail-footer',
    ],
    'objects' 		=> [


                [
                    'title' => [
                        'kontent' => 'content',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'content',
                   ],
                ],

                [
                    'title' => [
                        'odnośnik' => 'href',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'href',
                   ],
                ],


                [
                    'title' => [
                        'logo' => 'icon',
                    ],
                    'type' => [
                         'image',
                    ],
                    'field' => [
                        'icon',
                   ],
                ],



            ],
   
],

[
    'title' => [
        'Whatsapp' => 'whatsapp-footer',
    ],
    'objects' 		=> [


                [
                    'title' => [
                        'kontent' => 'content',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'content',
                   ],
                ],

                [
                    'title' => [
                        'odnośnik' => 'href',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'href',
                   ],
                ],


                [
                    'title' => [
                        'logo' => 'icon',
                    ],
                    'type' => [
                         'image',
                    ],
                    'field' => [
                        'icon',
                   ],
                ],

            ],
   
],

[
    'title' => [
        'Facebook' => 'facebook-footer',
    ],
    'objects' 		=> [


                [
                    'title' => [
                        'kontent' => 'content',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'content',
                   ],
                ],

                [
                    'title' => [
                        'odnośnik' => 'href',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'href',
                   ],
                ],


                [
                    'title' => [
                        'logo' => 'icon',
                    ],
                    'type' => [
                         'image',
                    ],
                    'field' => [
                        'icon',
                   ],
                ],

            ],
   
],

[
    'title' => [
        'Google Moja Firma' => 'google-my-business-footer',
    ],
    'objects' 		=> [


                [
                    'title' => [
                        'kontent' => 'content',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'content',
                   ],
                ],

                [
                    'title' => [
                        'odnośnik' => 'href',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'href',
                   ],
                ],


                [
                    'title' => [
                        'logo' => 'icon',
                    ],
                    'type' => [
                         'image',
                    ],
                    'field' => [
                        'icon',
                   ],
                ],

            ],
   
],

[
    'title' => [
        'Odnośniki stopki' => 'footer-info',
    ],
    'objects' 		=> [


                [
                    'title' => [
                        'Polityka prywatności' => 'policy',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'policy',
                   ],
                ],

                [
                    'title' => [
                        'Mapa strony' => 'robots-map',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'robots-map',
                   ],
                ],

                [
                    'title' => [
                        'Coppyright - prawa autorskie' => 'coppyright',
                    ],
                    'type' => [
                         'input-text',
                    ],
                    'field' => [
                        'coppyright',
                   ],
                ],

            ],
   
],

];


foreach($links_items_object as $graph_field => $object) {
$graph_field = key((array)$object['title']);

self::create_image_multiblock_test_field_array(
    $object['title'][$graph_field],
    $graph_field,
    $post,
    $object['objects'],
    [$linksSlug]
);
}


/**
*  Site Identity Section
*/


//Identity Items

//TEXT INPUT FIELD ARRAY

$site_text_content_object = [

[
    'title' => [
        'siteSlogan' => 'slogan',
    ],
],

[
    'title' => [
        'siteTitle' => 'tytuł strony',
    ],
],

[
    'title' => [
        'siteSubTitle' => 'podtytuł strony',
    ],
],

[
    'title' => [
        'siteBrand' => 'nazwa marki',
    ],
],

[
    'title' => [
        'siteDescription' => 'opis firmy',
    ],
],

];

foreach($site_text_content_object as $object) {
$name = key((array)$object['title']);
self::create_text_test_field_array(
    $name,
    $object['title'][$name],
    $post,
    [$identitySlug]
);
};

//IMAGE FIELD ARRAY

$site_img_object = [
[

'title' => [
    'site-logo' => 'logo firmy',
]
],
[
    'title' => [
        'site-header' => 'podstawowe zdjęcie nagłówka',
    ],
]

];

foreach($site_img_object as $object) {
$name = key((array)$object['title']);
self::create_image_test_field_array(
    $name,
    $object['title'][$name],
    $post,
    [$identitySlug]
);
};


/**
*  Theme Section
*/


$theme_color_picker_object = [
    [
        'title' => [
            'background' => 'tło (w trybie ciemnym przeciwieństwo koloru czcionki)',
        ]
    ],
    [
        'title' => [
            'font-color' => 'kolor czcionki (w trybie ciemnym przeciwieństwo koloru tła)',
        ]
    ],
    [
        'title' => [
            'primary' => 'pierwszy kolor wiodący',
        ]
    ],
    [
        'title' => [
            'primary-light' => 'pierwszy kolor wiodący (wersja jaśniesza)',
        ]
    ],
    [
        'title' => [
            'secondary' => 'drugi kolor wiodący',
        ]
    ],
    [
        'title' => [
            'secondary-light' => 'drugi kolor wiodący (wersja jaśniesza)',
        ]
    ],
    [
        'title' => [
            'third' => 'trzeci kolor wiodący',
        ]
    ],
    [
        'title' => [
            'third-darkmode' => 'trzeci kolor wiodący (dla trybu ciemnego)',
        ]
    ],
    [
        'title' => [
            'move-fill-bg-top' => 'tło sekcji kontaktowej (część górna)',
        ]
    ],
    [
        'title' => [
            'move-fill-bg-top-darkmode' => 'tło sekcji kontaktowej (część górna dla trybu ciemnego)',
        ]
    ],
    [
        'title' => [
            'move-fill-bg-bottom' => 'tło sekcji kontaktowej (część dolna)',
        ]
    ],
    [
        'title' => [
            'move-fill-bg-bottom-darkmode' => 'tło sekcji kontaktowej (część dolna dla trybu ciemnego)',
        ]
    ],
    
    
 ];


    foreach($theme_color_picker_object as $object) {
        $graph_field = key((array)$object['title']);
        self::create_color_picker_test_field_array(
            $graph_field,
            $object['title'][$graph_field],
            $post,
            [$themeSlug]
        );
 };
 
 

 $bottom_nav_items_object = [

    [
        'title' => [
            'Przycisk pierwszy' => 'button-1',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'tekst' => 'content',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'content',
                       ],
                    ],

                    [
                        'title' => [
                            'odnośnik' => 'href',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'href',
                       ],
                    ],

                    [
                        'title' => [
                            'style' => 'styl',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'styl',
                       ],
                    ],


                ],
       
    ],

    [
        'title' => [
            'Przycisk drugi' => 'button-2',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'tekst' => 'content',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'content',
                       ],
                    ],

                    [
                        'title' => [
                            'odnośnik' => 'href',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'href',
                       ],
                    ],

                    [
                        'title' => [
                            'styl' => 'style',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'styl',
                       ],
                    ],


                ],
       
    ],

];


 foreach($bottom_nav_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_image_multiblock_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        [$bottomNavSlug]
    );
}


/**
*  Svg Icons Section
*/


//Icons Items

//IMAGE FIELD ARRAY

$simple_icon_object = [
    [
    
    'title' => [
        'icon-sell' => 'Pieczątka sprzedane',
        ]
    ],
    [
    
        'title' => [
            'engine' => 'Slinik',
            ]
    ],
    [
    
        'title' => [
            'gearbox-automatic' => 'Automat',
            ]
    ],
    [
    
    'title' => [
        'gearbox-manual' => 'Manual',
        ]
    ],
    [
    
        'title' => [
            'petrol' => 'Paliwo',
            ]
    ],
    [
    
        'title' => [
            'road' => 'Droga',
            ]
    ],
    [
        
        'title' => [
                'vat' => 'VAT',
            ]
    ],
    [
        
        'title' => [
                'price' => 'Cena',
            ]
    ],
    [
        
        'title' => [
                'power' => 'Moc',
            ]
    ],
    
    ];
    
    foreach($simple_icon_object as $object) {
    $name = key((array)$object['title']);
    self::create_image_test_field_array(
        $name,
        $object['title'][$name],
        $post,
        [$iconsSlug]
    );
    };

/* $icons_items_object = [

    [
        'title' => [
            'Pieczątka sprzedane' => 'sell-icon',
        ],
        'objects' 		=> [
    
    
                    [
                        'title' => [
                            'kontent' => 'content',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'content',
                       ],
                    ],
    
                    [
                        'title' => [
                            'odnośnik' => 'href',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'href',
                       ],
                    ],
    
    
                    [
                        'title' => [
                            'logo' => 'icon',
                        ],
                        'type' => [
                             'image',
                        ],
                        'field' => [
                            'icon',
                       ],
                    ],
    
    
    
                ],
       
    ],
    

    
    ];
    
    
    foreach($icons_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);
    
    self::create_image_multiblock_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        [$iconsSlug]
    );
    } */
    

        
    }
}

ventuswebstartercore::register();


