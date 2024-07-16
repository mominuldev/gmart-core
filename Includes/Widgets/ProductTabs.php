<?php
namespace DesignMonks\MonksMartCore\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class ProductTabs extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve tabs widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'dmt-product-tabs';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve tabs widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return esc_html__( 'Product Tabs', 'gmart-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve tabs widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-tabs';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @return array Widget keywords.
	 * @since 2.1.0
	 * @access public
	 *
	 */
	public function get_keywords() {
		return [ 'tabs', 'toggle', 'product' ];
	}


	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'dmt-elements' );
	}

	/**
	 * Register tabs widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls() {

		// Get all terms of woocommerce
		$product_cat = array();
		$terms       = get_terms( 'product_cat' );
		if ( $terms && ! isset( $terms->errors ) ) {
			foreach ( $terms as $key => $value ) {
				$product_cat[ $value->term_id ] = $value->name;
			}
		}
		$product_cat = [ 0 => 'All' ] + $product_cat;


		$this->start_controls_section(
			'gmart_product_tabs_content',
			[
				'label' => esc_html__( 'Tabs', 'gmart-core' ),
			]
		);

		// Layout
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Layout', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'grid'     => esc_html__( 'Grid', 'gmart-core' ),
					'carousel' => esc_html__( 'Carousel', 'gmart-core' ),
				],
				'default' => 'grid',
			]
		);

		// Show Tab Menu
		$this->add_control(
			'show_tab_menu',
			[
				'label'        => esc_html__( 'Show Tab Menu', 'gmart-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'gmart-core' ),
				'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);


		$this->add_control(
			'tab_style',
			array(
				'label'   => esc_html__( 'Tabs style', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'tab_style1' => esc_html__( 'Style 1', 'gmart-core' ),
					'tab_style2' => esc_html__( 'Style 2', 'gmart-core' ),
					'tab_style3' => esc_html__( 'Style 3', 'gmart-core' ),
				),
				'default' => 'tab_style1',
				'condition' => [
					'show_tab_menu' => 'yes',
				],
			)
		);

		$this->add_control(
			'prod_style',
			[
				'label'   => esc_html__( 'Product style', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style--one',
				'options' => [
					'style--one'   => esc_html__( 'Style 1', 'gmart-core' ),
					'style--two'   => esc_html__( 'Style 2', 'gmart-core' ),
					'style--three' => esc_html__( 'Style 3', 'gmart-core' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label'       => esc_html__( 'Title', 'gmart-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab Title', 'gmart-core' ),
				'placeholder' => esc_html__( 'Tab Title', 'gmart-core' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'tabs_content',
			[
				'label'     => esc_html__( 'Content', 'gmart-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'display',
			array(
				'label'   => esc_html__( 'Display', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'all'                   => esc_html__( 'All products', 'gmart-core' ),
					'recent'                => esc_html__( 'Recent products', 'gmart-core' ),
					'featured'              => esc_html__( 'Featured products', 'gmart-core' ),
					'sale'                  => esc_html__( 'Sale products', 'gmart-core' ),
					'best_selling_products' => esc_html__( 'Best selling products', 'gmart-core' ),
					'rated'                 => esc_html__( 'Top Rated Products', 'gmart-core' ),
				),
				'default' => 'all',
			)
		);

		$repeater->add_control(
			'cat_id',
			array(
				'label'   => esc_html__( 'Category', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'options' => $product_cat,
				'default' => 'all',
			)
		);

		$repeater->add_control(
			'orderby',
			array(
				'label'       => esc_html__( 'Order By', 'gmart-core' ),
				'description' => sprintf( wp_kses_post( 'Select how to sort retrieved products. More at %s. Default by Title', 'gmart-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => array(
					'title'         => esc_html__( 'Title', 'gmart-core' ),
					'date'          => esc_html__( 'Date', 'gmart-core' ),
					'ID'            => esc_html__( 'ID', 'gmart-core' ),
					'author'        => esc_html__( 'Author', 'gmart-core' ),
					'modified'      => esc_html__( 'Modified', 'gmart-core' ),
					'rand'          => esc_html__( 'Random', 'gmart-core' ),
					'comment_count' => esc_html__( 'Comment count', 'gmart-core' ),
					'menu_order'    => esc_html__( 'Menu order', 'gmart-core' ),
				),
				'default'     => 'title',
			)
		);

		$repeater->add_control(
			'order',
			array(
				'label'       => esc_html__( 'Order', 'gmart-core' ),
				'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s. Default by ASC', 'gmart-core' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => array(
					'ASC'  => esc_html__( 'Ascending', 'gmart-core' ),
					'DESC' => esc_html__( 'Descending', 'gmart-core' ),
				),
				'default'     => 'ASC',
			)
		);

		$this->add_control(
			'tabs',
			[
				'label'       => esc_html__( 'Tabs Items', 'gmart-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'tab_title' => 'Tab #1',
					],
					[
						'tab_title' => 'Tab #2',
					],
					[
						'tab_title' => 'Tab #3',
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'gmart_product_tabs_settings',
			array(
				'label' => esc_html__( 'Setting', 'gmart-core' ),
			)
		);

		// Tab Align
		$this->add_control(
			'tab_align',
			[
				'label'        => esc_html__( 'Tab Align', 'gmart-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'options'      => [
					'left'   => esc_html__( 'Left', 'gmart-core' ),
					'center' => esc_html__( 'Center', 'gmart-core' ),
					'right'  => esc_html__( 'Right', 'gmart-core' ),
				],
				'default'      => 'left',
				'prefix_class' => 'dmt-tab-align-',
				'condition'    => [
					'style' => 'grid',
				],
			]
		);

		$this->add_control(
			'tabs_color',
			[
				'label'     => esc_html__( 'Tabs Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'color: {{VALUE}}; border-color: {{VALUE}} !important',
					'{{WRAPPER}} .elementor-tab-title:hover'            => 'color: {{VALUE}}; border-color: {{VALUE}} !important',
				],
				'default'   => '#222222'
			]
		);


		$this->add_control(
			'columns',
			array(
				'label'       => esc_html__( 'Columns', 'gmart-core' ),
				'description' => esc_html__( 'Columns per row', 'gmart-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => array(
					'6'  => esc_html__( '2 Columns', 'gmart-core' ),
					'4'  => esc_html__( '3 Columns', 'gmart-core' ),
					'3'  => esc_html__( '4 Columns', 'gmart-core' ),
					'15' => esc_html__( '5 Columns', 'gmart-core' ),
					'2'  => esc_html__( '6 Columns', 'gmart-core' ),
				),
				'default'     => '3',
				'condition'   => [
					'style' => 'grid',
				],
			)
		);

		$this->add_control(
			'limit',
			array(
				'label'       => esc_html__( 'Items per page', 'gmart-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'input_type'  => 'text',
				'placeholder' => '',
				'default'     => '12',
			)
		);

		$this->add_control(
			'css_animation',
			array(
				'label'     => esc_html__( 'CSS Animation', 'gmart-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'separator' => 'before',
				'options'   => array(
					'top-to-bottom' => esc_html__( 'Top to bottom', 'gmart-core' ),
					'bottom-to-top' => esc_html__( 'Bottom to top', 'gmart-core' ),
					'left-to-right' => esc_html__( 'Left to right', 'gmart-core' ),
					'right-to-left' => esc_html__( 'Right to left', 'gmart-core' ),
					'appear'        => esc_html__( 'Appear from center', 'gmart-core' ),
				),
				'default'   => 'top-to-bottom',
			)
		);

		$this->add_control(
			'class',
			array(
				'label'       => esc_html__( 'Extra class name', 'gmart-core' ),
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gmart-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'input_type'  => 'text',
				'placeholder' => '',
			)
		);

		$this->end_controls_section();



		// Slider Control
		//=====================
		$this->start_controls_section( 'settingd_section', [
			'label' => esc_html__( 'Slider Control', 'gmart-core' ),
		] );

		$this->add_control(
			'slides_per_view',
			[
				'label'   => esc_html__( 'Slider Per View', 'gmart-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'2' => esc_html__( '2', 'gmart-core' ),
					'3' => esc_html__( '3', 'gmart-core' ),
					'4' => esc_html__( '4', 'gmart-core' ),
					'5' => esc_html__( '5', 'gmart-core' ),
				],
			]
		);

		$this->add_control( 'navigation', [
			'label'        => esc_html__( 'Navigation', 'gmart-core' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'gmart-core' ),
			'label_off'    => esc_html__( 'Hide', 'gmart-core' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		// Pagination
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
			'label'     => __( 'Autoplay Time', 'gmart-core' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 9000,
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

		/**
		 * Products design settings.
		 */
		$this->start_controls_section(
			'products_design_style_section',
			[
				'label' => esc_html__( 'Products design', 'gmart-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'typography',
				'label'     => esc_html__( 'Product Title', 'gmart-core' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .product-title',
			]
		);
		$this->add_control(
			'product_title_color',
			[
				'label'     => esc_html__( 'Product Title Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-title a:not(:hover)' => 'color: {{VALUE}}',
				],
				'default'   => '#222222'
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'price_typography',
				'label'     => esc_html__( 'Product Price', 'gmart-core' ),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .cashop-sc-products .product .price',
			]
		);
		$this->add_control(
			'product_price_color',
			[
				'label'     => esc_html__( 'Product Price Color', 'gmart-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cashop-sc-products .product .price ins' => 'color: {{VALUE}}',
				],
				'default'   => ''
			]
		);
		$this->add_control(
			'img_size',
			[
				'label'     => esc_html__( 'Image size', 'gmart-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'large',
//				'options' => gmart_get_all_image_sizes_names(),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'img_size_custom',
			[
				'label'       => esc_html__( 'Image dimension', 'gmart-core' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Enter custom size to crop Image.', 'gmart-core' ),
				'condition'   => [
					'img_size' => 'custom',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render tabs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$default_setting = $this->get_default_setting();

		$tabs = $this->get_settings_for_display( 'tabs' );

		$settings = $this->get_settings_for_display();

		$global_setting = $this->get_global_setting( $settings );

		$settings = wp_parse_args( $settings, $default_setting );

		$product_shortcode = array();

		foreach ( $tabs as $tab_index => $tab ) {
			$tab_setting         = $this->get_tabs_setting( $tab );
			$product_shortcode[] = $this->create_shortcode_products( $global_setting, $tab_setting );
		}
		?>

		<div class="product-tabs <?php echo esc_attr( $settings['tab_style'] ); ?>">
			<?php if( 'yes' == $settings['show_tab_menu'] || 'yes' == $settings['navigation']) : ?>
				<div class="product-tab-nav">
					<?php if( 'yes' == $settings['show_tab_menu']) : ?>
					<div class="product-tab-header">
						<?php foreach ( $tabs as $index => $tab ) : ?>
							<?php $tab_attr = array_intersect_key( array_merge( $settings, $tab ), $this->get_default_setting() ); ?>
							<?php $item_class = $index == 0 ? 'elementor-active' : ''; ?>
							<div class="product-tab-item elementor-tab-title <?php echo esc_attr( $item_class ); ?>"
								 data-shortcode='<?php echo wp_json_encode( $tab_attr ); ?>'
								 data-skey="<?php echo wp_create_nonce( 'gmart_woo_change_tabs_el_datta' ); ?>">
								<a href="#"><?php echo esc_html( $tab['tab_title'] ); ?></a>
							</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php if( 'yes' == $settings['navigation'] && 'carousel' == $settings['style'] ) : ?>
						<div class="slider-control">
							<div class="product-tab-prev">
								<i class="ri ri-arrow-left-line"></i>
							</div>

							<div class="product-tab-next">
								<i class="ri ri-arrow-right-line"></i>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<!-- /.product-tab-nav -->
			<?php endif; ?>

			<div class="cashop-tab-content">
				<div class="product-tab-loading"><i class="fas fa-spin fa-spinner"></i></div>
				<?php if ( ! empty( $product_shortcode ) ) :
					echo do_shortcode( '[gmart_addons_products' . $product_shortcode[0] . ']' );
				endif; ?>

				<?php if( 'yes' == $settings['pagination'] && 'carousel' == $settings['style'] ) : ?>
					<div class="dmt-slider-pagination product-pagination"></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	protected function get_global_setting( $settings, $type = 'string' ) {
		$args_row = '';
		$args_row .= $settings['style'] ? ' style="' . esc_attr( $settings['style'] ) . '"' : '';
		$args_row .= $settings['tab_style'] ? ' tab_style="' . esc_attr( $settings['tab_style'] ) . '"' : '';
		$args_row .= $settings['prod_style'] ? ' prod_style="' . esc_attr( $settings['prod_style'] ) . '"' : '';

		$args_row .= $settings['columns'] ? ' columns="' . esc_attr( $settings['columns'] ) . '"' : '';
		$args_row .= absint( $settings['limit'] ) ? ' limit="' . intval( $settings['limit'] ) . '"' : '';

		$args_row .= $settings['img_size'] ? ' img_size="' . $settings['img_size'] . '"' : '';

		$args_row .= isset( $settings['img_size_custom']['width'] ) ? ' img_size_custom_width="' . $settings['img_size_custom']['width'] . '"' : '';
		$args_row .= isset( $settings['img_size_custom']['height'] ) ? ' img_size_custom_height="' . $settings['img_size_custom']['height'] . '"' : '';

		// Slider
		$args_row .= $settings['slides_per_view'] ? ' slides_per_view="' . esc_attr( $settings['slides_per_view'] ) . '"' : '';
		$args_row .= $settings['navigation'] ? ' navigation="' . esc_attr( $settings['navigation'] ) . '"' : '';
		$args_row .= $settings['pagination'] ? ' pagination="' . esc_attr( $settings['pagination'] ) . '"' : '';
		$args_row .= $settings['loop'] ? ' loop="' . esc_attr( $settings['loop'] ) . '"' : '';
		$args_row .= $settings['speed'] ? ' speed="' . esc_attr( $settings['speed'] ) . '"' : '';
		$args_row .= $settings['autoplay'] ? ' autoplay="' . esc_attr( $settings['autoplay'] ) . '"' : '';
		$args_row .= $settings['autoplay_time'] ? ' autoplay_time="' . esc_attr( $settings['autoplay_time'] ) . '"' : '';
		$args_row .= $settings['space_between'] ? ' space_between="' . esc_attr( $settings['space_between'] ) . '"' : '';

		// Overflows
		$args_row .= $settings['overflows'] ? ' overflows="' . esc_attr( $settings['overflows'] ) . '"' : '';

		return $args_row;
	}

	protected function get_tabs_setting( $settings ) {
		$args_row = '';

		$args_row .= isset ( $settings['display'] ) ? ' display="' . esc_attr( $settings['display'] ) . '"' : '';
		$args_row .= isset ( $settings['orderby'] ) ? ' orderby="' . esc_attr( $settings['orderby'] ) . '"' : '';
		$args_row .= isset ( $settings['order'] ) ? ' order="' . esc_attr( $settings['order'] ) . '"' : '';
		$args_row .= isset ( $settings['items'] ) ? ' items="' . absint( $settings['items'] ) . '"' : '';

		$args_row .= isset ( $settings['cat_id'] ) ? ' cat_id="' . esc_attr( $settings['cat_id'] ) . '"' : '';


		return $args_row;
	}

	protected function create_shortcode_products( $global_setting, $tab_setting ) {
		$args_row = '';
		$args_row = $global_setting . ' ' . $tab_setting;

		return $args_row;
	}

	protected function get_default_setting() {

		return array(
			'style'                  => 'grid',
			'id'                     => '',
			'sku'                    => '',
			'display'                => 'all',
			'prod_style'             => '',
			'orderby'                => 'title',
			'order'                  => 'ASC',
			'cat_id'                 => '',
			'limit'                  => 12,
			'columns'                => 4,
			'class'                  => '',
			'issc'                   => true,
			'img_size'               => 'woocommerce_thumbnail',
			'img_size_custom_width'  => '',
			'img_size_custom_height' => '',
			'slides_per_view' => '4',
			'navigation' => true,
			'pagination' => true,
			'loop' => true,
			'speed' => 700,
			'autoplay' => true,
			'autoplay_time' => 500,
			'space_between' => 20,
			'overflows' => 'hidden',
		);
	}

}
