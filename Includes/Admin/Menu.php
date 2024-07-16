<?php

namespace DesignMonks\MonksMartCore\Admin;

class Menu {

	public function __construct() {
		add_action( 'admin_menu', [$this, 'custom_menu'] );
	}

	public function custom_menu() {
		$capability  = 'manage_options';
		$parent_slug = 'dmt_core';

		$link_footer_post_type = 'edit.php?post_type=dmt_footer';
		$theme_option_link = 'admin.php?page=dmt-framework';

		add_menu_page(
			esc_html__( 'Gmart Core', 'gmart-core' ),
			esc_html__( 'Dmt', 'gmart-core' ),
			$capability,
			$parent_slug,
			[$this, 'plugin_main_page'],
			'dashicons-welcome-learn-more',
			50
		);

		// add_submenu_page(
		// 	$parent_slug,
		// 	'Theme Option',
		// 	'Theme Option',
		// 	$capability,
		// 	$theme_option_link
		// );

		// add_submenu_page(
		// 	$parent_slug,
		// 	'Footer Layout', //page title
		// 	'Footer Layout', //menu title
		// 	$capability, //capability,
		// 	$link_footer_post_type //callback function
		// );
	}

	public function plugin_main_page() {
		include __DIR__ . '/Views/plugin-page.php';
	}
}