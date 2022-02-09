<?php
/**
 * Plugin Name:			Frete Click - Tracking
 * Description:			Consulte a situação da entrega de um ou mais objetos. Shortcode: [wpfc-track]
 * Version:				1.0.10
 * Author:				Frete Click
 * Author URI:			https://www.freteclick.com.br/
 * Requires at least:	5.0
 * Tested up to:		5.9
 * Requires PHP: 		7.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
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