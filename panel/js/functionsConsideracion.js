$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Consideración');
	$('#operaciones').val('agregarconsideracion');
	$('#titulo').val('');
	$('#tituloEn').val('');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Consideración');
	$('#operaciones').val('modificarconsideracion');
	$('#id').val($(this).attr('data-id'));
	$('#titulo').val($(this).attr('data-titulo'));
	$('#tituloEn').val($(this).attr('data-tituloEn'));
	$('#modal-edit-table').modal('show');
})

