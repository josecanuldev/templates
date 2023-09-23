$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Etiqueta');
	$('#operaciones').val('agregaretiqueta');
	$('#tituloEs').val('');
	$('#tituloEn').val('');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Etiqueta');
	$('#operaciones').val('modificaretiqueta');
	$('#id').val($(this).attr('data-id'));
	$('#tituloEs').val($(this).attr('data-tituloEs'));
	$('#tituloEn').val($(this).attr('data-tituloEn'));
	$('#modal-edit-table').modal('show');
})