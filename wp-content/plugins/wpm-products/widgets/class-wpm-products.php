<?php
/**
 * WPM Products class.
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

namespace ElementorWPMProducts\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * WPM Products widget class.
 *
 * @since 1.0.0
 */
class WPMProducts extends Widget_Base {
	/**
	 * Class constructor.
	 *
	 * @param array $data Widget data.
	 * @param array $args Widget arguments.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'wpmproducts', plugins_url( '/assets/css/wpm-products.css', Elementor_WPM_Products ), array(), '1.0.0' );
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'wpmproducts';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'WPM Products', 'elementor-wpm-products' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-product-related';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}
	
	/**
	 * Enqueue styles.
	 */
	public function get_style_depends() {
		return array( 'wpmproducts' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'what_section',
			array(
				'label' => __( 'Display', 'elementor-wpm-products' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'showonly',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Which products?', 'elementor-wpm-products' ),
				'options' => [
					'onsale' => esc_html__( 'On sale', 'elementor-wpm-products' ),
					'toprated' => esc_html__( 'Top rated', 'elementor-wpm-products' ),
					'bestselling' => esc_html__( 'Best selling', 'elementor-wpm-products' ),
					'all' => esc_html__( 'Show All', 'elementor-wpm-products' ),
				],
				'default' => 'all',
			]
		);

		$this->add_control(
			'featured',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Show only featured?', 'elementor-wpm-products' ),
				'options' => [
					'yes' => esc_html__( 'Yes', 'elementor-wpm-products' ),
					'no' => esc_html__( 'No', 'elementor-wpm-products' ),
				],
				'default' => 'no',
			]
		);

		$this->add_control(
			'limit',
			array(
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'How many products?', 'elementor-wpm-products' ),
				'placeholder' => '3',
				'min' => 1,
				'max' => 200,
				'default' => 3,
			)
		);

		$this->add_control(
			'columns',
			array(
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'How many columns?', 'elementor-wpm-products' ),
				'placeholder' => '3',
				'min' => 1,
				'max' => 21,
				'default' => 3,
			)
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'order_section',
			array(
				'label' => __( 'Order & Pages', 'elementor-wpm-products' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'orderby',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Order by:', 'elementor-wpm-products' ),
				'options' => [
					'date' => esc_html__( 'Date', 'elementor-wpm-products' ),
					'title' => esc_html__( 'Title', 'elementor-wpm-products' ),
					'rating' => esc_html__( 'Rating', 'elementor-wpm-products' ),
					'popularity' => esc_html__( 'Popularity', 'elementor-wpm-products' ),
					'rand' => esc_html__( 'Randomly', 'elementor-wpm-products' ),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'order',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'How to order:', 'elementor-wpm-products' ),
				'options' => [
					'ASC' => esc_html__( 'Ascending', 'elementor-wpm-products' ),
					'DESC' => esc_html__( 'Descending', 'elementor-wpm-products' ),
				],
				'default' => 'DESC',
			]
		);

		$this->add_control(
			'paginate',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => esc_html__( 'Show pages:', 'elementor-wpm-products' ),
				'options' => [
					'yes' => esc_html__( 'Yes', 'elementor-wpm-products' ),
					'no' => esc_html__( 'No', 'elementor-wpm-products' ),
				],
				'default' => 'no',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'filter_section',
			array(
				'label' => __( 'Filters', 'elementor-wpm-products' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'skus',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Only show products with these SKUs:', 'elementor-wpm-products' ),
				'placeholder' => esc_html__( 'For example: SKU1, SKU2, SKU3', 'elementor-wpm-products' ),
				'default' => '',
			]
		);

		$this->add_control(
			'category',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Only show products from categories:', 'elementor-wpm-products' ),
				'placeholder' => esc_html__( 'For example: men, women, kids', 'elementor-wpm-products' ),
				'default' => '',
			]
		);

		$this->add_control(
			'tag',
			[
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Only show products with tags:', 'elementor-wpm-products' ),
				'placeholder' => esc_html__( 'For example: summer, winter, fall', 'elementor-wpm-products' ),
				'default' => '',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$show_only = '';
		switch($settings['showonly']) {
			case 'onsale':
				$show_only = 'on_sale="true"';
				break;
			case 'toprated':
				$show_only = 'top_rated="true"';
				break;
			case 'bestselling':
				$show_only = 'best_selling="true"';
				break;
			default:
				$show_only = '';
				break;
		}

		?>
		<div> <?php echo do_shortcode('[products ' . $show_only . ' 

			limit="' . $settings['limit'] . '" 
			columns="' . $settings['columns'] . '" 
			visibility="' . ($settings['featured'] == 'no' ? 'visible' : 'featured') . '" 
			paginate="' . ($settings['paginate'] == 'yes' ? 'true' : 'false') . '" 
			orderby="' . $settings['orderby'] . '" 
			order="' . $settings['order'] . '" 
			skus="' . $settings['skus'] . '" 
			category="' . $settings['category'] . '" 
			tag="' . $settings['tag'] . '" 

			]');

		?></div>

		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {

	}
}
