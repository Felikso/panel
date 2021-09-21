<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Types;

use Inc\MetaBoxes\Inc\MetaboxClass;
/* use Inc\MetaBoxes\Inc\MultiMetaBox; */
/* Defaut cheat template */

/* 
$post_type = 'none';

// add name input
new MetaboxClass(
	[
		'id'			=> 'name-metabox',
		'post_types' 	=> $post_type,
		'name'			=> esc_html( 'nazwa', 'mx-domain' ),
    ]
);

// add quantity input
new MetaboxClass(
	[
		'id'			=> 'price-metabox',
		'post_types' 	=> $post_type,
		'name'			=> esc_html( 'cena', 'mx-domain' ),
        'metabox_type'	=> 'number',
        'min'  => 0,
        'step' => 100,
    
    ]
);

// add one choose currency
new MetaboxClass(
	[
		'id'			=> 'currency-buttons-metabox',
		'post_types' 	=> $post_type,
		'name'			=> esc_html( 'waluta', 'mx-domain' ),
		'metabox_type'	=> 'radio',
		'options' 		=> [
			[
				'value' => 'pln',
                'checked' 	=> true
			],
			[
				'value' => 'euro'
			]			
		]
	]
);

// add quantity input
new MetaboxClass(
	[
		'id'			=> 'quantity-metabox',
		'post_types' 	=> $post_type,
		'name'			=> esc_html( 'ilosc', 'mx-domain' ),
        'metabox_type'	=> 'number',
        'min'  => 0,
        'step' => 20,
    
    ]
);

// add one choose measure
new MetaboxClass(
	[
		'id'			=> 'radio-buttons-metabox',
		'post_types' 	=> $post_type,
		'name'			=> esc_html( 'Radio Buttons', 'mx-domain' ),
		'metabox_type'	=> 'checkbox',
		'options' 		=> [
			[
				'value' => 'red'
			],
			[
				'value' => 'green'
			],
			[
				'value' 	=> 'Yellow',
				'checked' 	=> true
			]		
		]
	]
);

// add image upload
new MetaboxClass(
	[
		'id'			=> 'image-metabox',
		'post_types' 	=> $post_type,
		'name'			=> esc_html( 'zdjęcie', 'mx-domain' ),
		'metabox_type'	=> 'file',
        'max_file_size' => '1mb'
	]
);


// add image file attachment
new MetaboxClass(
	[
		'id'			=> 'file-metabox',
		'post_types' 	=> $post_type,
		'name'			=> esc_html( 'obrazek', 'mx-domain' ),
		'metabox_type'	=> 'file',
        'max_file_size' => '1mb',
		'mutiple'		=> false,
	]
);






// add one choose
new MetaboxClass(
	[
		'id'			=> 'kind-buttons-metabox',
		'post_types' 	=> ['post'],
		'name'			=> esc_html( 'rodzaj', 'mx-domain' ),
		'metabox_type'	=> 'select',
		'options' 		=> [
			[
				'value' => 'danie główne'
			],
			[
				'value' => 'zupy'
			],
			[
				'value' 	=> 'napoje'
				
            ],
            [
				'value' 	=> 'dodatki'
				
			]			
		]
	]
); */



/**
* multibox
*/

/*  define( 'VW_CUSTOM_CLIENTS_PANEL_PATH', plugin_dir_path( __FILE__ ) );  */
 
/* require VW_CUSTOM_CLIENTS_PANEL_PATH . '/inc/multibox.php'; */

/* 	$multibox2 = new MultiMetaBox(
		[
			'id'			=> 'text-metabox-multibox',
			'post_types' 	=> ['post'],
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