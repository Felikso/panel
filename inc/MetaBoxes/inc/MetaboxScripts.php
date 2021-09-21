<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Inc;

if ( ! defined( 'ABSPATH' ) ) exit;


class MetaboxScripts
{

	public function register()
	{
/* 		add_action( 'admin_enqueue_scripts', [ $this, 'wp_enqueue_metabox'] ); */
/* 		add_action( 'admin_enqueue_scripts', [ $this, 'wp_enqueue_uploader'] ); */
	}

/* 		function wp_enqueue_metabox() {
			wp_enqueue_script( 'mx-image-upload', VW_URL_TO_ASSETS_FOLDER . '/metabox.js', array( 'jquery' ), time(), true );
		}
 */
		function wp_enqueue_uploader() {
			wp_enqueue_script( 'mx-image-upload', VW_URL_TO_ASSETS_FOLDER . '/uploader.js', array( 'jquery' ), time(), true );
		}

 
}

