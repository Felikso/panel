<div class="wrap">
	<h1>Admin Page Managerrr</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="<?php echo !isset($_POST["edit_admin_page"]) ? 'active' : '' ?>"><a href="#tab-1">Your Admin Pages</a></li>
		<li class="<?php echo isset($_POST["edit_admin_page"]) ? 'active' : '' ?>">
			<a href="#tab-2">
				<?php echo isset($_POST["edit_admin_page"]) ? 'Edit' : 'Add' ?> Admin Page
			</a>
		</li>
		<li><a href="#tab-3">Export</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane <?php echo !isset($_POST["edit_admin_page"]) ? 'active' : '' ?>">

			<h3>Manage Your Custom Admin Pages</h3>

			<?php 
				$options = get_option( 'ventusweb_plugin_ap' ) ?: array();

				echo '<table class="cpt-table"><tr><th>ID</th><th>Singular Name</th><th class="text-center">Hierarchical</th><th class="text-center">Actions</th></tr>';

				foreach ($options as $option) {
					$hierarchical = isset($option['hierarchical']) ? "TRUE" : "FALSE";

					echo "<tr><td>{$option['admin_page']}</td><td>{$option['singular_name']}</td><td class=\"text-center\">{$hierarchical}</td><td class=\"text-center\">";

					echo '<form method="post" action="" class="inline-block">';
					echo '<input type="hidden" name="edit_admin_page" value="' . $option['admin_page'] . '">';
					submit_button( 'Edit', 'primary small', 'submit', false);
					echo '</form> ';

					echo '<form method="post" action="options.php" class="inline-block">';
					settings_fields( 'ventusweb_plugin_ap_settings' );
					echo '<input type="hidden" name="remove" value="' . $option['admin_page'] . '">';
					submit_button( 'Delete', 'delete small', 'submit', false, array(
						'onclick' => 'return confirm("Are you sure you want to delete this Custom Admin Page? The data associated with it will not be deleted.");'
					));
					echo '</form></td></tr>';
				}

				echo '</table>';
			?>
			
		</div>

		<div id="tab-2" class="tab-pane <?php echo isset($_POST["edit_admin_page"]) ? 'active' : '' ?>">
			<form method="post" action="options.php">
				<?php 
					settings_fields( 'ventusweb_plugin_ap_settings' );
					do_settings_sections( 'ventusweb_admin_page' );
					submit_button();
				?>
			</form>
		</div>

		<div id="tab-3" class="tab-pane">
			<h3>Export Your Admin Pages</h3>

		</div>
	</div>
</div>