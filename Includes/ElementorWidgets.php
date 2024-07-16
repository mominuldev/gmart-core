<?php
namespace DesignMonks\MonksMartCore;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'DMT_ELEMENTOR_CORE_URL', plugins_url( '/', __FILE__ ) );
define( 'DMT_ELEMENTOR_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'DMT_ELEMENTOR_CORE_FILE', __FILE__ );


class ElementorWidgets {
	// Properties

	/**
	 * Instance
	 *
	 * @var ElementorWidgets
	 */
	private static $instance = null;

	/**
	 * Get instance
	 *
	 * @return ElementorWidgets
	 */

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * ElementorWidgets constructor.
	 */

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init_addons' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'before_enqueue_scripts' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'after_register_scripts' ] );
	}

	/**
	 * Register Categories for Elementor
	 * @param $elements_manager
	 */

	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'dmt-elements',
			[
				'title' => __( 'Monks Mart Elements', 'gmart-core' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	/**
	 * Register widgets
	 */

	public function register_widgets() {
		$widget_manager = Plugin::instance()->widgets_manager;

		foreach ( glob( GMART_PATH . 'Includes/Widgets/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\DesignMonks\MonksMartCore\Widgets\%s', $class );

			if ( class_exists( $class ) ) {
				$widget_manager->register( new $class );
			}
		}
	}


	/**
	 * Register addon by file name
	 */
	public function register_modules_addon( ) {
		foreach ( glob( GMART_PATH . 'Includes/Elementor/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\DesignMonks\MonksMartCore\Elementor\%s', $class );

			if ( class_exists( $class ) ) {
				new $class;
			}
		}
	}

	/**
	 * Init Addons
	 */

	public function init_addons() {
		/**
		 * Check if Elementor installed and activated
		 * @see https://developers.elementor.com/creating-an-extension-for-elementor/
		 */
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		$this->register_modules_addon();
	}


	/**
	 * Enqueue scripts
	 */
	public function after_register_scripts() {
		wp_register_script( 'countUp', GMART_SCRIPT . '/countUp.min.js', array( 'jquery' ), GMART_CORE_VERSION, true );
		wp_register_script( 'appear-js', GMART_SCRIPT . '/jquery.appear.js', array( 'jquery' ), GMART_CORE_VERSION, true );
//		wp_register_script( 'swiper', GMART_SCRIPT . '/jquery.appear.js', array( 'jquery' ), GMART_CORE_VERSION, true );
//		wp_register_script( 'countTo', GMART_SCRIPT . '/jquery.countTo.js', array( 'jquery' ), GMART_CORE_VERSION, true );
		wp_register_script( 'countdown', GMART_SCRIPT . '/jquery.countdown.js', array( 'jquery' ), GMART_CORE_VERSION, true );
		wp_register_script( 'parallax-scroll', GMART_SCRIPT . '/jquery.parallax-scroll.js', array( 'jquery' ), GMART_CORE_VERSION, true );
//		wp_register_script( 'gmap3', GMART_SCRIPT . '/gmap.js', array( 'jquery' ), GMART_CORE_VERSION, true );
//		wp_register_script( 'isotope', GMART_SCRIPT . '/isotope.pkgd.min.js', array( 'jquery' ), GMART_CORE_VERSION, true );
		wp_register_script( 'parallax', GMART_SCRIPT . '/parallax.min.js', array( 'jquery' ), GMART_CORE_VERSION, true );
//		wp_enqueue_script( 'marquee', GMART_SCRIPT . '/jquery.marquee.js', array('jquery'), GMART_CORE_VERSION, true );
		wp_enqueue_script( 'gsap', GMART_SCRIPT . '/gsap.min.js', array(), GMART_CORE_VERSION, true );
		wp_enqueue_script( 'lenis', GMART_SCRIPT . '/lenis.min.js', array(), GMART_CORE_VERSION, true );
		wp_enqueue_script( 'splittext', GMART_SCRIPT . '/SplitText.min.js', array(), GMART_CORE_VERSION, true );
		wp_enqueue_script( 'ScrollToPlugin', GMART_SCRIPT . '/ScrollToPlugin.min.js', array(), GMART_CORE_VERSION, true );
		wp_enqueue_script( 'ScrollTrigger', GMART_SCRIPT . '/ScrollTrigger.min.js', array(), GMART_CORE_VERSION, true );
		wp_enqueue_script( 'ScrollSmoother', GMART_SCRIPT . '/ScrollSmoother.min.js', array(), GMART_CORE_VERSION, true );
		wp_enqueue_script( 'lenis', GMART_SCRIPT . 'lenis.min.js', array(), GMART_CORE_VERSION, true );
//		wp_enqueue_script( 'tilts', GMART_SCRIPT . '/jquery.tilt.js', array('jquery'), GMART_CORE_VERSION, true );
	}

	/**
	 * Enqueue Scripts
	 *
	 * @return void
	 */

	public function before_enqueue_scripts() {
		wp_enqueue_script( 'dmt-elementor', GMART_SCRIPT . '/elementor.js', array(
			'jquery',
			'elementor-frontend'
		), GMART_CORE_VERSION, true );
	}
}
