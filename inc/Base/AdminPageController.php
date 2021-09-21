<?php 
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Base;


use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\AdminPageCallbacks;

/**
* 
*/
class AdminPageController extends BaseController
{
	public $settings;

    public $subSettings;

	public $callbacks;

	public $ap_callbacks;

	public $subpages = array();

	public $admin_pages = array();

    public $pages = array(); //new

	public $dashSubpages = array(); //new

	public function register()
	{
		if ( ! $this->activated( 'admin_page_manager' ) ) return;

		$this->settings = new SettingsApi();

        $this->subSettings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->ap_callbacks = new AdminPageCallbacks();

		$this->setSubpages();

		$this->setSettings();

		$this->setSections();

		$this->setFields();

		$this->settings->addSubPages( $this->subpages )->register();

		$this->storeCustomCaps();

		if ( ! empty( $this->admin_pages ) ) {
			add_action( 'admin_menu', array( $this, 'registerCustomAdminPage' ), 9 );
			add_action( 'admin_menu', array( $this, 'registerCustomPostTypesCap' ), 8 );
			add_action( 'admin_menu', array( $this, 'registerCustomMenuPage' ), 9 );
		}

		add_action( 'admin_menu', array( $this, 'removeMenuAdminItems' ) );
		

	}


function removeMenuAdminItems() {
    if( !current_user_can( 'administrator') ):
		remove_menu_page('edit.php'); // Posts
		remove_menu_page('upload.php'); // Media
		remove_menu_page('link-manager.php'); // Links
		remove_menu_page('edit-comments.php'); // Comments
		remove_menu_page('edit.php?post_type=page'); // Pages
		remove_menu_page('plugins.php'); // Plugins
		remove_menu_page('themes.php'); // Appearance
		remove_menu_page('users.php'); // Users
		remove_menu_page('tools.php'); // Tools
		remove_menu_page('options-general.php'); // Settings
		remove_menu_page('edit.php?post_type=action_monitor');//action monitor

    endif;
}



	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'ventusweb_plugin', 
				'page_title' => 'Ventus WEB - Custom Admin Panel', 
				'menu_title' => 'Admin Page Manager', 
				'capability' => 'manage_options', 
				'menu_slug' => 'ventusweb_admin_page', 
				'callback' => array( $this->callbacks, 'adminPageMenu' )
			)
		);
	}

  	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'ventusweb_plugin_ap_settings',
				'option_name' => 'ventusweb_plugin_ap',
				'callback' => array($this->ap_callbacks, 'apSanitize')
			)
		);

		$this->settings->setSettings( $args );
	}  

  	public function setSections()
	{
		$args = array(
			array(
				'id' => 'ventusweb_ap_index',
				'title' => 'Custom AdminPage Manager',
				'callback' => array($this->ap_callbacks, 'apSectionManager'),
				'page' => 'ventusweb_admin_page'
			)
		);

		$this->settings->setSections( $args );
	}  

  	public function setFields()
	{


		$args = array(
			array(
				'id' => 'admin_page',
				'title' => 'Custom AdminPage ID',
				'callback' => array($this->ap_callbacks, 'textField'),
				'page' => 'ventusweb_admin_page',
				'section' => 'ventusweb_ap_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_ap',
					'label_for' => 'admin_page',
					'placeholder' => 'eg. genre',
					'array' => 'admin_page'
				)
			),
			array(
				'id' => 'singular_name',
				'title' => 'Singular Name',
				'callback' => array( $this->ap_callbacks, 'textField' ),
				'page' => 'ventusweb_admin_page',
				'section' => 'ventusweb_ap_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_ap',
					'label_for' => 'singular_name',
					'placeholder' => 'eg. Genre',
					'array' => 'admin_page'
				)
			),
			array(
				'id' => 'singular_post_name',
				'title' => 'Singular Post Name',
				'callback' => array( $this->ap_callbacks, 'textField' ),
				'page' => 'ventusweb_admin_page',
				'section' => 'ventusweb_ap_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_ap',
					'label_for' => 'singular_post_name',
					'placeholder' => 'eg. Genre',
					'array' => 'admin_page'
				)
			),
			array(
				'id' => 'plural_post_name',
				'title' => 'Plural Post Name',
				'callback' => array( $this->ap_callbacks, 'textField' ),
				'page' => 'ventusweb_admin_page',
				'section' => 'ventusweb_ap_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_ap',
					'label_for' => 'plural_post_name',
					'placeholder' => 'eg. Genre',
					'array' => 'admin_page'
				)
			),
			array(
				'id' => 'menu_dash_icon',
				'title' => 'Menu Dash',
				'callback' => array( $this->ap_callbacks, 'textField' ),
				'page' => 'ventusweb_admin_page',
				'section' => 'ventusweb_ap_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_ap',
					'label_for' => 'menu_dash_icon',
					'placeholder' => 'eg. dashicons-buddicons-activity',
					'array' => 'admin_page'
				)
			),
			array(
				'id' => 'dash_name',
				'title' => 'Dash name',
				'callback' => array( $this->ap_callbacks, 'textField' ),
				'page' => 'ventusweb_admin_page',
				'section' => 'ventusweb_ap_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_ap',
					'label_for' => 'dash_name',
					'placeholder' => 'eg. dashicons-buddicons-activity',
					'array' => 'admin_page'
				)
			),
			array(
				'id' => 'hierarchical',
				'title' => 'Hierarchical',
				'callback' => array( $this->ap_callbacks, 'checkboxField' ),
				'page' => 'ventusweb_admin_page',
				'section' => 'ventusweb_ap_index',
				'args' => array(
					'option_name' => 'ventusweb_plugin_ap',
					'label_for' => 'hierarchical',
					'class' => 'ui-toggle',
					'array' => 'admin_page'
				)
			),
				array(
					'id' => 'objects_cap',
					'title' => 'Post Types Cap',
					'callback' => array( $this->ap_callbacks, 'checkboxPostCapTypesField' ),
					'page' => 'ventusweb_admin_page',
					'section' => 'ventusweb_ap_index',
					'args' => array(
						'option_name' => 'ventusweb_plugin_ap',
						'label_for' => 'objects_cap',
						'class' => 'ui-toggle',
						'class_checks_list' => 'check-list',
						'class_user' => 'ui-user-toggle',
						'class_check' => 'ui-check-toggle',
						'array' => 'admin_page'
					)
			)
		);

		$this->settings->setFields( $args );
 
	}
	public function storeCustomCaps()
	{
		$options = get_option( 'ventusweb_plugin_ap' ) ?: array();

		foreach ($options as $option) {
			$labels = array(
				'name'             	=> $option['singular_name'],
				'singular_name'     => $option['singular_name'],
				'singular_post_name'     => $option['singular_post_name'],
				'plural_post_name'     => $option['plural_post_name'],
				'menu_dash_icon'     => isset($option['dash_name']) ? $option['menu_dash_icon'] : $option['menu_dash_icon'] . 'dashicons-buddicons-activity',
/* 				'search_items'      => 'Search ' . $option['singular_name'],
				'all_items'         => 'All ' . $option['singular_name'],
				'parent_item'       => 'Parent ' . $option['singular_name'],
				'parent_item_colon' => 'Parent ' . $option['singular_name'] . ':',
				'edit_item'         => 'Edit ' . $option['singular_name'],
				'update_item'       => 'Update ' . $option['singular_name'],
				'add_new_item'      => 'Add New ' . $option['singular_name'],
				'new_item_name'     => 'New ' . $option['singular_name'] . ' Name', */
				'menu_name'         => $option['singular_name'],
				'dash_name'			=> isset($option['dash_name']) ? $option['dash_name'] : $option['singular_name'] . '- Dashboard',
			);

			$this->admin_pages[] = array(
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $option['admin_page'] ),
				'objects'           => isset($option['objects']) ? $option['objects'] : null,
				'objects_cap'       => isset($option['objects_cap']) ? $option['objects_cap'] : null,
				'users_data'        => isset($option['users_data']) ? $option['users_data'] : null
			);
		}


	}

    public function registerCustomAdminPage()
	{
		$options = get_option( 'ventusweb_plugin_ap' ) ?: array();

		$post_types = get_post_types( array( 'ventus_web_menu_page' => true ) );

		foreach ($this->admin_pages as $admin_page) {
			$all_users = get_users();
			$users_data = isset($admin_page['users_data']) ? array_keys($admin_page['users_data']) : null;
			$objects = isset($admin_page['objects']) ? array_keys($admin_page['objects']) : null;
			$objects_cap = isset($admin_page['objects_cap']) ? array_keys($admin_page['objects_cap']) : null;



			if( $objects_cap  ) {


		//added caps edit menu caps

			
			$edit_cap = 'manage_admin_page_'.$admin_page['rewrite']['slug'];

            	$items[] = array(
                'page_title' => $admin_page['labels']['name'], 
                'menu_title' => $admin_page['labels']['dash_name'],
				'capability' => $edit_cap,
                'menu_slug' => $admin_page['rewrite']['slug'], 
				'callback' => array( $this->callbacks, 'userAdminPage' ),
                'icon_url' =>  (isset($admin_page['labels']['menu_dash_icon']) ? $admin_page['labels']['menu_dash_icon'] : 'dashicons-buddicons-activity' ), 
                'position' => 110 
             );
 

				foreach( $all_users as $current_user ) { //cleaning all edit admin menu caps

					if( $current_user->has_cap( $edit_cap ) ) {
						$current_user->remove_cap( $edit_cap );
 
					}

				 }


				 if( ! ($admin_page['objects_cap'] == null ) ){

					$admin_caps = $admin_page['objects_cap'];

					foreach ( $admin_caps as $post_type_name => $admin_cap ){
						if ( is_object($admin_cap) || is_array($admin_cap) ) {
						$users_array = $admin_cap['users'];

						foreach ( $users_array as $user_id => $user ) {
							$user = get_user_by('ID', $user_id);

							if( ! $user->has_cap( $edit_cap ) ) {
								$user->add_cap( $edit_cap );

							}
						}
						}
					}
			
				}
 

				if( $users_data ) {
					foreach( $users_data as $ID ) {
				
						$current_user = get_user_by( 'ID', $ID );

							if( ! $current_user->has_cap( $edit_cap ) ) {
								$current_user->add_cap( $edit_cap);

							}

					}
				}

		}

	}

	$this->pages = $items;
}

    public function registerCustomPostTypesCap()
	{
		$options = get_option( 'ventusweb_plugin_ap' ) ?: array();

		foreach ($this->admin_pages as $admin_page) {

			$post_types = get_post_types( array( 'ventus_web_menu_page' => true ) );

			//check if user has default for cpt cap and clean that
			foreach ($post_types as $post) {

				$all_users = get_users();

				$capabilities = get_post_type_object( $post )->cap;

				foreach( $capabilities as $key => $cap ) {
					foreach($all_users as $all_user){

						if( $all_user->has_cap( $cap ) ) {
							$all_user->remove_cap( $cap );
						}
					}

				}

			}

			if( ! ($admin_page['objects_cap'] == null ) ){

				$admin_caps = $admin_page['objects_cap'];
				//add selected users selected cap in admin panel
				foreach ( $admin_caps as $post_type_name => $admin_cap ){
					if ( is_object($admin_cap) || is_array($admin_cap) ) {
						foreach ( $admin_cap as $user_id => $caps ) {
							if (is_numeric($user_id)) {
								$user = get_user_by('ID', $user_id);
	
								foreach ( $caps as $cap_name => $cap_value ){
	
									if( ! $user->has_cap( $cap_name ) ) {
	
										$user->add_cap( $cap_name );
	
	
									}
								}
	
							}
			
						}
					}
				}

		
			}
 

	}
}


    public function registerCustomMenuPage()
	{

		foreach ($this->admin_pages as $admin_page) {

				$subItems = array();
				$objects_cap = isset($admin_page['objects_cap']) ? array_keys($admin_page['objects_cap']) : null;

				if(isset($objects_cap)) {

				foreach ($objects_cap as $object){

					$post_dash_name = get_post_type_object($object)->labels->dash_name;
					
					$subItems[] = array(
						'parent_slug' =>  $admin_page['rewrite']['slug'], 
						'page_title' =>  $object, //edited from name label admin page
						'menu_title' =>  $post_dash_name, 
						'capability' => 'edit_' . $object, 
						'menu_slug' => 'edit.php?post_type='.$object, 
						'callback' =>  '', 
						'icon_url' =>  $admin_page['labels']['name'], 
						'position' => 110
					 );

				}		
 
			}

			$this->dashSubpages = $subItems;
			$this->subSettings->addPages( $this->pages )->addSubPages( $this->dashSubpages )->register();

		}

	}

 
}

