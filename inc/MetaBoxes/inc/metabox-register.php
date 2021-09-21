<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// metabox creating main class
class Mx_Metaboxes_Register_Fields
{

	public $postMetaArray = [];


	// add post meta
    function create_text_field_array(...$postMetaArray){
        $array = array();
        foreach($postMetaArray as $postMeta){
        array_push($array, $postMeta);
        }
        return $array;
        }
        
}


	// add post meta
    function map_elements(...$postMetaArray){
        foreach( $postMetaArray as $postMeta) {
            new MetaboxClass(
                [
                    'id'			=> $postMeta.'-metabox',
                    'post_types' 	=> $postName,
                    'name'			=> esc_html( $postMeta, 'mx-domain' ),
                ]);
        
        }
        
}