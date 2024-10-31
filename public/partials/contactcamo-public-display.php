<?php

/**
 * Provide a public-facing view for the plugin.
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/public/partials
 */
?>

<div class="contactcamo is-layout-constrained has-global-padding wp-post-block-content">

        <div class="contactcamo-hidden-email-text">

		        <?php echo wp_kses_post( $link_content ); ?>

        </div>

</div>
