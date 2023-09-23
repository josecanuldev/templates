$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Incentivo');
	$('#operaciones').val('agregarincentivo');
	$('#MOD').val('0');
	$('#preview-slide').html('<div class="preview-example"></div>');
	$('#preview-slide-movil').html('<div class="preview-example"></div>');
	$('#titulo').val('');
	$('#tituloEn').val('');
	$('#descripcion').val('');
	$('#descripcionEn').val('');
	$('#link').val('');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Incentivo');
	$('#operaciones').val('modificarincentivo');
	$('#MOD').val('1');
	$('#id').val($(this).attr('data-id'));
	$('#titulo').val($(this).attr('data-titulo'));
	$('#tituloEn').val($(this).attr('data-tituloEn'));
	$('#preview-slide').html('<img width="auto" height="250px" src="../img/imgIncentivo/'+$(this).attr('data-ruta')+'">');
	($(this).attr('data-rutaMovil') != '') ? $('#preview-slide-movil').html('<img width="auto" height="250px" src="../img/imgIncentivo/'+$(this).attr('data-rutaMovil')+'">') : $('#preview-slide-movil').html('<div class="preview-example"></div>');
	
	$('#link').val($(this).attr('data-link'));
	
	$('#descripcion').val($(this).attr('data-descripcion'));
	$('#descripcionEn').val($(this).attr('data-descripcionEn'));

	$('#modal-edit-table').modal('show');
})