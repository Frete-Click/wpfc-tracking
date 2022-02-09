<?php
/**
 * Plugin Name:			WP Tracking - Via Frete Click
 * Description:			Rastreamento de mercadoreias via Frete Click. Shortcode: [wpfc-track]
 * Version:				1.0.10
 * Author:				Frete Click
 * Author URI:			https://www.freteclick.com.br/
 * Requires at least:	5.0
 * Tested up to:		5.9
 *
 * Text Domain: wpfc_tracking
 * Domain Path: /languages
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once 'includes/wpfc-hooks.php';
require_once 'includes/wpfc-freteclick.php';
require_once 'includes/wpfc-functions.php';