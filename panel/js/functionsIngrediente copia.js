$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Ingrediente');
	$('#operaciones').val('agregaringrediente');
	$('#titulo').val('');
	$('#tituloEn').val('');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Ingrediente');
	$('#operaciones').val('modificaringrediente');
	$('#id').val($(this).attr('data-id'));
	$('#titulo').val($(this).attr('data-titulo'));
	$('#tituloEn').val($(this).attr('data-tituloEn'));
	$('#modal-edit-table').modal('show');
})

