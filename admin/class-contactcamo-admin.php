<?php

/**
 * Admin-specific functionality.
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/admin
 */

/**
 * @package    ContactCamo
 * @subpackage ContactCamo/admin
 * @author     Plan Left <info@planleft.com>
 */
class ContactCamo_Admin {

        /**
         * The ID of this plugin.
         *
         * @since    1.0.0
         * @access   private
         * @var      string    $plugin_name    The ID of this plugin.
         */
        private $plugin_name;

        /**
         * The version of this plugin.
         *
         * @since    1.0.0
         * @access   private
         * @var      string    $version    The current version of this plugin.
         */
        private $version;

        /**
         * Initialize the class and set its properties.
         *
         * @since    1.0.0
         * @param      string    $plugin_name    The name of this plugin.
         * @param      string    $version    The version of this plugin.
         */
        public function __construct( $plugin_name, $version ) {

                $this->plugin_name = $plugin_name;
                $this->version = $version;

        }

        /**
         * Submit handler for shortcode included modal contact form.
         *
         * @since    1.0.0
         */
        public function contactcamo_submit() {

            global $wpdb;

            $table = $wpdb->prefix . 'contactcamo';
            $hashed_email = sanitize_text_field( $_POST['hash'] );

            $where = 'hash = %s';
            $select = "SELECT email FROM {$table} WHERE {$where}";
            $query = $wpdb->prepare( $select, array( $hashed_email ) );
            $result = $wpdb->get_row( $query );

            $to = $result->email;
            $subject = sanitize_text_field( $_POST['subject'] );
            $message = sanitize_textarea_field( $_POST['message'] );

            wp_mail( $to, $subject, $message );

            $redirect = get_option( 'contactcamo_setting_field' ) ?  get_option( 'contactcamo_setting_field' ) : wp_get_referer();
            $redirect = add_query_arg( array( 'message' => 'success' ), $redirect );

            wp_safe_redirect($redirect);

            exit;

        }


        /**
         * Admin menu handler for this plugin's admin settings page.
         *
         * @since    1.0.0
         */
        public function contactcamo_admin_menu() {

            add_submenu_page(
                'options-general.php',
                __( 'Contact Camo', 'contactcamo' ),
                __( 'Contact Camo', 'contactcamo' ),
                'manage_options',
                'contactcamo-settings',
                array( $this, 'contactcamo_admin_page_contents' ),
            );

        }

        /**
         * Returns the HTML contents of the admin settings page.
         *
         * @since    1.0.0
         */
        public function contactcamo_admin_page_contents() {

            include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/contactcamo-admin-display.php';

        }

        /**
         * Initializes our admin page settings sections and fields.
         *
         * @since    1.0.0
         */
        public function contactcamo_settings_init() {

            add_settings_section(
                'contactcamo_setting_section',
                __( 'Global Settings', 'contactcamo' ),
                array( $this, 'contactcamo_setting_section_callback' ),
                'contactcamo'
            );

            add_settings_field(
                'contactcamo_setting_field',
                __( 'Contact Form Settings', 'contactcamo' ),
                array( $this, 'contactcamo_setting_markup' ),
                'contactcamo',
                'contactcamo_setting_section'
            );

            register_setting( 'contactcamo', 'contactcamo_setting_field' );

        }

        /**
         * Callback function for our admin page's settings section.
         *
         * @since    1.0.0
         */
        public function contactcamo_setting_section_callback() {

            echo '<p>'. esc_html_e( 'Thank you for choosing Contact Camo!', 'contactcamo' ) .'</p>';

        }

        /**
         * Returns the HTML contents of our admin page's settings field.
         *
         * @since    1.0.0
         */
        public function contactcamo_setting_markup() {

            ?>

            <label for="contactcamo_setting_field"><?php esc_html_e( 'Redirect url after submission:', 'contactcamo' ); ?></label>

            <input type="text" id="contactcamo_setting_field" size="50" name="contactcamo_setting_field" value="<?php echo esc_attr( get_option( 'contactcamo_setting_field' ) ); ?>">

            <?php

        }

}
