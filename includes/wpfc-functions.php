<?php

use WPFCTracking\Inludes\FreteClick;

function wpfc_content_form_track(){
    $pluginDir =  plugin_dir_path(__FILE__);
        
    $html = include $pluginDir . '../views/templates/form/form-track.php';

    return $html;
}

function wpfc_content_track_result(){
    $pluginDir =  plugin_dir_path(__FILE__);
        
    $html = include $pluginDir . '../views/templates/result/track-result.php';

    return $html;
}

function wpfc_load_textdomain() {
    load_plugin_textdomain( 'wpfc_tracking', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

function wpfc_enqueue_scripts(){
    
    $plugin_uri = str_replace('/includes', '' , plugin_dir_url(__FILE__));

    wp_enqueue_style('wsvp-media-query', $plugin_uri . 'views/assets/css/dms-media-query.min.css');
    wp_enqueue_style('wpfc-style', $plugin_uri . 'views/assets/css/wpfc-style.css');


    wp_enqueue_script('wpfc-js-mask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('wpfc-mask', $plugin_uri . 'views/assets/js/wpfc-mask.js', array('jquery'), '1.0.2', true); 
    wp_enqueue_script('wpfc-tracking', $plugin_uri . 'views/assets/js/wpfc-tracking.js', array('jquery'), null, true);

    wp_localize_script('wpfc-tracking', 'ajax_object', array(
        'url' => admin_url("admin-ajax.php")
    ));

}

function wpfc_createAjaxShortcode()
{
    ob_start();
    
    do_action('wpfc-content-form-track');

    do_action('wpfc-before-track-result');
    do_action('wpfc-content-track-result');
    do_action('wpfc-after-track-result');

    return ob_get_clean();
}


function wpfcTracking(){

    $data = array(
        'orderId'   => preg_replace("/[^0-9]/","", $_POST['orderId']),
        'document'  => preg_replace("/[^0-9]/","", $_POST['document'])
    );

    $res = FreteClick::get_track($data);

    echo json_encode($res);

    wp_die();
}

add_action('wp_ajax_wpfcTracking', 'wpfcTracking');
add_action('wp_ajax_nopriv_wpfcTracking', 'wpfcTracking');