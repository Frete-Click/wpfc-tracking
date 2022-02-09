// Get and Show result track back
function showTrackBack(){

    var form = {
        'action':    'wpfcTracking',
        'orderId':   jQuery('#orderId').val(),
        'document':  jQuery('#document').val()    
    }

    jQuery.ajax({
        type: 'POST',
        url: ajax_object.url,
        data: form,
        success: function(response){

            response = JSON.parse(response);

            var id1 = document.getElementById('oderId-set');
            var id2 = document.getElementById('effectiveDateTime');
            var id3 = document.getElementById('orderStatus');
            var id4 = document.getElementById('deliveryDueDate');

            if(form.orderId === ""){
                jQuery('#orderId').addClass('input-error');
                jQuery('#addLoader').removeClass('loader');
            }
         
            if(form.document === ""){
                jQuery('#document').addClass('input-error');
                jQuery('#addLoader').removeClass('loader');
            }

            if(form.orderId.length >= 1 && form.document.length >= 1 ){

                Object.values(response).forEach(val => {

                    switch(val.data.order.orderStatus.status){
                        case 'quote': val.data.order.orderStatus.status = "Cotação";
                        break;
                        case 'waiting client invoice tax': val.data.order.orderStatus.status = "Aguardando nota fiscal";
                        break;
                        case 'automatic analysis': val.data.order.orderStatus.status = "Análise automática";
                        break;
                        case 'analysis': val.data.order.orderStatus.status = "Em análise";
                        break;
                        case 'waiting payment': val.data.order.orderStatus.status = "Aguardando pagamento";
                        break;
                        case 'waiting retrieve': val.data.order.orderStatus.status = "Aguardando coleta";
                        break;
                        case 'on the way': val.data.order.orderStatus.status = "Em trânsito";
                        break;
                        case 'waiting invoice tax': val.data.order.orderStatus.status = "Aguardando fatura";
                        break;
                        case 'delivered': val.data.order.orderStatus.status = "Entregue";
                        break;
                        case 'waiting billing': val.data.order.orderStatus.status = "Gerando NF";
                        break;
                        case 'canceled': val.data.order.orderStatus.status = "Cancelado";
                        break;
                        case 'waiting commission': val.data.order.orderStatus.status = "Aguardando comissão";
                        break;
                        case 'ship to carrier': val.data.order.orderStatus.status = "Entregar na transportadora";
                        break;
                        case 'retrieved': val.data.order.orderStatus.status = "Coletado";
                        break;
                        case 'expired': val.data.order.orderStatus.status = "Expirado";
                        break;
                    }
    
                    /**
                     * Alter Date
                     */
                    var alterDate = val.data.order.alterDate.date;
    
                    alterDate = new Date(alterDate);
                    alterDate = alterDate.toLocaleDateString('pt-BR', {timeZone: 'UTC'});                    
          
                    /**
                     * Delivery Due Date
                     */
                    var deliveryDueDateExtra = val.data.order.deliveryDueDate;
                    
                    deliveryDueDateExtra = new Date(deliveryDueDateExtra);
                    deliveryDueDateExtra = deliveryDueDateExtra.toLocaleDateString('pt-BR', {timeZone: 'UTC'});
                    
                    Date.prototype.addDays = function(days) {
                        var date = new Date(this.valueOf());
                        date.setDate(date.getDate() + days);
                        return date;
                    }

                    var deliveryDueDateExtra = new Date(deliveryDueDateExtra);
                    var deliveryDueDateExtra =  deliveryDueDateExtra.addDays(5);

                    var deliveryDueDateExtra =  deliveryDueDateExtra.toLocaleDateString('pt-BR', {timeZone: 'UTC'});

                    /**
                     * Show HTML
                     */                                        
                    id1.innerHTML = "#" + val.data.order.id;
                    id2.innerHTML = alterDate;
                    id3.innerHTML = val.data.order.orderStatus.status;
                    id4.innerHTML = val.data.order.deliveryDueDate + " - " + deliveryDueDateExtra;

                });

                jQuery('.track-wraper').css('display', 'block');
                jQuery('#addLoader').removeClass('loader'); 

            }
          
        }
    });
    
}

//Submit
jQuery('form').on('submit', function(e){
    e.preventDefault();

    showTrackBack();
    jQuery('.track-wraper').css('display', 'none');
    jQuery('#orderId').removeClass('input-error');
    jQuery('#document').removeClass('input-error');
    jQuery('#addLoader').addClass('loader'); 

});
