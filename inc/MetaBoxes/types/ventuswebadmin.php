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

/*
Assumed that fields datas:

0 - name
1 - graphql
2 - post
3 - slug

*/

class ventuswebadmin extends MetaboxRegisterFields
{

    public $dir;
    
    public $post; 

    public $postSlug;

    public $adminPath;

    public $adminPage;
    
    public $arrayToSearch;
    

    public static function register(){

        $dir = basename(__FILE__);

        $post = str_replace('.php', '', $dir);

        $postSlug = null;

        $adminPath = 'main-admin';

        $adminPage = get_page_by_path($adminPath, OBJECT, $post);
    



/**
 *  Menu Section
 */
 

/**
 *  Initial Section
 */
 

// Fields Manager
 
$text_fields_items_object = [
    [
        'title' => [
            'Fields Manager' => 'fields-manager',
        ],
        'objects' 		=> [

                    [
                        'title' => [
                            'Field Name' => 'field-name',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'field-name',
                       ],
                    ],

                    [
                        'title' => [
                            'Field GraphQl Name' => 'graphql-name',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'graphql-name',
                       ],
                    ],

                    [
                        'title' => [
                            'Post Name' => 'post-name',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'post-name',
                       ],
                    ],

                    [
                        'title' => [
                            'Slug' => 'post-slug',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'post-slug',
                       ],
                    ],

 

                    [
                        'title' => [
                            'przycisk' => 'button-name',
                        ],
                        'type' => [
                             'button',
                        ],
                        'field' => [
                            'button-name',
                       ],
                    ],
 
                ],
       
    ],

    [
        'title' => [
            'Fields Manager' => 'fields-manager2',
        ],
        'objects' 		=> [

                    [
                        'title' => [
                            'Field Name' => 'field-name',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'field-name',
                       ],
                    ],

                    [
                        'title' => [
                            'Field GraphQl Name' => 'graphql-name',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'graphql-name',
                       ],
                    ],

                    [
                        'title' => [
                            'Post Name' => 'post-name',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'post-name',
                       ],
                    ],

                    [
                        'title' => [
                            'Slug' => 'post-slug',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'post-slug',
                       ],
                    ],


 
                ],
       
    ],





 
];


 foreach($text_fields_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_image_multiblock_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        $postSlug
    );

}



// Fields Manager

//Color Picker test

$text_area_object = [
    [
        'title' => [
            'picker' => 'wybierz kolor',
        ]
    ],
    
 ];

    foreach($text_area_object as $object) {
        $graph_field = key((array)$object['title']);
        self::create_color_picker_test_field_array(
            $graph_field,
            $object['title'][$graph_field],
            $post,
            null,
        );
 };
 

//TEXTAREA FIELD ARRAY

$text_area_object = [
    [
        'title' => [
            'components' => 'skladniki',
        ]
    ],
    
 ];

    foreach($text_area_object as $object) {
        $graph_field = key((array)$object['title']);
        self::create_multi_text_test_field_array(
            $graph_field,
            $object['title'][$graph_field],
            $post,
            [$adminPath],
            8
        );
 };
 

 foreach($text_fields_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_multi_text_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        [$postSlug],

    );

}

// Fields Manager
 
$text_fields_items_object = [
    [
        'title' => [
            'Fields Manager' => 'fields-manager3',
        ],
        'objects' 		=> [

                    [
                        'title' => [
                            'Field GraphQl Name' => 'graphql-name',
                        ],
                        'type' => [
                             'input-text',
                        ],
                        'field' => [
                            'graphql-name',
                       ],
                    ],
 
                ],
       
    ],






 
];


 foreach($text_fields_items_object as $graph_field => $object) {
    $graph_field = key((array)$object['title']);

    self::create_image_multiblock_test_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['objects'],
        [$postSlug],
 
    );

}

if($adminPage) {




    $arrayToSearch = get_post_meta($adminPage->ID);

    $keyword = $post; //keyword is the name of post so name of this file

    $array = array(); //array for all metaboxes datas fields

    $mainFieldArray = array(); //array only for main metaboxes datas fields

    if($arrayToSearch) {
        if($arrayToSearch) {
            foreach($arrayToSearch as $key => $arrayItem){
    
                if( stristr( $key, $keyword ) ){
        
                    $array[$key] = $arrayItem; //create array with metaboxes datas
                }
        
            }
        }
    
    }



    foreach($array as $key => $arrayItem){

        $lengh = strlen($key);

        $searchWord = 'id';



        if( (strrpos($key,  $searchWord)) ==  ($lengh - strlen($searchWord)) ){
            $mainFieldArray[$key] = $arrayItem;
/*             echo '<script>';
            echo 'console.log('. json_encode($key, JSON_HEX_TAG) .')';
            echo '</script>'; */
        }else {
/*             echo '<script>';
            echo 'console.log('. json_encode('$key', JSON_HEX_TAG) .')';
            echo '</script>';   */
        }

    }

    foreach ( $mainFieldArray as $mainKey => $mainFieldItem ) {
        $boxArray = array();
        foreach ( $array as $arrayKey => $arrayFieldItem ) {
            $keyLengh = strlen($mainKey);

            
            if ( self::startsWith( $arrayKey, $mainKey )) {
                $boxArray[$arrayKey] = $arrayFieldItem;  //create custom array for metaboxes datas
            }

        }

        $name;
        $graphql;
        $post;
        $slug;

        foreach ( $boxArray as $fieldName => $boxItem ) {
            $fieldValue = $boxItem[0];
            if ( empty($fieldValue) ) {
                $fieldValue = null;
            }
            if (self::endsWith($fieldName, '0')) {
                $name = $fieldValue;
            }

            if (self::endsWith($fieldName, '1')) {
                $graphql = $fieldValue;
            }

            if (self::endsWith($fieldName, '2')) {
                $post = $fieldValue;
            }

            if (self::endsWith($fieldName, '3')) {
                $slug = $fieldValue;


            }

        }


 
        self::create_text_test_field_array(
            $name,
            $graphql,
            $post,
            $slug
             
        );
/*         echo '<script>';
        echo 'console.log('. json_encode($name, JSON_HEX_TAG) .')';
        echo '</script>';

        echo '<script>';
        echo 'console.log('. json_encode($graphql, JSON_HEX_TAG) .')';
        echo '</script>';

        echo '<script>';
        echo 'console.log('. json_encode($post, JSON_HEX_TAG) .')';
        echo '</script>';

        echo '<script>';
        echo 'console.log('. json_encode($slug, JSON_HEX_TAG) .')';
        echo '</script>'; */
/*         self::create_image_multiblock_test_field_array(
            $mainFieldItem['title'][$graph_field],
            $graph_field,
            $post,
            $mainFieldItem['objects'],
            $postSlug
        ); */



    }


 

    // Function to check the string is ends
    // with given substring or not

    
    // Driver code
   /*  if(endsWith("abcde","de"))
        echo "True";
    else
        echo "False"; */

    

    $foo = "0123456789a123456789b123456789c";

    $string = '1234 test';
    $txtToFind = 'test';

 
    $len = strlen($string);

 
    
    $pos= strpos($string,$txtToFind);
/* 
    public function endsWith($string, $endString)
    {
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }
        return (substr($string, -$len) === $endString);
    } */


    

/*     echo '<script>';
    echo 'console.log('. json_encode(endsWith("abcde","de"), JSON_HEX_TAG) .')';
    echo '</script>'; */



   /*  $names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );
 */



}
        
    }


}

ventuswebadmin::register();


