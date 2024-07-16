<?php

namespace GPTheme\GmartCore\Admin\PostType;

class Project {
	/**
	 * Post Type
	 *
	 * @var string
	 */
	private $post_type = 'project';

	/**
	 * Post Type Slug
	 *
	 * @var string
	 */

	private $post_type_slug = 'project';

	/**
	 * Post Type Singular Name
	 *
	 * @var string
	 */

	private $post_type_singular_name = 'Project';

	/**
	 * Post Type Plural Name
	 *
	 * @var string
	 */

	private $post_type_plural_name = 'Project';

	/**
	 * Post Type Icon
	 *
	 * @var string
	 */

	private $post_type_icon = 'dashicons-calendar-alt';

	/**
	 * Post Type Taxonomy
	 *
	 * @var string
	 */

	private $post_type_taxonomy = 'project_category';

	/**
	 * Post Type Taxonomy Singular Name
	 *
	 * @var string
	 */

	private $post_type_taxonomy_singular_name = 'Project Category';

	/**
	 * Post Type Taxonomy Plural Name
	 *
	 * @var string
	 */

	private $post_type_taxonomy_plural_name = 'Project Categories';

	/**
	 * post_type_taxonomy_slug
	 */

	private $post_type_taxonomy_slug = "project_category";


	/**
	 * PostType constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );

		// Single Template
		add_filter( 'single_template', array( $this, 'single_template' ) );
	}

	/**
	 * Register Post Type
	 */

	public function register_post_type() {
		$labels = array(
			'name'                  => _x( $this->post_type_plural_name, 'Post Type General Name', 'gmart-core' ),
			'singular_name'         => _x( $this->post_type_singular_name, 'Post Type Singular Name', 'gmart-core' ),
			'menu_name'             => __( $this->post_type_plural_name, 'gmart-core' ),
			'name_admin_bar'        => __( $this->post_type_singular_name, 'gmart-core' ),
			'archives'              => __( $this->post_type_plural_name . ' Archives', 'gmart-core' ),
			'attributes'            => __( $this->post_type_singular_name . ' Attributes', 'gmart-core' ),
			'parent_item_colon'     => __( 'Parent ' . $this->post_type_singular_name . ':', 'gmart-core' ),
			'all_items'             => __( 'All ' . $this->post_type_plural_name, 'gmart-core' ),
			'add_new_item'          => __( 'Add New ' . $this->post_type_singular_name, 'gmart-core' ),
			'add_new'               => __( 'Add New', 'gmart-core' ),
			'new_item'              => __( 'New ' . $this->post_type_singular_name, 'gmart-core' ),
			'edit_item'             => __( 'Edit ' . $this->post_type_singular_name, 'gmart-core' ),
			'update_item'           => __( 'Update ' . $this->post_type_singular_name, 'gmart-core' ),
			'view_item'             => __( 'View ' . $this->post_type_singular_name, 'gmart-core' ),
			'view_items'            => __( 'View ' . $this->post_type_plural_name, 'gmart-core' ),
			'search_items'          => __( 'Search ' . $this->post_type_singular_name, 'gmart-core' ),
			'not_found'             => __( 'Not found', 'gmart-core' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'gmart-core' ),
			'featured_image'        => __( 'Featured Image', 'gmart-core' ),
			'set_featured_image'    => __( 'Set featured image', 'gmart-core' ),
			'remove_featured_image' => __( 'Remove featured image', 'gmart-core' ),
			'use_featured_image'    => __( 'Use as featured image', 'gmart-core' ),
		);

		$args = array(
			'label'               => __( $this->post_type_singular_name, 'gmart-core' ),
			'description'         => __( $this->post_type_plural_name, 'gmart-core' ),
			'labels'              => $labels,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'taxonomies'          => array( $this->post_type_taxonomy ),
			'hierarchical'        => false,
			'show_in_rest'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => $this->post_type_icon,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'             => array( 'slug' => $this->post_type_slug ),
		);

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register Taxonomy
	 */


	public function register_taxonomy() {
		$labels = array(
			'name'                       => _x( $this->post_type_taxonomy_plural_name, 'Taxonomy General Name', 'gmart-core' ),
			'singular_name'              => _x( $this->post_type_taxonomy_singular_name, 'Taxonomy Singular Name', 'gmart-core' ),
			'menu_name'                  => __( $this->post_type_taxonomy_plural_name, 'gmart-core' ),
			'all_items'                  => __( 'All ' . $this->post_type_taxonomy_plural_name, 'gmart-core' ),
			'parent_item'                => __( 'Parent ' . $this->post_type_taxonomy_singular_name, 'gmart-core' ),
			'parent_item_colon'          => __( 'Parent ' . $this->post_type_taxonomy_singular_name . ':', 'gmart-core' ),
			'new_item_name'              => __( 'New ' . $this->post_type_taxonomy_singular_name . ' Name', 'gmart-core' ),
			'add_new_item'               => __( 'Add New ' . $this->post_type_taxonomy_singular_name, 'gmart-core' ),
			'edit_item'                  => __( 'Edit ' . $this->post_type_taxonomy_singular_name, 'gmart-core' ),
			'update_item'                => __( 'Update ' . $this->post_type_taxonomy_singular_name, 'gmart-core' ),
			'view_item'                  => __( 'View ' . $this->post_type_taxonomy_singular_name, 'gmart-core' ),
			'separate_items_with_commas' => __( 'Separate ' . $this->post_type_taxonomy_plural_name . ' with commas', 'gmart-core' ),
			'add_or_remove_items'        => __( 'Add or remove ' . $this->post_type_taxonomy_plural_name, 'gmart-core' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'gmart-core' ),
			'popular_items'              => __( 'Popular ' . $this->post_type_taxonomy_plural_name, 'gmart-core' ),
			'search_items'               => __( 'Search ' . $this->post_type_taxonomy_plural_name, 'gmart-core' ),
			'not_found'                  => __( 'Not Found', 'gmart-core' ),
			'no_terms'                   => __( 'No ' . $this->post_type_taxonomy_plural_name, 'gmart-core' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_rest'               => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => $this->post_type_taxonomy_slug ),
		);

		register_taxonomy( $this->post_type_taxonomy, array( $this->post_type ), $args );
	}

	// Single Post Template
	public function single_template( $single_template ) {
		global $post;

		if ( $post->post_type == $this->post_type ) {
			$single_template = plugin_dir_path( __FILE__ ) . 'views/single-project.php';
		}

		return $single_template;
	}
}