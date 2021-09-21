<?php 
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Base;

use Inc\Base\BaseController;

/**
* 
*/
class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}
	
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/mystyle.css' );
		wp_enqueue_script( 'mypluginscript', $this->plugin_url . 'assets/myscript.js' );

		// metaboxes
		wp_enqueue_style( 'multiboxstyle', $this->plugin_url . 'assets/multibox.css' );
/* 		wp_enqueue_script( 'uploaderscript', $this->plugin_url . 'assets/uploader.js' ); */
		wp_enqueue_script( 'metaboxpisckerscript', $this->plugin_url . 'assets/metabox.js' );
/* 		wp_enqueue_script( 'vuecustomscript', $this->plugin_url . 'assets/vue-custom.js' );
		wp_enqueue_script( 'vusecustomsavedcript', $this->plugin_url . 'assets/vue-custom-saved.js' );
		wp_enqueue_script( 'vueproductionscript', $this->plugin_url . 'assets/vue-production.js' );
		wp_enqueue_script( 'vuedevscript', $this->plugin_url . 'assets/vue-dev.js' );
		wp_enqueue_script( 'createfieldbuttonscript', $this->plugin_url . 'assets/create-field-button.js' );
		wp_enqueue_script( 'dynamicfieldsscript', $this->plugin_url . 'assets/dynamic-fields.js' ); */

		// multi gallery uploader
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-sortable');

		// theme color picker

		wp_enqueue_style( 'metaboxgallerystyle', $this->plugin_url . 'assets/metabox-gallery.css' );
		wp_enqueue_script('multiuploaderscript', $this->plugin_url . 'assets/multi-uploader.js', array('jquery','jquery-ui-sortable') );
	}
}
