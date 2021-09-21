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

class ventuswebstartermain extends MetaboxRegisterFields
{

    public $dir;
    
    public $post; 

    public $contactSlug;
    public $locationSlug;
    public $aboutSlug;

    public $policySlug;
    public $errorSlug;


    public static function register(){

        $dir = basename(__FILE__);
        $post = str_replace('.php', '', $dir);

        $offerSlug = "offer-section-page";
        $contactSlug = "contact-section-page";
        $locationSlug = "location-section-page";
        $aboutSlug = "about-section-page";

        $policySlug = "policy-external-page";
        $errorSlug = "error-external-page";

        $aboutSlug = "about-external-page";
/**
 *  Main Common
 */
 

 //TEXT FIELD ARRAY

 $text_field_object = array(
    [
        'title' => [
            'text-header' => 'tekst nagłówka',
        ]
    ],
    [
        'title' => [
            'section-title' => 'tytuł sekcji',
        ]
    ],

);

    foreach($text_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_text_test_field_array(
            $name,
            $object['title'][$name],
            $post,
            [        
            $offerSlug,
            $contactSlug,
            $locationSlug,
            $aboutSlug,
            $aboutSlug
            ]
        );
};


 //TEXT FIELD ARRAY

 $second_text_field_object = array(
    [
        'title' => [
            'text-subheader' => 'dodatkowy nagłówek',
        ]
    ],

);

    foreach($second_text_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_text_test_field_array(
            $name,
            $object['title'][$name],
            $post,
            [        
            $offerSlug,
            ]
        );
};

 //NUMBER FIELD ARRAY

 $number_field_object = array(
    [
       'title' => [
           'order' => 'kolejność',
       ],
       'min' => [
        'min' => '1',
       ],
       'max' => [
        'max' => '10',
       ],
    ]
           
   );
   
   foreach($number_field_object as $object){
       $name = key((array)$object['title']);
       $min_field = key((array)$object['min']);
       $max_field = key((array)$object['max']);
       self::create_number_test_field_array(
           $name,
           $object['title'][$name],
           $post,
           $object['min'][$min_field],
           $object['max'][$max_field],
           [        
            $offerSlug,
            $contactSlug,
            $locationSlug,
            $aboutSlug
            ]
   
       );
   };


 //HEADER IMG FIELD ARRAY

 $policy_image_field_object = array(
    [
        'title' => [
            'header-image' => 'zdjęcie nagłówka strony',
        ]
    ],

);

foreach($policy_image_field_object as $object) {
    $name = key((array)$object['title']);
    self::create_image_test_field_array(
        $name,
        $object['title'][$name],
        $post,
        [
            $policySlug,
            $errorSlug,
            $aboutSlug
        ],
    );
    };
 

/**
* About page
 */

  //TEXTERA FIELD ARRAY

  $about_editor_field_object = array(
    [
        'title' => [
            'about-content' => 'główny kontent',
        ]
    ],
    [
        'title' => [
            'about-content-secondary' => 'dodatkowy kontent',
        ]
    ],

);

    foreach($about_editor_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_editor_test_field_array(
            $object['title'][$name],
            $name,
            $post,
            [$aboutSlug],
        );
};
        
    


    $about_links_items_object = [

        [
            'title' => [
                'Numer kontaktowy' => 'about-phone',
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
                'Email' => 'about-mail',
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
                'Whatsapp' => 'about-whatsapp',
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
                'Facebook' => 'about-facebook',
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
                'Messenger' => 'about-messenger',
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
        
        
        foreach($about_links_items_object as $graph_field => $object) {
        $graph_field = key((array)$object['title']);
        
        self::create_image_multiblock_test_field_array(
            $object['title'][$graph_field],
            $graph_field,
            $post,
            $object['objects'],
            [$aboutSlug]
        );
        }

 //TEXT FIELD ARRAY

 $about_text_field_object = array(
    [
        'title' => [
            'about-web-link' => 'link do głównej strony',
        ]
    ],

);

    foreach($about_text_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_text_test_field_array(
            $name,
            $object['title'][$name],
            $post,
            [        
            $offerSlug,
            $contactSlug,
            $locationSlug,
            $aboutSlug,
            $aboutSlug
            ]
        );
};

/**
 *  Menu Section
 */
 


$text_area_object = [
    [
        'title' => [
            'paragraphs' => 'akapity',
        ]
    ],
    
 ];

    foreach($text_area_object as $object) {
        $graph_field = key((array)$object['title']);
        self::create_multi_text_test_field_array(
            $graph_field,
            $object['title'][$graph_field],
            $post,
            [
                $offerSlug,
                $aboutSlug,
                $locationSlug
            ],
            10
        );
 };
 



/**
 *  Contact Section
 */
 

//Contact Items
 
$contact_items_object = [

    [
        'title' => [
            'Email' => 'mail',
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
                            'name' => 'nazwa',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'name',
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
            'Numer kontaktowy' => 'phone',
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
                            'name' => 'nazwa',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'name',
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
            'Whatsapp' => 'whatsapp',
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
                            'name' => 'nazwa',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'name',
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


 foreach($contact_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_image_multiblock_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        [$contactSlug]
    );
}


$text_field_object = array(
    [
        'title' => [
            'brand-full-name' => 'nazwa pełna',
        ]
    ],
    [
        'title' => [
            'brand-nip' => 'NIP',
        ]
    ],
    [
        'title' => [
            'brand-regon' => 'REGON',
        ]
    ],
    [
        'title' => [
            'brand-phone' => 'telefon',
        ]
    ],
    [
        'title' => [
            'brand-email' => 'email',
        ]
    ],

);

    foreach($text_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_text_test_field_array(
            $name,
            $object['title'][$name],
            $post,
            [$contactSlug]
        );
};


//Location Items
 
$contact_info_items_object = [
    [
        'title' => [
            'Informacje o przedsiębiorstwie nr 1' => 'brand-info-1',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'nazwa pełna:' => 'brand-full-name',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'brand-full-name',
                       ],
                    ],

                    [
                        'title' => [
                            'NIP' => 'brand-nip',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'brand-nip',
                       ],
                    ],

                    [
                        'title' => [
                            'REGON' => 'brand-regon',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'brand-regon',
                       ],
                    ],

                ],
       
    ],

    [
        'title' => [
            'Informacje kontaktowe o przedsiębiorstwie nr 2' => 'brand-info-2',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'telefon:' => 'brand-phone',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'brand-phone',
                       ],
                    ],

                    [
                        'title' => [
                            'mail:' => 'brand-mail',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'brand-mail',
                       ],
                    ],

                ],
       
    ],


];


 foreach($contact_info_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_image_multiblock_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        [$contactSlug]
    );
}

/**
 *  Location Section
 */
 
 //Location Items
 

//Location Items
 
$location_items_object = [
    [
        'title' => [
            'Informacje o lokalizacji nr 1' => 'location-info-1',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'miasto' => 'city',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'city',
                       ],
                    ],

                    [
                        'title' => [
                            'ulica' => 'street',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'street',
                       ],
                    ],

                    [
                        'title' => [
                            'kod pocztowy' => 'zip-code',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'zip-code',
                       ],
                    ],

                    [
                        'title' => [
                            'odnośnik do dojazdu' => 'directions',
                        ],
                        'type' => [
                             'input-url',
                        ],
                        'field' => [
                            'directions',
                       ],
                    ],


                ],
       
    ],

    [
        'title' => [
            'Informacje o lokalizacji nr 2' => 'location-info-2',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'miasto' => 'city',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'city',
                       ],
                    ],

                    [
                        'title' => [
                            'ulica' => 'street',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'street',
                       ],
                    ],

                    [
                        'title' => [
                            'kod pocztowy' => 'zip-code',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'zip-code',
                       ],
                    ],

                    [
                        'title' => [
                            'odnośnik do dojazdu' => 'directions',
                        ],
                        'type' => [
                             'input-url',
                        ],
                        'field' => [
                            'directions',
                       ],
                    ],


                ],
       
    ],


];


 foreach($location_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_image_multiblock_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        [$locationSlug]
    );
}

//IMAGE FIELD ARRAY

$map_img_object = [
    [
    'title' => [
        'map' => 'mapa dojazdu',
    ]
]

];

foreach($map_img_object as $object) {
    $name = key((array)$object['title']);
    self::create_image_test_field_array(
        $name,
        $object['title'][$name],
        $post,
        [$locationSlug]
    );
};

/**
 *  About Section
 */
 


 //About Items
 
$about_items_object = [
    [
        'title' => [
            'Cecha 1' => 'features_1',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'treść cechy firmy' => 'title',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'title',
                       ],
                    ],

                    [
                        'title' => [
                            'motto cechy' => 'motto',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'motto',
                       ],
                    ],

                    [
                        'title' => [
                            'opis cechy firmy' => 'desc',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'desc',
                       ],
                    ],


                    [
                        'title' => [
                            'ikona' => 'icon',
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
            'Cecha 2' => 'features_2',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'treść cechy firmy' => 'title',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'title',
                       ],
                    ],

                    [
                        'title' => [
                            'motto cechy' => 'motto',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'motto',
                       ],
                    ],

                    [
                        'title' => [
                            'opis cechy firmy' => 'desc',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'desc',
                       ],
                    ],

                    [
                        'title' => [
                            'ikona' => 'icon',
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
            'Cecha 3' => 'features_3',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'treść cechy firmy' => 'title',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'title',
                       ],
                    ],

                    [
                        'title' => [
                            'motto cechy' => 'motto',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'motto',
                       ],
                    ],

                    [
                        'title' => [
                            'opis cechy firmy' => 'desc',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'desc',
                       ],
                    ],

                    [
                        'title' => [
                            'ikona' => 'icon',
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


 foreach($about_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_image_multiblock_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        [$aboutSlug]
    );
}



/**
 *  Policy Page
 */
 

 $title_content_object = [
    [
        'title' => [
            'policy-title' => 'tytuł sekcji',
        ]
    ],
    
 ];

 foreach($title_content_object as $object) {
    $name = key((array)$object['title']);
    self::create_text_test_field_array(
        $name,
        $object['title'][$name],
        $post,
        [        
        $policySlug,
        ]
    );
};

 //TEXTERA FIELD ARRAY

 $policy_editor_field_object = array(
    [
        'title' => [
            'policy-content' => 'treść polityki prywatności',
        ]
    ],

);

    foreach($policy_editor_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_editor_test_field_array(
            $object['title'][$name],
            $name,
            $post,
            [$policySlug],
        );
};

/**
 *  Error Page
 */
 
 //TEXT FIELD ARRAY

 $error_text_field_object = array(
    [
        'title' => [
            'title-info' => 'tytuł informujący',
        ]
    ],
    [
        'title' => [
            'content-info' => 'treść informująca',
        ]
    ],
    [
        'title' => [
            'button-text' => 'tekst przycisku powrotnego',
        ]
    ],

);

    foreach($error_text_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_text_test_field_array(
            $name,
            $object['title'][$name],
            $post,
            [$errorSlug],
        );
};

        
    }

    
}

ventuswebstartermain::register();


