<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Classes;

use Inc\MetaBoxes\Inc\MetaboxClass;
use Inc\MetaBoxes\Inc\MetaboxRegisterFields;

/**
* 
*/

class lasykesgallery extends MetaboxRegisterFields
{
	public function register()
    {
        $text_field_object = array(
            [
                'title' => [
                    'text-headerr' => 'tekst nagłówka',
                ]
            ],
            [
                'title' => [
                    'section-titlee' => 'tytuł sekcjsdffdi',
                ]
            ],
        
        );
        
            foreach($text_field_object as $object) {
                $graph_field = key((array)$object['title']);
                $lasykesmain->create_text_test_field_array(
                    $graph_field,
                    $object['title'][$graph_field],
                    'lasykesgallery',
                );
        };
        
    }
}