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

class lasykescore extends MetaboxRegisterFields
{

    public $dir;
    
    public $post;

    public $seoSlug;
    public $linksSlug;
    public $identitySlug;
    public $navSlug;
    public $themeSlug;


    public static function register(){

        $seoSlug = "seo-content";
        $linksSlug = "links-content";
        $identitySlug = "site-content";
        $navSlug = "nav-content";
        $themeSlug = "theme-content";

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
        'Instagram' => 'instagram-footer',
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
        'Messenger' => 'messenger-footer',
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
    'siteLogo' => 'logo firmy',
]
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
*  Links Section
*/


//Links Items

$links_items_object = [
[
    'title' => [
        'Facebook' => 'facebook-nav',
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
        'Instagram' => 'instagram-nav',
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
        'Messenger' => 'messenger-nav',
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
        'Numer kontaktowy' => 'phone-nav',
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
        'Whatsapp' => 'whatsapp-nav',
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
        'Pierwszy przycisk nawigacji' => 'first-nav-buttons',
    ],
    'objects' 		=> [


                [
                    'title' => [
                        'nazwa' => 'content',
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

            ],
],

 [
    'title' => [
        'Drugi przycisk nawigacji' => 'second-nav-buttons',
    ],
    'objects' 		=> [


                [
                    'title' => [
                        'nazwa' => 'content',
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

            ],
   
],



];


foreach($links_items_object as $name => $object) {
$graph_field = key((array)$object['title']);

self::create_image_multiblock_test_field_array(
    $object['title'][$graph_field],
    $graph_field,
    $post,
    $object['objects'],
    [$navSlug]
);
}

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
 
 
        
    }
}

lasykescore::register();


