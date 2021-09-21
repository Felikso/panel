<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// metabox creating main class
class MetaboxClass
{

	protected $args = [];

	protected $defauls = [];

	public function __construct( $args )
	{

		$this->defaults = [
			'id'			=> 'mx-extra-metabox-1',
			'post_name'		=> null,
			'post_types' 	=> ['page'],
			'name'			=> esc_html( 'Extra metabox 1', 'mx-domain' ),
			'human_name'	=> null,
			'metabox_type'	=> 'input-text',
			'context' 		=> 'normal', // normal, side or advanced 
			'priority' 		=> 'high', // high, low, core, default
				'options' 	=> [],
			'default' 		=> '',
			'min'  => 0,
			'step' => 100,
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

		// add options area
		if( $this->args['metabox_type'] == 'checkbox' ) {

			$i = 0;

			foreach ( $this->args['options'] as $key => $value ) {
				
				$this->args['options'][$key]['name'] = $this->args['post_meta_key'] . $i;

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

			if($post->post_name == $this->args['post_name'])
			{
				add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
			}
		} 

		add_action( 'save_post', [ $this, 'save_meta_box' ] );
		add_action( 'graphql_register_types', [ $this, 'type_graphql_register' ] );
		add_action( 'graphql_register_types', [ $this, 'connection_graphql_register' ] );
		add_action( 'graphql_register_types', [ $this, 'meta_graphql_register' ] );

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
		);
	}

	// save post meta
	public function save_meta_box( $post_id ) {
		if ( ! isset( $_POST[ $this->args['nonce_name'] ] ) || ! wp_verify_nonce( wp_unslash( $_POST[ $this->args['nonce_name'] ] ), $this->args['nonce_action'] ) ) { // phpcs:ignore WordPress.Security
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$value = $this->args['default'];

		if ( isset( $_POST ) && isset( $_POST[ $this->args['post_meta_key'] ] ) ) :

			if( $this->args['metabox_type'] == 'input-email' ) :

				// email field
				$value = sanitize_email( wp_unslash( $_POST[ $this->args['post_meta_key'] ] ) );

			elseif( $this->args['metabox_type'] == 'number' ) :

				// number field
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );
				$min = $_POST[ $this->args['min']];
				$step = $_POST[ $this->args['step']];
			
			elseif( $this->args['metabox_type'] == 'file' ) :

				// file field
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

			elseif( $this->args['metabox_type'] == 'input-url' ) :

				// url field
				$value = esc_url_raw( $_POST[ $this->args['post_meta_key'] ] );


			elseif( $this->args['metabox_type'] == 'textarea' ) :

				// textarea field
				$value = sanitize_textarea_field( $_POST[ $this->args['post_meta_key'] ] );

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
				$value = sanitize_text_field( $_POST[ $this->args['post_meta_key'] ] );

			elseif( $this->args['metabox_type'] == 'radio' ) :

				// radio value
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

		if( $meta_value == '' ) {

			$meta_value = $this->args['default'];

		}

		?>

		<p>
			<label for="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"></label>

			<?php if( $this->args['metabox_type'] == 'input-email' ) : ?>

				<!-- email field -->
				<input 
					type="email" id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					value="<?php echo $meta_value; ?>"
				/>

				<?php elseif( $this->args['metabox_type'] == 'number' ) : ?>

					<!-- number field -->
					<input 
					type="number" 
					id="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>"
					value="<?php echo $meta_value; ?>"
					min="<?php echo  $this->args['min']; ?>"
					max="<?php echo $this->args['step']; ?>"
					>

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
						<?php echo $image_url !== '' ? 'style="display: none;"' : ''; ?>
					>Choose image</button>				

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
						src="<?php echo $image_url !== '' ? $image_url : ''; ?>"					
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

				<?php elseif( $this->args['metabox_type'] == 'image-gallery' ) : ?>

				<?php
					if( count( $this->args['options'] ) == 0 ) {
						echo '<p>You have to add some options to the "Options" array!</p>';
					} else {
					
						if( is_array( $this->args['options'] ) ) {

							?><input type="hidden" name="<?php echo esc_attr( $this->args['post_meta_key'] ); ?>" value="gallery-image-type" /><?php


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
													<?php echo $image_url !== '' ? 'style="display: none;"' : ''; ?>
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
													src="<?php echo $image_url !== '' ? $image_url : ''; ?>"					
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
									id="<?php echo esc_attr( $this->args['post_meta_key'] ) . $i; ?>">

								<?php

							foreach ( $this->args['options'] as $key => $val ) {
								?>
								<?php if( $meta_value == '' ) : ?>

									<option 
										value=<?php echo $val['value']; ?>
										<?php echo isset( $val['selected'] ) && $val['selected'] == true  ? 'selected' : ''; ?>
										>
										<?php echo $val['value']; ?>
									</option>

								<?php else : ?>

									<option 
										value=<?php echo $val['value']; ?>
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
	public function connection_graphql_register() {
		register_graphql_connection([
			'fromType' => 'ContentNode',
			'toType' => 'MediaItem',
			'fromFieldName' => 'vwAttachedMedia',
			'connectionArgs' => \WPGraphQL\Connection\PostObjects::get_connection_args(),
			'resolve' => function( \WPGraphQL\Model\Post $source, $args, $context, $info ) {
				$resolver = new \WPGraphQL\Data\Connection\PostObjectConnectionResolver( $source, $args, $context, $info, 'attachment' );
				$resolver->set_query_arg( 'parent_id', $source->ID );
				return $resolver->get_connection();
			}
		]);
	}
 

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

		//select
		register_graphql_object_type( 'select', [
			'description' => __( 'select', 'ventus-web' ),
			'fields' => [
				'value' => [ 'type' => 'String' ],
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
							
							
/* 							 if( is_array( $someOptions )){
								$i = 0;
							
								foreach ( $someOptions as $key => $val ){
									$meta_id = '_mx_colors-metabox_lwowskiesmakigallery_id' . $i;
							
									$names = get_post_meta( 20, '_mx_colors-metabox_lwowskiesmakigallery_id' . $i, true );
							

 
									$i++;
								}
							 } */

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
			
		
/* 				register_graphql_field(
					$this->args['post_types'],
					$graphql_name, 
					[
						'description' => __( $this->args['name'], 'wp-graphql' ),
						'type'        => 'checkbox',
						'resolve'     => function( $post ) {
							$names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );
							$graph_field = key((array)$this->args['options'][0]); //set default if empty for value key
							$checkboxArray = array();
							foreach( $this->args['options'] as $option ){
			
								$obj = 	 [
									'value' => $this->args['options'][0][$graph_field],
									'checked' => $names
								];
			
								array_push( $checkboxArray, $obj );
							}
							return ! empty( $names ) ? $names : $this->args['options'][0][$graph_field];
							return $checkboxArray;
			
						},
					]
				); */

			}

			if( $this->args['metabox_type'] == 'image-gallery' ){

				register_graphql_field(
					$this->args['post_types'], $graphql_name,
					[
						'description' => __( $this->args['name'], 'wp-graphql' ),
						'type'        => 'GalleriesField',
						'resolve'     => function ( $post ) {

							/* $names = get_post_meta( $post->ID, $this->args['post_meta_key'], true ); */
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


				/* 
								function get_post_name( $post ) {
									$names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );
									return ! empty( $names ) ? $names : 0;
								}
				 */			
				
				
				
						/* 		register_graphql_field( $this->args['post_types'], $graphql_name, [ 'type' => 'MediaItem' ] ); */
										register_graphql_field( $this->args['post_types'], $graphql_name, [
											'type' => 'String',
											'description' => __( $this->args['name'], 'wp-graphql' ),
											'resolve' => function( $post ) {
											$names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );
											return ! empty( $names ) ? $names : 0;
											}
										] );
				
				/* 				register_graphql_connection([
									'fromType' => 'ContentNode',
									'toType' => 'MediaItem',
									'fromFieldName' => $graphql_name,
									'connectionArgs' => \WPGraphQL\Connection\PostObjects::get_connection_args(),
									'resolve' => function( \WPGraphQL\Model\Post $source, $args, $context, $info ) {
				 
										$resolver = new \WPGraphQL\Data\Connection\PostObjectConnectionResolver( $source, $args, $context, $info, 'attachment' );
										$resolver->set_query_arg( 'post_parent', $source->ID );
					 
				
										$test = $this->args['name'];
				 
										return $resolver->get_connection();
									}
								]); */
				
				

 

			}else{


				register_graphql_field( $this->args['post_types'], $graphql_name, [
					'type' => 'String',
					'description' => __( $this->args['name'], 'wp-graphql' ),
					'resolve' => function( $post ) {
					  $names = get_post_meta( $post->ID, $this->args['post_meta_key'], true );
					  return ! empty( $names ) ? $names : 0;
					}
				 ] );
			}
	/* 	} */



			



	
	} 

	

}