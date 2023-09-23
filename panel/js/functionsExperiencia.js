$(function() {
	initDatepicker();

	var listaResenias = $('#preview-resenias');
	var listaRanges = $('#preview-range');

	$('#btn-resenia').click(function(event) {
		var _index = listaResenias.find('div[class^="col-"]:last-child > .panel').data('id');
		_index = (isNaN(_index)) ? 0 : _index;
		// console.log(_index);
		var _resenia = '<div class="col-md-6">' +
							'<div class="panel panel-default" data-id="'+ (_index + 1) +'">' +
								'<div class="panel-heading">' +
    								'<h3 class="panel-title">Nueva característica</h3>' +
    							'</div>' +
								'<div class="panel-body">' +
									'<div class="row">' +
										'<div class="col-md-12">' +
											'<input type="hidden" name="resenia[id][]" id="" value="0">' +
											'<div class="input-group espacios">' +
					                        	'<span class="input-group-addon">Título</span>' +
					                        	'<input type="text" name="resenia[nombre][]" data-validate="false" class="form-control" placeholder="Ingresa el título" value="">' +
					                        '</div>' +
										'</div>' +
										'<div class="col-md-12">' +
											'<div class="input-group espacios">' +
					                        	'<span class="input-group-addon">Título en inglés</span>' +
					                        	'<input type="text" name="resenia[fecha][]" data-validate="false" class="form-control" placeholder="Ingresa el título en inglés" value="">' +
					                        '</div>' +
										'</div>' +
										'<div class="col-md-12">' +
											'<div class="input-group espacios">' +
					                        	'<span class="input-group-addon">Descripci&oacute;n</span>' +
					                        	'<textarea name="resenia[texto][]" id="" rows="3" class="form-control" placeholder="Ingresa la descripci&oacute;n"></textarea>' +
					                        '</div>' +
										'</div>' +
										'<div class="col-md-12">' +
											'<div class="input-group espacios">' +
					                        	'<span class="input-group-addon">Descripci&oacute;n inglés</span>' +
					                        	'<textarea name="resenia[textoEn][]" id="" rows="3" class="form-control" placeholder="Ingresa la descripci&oacute;n en inglés"></textarea>' +
					                        '</div>' +
										'</div>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</div>';

		listaResenias.append(_resenia);
		initDatepicker();
	});

	var previewRanges = $('#preview-range');
	$('#btn-range').click(function(event) {
		var _index = listaRanges.find('div[class^="col-"]:last-child > .panel').data('id');
		_index = (isNaN(_index)) ? 0 : _index;

		var _range = '<div class="col-md-6 col-sm-12">' +
        				'<div class="panel panel-default" data-id="'+ (_index + 1) +'">' +
        					'<div class="panel-heading">' +
        						'<h3 class="panel-title">Nueva tarifa</h3>' +
        					'</div>' +
        					'<div class="panel-body">' +
        						'<div class="row">' +
									'<div class="col-md-12 col-sm-12">' +
                						'<div class="form-group">' +
                    						'<div class="input-group">' +
                    							'<span class="input-group-addon">Pasajeros</span>' +
                    							'<input type="number" name="precios[periodo1][]" data-validate="true" class="form-control" placeholder="Pasajeros" value="">' +
					                        '</div>' +
					                    '</div>' +
                					'</div>' +
									'<div class="col-md-12 col-sm-12">' +
                						'<div class="form-group">' +
                    						'<div class="input-group">' +
                    							'<span class="input-group-addon">Tipo de viaje</span>' +
																	'<select name="precios[horaEn][]" data-validate="true" class="form-control"><option value="Sencillo">Sencillo</option><option value="Redondo">Redondo</option></select>'+
					                        '</div>' +
					                    '</div>' +
                					'</div>' +
                					'<div class="col-md-12 col-sm-12">' +
                						'<input type="hidden" name="precios[id][]" id="" value="0">' +
                						'<div class="form-group">' +
    										'<div class="input-group">' +
					                        	'<span class="input-group-addon">Precio MXN</span>' +
					                        	'<input type="number" name="precios[concepto][]" data-validate="true" class="form-control" placeholder="Precio MXN">' +
					                        '</div>' +
					                    '</div>' +
                					'</div>' +
									'<div class="col-md-12 col-sm-12">' +
                						'<div class="form-group">' +
    										'<div class="input-group">' +
					                        	'<span class="input-group-addon">Precio USD</span>' +
					                        	'<input type="number" name="precios[conceptoEn][]" data-validate="true" class="form-control" placeholder="Precio USD">' +
					                        '</div>' +
					                    '</div>' +
                					'</div>' +
                					'<!-- <div class="col-md-6 col-sm-12">' +
                						'<div class="form-group">' +
                    						'<div class="input-group">' +
                    							'<span class="input-group-addon">Periodo 2</span>' +
                    							'<input type="number" name="precios[periodo2][]" data-validate="false" class="form-control" placeholder="Precio" value="">' +
					                        	'<span class="input-group-addon">USD</span>' +
					                        '</div>' +
					                    '</div>' +
                					'</div> -->' +
            					'</div>' +
        					'</div>' +
        				'</div>' +
        			'</div>';

    	previewRanges.append(_range);

		setTimeout(function(){
		  initS();
		}, 500);
	});

	var previewPrizes = $('#preview-prizes');
	$('#btn-premio').click(function(event) {
		var _premio = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">' +
						'<div class="panel panel-default">' +
							'<div class="panel-heading">' +
								'<h3 class="panel-title">Premio nuevo</h3>' +
								'<input type="hidden" name="premios[id][]" value="0">' +
								'<input type="hidden" name="premios[periodo][]" value="">' +
							'</div>' +
							'<div class="panel-body">' +
								'<div class="input-group espacios">' +
									'<span class="input-group-addon">T&iacute;tulo</span>' +
									'<input type="text" name="premios[titulo][]" id="" class="form-control" value="" placeholder="Ingresa el t&iacute;tulo" data-validate="true">' +
								'</div>' +
								'<div class="input-group espacios">' +
									'<span class="input-group-addon">Descripci&oacute;n</span>' +
									'<textarea name="premios[descripcion][]" id="" rows="3" class="form-control" placeholder="Ingresa la descripc&iacute;on" data-text="Ingresa la descripc&iacute;on" data-summer="false" data-politix="false" data-validate="true"></textarea>' +
								'</div>' +
							'</div>' +
						'</div>' +
					'</div>';

		previewPrizes.append(_premio);
	});

	var previewSchedule = $('#preview-schedule');
	$('#btn-agenda').click(function(event) {
		var _agenda = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">' +
						'<div class="panel panel-default">' +
							'<div class="panel-heading">' +
								'<h3 class="panel-title">Agenda nuevo</h3>' +
								'<input type="hidden" name="agenda[id][]" value="0">' +
							'</div>' +
							'<div class="panel-body">' +
								'<div class="input-group espacios">' +
									'<span class="input-group-addon">T&iacute;tulo</span>' +
									'<input type="text" name="agenda[titulo][]" id="" class="form-control" value="" placeholder="Ingresa el t&iacute;tulo" data-validate="true">' +
								'</div>' +
								'<div class="input-group espacios">' +
									'<span class="input-group-addon">Periodo</span>' +
									'<input type="text" name="agenda[periodo][]" id="" class="form-control" value="" placeholder="Ingresa el periodo" data-validate="true">' +
								'</div>' +
								'<div class="input-group espacios">' +
									'<span class="input-group-addon">Descripci&oacute;n</span>' +
									'<textarea name="agenda[descripcion][]" id="" rows="3" class="form-control" placeholder="Ingresa la descripc&iacute;on" data-text="Ingresa la descripc&iacute;on" data-summer="false" data-politix="false" data-validate="true"></textarea>' +
								'</div>' +
							'</div>' +
						'</div>' +
					'</div>';

		previewSchedule.append(_agenda);
	});

	var previewRules = $('#preview-rules');
	$('#btn-regla').click(function(event) {
		var _regla = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">' +
						'<div class="panel panel-default">' +
							'<div class="panel-heading">' +
								'<h3 class="panel-title">Regla nueva</h3>' +
								'<input type="hidden" name="reglas[id][]" value="0">' +
								'<input type="hidden" name="reglas[periodo][]" value="">' +
							'</div>' +
							'<div class="panel-body">' +
								'<div class="input-group espacios">' +
									'<span class="input-group-addon">T&iacute;tulo</span>' +
									'<input type="text" name="reglas[titulo][]" id="" class="form-control" value="" placeholder="Ingresa el t&iacute;tulo" data-validate="true">' +
								'</div>' +
								'<div class="input-group espacios">' +
									'<span class="input-group-addon">Descripci&oacute;n</span>' +
									'<textarea name="reglas[descripcion][]" id="" rows="3" class="form-control" placeholder="Ingresa la descripc&iacute;on" data-text="Ingresa la descripc&iacute;on" data-summer="false" data-politix="false" data-validate="true"></textarea>' +
								'</div>' +
							'</div>' +
						'</div>' +
					'</div>';

		previewRules.append(_regla);
	});

	// Borrar imagen galeria
	$('.btn-del-slide').click(function(event) {
		var _id = $(this).data('id');
		var _seccion = $('input[name^="seccion"]').val();

		$.post('operaciones.php', { operaciones: 'borrarGaleriaExperiencia', id: _id, seccion: _seccion }, function(data, textStatus, xhr) {
			if (data.success == 3) {
				$('#galeria-'+ _id).fadeOut('fast', function() {
					$(this).remove();
				});
			}
		}, 'json');
	});

	// Borrar reseña
	$('.btn-del-resenia').click(function(event) {
		var _id = $(this).data('id');

		$.post('operaciones.php', { operaciones: 'borrarReseniaExperiencia', id: _id }, function(data, textStatus, xhr) {
			if (data.success == 3) {
				$('#resenia-'+ _id).fadeOut('fast', function() {
					$(this).remove();
				});
			}
		}, 'json');
	});

	// Borrar tarifa
	$('.btn-del-tarifa').click(function(event) {
		var _id = $(this).data('id');

		$.post('operaciones.php', { operaciones: 'borrarTarifaExperiencia', id: _id }, function(data, textStatus, xhr) {
			if (data.success == 3) {
				$('#tarifa-'+ _id).fadeOut('fast', function() {
					$(this).remove();
				});
			}
		}, 'json');
	});

	function initDatepicker() {
		$('.datepicker').datetimepicker({
			locale:  "es",
			format: 'LL',
			useCurrent: false
		});

		$('.datepicker').on('dp.change', function(event) {
			var _id = $(this).attr('id');
			var _formatted = moment(event.date, 'LL').format('YYYY-MM-DD');
			$('#'+ _id +'-2').val(_formatted);

			event.preventDefault();
		});
	}
})
