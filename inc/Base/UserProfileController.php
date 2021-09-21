<?php 
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\UserProfileCallbacks;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class UserProfileController extends BaseController
{
	public $settings;

	public $callbacks;

	public $up_callbacks;

	public $subpages = array();

	public $custom_post_types = array();

	public function register()
	{
		if ( ! $this->activated( 'user_profile_manager' ) ) return;

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->up_callbacks = new UserProfileCallbacks();

		$this->setSubpages();

		$this->setSettings();

		$this->setSections();

		$this->setFields();

		$this->settings->addSubPages( $this->subpages )->register();

		$this->storeCustomPostTypes();

		$this->addTypesTemplate();
 

		if ( ! empty( $this->custom_post_types ) ) {
			add_action( 'init', array( $this, 'registerCustomPostTypes' ) );
		}
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'ventusweb_plugin', 
				'page_title' => 'User Profiles', 
				'menu_title' => 'CPT Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'ventusweb_up', 
				'callback' => array( $this->callbacks, 'user-profile-manager.php' )
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'ventusweb_plugin_up_settings',
				'option_name' => 'ventusweb_plugin_up',
				'callback' => array( $this->up_callbacks, 'upSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'ventusweb_up_index',
				'title' => 'User Profile Manager',
				'callback' => array( $this->up_callbacks, 'adminUserProfile' ),
				'page' => 'ventusweb_up'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{

		$test = 'test';
		$args = array(
			array(
				'id' => 'post_type',
				'title' => 'User Profile ID',
				'callback' => array( $this->up_callbacks, 'textField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'post_type',
					'placeholder' => 'eg. product',
					'array' => 'post_type'
				)
			),
			array(
				'id' => 'singular_name',
				'title' => 'Singular Name',
				'callback' => array( $this->up_callbacks, 'textField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'singular_name',
					'placeholder' => 'eg. Product',
					'array' => 'post_type'
				)
			),
			array(
				'id' => 'plural_name',
				'title' => 'Plural Name',
				'callback' => array( $this->up_callbacks, 'textField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'plural_name',
					'placeholder' => 'eg. Products',
					'array' => 'post_type'
				)
			),
			array(
				'id' => 'singular_post_name',
				'title' => 'Singular Post Name',
				'callback' => array( $this->up_callbacks, 'textField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'singular_post_name',
					'placeholder' => 'eg. product',
					'array' => 'post_type'
				)
			),
			array(
				'id' => 'plural_post_name',
				'title' => 'Plural Post Name',
				'callback' => array( $this->up_callbacks, 'textField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'plural_post_name',
					'placeholder' => 'eg. products',
					'array' => 'post_type'
				)
			),
			array(
				'id' => 'has_title',
				'title' => 'Title',
				'callback' => array( $this->up_callbacks, 'checkboxField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'has_title',
					'class' => 'ui-toggle',
					'array' => 'post_type'
				)
			),
			array(
				'id' => 'has_editor',
				'title' => 'Editor',
				'callback' => array( $this->up_callbacks, 'checkboxField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'has_editor',
					'class' => 'ui-toggle',
					'array' => 'post_type'
				)
			),
			array(
				'id' => 'has_thumbnail',
				'title' => 'Thumnbail',
				'callback' => array( $this->up_callbacks, 'checkboxField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'has_thumbnail',
					'class' => 'ui-toggle',
					'array' => 'post_type'
				)
			),
			array(
				'id' => 'meta_field',
				'title' => 'Meta field',
				'callback' => array( $this->up_callbacks, 'metaField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'meta_field',
					'placeholder' => 'eg. product',
					'array' => 'post_type',
					'test' => $test
				)
			),
			array(
				'id' => 'dash_name',
				'title' => 'Dash Name',
				'callback' => array( $this->up_callbacks, 'textField' ),
				'page' => 'ventusweb_up',
				'section' => 'ventusweb_up_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_up',
					'label_for' => 'dash_name',
					'placeholder' => 'eg. Dashboard',
					'array' => 'post_type'
				)
			),
		);

		$this->settings->setFields( $args );
	}

	public function storeCustomPostTypes()
	{
		$options = get_option( 'ventusweb_plugin_up' ) ?: array();

		foreach ($options as $option) {

			$this->custom_post_types[] = array(
				'post_type'             => $option['post_type'],
				'name'                  => $option['plural_name'],
				'singular_name'         => $option['singular_name'],
				'singular_post_name'    => $option['singular_post_name'],
				'plural_post_name'    	=> $option['plural_post_name'],
				'dash_name'    	=> $option['plural_name'],
/* 				'dash_name'    			=> isset($option['dash_name']) ? $option['dash_name'] : '', */
				'menu_name'             => $option['plural_name'],
				'name_admin_bar'        => $option['singular_name'],
				'archives'              => $option['singular_name'] . ' Archives',
				'attributes'            => $option['singular_name'] . ' Attributes',
				'parent_item_colon'     => 'Parent ' . $option['singular_name'],
				'all_items'             => 'All ' . $option['plural_name'],
				'add_new_item'          => 'Add New ' . $option['singular_name'],
				'add_new'               => 'Add New',
				'new_item'              => 'New ' . $option['singular_name'],
				'edit_item'             => 'Edit ' . $option['singular_name'],
				'update_item'           => 'Update ' . $option['singular_name'],
				'view_item'             => 'View ' . $option['singular_name'],
				'view_items'            => 'View ' . $option['plural_name'],
				'search_items'          => 'Search ' . $option['plural_name'],
				'not_found'             => 'No ' . $option['singular_name'] . ' Found',
				'not_found_in_trash'    => 'No ' . $option['singular_name'] . ' Found in Trash',
				'featured_image'        => 'Featured Image',
				'set_featured_image'    => 'Set Featured Image',
				'remove_featured_image' => 'Remove Featured Image',
				'use_featured_image'    => 'Use Featured Image',
				'insert_into_item'      => 'Insert into ' . $option['singular_name'],
				'uploaded_to_this_item' => 'Upload to this ' . $option['singular_name'],
				'items_list'            => $option['plural_name'] . ' List',
				'items_list_navigation' => $option['plural_name'] . ' List Navigation',
				'filter_items_list'     => 'Filter' . $option['plural_name'] . ' List',
				'label'                 => $option['singular_name'],
				'description'           => $option['plural_name'] . 'User Profile',
				'supports'              => array( 
					isset($option['has_title']) ? 'title' : '', 
					isset($option['has_editor']) ? 'editor' : '', 
					isset($option['has_thumbnail']) ? 'thumbnail' : '' 
				),
				'show_in_rest'			=> true,
 
				'hierarchical'          => false,
				'public'                => isset($option['public']) ?: false,
				'show_ui'               => true,
				'ventus_web_menu_page' 			=> true,
				'show_in_menu'          => false,
				'menu_position'         => 5,
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'show_in_graphql' 		=> true,
				'graphql_single_name' 	=> $option['singular_post_name'],
				'graphql_plural_name' 	=> $option['plural_post_name'],
				'can_export'            => true,
				'has_title'				=> isset($option['has_title']) ?: true,
				'has_editor'			=> isset($option['has_editor']) ?: false,
				'has_thumbnail'			=> isset($option['has_thumbnail']) ?: false,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => array(
					$option['singular_post_name'],
					$option['plural_post_name'],
				),
				'capabilities' => array(
					'create_posts' => 'create_'.$option['singular_post_name'],
					'delete_others_posts' => 'delete_others_'.$option['plural_post_name'],
					'delete_post' => 'delete_'.$option['singular_post_name'],
					'delete_posts' => 'delete_'.$option['plural_post_name'],
					'delete_private_posts' => 'delete_private_'.$option['plural_post_name'],
					'delete_published_posts' => 'delete_published_'.$option['plural_post_name'],
					'edit_others_posts' => 'edit_others_'.$option['plural_post_name'], 
					'edit_post' => 'edit_'.$option['singular_post_name'],
					'edit_posts' => 'edit_'.$option['plural_post_name'],
					'edit_private_posts' => 'edit_private_'.$option['plural_post_name'],
					'edit_published_posts' => 'edit_published_'.$option['plural_post_name'],
					'publish_posts' => 'publish_'.$option['plural_post_name'],
					'read_post' => 'read_'.$option['singular_post_name'],
					'read_private_posts' => 'read_private_'.$option['plural_post_name']
				)
			);
		}
	}

	public function registerCustomPostTypes()
	{
		foreach ($this->custom_post_types as $post_type) {
			register_post_type( $post_type['post_type'],
				array(
					'labels' => array(
						'name'                  => $post_type['name'],
						'singular_name'         => $post_type['singular_name'],
						'singular_post_name'    => $post_type['singular_post_name'],
						'plural_post_name'    	=> $post_type['plural_post_name'],
						'dash_name'    			=> $post_type['dash_name'],
						'menu_name'             => $post_type['menu_name'],
						'name_admin_bar'        => $post_type['name_admin_bar'],
						'archives'              => $post_type['archives'],
						'attributes'            => $post_type['attributes'],
						'parent_item_colon'     => $post_type['parent_item_colon'],
						'all_items'             => $post_type['all_items'],
						'add_new_item'          => $post_type['add_new_item'],
						'add_new'               => $post_type['add_new'],
						'new_item'              => $post_type['new_item'],
						'edit_item'             => $post_type['edit_item'],
						'update_item'           => $post_type['update_item'],
						'view_item'             => $post_type['view_item'],
						'view_items'            => $post_type['view_items'],
						'search_items'          => $post_type['search_items'],
						'not_found'             => $post_type['not_found'],
						'not_found_in_trash'    => $post_type['not_found_in_trash'],
						'featured_image'        => $post_type['featured_image'],
						'set_featured_image'    => $post_type['set_featured_image'],
						'remove_featured_image' => $post_type['remove_featured_image'],
						'use_featured_image'    => $post_type['use_featured_image'],
						'insert_into_item'      => $post_type['insert_into_item'],
						'uploaded_to_this_item' => $post_type['uploaded_to_this_item'],
						'items_list'            => $post_type['items_list'],
						'items_list_navigation' => $post_type['items_list_navigation'],
						'filter_items_list'     => $post_type['filter_items_list']
					),
					'label'                     => $post_type['label'],
					'description'               => $post_type['description'],
					'supports'                  => $post_type['supports'],
					'show_in_rest'              => $post_type['show_in_rest'],
 
					'hierarchical'              => $post_type['hierarchical'],
					'public'                    => $post_type['public'],
					'show_ui'                   => $post_type['show_ui'],
					'ventus_web_menu_page'                   => $post_type['ventus_web_menu_page'],
					'show_in_menu'              => $post_type['show_in_menu'],
					'menu_position'             => $post_type['menu_position'],
					'show_in_admin_bar'         => $post_type['show_in_admin_bar'],
					'show_in_nav_menus'         => $post_type['show_in_nav_menus'],
					'show_in_graphql' => true,
					'graphql_single_name' => 	$post_type['singular_post_name'],
					'graphql_plural_name' => 	$post_type['plural_post_name'],
					'can_export'                => $post_type['can_export'],
					'has_title'               => $post_type['has_title'],
					'has_editor'               => $post_type['has_editor'],
					'has_thumbnail'               => $post_type['has_thumbnail'],
					'exclude_from_search'       => $post_type['exclude_from_search'],
					'publicly_queryable'        => $post_type['publicly_queryable'],
					'capability_type'           => $post_type['capability_type'],
					'capabilities'          	=> $post_type['capabilities']
				)
			);
		}
	}



	public function addTypesTemplate()
	
	{
 
		foreach ($this->custom_post_types as $post_type) {
			$filename = VW_CUSTOM_POST_TYPES_PATH . 'types/' . $post_type['post_type'] . '.php';
 
		   if(! file_exists( $filename )){

			   fopen( $filename, "w");

		   }
		}
	}

  
 
 

	
		
/* 	function add_custom_caps() {
		// gets the subscriber role
		$role = get_role( 'subscriber' );
	
		// This only works, because it accesses the class instance.
		// would allow the subscriber to edit others' posts for current theme only
		 $role->add_cap( 'read' );
		 $role->add_cap( 'read_post');
		 $role->add_cap( 'read_private_post' );
		 $role->add_cap( 'edit_post' );
		 $role->add_cap( 'edit_others_post' );
		 $role->add_cap( 'edit_published_post' );
		 $role->add_cap( 'publish_post' );
		 $role->add_cap( 'delete_others_post' );
		 $role->add_cap( 'delete_private_post' );
		 $role->add_cap( 'delete_published_post' );
	}
	add_action( 'admin_init', 'add_custom_caps'); */
	




}


