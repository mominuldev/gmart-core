<?php

namespace GPTheme\GmartCore\Widgets;

use Elementor\{
	Controls_Manager,
	Group_Control_Typography,
	Repeater,
	Widget_Base
};

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Dmt Tab
 * Dmt widget.
 * @since 1.0.0
 */
class TemplateTabs extends Widget_Base {

	public function get_name() {
		return 'dmt-dynamic-tabs';
	}

	public function get_title() {
		return __( 'Dmt Dynamic Tabs', 'gmart-core' );
	}

	public function get_icon() {
		return 'eicon-tabs';
	}

	public function get_categories() {
		return [ 'dmt-elements' ];
	}

	protected function register_controls() {

		// ------------------------------ Feature list ------------------------------
		$this->start_controls_section(
			'section_tab', [
				'label' => __( 'Dmt Tabs', 'gmart-core' ),
			]
		);

		// Layout
		$this->add_control(
			'tab_layout', [
				'label'   => __( 'Layout', 'gmart-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Horizontal', 'gmart-core' ),
					'vertical'   => __( 'Vertical', 'gmart-core' ),
				],
			]
		);

		// Tab Style
		$this->add_control(
			'tab_style', [
				'label'   => __( 'Tab Style', 'gmart-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-one',
				'options' => [
					'style-one'   => __( 'Style 1', 'gmart-core' ),
					'style-two'   => __( 'Style 2', 'gmart-core' ),
					'style-three' => __( 'Style 3', 'gmart-core' ),

				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_label', [
				'label'       => __( 'Tab Label', 'gmart-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_badge_text', [
				'label'       => __( 'Badge', 'gmart-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		// Icon Type Choose Control
		$repeater->add_control(
			'tab_icon_type',
			[
				'label'   => __( 'Icon Type', 'gmart-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'none' => [
						'title' => __( 'None', 'gmart-core' ),
						'icon'  => 'eicon-ban',
					],
					'icon' => [
						'title' => __( 'Icon', 'gmart-core' ),
						'icon'  => 'eicon-star',
					],
				],
				'default' => 'none',
				'toggle'  => false,
			]
		);

		// Icon Type Select Control
		$repeater->add_control(
			'tab_icon_pack',
			[
				'label'     => __( 'Icon Select', 'gmart-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => [
					'font_awesome' => __( 'Font Awesome', 'gmart-core' ),
					'elegant_icon' => __( 'Elegant Icon', 'gmart-core' ),
				],
				'condition' => [
					'tab_icon_type' => 'icon',
				],

			]
		);

		// Icon Control
		$repeater->add_control(
			'nav_icon',
			[
				'label'     => esc_html__( 'Icon', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'tab_icon_type' => 'icon',
					'tab_icon_pack' => 'font_awesome',
				],
			]
		);


		$repeater->add_control(
			'tab_icon',
			[
				'label'       => __( 'Choose Icon', 'gmart-core' ),
				'type'        => Controls_Manager::ICON,
				'options'     => gotox_simpleline_icons(),
				'include'     => gotox_include_simpleline_icons(),
				'default'     => 'icon-user',
				'label_block' => true,
				'condition'   => [
					'tab_icon_type' => 'icon',
					'tab_icon_pack' => 'elegant_icon',
				],
			]
		);

		// Get Template Library
		$templates = get_posts( array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => - 1,
		) );

		$options = array();
		if ( ! empty( $templates ) && ! is_wp_error( $templates ) ) {
			foreach ( $templates as $template ) {
				$options[ $template->ID ] = $template->post_title;
			}
		}

		$repeater->add_control(
			'template_id',
			[
				'label'   => __( 'Choose Template', 'gmart-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $options,
				'default' => '0',
			]
		);


		$this->add_control(
			'advance_tab',
			[
				'label'       => __( 'Tab Lists', 'gmart-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'tab_label' => __( 'Tab #1', 'gmart-core' ),
					],
					[
						'tab_label' => __( 'Tab #2', 'gmart-core' ),
					],
					[
						'tab_label' => __( 'Tab #3', 'gmart-core' ),
					],
				],
				'title_field' => '{{{ tab_label }}}',
			]
		);

		// Alignment
		$this->add_responsive_control(
			'tab_align',
			[
				'label'     => __( 'Alignment', 'gmart-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'gmart-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'gmart-core' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'gmart-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .dmt-dynamic-tabs-nav-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		// Spacing
		$this->add_responsive_control(
			'tab_spacing',
			[
				'label'      => __( 'Tabs Spacing', 'gmart-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} #dmt-dynamic-tabs.horizontal .dmt-dynamic-tabs-contents ' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Buttons


		// Tab Label Style
		// =========================
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Tab Label', 'gmart-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Spacing
		$this->add_responsive_control(
			'tab_label_spacing',
			[
				'label'      => __( 'Tabs Spacing', 'gmart-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} #dmt-dynamic-tabs.horizontal #dmt-dynamic-tabs-nav.style-one li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #dmt-dynamic-tabs.horizontal #dmt-dynamic-tabs-nav.style-two li:nth-child(-n+2)'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #dmt-dynamic-tabs.vertical #dmt-dynamic-tabs-nav li:not(:last-child)'             => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_icon_spacing',
			[
				'label'      => __( 'Icon Spacing', 'gmart-core' ),
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
					],
				],
				'selectors'  => [
					'{{WRAPPER}} #dmt-dynamic-tabs #dmt-dynamic-tabs-nav li .nav-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_label_typography',
				'label'    => __( 'Typography', 'gmart-core' ),
				'selector' => '{{WRAPPER}} #dmt-dynamic-tabs #dmt-dynamic-tabs-nav li a',
			]
		);

		// Padding
		$this->add_responsive_control(
			'tab_label_padding',
			[
				'label'      => __( 'Padding', 'gmart-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} #dmt-dynamic-tabs #dmt-dynamic-tabs-nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Normal
		$this->start_controls_tabs( 'tab_label_style_tabs' );

		// Normal
		$this->start_controls_tab( 'tab_label_style_normal_tab', [ 'label' => __( 'Normal', 'gmart-core' ) ] );

		$this->add_control(
			'tab_label_color',
			[
				'label'     => __( 'Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dmt-dynamic-tabs #dmt-dynamic-tabs-nav li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tab_label_bg_color',
			[
				'label'     => __( 'Background Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dmt-dynamic-tabs #dmt-dynamic-tabs-nav li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Hover

		$this->start_controls_tab( 'tab_label_style_hover_tab', [ 'label' => __( 'Hover', 'gmart-core' ) ] );

		$this->add_control(
			'tab_label_hover_color',
			[
				'label'     => __( 'Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dmt-dynamic-tabs #dmt-dynamic-tabs-nav li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tab_label_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dmt-dynamic-tabs #dmt-dynamic-tabs-nav li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Active
		$this->start_controls_tab( 'tab_label_style_active_tab', [ 'label' => __( 'Active', 'gmart-core' ) ] );

		$this->add_control(
			'tab_label_active_color',
			[
				'label'     => __( 'Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dmt-dynamic-tabs #dmt-dynamic-tabs-nav li.active a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tab-swipe-line'                                     => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tab_label_active_bg_color',
			[
				'label'     => __( 'Background Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dmt-dynamic-tabs #dmt-dynamic-tabs-nav li.active a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {

		$settings    = $this->get_settings();
		$advance_tab = isset( $settings['advance_tab'] ) ? $settings['advance_tab'] : '';

		// Tab Nav render attributes
		$this->add_render_attribute( 'tab_nav', 'class', 'dmt-dynamic-tabs-nav' );
		$this->add_render_attribute( 'tab_nav', 'id', 'dmt-dynamic-tabs-nav' );

		if ( ! empty( $settings['tab_style'] ) ) {
			$this->add_render_attribute( 'tab_nav', 'class', $settings['tab_style'] );
		}

		if ( $settings['tab_style'] == 'style-two' ) {
			$this->add_render_attribute( 'tab_nav', 'class', 'tab-swipe' );
		}

		// Tab Content render attributes
		$this->add_render_attribute( 'tab_wrapper', 'class', 'dmt-dynamic-tabs' );
		$this->add_render_attribute( 'tab_wrapper', 'id', 'dmt-dynamic-tabs' );

		if ( $settings['tab_layout'] == 'vertical' ) {
			$this->add_render_attribute( 'tab_wrapper', 'class', 'vertical' );
		}

		if ( $settings['tab_layout'] == 'horizontal' ) {
			$this->add_render_attribute( 'tab_wrapper', 'class', 'horizontal' );
		}

		?>


		<div <?php echo $this->get_render_attribute_string( 'tab_wrapper' ) ?>>
			<div class="dmt-dynamic-tabs-nav-wrapper">
			<ul <?php echo $this->get_render_attribute_string( 'tab_nav' ) ?>>
				<?php
				$id_int = 'dmt-tabs-id-' . substr( $this->get_id_int(), 0, 3 );
				foreach ( $advance_tab as $key => $tabitem ) : ?>
					<li class="elementor-repeater-item-<?php echo esc_attr( $tabitem['_id'] ); ?>">
						<a href="#<?php echo esc_attr( $id_int . '-' . $key ); ?>">

							<?php if ( $tabitem['tab_icon_type'] == 'icon' ) : ?>
								<?php if ( $tabitem['tab_icon_pack'] == 'font_awesome' ) : ?>
									<span class="nav-icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $tabitem['nav_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
								<?php else: ?>
									<span class="nav-icon">
                                       <?php if ( ! empty( $tabitem['tab_icon'] ) ) : ?>
										   <i class="<?php echo esc_attr( $tabitem['tab_icon'] ); ?>"></i>
                                       <?php endif; ?>
                                    </span>
								<?php endif; ?>
							<?php endif; ?>
							<span><?php echo esc_html( $tabitem['tab_label'] ); ?></span>

							<?php if ( ! empty( $tabitem['tab_badge_text']) ) : ?>
								<span class="tab-badge"><?php echo esc_html( $tabitem['tab_badge_text'] ); ?></span>
							<?php endif; ?>
						</a>
					</li>
				<?php endforeach; ?>

				<?php if ( $settings['tab_style'] == 'style-two' ) : ?>
					<li class="tab-swipe-line"></li>
				<?php endif; ?>
			</ul>
			</div>

			<div id="dmt-dynamic-tabs-content" class="dmt-dynamic-tabs-wrapper">
				<?php foreach ( $advance_tab as $key => $tabitem ) : ?>
					<div id="<?php echo esc_attr( $id_int . '-' . $key ); ?>" class="content">
						<div class="dmt-dynamic-tabs-contents">
							<?php if ( ! empty( $tabitem['template_id'] ) ) {
								$template_id      = $tabitem['template_id'];
								$template_content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
								echo $template_content;
							} ?>

						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<!-- dmt-dynamic-tabs-content -->
		</div>

		<?php
	}
}