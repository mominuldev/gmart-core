<?php
namespace GPTheme\GmartCore\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater
};

class TeamListBox extends Widget_Base {

	public function get_name() {
		return 'dmt-teamlist-box';
	}

	public function get_title() {
		return esc_html__( 'Team List Box', 'gmart-core' );
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

		$this->add_control( 'team-list_title', [
			'label'       => esc_html__( 'Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Title', 'gmart-core' ),
			'default'     => esc_html__( 'New Arrival 2022', 'gmart-core' ),
		] );


		$this->add_control( 'team-list_sub_title', [
			'label'       => esc_html__( 'Sub Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Project Completed', 'gmart-core' ),
			'label_block' => true,
			'placeholder' => esc_html__( 'Title', 'gmart-core' ),
		] );


		$this->add_control( 'list_info', [
			'label'       => esc_html__( 'List Info', 'gmart-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Team of Professional', 'gmart-core' ),
			'label_block' => true,
			'placeholder' => esc_html__( 'Description', 'gmart-core' ),
		] );

		// Team List
		$repeater = new Repeater();

		$repeater->add_control( 'team_avatar', [
			'label'   => esc_html__( 'Choose Image', 'gmart-core' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			],
		] );

		$repeater->add_control( 'name', [
			'label'       => esc_html__( 'Name', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Name', 'gmart-core' ),
		] );


		// Team List

		$this->add_control( 'team_list', [
			'label'       => esc_html__( 'Team List', 'gmart-core' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'name'        => esc_html__( 'John Doe', 'gmart-core' ),
					'team_avatar' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				],
				[
					'name'        => esc_html__( 'John Doe', 'gmart-core' ),
					'team_avatar' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				],
				[
					'name'        => esc_html__( 'John Doe', 'gmart-core' ),
					'team_avatar' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				],

				[
					'name'        => esc_html__( 'John Doe', 'gmart-core' ),
					'team_avatar' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				],

				[
					'name'        => esc_html__( 'John Doe', 'gmart-core' ),
					'team_avatar' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				],
			],
			'title_field' => '{{{ name }}}',
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
				'{{WRAPPER}} .dmt-team-list' => '{{VALUE}}',
			],
			'selectors_dictionary' => [
				'left'   => 'justify-content: start',
				'center' => 'justify-content: center',
				'right'  => 'justify-content: end',
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
				'{{WRAPPER}} .dmt-team-list' => 'align-items: {{VALUE}}',
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
				'{{WRAPPER}} .dmt-team-list' => 'text-align: {{VALUE}};'
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
				'{{WRAPPER}} .dmt-team-list .dmt-team-list__title' => 'color: {{VALUE}};'
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .dmt-team-list .dmt-team-list__title',
		] );

		$this->end_controls_section();

		//Subtitle Style Section
		$this->start_controls_section( 'section_subtitle_style', [
			'label' => esc_html__( 'Sub Title', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'subtitle_color', [
			'label'     => esc_html__( 'color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dmt-team-list .dmt-team-list__subtitle' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'team-list_subtitle_typography',
			'selector' => '{{WRAPPER}} .dmt-team-list .dmt-team-list__subtitle',
		] );

		$this->end_controls_section();

		//Info Style Section
		$this->start_controls_section( 'section_info_style', [
			'label' => esc_html__( 'Info', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'info_color', [
			'label'     => esc_html__( 'color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dmt-team-list .dmt-team-list__list-info' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'team-list_info_typography',
			'selector' => '{{WRAPPER}} .dmt-team-list .dmt-team-list__list-info',
		] );

		$this->end_controls_section();

		//Background Style
		$this->start_controls_section( 'section_team-list_style', [
			'label' => esc_html__( 'Promo Box Wrapper', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
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
					'{{WRAPPER}} .dmt-team-list' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'service_bg_color',
				'label'    => esc_html__( 'Background', 'plugin-name' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .dmt-team-list',
			]
		);

		$this->add_control( 'service_border_color', [
			'label'     => esc_html__( 'Border Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .dmt-team-list' => 'border-color: {{VALUE}};'
			],
		] );

		$this->add_responsive_control( 'box_padding', [
			'label'      => __( 'Padding', 'gmart-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dmt-team-list:not(.style_one), {{WRAPPER}} .dmt-team-list.style_one .dmt-team-list__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'box_margin', [
			'label'      => __( 'Margin', 'gmart-core' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .dmt-team-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
//		$layout   = $settings['layout'];
//		$target   = $settings['team-list_title_link']['is_external'] ? ' target="_blank"' : '';
//		$nofollow = $settings['team-list_title_link']['nofollow'] ? ' rel="nofollow"' : '';

//		if ( $layout != '4' ) {
//			$btn_target   = $settings['team-list_link']['is_external'] ? ' target="_blank"' : '';
//			$btn_nofollow = $settings['team-list_link']['nofollow'] ? ' rel="nofollow"' : '';
//		}

//		require __DIR__ . '/templates/team-list/layout-'.$layout.'.php';


		?>

		<div class="dmt-team-list">
			<div class="dmt-team-list__content">

				<?php if ( ! empty( $settings['team-list_title'] ) ) : ?>
					<h3 class="dmt-team-list__title"><?php echo $settings['team-list_title']; ?></h3>
				<?php endif; ?>

				<?php if ( ! empty( $settings['team-list_sub_title'] ) ) : ?>
					<h3 class="dmt-team-list__subtitle"><?php echo $settings['team-list_sub_title']; ?></h3>
				<?php endif; ?>

			</div>
			<!-- /.dmt-team-list__content -->

			<div class="dmt-team-list__content-bottom">
				<?php if ( ! empty( $settings['list_info'] ) ) : ?>
					<p class="dmt-team-list__list-info"><?php echo $settings['list_info'] ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $settings['team_list'] ) ) : ?>
					<ul class="dmt-team-list__list">
						<?php foreach ( $settings['team_list'] as $item ) : ?>
							<li class="dmt-team-list__list-item">
								<?php if ( ! empty( $item['team_avatar']['url'] ) ) : ?>
									<div class="dmt-team-list__list-image">
										<img src="<?php echo esc_url( $item['team_avatar']['url'] ); ?>"
											 alt="<?php echo esc_attr( $item['name'] ); ?>" title="<?php echo esc_attr( $item['name'] ); ?>"
											 width="50" height="50">
									</div>
								<?php endif; ?>
							</li>

						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>

		</div>
		<!-- /.dmt-team-list -->

		<?php
	}
}




