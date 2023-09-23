$(function() {
	$('.panel-heading .btn').click(function(event) {
		var _data = $(this).data();

		$.post('operaciones.php', { operaciones: 'borrarserviciogaleria', id: _data.id }, function(data, textStatus, xhr) {
			if (data.success == 3) {
				$('#galeria-'+ _data.id).fadeOut('fast', function() {
					$(this).remove();
				});
			}
		}, 'json');
	});
});