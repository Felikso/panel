<?php 
/**
 * @package  VentusWEBPlugin
 */

namespace Inc\MetaBoxes\Inc;

use WPGraphQL\Data\DataSource;
use WPGraphQL\Model\Post;
use WPGraphQL\Connection\PostObjects;
use WPGraphQL\Data\Connection\PostObjectConnectionResolver;


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// metabox creating main class
class MetaboxClass
{

	protected $args = [];

	protected $defaults = [];

	public function __construct( $args )
	{

		$this->defaults = [
			'id'			=> 'mx-extra-metabox-1',
			'post_name'		=> [],
			'post_types' 	=> ['page'],
			'name'			=> esc_html( 'Extra metabox 1', 'mx-domain' ),
			'human_name'	=> null,
			'metabox_type'	=> 'input-text',
			'context' 		=> 'normal', // normal, side or advanced 
			'priority' 		=> 'high', // high, low, core, default
				'options' 	=> [],
				'objects' 	=> [],
			'default' 		=> '',
			'min'  => 0,
			'step' => 100,
			'function' => "addNewField(this)",
			'button-text' => 'button',
			'limit' => 100
		];

		$this->args = wp_parse_args( $args, $this->defaults );

		if( is_array( $this->args['post_types'] ) ) :

			$this->args['metabox_id'] = $this->args['id'] . '_' . implode( '_',  $this->args['post_types'] );

		else :

			$this->args['metabox_id'] = $this->args['id'] . '_' . $this->args['post_types'];

		endif;

		$this->args['post_meta_key'] = '_mx_' . $this->args['metabox_id'] . '_id';
		$this->args['nonce_action']  = $this->args['metabox_id'] . '_nonce_action';
		$this->args['nonce_name']    = $this->args['metabox_id'] . '_nonce_name';
		$this->args['min']  = $this->args['min'];
		$this->args['step']  = $this->args['step'];
		$this->args['function']  = $this->args['function'];
		$this->args['button-text']  = $this->args['button-text'];
		$this->args['limit']  = $this->args['limit'];

		// add options area
		if( $this->args['metabox_type'] == 'checkbox' ) {

			$i = 0;

			foreach ( $this->args['options'] as $key => $value ) {
				
				$this->args['options'][$key]['name'] = $this->args['post_meta_key'] . $i;

				$i++;

			}		

		}

		// add options area
		if( $this->args['metabox_type'] == 'multi-text-field' ) {

			$this->args['post_meta_key'] = '_mx_' . $this->args['metabox_id'] . '_id';	

		}

		// add options area
		if( $this->args['metabox_type'] == 'dynamic-gallery-image' ) {

			$this->args['post_meta_key'] = '_mx_' . $this->args['metabox_id'] . '_id';	

		}

		// add options area
		if( $this->args['metabox_type'] == 'multi-drag-drop-gallery' ) {

			$this->args['post_meta_key'] = '_mx_' . $this->args['metabox_id'] . '_id';	
		
		}

		// each option for metabox

		if( $this->args['metabox_type'] == 'multi-block' ) {

			$i = 0;

			foreach ( $this->args['objects'] as $key => $value ) {
				
				$this->args['objects'][$key]['name'] = $this->args['post_meta_key'] . $i;

				$i++;

			}			

		}

		// each photo for gallery

		if( $this->args['metabox_type'] == 'image-gallery' ) {

			$i = 0;

			foreach ( $this->args['options'] as $key => $value ) {
				
				$this->args['options'][$key]['name'] = $this->args['post_meta_key'] . $i;

				$i++;

			}			

		}

		if ( $this->args['post_name'] === null){ //default add metabox for all posts
			add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );

		}elseif(isset($_GET['post'])){
			$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID']; //getting post id
			$post = get_post($post_id);
			if (is_array($this->args['post_name'])) {
				foreach( $this->args['post_name'] as $postName ) {
					if($post->post_name == $postName)
					{
						add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
					}
				}
			}//check array of single post names and add to them metabox



		} 

		add_action( 'save_post', [ $this, 'save_meta_box' ] );
		add_action( 'graphql_register_types', [ $this, 'type_graphql_register' ] );
		add_action( 'graphql_register_types', [ $this, 'connection_graphql_register' ] );
		add_action( 'graphql_register_types', [ $this, 'meta_graphql_register' ] );

	}


	public function ventusweb_gallery_field( $name, $value = '' ) {

		$html = '<div><ul class="ventusweb_gallery_mtb">';
		/* array with image IDs for hidden field */
		$hidden = array();
	
		
		if( $images = get_posts( array(
			'post_type' => 'attachment',
			'orderby' => 'post__in', /* we have to save the order */
			'order' => 'ASC',
			'post__in' => explode(',',$value), /* $value is the image IDs comma separated */
			'numberposts' => -1,
			'post_mime_type' => 'image'
		) ) ) {
	
			foreach( $images as $image ) {
				$hidden[] = $image->ID;
				$image_src = wp_get_attachment_image_src( $image->ID, array( 80, 80 ) );
				$html .= '<li data-id="' . $image->ID .  '"><span style="background-image:url(' . $image_src[0] . ')"></span><a href="#" class="ventusweb_gallery_remove">&times;</a></li>';
			}
	
		}
	
		$html .= '</ul><div style="clear:both"></div></div>';
		$html .= '<input type="hidden" name="'.$name.'" value="' . join(',',$hidden) . '" /><a href="#" class="button ventusweb_upload_gallery_button">Add Images</a>';
	
		return $html;
	}

	// add post meta
	public function add_meta_box() {
		add_meta_box(
			$this->args['metabox_id'],
			$this->args['name'],
			[ $this, 'meta_box_content' ],
			$this->args['post_types'],
			$this->args['context'],
			$this->args['priority'],
			$this->args['min'],
			$this->args['step'],
			$this->args['function'],
			$this->args['button-text'],
			$this->args['limit'],
		);
	}

	// save post meta
	public function save_meta_box( $post_id ) {
						// verify if this is an auto save routine. 
	   // If it is our form has not been submitted, so we dont want to do anything
	   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		  return;


		if ( ! isset( $_POST[ $this->args['nonce_name'] ] ) || ! wp_verify_nonce( wp_unslash( $_POST[ $this->args['nonce_name'] ] ), $this->args['nonce_action'] ) ) { // phpcs:ignore WordPress.Security
			return;
		}



		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$allowed = array(
			'a' => array( // on allow a tags
				'href' => array() // and those anchors can only have href attribute
			)
		);

		$value = $this->args['default'];

		if ( isset( $_POST ) && isset( $_POST[ $this->args['post_meta_key'] ] ) ) :

			if( $this->args['metabox_type'] == 'input-email' ) :

				// email field
				$value = sanitize_email( wp_unslash( $_POST[ $this->args['post_meta_key'] ] ) );

			elseif( $this->args['metabox_type'] == 'color-picker' ) :

				// color-picker field
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );


			elseif( $this->args['metabox_type'] == 'number' ) :

				// number field
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );
				$min = $_POST[ $this->args['min']];
				$step = $_POST[ $this->args['step']];

			elseif( $this->args['metabox_type'] == 'multi-text-field' ) :

				// multi text field
				$value = $_POST[ $this->args['post_meta_key'] ];

				elseif( $this->args['metabox_type'] == 'dynamic-gallery-image' ) :

					// dynamic image id

					$value =  $_POST[ $this->args['post_meta_key'] ];


					elseif( $this->args['metabox_type'] == 'multi-drag-drop-gallery' ) :

						// dynamic image id
	
						$value =  $_POST[ $this->args['post_meta_key'] ];

			elseif( $this->args['metabox_type'] == 'button' ) :
				// button field
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );
				$function = $_POST[ $this->args['function']];
				$buttonText = $_POST[ $this->args['button-text']];
			
			elseif( $this->args['metabox_type'] == 'file' ) :

				// file field
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

			elseif( $this->args['metabox_type'] == 'input-url' ) :

				// url field
				$value = esc_url_raw( $_POST[ $this->args['post_meta_key'] ] );


			elseif( $this->args['metabox_type'] == 'textarea' ) :

				// textarea field
				$value = sanitize_textarea_field( $_POST[ $this->args['post_meta_key'] ] );

			elseif( $this->args['metabox_type'] == 'editor' ) :

			// textarea field
			$value =   $_POST[ $this->args['post_meta_key'] ] ;

			elseif( $this->args['metabox_type'] == 'html' ) :

				// textarea field (save HTML)
				$value = htmlspecialchars( $_POST[ $this->args['post_meta_key'] ] );
				// use "htmlspecialchars_decode()" to decode

			elseif( $this->args['metabox_type'] == 'image' ) :

				// image id
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

			elseif( $this->args['metabox_type'] == 'video' ) :

				// video id
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

			elseif( $this->args['metabox_type'] == 'document' ) :

				// document id
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

			elseif( $this->args['metabox_type'] == 'select' ) :

				// select id
				$value =  sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

			elseif( $this->args['metabox_type'] == 'radio' ) :

				// radio value
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

					elseif( $this->args['metabox_type'] == 'multi-block' ) :

						$_value = '';
		
						// photo value
						foreach( $this->args['objects'] as $key => $val ) {
		
							if( isset( $_POST[ $val['name'] ] ) ) {
		
								$_value = sanitize_text_field( $_POST[ $val['name'] ] );
								
							}
		
							// save data
							update_post_meta( $post_id, $val['name'], $_value );
		
						}
		
						// gallery marker
						$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

				elseif( $this->args['metabox_type'] == 'image-gallery' ) :

					$_value = '';
	
					// photo value
					foreach( $this->args['options'] as $key => $val ) {
	
						if( isset( $_POST[ $val['name'] ] ) ) {
	
							$_value = sanitize_text_field( $_POST[ $val['name'] ] );
							
						}
	
						// save data
						update_post_meta( $post_id, $val['name'], $_value );
	
					}
	
					// gallery marker
					$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

			elseif( $this->args['metabox_type'] == 'checkbox' ) :

				$_value = null;

				// checkbox value
				foreach( $this->args['options'] as $key => $val ) {

					if( isset( $_POST[ $val['name'] ] ) ) {

						$_value = sanitize_text_field( $_POST[ $val['name'] ] );		

					}

					// save data
					update_post_meta( $post_id, $val['name'], $_value );

				}

				// checkbox marker
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

			else :

				// input text
				$value = sanitize_text_field( wp_unslash( $_POST[ $this->args['post_meta_key'] ] ) );

			endif;

		endif;



		// save data
		update_post_meta( $post_id, $this->args['post_meta_key'], $value );
		
	}
 


	// metabox content
	public function meta_box_content( $post, $meta )
	{

		$meta_value = get_post_meta(
			$post->ID,
			$this->args['post_meta_key'],
			true
		); 

		$function=" ";

		if( $this->args['metabox_type'] == 'button' ) {
			$function = $_POST[ $this->args['function']];
		}




		if( $meta_value == '' ) {

			$meta_value = $this->args['default'];

		}

		?>

		<p>
			<label 
			for="
			<?php if( $this->args['metabox_type'] == 'button' ) : ?>
				
				<?php else : ?>
			<?php echo esc_attr( $this->args['post_meta_key'] ); ?>
			<?php endif; ?>
			">
		</label>

			<?php if( $this->args['metabox_type'] == 'input-email' ) : ?>

				<!-- email field -->
				<input 
					type="email" id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					value="<?php echo $meta_value; ?>"
				/>

			<?php elseif( $this->args['metabox_type'] == 'button' ) : ?>
 
				<!-- button field -->
				<input 
				type="button" 
				value="<?php echo $meta_value; ?>"
				name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
				onclick="<?php echo $function; ?>"
				id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
				>

				<?php elseif( $this->args['metabox_type'] == 'color-picker' ) : ?>

					<!-- color-picker field -->
					<div class="custom_meta_box">
					<p>
					<label>Proszę wybrać kolor: </label>
					<input 
					class="color-field" 
					type="text" 
					id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					value="<?php echo $meta_value; ?>"
					/>
					</p>
					<div class="clear"></div> 

				<?php elseif( $this->args['metabox_type'] == 'number' ) : ?>

					<!-- number field -->
					<input 
					type="number"
					step="any"
					id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					value="<?php echo $meta_value; ?>"
					min="<?php echo  $this->args['min']; ?>"
					>

				<?php elseif( $this->args['metabox_type'] == 'multi-text-field' ) : ?>
 
					<div class="input_fields_wrap">
					<a class="add_field_button button-secondary">Add Field</a>
					<?php
					if(isset($meta_value) && is_array($meta_value)) {
						$i = 1;
						$output = '';
						
						foreach($meta_value as $text){
							//echo $text;
							$output = '<div><input type="text" 
							name="' . esc_attr( $this->args['post_meta_key'] ) . '[]" 
							value="' . $text . '"
							data-limit="'. $this->args['limit'].'"
							>';
							if( $i !== 1 && $i > 1 ) $output .= '<a href="#" class="remove_field">usuń opcję</a></div>';
							else $output .= '</div>';
							
							echo $output;
							$i++;
						}
					} else {
						echo '<div><input type="text" 
						name="' . esc_attr( $this->args['post_meta_key'] ) . '[]" 
						value="' . $meta_value . '" 
						data-limit="'. $this->args['limit'].'"
						></div>';
					}
					?>

					<?php

    $x = 1;
    if(is_array($meta_value)) {
        $x = 0;
	
        foreach($meta_value as $text){

            $x++;
        }
    }

	$limit = 10;

	if ( $this->args['limit'] ) {
		$limit = $this->args['limit'];
	}else {
		$limit = $this->defaults['limit'];
	}

        echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
    
    // Dynamic input fields ( Add / Remove input fields )
    var max_fields      = '. $limit .'; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var main_box = $("#my_custom_info")
    
    var x = '.$x.'; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
console.log(\'cliked\')
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append(\'<div><input type="text" name="'. esc_attr( $this->args['post_meta_key'] ) .'[]"  data-limit="'. $this->args['limit'].'"><a href="#" class="remove_field">Usuń</a></div>\');
        };


       });

    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent(\'div\').remove(); x--;
    })
});
</script>';

?>
				</div>


				<?php elseif( $this->args['metabox_type'] == 'dynamic-gallery-image' ) : ?>
 
					<div class="input_fields_wrap_gallery">
					<a class="add_field_button_gallery button-secondary">Add Field</a>
					<?php
					if(isset($meta_value) && is_array($meta_value)) {
						$i = 1;
						$output = '';
						
						foreach($meta_value as $text){


	
								$image_url = wp_get_attachment_url( $text );
							

					
							$none = 'style="display: none;"';
							$url = '';
							if(!$image_url){
								$none = '';
								$url = $image_url;
							}
							//echo $text;
							$output = '<div><div class="mx-image-uploader"><button class="mx_upload_image" '.($image_url ? $none :"" ).' >Wybierz zdjęcie</button><input type="text" 
							name="' . esc_attr( $this->args['post_meta_key'] ) . '[]" 
							value="' . $text . '"
							data-limit="'. $this->args['limit'].'"
							class="mx_save_img_field"
							><input type="image" accept="image/*" id="' . esc_attr( $this->args['post_meta_key'] ) . '"  name="' . esc_attr( $this->args['post_meta_key'] ) . '[]" value="' . $text . '"data-limit="'. $this->args['limit'].'" type="hidden" class="mx_upload_image_save" alt="uploader" type="hidden"><img src="'.wp_get_attachment_url( $text ).'" style="width: 300px;" alt="" class="mx_upload_image_show" '.($image_url ? "" : $none  ).' /><a href="#" class="mx_upload_image_remove" '.($image_url ? "" : $none ).' >Usuń zdjęcie</a></div>';
							if( $i !== 1 && $i > 1 ) $output .= '<a href="#" class="remove_field">usuń opcję</a></div>';
							else $output .= '</div>';
							
							echo $output;
							$i++;
						}
					} else {
						$none = 'style="display: none;';
						$url = '';
						if($meta_value){
							$none = '';
							$url = $meta_value;
						}

						echo '<div class="mx-image-uploader"><button class="mx_upload_image" '.$none.' >Wybierz zdjęcie</button><input type="text" 
						name="' . esc_attr( $this->args['post_meta_key'] ) . '[]" 
						value="' . $meta_value . '" 
						data-limit="'. $this->args['limit'].'"
						class="mx_save_img_field"
						><input type="image" accept="image/*" name="' . esc_attr( $this->args['post_meta_key'] ) . '[]" value="' . $meta_value . '"data-limit="'. $this->args['limit'].'" type="hidden" class="mx_upload_image_save" alt="uploader" type="hidden"><img src="'.wp_get_attachment_url( $meta_value ).'" style="width: 300px;" alt="" class="mx_upload_image_show" '.$none.' /><a href="#" class="mx_upload_image_remove" '.$none.' >Usuń zdjęcie</a></div>';
					}
					?>

					<?php

    $x = 1;
    if(is_array($meta_value)) {
        $x = 0;
	
        foreach($meta_value as $text){

            $x++;
        }
    }

	$limit = 100;

	if ( $this->args['limit'] ) {
		$limit = $this->args['limit'];
	}else {
		$limit = $this->defaults['limit'];
	}

        echo '
<script type="text/javascript">
jQuery(document).ready(function($) {
    
    // Dynamic input fields ( Add / Remove input fields )
    var max_fields      = '. $limit .'; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_gallery"); //Fields wrapper
    var add_button      = $(".add_field_button_gallery"); //Add button ID

    var main_box = $("#my_custom_info")
    
    var x = '.$x.'; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append(\'<div><div class="mx-image-uploader"><button class="mx_upload_image"  >Wybierz zdjęcie</button><input type="text" name="'. esc_attr( $this->args['post_meta_key'] ) .'[]"  data-limit="'. $this->args['limit'].'"><input type="image" accept="image/*" name="' . esc_attr( $this->args['post_meta_key'] ) . '[]" "data-limit="'. $this->args['limit'].'" type="hidden" class="mx_upload_image_save" alt="uploader" type="hidden"><img src="" style="width: 300px;" alt="" class="mx_upload_image_show" /><a href="#" class="mx_upload_image_remove" style="display: none;" >Usuń zdjęcie</a></div><a href="#" class="remove_field">Usuń</a></div>\');
        };


       });

    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent(\'div\').remove(); x--;
    })
});
</script>';

?>
				</div>


				<?php elseif( $this->args['metabox_type'] == 'multi-drag-drop-gallery' ) : ?>

				<?php 
					function ventusweb_gallery_field( $name, $value = '' ) {

						$html = '<div><ul class="ventusweb_gallery_mtb">';
						/* array with image IDs for hidden field */
						$hidden = array();
					
						
						if( $images = get_posts( array(
							'post_type' => 'attachment',
							'orderby' => 'post__in', /* we have to save the order */
							'order' => 'ASC',
							'post__in' => explode(',',$value), /* $value is the image IDs comma separated */
							'numberposts' => -1,
							'post_mime_type' => 'image'
						) ) ) {
					
							foreach( $images as $image ) {
								$hidden[] = $image->ID;
								$image_src = wp_get_attachment_image_src( $image->ID, array( 80, 80 ) );
								$html .= '<li data-id="' . $image->ID .  '"><img src="' . $image_src[0] . '"><a href="#" class="ventusweb_gallery_remove" style="width: 200px;">&times;</a></li>';
							}
					
						}
					
						$html .= '</ul><div style="clear:both"></div></div>';
						$html .= '<input type="hidden" name="'.$name.'" value="' . join(',',$hidden) . '" /><a href="#" class="button ventusweb_upload_gallery_button">Add Images</a>';
					
						return $html;
					}?>
				<?php	echo ventusweb_gallery_field( $this->args['post_meta_key'], get_post_meta(
			$post->ID,
			$this->args['post_meta_key'],
			true
		)  ); ?>
</div>

				<?php elseif( $this->args['metabox_type'] == 'image' ) : ?>

<?php

	$image_url = '';

	if( $meta_value !== '' ) {

		$image_url = wp_get_attachment_url( $meta_value );

	}

?>

<!-- image upload -->
<div class="mx-image-uploader">

	<button
		class="mx_upload_image"
		<?php echo ($image_url  && isset($meta_value)) ? 'style="display: none;"' : ''; ?>
	>Wybierz zdjęcie</button>				

	<!-- here we will save an id of image -->
	<input
		name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
		id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
		type="hidden"
		class="mx_upload_image_save"
		value="<?php echo $meta_value; ?>"
	/>

	<!-- show an image -->
	<img
		src="<?php echo ($image_url  && isset($meta_value))  ? $image_url : ''; ?>"					
		style="width: 300px;"
		alt=""
		class="mx_upload_image_show"
		<?php echo $image_url == '' ? 'style="display: none;"' : ''; ?>						
	/>

	<!-- remove image -->
	<a
		href="#"
		class="mx_upload_image_remove"
		<?php echo $image_url == '' ? 'style="display: none;"' : ''; ?>
	>Usuń zdjęcie</a>

</div>



 <!-- multi text field field -->

					<?php elseif( $this->args['metabox_type'] == 'file' ) : ?>

					<!-- file image field -->
					<input 
					type="file" 
					id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					value="<?php echo $meta_value; ?>"
					accept="image/*"
					>


			<?php elseif( $this->args['metabox_type'] == 'input-url' ) : ?>

				<!-- url field -->
				<input 
					type="url" id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					value="<?php echo $meta_value; ?>"
				/>

			<?php elseif( $this->args['metabox_type'] == 'textarea' ) : ?>

				<!-- textarea field -->
				<textarea name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>" id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>" cols="30" rows="10"><?php echo $meta_value; ?></textarea>

				<?php elseif( $this->args['metabox_type'] == 'editor' ) : ?>

<!-- editor field -->
<?php wp_editor( $meta_value , esc_attr( $this->args['post_meta_key'] ), array() ); ?>

			<?php elseif( $this->args['metabox_type'] == 'html' ) : ?>

				<!-- textarea field -->
				<textarea name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>" id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>" cols="30" rows="10"><?php echo $meta_value; ?></textarea>

			<?php elseif( $this->args['metabox_type'] == 'image' ) : ?>

				<?php

				

					$image_url = '';

					if( $meta_value !== '' ) {

						$image_url = wp_get_attachment_url( $meta_value );

					}

				?>

				<!-- image upload -->
				<div class="mx-image-uploader">

					<button
						class="mx_upload_image"
						<?php echo ($image_url  && isset($meta_value))  || $image_url !== '(unknown)'  ? 'style="display: none;"' : ''; ?>
					>Wybierz zdjęcie</button>				

					<!-- here we will save an id of image -->
					<input
						name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
						id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
						type="hidden"
						class="mx_upload_image_save"
						value="<?php echo $meta_value; ?>"
					/>

					<!-- show an image -->
					<img
						src="<?php echo ($image_url  && isset($meta_value))  ? $image_url : ''; ?>"					
						style="width: 300px;"
						alt=""
						class="mx_upload_image_show"
						<?php echo $image_url == '' ? 'style="display: none;"' : ''; ?>						
					/>

					<!-- remove image -->
					<a
						href="#"
						class="mx_upload_image_remove"
						<?php echo $image_url == '' ? 'style="display: none;"' : ''; ?>
					>Usuń zdjęcie</a>

				</div>

				<?php elseif( $this->args['metabox_type'] == 'multi-block' ) : ?>

<?php

	if( count( $this->args['objects'] ) == 0 ) {
		echo '<p>You have to add some options to the "Options" array!</p>';
	} else {

	
		if( is_array( $this->args['objects'] ) ) {

			?>

			<input type="hidden" name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>" value="ventus-web-type" /><?php


							$i = 0;

							foreach ( $this->args['objects'] as $key => $val ) {
								$input_val = get_post_meta(
									$post->ID,
									$val['name'],
									true
								);
	
								?>
								<p>
								<?php
								if( $val['type'][0] == 'input-text' ) {
									?>
				<!-- input text -->

								<input 
										type="text"
										name="<?php echo esc_attr( $val['name'] ); ?>"
										id="<?php echo esc_attr( $val['name'] ); ?>"
										value="<?php echo $input_val; ?>"
									/>

									<?php
								 } elseif( $val['type'][0] == 'input-url' ) {
									?>
					<!-- input url -->

								<input 
										type="url"
										name="<?php echo esc_attr( $val['name'] ); ?>"
										id="<?php echo esc_attr( $val['name'] ); ?>"
										value="<?php echo $input_val; ?>"

								/>

									<?php 
									} elseif( $val['type'][0] == 'button' ) {
										?>

					<!-- input button -->
	
									<input 
											type="button"
											onclick="addNewField(this)"
											name="<?php echo esc_attr( $val['name'] ); ?>"
											id="<?php echo esc_attr( $val['name'] ); ?>"
											value="<?php echo $input_val; ?>"
	
									/>
<script> 
function addNewField(elem) {

const buttonIdStr = elem.id;

const splitingArray = buttonIdStr.split("_");

const filteredArray = splitingArray.filter(e => e !== "");

const elemPrefix = filteredArray[0];

const elemId = filteredArray[filteredArray.length-1];

const elemPrefixSlicer = "_"+elemPrefix+"_";

const elemIdSlicer = "_"+elemId;

const parentIdStr = buttonIdStr.replace(elemPrefixSlicer, "").replace(elemIdSlicer, "");

const parentElem = elem.closest("#"+parentIdStr);

const parentNodes = parentElem.querySelectorAll('[id*='+parentIdStr+'');

parentNodes.forEach(
function(currentValue, currentIndex, listObj) {

  const node = parentNodes[currentIndex]

  if ( node.required && node.value === "" ) {
	  elem.preventDefault();
  }

},
'myThisArg'
);

  const arrayIds = parentIdStr.match(/\d+/g);

  const newIdLength = arrayIds ? arrayIds.length : null;

  const newId = arrayIds ? arrayIds[newIdLength] : null;

  const elementsParentIdStr = arrayIds ? parentIdStr.substring(0, parentIdStr.length - newIdLength) : parentIdStr

  const elements = document.querySelectorAll('div[id^='+elementsParentIdStr+'');
/* console.log(elements) */
let div = document.getElementById(parentIdStr),
  clone = div.cloneNode(true); // true means clone all childNodes and all event handlers
  id = elements.length;
  clone.id = elementsParentIdStr+""+id;
  elem.remove();
  let normalSortables = document.getElementById('normal-sortables');
  normalSortables.appendChild(clone);

  const nodes = clone.querySelectorAll('[id*='+parentIdStr+'');
/*   console.log(nodes) */
  nodes.forEach(
  function(currentValue, currentIndex, listObj) {
/* 	console.log(currentIndex)
	console.log(nodes[currentIndex]) */
		if ( nodes[currentIndex].id ) {
		nodes[currentIndex].id = nodes[currentIndex].id.replace(parentIdStr, clone.id);
	  }

	  if ( nodes[currentIndex].name ) {
		nodes[currentIndex].name = nodes[currentIndex].name.replace(parentIdStr, clone.id);
	  }


	  if ( nodes[currentIndex].for ) {
		nodes[currentIndex].for = nodes[currentIndex].for.replace(parentIdStr, clone.id);
	  }

/* 	  console.log(nodes[currentIndex].id)
	  console.log(nodes[currentIndex].id.replace(parentIdStr, clone.id)) */
	  if ( nodes[currentIndex].id == clone.id+"_nonce_name") {
		  nodes[currentIndex].value = nodes[currentIndex].value+"fdfd"+id
	  } else {
		  nodes[currentIndex].value = "";
	  }
},
'myThisArg'
);

}</script>
									<?php 
									} elseif( $val['type'][0] == 'color-picker' ) {
										?>

					<!-- input color-picker -->
					<div class="custom_meta_box">
					<p>
					<label>Proszę wybrać kolor: </label>
									<input 
											type="text"
											name="<?php echo esc_attr( $val['name'] ); ?>"
											id="<?php echo esc_attr( $val['name'] ); ?>"
											value="<?php echo $input_val; ?>"
	
									/>
					</p>
					<div class="clear"></div> 

	
										<?php 
										} elseif( $val['type'][0] == 'number' ) {
										?>

					<!-- input number -->
	
									<input 
											type="number"
											step="any"
											min="<?php echo esc_attr( $val['min'] ); ?>"
											max="<?php echo esc_attr( $val['max'] ); ?>"
											name="<?php echo esc_attr( $val['name'] ); ?>"
											id="<?php echo esc_attr( $val['name'] ); ?>"
											value="<?php echo $input_val; ?>"
	
									/>
	
										<?php 
										} elseif( $val['type'][0] == 'multi-text-field' ) {
											?>
	
						<!-- input multi text field -->

										<input 
												type="text"
												data-limit="<?php echo esc_attr( $val['limit'] ); ?>"
												name="<?php echo esc_attr( $val['name'] ); ?>"
												id="<?php echo esc_attr( $val['name'] ); ?>"
												value="<?php echo $input_val; ?>"
										/>
		
											<?php 
											} elseif( $val['type'][0] == 'textarea' ) {
										?>
					<!-- textarea -->
									<textarea 
										name="<?php echo esc_attr( $val['name'] ); ?>" 
										id="<?php echo esc_attr( $val['name'] ); ?>" 
										cols="30" 
										rows="10"><?php echo $input_val; ?>"</textarea>
										<?php 
									} elseif( $val['type'][0] == 'editor' ) {


 wp_editor( $input_val , esc_attr( $val['name'] ), array() ); ?>
										<?php 
										} elseif( $val['type'][0] == 'input-email' ) {
									?>
				<!-- input email -->

								<input 
										type="email"
										name="<?php echo esc_attr( $val['name'] ); ?>"
										id="<?php echo esc_attr( $val['name'] ); ?>"
										value="<?php echo $input_val; ?>"

									/>

									<?php } else {

							
								$photo_value = get_post_meta(
									$post->ID,
									$val['name'],
									true
								);
	
								$image_url = '';
			
								if( $photo_value !== '' ) {
			
									$image_url = wp_get_attachment_url( $photo_value );
			
								}
			
							?>
			
							<!-- image upload -->
							<div class="mx-image-uploader">

								<button
									class="mx_upload_image"
									<?php echo ($image_url  && isset($meta_value))  ? 'style="display: none;"' : ''; ?>
								>Proszę wybrać zdjęcie</button>				
			
								<!-- here we will save an id of image -->
								<input
									name="<?php echo esc_attr( $val['name'] ); ?>"
									id="<?php echo esc_attr( $val['name'] ); ?>"
									type="hidden"
									class="mx_upload_image_save"
									value="<?php echo $photo_value; ?>"
								/>
			
								<!-- show an image -->
								<img
									src="<?php echo ($image_url  && isset($meta_value))  ? $image_url : ''; ?>"					
									style="width: 300px;"
									alt=""
									class="mx_upload_image_show"
									<?php echo $image_url == '' ? 'style="display: none;"' : ''; ?>						
								/>
			
								<!-- remove image -->
								<a
									href="#"
									class="mx_upload_image_remove"
									<?php echo $image_url == '' ? 'style="display: none;"' : ''; ?>
								>Usuń zdjęcie</a>

							</div> 

								<?php 						} 
								?>
								<label for="<?php echo esc_attr( $val['name'] ); ?>"><?php echo  is_numeric(key((array)$val['title'])) ? "" : key((array)$val['title']);; ?></label></p>
								<?php
								 $i++;

/* 							}
						} */
			}//last else
					}//objects if end
						}//main else	
					?>


				<?php elseif( $this->args['metabox_type'] == 'image-gallery' ) : ?>

				<?php
					if( count( $this->args['options'] ) == 0 ) {
						echo '<p>You have to add some options to the "Options" array!</p>';
					} else {
					
						if( is_array( $this->args['options'] ) ) {

							?><input type="hidden" name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>" value="ventus-web-type" /><?php


											$i = 0;
				
											foreach ( $this->args['options'] as $key => $val ) {
												$photo_value = get_post_meta(
													$post->ID,
													$val['name'],
													true
												);
					
												$image_url = '';
							
												if( $photo_value !== '' ) {
							
													$image_url = wp_get_attachment_url( $photo_value );
							
												}
							
											?>
							
											<!-- image upload -->
											<div class="mx-image-uploader">
							
												<button
													class="mx_upload_image"
													<?php echo ($image_url  && isset($meta_value))  ? 'style="display: none;"' : ''; ?>
												>Proszę wybrać zdjęcie</button>				
							
												<!-- here we will save an id of image -->
												<input
													name="<?php echo esc_attr( $val['name'] ); ?>"
													id="<?php echo esc_attr( $val['name'] ); ?>"
													type="hidden"
													class="mx_upload_image_save"
													value="<?php echo $photo_value; ?>"
												/>
							
												<!-- show an image -->
												<img
													src="<?php echo ($image_url  && isset($meta_value))  ? $image_url : ''; ?>"					
													style="width: 300px;"
													alt=""
													class="mx_upload_image_show"
													<?php echo $image_url == '' ? 'style="display: none;"' : ''; ?>						
												/>
							
												<!-- remove image -->
												<a
													href="#"
													class="mx_upload_image_remove"
													<?php echo $image_url == '' ? 'style="display: none;"' : ''; ?>
												>Remove Image</a>
							
											</div>
			
												<?php $i++;
				
											}
										}

										} 
									?>
			

			<!-- video -->
			<?php elseif( $this->args['metabox_type'] == 'video' ) : ?>

				<?php

					$video_url = '';

					if( $meta_value !== '' ) {

						$video_url = wp_get_attachment_url( $meta_value );

					}

				?>

				<!-- video upload -->
				<div class="mx-video-uploader">

					<button
						class="mx_upload_video"
						<?php echo $video_url !== '' ? 'style="display: none;"' : ''; ?>
					>Choose Video</button>				

					<!-- here we will save an id of video -->
					<input
						name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
						id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
						type="hidden"
						class="mx_upload_video_save"
						value="<?php echo $meta_value; ?>"
					/>

					<!-- show an video -->

					<video
						width="400"
						class="video-wrapper"
						autoplay loop
						<?php echo $video_url == '' ? 'style="display: none;"' : ''; ?>
					>
						<source
							src="<?php echo $video_url !== '' ? $video_url : ''; ?>"					
							style="width: 300px;"
							alt=""
							class="mx_upload_video_show"						
							type="video/mp4"
						/>
					Your browser does not support the video tag.</video>

					<!-- remove video -->
					<a
						href="#"
						class="mx_upload_video_remove"
						<?php echo $video_url == '' ? 'style="display: none;"' : ''; ?>
					>Remove video</a>

				</div>
				
			<?php elseif( $this->args['metabox_type'] == 'document' ) : ?>

				<?php

					$document_url = '';

					if( $meta_value !== '' ) {

						$document_url = wp_get_attachment_url( $meta_value );

					}

				?>

				<!-- document upload -->
				<div class="mx-document-uploader">

					<button
						class="mx_upload_document"
						<?php echo $document_url !== '' ? 'style="display: none;"' : ''; ?>
					>Choose Document</button>				

					<!-- here we will save an id of document -->
					<input
						name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
						id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
						type="hidden"
						class="mx_upload_document_save"
						value="<?php echo $meta_value; ?>"
					/>

					<!-- show an document -->

					<p 
						class="mx_upload_document_show"
						<?php echo $document_url == '' ? 'style="display: none;"' : ''; ?>
					>
						<?php echo $document_url !== '' ? $document_url : ''; ?>
					</p>

					<!-- remove document -->
					<a
						href="#"
						class="mx_upload_document_remove"
						<?php echo $document_url == '' ? 'style="display: none;"' : ''; ?>
					>Remove document</a>

				</div>
				
			<?php elseif( $this->args['metabox_type'] == 'radio' ) : ?>

				<?php				

					if( count( $this->args['options'] ) == 0 ) {
						echo '<p>You have to add some options to the "Options" array!</p>';
					} else {
					
						if( is_array( $this->args['options'] ) ) {

							$i = 0;

							foreach ( $this->args['options'] as $key => $val ) {

								?>
								<div>
									<input 
										type="radio"
										name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
										id="<?php echo esc_attr( $this->args['post_meta_key'] ) . $i; ?>"
										value="<?php echo $val['value']; ?>" 
										
										<?php if( $meta_value == '' ) : ?>

											<?php echo isset( $val['checked'] ) && $val['checked'] == true  ? 'checked' : ''; ?>

										<?php else : ?>

											<?php echo $meta_value == $val['value'] ? 'checked' : ''; ?>

										<?php endif; ?>


									>
									<label for="<?php echo esc_attr( $this->args['post_meta_key'] ) . $i; ?>"><?php echo $val['value']; ?></label>
								</div>
								
								<?php $i++;

							}

						}

					}
				?>
				<?php elseif( $this->args['metabox_type'] == 'select' ) : ?>

				<?php				

					if( count( $this->args['options'] ) == 0 ) {
						echo '<p>You have to add some options to the "Options" array!</p>';
					} else {
					
						if( is_array( $this->args['options'] ) ) {

							$i = 0;
				?>

								<select 
									name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>" 
									id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>">

								<?php

							foreach ( $this->args['options'] as $key => $val ) {
								?>
								<?php if( $meta_value == '' ) : ?>

									<option 
										value="<?php echo $val['value']; ?>"
										<?php echo isset( $val['selected'] ) && $val['selected'] == true  ? 'selected' : ''; ?>
										>
										<?php echo $val['value']; ?>
									</option>

								<?php else : ?>

									<option 
										value="<?php echo $val['value']; ?>"
										<?php echo $meta_value == $val['value'] ? 'selected' : ''; ?>
										>
										<?php echo $val['value']; ?>
									</option>

								<?php endif; ?>
								
								<?php $i++;

							} ?>
							</select>
							<?php
						}

					}
				?>

			<?php elseif( $this->args['metabox_type'] == 'checkbox' ) : ?>

				<?php					

					if( count( $this->args['options'] ) == 0 ) {
						echo '<p>You have to add some options to the "Options" array!</p>';
					} else {
					
						if( is_array( $this->args['options'] ) ) {

							?><input type="hidden" name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>" value="checkbox-type" /><?php

							$i = 0;

							foreach ( $this->args['options'] as $key => $val ) {

								$checkbox_value = get_post_meta(
									$post->ID,
									$val['name'],
									true
								);

								?>
								<div>
									<input 
										type="checkbox"
										name="<?php echo esc_attr( $val['name'] ); ?>"
										id="<?php echo esc_attr( $val['name'] ); ?>"
										value="<?php echo $val['value']; ?>"

										<?php 
										if( !$meta_value ) {

											echo isset( $val['checked'] ) && $val['checked'] == true  ? 'checked' : '';

										} else {

											echo $val['value'] == $checkbox_value  ? 'checked' : '';

										}

										?>

									>
									<label for="<?php echo esc_attr( $val['name'] ); ?>"><?php echo $val['value']; ?></label>
								</div>

								<?php $i++;

							}

						}						

					}
				?>
				
			<?php else : ?>

				<!-- input text -->
				<input 
					type="text" id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					value="<?php echo $meta_value; ?>"
				/>

			<?php endif; ?>


		</p>

		<?php wp_nonce_field( $this->args['nonce_action'], $this->args['nonce_name'], true, true );

	}

	//for all medias
/* 	public function connection_graphql_register() {
		register_graphql_connection([
			'fromType' => 'ContentNode',
			'toType' => 'MediaItem',
			'fromFieldName' => 'vwAttachedMedia',
			'connectionArgs' => \WPGraphQL\Connection\PostObjects::get_connection_args(),
			'resolve' => function( Post $source, $args, $context, $info ) {
				$resolver = new PostObjectConnectionResolver( $source, $args, $context, $info, 'attachment' );
				$resolver->set_query_arg( 'parent_id', $source->ID );
				return $resolver->get_connection();
			}
		]);
	}
  */

	public function type_graphql_register() {

		//checboxes
		register_graphql_object_type( 'CheckboxField', [
			'fields' => [
				'value'  => [ 'type' => 'String' ],
				'checked' => [ 'type' => 'Boolean' ],
			]
		] );

		register_graphql_object_type( 'CheckboxesField', [
			'description' => __( 'Checkboxes Type', 'ventus-web' ),
			'fields'      => [
				'checkboxOptions'   => [
					'type' => [
						'list_of' => 'CheckboxField'
					]
				]
			],
		] );

				//multibox
				register_graphql_object_type( 'MultiboxField', [
					'fields' => [
						'description' => __( 'type of field', 'ventus-web' ),
						'type'  => [ 'type' => 'String' ],
						'description' => __( 'text input', 'ventus-web' ),
						'content'  => [ 'type' => 'String' ],
						'description' => __( 'text input title', 'ventus-web' ),
						'title'  => [ 'type' => 'String' ],
						'img'   => [ 'type' => 'MediaItem' ],

					]
				] );
		
				register_graphql_object_type( 'MultiboxesField', [
					'description' => __( 'MultiBox Type', 'ventus-web' ),
					'fields'      => [
						'multiBox'   => [
							'type' => [
								'list_of' => 'MultiboxField'
							]
						]
					],
				] );

		//gallery field
		register_graphql_object_type( 'GalleryField', [
			'fields' => [
				'description' => __( 'gallery image', 'ventus-web' ),
				'image'  => [ 'type' => 'String' ],
			]
		] );


		register_graphql_object_type( 'GalleriesField', [
			'description' => __( 'Galleries Type', 'ventus-web' ),
			'fields'      => [
				'galleryOptions'   => [
					'type' => [
						'list_of' => 'GalleryField'
					]
				]
			],
		] );

		//paragraphs
		register_graphql_object_type( 'ParagraphField', [
			'fields' => [
				'description' => __( 'paragraph', 'ventus-web' ),
				'paragraph'  => [ 'type' => 'String' ],
			]
		] );

		register_graphql_object_type( 'Paragraphs', [
			'description' => __( 'Paragraphs Type', 'ventus-web' ),
			'fields'      => [
				'fieldsList'   => [
					'type' => [
						'list_of' => 'ParagraphField'
					]
				]
			],
		] );

		//dynamic images
		register_graphql_object_type( 'ImageField', [
			'fields' => [
				'description' => __( 'gallery image', 'ventus-web' ),
				'image'  => [ 'type' => 'MediaItem' ],
			]
		] );

		register_graphql_object_type( 'Images', [
			'description' => __( 'Galleries Type', 'ventus-web' ),
			'fields'      => [
				'imagesList'   => [
					'type' => [
						'list_of' => 'ImageField'
					]
				]
			],
		] );

		//select
		register_graphql_object_type( 'select', [
			'description' => __( 'select', 'ventus-web' ),
			'fields' => [
				'value' => [ 'type' => 'String' ],

			],
		] );


		// img test
		register_graphql_object_type( 'gatsbyImage', [
			'description' => __( 'gatsbyImage', 'ventus-web' ),
			'fields' => [
				'id' => [ 'type' => 'String' ],
				'mediaItemUrl' => [ 'type' => 'String' ],
				'sourceUrl' => [ 'type' => 'String' ],
				'mediaDetails' => [ 'type' => 'String' ],
				'mediaItemId' => [ 'type' => 'String' ],
				'databaseId' => [ 'type' => 'String' ],
				'altText' => [ 'type' => 'String' ],
				'srcSet' => [ 'type' => 'String' ],
				'sizes' => [ 'type' => 'String' ],
				'databaseId' => [ 'type' => 'String' ],
				'description' => [ 'type' => 'String' ],
				'mediaType' => [ 'type' => 'String' ],
				'fileSize' => [ 'type' => 'String' ],
				'mimeType' => [ 'type' => 'String' ],
			],
		] );

		register_graphql_object_type( 'gatsbyGallery', [
			'description' => __( 'Galleries Type', 'ventus-web' ),
			'fields'      => [
				'photo'   => [
					'type' => [
						'list_of' => 'gatsbyImage'
					]
				]
			],
		] );
	}

 	public function meta_graphql_register() {

		$graphql_name = iconv('utf8', 'ascii//translit',  esc_html( (isset($this->args['human_name']) ? $this->args['human_name'] : $this->args['name']) , 'mx-domain' ));


		/* if ( isset( $_POST ) && isset( $_POST[ $this->args['post_meta_key'] ] ) ){ */
			if( $this->args['metabox_type'] == 'checkbox' ){

				register_graphql_field(
					$this->args['post_types'], $graphql_name,
					[
						'description' => __( $this->args['name'], 'wp-graphql' ),
						'type'        => 'CheckboxesField',
						'resolve'     => function ( $post ) {

							/* $names = get_post_meta( $post->ID, $this->args['post_meta_key'], true ); */
							$graph_field = key((array)$this->args['options'][0]); //set default if empty for value key

							$someOptions =   [
								[
									'value' => 'żółty',
								],
								[
									'value' => 'pomarańczowy',
									'checked' 	=> true
								],
								[
									'value' => 'zielony',
								],
								[
									'value' => 'beżowy',
									'checked' 	=> true
								],		
								];
							
							


							$checkboxArray = array();
							$i = 0;
							foreach( $this->args['options'] as $key => $option ){
								
								$names = get_post_meta( $post->ID, $this->args['post_meta_key'] . $i, true );
								$obj = 	 [
									'value' => $this->args['options'][$key]['value'],
									'checked' => $this->args['options'][$key]['value'] ===  $names ? true : false,
								];
			
								array_push( $checkboxArray, $obj );
								$i++;
							}

							return [
								'checkboxOptions'  => $checkboxArray,
							];
		
						},
					]
					);

			}

			if( $this->args['metabox_type'] == 'multi-block' ){

				register_graphql_field(
					$this->args['post_types'], $graphql_name,
					[
						'description' => __( $this->args['name'], 'wp-graphql' ),
						'type'        => 'MultiboxesField',
						'resolve'     =>  function( $post, $args, $context, $info ) {

							$checkboxArray = array();
							$i = 0;
							foreach( $this->args['objects'] as $key => $option ){
								$graph_field = key((array)$option['title']);
								$names = get_post_meta( $post->ID, $this->args['post_meta_key'] . $i, true );
								$img_id = absint(get_post_meta( $post->ID, $this->args['post_meta_key'] . $i, true ));
								$obj = 	 [
									'type' => $option['field'][0],
									'title' => $graph_field,
									'content' => preg_match('/^[0-9]+$/', $names) ? absint($names) : $names,
									'img' => DataSource::resolve_post_object( $img_id, $context )
									
								];
			
								array_push( $checkboxArray, $obj );
								$i++;
							}

							return [
								'multiBox'  => $checkboxArray,
							];
		
						},
					]
				);
			

			}

			if( $this->args['metabox_type'] == 'image-gallery' ){

				register_graphql_field(
					$this->args['post_types'], $graphql_name,
					[
						'description' => __( $this->args['name'], 'wp-graphql' ),
						'type'        => 'GalleriesField',
						'resolve'     => function ( $post ) {
							$graph_field = key((array)$this->args['options'][0]); //set default if empty for value key
							

							$checkboxArray = array();
							$i = 0;
							foreach( $this->args['options'] as $key => $option ){
								
								$names = get_post_meta( $post->ID, $this->args['post_meta_key'] . $i, true );
								$obj = 	 [
									'image' => $names,
								];
			
								array_push( $checkboxArray, $obj );
								$i++;
							}

							return [
								'galleryOptions'  => $checkboxArray,
							];
		
						},
					]
				);
			}

			if( $this->args['metabox_type'] == 'dynamic-gallery-image' ){

				register_graphql_field(
					$this->args['post_types'], $graphql_name,
					[
						'description' => __( $this->args['name'], 'wp-graphql' ),
						'type'        => 'Images',
						'resolve' => function( $post, $args, $context, $info ) {
							$names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );

							$galleryArray = array();
							$i = 0;
							foreach ($names as $item) {
								if(is_numeric($item)) {
									$img = DataSource::resolve_post_object( $item, $context );
									$obj = 	 [
										'image' => $img,
									];
									array_push($galleryArray, $obj);
									$i++;
								}

							}

							return [
								'imagesList'  => $galleryArray,
							];
					  },
					]
				);
			}
			if( $this->args['metabox_type'] == 'multi-drag-drop-gallery' ){

				register_graphql_field(
					$this->args['post_types'], $graphql_name,
					[
						'description' => __( $this->args['name'], 'wp-graphql' ),
						'type'        => 'Images',
						'resolve' => function( $post, $args, $context, $info ) {
							$names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );


							$galleryArray = array();
							$i = 0;
							foreach (explode(',', $names) as $item) {
								if(is_numeric($item)) {
									$img = DataSource::resolve_post_object( $item, $context );
									$obj = 	 [
										'image' => $img,
									];
									array_push($galleryArray, $obj);
									$i++;
								}

							}
							return [
								'imagesList'  => $galleryArray,
							];
					  },
					]
				);
			}
			

			elseif( $this->args['metabox_type'] == 'select' ){

				register_graphql_field( $this->args['post_types'], $graphql_name, [
					'type' => 'String',
					'description' => __( $this->args['name'], 'wp-graphql' ),
					'resolve' => function( $post ) {
					$names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );
					$graph_field = key((array)$this->args['options'][0]); //set default if empty for value key
					return ! empty( $names ) ? $names : $this->args['options'][0][$graph_field];
				}] );

			}
			elseif( $this->args['metabox_type'] == 'image' ){
				

				register_graphql_field( $this->args['post_types'], $graphql_name, [
					'description' => __( $this->args['name'], 'wp-graphql' ),
					'type' => 'MediaItem',
					'resolve' => function( $root, $args, $context, $info ) {
						$names = absint(get_post_meta( $root->ID, $this->args['post_meta_key'], true ));
						return DataSource::resolve_post_object( $names, $context );
				},
				
				 ] );

			}
			elseif( $this->args['metabox_type'] == 'multi-text-field' ){
				

				register_graphql_field( $this->args['post_types'], $graphql_name, [
					'type' => 'Paragraphs',
					'description' => __( $this->args['name'], 'wp-graphql' ),
/* 					'resolve' => function( $post ) {
					  $names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );

					  $data = json_encode($names);
 
					  return ! empty( $names ) ? $data : 0;
				}, */
				'resolve' => function( $post, $args, $context, $info ) {
					$names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );
					$data = json_encode($names);

					$paragraphsArray = array();
					$i = 0;

					foreach ($names as $item) {
						if(is_string($item)) {
							$obj = 	 [
								'paragraph' => $item,
							];
							array_push($paragraphsArray, $obj);
							$i++;
						}

						}
					return [
						'fieldsList'  => $paragraphsArray,
					];
			  },
				
				 ] );

			} 
			else{


				register_graphql_field( $this->args['post_types'], $graphql_name, [
					'type' => 'String',
					'description' => __( $this->args['name'], 'wp-graphql' ),
					'resolve' => function( $post ) {
					  $names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );
					  return ! empty( $names ) ? $names : 0;
					}
				 ] );
			}


	
	} 

	

}