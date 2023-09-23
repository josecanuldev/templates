$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Color');
	$('#operaciones').val('agregarcolor');
	$('#MOD').val('0');
	$('#preview-color').html('<div class="preview-example"></div>');
	$('#nombre').val('');
	$('#color').val('#000');
	$('.apply-colorPicker').colorpicker('setValue', '#000');
	$('.bootstrap-select').show();
	$('.content-color').hide('fast');
	$('.content-img').hide('fast');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Color');
	$('#operaciones').val('modificarcolor');
	$('#MOD').val('1');
	$('#id').val($(this).attr('data-id'));
	$('#nombre').val($(this).attr('data-nombre'));
	$('#preview-color').html('<img width="auto" height="250px" src="../img/colores/'+$(this).attr('data-ruta')+'">');
	$('#color').val($(this).attr('data-color'));
	$('.apply-colorPicker').colorpicker('setValue', $(this).attr('data-color'));
	$('.bootstrap-select').hide();
	$('#tipoColor').attr('data-validate', 'false');
	if($(this).attr('data-tipo') == 'solido'){
		$('.content-color').show('fast');
		$('.content-img').hide('fast');
	}else{
		$('.content-color').hide('fast');
		$('.content-img').show('fast');
	}
	$('#modal-edit-table').modal('show');
})

$('#tipoColor').on('change',function(){
	var _value = $(this).val();
	if(_value == 'solido'){
		$('.content-color').show('fast');
		$('.content-img').hide('fast');
		$('#patron').attr('data-validate', 'false');
		$('#color').attr('data-validate', 'true');
	}else{
		$('.content-color').hide('fast');
		$('.content-img').show('fast');
		$('#patron').attr('data-validate', 'true');
		$('#color').attr('data-validate', 'false');
	}
		
})

function initColorPicker(){
	$('.apply-colorPicker').colorpicker();
}