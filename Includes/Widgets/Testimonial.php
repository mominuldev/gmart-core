<?php

namespace DesignMonks\MonksMartCore\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater,
	Utils
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Testimonial
 * @package DesignMonks\MonksMartCore\Widgets
 */
class Testimonial extends Widget_Base {

	public function get_name() {
		return 'dmt-testimonial';
	}

	public function get_title() {
		return esc_html__( 'Dmt Testimonial', 'gmart-core' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return [ 'dmt-elements' ];
	}

	// Required Swiper JS
	public function get_script_depends() {
		return [ 'swiper' ];
	}

	protected function register_controls() {
		// Testimonial
		//=========================
		$this->start_controls_section( 'section_tab_style', [
			'label' => esc_html__( 'Testimonial', 'gmart-core' ),
		] );

		// Layout
		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one' => esc_html__( 'Layout One', 'gmart-core' ),
				'two' => esc_html__( 'Layout Two', 'gmart-core' ),
			],
		] );

		// Show Quotes
		$this->add_control( 'show_quotes', [
			'label'        => esc_html__( 'Show Quotes', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		// Show Rating
		$this->add_control( 'show_rating', [
			'label'        => esc_html__( 'Show Rating', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		// Show Image
		$this->add_control( 'show_image', [
			'label'        => esc_html__( 'Show Image', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes',
			'condition'    => [
				'layout' => 'two',
			],

		] );

		// Image
		$this->add_control( 'image', [
			'label'   => esc_html__( 'Image', 'gmart-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'show_image' => 'yes',
			],

		] );

		$repeater = new Repeater();

		$repeater->add_control( 'image', [
			'label'   => __( 'Author Image', 'gmart-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			]
		] );

		$repeater->add_control( 'title', [
			'label'       => __( 'Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$repeater->add_control( 'name', [
			'label'       => __( 'Name', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$repeater->add_control( 'designation', [
			'label'       => __( 'Designation', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$repeater->add_control( 'rating', [
			'label'   => __( 'Rating Number', 'gmart-core' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => '50',
			'options' => [
				'10' => __( '1 Star', 'gmart-core' ),
				'20' => __( '2 Star', 'gmart-core' ),
				'30' => __( '3 Star', 'gmart-core' ),
				'40' => __( '4 Star', 'gmart-core' ),
				'50' => __( '5 Star', 'gmart-core' ),
			],
		] );

		$repeater->add_control( 'review_content', [
			'label'      => __( 'Review Content', 'gmart-core' ),
			'type'       => Controls_Manager::TEXTAREA,
			'show_label' => false,
		] );


		$this->add_control( 'testimonials', [
			'label'       => __( 'Testimonial Items', 'gmart-core' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'image'          => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'name'           => __( 'Templeton Peck', 'gmart-core' ),
					'designation'    => __( 'Product Designer', 'gmart-core' ),
					'review_content' => __( 'Amazing product quality and design!. The prices are reasonable for the high quality product colours, and sizes are more accessible.', 'gmart-core' ),
				],
				[
					'image'          => [
						'url' => Utils::get_placeholder_image_src( 'hexa_testimonial_three' ),
					],
					'name'           => __( 'Michael Knight', 'gmart-core' ),
					'designation'    => __( 'Product Designer', 'gmart-core' ),
					'review_content' => __( 'Amazing product quality and design!. The prices are reasonable for the high quality product colours, and sizes are more accessible.', 'gmart-core' ),
				],
				[
					'image'          => [
						'url' => Utils::get_placeholder_image_src( 'hexa_testimonial_three' ),
					],
					'name'           => __( 'Gordana Pointer', 'gmart-core' ),
					'designation'    => __( 'Product Designer', 'gmart-core' ),
					'review_content' => __( 'Amazing product quality and design!. The prices are reasonable for the high quality product colours, and sizes are more accessible.', 'gmart-core' ),
				],
			],
			'title_field' => '{{{ name }}}',
		] );

		$this->end_controls_section();

		// Slider Control
		//=====================
		$this->start_controls_section( 'settingd_section', [
			'label' => esc_html__( 'Slider Control', 'gmart-core' ),
		] );

		$this->add_control(
			'slides_per_view',
			[
				'label'   => esc_html__( 'Slider Per View', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => esc_html__( '1', 'gmart-core' ),
					'2' => esc_html__( '2', 'gmart-core' ),
					'3' => esc_html__( '3', 'gmart-core' ),
				],
			]
		);

		$this->add_control( 'navigation', [
			'label'        => esc_html__( 'Navigation', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'pagination', [
			'label'        => esc_html__( 'Pagination', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'centered_slides', [
			'label'        => esc_html__( 'Center Slide', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'gmart-core' ),
			'label_off'    => esc_html__( 'No', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'no'
		] );


		$this->add_control( 'loop', [
			'label'        => esc_html__( 'Loop', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gmart-core' ),
			'label_off'    => esc_html__( 'Off', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'speed', [
			'label'   => __( 'Speed', 'gmart-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 700,
		] );

		$this->add_control( 'autoplay', [
			'label'        => esc_html__( 'Autoplay', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gmart-core' ),
			'label_off'    => esc_html__( 'Off', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'autoplay_time', [
			'label'     => __( 'Autoplay Time', 'gmart-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 9000,
			'condition' => [
				'autoplay' => 'yes'
			]
		] );

		// Space Between
		$this->add_control(
			'space_between',
			[
				'label'   => esc_html__( 'Space Between', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 30,
			]
		);

		$this->end_controls_section();


		// Style Sections
		//=====================

		// Avatar Style
		//=====================
		$this->start_controls_section( 'avatar_section', [
			'label' => __( 'Avatar', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
			'avatar_spacing',
			[
				'label'      => esc_html__( 'Spacing (Margin Bottom)', 'gmart-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 40,
				],

				'selectors' => [
					'{{WRAPPER}} .testimonial__avatar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'avatar_padding',
			[
				'label'      => esc_html__( 'Padding', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial__avatar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'avatar_border',
				'selector' => '{{WRAPPER}} .testimonial__avatar',
			]
		);

		$this->end_controls_section();

		// Name Style
		//=====================
		$this->start_controls_section( 'name_section', [
			'label' => __( 'Name', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => __( 'Typography', 'gmart-core' ),
			'selector' => '{{WRAPPER}} .testimonial__name',
		] );

		$this->add_control( 'name_color', [
			'label'     => __( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial__name' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Designation Style
		//=====================
		$this->start_controls_section( 'designation_section', [
			'label' => __( 'Designation', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'desi_typography',
			'label'    => __( 'Typography', 'gmart-core' ),
			'selector' => '{{WRAPPER}} .testimonial__designation',
		] );

		$this->add_control( 'desi_color', [
			'label'     => __( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial__designation' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Style Review Content
		//=========================
		$this->start_controls_section( 'review_section', [
			'label' => __( 'Review Content', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'review_typography',
			'label'    => __( 'Typography', 'gmart-core' ),
			'selector' => '{{WRAPPER}} .testimonial__content',
		] );

		$this->add_control( 'review_color', [
			'label'     => __( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial__content' => 'color: {{VALUE}}',
			],
		] );

		// Align
		$this->add_control(
			'review_align',
			[
				'label'   => __( 'Alignment', 'gmart-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'   => [
						'title' => __( 'Left', 'gmart-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'gmart-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'gmart-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'prefix_class' => 'testimonial-align-',
			]
		);

		$this->end_controls_section();

		// Style Slider Control Section
		//================================
		$this->start_controls_section( 'control_section', [
			'label' => __( 'Slider  Control', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->add_control(
			'nav_width',
			[
				'label'      => esc_html__( 'Nav Height/Width', 'gmart-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_font_size',
			[
				'label'      => esc_html__( 'Font Size', 'gmart-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]

		);

		$this->add_control(
			'nav_border_radius',
			[
				'label'      => esc_html__( 'Nav Border Radius', 'gmart-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_nav_style' );
		$this->start_controls_tab(
			'tab_nav_normal',
			[
				'label' => __( 'Normal', 'gmart-core' ),
			]
		);

		$this->add_control( 'slider_nav_color', [
			'label'     => __( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_bg_color', [
			'label'     => __( 'Background Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'slider_control_border',
				'selector' => '{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow',
				'label'    => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next',
			]
		);

		$this->add_control( 'pagination_bg_color', [
			'label'     => __( 'Pagination BG Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background: {{VALUE}}',
			],
			'separator' => 'before',
		] );

		$this->add_control( 'pagination_active_bg_color', [
			'label'     => __( 'Pagination Active BG Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}}',
			],
			'separator' => 'before',
		] );

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_nav_hover',
			[
				'label' => __( 'Hover', 'gmart-core' ),
			]
		);

		$this->add_control( 'nav_color_hover', [
			'label'     => __( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_color_bg_hover', [
			'label'     => __( 'Background Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_control_hover', [
			'label'     => __( 'Border Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover' => 'border-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover',
			]
		);

		$this->add_control( 'slider_pagination_active_color', [
			'label'     => __( 'Pagination Active BG Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:before' => 'background: {{VALUE}}',
			],
			'separator' => 'before',
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Style Slider Control Section
		//================================
		$this->start_controls_section( 'testimonial_section', [
			'label' => __( 'Testimonial Container', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'testimonial_background',
				'label'    => __( 'Background', 'gmart-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .testimonial',
			]
		);

		$this->add_control(
			'testimonial_padding',
			[
				'label'      => __( 'Padding', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'testimonial_border_radius',
			[
				'label'      => __( 'Padding', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'testimonial_shadow_hover',
				'label'    => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .testimonial',
			]
		);

		// Overflow
		$this->add_control(
			'testimonial_overflow',
			[
				'label'        => __( 'Overflow', 'gmart-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'gmart-core' ),
				'label_off'    => __( 'Hide', 'gmart-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
				'selectors'    => [
					'{{WRAPPER}} .dmt-testimonial' => 'overflow: visible !important;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings     = $this->get_settings_for_display();
		$testimonials = $settings['testimonials'];
		$layout       = $settings['layout'];

		$this->add_render_attribute( 'wrapper', 'class', [
			'swiper-container',
			'dmt-testimonial',
		] );


		// Testimonial Style
		$this->add_render_attribute( 'testimonial', 'class', 'testimonial' );

		if( 'two' == $layout ) {
			$this->add_render_attribute( 'testimonial', 'class', 'testimonial--two' );
		}

		$slider_options = $this->get_slider_options( $settings );
		$this->add_render_attribute( 'wrapper', 'data-testi', wp_json_encode( $slider_options ) );

		require __DIR__ . '/templates/testimonial/layout-' . $layout . '.php';

	}

	protected function get_slider_options( array $settings ) {

		// Loop
		if ( 'yes' === $settings['loop']) {
			$slider_options['loop'] = true;
		}

		// Speed
		if ( ! empty( $settings['speed'] ) ) {
			$slider_options['speed'] = (int) $settings['speed'];

		}

		// Centered Slides
		if ( 'yes' === $settings['centered_slides'] ) {
			$slider_options['centeredSlides'] = true;
		}

		// Breakpoints
		if( 'one' === $settings['layout']) {
			$slider_options['breakpoints'] = [
				'1024' => [
					'slidesPerView' => $settings['slides_per_view'],
					'spaceBetween'  => $settings['space_between'],
				],
				'620'  => [
					'slidesPerView' => 2,
					'spaceBetween'  => 30,
				],

				'320' => [
					'slidesPerView' => 1,
					'spaceBetween'  => 20,
				],
			];
		}


		// Auto Play
		if ( 'yes' === $settings['autoplay'] ) {
			$slider_options['autoplay'] = [
				'delay'                => $settings['autoplay_time'],
				'disableOnInteraction' => false
			];
		} else {
			$slider_options['autoplay'] = [
				'delay' => '99999999999',
			];
		}

		if ( 'yes' === $settings['navigation'] ) {
			$slider_options['navigation'] = [
				'nextEl' => '.testimonial-next',
				'prevEl' => '.testimonial-prev'
			];
		}

		if ( 'yes' === $settings['pagination'] ) {
			$slider_options['pagination'] = [
				'el'        => '.testimonial-pagination',
				'clickable' => true
			];
		}

		return $slider_options;
	}

}