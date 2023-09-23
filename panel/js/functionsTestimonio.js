$(function() {
	var mdlLista = $('#modal-edit-testimonio');

	$('.buttonagregar').click(function(event) {
		mdlLista.find('.modal-title').html('Nueva característica');
		mdlLista.find('#id').val('');
		mdlLista.find('#operaciones').val('agregartestimonio');
		mdlLista.find('#nombre').val('');
		mdlLista.find('#ubicacion').val('');
		mdlLista.find('#comentario').val('');
		mdlLista.find('#textoEn').val('');
		mdlLista.find('#preview-testimonio').html('<div style="background-color: #ddd; min-height: 180px;"></div>');
		mdlLista.find('#imagen').attr('data-validate', true);
		
		mdlLista.modal('show');
	});

	$('#table-short').on('click', '.edit', function(event) {
		var _data = $(this).data();

		mdlLista.find('.modal-title').html('Editar característica');
		mdlLista.find('#id').val(_data.id);
		mdlLista.find('#operaciones').val('actualizartestimonio');
		mdlLista.find('#nombre').val(_data.nombre);
		mdlLista.find('#ubicacion').val(_data.ubicacion);
		mdlLista.find('#comentario').val(_data.comentario);
		mdlLista.find('#textoEn').val(_data.texto);
		mdlLista.find('#preview-testimonio').html('<img src="../img/imgTestimonio/'+ _data.portada +'" class="img-responsive">');
		mdlLista.find('#imagen').attr('data-validate', false);
		
		mdlLista.modal('show');
	});
});