<?php

namespace DesignMonks\MonksMartCore\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ProductList extends Widget_Base {
	public function get_name() {
		return 'dmt-product-list';
	}

	public function get_title() {
		return __( 'Dmt Product List', 'gmart-core' );
	}

	public function get_icon() {
		return 'fa fa-sliders';
	}

	public function get_categories() {
		return [ 'dmt-elements' ];
	}

	protected function _register_controls() {
		$terms = get_terms( 'product_cat', array( 'hide_empty' => false ) );
		$term  = array( '' => __( 'All Categories', "gmart-core" ) );
		foreach ( $terms as $cat ) {
			$term[ $cat->slug ] = $cat->name;
		}
		$number = array( '1' => 1, '2' => 2, '3' => 3, '4' => 4,  '6' => 6);


		$this->start_controls_section( 'layout_section', [
			'label' => __( 'Layout and Style', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'layout', [
			'label'   => __( 'Layout', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'default',
			'options' => [
				'default'    => __( 'Grid', 'gmart-core' ),
				'slider'     => __( 'Slider', 'gmart-core' ),
			],
		] );

		$this->add_control( 'prod_style', [
			'label'   => __( 'Style', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'style--one',
			'options' => [
				'style--one'   => __( 'Style One', 'gmart-core' ),
				'style--two'   => __( 'Style Two', 'gmart-core' ),
				'style--three' => __( 'Style Three', 'gmart-core' ),
			],
		] );

//		$this->add_control( 'title', [
//			'label'       => __( 'Title', 'gmart-core' ),
//			'type'        => Controls_Manager::TEXT,
//			'default'     => __('Best Selling', 'gmart-core'),
//			'placeholder' => __( 'Type your title here', 'gmart-core' ),
//			'label_block' => true
//		] );
//
//		// Subtitle
//		$this->add_control( 'subtitle', [
//			'label'       => __( 'Subtitle', 'gmart-core' ),
//			'type'        => Controls_Manager::TEXT,
//			'default'     => __('Latest Product', 'gmart-core'),
//			'placeholder' => __( 'Type your subtitle here', 'gmart-core' ),
//			'label_block' => true
//		] );

		$this->end_controls_section();

		// Content Section
		//=====================
		$this->start_controls_section( 'content_section', [
			'label' => __( 'Content Settings', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control( 'title', [
			'label'       => __( 'Title', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __('Best Selling', 'gmart-core'),
			'placeholder' => __( 'Type your title here', 'gmart-core' ),
			'label_block' => true
		] );

		// Subtitle
		$this->add_control( 'subtitle', [
			'label'       => __( 'Subtitle', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __('Latest Product', 'gmart-core'),
			'placeholder' => __( 'Type your subtitle here', 'gmart-core' ),
			'label_block' => true
		] );

		$this->end_controls_section();



		$this->start_controls_section( 'query_section', [
			'label' => __( 'Query Settings', 'gmart-core' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );


		$this->add_control( 'category', [
			'label'   => __( 'Category', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '',
			'options' => $term
		] );
		$this->add_control( 'source', [
			'label'   => __( 'Source Product', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'default',
			'options' => array(
				'default'   => 'Default',
				'featured'  => 'Featured Product ',
				'sale'      => 'Sale Product',
				'toprating' => 'Top Rating',
				'bestsales' => 'Best Sales',
				'childcat'  => 'Child Category'
			)
		] );
		$this->add_control( 'orderby', [
			'label'   => __( 'Order By', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'date',
			'options' => array(
				'name'          => 'Name',
				'author'        => 'Author',
				'date'          => 'Date',
				'title'         => 'Title',
				'modified'      => 'Modified',
				'parent'        => 'Parent',
				'ID'            => 'ID',
				'rand'          => 'Random',
				'comment_count' => 'Comment Count'
			)
		] );

		$this->add_control( 'order', [
			'label'   => __( 'Order', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'DESC' => __( 'Descending', 'gmart-core' ),
				'ASC'  => __( 'No', 'Ascending' ),
			],
			'default' => 'ASC'
		] );

		$this->add_control( 'numberposts', [
			'label'       => __( 'Items per page', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => '5',
			'placeholder' => __( 'Number Of Products', 'gmart-core' ),
		] );

		$this->add_control( 'item_row', [
			'label'   => __( 'Number row per column', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array( '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5 ),
			'default' => 1
		] );

		$this->add_control( 'columns', [
			'label'   => __( 'Number of Columns >1440px', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $number,
			'default' => 4
		] );

		$this->add_control( 'columns1440', [
			'label'   => __( 'Number of Columns 1200px to 1440px', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $number,
			'default' => 1
		] );

		$this->add_control( 'columns1', [
			'label'   => __( 'Number of Columns on 992px to 1199px', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $number,
			'default' => 1
		] );

		$this->add_control( 'columns2', [
			'label'   => __( 'Number of Columns on 768px to 991px', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $number,
			'default' => 1
		] );

		$this->add_control( 'columns3', [
			'label'   => __( 'Number of Columns on 480px to 767px', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $number,
			'default' => 1
		] );

		$this->add_control( 'columns4', [
			'label'   => __( 'Number of Columns in 480px or less than', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $number,
			'default' => 1
		] );

		$this->add_control( 'time_deal', [
			'label'       => __( 'Time Coundown', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => '',
			'placeholder' => __( 'Ex : 2019-5-25', 'gmart-core' ),
			'condition'   => [
				'layout' => [ 'list-deal', 'list-deal2', 'list-deal3' ],
			]
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'label_list', [
			'label'       => __( 'label', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => '',
			'placeholder' => __( 'Type your text here', 'gmart-core' ),
		] );

		$repeater->add_control( 'link_list', [
			'label'       => __( 'Link', 'gmart-core' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => '#',
			'placeholder' => __( 'Type your link here', 'gmart-core' ),
			'condition'   => [
				'show_active' => [ "0" ],
			]
		] );

		$repeater->add_control( 'show_active', [
			'label'   => __( 'Show Active', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'1' => __( 'Yes', 'gmart-core' ),
				'0' => __( 'No', 'gmart-core' ),
			],
			'default' => '0',
		] );

		$this->end_controls_section();

		// Slider Control
		//=====================
		$this->start_controls_section( 'settingd_section', [
			'label' => esc_html__( 'Slider Control', 'gmart-core' ),
		] );

		// Product per view
		$this->add_responsive_control( 'slides_per_view', [
			'label'   => __( 'Product per view', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 4,
			'options' => [
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
			],
		] );

		$this->add_control( 'navigation', [
			'label'        => esc_html__( 'Navigation', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'no'
		] );

		$this->add_control( 'pagination', [
			'label'        => esc_html__( 'Pagination', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );
		// Pagination Align
		$this->add_control(
			'pagination_align',
			[
				'label'     => esc_html__( 'Pagination Align', 'gmart-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'left'   => esc_html__( 'Left', 'gmart-core' ),
					'center' => esc_html__( 'Center', 'gmart-core' ),
					'right'  => esc_html__( 'Right', 'gmart-core' ),
				],
				'default'   => 'center',
				'condition' => [
					'pagination' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .dmt-slider-pagination' => 'text-align: {{VALUE}}'
				]
			]
		);



		$this->add_control( 'loop', [
			'label'        => esc_html__( 'Loop', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gmart-core' ),
			'label_off'    => esc_html__( 'Off', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'speed', [
			'label'   => __( 'Speed', 'gmart-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 700,
		] );

		$this->add_control( 'autoplay', [
			'label'        => esc_html__( 'Autoplay', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'gmart-core' ),
			'label_off'    => esc_html__( 'Off', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'autoplay_time', [
			'label'   => __( 'Autoplay Time', 'gmart-core' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 3000,
			'condition' => [
				'autoplay' => 'yes'
			]
		] );

		// Space Between
		$this->add_control(
			'space_between',
			[
				'label'   => esc_html__( 'Space Between', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 30,
			]
		);

		// Scrollbar

		$this->add_control( 'scrollbar', [
			'label'        => esc_html__( 'Scrollbar', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'no'
		] );

		$this->add_control( 'scrollbar_drag_width', [
			'label'        => esc_html__( 'Scrollbar Drag Width', 'gmart-core' ),
			'type'         => Controls_Manager::NUMBER,
			'default'      => 200,
			'condition' => [
				'scrollbar' => 'yes'
			],
			'description' => 'Set the width of scrollbar drag in pixel. Default is 200px.'
		] );

		$this->add_control( 'scrollbar_hide', [
			'label'        => esc_html__( 'Scrollbar Hide', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'no',
			'condition' => [
				'scrollbar' => 'yes'
			]
		] );

		// Overflows
		$this->add_control( 'overflows', [
			'label'   => __( 'Overflows', 'gmart-core' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'hidden',
			'options' => [
				'hidden'  => __( 'Hidden', 'gmart-core' ),
				'visible' => __( 'Visible', 'gmart-core' ),
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$layout   = $settings['layout'];

		$this->add_render_attribute( 'wrapper', 'class', [
			'swiper',
			'dmt-products-slider',
		] );

		if( $settings['overflows'] == 'visible' ) {
//			$this->add_render_attribute( 'wrapper', 'style', 'overflow: hidden;' );
			$this->add_render_attribute( 'wrapper', 'style', 'overflow: visible;' );
		}

		$slider_options = $this->get_slider_options( $settings );
		$this->add_render_attribute( 'wrapper', 'data-product', wp_json_encode( $slider_options ) );

		global $gmart_sc;


		$settings = shortcode_atts( array(
			'title'        => '',
			'subtitle'        => '',
			'label_button'  => '',
			'link_button'   => '#',
			'orderby'       => '',
			'order'         => '',
			'category'      => '',
			'numberposts'   => 5,
			'length'        => 25,
			'item_row'      => 1,
			'columns'       => 4,
			'columns1440'   => 4,
			'columns1'      => 4,
			'columns2'      => 3,
			'columns3'      => 2,
			'columns4'      => 1,
			'style_product' => 1,
			'time_deal'     => '',
			'show_pag'      => '0',
			'source'        => 'default',
			'link'          => '#',
			'layout'        => 'default',
			'prod_style'    => 'style--one',
			'navigation'    => 'yes',
			'pagination'    => 'yes',
			'loop'          => 'yes',
			'speed'         => 700,
			'autoplay'      => 'yes',
			'autoplay_time' => 3000,
			'scrollbar'     => 'no',
			'scrollbar_drag_width' => 200,
			'scrollbar_hide' => 'no',
			'overflows'     => 'hidden',
		), $settings );


		$gmart_sc = $settings;

		switch ( $settings['source'] ) {
			case 'default':
				$default = array();
				if ( $settings['category'] ) {
					$default = array(
						'post_type'   => 'product',
						'tax_query'   => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $settings['category']
							)
						),
						'orderby'     => $settings['orderby'],
						'order'       => $settings['order'],
						'post_status' => 'publish',
						'showposts'   => $settings['numberposts']
					);
				} else {
					$default = array(
						'post_type'   => 'product',
						'orderby'     => $settings['orderby'],
						'order'       => $settings['order'],
						'post_status' => 'publish',
						'showposts'   => $settings['numberposts']
					);
				}
				$widget_id    = 'dmt_default_' . rand() . time();
				$widget_class = 'dmt_list_default';
				$list         = new \WP_Query( $default );
				break;
			case 'featured':
				$product_visibility_term_ids = wc_get_product_visibility_term_ids();
				if ( $settings['category'] ) {
					$default = array(
						'post_type'           => 'product',
						'post_status'         => 'publish',
						'tax_query'           => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $settings['category']
							),
							array(
								'taxonomy' => 'product_visibility',
								'field'    => 'term_taxonomy_id',
								'terms'    => $product_visibility_term_ids['featured'],
							)
						),
						'ignore_sticky_posts' => 1,
						'posts_per_page'      => $settings['numberposts'],
						'orderby'             => $settings['orderby'],
						'order'               => $settings['order']
					);
				} else {
					$default = array(
						'post_type'           => 'product',
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
						'posts_per_page'      => $settings['numberposts'],
						'orderby'             => $settings['orderby'],
						'order'               => $settings['order'],
						'tax_query'           => array(
							array(
								'taxonomy' => 'product_visibility',
								'field'    => 'term_taxonomy_id',
								'terms'    => $product_visibility_term_ids['featured'],
							)
						)
					);
				}
				$widget_id    = 'dmt_featured_' . rand() . time();
				$widget_class = 'dmt_list_featured';
				$list         = new \WP_Query( $default );
				break;
			case 'toprating':
				if ( $settings['category'] ) {
					$default = array(
						'post_type'     => 'product',
						'tax_query'     => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $settings['category'],
								'operator' => 'IN'
							)
						),
						'post_status'   => 'publish',
						'no_found_rows' => 1,
						'showposts'     => $settings['numberposts']
					);
				} else {
					$default = array(
						'post_type'     => 'product',
						'post_status'   => 'publish',
						'no_found_rows' => 1,
						'showposts'     => $settings['numberposts']
					);
				}
				$default['meta_query'] = WC()->query->get_meta_query();
				add_filter( 'posts_clauses', 'order_by_rating_post_clauses' );
				$widget_id    = 'dmt_toprated_' . rand() . time();
				$widget_class = 'dmt_list_toprated';
				$list         = new \WP_Query( $default );

				add_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );

				break;
			case 'sale':
				$product_ids_on_sale   = wc_get_product_ids_on_sale();
				$product_ids_on_sale[] = 0;
				if ( $settings['category'] ) {
					$default = array(
						'post_type'           => 'product',
						'tax_query'           => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $settings['category'],
								'operator' => 'IN'
							)
						),
						'post__in'            => $product_ids_on_sale,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
						'showposts'           => $settings['numberposts']
					);
				} else {
					$default = array(
						'post_type'           => 'product',
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
						'showposts'           => $settings['numberposts'],
						'post__in'            => $product_ids_on_sale
					);
				}
				$widget_id    = 'dmt_sale_product_' . rand() . time();
				$widget_class = 'dmt_sale_product';
				$list         = new \WP_Query( $default );
				break;
			case 'bestsales':
				if ( $settings['category'] ) {
					$default = array(
						'post_type'           => 'product',
						'tax_query'           => array(
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'slug',
								'terms'    => $settings['category'],
								'operator' => 'IN'
							)
						),
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
						'paged'               => 1,
						'showposts'           => $settings['numberposts'],
						'meta_key'            => 'total_sales',
						'orderby'             => 'meta_value_num'
					);
				} else {
					$default = array(
						'post_type'           => 'product',
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
						'showposts'           => $settings['numberposts'],
						'meta_key'            => 'total_sales',
						'orderby'             => 'meta_value_num'
					);
				}
				$widget_id    = 'dmt_bestsales_' . rand() . time();
				$widget_class = 'dmt_list_bestsales';
				$list         = new \WP_Query( $default );
				break;
			case 'childcat':
				$default   = array();
				$default   = array(
					'post_type'   => 'product',
					'tax_query'   => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => $settings['category']
						)
					),
					'orderby'     => $settings['orderby'],
					'order'       => $settings['order'],
					'post_status' => 'publish',
					'showposts'   => $settings['numberposts']
				);
				$term      = get_term_by( 'slug', $settings['category'], 'product_cat' );
				$widget_id = 'dmt_childcat_' . rand() . time();
				$list      = new \WP_Query( $default );
				break;
		}

		include_once __DIR__ . '/templates/product/'.$layout.'.php';
	}

	protected function get_slider_options( array $settings ) {

		// Loop
		if ( $settings['loop'] == 'yes' ) {
			$slider_options['loop'] = true;
		}

		// LoopSlides
		if ( $settings['loop'] == 'yes' ) {
			$slider_options['loopedSlides'] = (int) $settings['numberposts'];
		}

		// Loop Prevent slides
		if ( $settings['loop'] == 'yes' ) {
			$slider_options['loopPreventSlide'] = false;
		}


		// Speed
		if ( ! empty( $settings['speed'] ) ) {
			$slider_options['speed'] = $settings['speed'];
		}

		// Space Between
		$slider_options['spaceBetween'] = (int) $settings['space_between'];

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

		// Pagination
		if ( $settings['pagination'] == 'yes' ) {
			$slider_options['pagination'] = [
				'el'        => '.product-carousel-pagination',
				'clickable' => true,
			];
		}

		// Scrollbar
		if ( $settings['scrollbar'] == 'yes' ) {
			$slider_options['scrollbar'] = [
				'el'       => '.swiper-scrollbar',
				'hide'     => $settings['scrollbar_hide'] == 'yes' ? true : false,
				'dragSize' => (int) $settings['scrollbar_drag_width'],
				'draggable' => true,
			];
		}

//		scrollbar: {
//			el:
//			$crossSells . find( '.swiper-scrollbar' ),
//				hide: false,
//				draggable: true
//			},
//	}

		$slider_options['breakpoints'] = [
			'1024' => [
				'slidesPerView' => (int) $settings['slides_per_view'],
			],

			'620'  => [
				'slidesPerView' => 3,
				'spaceBetween'  => 20,
			],

			'420' => [
				'slidesPerView' => 2,
				'spaceBetween'  => 20,
			],

			'320' => [
				'slidesPerView' => 2,
				'spaceBetween'  => 20,
			],
		];


		$slider_options['navigation'] = [
			'nextEl' => '.product-next',
			'prevEl' => '.product-prev'
		];

		return $slider_options;
	}
}