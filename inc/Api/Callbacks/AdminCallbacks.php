<?php
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController {



	public function adminDashboard() {
		return require_once "$this->plugin_path/templates/admin.php";
	}

	public function adminPageMenu() {
		return require_once "$this->plugin_path/templates/admin-page.php";
	}

	public function adminCpt() {
		return require_once "$this->plugin_path/templates/cpt.php";
	}

	public function adminUserProfile() {
		return require_once "$this->plugin_path/templates/user-profile-manager.php";
	}

	public function userAdminPage() {
		return require_once "$this->plugin_path/templates/user-menu-page.php";
	}


}
