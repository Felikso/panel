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

class example extends MetaboxRegisterFields
{

    public $dir;
    
    public $post; 

    public $contactSlug;
    public $locationSlug;
    public $mainSlug;

    public $policySlug;
    public $errorSlug;


    public static function register(){

        $dir = basename(__FILE__);
        $post = str_replace('.php', '', $dir);

        $menuSlug = "menu-section-page";
        $contactSlug = "contact-section-page";
        $locationSlug = "location-section-page";
        $mainSlug = "main-section-page";

        $policySlug = "policy-external-page";
        $errorSlug = "error-external-page";

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
            $menuSlug,
            $contactSlug,
            $locationSlug,
            $mainSlug
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
            $menuSlug,
            $contactSlug,
            $locationSlug,
            $mainSlug
            ]
   
       );
   };


//IMAGE FIELD ARRAY

$image_object = [
    [
        'title' => [
            'header-image' => 'zdjęcie główne',
        ]
    ],
    
 ];

    foreach($image_object as $object) {
        $name = key((array)$object['title']);
        self::create_image_test_field_array(
            $name,
            $object['title'][$name],
            $post,
        );
 };

//TEXTAREA FIELD ARRAY

$menu_about_main_content_object = [
    [
        'title' => [
            'main-content' => 'główny kontent',
        ]
    ],
    
 ];

    foreach($menu_about_main_content_object as $object) {
        $name = key((array)$object['title']);
        self::create_textarea_test_field_array(

            $object['title'][$name],
            $name,
            $post,
            [
                $menuSlug,
                $mainSlug
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
                $menuSlug,
                $mainSlug
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
            'Numer na dowóz' => 'delivery-phone',
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
            'Messenger' => 'messenger',
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

    [
        'title' => [
            'Godziny otwarcia' => 'opened-hours',
        ],
        'objects' 		=> [

                    [
                        'title' => [
                            'poniedziałek' => 'monday',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'monday',
                       ],
                    ],


                    [
                        'title' => [
                            'wtorek' => 'tuesday',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'tuesday',
                       ],
                    ],

                    [
                        'title' => [
                            'środa' => 'wednesday',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'wednesday',
                       ],
                    ],

                    [
                        'title' => [
                            'czwartek' => 'thursday',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'thursday',
                       ],
                    ],

                    [
                        'title' => [
                            'piątek' => 'friday',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'friday',
                       ],
                    ],

                    [
                        'title' => [
                            'sobota' => 'saturday',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'saturday',
                       ],
                    ],

                    [
                        'title' => [
                            'niedziela' => 'sunday',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'sunday',
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

/**
 *  Location Section
 */
 
 //Location Items
 
 $location_address_items_object = [
    [
        'title' => [
            'Miasto' => 'item_1',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'title',
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
            'Ulica' => 'item_2',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'title',
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
            'Kod Pocztowy' => 'item_3',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'title',
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


 foreach($location_address_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_image_multiblock_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        [$locationSlug]
    );
}

//Location Items
 
$location_items_object = [
    [
        'title' => [
            'Informacje o lokalizacji' => 'location-info',
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


                ],
       
    ],

    [
        'title' => [
            'Mapa z lokalizacją' => 'location-map',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'odnośnik do strony z dojazdem' => 'url-address',
                        ],
                        'type' => [
                             'input-url',
                        ],
                        'field' => [
                            'url-address',
                       ],
                    ],

                    [
                        'title' => [
                            'zdjęcie mapy' => 'map-image',
                        ],
                        'type' => [
                             'image',
                        ],
                        'field' => [
                            'map-image',
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
        [$mainSlug]
    );
}

/**
 *  Policy Page
 */
 

 $html_content_object = [
    [
        'title' => [
            'html-content' => 'główny kontent',
        ]
    ],
    
 ];

    foreach($html_content_object as $object) {
        $name = key((array)$object['title']);
        self::create_html_test_field_array(

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

 //TEXTERA FIELD ARRAY

 $error_textarea_field_object = array(
    [
        'title' => [
            'info-text' => 'tekst informacyjny',
        ]
    ],

);

    foreach($error_textarea_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_textarea_test_field_array(
            $object['title'][$name],
            $name,
            $post,
            [$errorSlug],
        );
};

//dynamic add image field

$text_area_object = [
    [
        'title' => [
            'image-field' => 'img',
        ]
    ],
    
 ];

    foreach($text_area_object as $object) {
        $graph_field = key((array)$object['title']);
        self::create_multi_dynamic_gallery_test_field_array(
            $graph_field,
            $object['title'][$graph_field],
            $post,
            null,
            100
        );
 };
        
    }
}

/* example::register(); */


