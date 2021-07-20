<?php
/**
 * Plugin Name:			WP Tracking - Via Frete Click
 * Description:			Rastreamento de mercadoreias via Frete Click. Shortcode: [ws-viapajucara]
 * Version:				1.0.0
 * Author:				Frete Click
 * Author URI:			https://www.freteclick.com.br/
 * Requires at least:	5.3
 * Tested up to:		5.7.2
 *
 * Text Domain: wpfc-tracking
 * Domain Path: /languages
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(! is_admin()){

	require_once 'includes/wpfc-hooks.php';
	require_once 'includes/wpfc-freteclick.php';
	require_once 'includes/wpfc-functions.php';

}