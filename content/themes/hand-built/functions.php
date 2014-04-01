<?php

class Hand_Built {

	private static $instance;

	public function __construct() {}

	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new Hand_Built;
		}

		return self::$instance;
	}


}

/**
 * Load the theme
 */
add_action( 'after_setup_theme', 'Hand_Built' );
function Hand_Built() {
	return Hand_Built::get_instance();
}