<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://planleft.com/contactcamo
 * @since      1.0.0
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    ContactCamo
 * @subpackage ContactCamo/public
 * @author     Plan Left <info@planleft.com>
 */
class ContactCamo_Public {

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
         * @param      string    $plugin_name       The name of the plugin.
         * @param      string    $version    The version of this plugin.
         */
        public function __construct( $plugin_name, $version ) {

                $this->plugin_name = $plugin_name;
                $this->version = $version;

        }

        /**
         * Register the stylesheets for the public-facing side of the site.
         *
         * @since    1.0.0
         */
        public function enqueue_styles() {

            wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/contactcamo-public.css', array(), $this->version, false );

        }

        /**
         * Register the JavaScript for the public-facing side of the site.
         *
         * @since    1.0.0
         */
        public function enqueue_scripts() {

                wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/contactcamo-public.js', array( 'jquery' ), $this->version, true );

                wp_add_inline_script( $this->plugin_name, 'const contactcamoajax = ' . json_encode( array(
                        'restURL' => rest_url(),
                        'restNonce'=> wp_create_nonce( 'wp_rest' )
                ) ), 'after' );

        }

        /**
         * Initialize REST API callback for shortcode ajax response.
         *
         * @since    1.0.0
         */
        public function rest_api_initialize() {

			register_rest_route( 'baseURL/v1/baseEndPoint', '/endPoint/', array(
				'methods' => 'GET',
				'callback' => array( $this, 'restAPI_endpoint_callback' ),
				'permission_callback' => '__return_true',
			) );

        }

        /**
         * REST API endpoint callback for shortcode ajax response.
         *
         * @since    1.0.0
         */
        public function restAPI_endpoint_callback() {

		global $wpdb;

		$table = $wpdb->prefix . 'contactcamo';
                $hashed_email = sanitize_text_field( $_GET['hashed_email'] );

                $where = 'hash = %s';
                $select = "SELECT email FROM {$table} WHERE {$where}";
                $query = $wpdb->prepare( $select, array( $hashed_email ) );
                $result = $wpdb->get_row( $query );

                $response = array();
                array_push( $response, $result );

                echo json_encode( $response );

		die;

        }

	/**
	 * Register our plugin's shortcodes.
	 *
	 * @since   1.0.0
	 */
	public function register_shortcodes() {
		add_shortcode( 'contactcamo', array( $this, 'hide_email' ) );
	}

	/**
	 * Create a function to set the message.
	 *
	 * @since   1.0.0
	 */
	public function set_custom_plugin_message($message, $type = 'success') {
		// Check if session is not already active
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// Store the message in a session variable
		$_SESSION['concam'] = array(
			'message' => $message,
			'type' => $type
		);
	}

	/**
	 * Display the message in the template.
	 *
	 * @since   1.0.0
	 */
	public function display_custom_plugin_message() {
		// Check if session is not already active
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if (isset($_SESSION['concam'])) {
			$message = $_SESSION['concam']['message'];
			$type = $_SESSION['concam']['type'];
	
			// Display the message
			echo '<div class="custom-plugin-message ' . $type . '">' . $message . '</div>';
	
			// Once displayed, remove the message
			unset($_SESSION['concam']);
		}
	}

	/**
	 * Implementation of ContactCamo shortcode.
	 *
	 * @since   1.0.0
	 */
	public function hide_email( $atts = array() ) {

		// normalize attribute keys to lowercase
		$atts = array_change_key_case( $atts, CASE_LOWER );

		$form_submitted = '';
		if ( isset( $_GET['message'] ) ) {
			$form_submitted = sanitize_text_field( $_GET['message'] );
		}

		$success = 'success' === $form_submitted ? _e( 'Your message has been sent. Thank you for contacting us!', 'contactcamo' ) : '';

		// get shortcode parameters
		$email   = array_key_exists( 'email', $atts ) ? $atts['email'] : '';
		$form    = array_key_exists( 'form', $atts ) ? $atts['form'] : '';
		$button  = array_key_exists( 'button', $atts ) ? $atts['button'] : '';
		$label   = array_key_exists( 'label', $atts ) ? $atts['label'] : 'Click to Email';
		$id 	 = array_key_exists( 'id', $atts ) ? $atts['id'] : '';
		$subject = array_key_exists( 'subject', $atts ) ? $atts['subject'] : 'No Subject';
		$popup   = array_key_exists( 'popup', $atts ) ? $atts['popup'] : '';

		$link_content = '';
		$output = '';

		if ( $form_submitted ) {
			$this->set_custom_plugin_message($success, 'success');
	    		//set_transient( $success, $form_submitted, 86400 );
		}

		if ( $email ) {
			$hash = wp_hash( $email );

			set_transient( $hash, $email, 86400 );
			set_transient( $label, $label, 86400 );
			set_transient( $id, $id, 86400 );
			set_transient( $subject, $subject, 86400 );

			// see if we've already hashed this email, and if not, save it
			$existing_email = $this->get_email_from_hash( $hash );

			if ( !$existing_email ) {
				$this->save_email( $email, $hash );
			}

			if ( !$form ) {
				$class = 'contactcamo-hidden-email';
				$class .= array_key_exists( 'class', $atts ) ? ' '. $atts['class'] : '';
				set_transient( $class, $class, 86400 );

				ob_start();

				if ($button) {
					include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/contactcamo-public-button.php';
				} else {
					include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/contactcamo-public-link.php';
				}

				$link_content = ob_get_clean();
				set_transient( $link_content, $link_content, 86400 );

				ob_start();

				include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/contactcamo-public-display.php';

			} else {
				if ( !$popup ) {
					$class = 'contactcamo-link';
				} else {
					$class = 'contactcamo-link-popup';
				}

				$class .= array_key_exists( 'class', $atts ) ? ' '. $atts['class'] : '';
				set_transient( $class, $class, 86400 );
				set_transient( $popup, $popup, 86400 );

				ob_start();

				if ($button) {
					include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/contactcamo-public-button.php';
				} else {
					include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/contactcamo-public-link.php';
				}

				$link_content = ob_get_clean();
				set_transient( $link_content, $link_content, 86400 );

				ob_start();

				include plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/contactcamo-public-form.php';

			}

			$output = ob_get_clean();
		}

		return $output;

	}

    /**
     * Saves email with its hash to database.
     *
     * @since   1.0.0
     */
      public function save_email( $email = '', $hash = '' ) {

		global $wpdb;
		$table_name = $wpdb->prefix . 'contactcamo';

		$wpdb->insert(
			$table_name,
			array(
				'time' => current_time( 'mysql' ),
				'email' => $email,
				'hash' => $hash,
			)
		);

      }

	/**
	* Retrieve the associated email for a given hash.
	*
	* @since   1.0.0
	*/
	public function get_email_from_hash( $hash = '' ) {

		global $wpdb;
		$table_name = $wpdb->prefix . 'contactcamo';

		$data = $wpdb->get_results( "SELECT email FROM $table_name WHERE hash = '$hash'" );

		return $data;

	}

}
