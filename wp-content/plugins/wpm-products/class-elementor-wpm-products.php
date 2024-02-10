<?php
/**
 * Elementor_WPM_Products class.
 *
 * @category   Class
 * @package    ElementorWPMProducts
 * @subpackage WordPress
 * @author     WP Maker <andrei@wpmkr.com>
 * @copyright  2023 WP Maker
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.youtube.com/channel/UClGhdRdiwZbdFqAWMVirG8g,
 *             Make an Online Store Tutorial)
 * @since      1.0.1
 * php version 7.3.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

/**
 * Main WPM Products Class
 *
 * The init class that runs the WPM Products plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 */
final class Elementor_WPM_Products {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum WooCommerce Version
	 *
	 * @since 1.0.0
	 * @var string Minimum WooCommerce version required to run the plugin.
	 */
	const MINIMUM_WOOCOMMERCE_VERSION = '6.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Load the translation.
		add_action( 'init', array( $this, 'i18n' ) );

		// Initialize the plugin.
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'elementor-wpm-products' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor & WooCommerce are already loaded (and their versions), as well as the required PHP version.
	 * Checks for basic plugin requirements, if one check fails don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version.
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check if WooCommerce installed and activated.
		if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_woocommerce' ) );
			return;
		}

		// WooCommerce is active, now check for required WooCommerce version.
		if ( ! version_compare( WC_VERSION, self::MINIMUM_WOOCOMMERCE_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_woocommerce_version' ) );
			return;
		}

		// Check for required PHP version.
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our widgets.
		require_once 'class-widgets.php';
		// And also our Product Options
		require_once 'class-wpm-product-options.php';
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_missing_main_plugin() {
		deactivate_plugins( plugin_basename( Elementor_WPM_Products ) );
		$class = 'notice notice-error is-dismissible';
		$message = __( 'WPM Products requires Elementor to be installed and activated.', 'elementor-wpm-products' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		deactivate_plugins( plugin_basename( Elementor_WPM_Products ) );
		$class = 'notice notice-error is-dismissible';
		$message = __( 'WPM Products requires Elementor version ' . MINIMUM_ELEMENTOR_VERSION . ' or greater.', 'elementor-wpm-products' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have WooCommerce installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_woocommerce() {
		deactivate_plugins( plugin_basename( Elementor_WPM_Products ) );
		$class = 'notice notice-error is-dismissible';
		$message = __( 'WPM Products requires WooCommerce to be installed and activated.', 'elementor-wpm-products' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required WooCommerce version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_woocommerce_version() {
		deactivate_plugins( plugin_basename( Elementor_WPM_Products ) );
		$class = 'notice notice-error is-dismissible';
		$message = __( 'WPM Products requires WooCommerce version ' . MINIMUM_WOOCOMMERCE_VERSION . ' or greater.', 'elementor-wpm-products' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		deactivate_plugins( plugin_basename( Elementor_WPM_Products ) );
		$class = 'notice notice-error is-dismissible';
		$message = __( 'WPM Products requires PHP version ' . MINIMUM_PHP_VERSION . ' or greater.', 'elementor-wpm-products' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}
}

// Instantiate Elementor_WPM_Products.
new Elementor_WPM_Products();
