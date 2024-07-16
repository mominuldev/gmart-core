<?php

namespace GPTheme\GmartCore\Widgets;

use Elementor\{Controls_Manager,
	Widget_Base,
	Group_Control_Typography,
	Repeater
};

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class FeatureList extends Widget_Base
{

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name()
	{
		return 'dmt-feature-list';
	}


	public function get_title()
	{
		return __('Feature List', 'gmart-core');
	}

	public function get_icon()
	{

		return 'eicon-text';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories()
	{
		return ['dmt-elements'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'feature_content',
			[
				'label' => __('Feature', 'gmart-core'),
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			[
				'label'   => esc_html__('Icon', 'gmart-core'),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				]
			]
		);


		$repeater->add_control(
			'feature_title', [
				'label'       => __('Title', 'gmart-core'),
				'type'        => Controls_Manager::TEXT,
				'plaseholder' => __('Title', 'gmart-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'description', [
				'label'       => __('Description', 'gmart-core'),
				'type'        => Controls_Manager::TEXTAREA,
				'plaseholder' => __('Description', 'gmart-core'),
				'label_block' => true,
			]
		);


		$this->add_control(
			'feature_lists',
			[
				'label'       => __('Feature List', 'gmart-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'feature_title'     => __("Marketing & Reporting", "gmart-core"),
						'description' => __("In today's data-driven world, effective marketing.. ", "gmart-core"),
					],
					[
						'feature_title'     => __("Creative Design", "gmart-core"),
						'description' => __("Creative design is instrumental in creating a strong..", "gmart-core"),
					],
					[
						'feature_title'     => __("SEO Friendly", "gmart-core"),
						'description' => __("Optimizing your online content for search engines..", "gmart-core"),
					],
					[
						'feature_title'     => __("24/7 Support", "gmart-core"),
						'description' => __("By offering 24/7 support, businesses can address...", "gmart-core"),
					],
				],
				'title_field' => '{{{ feature_title }}}',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __('Title', 'gmart-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'feature_color',
			[
				'label'     => __('Color', 'gmart-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-feature__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'feature_typography',
				'label'    => __('Typography', 'gmart-core'),
				'selector' => '{{WRAPPER}} .dmt-feature__title',
			]
		);

		// Space
		$this->add_responsive_control(
			'feature_space',
			[
				'label'      => __('Space', 'gmart-core'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dmt-feature__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'description_style_section',
			[
				'label' => __('Description', 'gmart-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ans_color',
			[
				'label'     => __('Color', 'gmart-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-feature__content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'ans_typography',
				'label'    => __('Typography', 'gmart-core'),
				'selector' => '{{WRAPPER}} .dmt-feature__content',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'feature_style_section',
			[
				'label' => __('Feature Container', 'gmart-core'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'feature_margin',
			[
				'label'      => __('Margin', 'gmart-core'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .dmt-feature__item:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'feature_padding',
			[
				'label'      => __('Padding', 'gmart-core'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .dmt-feature__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'feature_bg_color',
			[
				'label'     => __('Background Color', 'gmart-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-feature__item' => 'background-color: {{VALUE}}',
				],
			]
		);

		// Hover Background Color
		$this->add_control(
			'feature_hover_bg_color',
			[
				'label'     => __('Hover Background Color', 'gmart-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-feature__item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'feature_icon_color',
			[
				'label'     => __('Icon Color', 'gmart-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-feature__item .dmt-feature__icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .dmt-feature__item .dmt-feature__icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		// Hover Icon Color
		$this->add_control(
			'feature_hover_icon_color',
			[
				'label'     => __('Hover Icon Color', 'gmart-core'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dmt-feature__item:hover .dmt-feature__icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .dmt-feature__item:hover .dmt-feature__icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'feature_border',
				'label'    => __('Border', 'gmart-core'),
				'selector' => '{{WRAPPER}} .dmt-feature__item',
			]
		);

		$this->add_responsive_control(
			'feature_border_radius',
			[
				'label'      => __('Border Radius', 'gmart-core'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .dmt-feature__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'feature_box_shadow',
				'selector' => '{{WRAPPER}} .dmt-feature__item',
			]
		);

		$this->end_controls_section();

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();


		if ($settings['feature_lists']) { ?>
			<div class="dmt-feature">
				<?php foreach ($settings['feature_lists'] as $item) { ?>
					<div class="dmt-feature__item">
						<?php if (!empty($item['icon'])) : ?>
							<div class="dmt-feature__icon">
								<?php \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']); ?>
							</div>
						<?php endif; ?>

						<div class="dmt-feature__content">
							<?php if (!empty($item['feature_title'])) : ?>
								<h4 class="dmt-feature__title"><?php echo $item['feature_title']; ?></h4>
							<?php endif; ?>

							<?php if (!empty($item['description'])) : ?>
								<p class="dmt-feature__content"><?php echo $item['description']; ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php } ?>
			</div>
			<!-- /.dmt-feature -->
			<?php

		}
	}
}

