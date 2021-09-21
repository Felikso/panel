<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Inc;

use Inc\MetaBoxes\Inc\MetaboxScripts;
use Inc\MetaBoxes\Inc\MetaboxUploader;


if ( ! defined( 'VW_CUSTOM_CLIENTS_PANEL_PATH' ) ) {


	define( 'VW_CUSTOM_CLIENTS_PANEL_PATH', plugin_dir_path( __FILE__ ));

}

require VW_CUSTOM_CLIENTS_PANEL_PATH . 'inc/MetaboxClass.php';

require VW_CUSTOM_CLIENTS_PANEL_PATH . 'inc/MetaboxUploader.php';

require VW_CUSTOM_CLIENTS_PANEL_PATH . 'inc/MetaboxScripts.php';

require VW_CUSTOM_CLIENTS_PANEL_PATH . 'inc/MetaboxRegisterFields.php';

/* require VW_CUSTOM_CLIENTS_PANEL_PATH . 'inc/MutliMetaBox.php'; */

/* MetaboxScripts::register_scripts();
MetaboxUploader::register_scrips(); */


