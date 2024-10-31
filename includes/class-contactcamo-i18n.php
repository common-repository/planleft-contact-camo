<?php

/**
 * Define the internationalization functionality.
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    ContactCamo
 * @subpackage ContactCamo/includes
 * @author     Plan Left <info@planleft.com>
 */
class ContactCamo_i18n {

        /**
         * Load the plugin text domain for translation.
         *
         * @since    1.0.0
         */
        public function load_plugin_textdomain() {

                load_plugin_textdomain(
                        'contactcamo',
                        false,
                        dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
                );

        }

}
