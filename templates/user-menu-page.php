<div class="wrap">
	<h1>Panel zarządzania treścią</h1> 
	<p> Witaj <?php echo wp_get_current_user()->data->display_name; ?>! :) </p>
	<p> Poniżej znajdują się strony, którymi możesz bezpośrednio zarządzać </p>
	<p> W razie wszekich wątpliwości sprawdź zakładkę kontakt i po prostu odezwij się do mnie </p>
	<h6> Miłego zarządzania treścią swojej strony www! :) </h6>

	<?php settings_errors(); ?>

	<?php 
	
	$options = get_option( 'ventusweb_plugin_ap' ) ?: array();

	$query = $_SERVER['QUERY_STRING'];

	$current_menu_page = str_replace( 'page=', '', $query );

	echo '<script>';
	echo 'console.log('. json_encode($options , JSON_HEX_TAG) .')';
	echo '</script>';

	foreach( $options as $option ) {

		if( $option['admin_page'] ===  $current_menu_page ) {

			$title = $option['singular_name'];
			$current_cpts = $option['objects_cap'];
		}

	}

	?>



	<ul class="nav nav-tabs">
		<li class="<?php echo !isset($_POST["edit_admin_page"]) ? 'active' : '' ?>"><a href="#tab-1"><?php echo $title ?> </a></li>
		<li><a href="#tab-2">Kontakt</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane <?php echo !isset($_POST["edit_admin_page"]) ? 'active' : '' ?>">

			<h3>Twoje posty do edycji</h3>

			<?php 
				$options = get_option( 'ventusweb_plugin_ap' ) ?: array();

				echo '<table class="cpt-table"><tr><th>ID</th><th>Nazwa</th><th class="text-center">Sprawdź wszystkie</th><th class="text-center">Dodaj nowy</th></tr>';

				foreach ( $current_cpts as $key => $current_cpt ) {

					echo "<tr><td>{$key}</td><td>{$key}</td><td class=\"text-center\">";
					echo '<a href="edit.php?post_type=' . $key . '">';
					submit_button( 'Edycja', 'primary medium', 'button', false);
					echo '</a>';
					echo "</td><td class=\"text-center\">";

					if(current_user_can( 'create_' . $key . '' )) {
						echo '<a href="post-new.php?post_type=' . $key . '">';
						submit_button( 'Dodaj', 'secondary medium', 'button', false);
						echo '</a>';
					}else{
						echo '<a href="#">';
						submit_button( 'Brak możliwości dodania', 'disabled medium', 'button', false);
						echo '</a>';
					}



					echo '</td></tr>';



				}

				echo '</table>';
			?>
			
		</div>

		<div id="tab-2" class="tab-pane <?php echo isset($_POST["edit_admin_page"]) ? 'active' : '' ?>">
		<p> W razie wszelkich wątpliwości zapraszam do bezpośredniego kontaktu ze mną poprzez: </p>
			<ul>
				<li>Messenger</li>
				<li>Whatsapp</li>
				<li>Mail</li>
			</ul>
		</div>
	</div>
</div>