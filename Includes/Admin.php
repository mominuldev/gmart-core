<?php

namespace DesignMonks\MonksMartCore;

use DesignMonks\MonksMartCore\Admin\Menu;
use DesignMonks\MonksMartCore\Admin\PostType\Footer;


class Admin {


	public function __construct() {

		if ( is_admin() ) {
//			new Menu();
		}
	}
}