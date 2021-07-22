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
            $error =  '<spam id="invalid-data">Por favor informe o numeo do Pedido!</spam>';        
        }

        if(!empty($_POST['orderId']) && empty($_POST['document'])){
            $error = '<spam id="invalid-data">Por favor informe o CNPJ ou CPF!</spam>';
        }

        do_action('wpfc-before-track-result');

        echo "<div id='track-error-box'>{$error}</div>";

        if(empty($error)){

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

            switch($order['orderStatus']['status']){
                case 'quote': $order['orderStatus']['status'] = "Cotação";
                break;
                case 'waiting client invoice tax': $order['orderStatus']['status'] = "Aguardando nota fiscal";
                break;
                case 'automatic analysis': $order['orderStatus']['status'] = "Análise automática";
                break;
                case 'analysis': $order['orderStatus']['status'] = "Em análise";
                break;
                case 'waiting payment': $order['orderStatus']['status'] = "Aguardando pagamento";
                break;
                case 'waiting retrieve': $order['orderStatus']['status'] = "Aguardando coleta";
                break;
                case 'on the way': $order['orderStatus']['status'] = "Em trânsito";
                break;
                case 'waiting invoice tax': $order['orderStatus']['status'] = "Aguardando fatura";
                break;
                case 'delivered': $order['orderStatus']['status'] = "Entregue";
                break;
                case 'waiting billing': $order['orderStatus']['status'] = "Gerando NF";
                break;
                case 'canceled': $order['orderStatus']['status'] = "Cancelado";
                break;
                case 'waiting commission': $order['orderStatus']['status'] = "Aguardando comissão";
                break;
                case 'ship to carrier': $order['orderStatus']['status'] = "Entregar na transportadora";
                break;
                case 'retrieved': $order['orderStatus']['status'] = "Coletado";
                break;
            }

            do_action('wpfc-content-track-result', $order, $tracking);

            
        }

        do_action('wpfc-after-track-result');


    }

    return ob_get_clean();
}

function wpfc_load_textdomain() {
    load_plugin_textdomain( 'wpfc_tracking', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

function wpfc_enqueue_scripts(){
    
    $plugin_uri = str_replace('/includes', '' , plugin_dir_url(__FILE__));

    wp_enqueue_style('wsvp-media-query', $plugin_uri . 'views/assets/css/dms-media-query.min.css');
    wp_enqueue_style('wpfc-style', $plugin_uri . 'views/assets/css/wpfc-style.css');
}
