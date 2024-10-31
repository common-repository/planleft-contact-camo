<?php

/**
 * The core plugin class.
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/includes
 */

/**
 * The core plugin class.
 *
 * @since      1.0.0
 * @package    ContactCamo
 * @subpackage ContactCamo/includes
 * @author     Plan Left <info@planleft.com>
 */
class ContactCamo {

        /**
         * The loader that's responsible for maintaining and registering all hooks that power
         * the plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      ContactCamo_Loader    $loader    Maintains and registers all hooks for the plugin.
         */
        protected $loader;

        /**
         * The unique identifier of this plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      string    $plugin_name    The string used to uniquely identify this plugin.
         */
        protected $plugin_name;

        /**
         * The current version of the plugin.
         *
         * @since    1.0.0
         * @access   protected
         * @var      string    $version    The current version of the plugin.
         */
        protected $version;

        /**
         * Define the core functionality of the plugin.
         *
         * @since    1.0.0
         */
        public function __construct() {
                if ( defined( 'CONTACTCAMO_VERSION' ) ) {
                        $this->version = CONTACTCAMO_VERSION;
                } else {
                        $this->version = '1.0.0';
                }
                $this->plugin_name = 'contactcamo';

                $this->load_dependencies();
                $this->set_locale();
                $this->define_admin_hooks();
                $this->define_public_hooks();

        }

        /**
         * Load the required dependencies for this plugin.
         *
         * Include the following files that make up the plugin:
         *
         * - ContactCamo_Loader. Orchestrates the hooks of the plugin.
         * - ContactCamo_i18n. Defines internationalization functionality.
         * - ContactCamo_Admin. Defines all hooks for the admin area.
         * - ContactCamo_Public. Defines all hooks for the public side of the site.
         *
         * @since    1.0.0
         * @access   private
         */
        private function load_dependencies() {

                /**
                 * The class responsible for orchestrating the actions and filters of the
                 * core plugin.
                 */
                require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-contactcamo-loader.php';

                /**
                 * The class responsible for defining internationalization functionality
                 * of the plugin.
                 */
                require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-contactcamo-i18n.php';

                /**
                 * The class responsible for defining all actions that occur in the admin area.
                 */
                require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-contactcamo-admin.php';

                /**
                 * The class responsible for defining all actions that occur in the public-facing
                 * side of the site.
                 */
                require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-contactcamo-public.php';

                $this->loader = new ContactCamo_Loader();

        }

        /**
         * Define the locale for this plugin for internationalization.
         *
         * Uses the ContactCamo_i18n class in order to set the domain and to register the hook
         * with WordPress.
         *
         * @since    1.0.0
         * @access   private
         */
        private function set_locale() {

                $plugin_i18n = new ContactCamo_i18n();

                $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

        }

        /**
         * Register all of the hooks related to the admin area functionality
         * of the plugin.
         *
         * @since    1.0.0
         * @access   private
         */
        private function define_admin_hooks() {

                $plugin_admin = new ContactCamo_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_post_contactcamo', $plugin_admin, 'contactcamo_submit', 9999 );
		$this->loader->add_action( 'admin_ajax_contactcamo', $plugin_admin, 'contactcamo_ajax_submit', 9999 );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'contactcamo_admin_menu', 9999 );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'contactcamo_settings_init', 9999 );

        }

        /**
         * Register all of the hooks related to the public-facing functionality
         * of the plugin.
         *
         * @since    1.0.0
         * @access   private
         */
        private function define_public_hooks() {

                $plugin_public = new ContactCamo_Public( $this->get_plugin_name(), $this->get_version() );

                $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 9999 );
                $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', 9999 );

		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes', 9999 );
		$this->loader->add_action( 'rest_api_init', $plugin_public, 'rest_api_initialize', 9999 );
                $this->loader->add_action( 'wp_head', $plugin_public, 'display_custom_plugin_message', 9999 );
        }

        /**
         * Run the loader to execute all of the hooks with WordPress.
         *
         * @since    1.0.0
         */
        public function run() {
                $this->loader->run();
        }

        /**
         * The name of the plugin used to uniquely identify it within the context of
         * WordPress and to define internationalization functionality.
         *
         * @since     1.0.0
         * @return    string    The name of the plugin.
         */
        public function get_plugin_name() {
                return $this->plugin_name;
        }

        /**
         * The reference to the class that orchestrates the hooks with the plugin.
         *
         * @since     1.0.0
         * @return    ContactCamo_Loader    Orchestrates the hooks of the plugin.
         */
        public function get_loader() {
                return $this->loader;
        }

        /**
         * Retrieve the version number of the plugin.
         *
         * @since     1.0.0
         * @return    string    The version number of the plugin.
         */
        public function get_version() {
                return $this->version;
        }

}
