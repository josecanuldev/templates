<?php
// Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/styles.scss');
Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css?v='.time());
Yii::app()->clientScript->registerCssFile('https://unpkg.com/dropzone@5/dist/min/dropzone.min.css?v='.time());
Yii::app()->clientScript->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css');
Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css');
$this->breadcrumbs=array(
	'Tarifas'=>array('index'),
	'Create',
);
$id = -1;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
// echo '<textarea>'.CJSON::encode($model).'</textarea>';
?>
<style>
	body {
		color: #212529 !important;
	}
	legend {
		font-size: 1rem !important;
	}
	.form-tarifas label {
		font-size: 14px !important;
	}
	#userTab li a {
		color: #212529 !important;
	}
	#userTabContent {
		padding: 16px !important;
	}

	.datepicker td, .datepicker th {
		width: 2.5rem;
		height: 2.5rem;
		font-size: 0.85rem;
	}

	.datepicker {
		margin-bottom: 3rem;
	}

	.datepicker-dropdown {
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
	}

	/* tabs	*/
	.catgtbl {
		font-size: 14px;
	}
	
	.catgtbl button {
		padding: 1px 5px;
    	font-size: 12px;
    	line-height: 1.5;
	}

	table {
		background-color: transparent;
	}

	table {
		border-spacing: 0;
		border-collapse: collapse;
	}

	.table-bordered > thead > tr > th {
		border-color: #e7e8ea;
	}

	.md-whiteframe-z1 {
		box-shadow: none;
	}

	.table-bordered {
		border-color: #e7e8ea;
	}

	.table-bordered {
		border: 1px solid #ddd;
	}

	.table-condensed > thead > tr > th, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > td {
		padding: 8px;
	}

	/*.ck-editor__editable_inline {
		height: 400px;
	}*/

</style>

<div id="app" class="font-weight-bold">
	<section class="bg-light text-left">
		<div class="container pb-5 mt-4" style="max-width: 1250px;">
			<div class="form-tarifas">
				<div class="row">
					<div class="col-12 col-md-9 col-lg-9">
						<div class="row">
							<div class="col-12 col-md-6 col-lg-6">
								<?php if (isset($_GET['id'])): ?>
									<h4>Ruta <?=$model->idRuta->Origen->name?> - <?=$model->idRuta->Destino->name?></h4>
								<?php else: ?>
									<h4>Nueva Tarifa</h4>
								<?php endif ?>
							</div>
							<div class="col-12 col-md-6 col-lg-6 text-right">
								<div class="row p-0">
									<div class="col-3 p-0">
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rutas">
										  Rutas
										</button>
									</div>
									<div class="col-4 p-0">
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#horarios">
										  Horarios Colectivos
										</button>
									</div>
									<div class="col-2 p-0">
										<a href="<?=Yii::app()->createUrl('site')?>" class="btn btn-primary btn-sm">
										  SAMMY
										</a>
									</div>
									<div class="col-2 p-0 d-block d-sm-none d-none d-sm-block d-md-none">
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tarifario">
										  Tarifas
										</button>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<?php echo $this->renderPartial('_form', array('model'=>$model, 'categorias' => $categorias, 'rutas' => $rutas)); ?>
					</div>
					<div class="col-12 col-md-3 col-lg-3 border-left aside-tarifas d-none d-sm-block d-sm-none d-md-block">
						<div class="row border-bottom pb-2">
							<div class="col-12 col-md-6 col-lg-6 text-left">
								Tarifas
							</div>
							<div class="col-12 col-md-6 col-lg-6 text-right">
								<a href="<?=Yii::app()->createUrl('tarifas')?>" class="btn btn-primary btn-sm pull-right">Nueva Tarifa</a>
							</div>
							<div class="col-12 pt-2">
								<div class="input-group mb-3">
								  <input type="text" class="form-control" name="search" aria-label="buscar tarifa" aria-describedby="basic-addon2" autocomplete="false">
								  <div class="input-group-append">
								    <button class="btn btn-outline-secondary" type="button" onclick="handleSearch()">Buscar</button>
								  </div>
								</div>
							</div>
						</div>
						<div id="listadoTarifas"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="modal fade" id="rutas" tabindex="-1" aria-labelledby="rutasLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="rutasLabel">Rutas</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="font-size: 14px;">
	      	<div id="success_ruta" class="alert alert-success alert-dismissible fade show d-none" role="alert">
			  <strong>Exito!</strong> Ruta guardada exitosamente
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div id="error_ruta" class="alert alert-success alert-dismissible fade show d-none" role="alert">
			  <strong>Error!</strong> Ocurrió un error en el servidor, intente más tarde.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
	        <!-- <span style="font-size: 16px;">Agregar ruta</span> -->
	        <form action="<?=Yii::app()->createUrl('rutas/create')?>" method="post" id="formRutas">
		        <div class="row mt-2">
		        	<div class="col-12 col-lg-5">
						<label for="Rutas_id_origen" class="required">Origen <span class="required">*</span></label>
						<select class="form-control" name="Rutas[id_origen]" id="Rutas_id_origen" style="font-size: 14px;">
							<?php foreach ($destinos as $key => $row) { ?>
								<option value="<?=$row->id?>">
									<?=$row->name?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-lg-5">
						<label for="Rutas_id_destino" class="required">Destino <span class="required">*</span></label>
						<select class="form-control" name="Rutas[id_destino]" id="Rutas_id_destino" style="font-size: 14px;">
							<?php foreach ($destinos as $key => $row) { ?>
								<option value="<?=$row->id?>">
									<?=$row->name?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-12 col-lg-2 text-right mt-4">
						<button type="button" class="btn btn-primary btn-sm" onclick="guardarRuta()">Guardar</button>
					</div>
					<div class="col-12">
						<div id="listadoRutas" style="font-size:14px;"></div>
					</div>
		        </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Horarios -->
	<div class="modal fade" id="horarios" tabindex="-1" aria-labelledby="horariosLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="horariosLabel">Horarios</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="font-size: 14px;">
	      	<div id="success_horarios" class="alert alert-success alert-dismissible fade show d-none" role="alert">
			  <strong>Exito!</strong> Horario guardada exitosamente
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div id="error_horarios" class="alert alert-success alert-dismissible fade show d-none" role="alert">
			  <strong>Error!</strong> Ocurrió un error en el servidor, intente más tarde.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
	        <!-- <span style="font-size: 16px;">Agregar horario</span> -->
	        <form action="<?=Yii::app()->createUrl('horarios/create')?>" method="post" id="formHorarios">
		        <div class="row mt-2">
		        	<div class="col-6 col-lg-3">
						<label for="Horarios_horario" class="required">Horario <span class="required">*</span></label>
						<div class="form-group">
							<div class="input-group date" id="datetimepickerHorario" data-target-input="nearest" >
								<input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerHorario" value="" id="Horarios_horario" data-toggle="datetimepicker">
								<div class="input-group-append" data-target="#datetimepickerHorario" data-toggle="datetimepicker">
									<div class="input-group-text">
										<i class="fas fa-clock"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<label for="Horarios_tipo" class="required">Tipo <span class="required">*</span></label>
						<select class="form-control" name="Horarios[tipo]" id="Horarios_tipo" style="font-size: 14px;">
							<option value="0">Llegada</option>
							<option value="1">Salida</option>
						</select>
					</div>
					<div class="col-6 col-lg-3">
						<label for="Horarios_estatus" class="required">Estatus <span class="required">*</span></label>
						<select class="form-control" name="Horarios[estatus]" id="Horarios_estatus" style="font-size: 14px;">
							<option value="1">Áctivo</option>
							<option value="0">Ináctivo</option>
						</select>
					</div>
					<div class="col-6 col-lg-3 text-right mt-4">
						<button type="button" class="btn btn-primary btn-sm" onclick="guardarHorario()">Guardar</button>
					</div>
					<div class="col-12">
						<div id="listadoHorarios" style="font-size:14px;"></div>
					</div>
		        </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Imagenes -->
	<div class="modal fade" id="GaleriaTarifas" tabindex="-1" aria-labelledby="galeriaLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="galeriaLabel">Subir Foto</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="font-size: 14px;">
	      	<div id="success_galería" class="alert alert-success alert-dismissible fade show d-none" role="alert">
			  <strong>Exito!</strong> Imagen guardada exitosamente
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div id="error_galería" class="alert alert-success alert-dismissible fade show d-none" role="alert">
			  <strong>Error!</strong> Ocurrió un error en el servidor, intente más tarde.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
	        <div class="row mt-2">
	        	<div class="col-12 col-lg-12">
			        <div id="formGaleria" class="dropzone">
			        	<input type="hidden" name="idTarifa" id="idTarifa" value="<?php echo $model->id_tarifa; ?>" />
			        </div>
				</div>
				<div class="col-12 mt-2">
					<h4>Fotos</h4>
					<div id="galeriaFotos" style="font-size:14px;"></div>
				</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Tarifas En movil -->
	<div class="modal fade" id="tarifario" tabindex="-1" aria-labelledby="tarifasLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-body" style="font-size: 14px;">
	      	<div class="row border-bottom pb-2">
				<div class="col-12 col-md-6 col-lg-6 text-left">
					Tarifas
				</div>
				<div class="col-12 col-md-6 col-lg-6 text-right">
					<a href="<?=Yii::app()->createUrl('tarifas')?>" class="btn btn-primary btn-sm pull-right">Nueva Tarifa</a>
				</div>
				<div class="col-12 pt-2">
					<div class="input-group mb-3">
					  <input type="text" class="form-control" name="search" aria-label="buscar tarifa" aria-describedby="basic-addon2" autocomplete="false">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary" type="button" onclick="handleSearch()">Buscar</button>
					  </div>
					</div>
				</div>
			</div>
			<div id="listadoTarifasMobile"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<?php
	Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', CClientScript::POS_END); 
	Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js?v='.time(), CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile('https://unpkg.com/dropzone@5/dist/min/dropzone.min.js?v='.time(), CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/ckeditor5/ckeditor.js', CClientScript::POS_END);
	Yii::app()->clientScript->registerScript('select2', '
		$(document).ready(function() {
	    	$(".select__2").select2()
		});
		Dropzone.options.myAwesomeDropzone = false;
    	Dropzone.autoDiscover = false;
    	let myDropzone = $("#formGaleria").dropzone({
		    paramName: "file", // The name that will be used to transfer the file
		    maxFilesize: 6, // MB
    		url: "'.Yii::app()->createUrl('tarifas/upload').'",
    		dictDefaultMessage: "Arrastre los archivos aquí para subirlos",
    		init: function() {
                this.on("sending", function(file, xhr, formData){
                	formData.append("idTarifa", $("#idTarifa").val());
                })
                this.on("complete", function(file) {
                	console.log("complete")
				  	this.removeFile(file)
				  	loadGaleria()
				})
            }
    	})
		', CClientScript::POS_END);
?>
<?php Yii::app()->clientScript->registerScript('ckeditor', '
    initEditor("Tarifas_restricciones")
    initEditor("Tarifas_politicas_cancelacion")
    initEditor("Tarifas_observaciones")
', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScript('loadTarifas', '
	var datepickerHorario = "'.date('H:i').'";
	var settings = {
		format: "HH:mm",
		icons: {
			up: "fas fa-chevron-up",
			down: "fas fa-chevron-down"
		}
	}

	$(document).ready(function() {
		$("#datetimepickerHorario").datetimepicker(settings)
		$("#datetimepickerHorario").datetimepicker("date", moment(datepickerHorario, "HH:mm"))
		loadTarifas()
		loadRutas()
		loadHorarios()
		loadGaleria()
	})

', CClientScript::POS_READY); ?>

<script>
	$('#myModal').on('show.bs.modal', function (event) {
	  $("#success_ruta").addClass('d-none')
	  $("#error_ruta").addClass('d-none')
	})

	function loadTarifas(name = '') {
		$("#listadoTarifas").html("<div align='center'><img width='15px' src='<?=Yii::app()->request->baseUrl?>/images/loader.gif'></div>");
		if (window.innerWidth <= 992) {
			$("#listadoTarifasMobile").html("<div align='center'><img width='15px' src='<?=Yii::app()->request->baseUrl?>/images/loader.gif'></div>");
		}
		$.ajax({
			url: '<?=$baseUr?>/tarifas/listaTarifas',
			type: 'POST',
			data: {id: <?=$id?>, name: name},
		})
		.done(function(response) {
			// console.log("success", response)
			$('#listadoTarifas').html(response)
			if (window.innerWidth <= 992) {
				$('#listadoTarifasMobile').html(response)
			}
		})
		.fail(function(error) {
			// console.log("error", error);
			$("#listadoTarifas").html('')
			if (window.innerWidth <= 992) {
				$('#listadoTarifasMobile').html('')
			}
		})
		.always(function() {
			console.log("complete");
		});
	}

	function handleSearch() {
		var name = $("input[name='search']").val()
		// console.log(name)
		loadTarifas(name)
	}

	function irTarifa(id) {
		window.location.href = "<?=$baseUrl?>/tarifas?id=" + id;
	}

	function loadRutas(name = '') {
		$("#listadoRutas").html("<div align='center'><img width='15px' src='<?=Yii::app()->request->baseUrl?>/images/loader.gif'></div>");
		$.ajax({
			url: '<?=$baseUr?>/rutas/listaRutas',
			type: 'POST',
			data: {name: name},
		})
		.done(function(response) {
			// console.log("success", response)
			$('#listadoRutas').html(response)
		})
		.fail(function(error) {
			$("#listadoRutas").html('')
			console.log("error", error);
		})
		.always(function() {
			console.log("complete rutas");
		});
	}

	function guardarRuta() {
		var form = $("#formRutas").serializeArray()
		// $("#success_ruta").addClass('d-none')
	  	// $("#error_ruta").addClass('d-none')
		$.ajax({
			url: '<?=$baseUrl?>/rutas/guardarRuta',
			type: 'POST',
			data: {
				Rutas: {
					id_origen: $("#Rutas_id_origen").val(), 
					id_destino: $("#Rutas_id_destino").val(),
					menor_paga: 0,
					edad_menor_paga: 0
				}
			}
		})
		.done(function(response) {
			var result = JSON.parse(response)
			if (result.response == 0) {
				toastr.error("¡Error!. Ocurrió un error en el servidor, intente más tarde.")
				// $("#error_ruta").removeClass('d-none')
				// var confirmation = confirm("Existe una ruta similar, ¿Desea guardar la ruta?")
			}
			if (result.response == 1) {
				toastr.success("¡Exito!. Ruta guardada exitosamente.")
				// $("#success_ruta").removeClass('d-none')
			}
			console.log("success", result);
		})
		.fail(function(error) {
			toastr.error("¡Error!. Ocurrió un error en el servidor, intente más tarde.")
			// $("#error_ruta").removeClass('d-none')
			console.log("error", error);
		})
		.always(function() {
			console.log("complete");
			loadRutas()
			formSelectRutas()
		});	
	}

	function loadHorarios(horario = '') {
		$("#listadoHorarios").html("<div align='center'><img width='15px' src='<?=Yii::app()->request->baseUrl?>/images/loader.gif'></div>");
		$.ajax({
			url: '<?=$baseUr?>/horarios/listaHorarios',
			type: 'POST',
			data: {horario: horario},
		})
		.done(function(response) {
			// console.log("success", response)
			$('#listadoHorarios').html(response)
		})
		.fail(function(error) {
			$("#listadoHorarios").html('')
			console.log("error", error);
		})
		.always(function() {
			console.log("complete horarios");
		});
	}

	function guardarHorario() {
		var form = $("#formHorarios").serializeArray()
		// $("#success_ruta").addClass('d-none')
	  	// $("#error_ruta").addClass('d-none')
		$.ajax({
			url: '<?=$baseUrl?>/horarios/guardarHorario',
			type: 'POST',
			data: {
				Horarios: {
					id: -1,
					horario: $("#Horarios_horario").val(), 
					tipo: $("#Horarios_tipo").val(),
					estatus: $("#Horarios_estatus").val()
				}
			}
		})
		.done(function(response) {
			var result = JSON.parse(response)
			if (result.response == 0) {
				toastr.error("¡Error!. Ocurrió un error en el servidor, intente más tarde.")
				// $("#error_ruta").removeClass('d-none')
			// 	var confirmation = confirm("Existe una ruta similar, ¿Desea guardar la ruta?")
			}
			if (result.response == 1) {
				toastr.success("¡Exito!. Horario guardada exitosamente.")
				// $("#success_ruta").removeClass('d-none')
			}
			console.log("success", result);
		})
		.fail(function(error) {
			toastr.error("¡Error!. Ocurrió un error en el servidor, intente más tarde.")
			// $("#error_ruta").removeClass('d-none')
			console.log("error", error);
		})
		.always(function() {
			console.log("complete");
			loadHorarios()
		});
	}

	function loadGaleria() {
		var idTarifa = "<?=$model->id_tarifa?>";
		$("#galeriaFotos").html("<div align='center'><img width='15px' src='<?=Yii::app()->request->baseUrl?>/images/loader.gif'></div>");
		$.ajax({
			url: '<?=$baseUr?>/tarifas/galeriaCollector',
			type: 'POST',
			data: {idTarifa: idTarifa}
		})
		.done(function(response) {
			// console.log("success", response)
			$('#galeriaFotos').html(response)
		})
		.fail(function(error) {
			$("#galeriaFotos").html('')
			console.log("error", error);
		})
		.always(function() {
			console.log("complete rutas");
		});
	}

	function eliminarFoto(idFoto) {
		// var idFoto = $(this).data("id")
		// console.log(idFoto, "idFoto")
		if (!confirm("¿Estás seguro de que deseas eliminar esta foto de la galería?")) {
			return false
		}
		$.ajax({
			url: "<?=Yii::app()->createUrl('tarifas/eliminarFoto')?>",
			type: "POST",
			data: {idFoto: idFoto}
		}).always(function() {
			toastr.success("¡Exito!. Foto eliminada de la galería para la tarifa actual.")
			loadGaleria()
		});
	}

	function eliminarTarifa(idTarifa) {
		// console.log(idTarifa, "idTarifa")
		const aux = '<?=$model->id_tarifa?>'
		if (!confirm("¿Estás seguro de que deseas eliminar esta tarifa?. Esta acción es irreversible.")) {
			return false
		}
		$.ajax({
			url: "<?=Yii::app()->createUrl('tarifas/eliminarTarifa')?>",
			type: "POST",
			data: {idTarifa: idTarifa}
		}).always(function() {
			toastr.success("¡Exito!. Tarifa eliminada.")
			// console.log(idTarifa.toString(), aux)
			if (idTarifa.toString() == aux) {
				window.location.href = "<?=$baseUrl?>/tarifas"
			} else {
				loadTarifas()
			}
		});
	}

	function initEditor(elementId) {
		ClassicEditor.create(document.getElementById(elementId), {
			extraPlugins: [SimpleUploadAdapterPlugin],
			mediaEmbed: {
				previewsInData: true
			}
		}).then(editor => {
	      // console.log('Editor initialized', editor);
	    }).catch(error => {
	      console.error('Error initializing editor');
	    });
	}

	function SimpleUploadAdapterPlugin(editor) {
       editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
          // Configure the URL to the upload script in your back-end here!
          return new MyUploadAdapter(loader);
       };
    }

    class MyUploadAdapter {
       constructor(loader) {
          // The file loader instance to use during the upload. It sounds scary but do not
          // worry — the loader will be passed into the adapter later on in this guide.
          this.loader = loader;

          // URL where to send files.
          this.url = '<?=Yii::app()->request->baseUrl?>/tarifas/uploadCK';

          //
       }
       // Starts the upload process.
       upload() {
          return this.loader.file.then(
             (file) =>
                new Promise((resolve, reject) => {
                   this._initRequest();
                   this._initListeners(resolve, reject, file);
                   this._sendRequest(file);
                })
          );
       }
       // Aborts the upload process.
       abort() {
          if (this.xhr) {
             this.xhr.abort();
          }
       }
       // Initializes the XMLHttpRequest object using the URL passed to the constructor.
       _initRequest() {
          const xhr = (this.xhr = new XMLHttpRequest());
          // Note that your request may look different. It is up to you and your editor
          // integration to choose the right communication channel. This example uses
          // a POST request with JSON as a data structure but your configuration
          // could be different.
          // xhr.open('POST', this.url, true);
          xhr.open("POST", this.url, true);
          xhr.responseType = "json";
       }
       // Initializes XMLHttpRequest listeners.
       _initListeners(resolve, reject, file) {
          const xhr = this.xhr;
          const loader = this.loader;
          const genericErrorText = `Couldn't upload file: ${file.name}.`;
          xhr.addEventListener("error", () => reject(genericErrorText));
          xhr.addEventListener("abort", () => reject());
          xhr.addEventListener("load", () => {
             const response = xhr.response;
             // This example assumes the XHR server's "response" object will come with
             // an "error" which has its own "message" that can be passed to reject()
             // in the upload promise.
             //
             // Your integration may handle upload errors in a different way so make sure
             // it is done properly. The reject() function must be called when the upload fails.
             if (!response || response.error) {
                return reject(response && response.error ? response.error.message : genericErrorText);
             }
             // If the upload is successful, resolve the upload promise with an object containing
             // at least the "default" URL, pointing to the image on the server.
             // This URL will be used to display the image in the content. Learn more in the
             // UploadAdapter#upload documentation.
             resolve({
                default: response.url,
             });
          });
          // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
          // properties which are used e.g. to display the upload progress bar in the editor
          // user interface.
          if (xhr.upload) {
             xhr.upload.addEventListener("progress", (evt) => {
                if (evt.lengthComputable) {
                   loader.uploadTotal = evt.total;
                   loader.uploaded = evt.loaded;
                }
             });
          }
       }
       // Prepares the data and sends the request.
       _sendRequest(file) {
          // Prepare the form data.
          const data = new FormData();
          data.append("upload", file);
          // Important note: This is the right place to implement security mechanisms
          // like authentication and CSRF protection. For instance, you can use
          // XMLHttpRequest.setRequestHeader() to set the request headers containing
          // the CSRF token generated earlier by your application.
          // Send the request.
          this.xhr.send(data);
       }
       // ...
    }
</script>