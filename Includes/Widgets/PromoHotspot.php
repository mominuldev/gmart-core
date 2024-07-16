<?php

namespace GPTheme\GmartCore\Widgets;
defined( 'ABSPATH' ) || exit; // Abort, if called directly.

use Elementor\{Utils, Widget_Base, Controls_Manager, Group_Control_Typography};

class PromoHotspot extends Widget_Base {

	public function get_name() {
		return 'dmt-product-hotspot';
	}

	public function get_title() {
		return esc_html__( 'Dmt Product Hotspot', 'gmart-core' );
	}

	public function get_icon() {
		return 'eicon-image-hotspot';
	}

	public function get_categories() {
		return [ 'dmt-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section( 'section_tab', [
			'label' => esc_html__( 'Hotspot', 'gmart-core' ),
		] );

		// Hotspot Image
		$this->add_control(
			'hotspot_image',
			[
				'label'   => esc_html__( 'Hotspot Image', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		// Hotspot Repeater
		$repeater = new \Elementor\Repeater();

		// Product select type
//		$repeater->add_control(
//			'product_type',
//			[
//				'label'   => esc_html__( 'Product Select Type', 'gmart-core' ),
//				'type'    => \Elementor\Controls_Manager::SELECT,
//				'default' => 'url',
//				'options' => [
//					'slug' => esc_html__( 'URL', 'gmart-core' ),
//					'id'  => esc_html__( 'ID', 'gmart-core' ),
//				],
//			]
//		);
//
//
//		// Product URL Text
//		$repeater->add_control(
//			'product_slug',
//			[
//				'label'       => esc_html__( 'Product URL', 'gmart-core' ),
//				'type'        => \Elementor\Controls_Manager::TEXT,
//				'label_block' => true,
//				'placeholder' => esc_html__( 'Product URL', 'gmart-core' ),
//				'description' => esc_html__( 'Enter the product URL here Ex: product-name', 'gmart-core' ),
//				'condition'   => [
//					'product_type' => 'slug'
//				]
//			]
//		);

		// Product ID
//		$repeater->add_control(
//			'product_id',
//			[
//				'label'       => esc_html__( 'Product ID', 'gmart-core' ),
//				'type'        => \Elementor\Controls_Manager::TEXT,
//				'label_block' => true,
//				'placeholder' => esc_html__( 'Product ID', 'gmart-core' ),
//				'description' => esc_html__( 'Enter the product ID here, Ex: 1', 'gmart-core' ),
//
//			]
//		);
//
//		// Position Slider Horizontal
//		$repeater->add_control(
//			'position_x',
//			[
//				'label'   => esc_html__( 'Position X', 'gmart-core' ),
//				'type'    => \Elementor\Controls_Manager::SLIDER,
//				'default' => [
//					'size' => 50,
//				],
//				'range'   => [
//					'px' => [
//						'min'  => 0,
//						'max'  => 100,
//						'step' => 1,
//					],
//				],
//				'selectors' => [
//					'{{WRAPPER}} {{CURRENT_ITEM}}.product-hotspot__item' => 'left: {{SIZE}}%;'
//				],
//			]
//		);
//
//		// Position Slider Vertical
//		$repeater->add_control(
//			'position_y',
//			[
//				'label'   => esc_html__( 'Position Y', 'gmart-core' ),
//				'type'    => \Elementor\Controls_Manager::SLIDER,
//				'default' => [
//					'size' => 50,
//				],
//				'range'   => [
//					'px' => [
//						'min'  => 0,
//						'max'  => 100,
//						'step' => 1,
//					],
//				],
//				'selectors' => [
//					'{{WRAPPER}} {{CURRENT_ITEM}}.product-hotspot__item' => 'top: {{SIZE}}%;'
//				],
//			]
//		);
//
//		$this->add_control(
//			'hotspot',
//			[
//				'label'       => esc_html__( 'Hotspot', 'gmart-core' ),
//				'type'        => \Elementor\Controls_Manager::REPEATER,
//				'fields'      => $repeater->get_controls(),
//				'title_field' => '{{{ product_slug }}}',
//			]
//		);


		$this->add_control(
			'hotspot',
			[
				'label'   => esc_html__( 'Repeater List', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::REPEATER,
				'fields'  => [
					[
						'name'        => 'product_id',
						'label'       => esc_html__( 'Product ID', 'gmart-core' ),
						'type'        => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'placeholder' => esc_html__( 'Product ID', 'gmart-core' ),
						'description' => esc_html__( 'Enter the product ID here, Ex: 1', 'gmart-core' ),
					],
					[
						'name'    => 'position_x',
						'label'   => esc_html__( 'Position X', 'gmart-core' ),
						'type'    => \Elementor\Controls_Manager::SLIDER,
						'default' => [
							'size' => 50,
						],
						'range'   => [
							'px' => [
								'min'  => 0,
								'max'  => 100,
								'step' => 1,
							],
						],
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}.product-hotspot__item' => 'left: {{SIZE}}%;'
						],
					],
					[
						'name'      => 'position_y',
						'label'     => esc_html__( 'Position Y', 'gmart-core' ),
						'type'      => \Elementor\Controls_Manager::SLIDER,
						'default'   => [
							'size' => 50,
						],
						'range'     => [
							'px' => [
								'min'  => 0,
								'max'  => 100,
								'step' => 1,
							],
						],
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}.product-hotspot__item' => 'top: {{SIZE}}%;'
						],
					],

				],
				'default' => [
					[
						'product_type' => 'slug',
						'product_slug' => 'product-slug',
						'product_id'   => 37,
						'position_x'   => [
							'size' => 50,
						],
						'position_y'   => [
							'size' => 50,
						],
					],
				],
//				'title_field' => '{{{ list_title }}}',
			]
		);


		$this->end_controls_section();


		//Title Style Section
		$this->start_controls_section( 'section_title_style', [
			'label' => esc_html__( 'Title', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color_two', [
			'label'     => esc_html__( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dmt-promo .dmt-promo__title,
					{{WRAPPER}} .dmt-promo .dmt-promo__title a,
					{{WRAPPER}} .promo-box-two .promo-content .box-title,
					{{WRAPPER}} .promo-box-two .promo-content .box-title a' => 'color: {{VALUE}};'
			],
		] );

		$this->add_control( 'title_color_two_hover', [
			'label'     => esc_html__( 'Hover Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dmt-promo .dmt-promo__title:hover,
					{{WRAPPER}} .dmt-promo .dmt-promo__title a:hover' => 'color: {{VALUE}};'
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .dmt-promo .dmt-promo__title',
		] );

		// Space Between Title and Button
		$this->add_responsive_control( 'title_bottom_space', [
			'label'      => esc_html__( 'Space Between Title and Button', 'gmart-core' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				],
				'em' => [
					'min'  => 0,
					'max'  => 10,
					'step' => 0.1,
				]
			],
			'selectors'  => [
				'{{WRAPPER}} .dmt-promo .dmt-promo__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		//Subtitle Style Section
		$this->start_controls_section( 'section_subtitle_style', [
			'label' => esc_html__( 'Description', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'subtitle_color', [
			'label'     => esc_html__( 'color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dmt-promo .dmt-promo__description, {{WRAPPER}} .description' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'promo_subtitle_typography',
			'selector' => '{{WRAPPER}} .dmt-promo .dmt-promo__description',
		] );

		$this->end_controls_section();

		//Background Style
		$this->start_controls_section( 'section_promo_style', [
			'label' => esc_html__( 'Promo Box Wrapper', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control(
			'box_height',
			[
				'label'      => esc_html__( 'Box Height', 'plugin-name' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .dmt-promo' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'service_bg_color',
				'label'    => esc_html__( 'Background', 'plugin-name' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dmt-promo',
			]
		);

		$this->add_control( 'service_border_color', [
			'label'     => esc_html__( 'Border Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dmt-promo' => 'border-color: {{VALUE}};'
			],
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => __( 'Padding', 'gmart-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dmt-promo:not(.style_one), {{WRAPPER}} .dmt-promo.style_one .dmt-promo__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_margin', [
			'label'      => __( 'Margin', 'gmart-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dmt-promo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();


		require __DIR__ . '/templates/hotspot/hotspot.php';
	}
}




