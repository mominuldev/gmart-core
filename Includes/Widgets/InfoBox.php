<?php

namespace DesignMonks\MonksMartCore\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class InfoBox extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'dmt-box';
	}


	public function get_title() {
		return __( 'Dmt Info Box', 'gmart-core' );
	}

	public function get_icon() {

		return 'eicon-text';
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

	protected function register_controls() {

		$this->start_controls_section(
			'info_content',
			[
				'label' => __( 'Content', 'gmart-core' ),
			]
		);


		// Icons
		$this->add_control(
			'info_icon',
			[
				'label'   => __( 'Icon', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-info-circle',
					'library' => 'solid',
				],
			]
		);

		// Title
		$this->add_control(
			'info_title',
			[
				'label'       => __( 'Title', 'gmart-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter title', 'gmart-core' ),
				'label_block' => true,
				'default'     => __( 'Do you have any queries?', 'gmart-core' ),
			]
		);

		// Button
		$this->add_control(
			'info_button',
			[
				'label'       => __( 'Button Text', 'gmart-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'gmart-core' ),
				'label_block' => true,
				'default'     => __( 'Shoot a Direct Mail', 'gmart-core' ),
			]
		);

		$this->add_control(
			'info_button_link',
			[
				'label'       => esc_html__( 'Link', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => '',
					'is_external' => false,
					'nofollow' => true,
					 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		// Alignment
		$this->add_control(
			'info_alignment',
			[
				'label'   => __( 'Alignment', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .dmt-info-box' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'social_style_section',
			[
				'label' => __( 'Title', 'gmart-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'info_color',
			[
				'label'     => __( 'Color', 'gmart-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-info-box__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'info_typography',
				'label'    => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-info-box__title',
			]
		);

		// Space
		$this->add_responsive_control(
			'info_space',
			[
				'label'      => __( 'Space', 'gmart-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dmt-info-box__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

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

		// Info Box Style
		$this->start_controls_section(
			'info_box_style',
			[
				'label' => __( 'Info Box', 'gmart-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'info_box_bg_color',
			[
				'label'     => __( 'Background Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-info-box' => 'background-color: {{VALUE}}',
				],
			]
		);

		// Backdrop Filter
		$this->add_control(
			'info_box_backdrop_filter',
			[
				'label'     => __( 'Backdrop Filter', 'gmart-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none'         => __( 'None', 'gmart-core' ),
					'blur'         => __( 'Blur', 'gmart-core' ),
					'brightness'   => __( 'Brightness', 'gmart-core' ),
					'contrast'     => __( 'Contrast', 'gmart-core' ),
					'grayscale'    => __( 'Grayscale', 'gmart-core' ),
					'hue-rotate'   => __( 'Hue Rotate', 'gmart-core' ),
					'invert'       => __( 'Invert', 'gmart-core' ),
					'opacity'      => __( 'Opacity', 'gmart-core' ),
					'saturate'     => __( 'Saturate', 'gmart-core' ),
					'sepia'        => __( 'Sepia', 'gmart-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .dmt-info-box' => '-webkit-backdrop-filter: {{VALUE}}(1px); backdrop-filter: {{VALUE}}(1px);',
				],
			]
		);

		$this->add_control(
			'info_box_backdrop_filter_value',
			[
				'label'     => __( 'Backdrop Filter Value', 'gmart-core' ),
				'type'      => Controls_Manager::SLIDER,
				'condition' => [
					'info_box_backdrop_filter!' => 'none',
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dmt-info-box' => '-webkit-backdrop-filter: {{info_box_backdrop_filter.VALUE}}({{SIZE}}{{UNIT}}); backdrop-filter: {{info_box_backdrop_filter.VALUE}}({{SIZE}}{{UNIT}});',
				],
			]
		);

		// Spacing margin bottom Slider Control
		$this->add_responsive_control(
			'info_box_margin_bottom',
			[
				'label'      => __( 'Margin Bottom', 'gmart-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dmt-info-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'info_box_padding',
			[
				'label'      => __( 'Padding', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dmt-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'info_box_border',
				'label'    => __( 'Border', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-info-box',
			]
		);

		$this->add_responsive_control(
			'info_box_border_radius',
			[
				'label'      => __( 'Border Radius', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dmt-info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'info_box_box_shadow',
				'selector' => '{{WRAPPER}} .dmt-info-box',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['info_button_link']['url'] ) ) {
			$this->add_link_attributes( 'info_button_link', $settings['info_button_link'] );
		}

		// Button Class
		$this->add_render_attribute( 'info_button_link', 'class', 'dmt-btn' );

		// Wrapper Class
		$this->add_render_attribute( 'wrapper', 'class', 'dmt-info-box' );

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( ! empty( $settings['info_icon'] ) ) : ?>
				<div class="dmt-info-box__icon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['info_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
			<?php endif; ?>

			<div class="dmt-info-box__content">
				<?php if ( ! empty( $settings['info_title'] ) ) : ?>
					<h3 class="dmt-info-box__title"><?php echo esc_html( $settings['info_title'] ); ?></h3>
				<?php endif; ?>

				<?php if ( ! empty( $settings['info_button'] ) ) : ?>
					<a <?php echo $this->get_render_attribute_string( 'info_button_link' ); ?>>
						<i class="ri-mail-open-line"></i>
						<?php echo esc_html( $settings['info_button'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

}

