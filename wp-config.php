<?php

/**
 * The base configurations for WordPress.
 * 
 * Don't edit this file directly. Instead, create a wp-config-env.php file
 * for any constants you'd like to define on a per-environment basis.
 */
if ( file_exists( dirname( __FILE__ ) . '/wp-config-env.php' ) ) 
	include( dirname( __FILE__ ) . '/wp-config-env.php' );

/**
 * Make sure the HTTP_HOST context is always set for WP-CLI
 */
if ( isset( $_SERVER['WP_CLI_PHP_USED'] )
	&& ! isset( $_SERVER['HTTP_HOST'] )
	&& defined( 'PRIMARY_DOMAIN' ) ) {
	$_SERVER['HTTP_HOST'] = PRIMARY_DOMAIN;
}

/**
 *	Constants you can define in your wp-config-env.php
 */
$wp_constant_defaults = array(
	'ENVIRONMENT'        => null, // LOCAL, STAGING, PRODUCTION
	'DB_NAME'            => null,
	'DB_USER'            => null,
	'DB_PASSWORD'        => null,
	'DB_HOST'            => 'localhost',
	'DB_CHARSET'         => 'utf8',
	'DB_COLLATE'         => null,
	'AUTH_KEY'           => null,
	'SECURE_AUTH_KEY'    => null,
	'LOGGED_IN_KEY'      => null,
	'NONCE_KEY'          => null,
	'AUTH_SALT'          => null,
	'SECURE_AUTH_SALT'   => null,
	'LOGGED_IN_SALT'     => null,
	'NONCE_SALT'         => null,
	'WP_SITEURL'         => 'http://' . $_SERVER['HTTP_HOST'] . '/wp',
	'WP_HOME'            => 'http://' . $_SERVER['HTTP_HOST'],
	'WP_DEFAULT_THEME'   => 'twentytwelve',
	);
foreach( $wp_constant_defaults as $key => $value ) {
	if ( ! defined( $key ) ) {
		define( $key, $value );
	}
}

/**
 * Connecting to the database is a required part of loading WordPress
 */
$wp_required_constants = array( 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_HOST' );
foreach( $wp_required_constants as $wp_required_constant ) {
	if ( ! defined( $wp_required_constant ) ) {
		$message = "DB_NAME, DB_USER, DB_PASSWORD, and DB_HOST are required constants. If you're seeing this message, your wp-config-env.php might not be configured properly.";
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			WP_CLI::error( $message );
		} else {
			echo $message;
			exit;
		}
	}
}

/**
 * WordPress Database Table prefix.
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 */
define( 'WPLANG', '' );

/**
 * For developers: WordPress debugging mode.
 */
if ( defined( 'ENVIRONMENT' ) && 'local' == ENVIRONMENT ) {
	
	if ( ! defined( 'WP_DEBUG' ) )
		define( 'WP_DEBUG', true );

	if ( ! defined( 'SAVEQUERIES' ) )
		define( 'SAVEQUERIES', true );

} else {

	define( 'WP_DEBUG', false );

}

/**
 * Don't permit files to be edited through the WordPress admin
 * All files should go version control.
 */
define( 'DISALLOW_FILE_MODS', true );


define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', WP_HOME . '/content' );
define( 'WPMU_PLUGIN_DIR', dirname( __FILE__ ) . '/content/mu-plugins' );
define( 'WPMU_PLUGIN_URL', WP_HOME . '/content/mu-plugins' );

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );