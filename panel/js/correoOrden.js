function enviarCorreo(id){
	$('.buttonSend').prop('disabled',true);
	$('.buttonSend').html('<i class="fa fa-spinner fa-spin"></i>');
	var _numGuia = $('#numGuia').val();
	if(validateAnyForm('formNumGuia')){
		$.ajax({
	    	url: 'operaciones.php',
	    	type: 'POST',
	    	dataType: false,
	    	data: {operaciones: 'correoPedidoEnviado', idorden: id, numGuia : _numGuia},
	    	cache:false,
			success:function(data){
				console.log(data);
				if(data == 1){
					$('.top-right').notify({
		    			message: { text: 'Se ha notificado exitosamente el envío de la orden.' },
		    			type:'blackgloss',
		    			fadeOut: { enabled: false, delay: 3000 }
		  			}).show();
		  			$('.buttonSend').prop('disabled',false);
					$('.buttonSend').html('Enviar Confirmación');
				}else{
					$('.top-right').notify({
		    			message: { text: 'Ha ocurrido un error inténtelo de nuevo.' },
		    			type:'blackgloss',
		    			fadeOut: { enabled: false, delay: 3000 }
		  			}).show();
		  			$('.buttonSend').prop('disabled',false);
					$('.buttonSend').html('Enviar Confirmación');
				}
			}
	    })
	}else{
		$('.buttonSend').prop('disabled',false);
		$('.buttonSend').html('Enviar Confirmación');
	}
	
}
function finishOrder(id){
	var data = new FormData();
	data.append('operaciones','envioentregado');
	data.append('idorden',id);
	$.ajax({
		url:"operaciones.php",
		 type:'POST',
		 contentType:false,
		 async: false,
		 data:data,
		processData:false,
		cache:false,
		success : function(data){
			window.location.href = "http://clientes.locker.com.mx/la-anita/panel/listOrden.php";
		}
	});
}