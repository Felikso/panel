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

$dir = basename(__FILE__);
$post = str_replace('.php', '', $dir);

$main = new MetaboxRegisterFields();

$text_field_array = [
    'section-title' => 'tytuł sekcji'
    
 ];//simply add another field

 foreach($text_field_array as $field => $graph_field) {
    $main->create_text_test_field_array(
        $field,
        $graph_field,
        $post
    );
 };



 //TEXT FIELD ARRAY

$text_field_array = [
    'section-title2' => 'tytuł sekcji'
    
 ];

 foreach($text_field_array as $field => $graph_field) {
    $main->create_text_test_field_array(
        $field,
        $graph_field,
        $post
    );
 };

//SELECT FIELD ARRAY

 $select_field_object = array(
 [
    'title' => [
        'sweets' => 'rodzaj słodyczy',
    ],
    'options' => [
        'galaretki',
        'cukierki',
        'lizaki'
    ]
    ],
    [
        'title' => [
            'dish-type' => 'kategoria dań',
        ],
        'options' => [
            'danie główne',
            'zupy',
            'napoje'
        ]
    ],
    [
        'title' => [
            'dish-type' => 'kategoria zup',
        ],
        'options' => [
            'warzywne',
            'mięsne',
            'owocowe'
        ]
     ]
        
);

foreach($select_field_object as $object){
    $graph_field = key((array)$object['title']);
    $main->create_select_field_array(
        $object['title'][$graph_field],
        $graph_field,
        $post,
        $object['options'],

    );
};

//TEXTAREA FIELD ARRAY

$textarea_field_array = [
    'main-content' => 'główny kontent test',
    'main-content2' => 'główny kontent test2'
    
 ];

 foreach($textarea_field_array as $field => $graph_field) {
    $main->create_textarea_test_field_array(
        $field,
        $graph_field,
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
            'colors' => 'kolory',
        ],
        'type' => [
            'field' => 'checkbox',
        ],
        'options' 		=> [
			[
				'value' => 'żółty',
			],
			[
				'value' => 'pomarańczowy',
                'checked' 	=> true
            ],
            [
				'value' => 'zielony',
			],
            [
				'value' => 'beżowy',
                'checked' 	=> true
			],			
		]
     ]      
 ];

 foreach($checkbox_field_array as $field => $object) {
    $field = key((array)$object['title']);

 
    $main->create_checkbox_test_field_array(
        $field,
        $object['title'][$field],
        $object['options'],
        $object['type']['field'],
        $post
    );
 };

//to do leter

/*  class Main extends MetaboxRegisterFields 
 {

    function __construct() {
        $dir = basename(__FILE__);

        $post = str_replace('.php', '', $dir);
        $this->post = $post;

        echo '<script>';
        echo 'console.log('. json_encode( '$xxxx->post'  , JSON_HEX_TAG) .')';
        echo '</script>';

      }


    public $text_field_array;


	public function register()
	{
        $text_field_array = [
            'section-title' => 'tytuł sekcji'
            
         ];

         foreach($text_field_array as $field => $graph_field) {
            $main->create_text_test_field_array(
                $field,
                $graph_field
            );
         };
         
		$this->test();



	}

}
 */


