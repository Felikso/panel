<?php
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Api\Callbacks;

class AdminPageCallbacks {


	public function apSectionManager() {
		echo 'Create as many Custom Admin Pages as you want.';
	}

	public function apSanitize( $input ) {
		$output = get_option( 'ventusweb_plugin_ap' );

		if ( isset( $_POST['remove'] ) ) {
			unset( $output[ $_POST['remove'] ] );

			return $output;
		}

		if ( count( $output ) == 0 ) {
			$output[ $input['admin_page'] ] = $input;

			return $output;
		}

		foreach ( $output as $key => $value ) {
			if ( $input['admin_page'] === $key ) {
				$output[ $key ] = $input;
			} else {
				$output[ $input['admin_page'] ] = $input;
			}
		}

		return $output;
	}

	public function textField( $args ) {
		$name        = $args['label_for'];
		$option_name = $args['option_name'];
		$value       = '';

		if ( isset( $_POST['edit_admin_page'] ) ) {
			$input = get_option( $option_name );
			$value = $input[ $_POST['edit_admin_page'] ][ $name ];
		}

		echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '" required>';
	}

	public function checkboxField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		$checked     = false;

		if ( isset( $_POST['edit_admin_page'] ) ) {
			$checkbox = get_option( $option_name );
			$checked  = isset( $checkbox[ $_POST['edit_admin_page'] ][ $name ] ) ?: false;
		}

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ( $checked ? 'checked' : '' ) . '><label for="' . $name . '"><div></div></label></div>';
	}

	public function checkboxPostTypesField( $args ) {
		$output      = '';
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		$checked     = false;

		if ( isset( $_POST['edit_admin_page'] ) ) {
			$checkbox = get_option( $option_name );
		}

		$post_types = get_post_types( array( 'ventus_web_menu_page' => true ) );

		foreach ( $post_types as $post ) {
			if ( isset( $_POST['edit_admin_page'] ) ) {
				$checked = isset( $checkbox[ $_POST['edit_admin_page'] ][ $name ][ $post ] ) ?: false;
			}

			$output .= '<div class="' . $classes . ' mb-10"><input type="checkbox" id="' . $post . '" name="' . $option_name . '[' . $name . '][' . $post . ']" value="1" class="" ' . ( $checked ? 'checked' : '' ) . '><label for="' . $post . '"><div></div></label> <strong>' . $post . '</strong></div>';

			$custom_output      = '';
			$user_output        = '';
			$custom_classes     = $args['class_checks_list'];
			$custom_option_name = $args['option_name'];

			if ( isset( $_POST['edit_admin_page'] ) ) {
				$custom_checkbox = get_option( $custom_option_name );
			}

			$custom_post_caps = get_post_type_object( $post )->cap;

			$user_output  = '';
			$user_name    = $args['label_for'];
			$user_classes = $args['class_user'];
			$option_name  = $args['option_name'];
			$user_checked = false;

			if ( isset( $_POST['edit_admin_page'] ) ) {
				$checkbox = get_option( $option_name );
			}

			$users = get_users();

			foreach ( $users as $user ) {
				if ( isset( $_POST['edit_admin_page'] ) ) {
					$user_checked = isset( $checkbox[ $_POST['edit_admin_page'] ][ $user_name ][ $post ]['users'][ $user->data->ID ] ) ?: false;
				}

				$user_output = '<div class="' . $user_classes . ' mb-10"><input type="checkbox" id="' . $post . $user->data->ID . '" name="' . $option_name . '[' . $user_name . '][' . $post . '][users][' . $user->data->ID . ']" value="1" class="" ' . ( $user_checked ? 'checked' : '' ) . '><label for="' . $post . $user->data->ID . '"><div></div></label> <strong>' . $user->data->user_login . '</strong></div>';

				foreach ( $custom_post_caps as $custom_cap ) {
					if ( ! $checked ) {
						$custom_output = '';
						$user_output   = '';
					}
					/*
					elseif ( ! $user_checked ) {
					$custom_output = '';
					$user_output = '';
					} */ /* elseif( $user_checked ) { */

					if ( isset( $_POST['edit_admin_page'] ) ) {
						$custom_checked = isset( $custom_checkbox[ $_POST['edit_admin_page'] ][ $name ][ $post ][ $custom_cap ] ) ?: false;
					}

					$custom_output .= '<div class=" test mb-10"><input type="checkbox" id="' . $custom_cap . '" name="' . $custom_option_name . '[' . $name . '][' . $post . '][' . $custom_cap . ']" value="1" class="" ' . ( $custom_checked ? 'checked' : '' ) . '><label for="' . $custom_cap . '"><div></div></label> <strong>' . $custom_cap . '</strong></div>';

					/*  } */
				}$custom_output .= $user_output;
			}$output .= '<div class=" cust">' . $custom_output . '</div>';
		}

		echo $output;
	}

	public function checkboxPostCapTypesField( $args ) {
		$output         = '';
		$section_output = '';
		$name           = $args['label_for'];
		$classes        = $args['class'];
		$option_name    = $args['option_name'];
		$checked        = false;

		if ( isset( $_POST['edit_admin_page'] ) ) {
			$checkbox = get_option( $option_name );
		}

		$post_types = get_post_types( array( 'ventus_web_menu_page' => true ) );

		foreach ( $post_types as $post ) {
			if ( isset( $_POST['edit_admin_page'] ) ) {
				$checked = isset( $checkbox[ $_POST['edit_admin_page'] ][ $name ][ $post ] ) ?: false;
			}

			$unique_id = $name . '_' . $post;

			$output .= '<div class="' . $classes . ' mb-10"><input type="checkbox" id="' . $unique_id . '" name="' . $option_name . '[' . $name . '][' . $post . ']" value="1" class="" ' . ( $checked ? 'checked' : '' ) . '><label for="' . $unique_id . '"><div></div></label> <strong>' . $post . '</strong></div>';

			$custom_output         = '';
			$user_output           = '';
			$user_post_name_output = '';
			$custom_classes        = $args['class_checks_list'];
			$class_check           = $args['class_check'];
			$custom_option_name    = $args['option_name'];

			if ( isset( $_POST['edit_admin_page'] ) ) {
				$custom_checkbox = get_option( $custom_option_name );
			}

			$custom_post_caps = get_post_type_object( $post )->cap;

			$user_output  = '';
			$user_name    = $args['label_for'];
			$user_classes = $args['class_user'];
			$option_name  = $args['option_name'];
			$user_checked = false;

			if ( isset( $_POST['edit_admin_page'] ) ) {
				$checkbox = get_option( $option_name );
			}

			$users = get_users();

			foreach ( $users as $user ) {


				if ( isset( $_POST['edit_admin_page'] ) ) {
					$user_checked = isset( $checkbox[ $_POST['edit_admin_page'] ][ $user_name ][ $post ]['users'][ $user->data->ID ] ) ?: false;
				}

				$user_output = '<div class="' . $user_classes . ' mb-10"><input type="checkbox" id="' . $post . $user->data->ID . '" name="' . $option_name . '[' . $user_name . '][' . $post . '][users][' . $user->data->ID . ']" value="1" class="" ' . ( $user_checked ? 'checked' : '' ) . '><label for="' . $post . $user->data->ID . '"><div></div></label> <strong>' . $user->data->user_login . '</strong></div>';

				$check_div_id = $post . '_' . $user->data->ID;
				$user_post_name_output = '<div class="user-name-box">' . $user_output . '</div>';
				$custom_output .= '<div id="'.$post . '_' . $user->data->ID.'" class="user-caps-box">';
				foreach ( $custom_post_caps as $cap_key => $custom_cap ) {
					if ( ! $checked ) {
						$custom_output         = '';
						$user_output           = '';
						$cheked_output         = '';
						$user_post_name_output = '';

					}
					$cheked_output         = '';
					$conveted_cap = $cap_key;


					switch ($conveted_cap) {
					  case "edit_post":
						$conveted_cap =  "Edycja posta";
						break;
					  case "delete_post":
						$conveted_cap = "Usuwanie posta";
						break;
					  case "read_post":
						$conveted_cap = "Czytanie posta";
						break;
					  case "edit_posts":
						$conveted_cap =  "Edycja postów";
						break;
					  case "edit_others_posts":
						$conveted_cap =  "Edycja innych postów";
						break;
					  case "delete_posts":
						$conveted_cap = "Usuwanie postów";
						break;
					  case "publish_posts":
						$conveted_cap = "Publikowanie postów";
						break;
					  case "read_private_posts":
						$conveted_cap =  "Czytanie prywatnych postów";
						break;
					  case "create_posts":
						$conveted_cap = "Tworzenie postów";
						break;
					  case "delete_others_posts":
						$conveted_cap = "Usuwanie innych postów";
						break;
					  case "delete_private_posts":
						$conveted_cap = "Usuwanie prywatnych postów";
						break;
					  case "delete_published_posts":
						$conveted_cap = "Usuwanie opublikowanych postów";
						break;
					  case "edit_private_posts":
						$conveted_cap =  "Edycja prywatnych postów";
						break;
					  case "edit_published_posts":
						$conveted_cap = "Edycja opublikowanych postów";
						break;
					  default:
					  $conveted_cap = ":)";
					}

					if ( isset( $_POST['edit_admin_page'] ) ) {
						$custom_checked = isset( $custom_checkbox[ $_POST['edit_admin_page'] ][ $name ][ $post ][ $user->data->ID ][ $custom_cap ] ) ?: false;
					}
					if ( $checked && $user_checked ) {
						$checbox_id     = 'user_' . $user->data->ID . '_' . $custom_cap;
						$custom_output .= '<div class="' . $class_check . ' m-10"><input type="checkbox" id="' . $checbox_id . '" name="' . $custom_option_name . '[' . $name . '][' . $post . '][' . $user->data->ID . '][' . $custom_cap . ']" value="1" class="" ' . ( $custom_checked ? 'checked' : '' ) . '><label title="' . $checbox_id .  '" for="' . $checbox_id . '"><div></div></label> <strong>' . $conveted_cap . '</strong></div>';
					}

				}



				if ( isset( $_POST['edit_admin_page'] ) ) {
					$main_checked = isset( $custom_checkbox[ $_POST['edit_admin_page'] ][ $name ][ $post ][ $check_div_id] ) ?: false;
				}

				if ( $user_checked ) {



				$user_post_name_output .= '<input 
				type="checkbox" 
				id="'.$check_div_id.'_main" 
				name="' . $custom_option_name . '[' . $name . '][' . $post . '][' .$check_div_id. ']" 
				value="1" 
				class="" 
				' . ( $main_checked ? 'checked' : '' ) . '
				onload="sampleFunction()" 
				onclick=\'toggle'.$check_div_id.'(this)
			  \' > ' . ( $main_checked ? 'odznacz' : 'zaznacz wszystkie' ) . '
			  <script>
			  function toggle'.$check_div_id.'(source) {
				var mainCheckbox = document.getElementById("'.$check_div_id.'");
				  checkboxes = mainCheckbox.getElementsByTagName("input");

				  for (var i = 0, n = checkboxes.length; i < n; i++) {
					checkboxes[i].checked = source.checked;

					var cheked = 0;
					if ( checkboxes[i].checked ) {
						cheked++;
						if ( cheked = (checkboxes.length - 1)) {
						 
						}
					}
				  }

			  }

			  var mainInput = document.getElementById("'.$check_div_id.'_main");
			  mainInput.addEventListener("load", sampleFunction);
 
				function sampleFunction() {
 
				}
			  </script>'; //div zamykający
			}
			$custom_output .= '</div>'; //div zamykający
				$test =  $custom_output .= $user_post_name_output;


			}

			if ( $checked ) {
				/* $output .= 'CHEKED!!!!'; */

				$cheked_output = ' <h2>' . $post . '</h2>';
			}
/* 			$section_output = ""; */
			if( ! $cheked_output == "" ){
				$section_output .= ' <div class="post-type-title">' . $cheked_output . '</div>' . $test ;
			}

		}

		echo $output;

		echo $section_output;
	}

	public function checkboxUsersListField( $args ) {
		/*
		 $output = '';
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checked = false;

		if ( isset($_POST["edit_admin_page"]) ) {
			$checkbox = get_option( $option_name );
		}


		$users = get_users();

		foreach ($users as $user) {

			if ( isset($_POST["edit_admin_page"]) ) {
				$checked = isset($checkbox[$_POST["edit_admin_page"]][$name][$user->data->ID]) ?: false;
			}

			$output .= '<div class="' . $classes . ' mb-10"><input type="checkbox" id="' . $user->data->ID . '" name="' . $option_name . '[' . $name . '][' . $user->data->ID . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '><label for="' . $user->data->ID . '"><div></div></label> <strong>' . $user->data->user_login . '</strong></div>';

			$post_types = get_post_types( array( 'ventus_web_menu_page' => true ) );

			foreach ($post_types as $post) {

			$custom_cap_output = '';
			$custom_classes = $args['class_checks_list'];
			$custom_cap_option_name = $args['option_name'];


					if ( isset($_POST["edit_admin_page"]) ) {
						$custom_cap_checkbox = get_option( $custom_cap_option_name );
					}

			$custom_post_caps = get_post_type_object( $post )->cap;
			$options = get_option( 'ventusweb_plugin_ap' ) ?: array();

			foreach ( $options as $option ) {
				if( $option['objects'] ) {
					$posts = $option['objects'];

					foreach ( $posts as $post_type => $custom_post ) {

						if( $custom_post == 1 ) {
						} else{
							$post_name = get_post_type_object( $post_type )->labels->name;
							$post_capability = get_post_type_object( $post_type )->cap;
 

							foreach ( $post_capability as $deault_name => $custom_cap_name) {
 

								if ( ! $checked ) {
									$custom_cap_output = '';
								} else {

								if ( isset($_POST["edit_admin_page"]) ) {
									$custom_cap_checked = isset($custom_cap_checkbox[$_POST["edit_admin_page"]][$name][$user->data->ID][$post_type][$custom_cap_name]) ?: false;
								}

									$custom_cap_output .= '<div class="' . $custom_classes . ' mb-10"><input type="checkbox" id="' . $custom_cap_name . '" name="' . $custom_cap_option_name . '[' . $name . '][' . $user->data->ID . '][' . $post_type . '][' . $custom_cap_name . ']" value="1" class="" ' . ( $custom_cap_checked ? 'checked' : '') . '><label for="' . $custom_cap_name . '"><div></div></label> <strong>' . $custom_cap_name . '</strong></div>';
									}


							} //post_capability

						}

					} //$posts
				}
			}//$options
		}$output .= '<div class="' . $custom_classes . '">' . $custom_cap_output . '</div>';
		}
		echo $output;
		echo 'xxxxxxxczxzxc'; */
	}
}
