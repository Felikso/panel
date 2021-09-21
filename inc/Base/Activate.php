<?php
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option( 'ventusweb_plugin' ) ) {
			update_option( 'ventusweb_plugin', $default );
		}

		if ( ! get_option( 'ventusweb_plugin_cpt' ) ) {
			update_option( 'ventusweb_plugin_cpt', $default );
		}

		if ( ! get_option( 'ventusweb_plugin_up' ) ) {
			update_option( 'ventusweb_plugin_up', $default );
		}

		if ( ! get_option( 'ventusweb_plugin_tax' ) ) {
			update_option( 'ventusweb_plugin_tax', $default );
		}

		if ( ! get_option( 'ventusweb_plugin_mp' ) ) {
			update_option( 'ventusweb_plugin_mp', $default );
		}

		if ( ! get_option( 'ventusweb_plugin_ap' ) ) {
			update_option( 'ventusweb_plugin_ap', $default );
		}
	}
}