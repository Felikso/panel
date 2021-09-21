<?php 
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Api\Callbacks;

class UserAdminCallbacks
{

  // Properties
  public $name = "test";
  public $color;

  // Methods
  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }

	public function apSectionManager() {
		echo 'Create as many Custom Admin Pages as you want.' . $this->name;
	}

	public function apSanitize( $input )
	{
		$output = get_option('ventusweb_plugin_ap');

		if ( isset($_POST["remove"]) ) {
			unset($output[$_POST["remove"]]);

			return $output;
		}

		if ( count($output) == 0 ) {
			$output[$input['admin_page']] = $input;

			return $output;
		}

		foreach ($output as $key => $value) {
			if ($input['admin_page'] === $key) {
				$output[$key] = $input;
			} else {
				$output[$input['admin_page']] = $input;
			}
		}

		return $output;
	}

	public function textField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$value = '';

		if ( isset($_POST["edit_admin_page"]) ) {
			$input = get_option( $option_name );
			$value = $input[$_POST["edit_admin_page"]][$name];
		}

		echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '" required>';
	}

	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checked = false;

		if ( isset($_POST["edit_admin_page"]) ) {
			$checkbox = get_option( $option_name );
			$checked = isset($checkbox[$_POST["edit_admin_page"]][$name]) ?: false;
		}

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
	}

	public function checkboxPostTypesField( $args )
	{
		$output = '';
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checked = false;

		if ( isset($_POST["edit_admin_page"]) ) {
			$checkbox = get_option( $option_name );
		}

		$post_types = get_post_types( array( 'ventus_web_menu_page' => true ) );

		foreach ($post_types as $post) {

			if ( isset($_POST["edit_admin_page"]) ) {
				$checked = isset($checkbox[$_POST["edit_admin_page"]][$name][$post]) ?: false;
			}

			$output .= '<div class="' . $classes . ' mb-10"><input type="checkbox" id="' . $post . '" name="' . $option_name . '[' . $name . '][' . $post . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '><label for="' . $post . '"><div></div></label> <strong>aaaaa' . $post . '</strong></div>';
		}

		echo $output;
	}

	public function checkboxUsersListField( $args )
	{
		$output = '';
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checked = false;

		if ( isset($_POST["edit_admin_page"]) ) {
			$checkbox = get_option( $option_name );
		}

		$post_types = get_post_types( array( 'ventus_web_menu_page' => true ) );
		$users = get_users();

		foreach ($users as $user) {

			if ( isset($_POST["edit_admin_page"]) ) {
				$checked = isset($checkbox[$_POST["edit_admin_page"]][$name][$user->data->ID]) ?: false;
			}

			$output .= '<div class="' . $classes . ' mb-10"><input type="checkbox" id="' . $user->data->ID . '" name="' . $option_name . '[' . $name . '][' . $user->data->ID . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '><label for="' . $user->data->ID . '"><div></div></label> <strong>' . $user->data->user_login . '</strong></div>';
		}

		echo $output;
	}
}