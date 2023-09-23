$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Categoría');
	$('#operaciones').val('agregarcategoria');
	$('#titulo').val('');
	$('#tituloEn').val('');
	$('#frase').val('');
	$('#fraseEn').val('');
	$('#preview-slide').html('<div class="preview-example"></div>');
	if($('#tipo').val() == 2){
		$('#color').val('#000');
		$('.apply-colorPicker').colorpicker('setValue', '#000');
	}else if($('#tipo').val() == 1){
		$('#content-subcategoria').empty();
	}
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Categoría');
	$('#operaciones').val('modificarcategoria');
	$('#id').val($(this).attr('data-id'));
	$('#titulo').val($(this).attr('data-tituloEs'));
	$('#tituloEn').val($(this).attr('data-tituloEn'));
	$('#frase').val($(this).attr('data-fraseEs'));
	$('#fraseEn').val($(this).attr('data-fraseEn'));
	$('#preview-slide').html('<img width="auto" height="250px" src="../img/imgCategoria/'+$(this).attr('data-ruta')+'">');
	if($('#tipo').val() == 2){
		$('#color').val($(this).attr('data-color'));
		$('.apply-colorPicker').colorpicker('setValue', $(this).attr('data-color'));
		//setTimeout(function(){ initColorPicker(); },200)
	}else if($('#tipo').val() == 1){
		$('#content-subcategoria').empty();
		loadSub($(this).attr('data-id'));
	}

	$('#modal-edit-table').modal('show');
})

function initColorPicker(){
	$('.apply-colorPicker').colorpicker();
}

$('#add-sub').on('click', function() {
	addSub();
});

var _tmpID = 0;
function addSub(){
	var _html = '<div class="input-group espacios" id="input-'+_tmpID+'">'+
				    '<span class="input-group-addon">Título</span>'+
				    '<input type="text" name="nombre-sub[]" data-validate="true" class="form-control" placeholder="Ingresa el título de la subcategoría..." value="">'+
				    '<div class="input-group-btn">'+
				        '<div class="btn btn-default" onclick="deleteElement('+_tmpID+', \'input-\', \'\', \'false\')"> <i class="fa fa-trash"></i> </div>'+
				    '</div>'+
				'</div>';
	$('#content-subcategoria').append(_html);
	_tmpID ++;				
}

function loadSub(_idCategoria){
	$.get('operaciones.php', {operaciones : 'listSubcategoria', idCategoria : _idCategoria}, function(data) {
		console.error(data);
		$('#content-subcategoria').html(data);
	});
}
