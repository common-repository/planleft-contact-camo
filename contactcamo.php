<?php

/**
 * @link              https://planleft.com/contactcamo
 * @since             1.0.0
 * @package           ContactCamo
 *
 * @wordpress-plugin
 * Plugin Name:       Contact Camo
 * Plugin URI:        https://planleft.com/contactcamo
 * Description:       This plugin provides several methods of securely obfuscating email addresses from bots and spammers.
 * Version:           1.0.10
 * Author:            Plan Left
 * Author URI:        https://planleft.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       contactcamo
 * Domain Path:       /languages
 * Requires PHP:      8.0
 * Requires at least: 5.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Current plugin version.
 */
define( 'CONTACTCAMO_VERSION', '1.0.10' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-contactcamo-activator.php
 */
function activate_contactcamo() {

    require_once plugin_dir_path( __FILE__ ) . 'includes/class-contactcamo-activator.php';
    ContactCamo_Activator::activate();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-contactcamo-deactivator.php
 */
function deactivate_contactcamo() {

    require_once plugin_dir_path( __FILE__ ) . 'includes/class-contactcamo-deactivator.php';
    ContactCamo_Deactivator::deactivate();

}

register_activation_hook( __FILE__, 'activate_contactcamo' );
register_deactivation_hook( __FILE__, 'deactivate_contactcamo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-contactcamo.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_contactcamo() {

    $plugin = new ContactCamo();
    $plugin->run();

}
run_contactcamo();
