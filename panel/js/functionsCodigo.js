/*$(document).ready(function(){
	var _value = $('input[name="tipo"]:checked').val();
	if(_value == 1){
		$('#ver-fecha').hide();
	}else if(_value == 2){
		$('#ver-fecha').show();
	}
})

$('input[name="tipo"]').click(function(){
	var _value = $(this).val();
	if(_value == 1){
		$('#ver-fecha').hide();
	}else if(_value == 2){
		$('#ver-fecha').show();
	}
})*/

$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Codigo');
	$('#operaciones').val('agregarcodigo');
	$('#nombre').val('');
	$('#fechaInicio').val('');
	$('#fechaExpiracion').val('');
	$('#fechaInicioHide').val('');
	$('#fechaExpiracionHide').val('');
	$('#limiteUso').val('');
	$('input[name="tipo"][value="1"]').prop('checked', true);
	$('input[name="tipoDescuento"][value="1"]').prop('checked', true);
	$('#descuento').val('');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Codigo');
	$('#operaciones').val('modificarcodigo');
	$('#id').val($(this).attr('data-id'));
	$('#nombre').val($(this).attr('data-titulo'));
	$('#fechaInicioHide').val($(this).attr('data-fechaInicio'));
	$('#fechaExpiracionHide').val($(this).attr('data-fechaExpiracion'));
	$('#fechaInicio').val($(this).attr('data-fechaInicioMostrar'));
	$('#fechaExpiracion').val($(this).attr('data-fechaExpiracionMostrar'));
	$('#limiteUso').val($(this).attr('data-limiteUso'));
	$('input[name="tipo"][value="'+$(this).attr('data-tipo')+'"]').prop('checked', true);
	$('input[name="tipoDescuento"][value="'+$(this).attr('data-tipoDescuento')+'"]').prop('checked', true);
	hideDescuento($(this).attr('data-tipoDescuento'));
	$('#descuento').val($(this).attr('data-descuento'));
	$('#modal-edit-table').modal('show');
})

var pickerOptsGeneral = {
	locale:  "es",
	format: 'LL',
	useCurrent: true
};

$('.apply-dateInicio').datetimepicker(pickerOptsGeneral);
$('.apply-dateExpiracion').datetimepicker(pickerOptsGeneral);

$('.apply-dateInicio').on('dp.change', function(e){
	var formatted = moment(e.date, 'LL').format('YYYY-MM-DD');
	$('#fechaInicioHide').val(formatted);
})

$('.apply-dateExpiracion').on('dp.change', function(e){
	var formatted = moment(e.date, 'LL').format('YYYY-MM-DD');
	$('#fechaExpiracionHide').val(formatted);
})

$('input[name="tipoDescuento"]').on('change', function(){
	var _value = $('input[name="tipoDescuento"]:checked').val();
	hideDescuento(_value);
})

function hideDescuento(_ver){
	(_ver == '3') ? $('#descuentoContent').hide('fast') :  $('#descuentoContent').show('fast');
}



