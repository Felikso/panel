<?php 
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Base;

class BaseController
{
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $managers = array();

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/ventusweb-plugin.php';

		$this->managers = array(
			'cpt_manager' => 'Activate CPT Manager',
			'admin_page_manager' => 'Activate Admin Page Manager',
			'user_profile_manager' => 'Activate User Profile Manager',
		);
	}

	public function activated( string $key )
	{
		$option = get_option( 'ventusweb_plugin' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}
}