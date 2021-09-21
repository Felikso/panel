<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Inc;

if ( ! defined( 'ABSPATH' ) ) exit;

// metabox creating main class
class MetaboxUploader
{

	// we will use jQuery
	// So we have to register scripts

	public static function register_scrips()
	{
		add_action( 'admin_enqueue_scripts', ['MetaboxUploader', 'upload_image_scrips'] );
	}

		public static function upload_image_scrips()
		{

		
			wp_enqueue_media();
			/* wp_enqueue_style( 'mypluginstyle', plugins_url( 'js/uploader.js', __FILE__ ) ); */
			wp_enqueue_script( 'mx-image-upload', VW_URL_TO_ASSETS_FOLDER . '/uploader.js', array( 'jquery' ), time(), true );

		}

		function enqueue() {
			// enqueue all our scripts
			wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
			wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
		}

}


/* function james_adds_to_the_head() {
 
    wp_enqueue_script('jquery');
 
    wp_register_script( 'mx-image-upload', VW_CUSTOM_CLIENTS_PANEL_PATH . 'js/uploader.js', array( 'jquery' ), array('jquery'),'',true  );
    wp_register_script( 'add-bx-custom-js', get_template_directory_uri() . '/jquery.bxslider/custom.js', '', null,''  );
    wp_register_style( 'add-bx-css', get_template_directory_uri() . '/jquery.bxslider/jquery.bxslider.css','','', 'screen' );
 
    wp_enqueue_script( 'mx-image-upload' );
    wp_enqueue_script( 'add-bx-custom-js' );
    wp_enqueue_style( 'add-bx-css' );
 
}
 
add_action( 'wp_enqueue_scripts', 'james_adds_to_the_head' ); */