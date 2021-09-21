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

class ventusautaproduct extends MetaboxRegisterFields
{

    public $dir;
    
    public $post; 

    public $contactSlug;
    public $locationSlug;
    public $aboutSlug;

    public $policySlug;
    public $errorSlug;

    public function add_alt_text(){
        update_post_meta(594, '_wp_attachment_image_alt', 'test');
    }
    public static function register(){

        $dir = basename(__FILE__);
        $post = str_replace('.php', '', $dir);

        $offerSlug = "offer-section-page";
        $contactSlug = "contact-section-page";
        $locationSlug = "location-section-page";
        $aboutSlug = "about-section-page";

        $policySlug = "policy-external-page";
        $errorSlug = "error-external-page";




        add_action( 'add_attachment',  'add_alt_text'  );


/**
 *  Products
 */
 

//IMAGE FIELD ARRAY

$main_img_object = [
    [
    'title' => [
        'main-image' => 'zdjęcie główne pojazdu',
    ],
],
[
    'title' => [
        'second-image' => 'drugie zdjęcie główne pojazdu',
    ]
]

];

foreach($main_img_object as $object) {
    $name = key((array)$object['title']);
    self::create_image_test_field_array(
        $name,
        $object['title'][$name],
        $post,
        null
    );
};


//TEXTAREA FIELD ARRAY

$menu_about_main_content_object = [
    [
        'title' => [
            'description' => 'opis pojazdu',
        ]
    ],
    
 ];

    foreach($menu_about_main_content_object as $object) {
        $name = key((array)$object['title']);
        self::create_textarea_test_field_array(

            $object['title'][$name],
            $name,
            $post,
            null
        );
 };


//GALLERY FIELD ARRAY
 
/* $gallery_object = [
    [
        'title' => [
            'gallery' => 'galeria pojazdu',
        ],
        'options' 		=> [
			[
				'image' => 'zdjęcie 1',
            ],
            [
                'image' 	=> 'zdjęcie 2',
			],
            [
                'image' 	=> 'zdjęcie 3',
			],
            [
                'image' 	=> 'zdjęcie 4',
			],
            [
                'image' 	=> 'zdjęcie 5',
			]				
		]
    ],

 ];

 foreach($gallery_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_image_gallery_test_field_array(
        $graph_field,
        $object['title'][$graph_field],
        $post,
        $object['options'],
        null
    );
 };
  */


 $drag_drop_object = [
    [
        'title' => [
            'gallery' => 'zdjęcia produktu',
        ]
    ],
    
 ];

    foreach($drag_drop_object as $object) {
        $graph_field = key((array)$object['title']);
        self::create_multi_drag_drop_gallery_test_field_array(
            $graph_field,
            $object['title'][$graph_field],
            $post,
            null,

        );
 };


 
 //TEXT FIELD ARRAY

 $text_field_object = array(
    [
        'title' => [
            'product-name' => 'nazwa',
        ]
    ],
    [
        'title' => [
            'product-full-name' => 'nazwa pełna',
        ]
    ],
    [
        'title' => [
            'productSlug' => 'odnośnik',
        ]
    ],
/*     [
        'title' => [
            'type' => 'typ',
        ]
    ],
    [
        'title' => [
            'kind' => 'rodzaj',
        ]
    ], */
    [
        'title' => [
            'brand' => 'marka',
        ]
    ],
    [
        'title' => [
            'model' => 'model',
        ]
    ],
    [
        'title' => [
            'generation' => 'generacja',
        ]
    ],
    [
        'title' => [
            'oil' => 'paliwo',
        ]
    ],
    [
        'title' => [
            'vin' => 'vin',
        ]
    ],

);

    foreach($text_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_text_test_field_array(
            $name,
            $object['title'][$name],
            $post,
            null
        );
};


 //NUMBER FIELD ARRAY

 $number_field_object = array(
    [
        'title' => [
            'year' => 'rok',
        ],
        'min' => [
         'min' => '1',
        ],
        'max' => [
         'max' => '500',
        ],
    ],
    [
       'title' => [
           'price' => 'cena',
       ],
       'min' => [
        'min' => '15000',
       ],
       'max' => [
        'max' => '200000',
       ],
    ],
    [
        'title' => [
            'gross-price' => 'cena brutto',
        ],
        'min' => [
         'min' => '15000',
        ],
        'max' => [
         'max' => '250000',
        ],
    ],
    [
        'title' => [
            'power' => 'moc',
        ],
        'min' => [
         'min' => '1',
        ],
        'max' => [
         'max' => '500',
        ],
    ],
    [
        'title' => [
            'course' => 'przebieg',
        ],
        'min' => [
         'min' => '1',
        ],
        'max' => [
         'max' => '500000',
        ],
    ],
    [
        'title' => [
            'capacity' => 'pojemność',
        ],
        'min' => [
         'min' => '1',
        ],
        'max' => [
         'max' => '5000',
        ],
    ],
    [
        'title' => [
            'loan-price' => 'cena wynajmu',
        ],
        'min' => [
         'min' => '1',
        ],
        'max' => [
         'max' => '500',
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
           null
   
       );
   };

 //SELECT FIELD ARRAY

$select_field_object = array(
    [
        'title' => [
            'type' => 'typ',
        ],
        'options' => [
            'furgon',
            'kombi',
            'suv',
            'sedan',
            'minikoparka'
        ]
    ],
    [
        'title' => [
            'kind' => 'rodzaj',
        ],
        'options' => [
            'samochody dostawcze',
            'samochody osobowe',
            'maszyny'
        ]
    ],
    [
        'title' => [
            'gearbox' => 'skrzynia biegów',
        ],
        'options' => [
            'manual',
            'automat'
        ]
    ],
    [
        'title' => [
            'petrol' => 'paliwo',
        ],
        'options' => [
            'benzyna',
            'ropa',
            'gaz'
        ]
    ],
    [
        'title' => [
            'oil' => 'paliwo - skrót',
        ],
        'options' => [
            'PB',
            'ON',
            'PG'
        ]
    ],
    [
        'title' => [
            'course-value' => 'jednostka liczonego przebiegu',
        ],
        'options' => [
            'KM',
            'RGB'
        ]
    ],
    [
        'title' => [
            'drive' => 'napęd',
        ],
        'options' => [
            'na tylne koła',
            'na przednie koła',
            'na przednie i tylne koła',
            '0'
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
        null
    
    );
    };

//CHECKBOX FIELD ARRAY

$checkbox_field_array = [
    [
        'title' => [
            'currency' => 'waluta',
        ],
        'type' => [
            'field' => 'radio',
        ],
        'options' 		=> [
			[
				'value' => 'pln',
                'checked' 	=> true
			],
			[
				'value' => 'dollar'
			]			
		]
    ],
    [
        'title' => [
            'properties' => 'właściwości',
        ],
        'type' => [
            'field' => 'checkbox',
        ],
        'options' 		=> [
			[
				'value' => 'ABS',
],
[
				'value' => 'Alarm',
],
[
				'value' => 'Alufelgi',
],
[
				'value' => 'ASR (kontrola trakcji)',
],
[
				'value' => 'Asystent parkowania',
],
[
				'value' => 'Bluetooth',
],
[
				'value' => 'CD',
],
[
				'value' => 'Centralny zamek',
],
[
				'value' => 'Czujnik deszczu',
],
[
				'value' => 'Czujnik zmierzchu',
],
[
				'value' => 'Czujniki parkowania przednie',
],
[
				'value' => 'Czujniki parkowania tylne',
],
[
				'value' => 'Elektrochromatyczne lusterka wsteczne',
],
[
				'value' => 'Elektryczne szyby przednie',
],
[
				'value' => 'Elektryczne szyby tylne',
],
[
				'value' => 'Elektrycznie ustawiane fotele',
],
[
				'value' => 'Elektrycznie ustawiane lusterka',
],
[
				'value' => 'Gniazdo USB',
],
[
				'value' => 'Immobilizer',
],
[
				'value' => 'Isofix',
],
[
				'value' => 'Kamera cofania',
],
[
				'value' => 'Klimatyzacja automatyczna',
],
[
				'value' => 'Klimatyzacja czterostrefowa',
],
[
				'value' => 'Komputer pokładowy',
],
[
				'value' => 'Kurtyny powietrzne',
],
[
				'value' => 'MP3',
],
[
				'value' => 'Nawigacja GSP',
],
[
				'value' => 'Odtwarzacz DVD',
],
[
				'value' => 'Ogranicznik prędkości',
],
[
				'value' => 'Podgrzewane przednie siedzenia',
],
[
				'value' => 'Podgrzewane lusterka boczne',
],
[
				'value' => 'Poduszka powietrzna chroniąca kolana',
],
[
				'value' => 'Poduszka powietrzna kierowcy',
],
[
				'value' => 'Poduszka powietrzna pasażera',
],
[
				'value' => 'Poduszki boczne przednie',
],
[
				'value' => 'Poduszki boczne tylne',
],
[
				'value' => 'Przyciemniane szyby',
],
[
				'value' => 'Radio fabryczne',
],
[
				'value' => 'Relingi dachowe',
],
[
				'value' => 'System Start-Stop',
],
[
				'value' => 'Światła do jazdy dziennej',
],
[
				'value' => 'Światła LED',
],
[
				'value' => 'Światła przeciwmgielne',
],
[
				'value' => 'Światła Xenonowe',
],
[
				'value' => 'Tapicerka skórzana',
],
[
				'value' => 'Klimatyzacja dwustrefowa',
],
[
				'value' => 'Nawigacja GPS',
],
[
				'value' => 'Tapicerka welurowa',
],
[
				'value' => 'Wspomaganie kierownicy',
],
[
				'value' => 'Klimatyzacja manualna',
],
[
				'value' => 'Przesuwne drzwi',
],
[
				'value' => 'Radio niefabryczne',
],
[
				'value' => 'waga : 1.43 t',
],
[
				'value' => 'długość transportowa : 3.75 m',
],
[
				'value' => 'wysokość transportu : 2.16 m',
],
[
				'value' => 'szerokość łańcuchów : 200 mm',
],
[
				'value' => 'ochrona kierowcy : kabina',
],
[
				'value' => 'głębokość kopania : 2,3 m',
],
[
				'value' => 'producent silnika : Kubota',
],
[
				'value' => 'typ silnika : D722E',
],
[
				'value' => 'moc silnika : 9.9 kW',
],
[
				'value' => 'pojemność skokowa : 0.72 l',
],
[
				'value' => 'prędk. obr. przy max. m. obr. : 2000 rpm',
],
[
				'value' => 'Asystent pasa ruchu',
],
[
				'value' => 'Tempomat',
],
[
				'value' => 'Wielofunkcyjna kierownica',
],
[
				'value' => 'Zmieniarka CD',
],
		]
     ]      
 ];

 foreach($checkbox_field_array as $field => $object) {
    $field = key((array)$object['title']);

 
    self::create_checkbox_test_field_array(
        $field,
        $object['title'][$field],
        $object['options'],
        $object['type']['field'],
        $post
    );
 };


 //CHECKBOX FIELD ARRAY

$checkbox_field_array = [
    [
        'title' => [
            'currency' => 'waluta',
        ],
        'type' => [
            'field' => 'radio',
        ],
        'options' 		=> [
			[
				'value' => 'pln',
                'checked' 	=> true
			],
			[
				'value' => 'dollar'
			]			
		]
    ],
    [
        'title' => [
            'loanable' => 'wypożyczalny',
        ],
        'type' => [
            'field' => 'checkbox',
        ],
        'options' 		=> [
			[
				'value' => 'możliwość wypożyczenia',
            ],
		]
        ],
        [
            'title' => [
                'sold' => 'sprzedany',
            ],
            'type' => [
                'field' => 'checkbox',
            ],
            'options' 		=> [
                [
                    'value' => 'czy pojazd jest już sprzedany?',
                ],
            ]
        ],
        [
            'title' => [
                'imported' => 'importowany',
            ],
            'type' => [
                'field' => 'checkbox',
            ],
            'options' 		=> [
                [
                    'value' => 'czy pojazd pochodzi z importu?',
                ],
            ]
        ],
        [
            'title' => [
                'invoice' => 'faktura VAT',
            ],
            'type' => [
                'field' => 'checkbox',
            ],
            'options' 		=> [
                [
                    'value' => 'czy za zakup można otrzymac fakturę vat?',
                ],
            ]
        ],    
     
     


 ];

 foreach($checkbox_field_array as $field => $object) {
    $field = key((array)$object['title']);

 
    self::create_checkbox_test_field_array(
        $field,
        $object['title'][$field],
        $object['options'],
        $object['type']['field'],
        $post
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
            'info-text' => 'tekst informacyjnyy',
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

 //TEXTERA FIELD ARRAY

 $error_editor_field_object = array(
    [
        'title' => [
            'editor' => 'editor',
        ]
    ],

);

    foreach($error_editor_field_object as $object) {
        $name = key((array)$object['title']);
        self::create_editor_test_field_array(
            $object['title'][$name],
            $name,
            $post,
            [$errorSlug],
        );
};
        
    }

    

    public static function my_set_image_meta_upon_image_upload( $post_ID ) {

        echo '<script>';
        echo 'console.log('. json_encode( '$posts' , JSON_HEX_TAG) .')';
        echo '</script>'; 

        // Check if uploaded file is an image, else do nothing
    
        if ( wp_attachment_is_image( $post_ID ) ) {
    
            $prefix = 'Ventus WEB - ';
            $dir = basename(__FILE__);
            $post = str_replace('.php', '', $dir);
    
            $meta = get_post_meta( $post_ID );
    
            $posts = get_posts([
                'post_type' => $post,
            ]);
    
            $image_post_type = get_post( $post_ID )->post_type;
    
            if ( $image_post_type  ==  $post ) {
            
            $my_image_title = 'Ventus WEB';
    
            foreach( $meta as $key => $value ) {
                if ( strpos($key, 'product-name') ) {
                    $newAltText = $prefix . $value[0];
                    echo '<script>';
                    echo 'console.log('. json_encode( $newAltText , JSON_HEX_TAG) .')';
                    echo '</script>';
                    $my_image_title = $newAltText;
             
                }
            }
    
            // Sanitize the title:  remove hyphens, underscores & extra spaces:
            $my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );
    
            // Sanitize the title:  capitalize first letter of every word (other letters lower case):
            $my_image_title = ucwords( strtolower( $my_image_title ) );
    
            // Create an array with the image meta (Title, Caption, Description) to be updated
            // Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
            $my_image_meta = array(
                'ID'		=> $post_ID,			// Specify the image (ID) to be updated
                'post_title'	=> $my_image_title,		// Set image Title to sanitized title
                'post_excerpt'	=> $my_image_title,		// Set image Caption (Excerpt) to sanitized title
                'post_content'	=> $my_image_title,		// Set image Description (Content) to sanitized title
            );
    
            // Set the image Alt-Text
            update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );
    
            // Set the image meta (e.g. Title, Excerpt, Content)
            wp_update_post( $my_image_meta );
            }
    
    

        } 
    }
}

ventusautaproduct::register();

/* ventusautaproduct::my_set_image_meta_upon_image_upload(704); */

/* $prefix = 'Ventus WEB - ';
$dir = basename(__FILE__);
$post = str_replace('.php', '', $dir);

$posts = get_posts([
    'post_type' => $post,
  ]);



foreach( $posts as $item ) {

$meta = get_post_meta( $item->ID);


foreach( $meta as $key => $value ) {
    if ( strpos($key, 'product-name') ) {
        $newAltText = $prefix . $value[0];
        echo '<script>';
        echo 'console.log('. json_encode( $newAltText , JSON_HEX_TAG) .')';
        echo '</script>';

 
    }
}
} */

/* Automatically set the image Title, Alt-Text, Caption & Description upon upload
--------------------------------------------------------------------------------------*/
/* Automatically set the image Title, Alt-Text, Caption & Description upon upload
--------------------------------------------------------------------------------------*/
add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );
function my_set_image_meta_upon_image_upload( $post_ID ) {

	// Check if uploaded file is an image, else do nothing

	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucwords( strtolower( $my_image_title ) );

		// Create an array with the image meta (Title, Caption, Description) to be updated
		// Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
		$my_image_meta = array(
			'ID'		=> $post_ID,			// Specify the image (ID) to be updated
			'post_title'	=> $my_image_title,		// Set image Title to sanitized title
			'post_excerpt'	=> $my_image_title,		// Set image Caption (Excerpt) to sanitized title
			'post_content'	=> $my_image_title,		// Set image Description (Content) to sanitized title
		);

		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );



		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );

	} 
}
