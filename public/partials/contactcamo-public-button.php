<?php

/**
 * Provide a public-facing view for the plugin's shortcode button.
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/public/partials
 */
?>

<button type="button" style="cursor:pointer;" <?php if ( $id ): ?>id="<?php echo esc_attr( $id ); ?>"<?php endif; ?> <?php if ( $class ): ?>class="<?php echo esc_attr( $class ); ?>"<?php endif; ?> data-email="<?php echo esc_attr( $hash ); ?>" data-subject="<?php echo esc_attr( $subject ); ?>"><?php echo esc_html( $label ); ?></button>
