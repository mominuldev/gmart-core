<?php

namespace GPTheme\GmartCore\Admin\PostType;

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

class MegaMenu {
	private $type = 'mega_menu';
	private $slug = 'mega_menu';
	private $name;
	private $tem;
	private $singular_name;
	private $plural_name;

	function __construct() {
		$this->name          = __( 'Mega Menu', 'gmart-core' );
		$this->singular_name = __( 'Item', 'gmart-core' );
		$this->plural_name   = __( 'Items', 'gmart-core' );


		add_action( 'init', array( $this, 'register_post_types' ), 1 );
//			add_action( 'init', array( $this, 'register_mega_menu_taxonomy' ), 1 );
	}

	function register_post_types() {
		$labels = array(
			'name'                  => esc_html__( 'Mega Menu', 'gmart-core' ),
			'singular_name'         => esc_html__( 'Mega Menu', 'gmart-core' ),
			'all_items'             => esc_html__( 'All Menus', 'gmart-core' ),
			'menu_name'             => _x( 'Mega Menu', 'Admin menu name', 'gmart-core' ),
			'add_new'               => esc_html__( 'Add New', 'gmart-core' ),
			'add_new_item'          => esc_html__( 'Add new Menu', 'gmart-core' ),
			'edit'                  => esc_html__( 'Edit', 'gmart-core' ),
			'edit_item'             => esc_html__( 'Edit Footer', 'gmart-core' ),
			'new_item'              => esc_html__( 'New Menu', 'gmart-core' ),
			'view'                  => esc_html__( 'View Menu', 'gmart-core' ),
			'view_item'             => esc_html__( 'View Menu', 'gmart-core' ),
			'search_items'          => esc_html__( 'Search Menus', 'gmart-core' ),
			'not_found'             => esc_html__( 'No Menus found', 'gmart-core' ),
			'not_found_in_trash'    => esc_html__( 'No Menus found in trash', 'gmart-core' ),
			'parent'                => esc_html__( 'Parent Menu', 'gmart-core' ),
			'filter_items_list'     => esc_html__( 'Filter Menus', 'gmart-core' ),
			'items_list_navigation' => esc_html__( 'Menus navigation', 'gmart-core' ),
			'items_list'            => esc_html__( 'Menu list', 'gmart-core' ),
		);

		$supports = array(
			'title',
			'editor',
			'elementor',
		);

		register_post_type( $this->type, array(
			'labels'            => $labels,
			'supports'          => $supports,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => false,
			'hierarchical'      => true,
			'show_tagcloud'     => false,
			'show_ui'           => true,
			'rewrite'           => array(
				'slug' => $this->slug,
			),
			'can_export'        => true,
			'menu_icon'         => 'dashicons-download',
		) );

		flush_rewrite_rules( true );
	}

	function register_mega_menu_taxonomy() {
		$category = 'category'; // Second part of taxonomy name

		$labels = array(
			'name'              => sprintf( __( '%s Categories', 'gmart-core' ), $this->name ),
			'menu_name'         => sprintf( __( '%s Categories', 'gmart-core' ), $this->name ),
			'singular_name'     => sprintf( __( '%s Category', 'gmart-core' ), $this->name ),
			'search_items'      => sprintf( __( 'Search %s Categories', 'gmart-core' ), $this->name ),
			'all_items'         => sprintf( __( 'All %s Categories', 'gmart-core' ), $this->name ),
			'parent_item'       => sprintf( __( 'Parent %s Category', 'gmart-core' ), $this->name ),
			'parent_item_colon' => sprintf( __( 'Parent %s Category:', 'gmart-core' ), $this->name ),
			'new_item_name'     => sprintf( __( 'New %s Category Name', 'gmart-core' ), $this->name ),
			'add_new_item'      => sprintf( __( 'Add New %s Category', 'gmart-core' ), $this->name ),
			'edit_item'         => sprintf( __( 'Edit %s Category', 'gmart-core' ), $this->name ),
			'update_item'       => sprintf( __( 'Update %s Category', 'gmart-core' ), $this->name ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $this->slug . '-' . $category ),
		);
		register_taxonomy( $this->type . '-' . $category, array( $this->type ), $args );
	}
}

