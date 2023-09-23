/* ========================================================================
 * functionsProducto.js v1.0.0
 * ========================================================================
 * Copyright: 2016 Luis J. Caamal 
 * License: Locker Agencia Creativa, S.A de C.V.
 *
 * Author:  Luis J. Caamal.
 * Description:
 * Scripts esclusivos para el modulo del producto.
 * ======================================================================== */

/* ========================================================
 * Inicializa el pluggin multiselect.js para seleccionar 
 * los valores de la tabla para los productos.
 * ======================================================== */
$(document).ready(function(){
	if($('#multiselect').length > 0)
		$('#multiselect').multiSelect();
	if($('#select-transporte').length > 0)
		$('#select-transporte').multiSelect();
	initPriceFormat(1);
	initPriceFormat(2);
	var _aplicarDescuento = $('input[name="aplicarDescuento"]:checked').val();
	if(_aplicarDescuento == 0){
 		$('#content-descuento').hide();
 	}else if(_aplicarDescuento == 1){
 		$('#content-descuento').show();
 	}
 	setTimeout(function(){
 		getSubcategorias()
 	},100)
 	$('.selectpicker-general').selectpicker();
})
/* ========================================================
 * Inicializa el pluggin tagsInput.js para craer los 
 * materiales del producto.
 * ======================================================== */
 if($('#inputMaterial').length > 0){
	$('#inputMaterial').tagsInput({
	    'defaultText':'Agregar Material',
	    'width':'500px'
	});
}
/* ========================================================
 * Inicializa el pluggin sortable.js para ordenar los
 * elementos en la tabla
 * ======================================================== */
 $( "#content-producto" ).sortable({
	cursor: "move",
	cursorAt: { right: 500 },
	delay: 150,
	distance: 5,
	forceHelperSize: true,
	handle: ".handle-combinacion",
	opacity: 0.5,
	revert: true,
	update : function(e, ui) {
	   	guardarOrdenCombinacion();
	}
});
if($('#tablaProducto').length > 0){
	$('#tablaProducto').dragtable({
		dragaccept:'.accept',
		persistState: function(){
			guardarOrdenColumna();
		}
	}); 
}
/* ========================================================
 * Metodo para guardar el orden de las combinaciones
 * ======================================================== */
function guardarOrdenCombinacion(){
	var _orden = new Array;   
	$(".orden-combinacion").each(function(){    
		_orden.push($(this).val());
	});
	$.post('operaciones.php',{operaciones : 'ordenarCombinacion', orden : _orden}, function(data){
		$('.bottom-right').notify({
	    	message: { text: 'Se ha guardado el orden correctamente' },
	    	type:'info',
	    	fadeOut: { enabled: true, delay: 5000 }
	  	}).show();
	})
}
/* ========================================================
 * Metodo para guardar el orden de las columnas
 * ======================================================== */
function guardarOrdenColumna(){
	var _orden = new Array; 
	var _idProducto = $('#idProducto').val();  
	$(".orden-columna").each(function(){    
		_orden.push($(this).val());
	});

	$.post('operaciones.php',{operaciones : 'ordenarColumna', orden : _orden, idProducto : _idProducto}, function(data){
		$('.bottom-right').notify({
	    	message: { text: 'Se ha guardado el orden correctamente' },
	    	type:'info',
	    	fadeOut: { enabled: true, delay: 5000 }
	  	}).show();
	})
}
/* ========================================================
 * Metodo para inicializar el tooltip.js para las 
 * combinaciones
 * ======================================================== */
$('.ver_combinacion').tooltip({
	placement: "top",
    title: "Mostrar"
});
$('.nover_combinacion').tooltip({
	placement: "top",
    title: "Ocultar"
});
/* ========================================================
 * Metodo para cambiar el status de la combinacion
 * ======================================================== */
function changeStatusCombinacion(_idCombinacion, _status){
	$.post('operaciones.php',{operaciones : 'changeStatusCombinacion', idCombinacion : _idCombinacion, status : _status},function(data){
		if(_status == 1){
				$("#combinacion-status-"+_idCombinacion).removeClass("fa-eye-slash").addClass('fa-eye');
				$("#combinacion-status-"+_idCombinacion).attr("onclick", "changeStatusCombinacion("+_idCombinacion+", 0)");
				$("#combinacion-status-"+_idCombinacion).tooltip('hide');		
				$("#combinacion-status-"+_idCombinacion).data('bs.tooltip').options.title = 'Ocultar';
				$("#combinacion-status-"+_idCombinacion).tooltip('show');	
		}else{
				$("#combinacion-status-"+_idCombinacion).removeClass('fa-eye').addClass('fa-eye-slash');
				$("#combinacion-status-"+_idCombinacion).attr("onclick", "changeStatusCombinacion("+_idCombinacion+", 1)");
				$("#combinacion-status-"+_idCombinacion).tooltip('hide');
				$("#combinacion-status-"+_idCombinacion).data('bs.tooltip').options.title = 'Mostrar';
				$("#combinacion-status-"+_idCombinacion).tooltip('show');
			}	
	})
} 
/* ========================================================
 * Función que obtiene las subcategorias relacionadas
 * con la categoria seleccionada
 * ======================================================== */
function getSubcategorias(){
	var _selectCategoria = $('#idCategoria').val();
	var _selectSubcategoria = $('#idSubcategoria');
	var _subcategoriaSelected = $('#idSubcategoriaSelected').val();
	$.post('operaciones.php', {operaciones : 'getSubcategorias', idCategoria : _selectCategoria}, function(data){
		//console.error(data);
		if(data != '[]'){
			var _resultado = JSON.parse(data);
			_selectSubcategoria.empty();
			for(var _i in _resultado){
				_selectSubcategoria.append('<option value="'+_resultado[_i].idSubcategoria+'">'+_resultado[_i].nombre+'</option>');
			}
			_selectSubcategoria.prop('disabled', false);
			_selectSubcategoria.selectpicker('refresh');
			if(_subcategoriaSelected != 0){
				console.error('entre')
				_selectSubcategoria.selectpicker('val', _subcategoriaSelected)
			}else{
				console.error('no entre')
			}
		}else{
			_selectSubcategoria.empty();
			_selectSubcategoria.append('<option selected value="0">Sin subcategorias disponibles</option>'); 
			_selectSubcategoria.prop('disabled', true);
			_selectSubcategoria.selectpicker('refresh');
		}
	})
} 

$('#idCategoria').change(function() {
	getSubcategorias();
});
/* ========================================================
 * Función para agregar los campos a la tabla de producto
 * ======================================================== */
$('#addProducto').click(function() {
	 agregarProducto();
});
var _temporalID = 1;
function agregarProducto(){
	var _tablaProducto = $('#tablaProducto > thead');
	var _contentProducto = $('#content-producto');
	var _html = '';
	var _htmlContent = '';
	$(_tablaProducto).find('th').each(function(){
		var _name = $(this).children('div').html();
		var _nameInput = $(this).attr('data-input-text');
		var _placeholder = $(this).attr('data-input-placeholder');
		if(_name === 'Opciones'){
			_htmlContent += '<td class="text-center"> <div class="btn-group btn-group-xs" role="group"> <button onclick="delProducto('+_temporalID+', \'producto-\', false)" type="button" class="btn btn-default"> <i class="fa fa-times"></i> </button> </div> </td>'
		}else if(_name === 'Precio'){
			_htmlContent += '<td>' 
			_htmlContent += '	<input id="input-price'+_temporalID+'" type="text" name="'+_name+'[]" placeholder="'+_name+'..." class="form-control apply-price" value="">'
			_htmlContent += '	<select data-id-desc="'+_temporalID+'" data-mod="" class="form-control tipoDescuento top5px"> <option value="sindescuento">Ningún descuento</option> <option value="porcentaje">Porcentaje</option> <option value="efectivo">Efectivo</option> </select>'
			_htmlContent += '	<input type="hidden" name="TipoDescuento[]" id="input-tipo-descuento'+_temporalID+'" value="sindescuento">'
			_htmlContent += '   <input style="display:none" data-id-desc="'+_temporalID+'" data-mod="" id="input-descuento-comb'+_temporalID+'" type="text" name="Descuento[]" placeholder="" class="form-control descuento-value top5px" value="0">'
			_htmlContent += ' 	<p style="display:none" class="help-block" id="precio-final-comb'+_temporalID+'">El precio final de este producto es: $<span id="precioFinalCombinacion'+_temporalID+'"><span></p>'
			_htmlContent += '</td>';
		}else if(_name === 'Peso'){
			_htmlContent += '<td> <input type="text" name="'+_name+'[]" placeholder="'+_name+'..." class="form-control apply-price" value=""> </td>';
		}else if(_name === 'Stock'){
			_htmlContent += '<td> <input type="hidden" name="temporalID[]" value="'+_temporalID+'"></input> <input type="text" name="'+_name+'[]" placeholder="'+_name+'..." class="form-control apply-price-stock" value=""> </td>';
		}else{
			_htmlContent += '<td> <input type="text" name="'+_nameInput+'-'+_temporalID+'" placeholder="'+_placeholder+'..." class="form-control" value=""> </td>';
		}
		
	})
	_html += '<tr id="producto-'+_temporalID+'">';
	_html += _htmlContent;
	_html += '</tr>';
	$(_contentProducto).append(_html);
	setTimeout(function(){
		initPriceFormat(1);
	}, 100);
	setTimeout(function(){
		initPriceFormat(2);
	}, 100);
	_temporalID ++;
}

function initPriceFormat(_tipo){
	if(_tipo == 1){
		$('.apply-price').priceFormat({
	        prefix: '',
	        thousandsSeparator: '',
	        limit: 10,
	        centsLimit: 2
	    })
	}else{
		$('.apply-price-stock').priceFormat({
	        prefix: '',
	        thousandsSeparator: '',
	        limit: 10,
	        centsLimit: 0
	    })
	}
	 
}

function delProducto(_id, _content, _bd){
	if(_bd == 'true'){
		alertify.confirm( 'Antes de eliminar este producto verifique si no ha sido adquirido por un usuario, al eliminarlo puede que genere algunos conflictos con el sistema, si no desea que se muestre en la página principal oculte este producto. ¿Desea Continuar?', function (e) {
			if (e) {
				$.post('operaciones.php',{operaciones : 'deleteCombinacion', idCombinacion : _id}, function(data){
					$('#'+_content+_id).fadeOutAndRemove(800);
				});
			}
		})
	}else{
		$('#'+_content+_id).fadeOutAndRemove(800);
	}
}

jQuery.fn.fadeOutAndRemove = function(speed){
    $(this).fadeOut(speed,function(){
        $(this).remove();
    })
}
/* ========================================================
 * Función para ocultar campos
 * ======================================================== */
$("input[name='sincombinacion']").click(function(){
	var _value = $(this).val();
	if(_value == 1){
		$('#tab-productos').hide('fast');
		$('#content-hidden-inputs').show('fast');
		$('#content-atributos-tabla').hide('fast');
		$('#precioProducto').attr('data-validate', 'true');
		$('#pesoProducto').attr('data-validate', 'true');
		$('#stockProducto').attr('data-validate', 'true');
	}else if(_value == 0 && _MOD == 1){
		$('#tab-productos').show('fast');
		$('#content-hidden-inputs').hide('fast');
		$('#content-atributos-tabla').show('fast');
		$('#precioProducto').attr('data-validate', 'false');
		$('#pesoProducto').attr('data-validate', 'false');
		$('#stockProducto').attr('data-validate', 'false');
	}else if(_value == 0 && _MOD == 0){
		$('#tab-productos').hide('fast');
		$('#content-hidden-inputs').hide('fast');
		$('#content-atributos-tabla').show('fast');
		$('#precioProducto').attr('data-validate', 'false');
		$('#pesoProducto').attr('data-validate', 'false');
		$('#stockProducto').attr('data-validate', 'false');
	}
})

/* ========================================================
 * Función para calcular descuento de un producto
 * ======================================================== */
 $('input[name="aplicarDescuento"]').change(function() {
 	var _value = $('input[name="aplicarDescuento"]:checked').val();
 	if(_value == 0){
 		$('#content-descuento').hide();
 	}else if(_value == 1){
 		$('#content-descuento').show();
 	}
 });

 $('#descuento').keyup(function() {
 	var _descuento = $(this).val();
 	var _precio = $('#precioProducto').val();
 	var _tipoDescuento = $('input[name="tipoDescuento"]:checked').val();
 	if(_tipoDescuento == 1 && _descuento != ''){
 		var _desc = (parseFloat(_precio).toFixed(2) * parseFloat(_descuento).toFixed(2)) / 100;
 		var _precioFinal = parseFloat(_precio).toFixed(2) - parseFloat(_desc).toFixed(2);
 	}else if(_tipoDescuento == 2 && _descuento !== ''){
 		var _precioFinal = parseFloat(_precio).toFixed(2) - parseFloat(_descuento).toFixed(2);
 	}else{
 		var _precioFinal = _precio;
 	}
 	$('#precioFinal').text(parseFloat(_precioFinal).toFixed(2));
 });

 /* ========================================================
 * Función para calcular descuento de una combinacion
 * ======================================================== */
 $(document).on("click", 'input[name="tipoDescuento"]', function(){
 	var _tipoDescuento = $('input[name="tipoDescuento"]:checked').val();
 	var _descuento = $('#descuento').val();
 	var _precio = $('#precioProducto').val();
 	if(_tipoDescuento == 1 && _descuento != ''){
 		var _desc = (parseFloat(_precio).toFixed(2) * parseFloat(_descuento).toFixed(2)) / 100;
 		var _precioFinal = parseFloat(_precio).toFixed(2) - parseFloat(_desc).toFixed(2);
 	}else if(_tipoDescuento == 2 && _descuento !== ''){
 		var _precioFinal = parseFloat(_precio).toFixed(2) - parseFloat(_descuento).toFixed(2);
 	}else{
 		var _precioFinal = _precio;
 	}
 	$('#precioFinal').text(parseFloat(_precioFinal).toFixed(2));
 })
 
 $(document).on("keyup", '.descuento-value', function() {
 	var _id = $(this).attr('data-id-desc');
 	var _mod = $(this).attr('data-mod');
 	var _descuento = $(this).val();
 	
 	var _precio = $('#input-price'+_mod+_id).val();
 	var _tipoDescuento = $('#input-tipo-descuento'+_mod+_id).val();
 	
 	if(_tipoDescuento === 'porcentaje' && _descuento !== ''){
 		var _desc = (parseFloat(_precio).toFixed(2) * parseFloat(_descuento).toFixed(2)) / 100;
 		var _precioFinal = parseFloat(_precio).toFixed(2) - parseFloat(_desc).toFixed(2);
 	}else if(_tipoDescuento === 'efectivo' && _descuento !== ''){
 		var _precioFinal = parseFloat(_precio).toFixed(2) - parseFloat(_descuento).toFixed(2);
 	}else{
 		var _precioFinal = _precio;
 	}
 	$('#precioFinalCombinacion'+_mod+_id).text(parseFloat(_precioFinal).toFixed(2));
 });


 /* ========================================================
 * Función agregar un producto combinacion
 * ======================================================== */

 function addCombinacionProducto(){
 	var _data = new FormData(),
 		_operaciones = $('#operacionesComb').val(),
 		_idTalla = $('#talla').val(),
 		_idCombinacion = $('#idCombinacion').val(),
 		_idProducto = $('#idProducto').val(),
 		_idColor = $('#color').val(),
 		_galeria = $('#galeria-combinaciones'),
 		_idGaleria = $('#galeria-combinaciones').find(':selected').val(),
 		_stock = $('#stock-combinacion').val(),
		_precio = $('#precio-combinacion').val(),
		_peso = $('#peso-combinacion').val(),
 		_success = true;

 	//console.log(_idTalla+'-'+_idColor+'-'+_idGaleria+'-'+_stock);
 	if(_idTalla == '')
 		_success = false;
 	else if(_idColor == '')
 		_success = false;
 	else if(_stock == '')
 		_success = false;
	else if(_precio == '' || _precio == 0)
 		_success = false;
	else if(_peso == '' || _peso == 0)
 		_success = false;		
 	else if(_idGaleria == '')
 		_success = false
 	


 	if(_success){
 		_data.append('operaciones', _operaciones);
 		_data.append('idProducto', _idProducto);
 		_data.append('idCombinacion', _idCombinacion);
 		_data.append('idTalla', _idTalla);
 		_data.append('idColor', _idColor);
 		_data.append('idGaleria', _idGaleria);
 		_data.append('stock', _stock);
		_data.append('precio', _precio);
		_data.append('peso', _peso);
 		_galeria.find(':selected').each(function() {
 			_option = $(this).val();
 			_data.append('galeria-combinacion[]', _option);
 		});

 		$.ajax({
 			url: 'operaciones.php',
 			type: 'POST',
 			processData: false,
   			contentType: false,
 			data: _data,
 			success: function(data){
 				console.log(data);
 				var _response = JSON.parse(data);
 				if(_operaciones == 'agregarCombinacion'){
 					$('#response-combinacion').append(_response[0]._html);
 					//$('#form-combinacion').reset();
 				}else{
 					$('#idCombinacion-'+_idCombinacion).html(_response[0]._html);
 				}
 				$('#myModalCombinacion').modal('hide');
 				$('#talla').val('0');
 				$('#color').val('0');
 				$('#stock-combinacion').val('0');
				$('#precio-combinacion').val('0');
				$('#peso-combinacion').val('0');
 			}
 		})
 	}else{
 		alertify.alert('Seleccione todos los campos para poder continuar')
 	}

}

$('.addCombinacion').on('click',function(){
	$('#operacionesComb').val('agregarCombinacion');
	$('#titulo-combinacion').text('Agregar Combinación')
 	$('#stock-combinacion').val('0');
	$('#precio-combinacion').val('0');
	$('#peso-combinacion').val('0');
 	$('.selectpicker').selectpicker('deselectAll')
	$('#myModalCombinacion').modal('show');
})

$(document).on('click','.trigger-edit-combinacion',function(){
	var _obj = $(this);
	$('#operacionesComb').val('modificarCombinacion');
	$('#titulo-combinacion').text('Modificar Combinación')
 	$('#talla').val(_obj.attr('data-idTalla'));
 	$('#idCombinacion').val(_obj.attr('data-idCombinacion'));
 	$('#color').val(_obj.attr('data-idColor'));
 	$('#galeria-combinaciones').val(_obj.attr('data-idGaleria'));
 	$('#stock-combinacion').val(_obj.attr('data-stock'));
	$('#precio-combinacion').val(_obj.attr('data-precio'));
	$('#peso-combinacion').val(_obj.attr('data-peso'));
 	var _galeria = _obj.data('galeria');
 	$('#galeria-combinaciones').find('option').each(function(){
 		var _ID = $(this).val()
 		if(jQuery.inArray(_ID, _galeria) !== -1){
 			$(this).attr('selected', 'selected');
 		}
 	})
 	$('.selectpicker').selectpicker('refresh')
 	$('#myModalCombinacion').modal('show');
})

$(document).on('click', '.trigger-edit', function(){
	$('.modal-title').text('Modificar Titulo Seccion');
	$('#operaciones').val('modificartituloseccion');
	$('#id').val($(this).attr('data-id'));
	$('#tituloEs').val($(this).attr('data-tituloEs'));
	$('#tituloEn').val($(this).attr('data-tituloEn'));
	$('#modal-edit-table').modal('show');
})

$(window).load(function(){
	if($('#multiselect2').length > 0)
		$('#multiselect2').multiSelect();
	
})

$(window).load(function(){
	if($('#multiselect3').length > 0)
		$('#multiselect3').multiSelect();
	
})

 

