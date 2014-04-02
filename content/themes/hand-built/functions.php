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

		add_action( 'wp_enqueue_scripts', array( $this, 'action_wp_enqueue_scripts' ) );

	}

	public function action_wp_enqueue_scripts() {

		wp_enqueue_script( 'foundation', get_stylesheet_directory_uri() . '/lib/foundation/foundation.min.js', array( 'jquery' ) );
		wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/lib/foundation/foundation.min.css' );

		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto+Slab:400,300,700|Open+Sans:400italic,600italic,300,400,600' );
		wp_enqueue_style( 'hand-built', get_stylesheet_uri() );

	}


}

/**
 * Load the theme
 */
add_action( 'after_setup_theme', 'Hand_Built' );
function Hand_Built() {
	return Hand_Built::get_instance();
}