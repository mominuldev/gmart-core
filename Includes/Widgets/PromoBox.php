<?php

namespace DesignMonks\MonksMartCore\Widgets;
defined( 'ABSPATH' ) || exit; // Abort, if called directly.

use Elementor\{Group_Control_Background, Utils, Widget_Base, Controls_Manager, Group_Control_Typography};

class PromoBox extends Widget_Base {

	public function get_name() {
		return 'dmt-promo-category';
	}

	public function get_title() {
		return esc_html__( 'Dmt Promo Box', 'gmart-core' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return [ 'dmt-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section( 'section_tab', [
			'label' => esc_html__( 'Promo Box', 'gmart-core' ),
		] );

		// Layout
		// =====================
		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'one'   => esc_html__( 'Layout 1', 'gmart-core' ),
				'two'   => esc_html__( 'Layout 2', 'gmart-core' ),
				'three' => esc_html__( 'Layout 3', 'gmart-core' ),
				'four'  => esc_html__( 'Layout 4', 'gmart-core' ),
			],
			'default' => 'two',
		] );

		// Offer Percentage
		$this->add_control( 'offer_percentage', [
			'label'       => esc_html__( 'Offer Percentage', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Offer Percentage', 'gmart-core' ),
			'default'     => esc_html__( '50', 'gmart-core' ),
			'condition'   => [
				'layout' => ['one', 'four']
			]
		] );

		// Offer Suffix
		$this->add_control( 'offer_suffix', [
			'label'       => esc_html__( 'Offer Suffix', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Offer Suffix', 'gmart-core' ),
			'default'     => '%',
			'condition'   => [
				'layout' => ['one', 'four']
			]
		] );

		// Offer Text
		$this->add_control( 'offer_text', [
			'label'       => esc_html__( 'Offer Text', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Offer Text', 'gmart-core' ),
			'default'     => esc_html__( 'Off', 'gmart-core' ),
			'condition'   => [
				'layout' => ['one', 'four']
			]
		] );

		$this->add_control( 'promo_sub_title', [
			'label'       => esc_html__( 'Sub Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __( 'Summer Trending Now', 'gmart-core' ),
			'placeholder' => esc_html__( 'Sub Title', 'gmart-core' ),
			'condition'   => [
				'layout' => 'one'
			]
		] );


		$this->add_control( 'promo_title', [
			'label'       => esc_html__( 'Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Title', 'gmart-core' ),
			'default'     => esc_html__( 'Men Collection', 'gmart-core' ),
		] );

		// Description
		$this->add_control( 'promo_description', [
			'label'       => esc_html__( 'Description', 'gmart-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'placeholder' => esc_html__( 'Description', 'gmart-core' ),
			'default'     => esc_html__( 'Comfortable and new stylish cloths for everyone. Find true style', 'gmart-core' ),
			'condition'  => [
				'layout' => 'four'
			]
		] );


		// Button Text
		$this->add_control( 'promo_btn_text', [
			'label'       => esc_html__( 'Button Text', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Button Text', 'gmart-core' ),
			'default'     => esc_html__( 'Shop Now', 'gmart-core' ),
		] );

		// Button Link
		$this->add_control(
			'btn_url',
			[
				'label'       => esc_html__( 'Button URL', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		// Image
		$this->add_control( 'promo_image', [
			'label'   => esc_html__( 'Image', 'gmart-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );


		$this->add_control( 'content_horizontal', [
			'label'                => esc_html__( 'Horizontal Position', 'gmart-core' ),
			'type'                 => Controls_Manager::CHOOSE,
			'label_block'          => false,
			'options'              => array(
				'left'   => array(
					'title' => esc_html__( 'Left', 'gmart-core' ),
					'icon'  => 'eicon-h-align-left',
				),
				'center' => array(
					'title' => esc_html__( 'Center', 'gmart-core' ),
					'icon'  => 'eicon-h-align-center',
				),
				'right'  => array(
					'title' => esc_html__( 'Right', 'gmart-core' ),
					'icon'  => 'eicon-h-align-right',
				),
			),
			'default'              => 'left',
			'selectors'            => [
				'{{WRAPPER}} .dmt-promo__content' => '{{VALUE}}',
			],
			'selectors_dictionary' => [
				'left'   => 'justify-content: start',
				'center' => 'justify-content: center',
				'right'  => 'justify-content: end',
			],
			'condition'            => [
				'layout!' => 'three'
			]
		] );

		$this->add_control( 'content_vertical', [
			'label'                => esc_html__( 'Vertical Position', 'gmart-core' ),
			'type'                 => Controls_Manager::CHOOSE,
			'label_block'          => false,
			'options'              => array(
				'top'    => array(
					'title' => esc_html__( 'Top', 'gmart-core' ),
					'icon'  => 'eicon-v-align-top',
				),
				'middle' => array(
					'title' => esc_html__( 'Middle', 'gmart-core' ),
					'icon'  => 'eicon-v-align-middle',
				),
				'bottom' => array(
					'title' => esc_html__( 'Bottom', 'gmart-core' ),
					'icon'  => 'eicon-v-align-bottom',
				),
			),
			'default'              => 'top',
			'selectors'            => [
				'{{WRAPPER}} .dmt-promo__content' => 'align-items: {{VALUE}}',
			],
			'selectors_dictionary' => [
				'top'    => 'flex-start',
				'middle' => 'center',
				'bottom' => 'flex-end',
			]
		] );


		$this->add_responsive_control( 'title_align', [
			'label'     => esc_html__( 'Alignment', 'gmart-core' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [

				'left'    => [
					'title' => esc_html__( 'Left', 'gmart-core' ),
					'icon'  => 'eicon-text-align-left',
				],
				'center'  => [
					'title' => esc_html__( 'Center', 'gmart-core' ),
					'icon'  => 'eicon-text-align-center',
				],
				'right'   => [
					'title' => esc_html__( 'Right', 'gmart-core' ),
					'icon'  => 'eicon-text-align-right',
				],
				'justify' => [
					'title' => esc_html__( 'Justified', 'gmart-core' ),
					'icon'  => 'eicon-text-align-justify',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .dmt-promo' => 'text-align: {{VALUE}};'
			],
		] );


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

		// Padding
		$this->add_responsive_control( 'content_padding', [
			'label'      => esc_html__( 'Padding', 'gmart-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dmt-promo .dmt-promo__content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition'  => [
				'layout' => 'three'
			]
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

		// Space Between Title and Button
		$this->add_responsive_control( 'subtitle_bottom_space', [
			'label'      => esc_html__( 'Space Between Description and Button', 'gmart-core' ),
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
				'{{WRAPPER}} .dmt-promo .dmt-promo__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
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
					'{{WRAPPER}} .dmt-promo__image img ' => 'height: {{SIZE}}{{UNIT}}; width: 100%; object-fit: cover;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
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
				'{{WRAPPER}} .dmt-promo__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$layout   = $settings['layout'];

		// Wrapper Classes
		$this->add_render_attribute( 'wrapper', 'class', 'dmt-promo' );

		if ( $settings['layout'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'dmt-promo--' . $settings['layout'] );
		}

		if ( ! empty( $settings['btn_url']['url'] ) ) {
			$this->add_link_attributes( 'btn_link', $settings['btn_url'] );
		}

		// Button Classes
		if ( 'four' === $settings['layout'] ) {
			$this->add_render_attribute( 'btn_link', 'class', 'dmt-btn btn-light' );
		} else if ( 'one' === $settings['layout'] ) {
			$this->add_render_attribute( 'btn_link', 'class', 'dmt-btn' );
		} else {
			$this->add_render_attribute( 'btn_link', 'class', 'dmt-btn-url ' );
		}

		require __DIR__ . '/templates/promo/layout-' . $layout . '.php';
	}
}




