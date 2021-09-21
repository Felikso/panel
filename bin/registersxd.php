<?php 


add_action( 'init', 'init_meta_field');
function init_meta_field(){






$dirName = (array_filter(glob(dirname(__FILE__).'/*'), 'is_file'));

$dir = basename(__FILE__);

global $postName;
global $postMetaArray;
global $postMeta;
/* $postName = str_replace('.php', '', $dir); */
$postName = 'lwowskiesmakimenu';
$postMetaArray = array(
	'name',
	'price', 
	'test',
	'another'
);

foreach( $postMetaArray as $postMeta) {
	new Mx_Metaboxes_Class(
		[
			'id'			=> $postMeta.'-metabox',
			'post_types' 	=> $postName,
			'name'			=> esc_html( $postMeta, 'mx-domain' ),
		]);

}



			global $postName;
			global $postMeta;
			
			foreach( $postMetaArray as $postMeta) {

/* 				register_graphql_field( 'lwowskiesmakimenu', 'tessst', [
					'type' => 'String',
					'description' => __( 'Nazwa produktu', 'wp-graphql' ),
					'resolve' => function( $post ) {
					  $names = get_post_meta( $post->ID, '_mx_name-metabox_lwowskiesmakimenu_id', true );
					  return ! empty( $names ) ? $names : 0;
					}
				 ] ); */

/* 					echo '<script>';
					echo 'console.log('. json_encode('_mx_another-metabox_lwowskiesmakimenu_id', JSON_HEX_TAG) .')';
					echo '</script>'; //singular graphql name

					
					echo '<script>';
					echo 'console.log('. json_encode('_mx_'.$postMeta.'-metabox_'.$postName.'_id', JSON_HEX_TAG) .')';
					echo '</script>'; //singular graphql name */



/* 				register_graphql_field( $postName, $postMeta, [
					'type' => 'String',
					'description' => __( $postMeta, 'wp-graphql' ),
					'resolve' => function( $post  ) {
						global $postName;

						$post_meta_boxes =  get_post_meta(get_posts([
							'post_type' => $postName['graphql_single_name']
						  ])[0]->ID); */
						/* global $postMeta; */
/* 						echo '<script>';
						echo 'console.log('. json_encode('xxxx', JSON_HEX_TAG) .')';
						echo '</script>'; //singular graphql name

						echo '<script>';
						echo 'console.log('. json_encode('_mx_'.$postMeta.'-metabox_'.$postName.'_id', JSON_HEX_TAG) .')';
						echo '</script>'; //singular graphql name */
/* 						$array = array(
							'_mx_name-metabox_lwowskiesmakimenu_id',
							'_mx_price-metabox_lwowskiesmakimenu_id',
							'_mx_test-metabox_lwowskiesmakimenu_id',
							'_mx_another-metabox_lwowskiesmakimenu_id'
						);

						

						foreach( $array as $item ) {

								$names = get_post_meta( $post->ID, $item, true );
								
							return $names;
							
							foreach( $names as $name ){
								return $name;
							}
						}

					}
				 ] );
				} */
		

	

}}


/* echo '<script>';
echo 'console.log('. json_encode($postName  , JSON_HEX_TAG) .')';
echo '</script>'; */

/* new Mx_Metaboxes_Class(
	[
		'id'			=> 'name-metabox',
		'post_types' 	=> $postName,
		'name'			=> esc_html( 'name', 'mx-domain' ),
    ]);


add_action( 'graphql_register_types', function() {

	global $postName;
	

		register_graphql_field( $postName, 'test', [
			'type' => 'String',
			'description' => __( 'Nazwa produktu', 'wp-graphql' ),
			'resolve' => function( $post ) {
			  $names = get_post_meta( $post->ID, '_mx_name-metabox_lwowskiesmakimenu_id', true );
			  return ! empty( $names ) ? $names : 0;
			}
		 ] );


}); */

// add name input
/* new Mx_Metaboxes_Class(
	[
		'id'			=> 'name-metabox',
		'post_types' 	=> $postName,
		'name'			=> esc_html( 'name', 'mx-domain' ),
    ]
	
);




// add quantity input
new Mx_Metaboxes_Class(
	[
		'id'			=> 'price-metabox',
		'post_types' 	=> $postName,
		'name'			=> esc_html( 'cena', 'mx-domain' ),
        'metabox_type'	=> 'number',
        'min'  => 0,
        'step' => 100,
    
    ]
);

// add one choose currency
new Mx_Metaboxes_Class(
	[
		'id'			=> 'currency-buttons-metabox',
		'post_types' 	=> $postName,
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
new Mx_Metaboxes_Class(
	[
		'id'			=> 'quantity-metabox',
		'post_types' 	=> $postName,
		'name'			=> esc_html( 'ilość', 'mx-domain' ),
        'metabox_type'	=> 'number',
        'min'  => 0,
        'step' => 20,
    
    ]
);

// add one choose measure
new Mx_Metaboxes_Class(
	[
		'id'			=> 'measure-buttons-metabox',
		'post_types' 	=> $postName,
		'name'			=> esc_html( 'miara', 'mx-domain' ),
		'metabox_type'	=> 'radio',
		'options' 		=> [
			[
				'value' => 'szt',
                'checked' 	=> true
			],
			[
				'value' => 'ml'
			]			
		]
	]
);


// add image upload
new Mx_Metaboxes_Class(
	[
		'id'			=> 'image-metabox',
		'post_types' 	=> $postName,
		'name'			=> esc_html( 'zdjęcie', 'mx-domain' ),
		'metabox_type'	=> 'file',
        'max_file_size' => '1mb'
	]
);


// add image file attachment
new Mx_Metaboxes_Class(
	[
		'id'			=> 'file-metabox',
		'post_types' 	=> $postName,
		'name'			=> esc_html( 'obrazek', 'mx-domain' ),
		'metabox_type'	=> 'file',
        'max_file_size' => '1mb',
		'mutiple'		=> false,
	]
);






// add one choose
new Mx_Metaboxes_Class(
	[
		'id'			=> 'kind-buttons-metabox',
		'post_types' 	=> $postName,
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
);
 */

/**
* multibox
*/

/* define( 'VW_CUSTOM_CLIENTS_PANEL_PATH', plugin_dir_path( __FILE__ ) ); */
/* 
require VW_CUSTOM_CLIENTS_PANEL_PATH . '/inc/multibox.php';

	$multibox = new Mx_Multibox_Class(
		[
			'id'			=> 'text-metabox-multibox',
			'post_types' 	=> $postName,
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