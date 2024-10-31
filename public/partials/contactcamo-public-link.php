<?php

/**
 * Provide a public-facing view for the plugin's shortcode link
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/public/partials
 */
?>

<a href="#" <?php if ( $id ): ?>id="<?php echo esc_attr( $id ); ?>"<?php endif; ?> <?php if ( $class ): ?>class="<?php echo esc_attr( $class ); ?>"<?php endif; ?> data-email="<?php echo esc_attr( $hash ); ?>" data-subject="<?php echo esc_attr( $subject ); ?>"><?php echo esc_html( $label ); ?></a>
