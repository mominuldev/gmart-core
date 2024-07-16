<?php
/**
 * Wpbingo Woo Tab Slider Widget
 * Plugin URI: http://www.gmart.com
 * Version: 1.0
 */
namespace DesignMonks\MonksMartCore\Admin\PostType;

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;
class ProductBrands {
	public function __construct() {

		add_action( 'woocommerce_register_taxonomy', array( $this, 'create_taxonomies' ) );
		add_action( "delete_term", array( $this, 'delete_term' ), 5 );
	}
	public function create_taxonomies() {
		$shop_page_id = wc_get_page_id( 'shop' );

		$base_slug = $shop_page_id > 0 && get_page( $shop_page_id ) ? get_page_uri( $shop_page_id ) : 'shop';

		$brands_base = get_option('woocommerce_prepend_shop_page_to_urls') == "yes" ? trailingslashit( $base_slug ) : '';

		$cap = version_compare( WOOCOMMERCE_VERSION, '2.0', '<' ) ? 'manage_woocommerce_products' : 'edit_products';
		$labels = array(
			'name'              => __( 'Brands', 'gmart-core' ),
			'singular_name'     => __( 'Brands', 'gmart-core' ),
			'search_items'      => __( 'Search Genres', 'gmart-core' ),
			'all_items'         => __( 'All Brands', 'gmart-core' ),
			'parent_item'       => __( 'Parent Brands', 'gmart-core'),
			'parent_item_colon' => __( 'Parent Brands:', 'gmart-core' ),
			'edit_item'         => __( 'Edit Brands', 'gmart-core'),
			'update_item'       => __( 'Update Brands', 'gmart-core'),
			'add_new_item'      => __( 'Add New Brands', 'gmart-core'),
			'new_item_name'     => __( 'New Brands Name', 'gmart-core'),
			'menu_name'         => 'Brand',
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui' 				=> true,
			'show_in_nav_menus' 	=> true,
			'capabilities'			=> array(
				'manage_terms' 		=> $cap,
				'edit_terms' 		=> $cap,
				'delete_terms' 		=> $cap,
				'assign_terms' 		=> $cap
			),
			'rewrite' 				=> array( 'slug' => $brands_base . __( 'brand', 'gmart-core' ), 'with_front' => false, 'hierarchical' => true )
		);
		register_taxonomy( 'product_brand', array('product'), apply_filters( 'register_taxonomy_product_brand',$args ));
	}

	public function delete_term( $term_id ) {

		$term_id = (int) $term_id;

		if ( ! $term_id )
			return;

		global $wpdb;
		$wpdb->query( "DELETE FROM {$wpdb->woocommerce_termmeta} WHERE `woocommerce_term_id` = " . $term_id );
	}
}
