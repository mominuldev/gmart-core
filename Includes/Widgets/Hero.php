<?php

namespace GPTheme\GmartCore\Widgets;

use Elementor\{Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Controls_Manager,
	Group_Control_Typography,
	Group_Control_Background,
	Utils,
	Repeater
};

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hero extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Hero widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'dmt-hero-static';
	}


	/**
	 * Get widget title.
	 * Retrieve Hero widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Dmt Hero', 'gmart-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Hero widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-photo-library';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'dmt-elements' ];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the widget keywords.
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_keywords() {
		return [ 'hero', 'hero static', 'hero static image' ];
	}

	/**
	 * @return string[]
	 */
//	public function get_script_depends() {
//		return [ 'marque' ];
//	}


	/**
	 * Get button sizes.
	 * Retrieve an array of button sizes for the button widget.
	 * @return array An array containing button sizes.
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function get_button_sizes() {
		return [
			'btn-xs' => __( 'Extra Small', 'gmart-core' ),
			'btn-sm' => __( 'Small', 'gmart-core' ),
			'btn-md' => __( 'Medium', 'gmart-core' ),
			'btn-lg' => __( 'Large', 'gmart-core' ),
			'btn-xl' => __( 'Extra Large', 'gmart-core' ),
		];
	}

	/**
	 * Register Hero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */

	protected function register_controls() {

		$this->start_controls_section( 'section_hero', [
			'label' => __( 'Dmt Hero Static', 'gmart-core' ),
		] );

		// Layout
		$this->add_control( 'layout', [
			'label'   => __( 'Layout', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one'   => __( 'Layout One', 'gmart-core' ),
				'two'   => __( 'Layout Two', 'gmart-core' ),
			],
		] );

		// Subtitle
		$this->add_control( 'subtitle', [
			'label'       => __( 'Subtitle', 'gmart-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => __( 'SUMMER SALE IS ON', 'gmart-core' ),
			'label_block' => true,
			'rows'        => 2,
			'description' => __( "Type your subtitle here.", 'gmart-core' ),
		] );


		$this->add_control( 'title', [
			'label'       => __( 'Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => __( 'New Summer Collection', 'gmart-core' ),
			'label_block' => true,
			'rows'        => 2,
			'description' => __( "Type your title here.", 'gmart-core' ),
		] );

		// Enable Animation
		$this->add_control( 'enable_animation', [
			'label'        => __( 'Enable Animation', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'gmart-core' ),
			'label_off'    => __( 'No', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		// Animation Text Type
		$this->add_control( 'animation_text_type', [
			'label'     => __( 'Animation Text Type', 'gmart-core' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'word',
			'options'   => [
				'chars' => __( 'Charterers', 'gmart-core' ),
				'words' => __( 'Word', 'gmart-core' ),
				'lines' => __( 'Lines', 'gmart-core' ),
			],
			'condition' => [
				'enable_animation' => 'yes',
			],
		] );

		// Animation Style
		$this->add_control( 'animation_style', [
			'label'     => __( 'Animation Style', 'gmart-core' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'one',
			'options'   => [
				'one'   => __( 'One', 'gmart-core' ),
				'two'   => __( 'Two', 'gmart-core' ),
				'three' => __( 'Three', 'gmart-core' ),
				'four'  => __( 'four', 'gmart-core' ),
			],
			'condition' => [
				'enable_animation' => 'yes',
			],
		] );

		// Animation Duration
		$this->add_control( 'animation_duration', [
			'label'     => __( 'Animation Duration', 'gmart-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 2,
			'step'      => 0.1,
			'min'       => 0.1,
			'condition' => [
				'enable_animation' => 'yes',
			],
		] );

		// Animation Delay
		$this->add_control( 'animation_delay', [
			'label'     => __( 'Animation Delay', 'gmart-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 0.1,
			'step'      => 0.1,
			'min'       => 0.1,
			'condition' => [
				'enable_animation' => 'yes',
			],
		] );


		$this->add_control( 'description', [
			'label'       => __( 'Description', 'gmart-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => __( 'We\'re an innovative global ui/ux design agency building high-end products ', 'gmart-core' ),
			'label_block' => true,
		] );

		$this->end_controls_section();

		// Buttons
		// =====================

		$this->start_controls_section( 'button_section', [
			'label'     => esc_html__( 'Button', 'gmart-core' ),
		] );

		$this->add_control(
			'button_size',
			[
				'label'   => __( 'Size', 'gmart-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-md',
				'options' => $this->get_button_sizes(),
			]
		);

		$this->add_control(
			'button_shape',
			[
				'label'   => __( 'Shape', 'gmart-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-square',
				'options' => [
					'btn-square' => __( 'Square', 'gmart-core' ),
					'btn-round'  => __( 'Round', 'gmart-core' ),
					'btn-circle' => __( 'Circle', 'gmart-core' ),
				],
			]
		);



		$this->add_control( 'btn_text', [
			'label'       => __( 'Button Label', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Type your button label here', 'gmart-core' ),
			'default'     => __( 'Shop Now', 'gmart-core' ),
			'label_block' => true
		] );

		$this->add_control( 'btn_link', [
			'label'       => __( 'Button Link', 'gmart-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( '/shop/', 'gmart-core' ),
			'default'     => [
				'url' => '#',
			],
		] );

		$this->add_control(
			'primary_button_style',
			[
				'label'   => __( 'Button Style', 'gmart-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-fill',
				'options' => [
					'btn-fill' => __( 'Default', 'gmart-core' ),
					'btn-outline' => __( 'Outline', 'gmart-core' ),
				],
			]
		);

		// Button Color
		$this->add_control(
			'primary_button_color',
			[
				'label'   => __( 'Fill Color', 'gmart-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-default',
				'options' => [
					'btn-default' => __( 'Default', 'gmart-core' ),
					'btn-light' => __( 'Light', 'gmart-core' ),
					'btn-dark'  => __( 'Dark', 'gmart-core' ),
				],
			]
		);

		$this->end_controls_section();

		// Feature Image
		// =====================
		$this->start_controls_section( 'feature_image_section', [
			'label'     => __( 'Feature Image', 'gmart-core' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
		] );

		// Category Title
		$this->add_control( 'banner-cat-title', [
			'label'       => __( 'Category Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => 'Men <br>Collection',
			'label_block' => true,
			'condition'   => [
				'layout' => 'one',
			],
		] );
		// Category Link
		$this->add_control( 'banner-cat-link', [
			'label'       => __( 'Category Link', 'gmart-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( '/shop/', 'gmart-core' ),
			'default'     => [
				'url' => '#',
			],
			'condition'   => [
				'layout' => 'one',
			],
		] );

		$this->add_control( 'feature_image', [
			'label'     => __( 'Choose Image', 'gmart-core' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/banner-image-1.png'
			],
			'separator'   => 'after'
		] );



		// Category Title
		$this->add_control( 'banner-cat-title-two', [
			'label'       => __( 'Category Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => 'Enjoy<br> This Summer Trend',
			'label_block' => true,
			'condition'   => [
				'layout' => 'one',
			],
		] );
		// Category Link
		$this->add_control( 'banner-cat-link-two', [
			'label'       => __( 'Category Link', 'gmart-core' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( '/shop/', 'gmart-core' ),
			'default'     => [
				'url' => '#',
			],
			'condition'   => [
				'layout' => 'one',
			],
		] );

		$this->add_control( 'feature_image_two', [
			'label'     => __( 'Choose Image', 'gmart-core' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/banner-image-2.png'
			],
		] );

		// Ticket Image
		$this->add_control( 'badge_image', [
			'label'     => __( 'Badge Image', 'gmart-core' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/offer-badge.png'
			],
		] );


		$this->end_controls_section();


		// Style Settings
		// =====================

		$this->start_controls_section( 'title_style', [
			'label' => __( 'Title', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'gmart-core' ),
			'selector' => '{{WRAPPER}} .banner__title',
		] );


		$this->add_control( 'title_color', [
			'label'     => __( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__title' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();


		// Description
		// =====================
		$this->start_controls_section( 'description_section', [
			'label' => __( 'Description', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,

		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'des_typography',
			'label'    => __( 'Typography', 'gmart-core' ),
			'selector' => '{{WRAPPER}} .banner__description',
		] );

		$this->add_control( 'des_color', [
			'label'     => __( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__description' => 'color: {{VALUE}}',
			],

		] );

		$this->end_controls_section();


		// Button Style
		// =====================
		$this->start_controls_section( 'style_button', [
			'label' => __( 'Button', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab( 'tab_button_normal', [
			'label' => __( 'Normal', 'gmart-core' ),
		] );

		$this->add_control( 'button_text_color', [
			'label'     => __( 'Text Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .banner-btn' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_bg_color', [
			'label'     => __( 'Background Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-btn' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'label'    => __( 'Border', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .banner-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'label'    => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .banner-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_button_hover', [
			'label' => __( 'Hover', 'gmart-core' ),
		] );

		$this->add_control( 'hover_color', [
			'label'     => __( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-btn:hover' => 'color: {{VALUE}};',
			],

		] );

		$this->add_control( 'button_hover_bg_color', [
			'label'     => __( 'Background Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-btn:hover' => 'background-color: {{VALUE}};',
			]
		] );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_hover_border',
				'label'    => __( 'Border', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .banner-btn:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .banner-btn',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'btn_typography',
			'label'     => __( 'Typography', 'gmart-core' ),
			'selector'  => '{{WRAPPER}} .banner-btn',
			'separator' => 'before'
		] );

		$this->add_control(
			'padding',
			[
				'label'      => __( 'Padding', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .banner-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border-radius',
			[
				'label'      => __( 'Border Radius', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .banner-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Background Settings
		// =====================
		$this->start_controls_section( 'style_background', [
			'label' => __( 'Background & Spacing', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'background',
			'label'    => __( 'Background', 'gmart-core' ),
			'types'    => [ 'classic', 'gradient', 'video' ],
			'selector' => '{{WRAPPER}} .banner',
		] );

		$this->add_responsive_control(
			'hero_padding',
			[
				'label'      => __( 'Padding', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper Classes
		// =====================
		$this->add_render_attribute( 'wrapper', 'class', 'banner' );

		if ( $settings['layout'] == 'one' ) {
			$this->add_render_attribute( 'wrapper', 'class', 'd-flex align-items-center' );
		}

		if ( ! empty( $settings['layout'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'banner--' . $settings['layout'] );
		}

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['btn_link'] );
			$this->add_render_attribute( 'button', 'class', 'dmt-btn banner-btn' );
			// Button Size
			if ( ! empty( $settings['button_size'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['button_size'] );
			}

			// Button Shape
			if ( ! empty( $settings['button_shape'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['button_shape'] );
			}

			// Button Style
			if ( ! empty( $settings['primary_button_style'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['primary_button_style'] );
			}

			// Button Fill Color
			if ( ! empty( $settings['primary_button_color'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['primary_button_color'] );
			}
		}


		// Secondary Button
		// =====================
		if ( ! empty( $settings['sec_btn_link']['url'] ) ) {
			$this->add_link_attributes( 'secondary_button', $settings['sec_btn_link'] );
			$this->add_render_attribute( 'secondary_button', 'class', 'dmt-btn banner-btn banner-btn--two btn-light' );

			// Button Size
			if ( ! empty( $settings['button_size'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class', $settings['button_size'] );
			}

			// Button Shape
			if ( ! empty( $settings['button_shape'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class', $settings['button_shape'] );
			}

			// Button Style
			if ( ! empty( $settings['secondary_button_style'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class',  $settings['secondary_button_style'] );
			}

			// Button Fill Color
			if ( ! empty( $settings['secondary_button_color'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class', $settings['secondary_button_color'] );
			}
		}

		$this->add_render_attribute( 'title', 'class', 'banner__title' );

		// Subtitle
		$this->add_render_attribute( 'subtitle', 'class', 'banner__subtitle' );

		// Title Animation Style
		// =====================
		if ( ! empty( $settings['animation_style'] ) ) {
			$this->add_render_attribute( 'title', [
				'data-animation' => $settings['animation_style'],
			] );
		}



//		$textAnimation = $this->textAnimation( $settings );
//		$json = str_replace('"','', (string) wp_json_encode( $textAnimation ) );
//		$this->add_render_attribute( 'title', 'data-anime', $json);

		require __DIR__ . '/templates/hero/layout-' . $settings['layout'] . '.php';

	}

	protected function textAnimation( array $settings ) {
		$animation = [];

		if ( ! empty( $settings['animation_style'] == 'one' ) ) {
			$animation['y']       = 90;
			$animation['opacity'] = 0;
			$animation['stagger'] = 0.1;
//			$animation['ease']  = 'Power4.easeOut';
			$animation['ease'] = 'Elastic.easeOut.config(1.2, 0.5)';
		}

		if ( ! empty( $settings['animation_delay'] ) ) {
			$animation['delay'] = $settings['animation_delay'];
		}

		if ( ! empty( $settings['animation_duration'] ) ) {
			$animation['duration'] = $settings['animation_duration'];
		}

		return $animation;
	}
}