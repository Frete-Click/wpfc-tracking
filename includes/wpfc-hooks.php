<?php

add_action( 'plugins_loaded', 'wpfc_load_textdomain' );
add_shortcode('wpfc-track','wpfc_createAjaxShortcode');
add_action('wpfc-content-form-track','wpfc_content_form_track', 10, 1);
add_action('wpfc-content-track-result','wpfc_content_track_result',10, 2);
add_action('wp_enqueue_scripts', 'wpfc_enqueue_scripts');