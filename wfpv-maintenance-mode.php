<?php
/*
 * Plugin Name: WFPV Maintenance Mode
 * Plugin URI: http://ajalabs.com
 * Description: Display a custom Coming Soon and Maintenance page for Westchester FPV Racing when this plugin is activated.
 * Version: 1.0
 * Author: AJ
 * Author URI: http://ajalabs.com
 * License: GPL2
 *
 * @package wfpv-maintenance-mode
 * @copyright Copyright (c) 2017, AJ Acevedo
 * @license GPL2+
*/

/**
 * Maintenance Page
 *
 * Displays the coming soon page for anyone who's not logged in.
 * The login page gets excluded so that you can login if necessary.
 *
 * @return void
 */

function ng_maintenance_mode() {
	global $pagenow;
	if ( $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin() ) {
		header( 'HTTP/1.1 Service Unavailable', true, 503 );
		header( 'Content-Type: text/html; charset=utf-8' );
		if ( file_exists( plugin_dir_path( __FILE__ ) . 'views/maintenance.php' ) ) {
			require_once( plugin_dir_path( __FILE__ ) . 'views/maintenance.php' );
		}
		die();
	}
}

add_action( 'wp_loaded', 'ng_maintenance_mode' );