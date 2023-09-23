$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Distribuidor');
	$('#operaciones').val('agregardistribuidor');
	$('#titulo').val('');
	$('#latitud').val('');
	$('#longitud').val('');
	$('#descripcion').val('');
	$('#content-distribuidor').empty();
	setTimeout(function(){
		initSummernote('descripcion');
	},100)
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Distribuidor');
	$('#operaciones').val('modificardistribuidor');
	$('#id').val($(this).attr('data-id'));
	$('#titulo').val($(this).attr('data-nombre'));
	$('#latitud').val($(this).attr('data-latitud'));
	$('#longitud').val($(this).attr('data-longitud'));
	$('#descripcion').val($('#desc-'+$(this).attr('data-id')).html());
	setTimeout(function(){
		initSummernote('descripcion');
	},100)
	$('#content-distribuidor').empty();
	loadDatos($(this).attr('data-id'));
	$('#modal-edit-table').modal('show');
})

$('#add-datos').on('click', function() {
	addDatos();
});

var _tmpID = 0;
function addDatos(){
	var _html = '<div class="input-group espacios" id="input-'+_tmpID+'">'+
				    '<span class="input-group-addon">Titulo</span>'+
				    '<input type="text" name="nombre-dist[]" data-validate="true" class="form-control" placeholder="Ingresa el titulo" value="">'+
				    '<span class="input-group-addon">Descripción</span>'+
				    '<input type="text" name="desc-dist[]" data-validate="true" class="form-control" placeholder="Ingresa la descripción" value="">'+
				    '<div class="input-group-btn">'+
				        '<div class="btn btn-default" onclick="deleteElement('+_tmpID+', \'input-\', \'\', \'false\')"> <i class="fa fa-trash"></i> </div>'+
				    '</div>'+
				'</div>';
	$('#content-distribuidor').append(_html);
	_tmpID ++;				
}

function loadDatos(_idDistribuidor){
	$.get('operaciones.php', {operaciones : 'listDatosDistribuidor', idDistribuidor : _idDistribuidor}, function(data) {
		console.error(data);
		$('#content-distribuidor').html(data);
	});
}

$('#modal-edit-table').on('hidden.bs.modal', function (e) {
	$('#descripcion').destroy();
})
