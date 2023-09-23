$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Presentación');
	$('#operaciones').val('agregartalla');
	$('#titulo').val('');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Presentación');
	$('#operaciones').val('modificartalla');
	$('#id').val($(this).attr('data-id'));
	$('#titulo').val($(this).attr('data-titulo'));
	$('#modal-edit-table').modal('show');
})

