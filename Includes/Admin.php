<?php

namespace GPTheme\GmartCore;

use GPTheme\GmartCore\Admin\Menu;
use GPTheme\GmartCore\Admin\PostType\Footer;


class Admin {


	public function __construct() {

		if ( is_admin() ) {
//			new Menu();
		}
	}
}