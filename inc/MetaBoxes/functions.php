<?php

define( 'VW_CUSTOM_CLIENTS_PANEL_PATH', plugin_dir_path( __FILE__ ) );

define( 'VW_CUSTOM_POST_TYPES_PATH', plugin_dir_path( __FILE__ ) );

require VW_CUSTOM_CLIENTS_PANEL_PATH.'inc/metabox-init.php';

require VW_CUSTOM_CLIENTS_PANEL_PATH . 'graphql/ImageUploader.php';

//adding all meta types from directory

$filePath = VW_CUSTOM_CLIENTS_PANEL_PATH.'types/*';
foreach (array_filter(glob($filePath), 'is_file') as $file)
{
    require $file;
}//require classes inside autogenereted

foreach(glob($filePath) as $file) {

    $path = str_replace('*', '', $filePath);
    $fileName = str_replace('types/', '', $path);

/*     echo '<script>';
    echo 'console.log('. json_encode($fileName, JSON_HEX_TAG) .')';
    echo '</script>'; */
}


foreach (array_filter(glob($filePath), 'is_file') as $class) {
/*     $service = self::instantiate($class);
    if (method_exists($service, 'register')) {
        $service->register();
    } */
    $domain = strstr($class, 'types/');
    $types = str_replace('types/', '', $domain);
    $php = str_replace('.php', '', $class);
/*     echo '<script>';
    echo 'console.log('. json_encode($domain, JSON_HEX_TAG) .')';
    echo '</script>'; */
/* 
    echo '<script>';
    echo 'console.log('. json_encode($class, JSON_HEX_TAG) .')';
    echo '</script>'; */
}

include 'inc/autoloader.php';

/* $thisPost = get_post_meta(406);
$data = $thisPost['mytext'][0];
$obj = unserialize($data);
$string = implode(",",$obj);
 */
/* echo '<script>';    
echo 'console.log('. json_encode($data, JSON_HEX_TAG) .')';
echo '</script>';

    echo '<script>';    
    echo 'console.log('. json_encode($obj, JSON_HEX_TAG) .')';
    echo '</script>';

    echo '<script>';    
    echo 'console.log('. json_encode(unserialize($data), JSON_HEX_TAG) .')';
    echo '</script>'; */
 
// My custom codes will be here
/* add_action( 'admin_init', 'my_custom_codes_init_func' );
 
function my_custom_codes_init_func() {
    //$id, $title, $callback, $page, $context, $priority, $callback_args
    add_meta_box('my_custom_info', 'Custom Info', 'my_custom_metabox_func', 'post', 'normal', 'low');
}
 
function my_custom_metabox_func() {
    global $post;
        
    $mytext =   get_post_meta($post->ID, 'mytext', true);
    ?>
<div class="input_fields_wrap">
    <a class="add_field_button button-secondary">Add Field</a>
    <?php
    if(isset($mytext) && is_array($mytext)) {
        $i = 1;
        $output = '';
        
        foreach($mytext as $text){
            //echo $text;
            $output = '<div><input type="text" name="mytext[]" value="' . $text . '">';
            if( $i !== 1 && $i > 1 ) $output .= '<a href="#" class="remove_field">usuń</a></div>';
            else $output .= '</div>';
            
            echo $output;
            $i++;
        }
    } else {
        echo '<div><input type="text" name="mytext[]"></div>';
    }
    ?>
</div>
    
    <?php
} */

/* 
add_action('admin_enqueue_scripts', 'admin_enqueue_scripts_func');

function admin_enqueue_scripts_func() {
    //$name, $src, $dependencies, $version, $in_footer
    wp_enqueue_script( 'my-script', VW_URL_TO_ASSETS_FOLDER . '/js/dynamic-fields.js', array( 'jquery' ), '20160816', true );
} //loaded from gulp main assets
 

//saving data

add_action('save_post', 'save_my_post_meta');

function save_my_post_meta($post_id) {
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
    // If any value present in input field, then update the post meta
    if(isset($_POST['mytext'])) {
        // $post_id, $meta_key, $meta_value
        update_post_meta( $post_id, 'mytext', $_POST['mytext'] );
    }
}

add_action('admin_footer', 'my_admin_footer_script');

function my_admin_footer_script() {
    global $post;
        
    $mytext =   get_post_meta($post->ID, 'mytext', true);
    $x = 1;
    if(is_array($mytext)) {
        $x = 0;
        foreach($mytext as $text){
            $x++;
        }
    }
    if(  'post' == $post->post_type ) {
        echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
    
    // Dynamic input fields ( Add / Remove input fields )
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var main_box = $("#my_custom_info")
    
    var x = '.$x.'; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append(\'<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Usuń</a></div>\');
        };


       });

    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent(\'div\').remove(); x--;
    })
});
</script>
                ';
    }
} */



/* 
// My custom codes will be here
add_action( 'admin_init', 'my_custom_codes_init_func' );
 
function my_custom_codes_init_func() {
    //$id, $title, $callback, $page, $context, $priority, $callback_args
    add_meta_box('my_custom_info', 'Custom Info', 'my_custom_metabox_func', 'post', 'normal', 'low');
}
 
function my_custom_metabox_func() {
    global $post;
        
    $mytext =   get_post_meta($post->ID, 'mytext', true);
    ?>
<div class="input_fields_wrap">
    <a class="add_field_button button-secondary">Add Field</a>
    <?php
    if(isset($mytext) && is_array($mytext)) {
        $i = 1;
        $output = '';
        
        foreach($mytext as $text){
            //echo $text;
            $output = '<div><input type="text" name="mytext[]" value="' . $text . '">';
            if( $i !== 1 && $i > 1 ) $output .= '<a href="#" class="remove_field">Remove</a>';
            else $output .= '</div>';
            
            echo $output;
            $i++;
        }
    } else {
        echo '<div><input type="text" name="mytext[]"></div>';
    }
    ?>
</div>
    
    <?php
}


add_action('admin_enqueue_scripts', 'admin_enqueue_scripts_func');

function admin_enqueue_scripts_func() {
    //$name, $src, $dependencies, $version, $in_footer
    wp_enqueue_script( 'my-script', VW_URL_TO_ASSETS_FOLDER . '/js/dynamic-fields.js', array( 'jquery' ), '20160816', true );
} //loaded from gulp main assets
 

//saving data

add_action('save_post', 'save_my_post_meta');

function save_my_post_meta($post_id) {
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
    // If any value present in input field, then update the post meta
    if(isset($_POST['mytext'])) {
        // $post_id, $meta_key, $meta_value
        update_post_meta( $post_id, 'mytext', $_POST['mytext'] );
    }
}

add_action('admin_footer', 'my_admin_footer_script');

function my_admin_footer_script() {
    global $post;
        
    $mytext =   get_post_meta($post->ID, 'mytext', true);
    $x = 1;
    if(is_array($mytext)) {
        $x = 0;
        foreach($mytext as $text){
            $x++;
        }
    }
    if(  'post' == $post->post_type ) {
        echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
    console.log("dziala?")
    // Dynamic input fields ( Add / Remove input fields )
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var main_box = $("#my_custom_info")
    
    var x = '.$x.'; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append(\'<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>\');
        };


       });

    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent(\'div\').remove(); x--;
    })
});
</script>
                ';
    }
}



 */