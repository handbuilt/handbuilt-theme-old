<?php

class Hand_Built {

	private static $instance;

	public function __construct() {}

	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new Hand_Built;
			self::$instance->setup_actions();
		}

		return self::$instance;
	}

	private function setup_actions() {

		add_action( 'init', function() {
			if ( ! is_admin() ) {
				show_admin_bar( false );
			}
		});

	} 


}

/**
 * Load the theme
 */
add_action( 'after_setup_theme', 'Hand_Built' );
function Hand_Built() {
	return Hand_Built::get_instance();
}