<?php

/**
 * Provide a public-facing view for the plugin's contact form
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/public/partials
 */
?>
<div class="contactcamo is-layout-constrained has-global-padding wp-post-block-content">

        <h4 class="contactcamo-form-message"><?php echo esc_html( $success ); ?></h4>

        <?php if ( $popup ): ?>

            <?php echo wp_kses_post( $link_content ); ?>

            <div class="contactcamo-popup">

                    <strong>Compose Email Message</strong>

                    <div id="contactcamo-close">X</div>

                    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) )?>" method="post" id="contactcamo-email-form">

                        <div class="form-field">
                        
                                <input type="text" name="subject" id="contactcamo-email-form-subject" placeholder="subject" <?php if ( $subject ): ?>value="<?php echo esc_attr( $subject ); ?>"<?php endif; ?> />
                        
                        </div>

                        <div class="form-field">

                                <textarea name="message" id="contactcamo-email-form-message" placeholder="Message..."></textarea>

                        </div>

                        <div class="form-field">

                                <input type="submit" name="submit" id="contactcamo-email-form-submit" value="Send"/>

                        </div>

                        <input type="hidden" name="hash" value="<?php echo esc_attr( $hash ); ?>">

                        <input type="hidden" name="action" value="contactcamo">

                    </form>

            </div>

        <?php else: ?>

            <div class="contactcamo-non-popup <?php echo esc_attr( $class ); ?>" <?php if ( $id ): ?>id="<?php echo esc_attr( $id ); ?>"<?php endif; ?>>

                    <strong><?php echo esc_html( $label ); ?></strong>

                    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) )?>" method="post" id="contactcamo-email-form">

                        <div class="form-field">
                            
                                <input type="text" name="subject" id="contactcamo-email-form-subject" placeholder="subject" <?php if ( $subject ): ?>value="<?php echo esc_attr( $subject ); ?>"<?php endif; ?> />
                        
                        </div>

                        <div class="form-field">

                                <textarea name="message" id="contactcamo-email-form-message" placeholder="Message..."></textarea>

                        </div>

                        <div class="form-field">
                        
                                <input type="submit" name="submit" id="contactcamo-email-form-submit" value="Send"/>

                        </div>

                        <input type="hidden" name="hash" value="<?php echo esc_attr( $hash ); ?>">

                        <input type="hidden" name="action" value="contactcamo">

                    </form>

            </div>

        <?php endif; ?>

</div>
