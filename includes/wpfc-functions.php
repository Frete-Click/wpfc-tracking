<?php

use WPFCTracking\Inludes\FreteClick;



function wpfc_enqueue_scripts(){
    
    $plugin_uri = str_replace('/includes', '' , plugin_dir_url(__FILE__));

    wp_enqueue_style('wsvp-media-query', $plugin_uri . 'views/assets/css/dms-media-query.min.css');
    wp_enqueue_style('wpfc-style', $plugin_uri . 'views/assets/css/wpfc-style.css');
}


function wpfc_tracking(){


    ?>
        <div class="dms-container">
            <div class="dms-row">
                <form  method="post">
                    <div class="dms-col-md-4 dms-col-lg-4 dms-col-xl-4 dms-col-sm-6 dms-col-xs-6 dms-col-6 wpfc-form-control">
                        <input type="tel" name="orderId" id="orderId" placeholder="Digite o número do Pedido">
                    </div>
                    <div class="dms-col-md-4 dms-col-lg-4 dms-col-xl-4 dms-col-sm-6 dms-col-xs-6 dms-col-6 wpfc-form-control">
                        <input type="tel" name="document" id="document" placeholder="Digite o CNPJ ou CPF">
                    </div>
                    <div class="dms-col-md-4 dms-col-lg-4 dms-col-xl-4 dms-col-sm-12 dms-col-xs-12 dms-col-12 wpfc-form-control">
                        <input type="submit" name="submit" id="wpfc-btnrastrear" value="RASTREAR">
                    </div>                
                </form>
            </div>
        </div>
    <?php

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

        ?>

        <div class="track-box">
            <div class="dms-container">
                <div class="dms-row">
                        <div class="dms-col-md-3 dms-col-lg-3 dms-col-xl-3 dms-col-sm-3 dms-col-xs-6 dms-col-6">
                            <div class="track-status">
                                <h2>Pedido</h2>
                                <span>#<?php echo $order['id'] ."<br>"; ?></span>
                            </div>
                        </div>
                        <div class="dms-col-md-3 dms-col-lg-3 dms-col-xl-3 dms-col-sm-3 dms-col-xs-6 dms-col-6">
                            <div class="track-status">
                                <h2>Última Alteração</h2>
                                <span>...<?php echo  $tracking_data['effectiveDateTime']?></span>
                            </div>
                        </div>
                        <div class="dms-col-md-3 dms-col-lg-3 dms-col-xl-3 dms-col-sm-3 dms-col-xs-6 dms-col-6">
                            <div class="track-status">
                                <h2>Status</h2>
                                <span><?php echo $order['orderStatus']['status']; ?></span>
                            </div>
                        </div>
                        <div class="dms-col-md-3 dms-col-lg-3 dms-col-xl-3 dms-col-sm-3 dms-col-xs-6 dms-col-6">
                            <div class="track-status">
                                <h2>Previsão de Entrega</h2>
                                <span><?php echo $order['deliveryDueDate']; ?></span>
                            </div>
                        </div>                                        
                        <div class="dms-col-md-12 dms-col-lg-12 dms-col-xl-12 dms-col-sm-12 dms-col-xs-12 dms-col-12">
                            <div class="track-content">
                            <?php 
                                foreach($result['response']['data']['tracking'] as $key2 => $tracking_data) {
                                    ?>
                                        <div class="track-status-detal">
                                            <div class="dms-col-md-4 dms-col-lg-4 dms-col-xl-4 dms-col-sm-6 dms-col-xs-6 dms-col-6">
                                                <span><?php echo $tracking_data['effectiveDateTime']; ?></span><br>
                                                <span><?php echo $tracking_data['city']; ?></span>
                                            </div>
                                            <div class="dms-col-md-8 dms-col-lg-8 dms-col-xl-8 dms-col-sm-6 dms-col-xs-6 dms-col-6">
                                                <h4><?php echo $tracking_data['details']; ?></h4>
                                                <span><?php echo $tracking_data['description']; ?></span>
                                            </div>
                                        </div>
        

                                    <?php
                                    
                                }
                            ?>
                            </div>
                        </div>

                </div>
            </div>
        </div>
            
        <?php
        




    }

    ?>

    <?php 
    
}
