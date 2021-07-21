<?php

use WPFCTracking\Inludes\FreteClick;

function wpfc_content_form_track(){
    $pluginDir =  plugin_dir_path(__FILE__);
        
    $html = include $pluginDir . '../views/templates/form/form-track.php';

    return $html;
}

function wpfc_before_track_result(){
    $pluginDir =  plugin_dir_path(__FILE__);
        
    $html = include $pluginDir . '../views/templates/result/track-before.php';

    return $html;
}

function wpfc_after_track_result(){
    $pluginDir =  plugin_dir_path(__FILE__);
        
    $html = include $pluginDir . '../views/templates/result/track-after.php';

    return $html;
}

function wpfc_content_track_result($order, $tracking){
    $pluginDir =  plugin_dir_path(__FILE__);
        
    $html = include $pluginDir . '../views/templates/result/track-result.php';

    return $html;
}

function wpfc_tracking(){

    ob_start();

    do_action('wpfc-content-form-track');

    if(isset($_POST['submit'])){


        if(empty($_POST['orderId'])){            
            return '<spam id="invalid-data">Por favor informe o numeo do Pedido!</spam>';
        }

        if(empty($_POST['document'])){
            return '<spam id="invalid-data">Por favor informe o CNPJ ou CPF!</spam>';
        }

        $data = array(
            'orderId'   => preg_replace("/[^0-9]/","", $_POST['orderId']),
            'document'  => preg_replace("/[^0-9]/","", $_POST['document'])
        );

        $result =  FreteClick::get_track($data);

        if($result != null){
            foreach($result['response']['data']['order'] as $key => $order_data) {
                $order[$key] = $order_data;
            }
        }

        foreach($result['response']['data']['tracking'] as $tracking_data) {
            $tracking = array_reverse($tracking_data);
        }

        do_action('wpfc-before-track-result');

        do_action('wpfc-content-track-result', $order, $tracking);

        do_action('wpfc-after-track-result');

    }

    return ob_get_clean();
}

function wpfc_enqueue_scripts(){
    
    $plugin_uri = str_replace('/includes', '' , plugin_dir_url(__FILE__));

    wp_enqueue_style('wsvp-media-query', $plugin_uri . 'views/assets/css/dms-media-query.min.css');
    wp_enqueue_style('wpfc-style', $plugin_uri . 'views/assets/css/wpfc-style.css');
}
