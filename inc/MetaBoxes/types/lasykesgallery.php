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

class lasykesgallery extends MetaboxRegisterFields
{

    public $dir;
    
    public $post; 


    public static function register(){

        $dir = basename(__FILE__);
        $post = str_replace('.php', '', $dir);

        $gallery_items_object = [
            [
                'title' => [
                    'Zdjęcie' => 'item_1',
                ],
                'objects' 		=> [
        
                            [
                                'title' => [
                                    'podpis do zdjęcia' => 'title',
                                ],
                                'type' => [
                                    'input-text',
                                ],
                                'field' => [
                                    'title',
                               ],
                            ],
        
                            [
                                'title' => [
                                    'icon',
                                ],
                                'type' => [
                                     'image',
                                ],
                                'field' => [
                                    'icon',
                               ],
                            ],
        
                        ],
               
            ],
        
        ];
        
        
         foreach($gallery_items_object as $graph_field => $object) {
            $graph_field = key((array)$object['title']);
        
            self::create_image_multiblock_test_field_array(
                $object['title'][$graph_field],
                $graph_field,
                $post,
                $object['objects'],
            );
        }

 
        
    }
}

lasykesgallery::register();


