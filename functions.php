<?php

class Hand_Built {

	private static $instance;

	public function __construct() {}

	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new Hand_Built;
			self::$instance->require_files();
			self::$instance->setup_actions();
			self::$instance->setup_filters();
		}

		return self::$instance;
	}

	private function require_files() {
		require_once dirname( __FILE__ ) . '/lib/cache-busting-magic.php';
		require_once dirname( __FILE__ ) . '/lib/timber/timber.php';
	}

	private function setup_actions() {

		add_action( 'init', function() {
			if ( ! is_admin() ) {
				show_admin_bar( false );
			}
		});

		add_action( 'template_redirect', function() {
			if ( ! is_home() ) {
				wp_safe_redirect( home_url() );
				exit;
			}

		});

		add_action( 'wp_enqueue_scripts', array( $this, 'action_wp_enqueue_scripts' ) );

		add_action( 'wp_footer', array( $this, 'action_wp_footer' ) );

	}

	private function setup_filters() {
		add_filter( 'pre_option_blogname', function() {
			return 'Hand Built';
		});

		add_filter( 'pre_option_blogdescription', function(){
			return 'Custom WordPress development, code review, data migrations, and consulting services from Daniel Bachhuber.';
		});
	}

	public function action_wp_enqueue_scripts() {

		wp_enqueue_script( 'foundation', get_stylesheet_directory_uri() . '/lib/foundation/foundation.min.js', array( 'jquery' ) );
		wp_enqueue_style( 'foundation', get_stylesheet_directory_uri() . '/lib/foundation/foundation.min.css' );

		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto+Slab:400,300,700|Open+Sans:400italic,600italic,300,400,600' );
		wp_enqueue_style( 'hand-built', get_stylesheet_uri() );

	}

	public function action_wp_footer() {

		if ( is_user_logged_in() || ( defined( 'ENVIRONMENT' ) && 'local' === ENVIRONMENT ) ) {
			return;
		}

		?>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-49623239-1', 'handbuilt.co');
			ga('send', 'pageview');

		</script>
		<?php

	}


}

/**
 * Load the theme
 */
add_action( 'after_setup_theme', 'Hand_Built' );
function Hand_Built() {
	return Hand_Built::get_instance();
}
