<?php
add_shortcode('wpfc-track','wpfc_tracking');

add_action('wp_enqueue_scripts', 'wpfc_enqueue_scripts', 15);

add_action('wpfc-content-form-track','wpfc_content_form_track', 10);


add_action('wpfc-before-track-result','wpfc_before_track_result',10);
add_action('wpfc-content-track-result','wpfc_content_track_result',10, 2);
add_action('wpfc-after-track-result', 'wpfc_before_track_result',10);