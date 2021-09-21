<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Types;

use Inc\MetaBoxes\Inc\MetaboxClass;

// add text input
new MetaboxClass(
	[
		'id'			=> 'text-metabox',
		'post_types' 	=> 'page',
		'name'			=> esc_html( 'Text field', 'mx-domain' ),
		'default' 		=> 'News & Media',
		'fields' => [
			[
				'id' => 'a_random_number',
				'name' => 'A Random Number',
				'type' => 'number',
				'std' => 5,
				'columns' => 2,
				'size' => 3,
				'graphql_name' => 'randomNumber',
				'graphql_mutate' => true
			],
		],
	]
);

// add email input
new MetaboxClass(
	[
		'id'			=> 'email-metabox',
		'post_types' 	=> 'page',
		'name'			=> esc_html( 'E-mail field', 'mx-domain' ),
		'metabox_type'	=> 'input-email',
		'fields' => [
			[
				'id' => 'a_random_number',
				'name' => 'A Random Number',
				'type' => 'number',
				'std' => 5,
				'columns' => 2,
				'size' => 3,
				'graphql_name' => 'randomNumber',
				'graphql_mutate' => true
			],
		],
	]
);

// add url input
new MetaboxClass(
	[
		'id'			=> 'url-metabox',
		'post_types' 	=> 'page',
		'name'			=> esc_html( 'URL field', 'mx-domain' ),
		'metabox_type'	=> 'input-url'
	]
);

// description
new MetaboxClass(
	[
		'id'			=> 'desc-metabox',
		'post_types' 	=> 'page',
		'name'			=> esc_html( 'Some Description', 'mx-domain' ),
		'metabox_type'	=> 'textarea'
	]
);

// add checkboxes
new MetaboxClass(
	[
		'id'			=> 'checkboxes-metabox',
		'post_types' 	=> 'page',
		'name'			=> esc_html( 'Checkbox Buttons', 'mx-domain' ),
		'metabox_type'	=> 'checkbox',
		'options' 		=> [
			[
				'value' => 'Dog',
				'checked' 	=> true
			],
			[
				'value' 	=> 'Cat'
			],
			[
				'value' 	=> 'Fish'
			]		
		]
	]
);

// add radio buttons
new MetaboxClass(
	[
		'id'			=> 'radio-buttons-metabox',
		'post_types' 	=> 'page',
		'name'			=> esc_html( 'Radio Buttons', 'mx-domain' ),
		'metabox_type'	=> 'radio',
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

// image upload
new MetaboxClass(
	[
		'id'			=> 'featured-image-metabox',
		'post_types' 	=> 'page',
		'name'			=> esc_html( 'Featured image', 'mx-domain' ),
		'metabox_type'	=> 'image'
	]
);

// video upload
new MetaboxClass(
	[
		'id'			=> 'featured-video-metabox',
		'post_types' 	=> 'page',
		'name'			=> esc_html( 'Video Upload', 'mx-domain' ),
		'metabox_type'	=> 'video',
		'context' 		=> 'side',
		'priority' 		=> 'low'
	]
);

// save HTML
new MetaboxClass(
	[
		'id'			=> 'some-html-to-save',
		'post_types' 	=> 'page',
		'name'			=> esc_html( 'Save HTML', 'mx-domain' ),
		'metabox_type'	=> 'html'
	]
);

// Document upload
new MetaboxClass(
	[
		'id'			=> 'featured-document-metabox',
		'post_types' 	=> 'documents',
		'name'			=> esc_html( 'Document Upload', 'mx-domain' ),
		'metabox_type'	=> 'document',
		'fields' => [
			[
				'id' => 'a_random_number',
				'name' => 'A Random Number',
				'type' => 'number',
				'std' => 5,
				'columns' => 2,
				'size' => 3,
				'graphql_name' => 'randomNumber',
				'graphql_mutate' => true
			],
		],
	]
);

/**
* multibox
*/
/* require MX_METABOXEX_PATH_TO_FOLDER . '/inc/multibox.php';

	$multibox = new Mx_Multibox_Class(
		[
			'id'			=> 'text-metabox-multibox',
			'post_types' 	=> 'post',
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

	$multibox->register_scrips();

	$multibox->ajax_multibox(); */




/*  lwowskiesmakimenu */