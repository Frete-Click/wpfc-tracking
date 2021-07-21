<?php
add_shortcode('wpfc-track','wpfc_tracking');

add_action('wp_enqueue_scripts', 'wpfc_enqueue_scripts', 1000);

