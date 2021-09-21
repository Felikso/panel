<?php 
/**
 * @package  VentusWEBPlugin
 */
namespace Inc\Api\Callbacks;

class UserProfileCallbacks
{

	public function upSectionManager()
	{
		echo 'Create as many User Profiles as you wanttt.';

	}

	public function upSanitize( $input )
	{
		$output = get_option('ventusweb_plugin_up');


		if ( isset($_POST["remove"]) ) {//removing types file from metaboxes

			$coppyPath = VW_CUSTOM_POST_TYPES_PATH . 'removed/' . $_POST["remove"] . '.php';
			$filename = VW_CUSTOM_POST_TYPES_PATH . 'types/' . $_POST["remove"] . '.php';
			if( file_exists( $filename )){
 
				if(! filesize( $filename ) == 0 ){
					copy($filename, $coppyPath);
				}

				unlink( $filename );

			}

			unset($output[$_POST["remove"]]);

			return $output;
		}

		if ( count($output) == 0 ) {
			$output[$input['post_type']] = $input;

			return $output;
		}

		foreach ($output as $key => $value) {
			if ($input['post_type'] === $key) {
				$output[$key] = $input;
			} else {
				$output[$input['post_type']] = $input;
			}
		}
		
		return $output;
	}

	public function textField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$value = '';

		if ( isset($_POST["edit_post"]) ) {
			$input = get_option( $option_name );
			$value = $input[$_POST["edit_post"]][$name];
		}

		echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '" required>';
	}

	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checked = false;

		if ( isset($_POST["edit_post"]) ) {
			$checkbox = get_option( $option_name );
			$checked = isset($checkbox[$_POST["edit_post"]][$name]) ?: false;
		}

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ( $checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
	}

/* 	public function editMetaBoxesField( $args )
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$value = '';

		if ( isset($_POST["edit_post"]) ) {
			$input = get_option( $option_name );
			$value = $input[$_POST["edit_post"]][$name];
		}

		echo '<a target="_blank" href="https://www.robkop.ventus-trade.pl/wp-admin/plugin-editor.php?file=vw-admin-panel-beta%2Finc%2FMetaBoxes%2Ftypes%2F'.$value.'.php&plugin=vw-admin-panel-beta%2Fventusweb-plugin.php"> edytuj '.$value.'  </a>';
	}
 */

public function metaField( )
{

	$meta = get_post_meta( 17, '_mx_name-metabox_lwowskiesmakimenu_id', true );
	$this_post = get_post_type_object('lwowskiesmakimenu');
	$types = get_post_types( [
		'menu_page'   => true
	] );
	foreach ( $types as $type ){

	};

	$query = '
	query MyQuery {
		mediaItems {
		  nodes {
			id
			mediaItemUrl
			mediaItemId
			sourceUrl
			altText
			srcSet
			caption
			sizes
			description
			mediaType
			databaseId
			fileSize
			mimeType
			mediaDetails {
				file
				height
				width
			  }
		  }
		}
	  }
	  
	  
	';
	
	$data = do_graphql_request( $query );
	
	$id = '381';
	
	$mediaArray = $data['data']['mediaItems']['nodes'];

	$image;

	foreach ( $mediaArray as $key => $mediaItem) {

		if ( $mediaItem['mediaItemId']  == $id ){
			$image = $mediaItem;
		}

		
	}
 

	if ( isset($_POST["edit_post"]) ) {

		echo '<a target="_blank" href="https://www.robkop.ventus-trade.pl/wp-admin/plugin-editor.php?file=vw-admin-panel-beta%2Finc%2FMetaBoxes%2Ftypes%2F'.$_POST["edit_post"].'.php&plugin=vw-admin-panel-beta%2Fventusweb-plugin.php"> edytuj '.$_POST["edit_post"].'  </a>';
	}else{
		echo 'nic';
	}


}
	
}