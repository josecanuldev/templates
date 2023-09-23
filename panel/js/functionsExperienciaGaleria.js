$(function() {
	var mdlLista = $('#modal-edit-slider');

	$('.buttonagregar').click(function(event) {
		mdlLista.find('.modal-title').html('Nuevo slider');
		mdlLista.find('#id').val('');
		mdlLista.find('#operaciones').val('agregarExperienciaSlider');
		mdlLista.find('#titulo').val('');
		mdlLista.find('#preview-slider').html('<div style="background-color: #ddd; min-height: 180px;"></div>');
		mdlLista.find('#imagen').attr('data-validate', true);
		
		mdlLista.modal('show');
	});

	$('#table-short').on('click', '.edit', function(event) {
		var _data = $(this).data();
		
		mdlLista.find('.modal-title').html('Editar slider');
		mdlLista.find('#id').val(_data.id);
		mdlLista.find('#operaciones').val('actualizarExperienciaSlider');
		mdlLista.find('#titulo').val(_data.titulo);
		mdlLista.find('#preview-slider').html('<img src="../img/imgSlider/'+ _data.portada +'" class="img-responsive">');
		mdlLista.find('#imagen').attr('data-validate', false);
		
		mdlLista.modal('show');
	});
});