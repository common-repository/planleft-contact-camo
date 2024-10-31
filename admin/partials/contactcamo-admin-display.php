<?php

/**
 * Provide an admin area view.
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/admin/partials
 */
?>

<h1> <?php esc_html_e( 'Contact Camo Configuration', 'contactcamo' ); ?> </h1>

<form method="post" action="options.php" id="contactcamo-admin-settings-form">
	<?php
	settings_fields( 'contactcamo' );
	do_settings_sections( 'contactcamo' );
	submit_button();
	?>
</form>
