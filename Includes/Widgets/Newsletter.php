<?php

namespace GPTheme\GmartCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\{Group_Control_Box_Shadow,
	Widget_Base,
	Controls_Manager,
	Group_Control_Typography,
	Group_Control_Border,
	Group_Control_Background};


class Newsletter extends Widget_Base {

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
	public function get_name() {
		return 'dmt-newsletter';
	}


	public function get_title() {
		return __( 'Dmt Newsletter', 'gmart-core' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-mailchimp';
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
		return [ 'dmt-elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => __( 'Newsletter', 'gmart-core' ),
		] );

		// Layout
		$this->add_control( 'layout', [
			'label'   => __( 'Layout', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one' => __( 'Layout One', 'gmart-core' ),
				'two'  => __( 'Layout Two', 'gmart-core' ),
				'three'  => __( 'Layout Three', 'gmart-core' ),
			],
		] );

		$this->add_control( 'button_view', [
			'label'   => __( 'Button View', 'gmart-core' ),
			'type'    => Controls_Manager::CHOOSE,
			'default' => 'traditional',
			'options' => [
				'traditional' => [
					'title' => __( 'Default', 'gmart-core' ),
					'icon'  => 'eicon-ellipsis-h',
				],
				'block'      => [
					'title' => __( 'Block', 'gmart-core' ),
					'icon'  => 'eicon-editor-list-ul'
				],
			],
		] );

		$this->add_control( 'name_placeholder', [
			'label'       => esc_html__( 'Name Placeholder', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Enter your name', 'gmart-core' ),
			'label_block' => true,
			'condition' => [
				'layout' => 'two',
			],
		] );

		$this->add_control( 'input_placeholder', [
			'label'       => esc_html__( 'Email Placeholder', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Enter your email', 'gmart-core' ),
			'label_block' => true,
		] );

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Spacing', 'gmart-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner.btn-inline .input-inner' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .newsletter-form .newsletter-inner.btn-block .input-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control( 'button_type', [
			'label'   => esc_html__( 'Button Type', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'text',
			'options' => [
				'icon'  => esc_html__( 'Icon', 'gmart-core' ),
				'text'  => esc_html__( 'Text', 'gmart-core' ),
			],
		] );

		$this->add_control( 'subscribe_text', [
			'label'       => esc_html__( 'Button Text', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __( 'Subscribe', 'gmart-core' ),
			'condition'   => [
				'button_type' => 'text',
			],
		] );

		$this->add_control( 'subscribe_icon', [
			'label'     => esc_html__( 'Button Icon', 'gmart-core' ),
			'type' => \Elementor\Controls_Manager::ICONS,
			'default' => [
				'value' => 'far fa-paper-plane',
				'library' => 'fa-regular',
			],
			'condition' => [
				'button_type' => 'icon',
			],
		] );

		$this->add_control(
			'button_switch',
			[
				'label' => esc_html__( 'Button Icon Show/Hide', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'button_type' => 'text'
				],
			]
		);

		$this->add_control( 'selected_icon', [
			'label'     => __( 'Icon', 'gmart-core' ),
			'type'      => Controls_Manager::ICONS,
			'default'   => [
				'value'   => 'fas fa-arrow-right',
				'library' => 'solid',
			],
			'condition' => [
				'button_type' => 'text',
				'button_switch' => 'yes'
			],
		] );

		$this->add_control(
			'icon_align',
			[
				'label' => __('Icon Position', 'gmart-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left' => __('Before', 'gmart-core'),
					'right' => __('After', 'gmart-core'),
				],
				'condition' => [
					'selected_icon!' => '',
					'button_type' => 'text',
					'button_switch' => 'yes'
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => __('Icon Spacing', 'gmart-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'selected_icon!' => '',
					'button_type' => 'text',
					'button_switch' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .dmt-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dmt-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Newsletter Form alignment
		$this->add_responsive_control(
			'newsletter_position',
			[
				'label' => esc_html__( 'Alignment', 'gmart-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'gmart-core' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'gmart-core' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'gmart-core' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'start',
				'selectors' => [
					'{{WRAPPER}} .dmt-newsletter' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		// Style Section
		//======================

		$this->start_controls_section( 'section_style_field', [
			'label' => __( 'Email Field', 'gmart-core' ),
			'tab' => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
			'field_color',
			[
				'label' => __('Color', 'gmart-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'field_bg_color',
			[
				'label' => __('Background', 'gmart-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Paceholder Color
		$this->add_control(
			'placeholder_color',
			[
				'label' => __('Placeholder Color', 'gmart-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])::placeholder' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'label' => __('Typography', 'gmart-core'),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_field',
				'label' => __('Border', 'gmart-core'),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_field_shadow',
				'label' => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit])',
			]
		);

		$this->add_control(
			'field_bg_color_focus',
			[
				'label' => __('Focus Background', 'gmart-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit]):focus' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before'
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_field_focus',
				'label' => __('Focus Border', 'gmart-core'),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit]):focus'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_field_shadow_focus',
				'label' => __( 'Focus Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .newsletter-form input:not([type=checkbox]):not([type=submit]):focus',
			]
		);

		// Input Height
		$this->add_control(
			'input_height',
			[
				'label' => __('Input Height', 'gmart-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form input:not([type=checkbox]), {{WRAPPER}} .newsletter-form .newsletter-submit' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Button', 'gmart-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => __('Typography', 'gmart-core'),
				'selector' => '{{WRAPPER}} .dmt-btn',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __('Border Radius', 'gmart-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} a.dmt-btn, {{WRAPPER}} .dmt-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'text_padding',
			[
				'label' => __('Padding', 'gmart-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} a.dmt-btn, {{WRAPPER}} .dmt-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		// Button Min Width
		$this->add_responsive_control(
			'button_min_width',
			[
				'label' => __('Min Width', 'gmart-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 80,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} a.dmt-btn, {{WRAPPER}} .dmt-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __('Normal', 'gmart-core'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __('Color', 'gmart-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.dmt-btn, {{WRAPPER}} .dmt-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __('Background Color', 'gmart-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __('Border', 'gmart-core'),
				'selector' => '{{WRAPPER}} .dmt-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __('Hover', 'gmart-core'),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => __('Color', 'gmart-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label' => __('Background Color', 'gmart-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_hover',
				'label' => __('Border', 'gmart-core'),
				'selector' => '{{WRAPPER}} .dmt-btn:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .dmt-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_wrapper_style',
			[
				'label' => __('Wrapper', 'gmart-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'wrapper_bg_color',
			[
				'label' => __('Background Color', 'gmart-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wrapper_border',
				'label' => __('Border', 'gmart-core'),
				'selector' => '{{WRAPPER}} .newsletter-form .newsletter-inner',
			]
		);

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrapper_box_shadow',
				'label' => __( 'Box Shadow', 'gmart-core' ),
				'selector' => '{{WRAPPER}} .newsletter-form .newsletter-inner',
			]
		);

		// Border Radius
		$this->add_responsive_control(
			'wrapper_border_radius',
			[
				'label' => __('Border Radius', 'gmart-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_control(
			'wrapper_padding',
			[
				'label' => __('Padding', 'gmart-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .newsletter-form .newsletter-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$this->add_render_attribute('icon-align', 'class', 'elementor-align-icon-' . $settings['icon_align']);
		$this->add_render_attribute('icon-align', 'class', 'dmt-btn-icon');

		// Add Inner form wrapper class
		if( $settings['button_view'] == 'traditional'  ) {
			$this->add_render_attribute('form-inner', 'class', 'newsletter-inner btn-inline justify-content-center');
		} else {
			$this->add_render_attribute('form-inner', 'class', 'newsletter-inner btn-block');
		}

		$this->add_render_attribute('form', 'method', 'post');
		$this->add_render_attribute('form', 'action', admin_url( 'admin-ajax.php' ));
		$this->add_render_attribute('form', 'class', 'newsletter-form');

		// Add Inner form wrapper class
		if( $settings['layout']  ) {
			$this->add_render_attribute('form-inner', 'class', 'style-' . $settings['layout'] );
		}

		// Newsletter position
//		if ( $settings['newsletter_position'] == 'right' ) {
//			$this->add_render_attribute( 'form-inner', 'class', 'position-right' );
//		} elseif ( $settings['newsletter_position'] == 'center' ) {
//			$this->add_render_attribute( 'form-inner', 'class', 'position-center' );
//		} else {
//			$this->add_render_attribute( 'form-inner', 'class', 'position-left' );
//		}

//		if($settings['show_input_icon'] == 'yes' ) {
//			$this->add_render_attribute('form-inner', 'class', 'show_before_icon');
//		}

		// Form action
		$this->add_render_attribute('form', 'data-dmt-form', 'newsletter-subscribe');
		?>

		<div class="dmt-newsletter">
			<form <?php echo $this->get_render_attribute_string('form') ?> >
				<?php
					$nonce = wp_create_nonce( 'dmt_mailchimp_subscribe' );
				?>
				<input type="hidden" name="action" value="dmt_mailchimp_subscribe" class="dmt-newsletter-security" data-security="<?php echo esc_attr($nonce); ?>">
				<div <?php echo $this->get_render_attribute_string('form-inner'); ?> >
					<div class="input-inner">
						<?php if( $settings['layout'] == 'two' ) : ?>
							<input type="text" name="fname" class="form-control"  placeholder="<?php echo esc_attr( $settings['name_placeholder'] ); ?>" required>
						<?php endif; ?>
						<input type="email" name="email" class="form-control"  placeholder="<?php echo esc_attr( $settings['input_placeholder'] ); ?>" required>
					</div>
					<button type="submit" name="submit" class="newsletter-submit dmt-btn">
						<?php if( $settings['button_type'] == 'text' ) : ?>
							<span class="dmt-btn-text"><?php echo esc_html( $settings['subscribe_text'] ); ?></span>
							<?php if (!empty($settings['selected_icon']) && $settings['button_switch'] == 'yes' ) : ?>
								<span <?php echo $this->get_render_attribute_string('icon-align'); ?>>
                                    <?php if ( ! empty( $settings['selected_icon'] ) ) : ?>
	                                    <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php endif; ?>
                                </span>
							<?php endif; ?>
						<?php else : ?>
							<?php \Elementor\Icons_Manager::render_icon( $settings['subscribe_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php endif; ?>
						<i class="fa fa-circle-o-notch fa-spin"></i>
					</button>
				</div>
				<div class="form-result alert">
					<div class="content"></div>
				</div><!-- /.form-result-->
			</form><!-- /.newsletter-form -->
		</div>
		<!-- /.newsletter -->
		<?php
	}
}
