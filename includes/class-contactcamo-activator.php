<?php

/**
 * Fired during plugin activation
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    ContactCamo
 * @subpackage ContactCamo/includes
 * @author     Plan Left <info@planleft.com>
 */
class ContactCamo_Activator {

        /**
         * @since    1.0.0
         */
        public static function activate() {

		global $wpdb;

		$table_name = $wpdb->prefix . 'contactcamo';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			email tinytext NOT NULL,
			hash varchar(255) DEFAULT '' NOT NULL,	
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		dbDelta( $sql );

        }

}
