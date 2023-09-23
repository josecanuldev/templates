$(document).ready(function(){
	var _gratis = $('input[name="gratis"]:checked').val();
	if(_gratis == 0){
		$('.content-hidden-inputs').hide();
	}else{
		$('.content-hidden-inputs').show();
	}
})

$('input[name="gratis"]').click(function() {
	var _value = $(this).val();
	if(_value == 1){
		$('.content-hidden-inputs').show();
	}else{
		$('.content-hidden-inputs').hide();
	}
});

var _cont = 0;
function addRango(){

	var _htmlRango = '';

	for(var _i in _PAISES){
		_htmlRango += 		'<input type="hidden" name="montos[pais-'+_cont+'][]" value="'+_PAISES[_i].idPais+'">'+
							'<div class="input-group espacios">'+
							   	'<span class="input-group-addon">'+_PAISES[_i].nombre+'</span>'+
							    '<input type="text" name="montos[precio-'+_cont+'][]" data-validate="true" class="form-control apply-priceFormat" placeholder="Ingresa un precio" value="">'+
							'</div>';
	}

	var _html = '<div class="col-md-4 col-xs-12 espacios" id="rango-'+_cont+'">'+
				    '<div class="panel panel-default">'+
				    	'<div class="panel-heading">'+
				    		'Nuevo Rango'+
				            '<div class="btn-group btn-group-xs pull-right">'+
				            	'<button onclick="deleteRango('+_cont+',1)" class="btn btn-default fa fa-times"></button>'+
				            '</div>'+
				        '</div>'+
				        '<div class="panel-body">'+
				        	'<div class="input-group espacios">'+
							   	'<span class="input-group-addon">Peso Mínimo</span>'+
							       	'<input type="text" name="rango[pesoMinimo][]" data-validate="true" class="form-control apply-priceFormat" data-text="Ingresa un peso mínimo" placeholder="Ej. 1" value="">'+
								'<span class="input-group-addon">KG</span>'+
							'</div>'+
							'<div class="input-group espacios">'+
							   	'<span class="input-group-addon">Peso Máximo</span>'+
							       	'<input type="text" name="rango[pesoMaximo][]" data-validate="true" class="form-control apply-priceFormat" data-text="Ingresa un peso máximo" placeholder="Ej. 2.99" value="">'+
							   	'<span class="input-group-addon">KG</span>'+
							'</div>'+
							'<input type="hidden" name="rango[id-tmp][]" value="'+_cont+'">'+
							'<p>PRECIO PARA:</p>';
		_html += _htmlRango;				
		_html +=		'</div>'+		                    						
				    '</div>'+
				'</div>';
	$('#content-rangos').append(_html);
	initPriceFormat();
	_cont ++;			
}

function deleteRango(_id, _tipo){
	if(_tipo == 1){
		$('#rango-'+_id).remove();
	}else if(_tipo == 2){
		alertify.confirm('Antes de eliminar este rango verifique si no ha sido adquirido por un usuario, al eliminarlo puede que genere algunos conflictos con el sistema, si no desea que se muestre en la página principal oculte este rango. ¿Desea Continuar?', function (e) {
			if (e) {
				$.post('operaciones.php', {operaciones : 'deleteTransporte', idRangoTransporte : _id}, function(data){
					$('#rangoMod-'+_id).remove();
				});
			}
		});		
	}
}
function changeStatusRango(_idRango, _status){
	$.post('operaciones.php',{operaciones : 'changeStatusRango', idRango : _idRango, status : _status},function(data){
		if(_status == 1){
				$("#rango-status-"+_idRango).removeClass("fa-eye-slash").addClass('fa-eye');
				$("#rango-status-"+_idRango).attr("onclick", "changeStatusRango("+_idRango+", 0)");
				$("#rango-status-"+_idRango).tooltip('hide');		
				$("#rango-status-"+_idRango).data('bs.tooltip').options.title = 'Ocultar';
				$("#rango-status-"+_idRango).tooltip('show');	
		}else{
				$("#rango-status-"+_idRango).removeClass('fa-eye').addClass('fa-eye-slash');
				$("#rango-status-"+_idRango).attr("onclick", "changeStatusRango("+_idRango+", 1)");
				$("#rango-status-"+_idRango).tooltip('hide');
				$("#rango-status-"+_idRango).data('bs.tooltip').options.title = 'Mostrar';
				$("#rango-status-"+_idRango).tooltip('show');
			}	
	})
}
$('#addRango').click(function(){
	addRango();
})
