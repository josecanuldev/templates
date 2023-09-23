<?php
$this->breadcrumbs=array(
	'Reserva Transfer Holbox',
);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/styles.scss');
Yii::app()->clientScript->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css');
$arrivals = Arrivals::model()->findAll();
$agencies = Agencies::model()->findAll('status=1');

$this->renderPartial("/layouts/_call_css_kendo");

?>
<style type="text/css">
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

	#showOrders{
		font-size: 13px;
	}

	#writePrice{
		z-index: 2000;
	}

	label{
		margin-bottom: initial !important;
	}
</style>
<div id="app" class="font-weight-bold" v-cloak>
	<section class="bg-light text-left">
		<div class="container pb-5">
			<!-- <iframe src="https://www.flightradar24.com/simple_index.php?lat=20.9882938&lon=-87.0946008&z=10" width="600" height="600"></iframe> -->
			<div class="row">
				<?php $this->renderPartial('/layouts/_logo_transfer') ?>
				<div class="col-md-6 align-items-center text-center text-dark">
					<div class="row">
						<div class="col-12">
							<h1 class="text-dark"> Reserva Transfer Holbox </h1> 
							<span><?=$date?></span>
						</div>
					</div>					
				</div>
				<?php $this->renderPartial('/layouts/_return_samy') ?>
			</div>
			<?php if (isset($_GET["type"]) || isset($_GET["id"])): ?>
				<?php if ($_GET["id"]){ $idreserva = $_GET["id"]; } ?>
				<div class="row text-secondary">
					<div class="col-md-4 col-sm-12">
						<label>Buscar por ID o Referencia</label>
						<div class="input-group mb-3">
							<input type="text" class="form-control text-right" placeholder="Ingresar ID o Referencia" v-model="model.idreserva">
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button" @click="getModel">Buscar</button>
							</div>
						</div>
					</div>
					<div class="col-md-8 col-sm-12 text-right mt-4">
						<a href="<?=Yii::app()->createUrl('reservatour')?>" class="btn btn-info"> Nueva reserva</a>
						<button type="button" class="btn btn-info" @click="openActionOrder()" :disabled="model.idreserva == 0"> Agregar Orden de pago </button>
						<?php #if (isset($_GET["type"]) || isset($_GET["id"])): ?>
							<button type="button" class="btn btn-info" :disabled="model.idreserva == 0" @click="openShowOrders"> Ver Ordenes de pago</button>
						<?php #endif ?>
					</div>
				</div>
			<?php else: 
				$idreserva = $lastInsertID;
			?>
				<div class="row text-secondary">
					<div class="col-md-4 col-sm-12">
						<label>Nuevo Folio:</label>
						<div class="input-group mb-3">
							<input type="text" class="form-control text-right" placeholder="Ingresar ID o Referencia" v-model="model.idreserva" readonly>
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button" @click="getModel" disabled>Buscar</button>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
			<div class="row">
				<div class="col-md-12">
					<hr class="text-dark">
				</div>
			</div>
			<?php $this->renderPartial('_form_cliente',array('agencies'=>$agencies)); ?>
			<hr>
			<div class="row text-secondary">
				<div class="col-md-6 mb-3 text-left">
					<fieldset class="form-group">
						<legend tabindex="-1" class="bv-no-focus-ring col-form-label pt-0">Tipo de viaje</legend>
						<div>
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" name="tipoViaje" v-model="model.tipoViaje" value="Sencillo">
								<label class="form-control-label" for="inlineRadio1Sencillo">Sencillo</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" name="tipoViaje" v-model="model.tipoViaje" value="Redondo">
								<label class="form-control-label" for="inlineRadio1Redondo">Redondo</label>
							</div>
							<!-- <div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" name="tipoViaje" v-model="model.tipoViaje" value="Ruta">
								<label class="form-control-label" for="inlineRadio1Ruta">Agregar Ruta</label>
							</div> -->
						</div>
					</fieldset>
				</div>
				<div class="col-md-6 mb-3 text-left">
					<fieldset class="form-group">
						<legend tabindex="-1" class="bv-no-focus-ring col-form-label pt-0">Tipo de vuelo</legend>
						<div>
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" name="tipoVuelo" id="inlineRadio1" v-model="model.tipoVuelo" value="Vuelo Nacional">
								<label class="form-check-label" for="inlineRadio1">Nacional</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" name="tipoVuelo" id="inlineRadio2" v-model="model.tipoVuelo" value="Vuelo Internacional">
								<label class="form-check-label" for="inlineRadio2">Internacional</label>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
			<div class="row text-secondary bd-top-black">
				<div class="col-md-6 bd-right-black">
					<div class="row">
						<div class="col-md-12 mt-3">
							<h6><b>DESDE:</b></h6>
						</div>
						<div class="col-md-8 mt-3 mb-3">
							<div class="row g-3">
								<div class="col-auto">
									<label for="from-option" class="col-form-label">Lugar / Zona:</label>
								</div>
								<div id="from-header" class="col-auto">
									<select class="custom-select" id="__BVID__68" v-model="model.id_arrivals_from">
										<option v-for="(arrival, i) in arrivals" :key="i" :value="arrival.id">{{arrival.name}}</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<button type="button" class="btn btn-block mt-3 mb-3 btn-secondary" data-toggle="modal" data-target="#zonaModal"> Agregar zona </button>
						</div>
					</div>
					<div class="row bd-top-black">
						<div class="col-md-12 mb-3 mt-3">
							<label>Información del Origen</label>
						</div>
					</div>
					<?php $this->renderPartial('_form_llegada'); ?>
				</div>
				<div class="col-md-6 mb-3">
					<div class="row">
						<div class="col-md-12 mt-3">
							<h6><b>HASTA:</b></h6>
						</div>
						<div class="col-md-12 mt-3 mb-3">
							<div class="row g-3">
								<div class="col-auto">
									<label for="to-optiion" class="col-form-label">Lugar / Zona:</label>
								</div>
								<div id="to-header" class="col-auto">
									<select class="custom-select" id="__BVID__73" v-model="model.id_arrivals_to">
										<option v-for="(arrival, i) in arrivals" :key="i" :value="arrival.id">{{arrival.name}}</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row bd-top-black">
						<div class="col-md-12 mb-3 mt-3">
							<label>Información del {{ is_circuito ? 'Retorno' : 'Destino'}}</label>
						</div>
					</div>
					<?php $this->renderPartial('_form_salida'); ?>
					<input type="hidden" name="reservatour__horarioPickup" id="reservatour__horarioPickup">
				</div>
			</div>
			<div class="row text-secondary bd-top-black">
				<div class="col-12">
					<!-- Si es un tour o holbox -->
					<form action="" method="post" id="form_circuitos">						
						<div class="row">
							<div class="col-6 mt-2">
								<div class="row">
									<div class="col-8">
										<div class="form-group form-check">
											<input type="checkbox" class="form-check-input" id="check_circuito" v-model="is_circuito" @change="changeTours($event)">
											<label class="form-check-label" for="check_circuito">Es un Tour</label> 
										</div>
									</div>
									<div class="col-4" v-if="is_circuito">
										<button type="button" class="btn mb-2 btn-secondary" @click="addHotel()"> <i class="fa fa-plus"></i> </button>											
									</div>
								</div>
							</div>
							<div class="col-12" v-if="is_circuito">
								<div v-for="(item,index) in reservatourcircuito" :key="index" class="row mb-3">
									<div class="col-md-3 col-sm-6">
										<label for="single-arrival-select-hotel">{{index+1}}.- Hotel / Sitio</label>
										<input type="text" autocomplete="off" class="form-control" v-model="item.hotel" :name="'hotel_' + index">
										<!-- <select class="custom-select" id="__BVID__236" value="" v-model="item.hotel"></select> -->
									</div>
									<div class="col-md-3">
										<label for="arrival_date" class="form-label">Fecha de Servicio</label>
										<div>
											<vuejs-datepicker :name="'fechaServicio_' + index" :format="'dd/MM/yyyy'" :language="es" :bootstrap-styling="true" :value="item.fechaServicio">
											</vuejs-datepicker>
										</div>
										<!-- <div class="datePickerCircuito input-group" v-html="assignID(index)">
											<input type="text" class="form-control" :id="'fechaServicio_' + index">
											<div class="input-group-append">
												<span class="input-group-text px-4"><i class="fa fa-calendar"></i></span>
											</div>
										</div> -->
									</div>
									<div class="col-md-3">
										<label for="service_hour">Hora de Servicio</label>
										<!-- <div>
											<timepicker :value="item.horarioServicio" :format="'HH:mm'"></timepicker>
										</div> -->
										<div class="form-group">
											<div class="input-group date" :id="'datetimepickerHorarioServicio_' + index" data-target-input="nearest" v-html="assignID(index)">
												<!-- v-html="assignID(index)" -->
												<!-- <input type="text" class="form-control datetimepicker-input" :data-target="'#datetimepickerHorarioServicio_' + index" :id="'reservatour__horarioServicio_' + index" data-toggle="datetimepicker" :name="'horaServicio_' + index" :value="item.horarioServicio" />
												<div class="input-group-append" :data-target="'#datetimepickerHorarioServicio_' + index" data-toggle="datetimepicker" v-html="assignID(index)">
													
												</div> -->
											</div>
										</div>
									</div> 
									<div class="col-md-3 col-sm-6">
										<a href="javascript:void(0);" @click="deleteHotel(index)" class="btn btn-danger" style="margin-top: 32px !important;"><i class="fa fa-trash"></i></a>
									</div>
								</div>
							</div>
						</div>	
					</form>
					<!-- ------------------ -->
				</div>
				<div class="col-md-12 mt-3 mb-3">
					<label for="observations-textarea" class="form-label"> Observaciones </label>
					<textarea id="observations-textarea" name="observations-textarea" rows="5" wrap="soft" class="form-control" v-model="model.observaciones"></textarea>
				</div>
			</div>

			<!-- Botones de acciones -->
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-12 text-right">
					<button type="button" class="btn btn-primary" @click="booking" :disabled="is_loading_save"> 
						<span v-show="is_loading_save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
						<?php if (isset($_GET["type"]) || isset($_GET["id"])): echo "Actualizar";?>
						<?php else: echo "Guardar"?>
						<?php endif ?>
						Reservación 
						<!-- {{model.idreserva == 0 ? 'Guardar' : 'Actualizar'}}  -->
					</button>
				</div>
				<div class="col-md-3">
				</div>
			</div>

			<!-- Modal agregar zona -->
			<div class="modal fade" id="zonaModal" tabindex="-1" aria-labelledby="zonaModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content text-dark">
						<div class="modal-header">
							<h5 class="modal-title" id="zonaModalLabel">Registrar Zona</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" id="form_agency">
								<div class="row">
									<div class="col-12">							
										<div class="form-group">
											<label for="inputNameZona">Zona *</label>
											<input type="text" class="form-control" id="arrivals_name" v-model="model_arrivals.name">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label for="inputNameZona">Descripción </label>
											<textarea id="description-textarea" name="description-textarea" rows="5" wrap="soft" class="form-control" v-model="model_arrivals.description"></textarea>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" @click="saveArrivals">Guardar</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal agregar sitio -->
			<div class="modal fade" id="sitioModal" tabindex="-1" aria-labelledby="sitioModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content text-dark">
						<div class="modal-header">
							<h5 class="modal-title" id="sitioModalLabel">Registrar Hotel/Sitio</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" id="form_agency">
								<div class="row">
									<div class="col-12">							
										<div class="form-group">
											<label for="inputsitioSitio">Sitio *</label>
											<input type="text" class="form-control" id="sitios_sitio" v-model="model_sitios.sitio">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label for="inputsitioDescripcion">Descripción </label>
											<textarea id="description-textarea-sitio" name="description-textarea-sitio" rows="5" wrap="soft" class="form-control" v-model="model_sitios.descripcion"></textarea>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label for="estatusReservaSitio">Estatus</label>
											<select class="form-control" id="sitios_estatus" v-model="model_sitios.estatus">
												<option value="1">Áctivo</option>
												<option value="0">Ináctivo</option>
											</select>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" @click="saveSitios">Guardar</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal agregar orden -->
			<?php $this->renderPartial('_modal_orders'); ?>
			<?php $this->renderPartial('/orders/_desglose_orders'); ?>
		</div>
	</section>
</div>
<?php $this->renderPartial("/agencies/_agenciesModal",array("idModal" => "agencies")); ?>
<?php 
$restarHoras = date('H:i',strtotime('-5 hour', strtotime(date('H:i:s'))));
Yii::app()->clientScript->registerScript('modal', '
	var agenciesModal = "agencies";
	// var idreserva = "'.(isset($_GET["id"]) ? $_GET["id"] : 0).'";
	var idreserva = "'.$idreserva.'";
	var type = "'.(isset($_GET["type"]) || isset($_GET["id"]) ? 'edit' : 'new').'";
	var datepickerllegada = "'.date('H:i').'";
	var datepickersalida = "'.date('H:i').'";
	var datepickerpickup = "'.$restarHoras.'";
	', CClientScript::POS_HEAD);

$this->renderPartial("/layouts/_call_js_kendo");

Yii::app()->clientScript->registerScriptFile('https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdn.jsdelivr.net/npm/fecha@3.0.2/lib/fecha.umd.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/es-do.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('initHours', '
	$(function () {
		initHours();
		});
		', CClientScript::POS_READY);

Yii::app()->clientScript->registerScriptFile('https://unpkg.com/vuejs-datepicker', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://unpkg.com/vuejs-datepicker/dist/locale/translations/es.js', CClientScript::POS_END);

// Yii::app()->clientScript->registerScriptFile('https://unpkg.com/@domi7891/vuejs-datetime-picker', CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/agencies.js?v='.time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/assets/vue/reservaTraslados.js?v='.time(), CClientScript::POS_END); 
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/desglose_kendo.js?v='.time(), CClientScript::POS_END);
?>

<script>
	function initHours(){
		var settings = {
			format: 'HH:mm',
			icons: {
				up: "fas fa-chevron-up",
				down: "fas fa-chevron-down"
			}
		};
		$('#datetimepickerHoraLlegada').datetimepicker(settings);
		$('#datetimepickerHoraSalida').datetimepicker(settings);
		$('#datetimepickerHoraPickup_1').datetimepicker(settings);
		$('#datetimepickerHoraPickup_2').datetimepicker(settings);
		
		// console.log(datepickerllegada)
		if (type != 'edit') {
			$('#datetimepickerHoraLlegada').datetimepicker('date', moment(datepickerllegada, 'HH:mm') );
			$('#datetimepickerHoraSalida').datetimepicker('date', moment(datepickersalida, 'HH:mm') );
			$('#datetimepickerHoraPickup_1').datetimepicker('date', moment(datepickerpickup, 'HH:mm') );
			$('#datetimepickerHoraPickup_2').datetimepicker('date', moment(datepickerpickup, 'HH:mm') );
		}

	}
</script>
