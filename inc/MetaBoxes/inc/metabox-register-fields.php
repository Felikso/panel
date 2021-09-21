<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// metabox creating register graphql fields
class Mx_Metaboxes_Register_Fields
{
    public $post;
    function __construct() {
        $dir = basename(__FILE__);

        $post = str_replace('.php', '', $dir);
        $this->post = $post;

        echo '<script>';
        echo 'console.log('. json_encode( '$this->post'  , JSON_HEX_TAG) .')';
        echo '</script>';

      }

    function create_select_test_field_array($postMetaName, $graphqlName, $options) {


                new Mx_Metaboxes_Class(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $this->post,
                        'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                        'metabox_type'	=> 'select',
                        'options' => $options,
                    
                    ]
                );

    }

    function create_text_test_field_array( $postMetaName, $graphqlName ) {
 
        
                        new Mx_Metaboxes_Class(
                            [
                                'id'			=> $postMetaName.'-metabox',
                                'post_types' 	=> $this->post,
                                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                            ]);
                    
 
        
        }

        function create_image_gallery_test_field_array( $human_name, $graph_name, $post, $options ) {
 
            new Mx_Metaboxes_Class(
                [
                    'id'			=> $graph_name . '-metabox',
                    'post_types' 	=> $post,
                    'human_name'	=> esc_html( $human_name, 'mx-domain' ),
                    'name'	        => esc_html( $graph_name, 'mx-domain' ),
                    'metabox_type'	=> 'image-gallery',
                                        'options'       => $options,
        
                ]);
        
/*                         new Mx_Metaboxes_Class(
                            [
                                'id'			=> $postMetaName.'-metabox',
                                'post_types' 	=> $this->post,
                                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                                'metabox_type'	=> 'image-gallery',
                                'options'       => $options,

                            ]); */
                    
 
        
        }

    function create_image_test_field_array( $postMetaName, $graphqlName ) {
 
        
                        new Mx_Metaboxes_Class(
                            [
                                'id'			=> $postMetaName.'-metabox',
                                'post_types' 	=> $this->post,
                                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                                'metabox_type'	=> 'image',

                            ]);
                    
 
        
        }

	// textarea field array
    function create_textarea_test_field_array( $postMetaName, $graphqlName ) {


                new Mx_Metaboxes_Class(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $this->post,
                        'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                        'metabox_type'	=> 'textarea',
    
                    ]);
            
    }

        // checkbox input field array
    function create_checkbox_test_field_array($postMetaName, $graphqlName, $checkBoxOptions,  $kind ){

                new Mx_Metaboxes_Class(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $this->post,
                        'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                        'metabox_type'	=> $kind ? $kind : "radio",
                        'options' 		=> $checkBoxOptions

                    ]
                );


    }
 

	// text field array
    function create_text_field_array( $postMetaArray ) {
/*         $array = array();
        foreach($postMetaArray as $postMeta){
        array_push($array, $postMeta);
        } */
        if(is_array($postMetaArray)){
            foreach( $postMetaArray as $postMetaName=> $graphqlName ) {

                new Mx_Metaboxes_Class(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $this->post,
                        'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	    => esc_html( $graphqlName, 'mx-domain' ),
/*                         'default' 		=> $default, */
    
                    ]);
            
            }
        }

}

	// textarea field array
    function create_textarea_field_array( $postMetaArray ) {

                if(is_array($postMetaArray)){
                    foreach( $postMetaArray as $postMetaName=> $graphqlName ) {
        
                        new Mx_Metaboxes_Class(
                            [
                                'id'			=> $postMetaName.'-metabox',
                                'post_types' 	=> $this->post,
                                'human_name'	=> esc_html( $postMetaName, 'mx-domain' ),
                                'name'	        => esc_html( $graphqlName, 'mx-domain' ),
                                'metabox_type'	=> 'textarea',
            
                            ]);
                    
                    }
                }
        
    }

    // quantity input field array
    function create_quantity_input_field_array( $postMetaArray, $min, $max ) {

        if(is_array($postMetaArray)){
            foreach( $postMetaArray as $postMetaName=> $graphqlName ) {

                new Mx_Metaboxes_Class(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $this->post,
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
        function create_image_upload_field_array( $postMetaArray ) {

            if(is_array($postMetaArray)){
                foreach( $postMetaArray as $postMetaName=> $graphqlName ) {

                    new Mx_Metaboxes_Class(
                        [
                            'id'			=> $postMetaName.'-metabox',
                            'post_types' 	=> $this->post,
                            'human_name'			=> esc_html( $postMetaName, 'mx-domain' ),
                            'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                            'metabox_type'	=> 'image',
                        
                        ]
                    );
                }

            }
        }

        function create_select_field_array( $postMetaArray, $options) {

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


                    new Mx_Metaboxes_Class(
                        [
                            'id'			=> $postMetaName.'-metabox',
                            'post_types' 	=> $this->post,
                            'human_name'			=> esc_html( $postMetaName, 'mx-domain' ),
                            'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                            'metabox_type'	=> 'select',
                            'options' => $selectOptions
                        
                        ]
                    );
                }
    
            }
        }
    // checkbox input field array
   /*  function create_checkbox_field_array( $postMetaArray, $options, $kind ){

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

                new Mx_Metaboxes_Class(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $this->post,
                        'human_name'			=> esc_html( $postMetaName, 'mx-domain' ),
                        'name'	=> esc_html( $graphqlName, 'mx-domain' ),
                        'metabox_type'	=> $kind ? $kind : "radio",
                        'options' 		=> $checkBoxOptions

                    ]
                );

            }

    } */ //TODO checkbox for mutliplay


/*     function create_select_field_array( $postMetaArray, $post ){

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
                new Mx_Metaboxes_Class(
                    [
                        'id'			=> $postMetaName.'-metabox',
                        'post_types' 	=> $this->post,
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
            function create_file_attachment_field_array($postMetaArray, $maxSize ){

                if(is_array($postMetaArray)){
                    foreach( $postMetaArray as $postMetaName=> $graphqlName ) {
    
                        new Mx_Metaboxes_Class(
                            [
                                'id'			=> $postMetaName.'-metabox',
                                'post_types' 	=> $this->post,
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
