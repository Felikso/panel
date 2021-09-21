<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Inc;

use Inc\MetaBoxes\Inc\MetaboxClass;
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// metabox creating register graphql fields
class MetaboxRegisterFields {

    public static function startsWith( $haystack, $needle ) {
        $length = strlen( $needle );
        return substr( $haystack, 0, $length ) === $needle;
   }

   public static function endsWith( $haystack, $needle ) {
    $length = strlen( $needle );
    if( !$length ) {
        return true;
    }
    return substr( $haystack, -$length ) === $needle;
} //help for php before 8.0


    public static function create_select_field_array( $postMetaName, $graphqlName, $post, $options, $postSlug = null) {


        $selectOptions = array();

            foreach($options as $value ){
                $obj = [
                    'value' => $value
                ];
                array_push($selectOptions,                         
                    $obj
                );

            }

            new MetaboxClass(
                [
                    'id'			=> $postMetaName.'-metabox',
                    'post_types' 	=> $post,
                    'human_name'			=> esc_html( $postMetaName, 'mx-domain' ),
                    'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                    'metabox_type'	=> 'select',
                    'options' => $selectOptions,
                    'post_name'     => $postSlug,
                
                ]
            );

}


    public static function create_multibox_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null ) {
 
 
        new MetaboxClass(
            [
                'id'			=> $postMetaName.'-metabox',
                'post_types' 	=> $post,
                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                'post_name'     => $postSlug,
 
            ]);

}


public static function create_multi_text_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null, $limit = 10 ) {
 
        
    new MetaboxClass(
        [
            'id'			=> $postMetaName.'-metabox',
            'post_types' 	=> $post,
            'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
            'name'	        => esc_html( $graphqlName, 'mx-domain' ),
            'metabox_type'	=> 'multi-text-field',
            'post_name'     => $postSlug,
            'limit'         => $limit,
        ]);


}

public static function create_multi_dynamic_gallery_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null, $limit = 10 ) {
 
        
    new MetaboxClass(
        [
            'id'			=> $postMetaName.'-metabox',
            'post_types' 	=> $post,
            'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
            'name'	        => esc_html( $graphqlName, 'mx-domain' ),
            'metabox_type'	=> 'dynamic-gallery-image',
            'post_name'     => $postSlug,
            'limit'         => $limit,
        ]);


}

public static function create_multi_drag_drop_gallery_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null) {
 
        
    new MetaboxClass(
        [
            'id'			=> $postMetaName.'-metabox',
            'post_types' 	=> $post,
            'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
            'name'	        => esc_html( $graphqlName, 'mx-domain' ),
            'metabox_type'	=> 'multi-drag-drop-gallery',
            'post_name'     => $postSlug,
        ]);


}

public static function create_color_picker_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null ) {
    
            
        new MetaboxClass(
            [
                'id'			=> $postMetaName.'-metabox',
                'post_types' 	=> $post,
                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                'metabox_type'	=> 'color-picker',
                'post_name'     => $postSlug,
            ]);


    }

    public static function create_number_test_field_array( $postMetaName, $graphqlName, $post, $min, $max, $postSlug = null ) {
 
        
        new MetaboxClass(
            [
                'id'			=> $postMetaName.'-metabox',
                'post_types' 	=> $post,
                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                'metabox_type'	=> 'number',
                'min'  => $min,
                'step' => $max,
                'post_name'     => $postSlug,
            ]);
    

}

    public static function create_select_test_field_array($postMetaName, $graphqlName, $post, $options) {


                new MetaboxClass(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $post,
                        'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                        'metabox_type'	=> 'select',
                        'options' => $options,
                    
                    ]
                );

    }

    public static function create_button_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null, $function = null, $textButton = 'button' ) {
 
        
        new MetaboxClass(
            [
                'id'			=> $graphqlName.'-metabox',
                'post_types' 	=> $post,
                'human_name'	=> esc_html( $graphqlName, 'mx-domain' ),
                'name'	        => esc_html( $postMetaName, 'mx-domain' ),
                'post_name'     => $postSlug,
                'metabox_type'	=> 'button',
                'function'      => $function,
                'text-button'   => $textButton,
            ]);
    

}

public static function create_mixed_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null, $fieldType = 'text-input', $function = null, $textButton = 'button'  ) {
 
        
    new MetaboxClass(
        [
            'id'			=> $graphqlName.'-metabox',
            'post_types' 	=> $post,
            'human_name'	=> esc_html( $graphqlName, 'mx-domain' ),
            'name'	        => esc_html( $postMetaName, 'mx-domain' ),
            'post_name'     => $postSlug,
            'metabox_type'	=> $fieldType,
            'function'      => $function,
            'text-button'   => $textButton,
        ]);


}

    public static function create_text_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null ) {
 
        
                        new MetaboxClass(
                            [
                                'id'			=> $postMetaName.'-metabox',
                                'post_types' 	=> $post,
                                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                                'post_name'     => $postSlug,
                            ]);
                    
        
        }

        public static function create_url_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null ) {
 
        
            new MetaboxClass(
                [
                    'id'			=> $postMetaName.'-metabox',
                    'post_types' 	=> $post,
                    'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                    'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                    'metabox_type'	=> 'input-url',
                    'post_name'     => $postSlug,
                ]);
        

}
        
        public static function create_image_multiblock_test_field_array( $postMetaName, $graphqlName, $post, $objects, $postSlug = null, $fieldType = 'text-input', $function = null, $textButton = 'button'  ) {
 
            new MetaboxClass(
                [
                    'id'			=> $postMetaName . '-metabox',
                    'post_types' 	=> $post,
                    'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                    'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                    'metabox_type'	=> 'multi-block',
                                        'objects'       => $objects,
                    'post_name'     => $postSlug,
        
                ]);
    
        }

/*         public static function create_image_multiblock_test_field_array( $postMetaName, $graphqlName, $post, $objects, $postSlug = null ) {
 
            new MetaboxClass(
                [
                    'id'			=> $postMetaName . '-metabox',
                    'post_types' 	=> $post,
                    'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                    'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                    'metabox_type'	=> 'multi-block',
                                        'objects'       => $objects,
                    'post_name'     => $postSlug,
        
                ]);
    
        } */
        public static function create_image_gallery_test_field_array( $postMetaName, $graphqlName, $post, $options, $postSlug = null ) {
 
            new MetaboxClass(
                [
                    'id'			=> $postMetaName . '-metabox',
                    'post_types' 	=> $post,
                    'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                    'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                    'metabox_type'	=> 'image-gallery',
                                        'options'       => $options,
                    'post_name'     => $postSlug,
        
                ]);
        
                    
 
        
        }

    public static function create_image_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null) {
 
        
                        new MetaboxClass(
                            [
                                'id'			=> $postMetaName.'-metabox',
                                'post_types' 	=> $post,
                                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                                'metabox_type'	=> 'image',
                                'post_name'     => $postSlug,
                            ]);
                    
 
        
        }

	// textarea field array
    public static function create_textarea_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null ) {


                new MetaboxClass(
                    [
                        'id'			=> $graphqlName.'-metabox',
                        'post_types' 	=> $post,
                        'human_name'	=> esc_html( $graphqlName, 'mx-domain' ),
                        'name'	        => esc_html( $postMetaName, 'mx-domain' ),
                        'metabox_type'	=> 'textarea',
                        'post_name'     => $postSlug,
                    ]);
            
    }

    	// editor field array
        public static function create_editor_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null ) {


            new MetaboxClass(
                [
                    'id'			=> $graphqlName.'-metabox',
                    'post_types' 	=> $post,
                    'human_name'	=> esc_html( $graphqlName, 'mx-domain' ),
                    'name'	        => esc_html( $postMetaName, 'mx-domain' ),
                    'metabox_type'	=> 'editor',
                    'post_name'     => $postSlug,
                ]);
        
}

    	// html field array
        public static function create_html_test_field_array( $postMetaName, $graphqlName, $post, $postSlug = null ) {


            new MetaboxClass(
                [
                    'id'			=> $graphqlName.'-metabox',
                    'post_types' 	=> $post,
                    'human_name'	=> esc_html( $graphqlName, 'mx-domain' ),
                    'name'	        => esc_html( $postMetaName, 'mx-domain' ),
                    'metabox_type'	=> 'html',
                    'post_name'     => $postSlug,
                ]);
        
}


        // checkbox input field array
    public static function create_checkbox_test_field_array($postMetaName, $graphqlName, $checkBoxOptions,  $kind, $post, $postSlug = null  ){

                new MetaboxClass(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $post,
                        'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                        'metabox_type'	=> $kind ? $kind : "radio",
                        'options' 		=> $checkBoxOptions,
                        'post_name'     => $postSlug,
                    ]
                );


    }
 

	// text field array
    public static function create_text_field_array( $postMetaArray ) {
/*         $array = array();
        foreach($postMetaArray as $postMeta){
        array_push($array, $postMeta);
        } */
        if(is_array($postMetaArray)){
            foreach( $postMetaArray as $postMetaName=> $graphqlName ) {

                new MetaboxClass(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $post,
                        'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	    => esc_html( $graphqlName, 'mx-domain' ),
    
                    ]);
            
            }
        }

}

	// textarea field array
    public static function create_textarea_field_array( $postMetaArray ) {

                if(is_array($postMetaArray)){
                    foreach( $postMetaArray as $postMetaName=> $graphqlName ) {
        
                        new MetaboxClass(
                            [
                                'id'			=> $postMetaName.'-metabox',
                                'post_types' 	=> $post,
                                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                                'metabox_type'	=> 'textarea',
            
                            ]);
                    
                    }
                }
        
    }

    // quantity input field array
    public static function create_quantity_input_field_array( $postMetaArray, $min, $max ) {

        if(is_array($postMetaArray)){
            foreach( $postMetaArray as $postMetaName=> $graphqlName ) {

                new MetaboxClass(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $post,
                        'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                        'metabox_type'	=> 'number',
                        'min'  => $min,
                        'step' => $max,
                    
                    ]
                );
            
            }
        }
    }


        // quantity input field array
        public static function create_image_upload_field_array( $postMetaArray ) {

            if(is_array($postMetaArray)){
                foreach( $postMetaArray as $postMetaName=> $graphqlName ) {

                    new MetaboxClass(
                        [
                            'id'			=> $postMetaName.'-metabox',
                            'post_types' 	=> $post,
                            'human_name'			=> esc_html( $postMetaName, 'mx-domain' ),
                            'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                            'metabox_type'	=> 'image',
                        
                        ]
                    );
                }

            }
        }




/*         public static function create_select_field_array( $postMetaArray, $post, $options) {

            if(is_array($postMetaArray)){
                $selectOptions = array();
  
                    foreach($options as $value ){
                        $obj = [
                            'value' => $value
                        ];
                        array_push($selectOptions,                         
                            $obj
                        );
 
                    }
 
                foreach( $postMetaArray as $postMetaName=> $graphqlName ) {


                    new MetaboxClass(
                        [
                            'id'			=> $postMetaName.'-metabox',
                            'post_types' 	=> $post,
                            'human_name'			=> esc_html( $postMetaName, 'mx-domain' ),
                            'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                            'metabox_type'	=> 'select',
                            'options' => $selectOptions
                        
                        ]
                    );
                }
    
            }
        } */
    // checkbox input field array
   /*  public static function create_checkbox_field_array( $postMetaArray, $options, $kind ){

        if(is_array($postMetaArray)){
            foreach( $postMetaArray as $postMetaName=> $graphqlName ) {

                    $checkBoxOptions = array();

                    foreach($options as $value => $checked){
                        $obj = [
                            'value' => $value,
                            'checked' 	=> $checked
                        ];
                        array_push($checkBoxOptions,                         
                            $obj
                        );
                    }

                new MetaboxClass(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $post,
                        'human_name'			=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                        'metabox_type'	=> $kind ? $kind : "radio",
                        'options' 		=> $checkBoxOptions

                    ]
                );

            }

    } */ //TODO checkbox for mutliplay


/*     public static function create_select_field_array( $postMetaArray, $post ){

        if(is_array($postMetaArray)){
            foreach( $postMetaArray as $postMetaName=> $graphqlName ) {
                $selectOptions = array();
                foreach( $postMetaArray as $postMetaName => $graphqlName ){

                        $obj = [
                            'value' => $postMetaName
                        ];
                        array_push($selectOptions,                         
                            $obj
                        );
                }

                // add one choose
                new MetaboxClass(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $post,
                        'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'      	=> esc_html( $graphqlName, 'mx-domain' ),
                        'metabox_type'	=> 'select',
                        'options' 		=> $selectOptions
                    ]
                );

            }

        }  

    } */
 

            // file attachment input field array
            public static function create_file_attachment_field_array($postMetaArray, $maxSize ){

                if(is_array($postMetaArray)){
                    foreach( $postMetaArray as $postMetaName=> $graphqlName ) {
    
                        new MetaboxClass(
                            [
                                'id'			=> $postMetaName.'-metabox',
                                'post_types' 	=> $post,
                                'human_name'			=> esc_html( $postMetaName, 'mx-domain' ),
                                'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                                'metabox_type'	=> 'file',
                                'max_file_size' => isset($maxSize) ? $maxSize : '1mb',
                                'mutiple'		=> false,
                            ]
                        );
    
                    }
                }
            }
}
