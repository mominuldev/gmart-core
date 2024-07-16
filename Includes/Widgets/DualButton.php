<?php

namespace GPTheme\GmartCore\Widgets;

use Elementor\ {
	Icons_Manager,
	Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Group_Control_Text_Shadow,
	Group_Control_Typography,
	Widget_Base
};

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class DualButton extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name()
	{
		return 'dmt-dual-button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title()
	{
		return __('Dmt Dual Button', 'gmart-core');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon()
	{
		return 'eicon-button';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the icon box widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories()
	{
		return ['dmt-elements'];
	}


	/**
	 * The keywords for search.
	 *
	 * @return array
	 */
	public function get_keywords() {
		return [ 'button', 'call to action', 'decent element', 'btn' ];
	}


	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @return array An array containing button sizes.
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 */
	public static function get_button_sizes()
	{
		return [
			'btn-xs' => __('Extra Small', 'gmart-core'),
			'btn-sm' => __('Small', 'gmart-core'),
			'btn-md' => __('Medium', 'gmart-core'),
			'btn-lg' => __('Large', 'gmart-core'),
			'btn-xl' => __('Extra Large', 'gmart-core'),
		];
	}

	/**
	 * Add controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'second_button_section',
			[
				'label' => __( 'General Settings', 'gmart-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label' => __( 'Alignment', 'gmart-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'gmart-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'gmart-core' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'gmart-core' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .dmt-button-container' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'gmart-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-md',
				'options' => $this->get_button_sizes(),
				'style_transfer' => true,
			]
		);

		$this->add_responsive_control( 'space_between_button', [
			'label'           => __( 'Space Between Buttons', 'gmart-core' ),
			'type'            => Controls_Manager::SLIDER,
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 15,
			],
			'selectors'       => [
				'{{WRAPPER}} .dmt-button-primary' => 'margin-right: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .dmt-block .dmt-button-primary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
			'separator' => 'after'
		] );

		$this->end_controls_section();


		$this->start_controls_section(
			'button_section',
			[
				'label' => __( 'Dual Button', 'gmart-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->start_controls_tabs( 'tabs_dual_button' );

		$this->start_controls_tab(
			'tab_button_primary',
			[
				'label' => __('Primary', 'gmart-core'),
			]
		);

		$this->add_control(
			'button_label',
			[
				'label' => __( 'Text', 'gmart-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'gmart-core' ),
				'placeholder' => __( 'Type your button title here', 'gmart-core' ),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'gmart-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gmart-core' ),
				'default' => [
					'url' => '#',
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'button_icon_options',
			[
				'label' => __( 'Icons', 'gmart-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'gmart-core' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'gmart-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'gmart-core' ),
					'right' => esc_html__( 'After', 'gmart-core' ),
				],
				'condition' => [
					'selected_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'gmart-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-one .dmt-btn__align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dmt-btn-one .dmt-btn__align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control( 'icon_size', [
			'label'           => __( 'Icon Size', 'gmart-core' ),
			'type'            => Controls_Manager::SLIDER,
			'range'           => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default' => [
				'unit' => 'px',
				'size' => 15,
			],
			'selectors'       => [
				'{{WRAPPER}} .dmt-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .dmt-btn-one svg, {{WRAPPER}} .dmt-btn-one img,
				{{WRAPPER}} .dmt-btn-two svg, {{WRAPPER}} .dmt-btn-two img' => 'width: {{SIZE}}{{UNIT}};',
			],

		] );

		$this->add_control(
			'button_shape',
			[
				'label' => __('Shape', 'gmart-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-round',
				'options' => [
					'btn-square' => __('Square', 'gmart-core'),
					'btn-round' => __('Round', 'gmart-core'),
					'btn-circle' => __('Circle', 'gmart-core'),
				],
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __('Shape', 'gmart-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-default',
				'options' => [
					'btn-default' => __('Default', 'gmart-core'),
					'btn-outline' => __('Outline', 'gmart-core'),
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_secondary',
			[
				'label' => __('Secondary', 'gmart-core'),
			]
		);

		$this->add_control(
			'button_type',
			[
				'label' => __('Shape', 'gmart-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'button',
				'options' => [
					'button' => __('Simple Button', 'gmart-core'),
					'popup_video' => __('Popup Video Button', 'gmart-core'),
				],
			]
		);

		$this->add_control(
			'sec_button_label',
			[
				'label' => __( 'Text', 'gmart-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'gmart-core' ),
				'placeholder' => __( 'Type your button title here', 'gmart-core' ),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'sec_button_link',
			[
				'label' => __( 'Link', 'gmart-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gmart-core' ),
				'default' => [
					'url' => '#',
				],
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'sec_button_icon_options',
			[
				'label' => __( 'Icons', 'gmart-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sec_selected_icon',
			[
				'label' => esc_html__( 'Icon', 'gmart-core' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'sec_icon',
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'sec_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'gmart-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'gmart-core' ),
					'right' => esc_html__( 'After', 'gmart-core' ),
				],
				'condition' => [
					'sec_selected_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'sec_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'gmart-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-two .dmt-btn__align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dmt-btn-two .dmt-btn__align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sec_button_shape',
			[
				'label' => __('Shape', 'gmart-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-round',
				'options' => [
					'btn-square' => __('Square', 'gmart-core'),
					'btn-round' => __('Round', 'gmart-core'),
					'btn-circle' => __('Circle', 'gmart-core'),
				],
			]
		);

		$this->add_control(
			'sec_button_style',
			[
				'label' => __('Shape', 'gmart-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn-outline',
				'options' => [
					'btn-default' => __('Default', 'gmart-core'),
					'btn-outline' => __('Outline', 'gmart-core'),
				],
			]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_layout',
			[
				'label' => __( 'Layout', 'gmart-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'dmt-inline' => [
						'title' => __( 'Inline', 'gmart-core' ),
						'icon' => 'eicon-navigation-horizontal',
					],
					'dmt-block' => [
						'title' => __( 'Block', 'gmart-core' ),
						'icon' => 'eicon-navigation-vertical',
					],
				],
				'default' => 'dmt-inline',
			]
		);

		$this->end_controls_section();

		// Button Primary Style Section
		//=====================================
		$this->start_controls_section(
			'button_primary_style_section',
			[
				'label' => __( 'Button', 'gmart-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-btn-one',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .dmt-btn-one',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'gmart-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__( 'Padding', 'gmart-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'gmart-core' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Color', 'gmart-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-one' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'gmart-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .dmt-btn-one',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .dmt-btn-one',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .dmt-btn-one',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'gmart-core' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__( 'Text Color', 'gmart-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-one:hover, {{WRAPPER}} .dmt-btn-one:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dmt-btn-one:hover svg, {{WRAPPER}} .dmt-btn-one:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'label' => esc_html__( 'Background', 'gmart-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .dmt-btn-one:hover, {{WRAPPER}} .dmt-btn-one:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'selector' => '{{WRAPPER}} .dmt-btn-one:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .dmt-btn-one:hover',
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'gmart-core' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Secondary Button Style
		//============================
		$this->start_controls_section(
			'button_secondary_style_section',
			[
				'label' => __( 'Secondary Button', 'gmart-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_type' => 'button'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sec_button_typography',
				'label' => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-btn-two',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'sec_text_shadow',
				'selector' => '{{WRAPPER}} .dmt-btn-two',
			]
		);

		$this->add_control(
			'sec_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'gmart-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sec_text_padding',
			[
				'label' => esc_html__( 'Padding', 'gmart-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'sec_tabs_button_style' );

		$this->start_controls_tab(
			'sec_tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'gmart-core' ),
			]
		);

		$this->add_control(
			'sec_button_text_color',
			[
				'label' => esc_html__( 'Color', 'gmart-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-two' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'sec_background',
				'label' => esc_html__( 'Background', 'gmart-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .dmt-btn-two',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sec_border',
				'selector' => '{{WRAPPER}} .dmt-btn-two',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sec_button_box_shadow',
				'selector' => '{{WRAPPER}} .dmt-btn-two',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'sec_tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'gmart-core' ),
			]
		);

		$this->add_control(
			'sec_hover_color',
			[
				'label' => esc_html__( 'Color', 'gmart-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-btn-two:hover, {{WRAPPER}} .dmt-btn-two:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .dmt-btn-two:hover svg, {{WRAPPER}} .dmt-btn-two:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'sec_button_background_hover',
				'label' => esc_html__( 'Background', 'gmart-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .dmt-btn-two:hover, {{WRAPPER}} .dmt-btn-two:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sec_border_hover',
				'selector' => '{{WRAPPER}} .dmt-btn-two:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sec_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .dmt-btn-two:hover',
			]
		);

		$this->add_control(
			'sec_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'gmart-core' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

		// Video Button Style
		//=======================
		$this->start_controls_section(
			'video_button_style',
			[
				'label' => __( 'Popup Video Button', 'gmart-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_type' => 'popup_video'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_button_typography',
				'label' => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .play-button',
			]
		);

		$this->add_control(
			'video_border_radius',
			[
				'label' => esc_html__( 'Icon Border Radius', 'gmart-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .play-button i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_text_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'gmart-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .play-button i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_video_style' );

		$this->start_controls_tab(
			'tab_button_video_normal',
			[
				'label' => esc_html__( 'Normal', 'gmart-core' ),
			]
		);

		$this->add_control(
			'video_button_color',
			[
				'label' => esc_html__( 'Color', 'gmart-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .play-button .dmt-btn__text:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'video_button_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'gmart-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'play_button_background',
				'label' => esc_html__( 'Icon Background', 'gmart-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .play-button .dmt-btn__icon',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'play_button_border',
				'selector' => '{{WRAPPER}} .play-button .dmt-btn__icon',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'video_button_box_shadow',
				'selector' => '{{WRAPPER}} .play-button .dmt-btn__icon',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_video_button_hover',
			[
				'label' => esc_html__( 'Hover', 'gmart-core' ),
			]
		);

		$this->add_control(
			'video_button_hover_color',
			[
				'label' => esc_html__( 'Color', 'gmart-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button:hover, {{WRAPPER}} .play-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .play-button:hover .dmt-btn__text:after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'video_button_hover_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'gmart-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play-button:hover i, {{WRAPPER}} .play-button:focus i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'play_button_background_hover',
				'label' => esc_html__( 'Icon Background', 'gmart-core' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .play-button:hover .dmt-btn__icon, {{WRAPPER}} .play-button:focus .dmt-btn__icon',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'play_button_border_hover',
				'selector' => '{{WRAPPER}} .play-button:hover i',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'video_button_hover_box_shadow',
				'selector' => '{{WRAPPER}} .play-button:hover i',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$migration_allowed = Icons_Manager::is_migration_allowed();

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if ( ! $is_new && empty( $settings['icon_align'] ) ) {
			$settings['icon_align'] = $this->get_settings( 'icon_align' );
		}

		if ( ! $is_new && empty( $settings['sec_icon_align'] ) ) {
			$settings['sec_icon_align'] = $this->get_settings( 'sec_icon_align' );
		}

		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['button_link'] );
		}

		if ( ! empty( $settings['sec_button_link']['url'] ) ) {
			$this->add_link_attributes( 'buttontwo', $settings['sec_button_link'] );
		}

		// Video Button
		if ( ! empty( $settings['sec_button_link']['url'] ) ) {
			$this->add_link_attributes( 'video', $settings['sec_button_link'] );
		}

		/**
		 * Button
		 */
		$this->add_render_attribute( 'button', 'class', ['dmt-btn dmt-btn-one', $settings['button_style'] ] );
		// Button Shape
		if( ! empty( $settings['button_shape'] ) ) {
			$this->add_render_attribute( 'button', 'class',  $settings['button_shape'] );
		}
		$this->add_render_attribute( 'video', 'class', 'play-button btn-fill'  );

		/**
		 * Button Size Class
		 */
		if ( ! empty ( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['size'] );
		}

		$this->add_render_attribute( 'buttontwo', 'class', ['dmt-btn dmt-btn-two', $settings['sec_button_style'] ] );

		/**
		 * Button Size Class
		 */
		if ( ! empty ( $settings['size'] ) ) {
			$this->add_render_attribute( 'buttontwo', 'class', $settings['size'] );
		}

		if( ! empty( $settings['button_shape'] ) ) {
			$this->add_render_attribute( 'buttontwo', 'class',  $settings['sec_button_shape'] );
		}


		/**
		 * Extra Css Classes
		 */
		if ( ! empty( $settings['button_class'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['button_class'] );
		}

		if ( ! empty( $settings['button_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', $settings['button_id'] );
		}
		$this->add_render_attribute( [
			'icon-align' => [
				'class' => [
					'dmt-btn__icon',
					'dmt-btn__align-icon-' . $settings['icon_align'],
				],
			],
			'text' => [
				'class' => 'dmt-btn__text',
			],
		] );

		$this->add_render_attribute( [
			'sec_icon_align' => [
				'class' => [
					'dmt-btn__icon',
					'dmt-btn__align-icon-' . $settings['sec_icon_align'],
				],
			],
			'text' => [
				'class' => 'dmt-btn__text',
			],
		] );

		$this->add_render_attribute( 'button_label', 'class', 'dmt-btn__text' );
		$this->add_inline_editing_attributes( 'button_label', 'none' );

		$this->add_render_attribute( 'sec_button_label', 'class', 'dmt-btn__text' );
		$this->add_inline_editing_attributes( 'sec_button_label', 'none' );

		?>

		<div class="dmt-button-container <?php echo esc_attr( $settings['button_layout'] ); ?>">

			<?php if ( ! empty( $settings['button_label'] ) ) : ?>
				<div class="dmt-button-wrapper dmt-button-primary">
					<a <?php $this->print_render_attribute_string( 'button' ); ?>>
						<span class="dmt-btn-content-wrapper">
							<?php if ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
								<span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
									<?php if ( $is_new || $migrated ) :
										Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
									else : ?>
										<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
									<?php endif; ?>
								</span>
							<?php endif; ?>
							<span <?php $this->print_render_attribute_string( 'button_label' ); ?>><?php $this->print_unescaped_setting( 'button_label' ); ?></span>
						</span>
						<!-- /.dmt-btn-content-wrapper -->
					</a>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $settings['sec_button_label'] ) ) : ?>
				<div class="dmt-button-wrapper">
					<?php if ( 'button' == $settings['button_type'] ) : ?>
						<a <?php $this->print_render_attribute_string( 'buttontwo' ); ?>>
							<span class="dmt-btn-content-wrapper">
								<?php if ( ! empty( $settings['sec_icon'] ) || ! empty( $settings['sec_selected_icon']['value'] ) ) : ?>
									<span <?php $this->print_render_attribute_string( 'sec_icon_align' ); ?>>
											<?php if ( $is_new || $migrated ) :
												Icons_Manager::render_icon( $settings['sec_selected_icon'], [ 'aria-hidden' => 'true' ] );
											else : ?>
												<i class="<?php echo esc_attr( $settings['sec_icon'] ); ?>" aria-hidden="true"></i>
											<?php endif; ?>
										</span>
								<?php endif; ?>
								<span <?php $this->print_render_attribute_string( 'sec_button_label' ); ?>><?php $this->print_unescaped_setting( 'sec_button_label' ); ?></span>
							</span>
						</a>
					<?php elseif ('popup_video' == $settings['button_type']) : ?>
						<a <?php $this->print_render_attribute_string( 'video' ); ?>>
                            <span class="dmt-btn__icon">
                                <i class="fas fa-play"></i>
                            </span>
							<span class="dmt-btn__text">
                                <?php echo esc_html( $settings['sec_button_label'] ); ?>
                            </span>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<!-- /.dmt-btn-wrapper -->
		<?php
	}
}