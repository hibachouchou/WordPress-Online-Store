<?php
/**
 * WPM Products WordPress Plugin
 *
 * @package ElementorWPMProducts
 *
 * Plugin Name: WPM Products by WP Maker
 * Description: Adds the "WPM Products" widget to Elementor, a super easy way to add any WooCommerce products to any Elementor page.
 * Plugin URI:  https://www.youtube.com/channel/UClGhdRdiwZbdFqAWMVirG8g
 * Version:     1.0.1
 * Author:      WP Maker
 * Author URI:  https://wpmkr.com/
 * Text Domain: elementor-wpm-products
 */

define( 'Elementor_WPM_Products', __FILE__ );

/**
 * Include the Elementor_WPM_Products class.
 */
require plugin_dir_path( Elementor_WPM_Products ) . 'class-elementor-wpm-products.php';
