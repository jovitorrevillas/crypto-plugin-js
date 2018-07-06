<?php

/*
Plugin Name: Ibinex Crypto Calculator
Plugin URI: https://ibinex.com/
Description: Simple but flexible crypto currency display and calculator
Author: IbinexPH
Author URI: https://ibinex.com/
Text Domain: ibinex-crypto-calculator
Version: 1.0.0
*/

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if (file_exists($composer = __DIR__.'/vendor/autoload.php')) {
	require_once $composer;
}

define( 'IBINEX_CC_PLUGIN', __FILE__ );
define( 'IBINEX_CC_PLUGIN_DIR', untrailingslashit( dirname( IBINEX_CC_PLUGIN ) ) );
define( 'IBINEX_CC_PLUGIN_CALL', plugin_dir_url(__FILE__) );

require_once IBINEX_CC_PLUGIN_DIR . '/settings.php';