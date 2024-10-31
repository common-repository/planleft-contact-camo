<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

$table_name = $wpdb->prefix . 'contactcamo';

$wpdb->query( "DROP TABLE IF EXISTS $table_name" );

delete_option("contactcamo_setting_field");
