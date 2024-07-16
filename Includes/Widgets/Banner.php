<?php

namespace DesignMonks\MonksMartCore\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater,
	Utils};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Banner extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'dmt-banner-slider';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Dmt Banner Slider', 'gmart-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-photo-library';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'dmt-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'banner', 'slider', 'dmt' ];
	}


	protected function register_controls() {

		// Slider Items
		// =====================

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Slider Content', 'gmart-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();


		$repeater->add_control(
			'banner_subtitle', [
				'label'       => __( 'Sub Title', 'gmart-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'banner_title', [
				'label'       => __( 'Title', 'gmart-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'banner_description', [
				'label'      => __( 'Description', 'gmart-core' ),
				'type'       => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'btn_text_one', [
				'label'       => __( 'Button Title', 'gmart-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Explore Now', 'gmart-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'btn_link_one',
			[
				'label'         => __( 'Link', 'gmart-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'gmart-core' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
				'separator'     => 'after'
			]
		);

		$repeater->add_control(
			'banner_image',
			[
				'label'   => __( 'Choose Image', 'gmart-core' ),
				'type'    => Controls_Manager::MEDIA,
			]
		);


		$this->add_control(
			'sliders',
			[
				'label'       => __( 'Repeater List', 'gmart-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'banner_subtitle'       => __( '30%-70% OFF', 'gmart-core' ),
						'banner_title'       => __( 'New Arrival Collection Summer 2024', 'gmart-core' ),
						'banner_description' => __( '500+ deals on top brands & big offer on first order. Comfortable and new stylish cloths for everyone. Find true style', 'gmart-core' ),
						'banner_image'       => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'banner_subtitle'       => __( '30%-70% OFF', 'gmart-core' ),
						'banner_title'       => __( 'New Arrival Collection Summer 2024', 'gmart-core' ),
						'banner_description' => __( '500+ deals on top brands & big offer on first order. Comfortable and new stylish cloths for everyone. Find true style', 'gmart-core' ),
						'banner_image'       => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'banner_subtitle'       => __( '30%-70% OFF', 'gmart-core' ),
						'banner_title'       => __( 'New Arrival Collection Summer 2024', 'gmart-core' ),
						'banner_description' => __( '500+ deals on top brands & big offer on first order. Comfortable and new stylish cloths for everyone. Find true style', 'gmart-core' ),
						'banner_image'       => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
				],
				'title_field' => '{{{ banner_title }}}',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section( 'sittings_control', [
			'label' => esc_html__( 'Slider Control', 'gmart-core' ),
		] );


		$this->add_control(
			'navigation',
			[
				'label'        => esc_html__( 'Navigation', 'gmart-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'gmart-core' ),
				'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'        => esc_html__( 'Pagination', 'gmart-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'gmart-core' ),
				'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'direction',
			[
				'label'   => __( 'Direction', 'gmart-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'vertical',
				'options' => [
					'horizontal' => __( 'Horizontal', 'gmart-core' ),
					'vertical'   => __( 'Vertical', 'gmart-core' ),
				],


			]
		);

		$this->add_control(
			'mousewheel',
			[
				'label'        => esc_html__( 'mousewheel', 'gmart-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'gmart-core' ),
				'label_off'    => esc_html__( 'Off', 'gmart-core' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'loop',
			[
				'label'        => esc_html__( 'Loop', 'gmart-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'gmart-core' ),
				'label_off'    => esc_html__( 'Off', 'gmart-core' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'gmart-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'gmart-core' ),
				'label_off'    => esc_html__( 'Off', 'gmart-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'loop' => 'yes'
				]
			]
		);

		$this->add_control(
			'autoplay_time',
			[
				'label'     => __( 'Autoplay Time', 'gmart-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'loop'     => 'yes',
					'autoplay' => 'yes',
				]
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'gmart-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 700,
			]
		);

		$this->end_controls_section();

		// Title
		// ==================
		$this->start_controls_section(
			'title_section',
			[
				'label' => __( 'Title', 'gmart-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .banner__title',
			]
		);


		$this->end_controls_section();

		// Description
		// ==================
		$this->start_controls_section(
			'description_section',
			[
				'label' => __( 'Description', 'gmart-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner__description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .banner__description',
			]
		);

		$this->end_controls_section();


		// Button
		//======================

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'gmart-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-btn',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.dmt-btn, {{WRAPPER}} .dmt-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'btn_padding',
			[
				'label'      => __( 'Padding', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.dmt-btn, {{WRAPPER}} .dmt-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'gmart-core' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} a.dmt-btn, {{WRAPPER}} .dmt-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'gmart-core' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label'     => __( 'Background Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border_hover',
				'label'    => __( 'Border', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-btn:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
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
					'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_font_size',
			[
				'label'      => esc_html__( 'Nav Font Size', 'gmart-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'border-radius: {{SIZE}}{{UNIT}};',
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
				'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_bg_color', [
			'label'     => __( 'Background Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'slider_control_border',
				'selector' => '{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow',
				'label'    => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .banner__slider-prev, {{WRAPPER}} .banner__slider-next',
			]
		);

		$this->add_control( 'pagination_bg_color', [
			'label'     => __( 'Pagination BG Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}}',
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
				'{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_color_bg_hover', [
			'label'     => __( 'Background Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_control_hover', [
			'label'     => __( 'Border Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover' => 'border-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .banner__slider-prev:hover, {{WRAPPER}} .banner__slider-next:hover',
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


		// Overlay BG
		// =======================

		$this->start_controls_section(
			'overlay_section',
			[
				'label' => esc_html__( 'Overlay Background', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'overlay_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .banner__slider .banner__slide:before',
			]
		);


		$this->add_control(
			'overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0.7,
				],
				'selectors' => [
					'{{WRAPPER}} .banner__slider .banner__slide:before' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_section();

		//Social Links
		$this->start_controls_section(
			'social_banner_style',
			[
				'label' => __( 'Social Style', 'gmart-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'link_size',
			[
				'label'     => __( 'Font Size', 'gmart-core' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 10,
				'max'       => 50,
				'step'      => 1,
				'default'   => 14,
				'selectors' => [
					'{{WRAPPER}} .banner-share-link li a' => 'font-size: {{VALUE}}px',
				],
			]
		);

		$this->add_control(
			'i_color',
			[
				'label'     => __( 'Icon Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-share-link li a i' => 'text-shadow: 0 0 {{VALUE}}, 0 30px {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'i_color_hover',
			[
				'label'     => __( 'Icon Hover Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-share-link li a:hover i' => 'text-shadow: 0 -30px {{VALUE}}, 0 0 {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$sliders  = $settings['sliders'];

		$this->add_render_attribute( 'wrapper', 'class', [
			'swiper-container',
			'banner__slider'
		] );


		$slider_options = $this->get_slider_options( $settings );
		$this->add_render_attribute( 'wrapper', 'data-banner', wp_json_encode( $slider_options ) );

		$this->add_render_attribute( 'button', 'class', 'dmt-btn' );

		?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<?php if ( $settings['navigation'] == 'yes' ): ?>
				<div class="banner__slider-prev"><i class="feather-chevron-left"></i></div>
			<?php endif; ?>

			<div class="swiper-wrapper">
				<?php foreach ( $sliders as $item ) : ?>
					<div class="swiper-slide">
						<div class="banner__slide">
							<div class="container">
								<div class="row align-items-center">
									<div class="col-md-7 dmt-order-lg-2">
										<div class="banner__content">
											<?php if ( ! empty( $item['banner_subtitle'] ) ) : ?>
												<h3 class="banner__subtitle"><?php echo $item['banner_subtitle']; ?></h3>
											<?php endif; ?>

											<?php if ( ! empty( $item['banner_title'] ) ) : ?>
												<h1 class="banner__title"><?php echo $item['banner_title']; ?></h1>
											<?php endif; ?>

											<?php if ( ! empty( $item['banner_description'] ) ) : ?>
												<div class="banner__description"><?php echo $item['banner_description']; ?></div>
											<?php endif; ?>


											<?php if ( ! empty( $item['btn_text_one'] ) ) : ?>
												<a <?php $this->print_render_attribute_string( 'button' ); ?>><?php echo esc_html( $item['btn_text_one'] ); ?></a>
											<?php endif; ?>

										</div>
										<!-- /.banner__content -->
									</div>
									<!-- /.col-md-7 -->

									<div class="col-md-5">
										<div class="banner__image">

											<div class="banner__image-shape">
												<svg xmlns="http://www.w3.org/2000/svg" width="513" height="513" viewBox="0 0 513 513" fill="none">
													<path d="M513 256.5C513 398.161 398.161 513 256.5 513C114.839 513 0 398.161 0 256.5C0 114.839 114.839 0 256.5 0C398.161 0 513 114.839 513 256.5ZM31.2937 256.5C31.2937 380.878 132.122 481.706 256.5 481.706C380.878 481.706 481.706 380.878 481.706 256.5C481.706 132.122 380.878 31.2937 256.5 31.2937C132.122 31.2937 31.2937 132.122 31.2937 256.5Z" fill="#DEEBED"/>
													<circle cx="256.5" cy="256.5" r="172.05" fill="#CFDBDD"/>
												</svg>

											</div>
											<!-- /.banner__image-shape -->

											<img src="<?php echo esc_url( $item['banner_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['banner_title'] ); ?>">
										</div>
									</div>
								</div>
								<!-- /.row -->
							</div>
						</div>
						<!-- /.banner__slide -->
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( $settings['navigation'] == 'yes' ): ?>
				<div class="banner__slider-next"><i class="feather-chevron-right"></i></div>
			<?php endif; ?>

			<?php if ( $settings['pagination'] == 'yes' ): ?>
				<div class="banner-pagination dmt-slider-pagination"></div>
			<?php endif; ?>
		</div>
		<?php

	}

	protected function get_slider_options( array $settings ) {

		// Loop
		if ( $settings['loop'] == 'yes' ) {
			$slider_options['loop'] = true;
		}

		// Speed
		if ( ! empty( $settings['speed'] ) ) {
			$slider_options['speed'] = $settings['speed'];
		}

		// Auto Play
		if ( $settings['autoplay'] == 'yes' ) {
			$slider_options['autoplay'] = [
				'delay'                => $settings['autoplay_time'],
				'disableOnInteraction' => false
			];
		} else {
			$slider_options['autoplay'] = [
				'delay' => '99999999999',
			];
		}

		if ( $settings['navigation'] == 'yes' ) {
			$slider_options['navigation'] = [
				'nextEl' => '.banner__slider-next',
				'prevEl' => '.banner__slider-prev'
			];
		}

		if ( $settings['pagination'] == 'yes' ) {
			$slider_options['pagination'] = [
				'el'        => '.banner-pagination',
				'clickable' => true
			];
		}

		return $slider_options;
	}
}