<?php

namespace DesignMonks\MonksMartCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Countdown extends Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve alert widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name()
	{
		return 'dmt-countdown';
	}


	public function get_title()
	{
		return __('Countdown', 'gmart-core');
	}

	public function get_icon()
	{

		return 'eicon-social-icons';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the widget categories.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return ['dmt-elements'];
	}

	/**
	 * Retrieve the list of scripts the image widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'countdown' ];
	}

	// Keywords
	public function get_keywords() {
		return [ 'countdown', 'timer', 'clock', 'date', 'time' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'coming_content',
			[
				'label' => __('Countdown', 'gmart-core'),
			]
		);


		$this->add_control(
			'year', [
				'label' => __('Year', 'gmart-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '2022',
			]
		);

		$this->add_control(
			'month',
			[
				'label' => __( 'Month', 'gmart-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					"1"  => __("January", 'gmart-core'),
					"2"  => __("February", 'gmart-core'),
					"3"  => __("March", 'gmart-core'),
					"4"  => __("April", 'gmart-core'),
					"5"  => __("May", 'gmart-core'),
					"6"  => __("June", 'gmart-core'),
					"7"  => __("July", 'gmart-core'),
					"8"  => __("August", 'gmart-core'),
					"9"  => __("September", 'gmart-core'),
					"10" => __("October", 'gmart-core'),
					"11" => __("November", 'gmart-core'),
					"12" => __("December", 'gmart-core')
				],
			]
		);

		$this->add_control(
			'day',
			[
				'label' => __( 'Day', 'gmart-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 31,
				'step' => 1,
				'default' => 10,
			]
		);

		$this->end_controls_section();

		/**
		 * Style
		 */

		$this->start_controls_section(
			'social_style_section',
			[
				'label' => __( 'Style', 'gmart-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'countdown_color',
			[
				'label' => __( 'Color', 'gmart-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .CountdownContent' => 'color: {{VALUE}}',
				],
			]
		);

		// Background Color
		$this->add_control(
			'countdown_bg_color',
			[
				'label' => __( 'Background Color', 'gmart-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .CountdownContent' => 'background-color: {{VALUE}}',
				],
			]
		);



		// Backdrop Filter blur effect
		$this->add_control(
			'backdrop_filter',
			[
				'label' => __( 'Backdrop Filter', 'gmart-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .CountdownContent' => 'backdrop-filter: blur({{SIZE}}px)',
				],
			]
		);



		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'countdown_typography',
				'label' => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .CountdownContent',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => __( 'Label Color', 'gmart-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .CountdownLabel' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .CountdownLabel',
			]
		);

		// Box Width
		$this->add_responsive_control(
			'countdown_width',
			[
				'label' => __( 'Width', 'gmart-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'px' => [
						'min' => 50,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dmt-countdown .CountdownContent' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$starting_year = $settings['year'];
		$starting_month = $settings['month'];
		$starting_day = $settings['day'];

		?>

		<div class="count-wrap">
			<div class="dmt-countdown" data-count-year="<?php echo esc_attr($starting_year); ?>" data-count-month="<?php echo esc_attr($starting_month); ?>" data-count-day="<?php echo esc_attr($starting_day); ?>"></div>
		</div><!-- /.count-wrap -->

		<?php
	}

}
