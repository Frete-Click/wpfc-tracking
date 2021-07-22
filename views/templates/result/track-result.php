
<div class="dms-col-md-3 dms-col-lg-3 dms-col-xl-3 dms-col-sm-3 dms-col-xs-6 dms-col-6">
    <div class="wrap-track-box">
        <h2>Pedido</h2>
        <span>#<?php echo $order['id'] ."<br>"; ?></span>
    </div>
</div>
<div class="dms-col-md-3 dms-col-lg-3 dms-col-xl-3 dms-col-sm-3 dms-col-xs-6 dms-col-6">
    <div class="wrap-track-box">
        <h2>Última Alteração</h2>
        <span><?php echo  date('d-m-Y', strtotime( $tracking['effectiveDateTime'])); ?></span>
    </div>
</div>
<div class="dms-col-md-3 dms-col-lg-3 dms-col-xl-3 dms-col-sm-3 dms-col-xs-6 dms-col-6">
    <div class="wrap-track-box">
        <h2>Status</h2>
        <span><?php printf( __('%s', 'wpfc_tracking'), $order['orderStatus']['status']); ?></span>
    </div>
</div>
<div class="dms-col-md-3 dms-col-lg-3 dms-col-xl-3 dms-col-sm-3 dms-col-xs-6 dms-col-6">
    <div class="wrap-track-box">
        <h2>Previsão de Entrega</h2>
        <span><?php echo $order['deliveryDueDate']; ?></span>
    </div>
</div>                                                            
