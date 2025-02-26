<?php

namespace GPTheme\GmartCore\Widgets;

use Elementor\{
	Controls_Manager,
	Group_Control_Background,
	Group_Control_Typography,
	Utils,
	Widget_Base
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


/**
 * Class Heading
 *
 * @package GPTheme\GmartCore\Widgets
 */

class Heading extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'dmt-heading';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Dmt Heading', 'gmart-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-heading';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Heading widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'dmt-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Heading widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'heading', 'title', 'sub-title' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'heading', GMART_PLUGIN_URL . 'assets/js/heading.js', [ 'elementor-frontend' ], '1.0.0', true );

		return [ 'heading' ];
	}

	/**
	 * Register Heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function register_controls() {

		// Heading Content Section
		//==========================
		$this->start_controls_section( 'section_tab', [
			'label' => esc_html__( 'Heading', 'gmart-core' ),
		] );

		// Style
		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one' => esc_html__( 'Style 1', 'gmart-core' ),
				'two' => esc_html__( 'Style 2', 'gmart-core' ),
			]
		] );


		$this->add_control( 'sub_title', [
			'label'       => esc_html__( 'Sub Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'placeholder' => esc_html__( 'Sub Title', 'gmart-core' ),
			'default'     => 'Sub Title',
			'separator'   => 'none',
		] );

		$this->add_control( 'title_text', [
			'label'       => esc_html__( 'Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'rows'        => 2,
			'placeholder' => esc_html__( 'Title', 'gmart-core' ),
			'default'     => esc_html__( 'Section Title', 'gmart-core' ),
		] );


		// Secondary Title Enable
		$this->add_control( 'secondary_title_enable', [
			'label'        => __( 'Secondary Title Enable', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'gmart-core' ),
			'label_off'    => __( 'No', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		// Secondary Title
		$this->add_control( 'secondary_title', [
			'label'       => esc_html__( 'Secondary Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'rows'        => 2,
			'placeholder' => esc_html__( 'Secondary Title', 'gmart-core' ),
			'default'     => esc_html__( 'Secondary Title', 'gmart-core' ),
			'condition'   => [
				'secondary_title_enable' => 'yes'
			]
		] );

		$this->add_control( 'title_size', [
			'label'   => __( 'Title HTML Tag', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'h1'   => 'H1',
				'h2'   => 'H2',
				'h3'   => 'H3',
				'h4'   => 'H4',
				'h5'   => 'H5',
				'h6'   => 'H6',
				'div'  => 'div',
				'span' => 'span',
				'p'    => 'p',
			],
			'default' => 'h2',
		] );


		$this->add_control( 'description_text', [
			'label'       => __( 'Description', 'gmart-core' ),
			'type'        => Controls_Manager::WYSIWYG,
			'placeholder' => __( 'Type your description here', 'gmart-core' ),
			'separator'   => 'before'
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
			'default'   => 'center',
			'selectors' => [
				'{{WRAPPER}} .section-heading' => 'text-align: {{VALUE}};'
			],
		] );

		$this->add_responsive_control( 'heading_spacing_div', [
			'label'     => __( 'Spacing', 'gmart-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => - 20,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .section-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Heading Effects
		//=========================
		$this->start_controls_section( 'section_heading_effect', [
			'label' => esc_html__( 'Heading Effects', 'gmart-core' ),
		] );

		// Enable Splitting Effects
		$this->add_control( 'enable_splitting', [
			'label'        => __( 'Enable Splitting', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'gmart-core' ),
			'label_off'    => __( 'No', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		// Effect Style
		$this->add_control( 'effect_style', [
			'label'     => __( 'Effect Style', 'gmart-core' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'one'   => 'One',
				'two'   => 'Two',
				'three' => 'Three',
				'four'  => 'Four',
			],
			'default'   => 'one',
			'condition' => [
				'enable_splitting' => 'yes'
			]
		] );

		// Splitting Effects Type
		$this->add_control( 'splitting_type', [
			'label'   => __( 'Splitting Type', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'chars' => 'Chars',
				'words' => 'Words',
				'lines' => 'Lines',
			],
			'default' => 'lines',
			'condition' => [
				'enable_splitting' => 'yes'
			]
		] );

		//Animation Duration
		$this->add_control( 'title_animation_time', [
			'label'     => __( 'Animation Duration', 'gmart-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 1,
			'min'       => 0.1,
			'max'       => 10,
			'step'      => 0.1,
			'condition' => [
				'enable_splitting' => 'yes'
			]
		] );

		$this->end_controls_section();


		// Description Effects
		//=========================
		$this->start_controls_section( 'section_description_effect', [
			'label' => esc_html__( 'Description Effects', 'gmart-core' ),
		] );

		// Enable Splitting Effects
		$this->add_control( 'des_enable_splitting', [
			'label'        => __( 'Enable Splitting', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'gmart-core' ),
			'label_off'    => __( 'No', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		// Effect Style
		$this->add_control( 'des_effect_style', [
			'label'     => __( 'Effect Style', 'gmart-core' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'one'   => 'One',
				'two'   => 'Two',
				'three' => 'Three',
				'four'  => 'Four',
			],
			'default'   => 'one',
			'condition' => [
				'des_enable_splitting' => 'yes'
			]
		] );

		// Splitting Effects Type
		$this->add_control( 'des_splitting_type', [
			'label'   => __( 'Splitting Type', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'chars' => 'Chars',
				'words' => 'Words',
				'lines' => 'Lines',
			],
			'default' => 'lines',
			'condition' => [
				'des_enable_splitting' => 'yes'
			]
		] );



		// Animation Delay Delay
		$this->add_control( 'animation_delay', [
			'label'     => __( 'Animation Delay', 'gmart-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 0.1,
			'min'       => 0.1,
			'max'       => 10,
			'step'      => 0.1,
			'condition' => [
				'des_enable_splitting' => 'yes'
			]
		] );

		//Animation Duration
		$this->add_control( 'animation_time', [
			'label'     => __( 'Animation Duration', 'gmart-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 1,
			'min'       => 0.1,
			'max'       => 10,
			'step'      => 0.1,
			'condition' => [
				'des_enable_splitting' => 'yes'
			]
		] );


		$this->end_controls_section();


		//Title Style Section
		//=========================
		$this->start_controls_section( 'section_title_style', [
			'label' => esc_html__( 'Title', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color_one', [
			'label'     => esc_html__( 'Title color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .section-title' => 'color: {{VALUE}};'
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .section-heading .section-title',
		] );

        // Highlight Color
        $this->add_control( 'title_highlight_color', [
            'label'     => esc_html__( 'Highlight color', 'gmart-core' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .section-heading .section-title span' => 'color: {{VALUE}};'
            ],
            'separator' => 'before'
        ] );

        // Highlight Typography
        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'title_highlight_typography',
            'selector' => '{{WRAPPER}} .section-heading .section-title span',

        ] );

		$this->add_responsive_control( 'space_between_title', [
			'label'     => __( 'Spacing Title', 'gmart-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => - 20,
					'max' => 150,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .section-heading .section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
            'separator' => 'before'
		] );

		$this->end_controls_section();

		// Secondary Title Style Section
		//=========================
		$this->start_controls_section( 'section_secondary_title_style', [
			'label'     => esc_html__( 'Secondary Title', 'gmart-core' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'secondary_title_enable' => 'yes'
			]
		] );

		$this->add_control( 'title_color_two', [
			'label'     => esc_html__( 'Secondary Title color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .section-title-secondary' => 'color: {{VALUE}};'
			],
			'condition' => [
				'secondary_title_enable' => 'yes'
			]
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'secondary_title_typography',
			'selector'  => '{{WRAPPER}} .section-heading .section-title-secondary',
			'condition' => [
				'secondary_title_enable' => 'yes'
			]
		] );

		// Space Between
		$this->add_responsive_control( 'space_between_two', [
			'label'     => __( 'Spacing', 'gmart-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => - 20,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .section-heading .section-title-secondary' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'secondary_title_enable' => 'yes'
			]
		] );

		$this->end_controls_section();


		//Subtitle Style Section
		$this->start_controls_section( 'section_subtitle_style', [
			'label' => esc_html__( 'Sub Title', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->add_control( 'heading_color_type', array(
			'label'        => __( 'Color Type', 'gmart-core' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => array(
				'color'    => __( 'Color', 'gmart-core' ),
				'gradient' => __( 'Background', 'gmart-core' ),
			),
			'default'      => 'color',
			'prefix_class' => 'dmt-heading-fill-',
		) );

		$this->add_control( 'subtitle_color', [
			'label'     => esc_html__( 'Color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle' => 'color: {{VALUE}};',
			],
			'condition' => array(
				'heading_color_type' => 'color',
			),
		] );

		$this->add_group_control( Group_Control_Background::get_type(), array(
			'name'      => 'heading_color_gradient',
			'types'     => array(
				'gradient',
				'classic'
			),
			'selector'  => '{{WRAPPER}} .section-heading .subtitle',
			'condition' => array(
				'heading_color_type' => 'gradient',
			),
		) );

		$this->add_control( 'subtitle_bg_color', [
			'label'     => esc_html__( 'Sub Title BG color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle' => 'background-color: {{VALUE}};'
			],
		] );

		// Background

		$this->add_control( 'subtitle_bg', [
			'label'     => esc_html__( 'BG color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle' => 'background: {{VALUE}};'
			],
			'condition' => [
				'style'              => 'two',
			],
		] );

		// Border color
		$this->add_control( 'subtitle_border_color', [
			'label'     => esc_html__( 'Border color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle' => 'border-color: {{VALUE}};'
			],
			'condition' => [
				'style'              => 'two',
			],
		] );

		// Circle BG Color
		$this->add_control( 'circle_bg_color', [
			'label'     => esc_html__( 'Circle BG color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle:before, {{WRAPPER}} .section-heading .subtitle:after' => 'background: {{VALUE}};'
			],
			'condition' => [
				'style'              => 'two',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'subtitle_typography',
			'selector' => '{{WRAPPER}} .section-heading .subtitle',
		] );

		$this->add_responsive_control( 'space_between_subtitle', [
			'label'     => __( 'Spacing Sub Title', 'gmart-core' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => - 0,
					'max' => 100,
				],
			],
			'devices'   => [
				'desktop',
				'tablet',
				'mobile'
			],
			'selectors' => [
				'{{WRAPPER}} .section-heading .subtitle, {{WRAPPER}} .section-subhead .subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
			'separator' => 'after'
		] );


		$this->end_controls_section();

		//Description Style Section
		$this->start_controls_section( 'section_des_style', [
			'label' => esc_html__( 'Description', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->add_control( 'des_color', [
			'label'     => esc_html__( 'color', 'gmart-core' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .section-heading .description, {{WRAPPER}} .section-heading .description p' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'des_typography',
			'selector' => '{{WRAPPER}} .section-heading .description',
		] );


		$this->end_controls_section();

	}

	/**
	 * Render section heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$title            = $settings['title_text'];
		$secondary_title  = $settings['secondary_title'];
		$sub_title        = $settings['sub_title'];
		$description_text = $settings['description_text'];

		// Wrapper Classes
		$this->add_render_attribute( 'wrapper', 'class', 'section-heading' );

		// Style
		if( !empty( $settings['style'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'heading-style--' . $settings['style'] );
		}

		$this->add_render_attribute( 'title_text', [
			'class' => 'section-title'
		] );

		// Title Text Data Attributes date-set-bg
		$this->add_render_attribute( 'title_text', [
			'data-bg-color' => '#dedede'
		] );

		$this->add_render_attribute( 'title_text', [
			'data-fg-color' => '#000'
		] );


		if( !empty( $settings['splitting_type'] ) ) {
			$this->add_render_attribute( 'title_text', 'data-animate-type', $settings['splitting_type'] );
		}

		if( !empty( $settings['effect_style'] ) ) {
			$this->add_render_attribute( 'title_text', 'data-animate-style', $settings['effect_style'] );
		}

		// Animation Duration
		if( !empty( $settings['title_animation_time'] ) ) {
			$this->add_render_attribute( 'title_text', 'data-animate-duration', $settings['title_animation_time'] );
		}

		if ( $settings['enable_splitting'] == 'yes' ) {
			$this->add_render_attribute( 'title_text', [
				'class'             => 'anime-title'
			] );

			$this->add_render_attribute( 'secondary_title_text', [
				'class' => 'anime-title'
			] );

			$this->add_render_attribute( 'sub_title', 'class', 'anime-subtitle' );
		}


		if ( $settings['secondary_title_enable'] == 'yes' ) {
			$this->add_render_attribute( 'title_text', [
				'class' => 'has-secondary-title'
			] );
		}

		$this->add_render_attribute( 'secondary_title_text', [
			'class' => 'section-title-secondary'
		] );

		$this->add_render_attribute( 'sub_title', 'class', 'subtitle' );

		$this->add_inline_editing_attributes( 'title_text' );
		$this->add_inline_editing_attributes( 'secondary_title' );
		$this->add_inline_editing_attributes( 'sub_title' );


		$this->add_render_attribute( 'description_text', [
			'class' => 'description',
		] );
		$this->add_inline_editing_attributes( 'description_text' );

		if ( $settings['des_enable_splitting'] == 'yes' ) {
			$this->add_render_attribute( 'description_text','class','anime-text' );
		}

		if( !empty( $settings['des_splitting_type'] ) ) {
			$this->add_render_attribute( 'description_text', 'data-animate-type', $settings['des_splitting_type'] );
		}

		if( !empty( $settings['des_effect_style'] ) ) {
			$this->add_render_attribute( 'description_text', 'data-animate-style', $settings['des_effect_style'] );
		}
		if( !empty( $settings['animation_time'] ) ) {
			$this->add_render_attribute( 'description_text', 'data-animate-duration', $settings['animation_time'] );
		}

		// Delay
		if( !empty( $settings['animation_delay'] ) ) {
			$this->add_render_attribute( 'description_text', 'data-animate-delay', $settings['animation_delay'] );
		}

		?>

		<div <?php echo $this->get_render_attribute_string('wrapper')?>>
			<?php if ( ! empty( $sub_title ) ): ?>
				<h3 <?php echo $this->get_render_attribute_string( 'sub_title' ); ?>><?php echo $sub_title; ?></h3>
			<?php endif; ?>

			<?php if ( ! empty( $title ) ) {
				$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['title_size'] ), $this->get_render_attribute_string( 'title_text' ), $title );
				echo $title_html;
			} ?>

			<?php if ( ! empty( $secondary_title ) && $settings['secondary_title_enable'] == 'yes' ) {
				$secondary_title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['title_size'] ), $this->get_render_attribute_string( 'secondary_title_text' ), $secondary_title );
				echo $secondary_title_html;
			} ?>

			<?php if ( ! empty( $description_text ) ): ?>
				<div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $description_text; ?></div>
			<?php endif; ?>
		</div>

		<?php
	}

	/**
	 * Render section heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() { ?>
		<#
		view.addRenderAttribute( 'wrapper', 'class', 'section-heading' );


		if( settings.style ){
			view.addRenderAttribute( 'wrapper', 'class', 'heading-style--' + settings.style );
		}

		if( settings.splitting_type ) {
		view.addRenderAttribute( 'title_text', 'data-animate-type', settings.splitting_type );
		}

		if( settings.effect_style ) {
		view.addRenderAttribute( 'title_text', 'data-animate-style', settings.effect_style );
		}

		if( settings.title_animation_time ) {
		view.addRenderAttribute( 'title_text', 'data-animate-duration', settings.title_animation_time );
		}

		if( settings.des_splitting_type ) {
		view.addRenderAttribute( 'description_text', 'data-animate-type', settings.des_splitting_type );
		}

		if( settings.des_effect_style ) {
		view.addRenderAttribute( 'description_text', 'data-animate-style', settings.des_effect_style );
		}

		if( settings.animation_time ) {
		view.addRenderAttribute( 'description_text', 'data-animate-duration', settings.animation_time );
		}

		if( settings.animation_delay ) {
		view.addRenderAttribute( 'description_text', 'data-animate-delay', settings.animation_delay );
		}

		if ( settings.enable_splitting == 'yes') {
		view.addRenderAttribute( 'sub_title', 'class', 'anime-subtitle' );
		view.addRenderAttribute( 'title_text', 'class', 'anime-title' );

		}

		if ( settings.des_enable_splitting == 'yes') {
		view.addRenderAttribute( 'description_text', 'class', 'anime-text' );
		}

		view.addRenderAttribute( 'title_text', 'class', 'section-title' );
		view.addInlineEditingAttributes( 'title_text', 'none' );

		if( settings.secondary_title_enable == 'yes' ){
		view.addRenderAttribute( 'title_text', 'class', 'has-secondary-title' );
		}


		view.addRenderAttribute( 'secondary_title_text', 'class', 'section-title-secondary' );
		view.addInlineEditingAttributes( 'secondary_title_text', 'none' );

		view.addRenderAttribute( 'description_text', 'class', 'description' );
		view.addInlineEditingAttributes( 'description_text', 'none' );

		view.addRenderAttribute( 'sub_title', 'class', 'subtitle' );
		view.addInlineEditingAttributes( 'sub_title', 'none' );

		#>
		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
			<# if(settings.sub_title) { #>
			<h3 {{{ view.getRenderAttributeString( 'sub_title' ) }}}>{{{ settings.sub_title }}}</h3>
			<# } #>

			<#
			var title = settings.title_text;
			var headerSizeTag = elementor.helpers.validateHTMLTag( settings.title_size );
			var title_html = '<' + headerSizeTag + ' ' + view.getRenderAttributeString( 'title_text' ) + '>' + title + '</' + headerSizeTag + '>';

		var sec_title = settings.secondary_title;
		var headerSizeTag = elementor.helpers.validateHTMLTag( settings.title_size );
		var sec_title_html = '<' + headerSizeTag  + ' ' + view.getRenderAttributeString( 'secondary_title_text' ) + '>' + sec_title + '</' + headerSizeTag + '>';

		print( title_html );
		if(settings.secondary_title_enable == 'yes'){
		print( sec_title_html );
		} #>

		<# if(settings.description_text) { #>
		<div {{{ view.getRenderAttributeString('description_text' ) }}}>{{{ settings.description_text }}}</div>
		<# } #>
		</div>
		<?php
	}
}

