<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Types;

use Inc\MetaBoxes\Inc\MetaboxClass;
use Inc\MetaBoxes\Inc\MetaboxRegisterFields;
use Inc\MetaBoxes\Inc\MultiMetaBox;

/**
* 
*/

$dir = basename(__FILE__);
$post = str_replace('.php', '', $dir);

$lasykesmenu = new MetaboxRegisterFields();


 //TEXT FIELD ARRAY

$text_field_object = array(
    [
        'title' => [
            'product-name' => 'nazwa produktu',
        ]
    ],

);


    foreach($text_field_object as $object) {
        $graph_field = key((array)$object['title']);
        $lasykesmenu->create_text_test_field_array(
            $graph_field,
            $object['title'][$graph_field],
            $post,
        );
};
 



 //NUMBER FIELD ARRAY

 $number_field_object = array(
    [
       'title' => [
           'price' => 'cena',
       ],
       'min' => [
        'min' => '1',
       ],
       'max' => [
        'max' => '100',
       ],
    ],
    [
        'title' => [
            'quantity' => 'ilość',
        ],
        'min' => [
         'min' => '1',
        ],
        'max' => [
         'max' => '500',
        ],
    ],
           
   );
   
   foreach($number_field_object as $object){
       $graph_field = key((array)$object['title']);
       $min_field = key((array)$object['min']);
       $max_field = key((array)$object['max']);
       $lasykesmenu->create_number_test_field_array(
           $graph_field,
           $object['title'][$graph_field],
           $post,
           $object['min'][$min_field],
           $object['max'][$max_field],
   
       );
   };

//SELECT FIELD ARRAY

 $select_field_object = array(
    [
        'title' => [
            'menu-category' => 'kategoria dań',
        ],
        'options' => [
            'danie główne',
            'zupy',
            'dodatki',
            'napoje'
        ]
    ],
    [
        'title' => [
            'measure' => 'miara',
        ],
        'options' => [
            'szt',
            'ml',
            'g'
        ]
    ],
        
);

foreach($select_field_object as $object){
    $graph_field = key((array)$object['title']);
    $lasykesmenu->create_select_field_array(
        $graph_field,
        $object['title'][$graph_field],
        $post,
        $object['options'],

    );
};

//TEXTAREA FIELD ARRAY

$text_area_object = [
    [
        'title' => [
            'components' => 'składniki',
        ]
    ],
    
 ];

    foreach($text_area_object as $object) {
        $graph_field = key((array)$object['title']);
        $lasykesmenu->create_textarea_test_field_array(
            $object['title'][$graph_field],
            $graph_field,
            $post,
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
				'value' => 'wegetariański',
			],
			[
				'value' => 'promocja',
                'checked' 	=> true
            ],
            [
				'value' => 'bio',
			],
            [
				'value' => 'fit',
                'checked' 	=> true
			],
            [
				'value' => 'zestaw',
			],		
		]
     ]      
 ];

 foreach($checkbox_field_array as $field => $object) {
    $field = key((array)$object['title']);

 
    $lasykesmenu->create_checkbox_test_field_array(
        $field,
        $object['title'][$field],
        $object['options'],
        $object['type']['field'],
        $post
    );
 };

 //GALLERY FIELD ARRAY
 
/*  $multiblock_object = [
    [
        'title' => [
            'Sekcja kontakt' => 'multi-block',
        ],
        'objects' 		=> [


                    [
                        'title' => [
                            'name' => 'custom-name',
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
                            'nazwisko' => 'custom-subname',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'subname',
                       ],
                    ],

                    [
                        'title' => [
                            'email' => 'email',
                        ],
                        'type' => [
                             'input-email',
                        ],
                        'field' => [
                            'email',
                       ],
                    ],

                    [
                        'title' => [
                            'galeria' => 'custom-gallery',
                        ],
                        'type' => [
                             'image',
                        ],
                        'field' => [
                            'logo',
                       ],
                    ],



                ],
       
    ],
 
];


 foreach($multiblock_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    $lasykesmenu->create_image_multiblock_test_field_array(
        $graph_field,
        $object['title'][$graph_field],
        $post,
        $object['objects'],
    );

 }; */


 //GALLERY FIELD ARRAY
 
 $gallery_object = [
    [
        'title' => [
            'gallery' => 'galeria produktu',
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

/*  new MetaboxClass(
    [
        'id'			=> '$postMetaName' . '-metabox',
        'post_types' 	=> 'lasykesmenu',
        'human_name'	=> esc_html( '$postMetaName', 'mx-domain' ),
        'name'	        => esc_html( '$graphqlName', 'mx-domain' ),
        'post_name'     => null,

    ]);

    $multibox2 = new MultiMetaBox(
		[
			'id'			=> 'textxx-metabox-multibox',
			'post_types' 	=> 'lasykesmenu',
			'name'			=> esc_html( 'MultiBox', 'mx-domain' ),
			'blocks' 		=> [

				// block 1
				'block_1' 		=> [
					[ 'section_name' => 'Some section' ],
					[
						'type' => 'input-text',
						'label' => esc_html( 'Enter Title', 'mx-domain' ),
					],
					[
						'type' => 'textarea',
						'label' => esc_html( 'Enter the text', 'mx-domain' ),
					]
				],

				// block 2
				'block_2' 		=> [
					[ 'section_name' => 'Some section 2' ],
					[
						'type' => 'input-text',
						'label' => esc_html( 'Enter Title 2', 'mx-domain' ),
					]
				]

			]
			
		]
	);

	$multibox2->register_scrips();

	$multibox2->ajax_multibox();  */

 foreach($gallery_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    $lasykesmenu->create_image_gallery_test_field_array(
        $graph_field,
        $object['title'][$graph_field],
        $post,
        $object['options'],
    );
 };
 
//IMAGE FIELD ARRAY

$image_object = [
    [
        'title' => [
            'main-image' => 'zdjęcie główne',
        ]
    ],
    
 ];

    foreach($image_object as $object) {
        $graph_field = key((array)$object['title']);
        $lasykesmenu->create_image_test_field_array(
            $graph_field,
            $object['title'][$graph_field],
            $post,
        );
 };

 foreach($image_object as $object) {
    $graph_field = key((array)$object['title']);
    $lasykesmenu->create_image_test_field_array(
        $graph_field,
        $object['title'][$graph_field],
       'post'
    );
};


