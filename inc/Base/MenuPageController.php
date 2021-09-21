<?php 
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\MenuPageCallbacks;

/**
* 
*/
class MenuPageController extends BaseController
{
	public $settings;

	public $callbacks;

	public $mp_callbacks;

	public $subpages = array();

	public $menuPages = array();

	public $admin_pages = array();

	public $adminMenuPages = array();

	public function register()
	{
		if ( ! $this->activated( 'menu_page_manager' ) ) return;

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->mp_callbacks = new MenuPageCallbacks();

		$this->setSubpages();

		$this->setSettings();

		$this->setSections();

		$this->setFields();

		$this->settings->addSubPages( $this->subpages )->register();

		$this->storeCustomMenuPages();

		if ( ! empty( $this->menuPages ) ) {
			add_action( 'init', array( $this, 'registerCustomMenuPage' ));
		}

		$this->storeAdminMenuPages();

		if ( ! empty( $this->adminMenuPages ) ) {
			add_action( 'init', array( $this, 'registerCustomMenuPage' ));
		}
	}

    

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'ventusweb_plugin', 
				'page_title' => 'Custom Menu Pages', 
				'menu_title' => 'Menu Page Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'ventusweb_menu_page', 
				'callback' => array( $this->callbacks, 'adminMenuPage' )
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'ventusweb_plugin_mp_settings',
				'option_name' => 'ventusweb_plugin_mp',
				'callback' => array($this->mp_callbacks, 'mpSanitize')
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'ventusweb_mp_index',
				'title' => 'Custom MenuPage Manager',
				'callback' => array($this->mp_callbacks, 'mpSectionManager'),
				'page' => 'ventusweb_menu_page'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'menu_page',
				'title' => 'Custom MenuPage ID',
				'callback' => array($this->mp_callbacks, 'textField'),
				'page' => 'ventusweb_menu_page',
				'section' => 'ventusweb_mp_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_mp',
					'label_for' => 'menu_page',
					'placeholder' => 'eg. genre',
					'array' => 'menu_page'
				)
			),
			array(
				'id' => 'singular_name',
				'title' => 'Singular Name',
				'callback' => array( $this->mp_callbacks, 'textField' ),
				'page' => 'ventusweb_menu_page',
				'section' => 'ventusweb_mp_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_mp',
					'label_for' => 'singular_name',
					'placeholder' => 'eg. Genre',
					'array' => 'menu_page'
				)
			),
            array(
				'id' => 'menu_page_name',
				'title' => 'Menu Page Name',
				'callback' => array( $this->mp_callbacks, 'textField' ),
				'page' => 'ventusweb_menu_page',
				'section' => 'ventusweb_mp_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_mp',
					'label_for' => 'menu_page_name',
					'placeholder' => 'eg. Menu Name',
					'array' => 'menu_page'
				)
			),
			array(
				'id' => 'hierarchical',
				'title' => 'Hierarchical',
				'callback' => array( $this->mp_callbacks, 'checkboxField' ),
				'page' => 'ventusweb_menu_page',
				'section' => 'ventusweb_mp_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_mp',
					'label_for' => 'hierarchical',
					'class' => 'ui-toggle',
					'array' => 'menu_page'
				)
			),
            array(
				'id' => 'menu_page',
				'title' => 'Menu Page',
				'callback' => array( $this->mp_callbacks, 'checkboxField' ),
				'page' => 'ventusweb_menu_page',
				'section' => 'ventusweb_mp_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_mp',
					'label_for' => 'menu_page',
					'class' => 'ui-toggle',
					'array' => 'menu_page'
				)
			),
			array(
				'id' => 'objects',
				'title' => 'Post Types',
				'callback' => array( $this->mp_callbacks, 'checkboxPostTypesField' ),
				'page' => 'ventusweb_menu_page',
				'section' => 'ventusweb_mp_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_mp',
					'label_for' => 'objects',
					'class' => 'ui-toggle',
					'array' => 'menu_page'
				)
			)
		);

		$this->settings->setFields( $args );
	}

	public function storeCustomMenuPages()
	{
		$options = get_option( 'ventusweb_plugin_mp' ) ?: array();

		foreach ($options as $option) {
			$labels = array(
				'name'              => $option['singular_name'],
				'singular_name'     => $option['singular_name'],
				'search_items'      => 'Search ' . $option['singular_name'],
				'all_items'         => 'All ' . $option['singular_name'],
				'parent_item'       => 'Parent ' . $option['singular_name'],
				'parent_item_colon' => 'Parent ' . $option['singular_name'] . ':',
				'edit_item'         => 'Edit ' . $option['singular_name'],
				'update_item'       => 'Update ' . $option['singular_name'],
				'add_new_item'      => 'Add New ' . $option['singular_name'],
				'new_item_name'     => 'New ' . $option['singular_name'] . ' Name',
				'menu_name'         => $option['singular_name'],
			);

			$this->menuPages[] = array(
				'hierarchical'      => isset($option['hierarchical']) ? true : false,
                'menu_page'      => isset($option['menu_page']) ? true : false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'show_in_rest'		=> true,
				'rewrite'           => array( 'slug' => $option['menu_page'] ),
				'objects'           => isset($option['objects']) ? $option['objects'] : null
			);

		}
	}

	public function storeAdminMenuPages()
	{
		$options = get_option( 'ventusweb_plugin_mp' ) ?: array();

		foreach ($options as $option) {
/* 			$labels = array(
				'name'              => $option['singular_name'],
				'singular_name'     => $option['singular_name'],
				'search_items'      => 'Search ' . $option['singular_name'],
				'all_items'         => 'All ' . $option['singular_name'],
				'parent_item'       => 'Parent ' . $option['singular_name'],
				'parent_item_colon' => 'Parent ' . $option['singular_name'] . ':',
				'edit_item'         => 'Edit ' . $option['singular_name'],
				'update_item'       => 'Update ' . $option['singular_name'],
				'add_new_item'      => 'Add New ' . $option['singular_name'],
				'new_item_name'     => 'New ' . $option['singular_name'] . ' Name',
				'menu_name'         => $option['singular_name'],
			);
 */
/* 			$this->menuPages[] = array(
				'hierarchical'      => isset($option['hierarchical']) ? true : false,
                'menu_page'      => isset($option['menu_page']) ? true : false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'show_in_rest'		=> true,
				'rewrite'           => array( 'slug' => $option['menu_page'] ),
				'objects'           => isset($option['objects']) ? $option['objects'] : null
			); */

			$this->menuPages[] = array(
				'hierarchical'      => isset($option['hierarchical']) ? true : false,
                'menu_page'      => isset($option['menu_page']) ? true : false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'show_in_rest'		=> true,
				'rewrite'           => array( 'slug' => $option['menu_page'] ),
				'objects'           => isset($option['objects']) ? $option['objects'] : null
			);	

		}
	}

	public function registerCustomMenuPage()
	{
		foreach ($this->menuPages as $menu_page) {
			$objects = isset($menu_page['objects']) ? array_keys($menu_page['objects']) : null;
			register_taxonomy( $menu_page['rewrite']['slug'], $objects, $menu_page );
		}
	}

	public function registerAdminMenuPage()
	{
		foreach ($this->menuPages as $menu_page) {
			$objects = isset($menu_page['objects']) ? array_keys($menu_page['objects']) : null;
			/* register_taxonomy( $menu_page['rewrite']['slug'], $objects, $menu_page ); */

			add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
		}
	}
}