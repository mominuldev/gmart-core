<?php

namespace DesignMonks\MonksMartCore\Admin\PostType;

class Footer {

	public function __construct() {
		add_action( 'init', [ $this, 'gotox_create_type_footer' ], 2 );
		add_action( 'wp_insert_post_data', [$this, 'set_default_footer_template'], 10, 2 );
	}

	public function gotox_create_type_footer() {
		register_post_type( 'dmt_footer',
			array(
				$labels = [
					'name'          => __( 'Footer', 'gmart-core' ),
					'singular_name' => __( 'Footer', 'gmart-core' ),
				],
				'labels'              => $labels,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'menu_icon'           => 'dashicons-editor-kitchensink',
				'supports'            => [ 'title', 'elementor' ],
			)
		);

		if ( $tt_js_content_types = get_option( 'dmt_js_content_types' ) ) {
			if ( ! in_array( 'dmt_footer', $tt_js_content_types ) ) {
				$tt_js_content_types[] = 'dmt_footer';
			}
			$options[] = 'dmt_footer';
			update_option( 'dmt_js_content_types', $tt_js_content_types );
		} else {
			$options = array( 'page', 'dmt_footer' );
		}

		update_post_meta( get_the_ID(), '_wp_page_template', 'elementor_canvas' );
	}


	public function set_default_footer_template( $data, $postarr ) {
		if ( 'footer' === $data['post_type'] && empty( $postarr['ID'] ) ) {
			$footer_template_id = get_page_by_title( 'Elementor Canvas', OBJECT, 'elementor_library' )->ID;
			update_post_meta( $postarr['ID'], '_elementor_template_id', $footer_template_id );
		}

		return $data;
	}
}

