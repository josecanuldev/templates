$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Banner');
	$('#operaciones').val('agregarbanner');
	$('#MOD').val('0');
	$('#preview-slide').html('<div class="preview-example"></div>');
	$('#preview-slide-movil').html('<div class="preview-example"></div>');
	$('#titulo').val('');
	$('#tituloEn').val('');
	$('#descripcion').val('');
	$('#descripcionEn').val('');
	$('#link').val('');
	$('#linkVideo').val('');
	$('#textoBoton').val('');
	$('#textoBotonEn').val('');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Banner');
	$('#operaciones').val('modificarbanner');
	$('#MOD').val('1');
	$('#id').val($(this).attr('data-id'));
	$('#titulo').val($(this).attr('data-titulo'));
	$('#tituloEn').val($(this).attr('data-tituloEn'));
	$('#textoBoton').val($(this).attr('data-textoBoton'));
	$('#textoBotonEn').val($(this).attr('data-textoBotonEn'));
	$('#preview-slide').html('<img style="max-width:100%" width="auto" height="250px" src="../img/'+$(this).attr('data-ruta')+'">');
	($(this).attr('data-rutaMovil') != '') ? $('#preview-slide-movil').html('<img width="auto" height="250px" src="../img/imgSlide/'+$(this).attr('data-rutaMovil')+'">') : $('#preview-slide-movil').html('<div class="preview-example"></div>');

	$('#link').val($(this).attr('data-link'));
	$('#linkVideo').val($(this).attr('data-linkVideo'));

	$('#descripcion').val($(this).attr('data-descripcion'));
	$('#descripcionEn').val($(this).attr('data-descripcionEn'));

	$('#modal-edit-table').modal('show');
})
