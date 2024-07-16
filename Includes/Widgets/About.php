<?php

namespace GPTheme\GmartCore\Widgets;

use Elementor\{Controls_Manager,
	Widget_Base,
	Group_Control_Typography
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class Team
 *
 * @package GPTheme\GmartCore\Widgets
 */
class About extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Team widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'dmt-about';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Team widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Dmt About', 'gmart-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Team widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Team widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'dmt-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'About', 'Animation', 'Parallax' ];
	}

	// Dependancy Scripts
//	public function get_script_depends() {
//		return [ 'lenis' ];
//	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//============================================
		// START CONTENT SECTION
		//============================================
		$this->start_controls_section( 'team_content', [
			'label' => __( 'About Content', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'content', [
			'label'       => __( 'Content', 'gmart-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'rows'        => 10,
			'placeholder' => __( 'Enter content here', 'gmart-core' ),
			'default'     => __( 'We\'re the champions of style without breaking the bank. We see no boundaries when it comes to fashion then it’s your budget and your playground.', 'gmart-core' ),
		] );

		$this->add_control( 'image', [
			'label'   => __( 'Choose Image', 'gmart-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/team1.jpg'
			],
		] );

		$this->add_control( 'image_two', [
			'label'   => __( 'Choose Image', 'gmart-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/team1.jpg'
			],
		] );

		$this->add_control( 'image_three', [
			'label'   => __( 'Choose Image', 'gmart-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/team1.jpg'
			],
		] );


		$this->end_controls_section();
		// End Content Section
		// =====================

		//============================================
		// START STYLE SECTION
		//============================================

		// Start Content Style
		// =====================
		$this->start_controls_section( 'name_style', [
			'label' => __( 'Content', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'color', [
			'label'     => __( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dmt-content__heading' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => __( 'Typography', 'gmart-core' ),
			'selector' => '{{WRAPPER}} .dmt-content__heading',
		] );


		$this->end_controls_section();
		// End Name Style
		// ====================

	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper attributes
		$this->add_render_attribute( 'wrapper', 'class', 'dmt-content' );
		$this->add_render_attribute( 'wrapper', 'data-scroll-section' );

		// Title attributes
		$this->add_render_attribute( 'title', 'class', 'dmt-content__heading' );

		$this->add_render_attribute( 'title', [
			'data-bg-color' => '#A7A5A6'
		] );

		$this->add_render_attribute( 'title', [
			'data-fg-color' => '#000'
		] );


		?>

		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

			<h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['content']; ?></h2>

			<div class="dmt-content__wrapper">
				<div class="dmt-content__image dmt-content__image-left" data-scroll data-scroll-speed="2">
					<img src="<?php echo $settings['image']['url']; ?>" alt="<?php echo esc_attr('Image One'); ?>">
				</div>
				<div class="dmt-content__image dmt-content__image-right" data-scroll data-scroll-speed="2">
					<img src="<?php echo $settings['image_two']['url']; ?>" alt="<?php echo esc_attr('Image Two'); ?>">
				</div>
				<div class="dmt-content__image dmt-content__image-bottom" data-scroll data-scroll-speed="5">
					<img src="<?php echo $settings['image_three']['url']; ?>" alt="<?php echo esc_attr('Image Three'); ?>">
				</div>
			</div>
			<!-- /.dmt-content__wrapper -->
		</div>

		<?php
	}

}