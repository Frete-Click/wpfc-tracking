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
    
                    var alterDate = val.data.order.alterDate.date;
    
                    alterDate = new Date(alterDate);
                    alterDate = alterDate.toLocaleDateString('pt-BR', {timeZone: 'UTC'});

                    var deliveryDueDate = val.data.order.deliveryDueDate;


                    const deliveryDueDateSplit = deliveryDueDate.split('/');

                    const day = deliveryDueDateSplit[0]; 
                    const month = deliveryDueDateSplit[1]; 
                    const year = deliveryDueDateSplit[2]; 

                    deliveryDueDate = new Date(day,month, year);
                    deliveryDueDate =  deliveryDueDate.toLocaleDateString('pt-BR', {timeZone: 'UTC'});


    
                    id1.innerHTML = "#" + val.data.order.id;
                    id2.innerHTML = alterDate;
                    id3.innerHTML = val.data.order.orderStatus.status;
                    id4.innerHTML = deliveryDueDate;

                    console.log(val.data.order.deliveryDueDate);
             
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
