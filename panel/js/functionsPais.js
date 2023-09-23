$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Pais');
	$('#operaciones').val('agregarpais');
	$('#titulo').val('');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Pais');
	$('#operaciones').val('modificarpais');
	$('#id').val($(this).attr('data-id'));
	$('#titulo').val($(this).attr('data-titulo'));
	$('#modal-edit-table').modal('show');
})

