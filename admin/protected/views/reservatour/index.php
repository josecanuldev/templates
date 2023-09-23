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
			<?php if (isset($_GET["type"])): ?>
				<div class="row mt-2">
					<div class="col-6 text-dark">
						<div v-show="loading_wait" class="spinner-border" style="width: 1.5rem; height: 1.5rem;" role="status">
						  <span class="sr-only">Loading...</span> 
						</div> <span v-show="loading_wait" class="ml-2">Espere ...</span>
						<span class="text-danger" v-show="multiReservas.length == 0 && !loading_wait">Sin Resultados </span>
					</div>
					<div class="col-6 text-dark text-right">
						<button class="btn btn-outline-secondary" type="button" @click="back()"><i class="fas fa-angle-left"></i></button>
						<button class="btn btn-outline-secondary pr-2" type="button" @click="next()"><i class="fas fa-angle-right"></i></button>
						<span class="pl-2"> {{ current }} / {{ multiReservas.length }} Encontrados</span>
					</div>
				</div>
			<?php endif ?> 
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
				<?php if ($_GET["id"]){ $idreserva = $_GET["id"]; $disabled = "disabled"; } ?>
				<div class="row text-secondary text-right">
					<div class="col-md-12 col-sm-12">
						<a href="<?=Yii::app()->createUrl('reservatour')?>" class="btn btn-info"> Nueva reserva</a>
						<button type="button" class="btn btn-info" @click="openActionOrder()" :disabled="model.idreserva == 0"> Agregar Orden </button>
						<?php #if (isset($_GET["type"]) || isset($_GET["id"])): ?>
							<button type="button" class="btn btn-info" :disabled="model.idreserva == 0" @click="openShowOrders"> Ver Ordenes</button>
						<?php #endif ?>
					</div>
					<div class="col-md-2 col-sm-12">
						<div class="mb-3">
							<label for="date-input" class="form-label">ID Reserva</label>
							<input type="text" class="form-control text-right" placeholder="Ingresar ID" v-model="filters.id">
						</div>
					</div>
					<?php if (!isset($_GET["id"])): ?>
						<div class="col-md-2 col-sm-12">
							<div class="mb-3">
								<label for="date-input" class="form-label">Referencia</label>
								<input type="text" <?=$disabled?> class="form-control text-right" placeholder="Ingresar Referencia" v-model="filters.referencia">
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="mb-3">
								<label for="date-input" class="form-label">Fecha Reserva *</label>
								<div class="date input-group">
									<input type="text" <?=$disabled?> class="form-control" id="datepicker_filter" autocomplete="off">
									<div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar"></i></span></div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="mb-3">
								<label for="name-input" class="form-label">Nombre</label>
								<input type="text" <?=$disabled?> class="form-control text-right" placeholder="Buscar nombre" v-model="filters.nombre">
							</div>
						</div>
					<?php endif ?>
					<div class="<?=!isset($_GET["id"]) ? 'col-md-2' : 'col-md-10'?> col-sm-12 text-right mt-4" style="font-size: 7px;">
						<?php if (!isset($_GET["id"])): ?>
							<button class="btn btn-info" type="button" @click="getModel">Buscar</button>
						<?php endif ?>
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
			<div v-for="(ruta,i) in rutas">				
				<?php $this->renderPartial('_ruta') ?>
			</div>

			<!-- Botones de acciones -->
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-12 text-right">
					<?php if (isset($_GET["type"]) || isset($_GET["id"])): ?>
						<button type="button" class="btn btn-secondary" @click="reenviaMail" :disabled="is_loading_reenvia_mail" data-toggle="tooltip" data-placement="top" title="Si tienes cambios, actualiza y después reenvia el correo">
							<span v-show="is_loading_reenvia_mail" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
							Reenviar correo 
						</button>
					<?php endif ?>
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

			<!-- modales para destinos y sitios -->
			<?php $this->renderPartial('_destinos_sitios') ?>

			<!-- <div class="modal fade" id="modalReservas" data-backdrop="static" tabindex="-1" aria-labelledby="modalReservasLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content text-dark">
						<div class="modal-header">
							<h5 class="modal-title" id="modalReservasLabel">Reservas Generadas</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div v-for="(id,d) in idsReservas" class="col-md-12 mt-3">
									<div class="row text-dark"> 
										<div class="col-md-6 text-dark">
											<span>
												<a class="text-dark" target="_blank" :href="'<?=Yii::app()->baseUrl?>/reservatour?id=' + id"> Reserva: {{ id }} </a>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<a href="<?=Yii::app()->createUrl('orders')?>" class="btn btn-primary">
								Ver Ordenes de Servicio
							</a>
						</div>
					</div>
				</div>
			</div> -->

			<div class="modal fade" id="modalReservas" data-backdrop="static" tabindex="-1" aria-labelledby="modalReservasLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content text-dark">
						<div class="modal-header">
							<h5 class="modal-title" id="modalReservasLabel">Generar Ordenes</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" id="form_agency">
								<div v-for="(orden, i) in ordenPagos":key="orden.idreserva" class="row border-bottom mt-3 pb-2">
									<div class="col-12">
										<h4>ID Reserva: {{orden.idreserva}} - Ruta {{ i+1 }} </h4>
									</div>
									<div class="col-4">							
										<div class="form-group">
											<label for="inputOrdenReservaTotal">Total *</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">$</div>
												</div>
												<input type="text" class="form-control text-right" :id="'ordenreserva_total_' + i" v-model="orden.total">
											</div>
										</div>
									</div>
									<div class="col-4">							
										<div class="form-group">
											<label for="inputOrdenReservaMoneda">Moneda *</label>
											<div class="input-group">
												<select class="form-control" v-model="orden.moneda" name="orden.moneda" :id="'ordenreserva_moneda_' + i">
													<option value="MXN">MXN</option>
													<option value="USD">USD</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-4">							
										<div class="form-group">
											<label for="inputOrdenReservaTipoCambio">Tipo Cambio</label>
											<input type="text" class="form-control text-right" :id="'ordenreserva_tipo_cambio_' + i" v-model="orden.tipo_cambio">
										</div>
									</div>
									<div class="col-12">
										<label for="observations-textarea-orders" class="form-label"> Observaciones </label>
										<textarea :id="'observations-textarea-orders_' + i" name="observations-textarea-orders" rows="4" wrap="soft" class="form-control" v-model="orden.observaciones"></textarea>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal" @click="cerrarModal">Cerrar</button>
							<a href="<?=Yii::app()->createUrl('reservatour')?>" class="btn btn-success"> Nueva reserva</a>
							<button type="button" class="btn btn-primary" @click="saveOrders" :disabled="is_loading_orders">
							<span v-show="is_loading_orders" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
							Guardar
							</button>
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
$minutes = date('i', strtotime($restarHoras));
$remainder = ((int) $minutes) % 30;
$restarHoras = date('H:i',strtotime('-'.$remainder.' minutes', strtotime($restarHoras)));
$restarHoras = date('H:i'); // 20/07/2022 jccd

Yii::app()->clientScript->registerScript('modal', '
	var agenciesModal = "agencies";
	// var idreserva = "'.(isset($_GET["id"]) ? $_GET["id"] : 0).'";
	var idreserva = "'.$idreserva.'";
	var type = "'.(isset($_GET["type"]) || isset($_GET["id"]) ? 'edit' : 'new').'";
	var datepickerllegada = "'.date('H:i').'";
	var datepickersalida = "'.date('H:i').'";
	var datepickerpickup = "'.$restarHoras.'";

	var settings = {
		format: "HH:mm",
		icons: {
			up: "fas fa-chevron-up",
			down: "fas fa-chevron-down"
		}
	}
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
		
		// $('#datetimepickerHoraLlegada').datetimepicker(settings)
		// $('#datetimepickerHoraSalida').datetimepicker(settings)
		// $('#datetimepickerHoraPickup_1').datetimepicker(settings)
		// $('#datetimepickerHoraPickup_2').datetimepicker(settings)
		
		// console.log(datepickerllegada)
		if (type != 'edit') {
			// $('#datetimepickerHoraLlegada').datetimepicker('date', moment(datepickerllegada, 'HH:mm') )
			// $('#datetimepickerHoraSalida').datetimepicker('date', moment(datepickersalida, 'HH:mm') )
			// $('#datetimepickerHoraPickup_1').datetimepicker('date', moment(datepickerpickup, 'HH:mm') )
			// $('#datetimepickerHoraPickup_2').datetimepicker('date', moment(datepickerpickup, 'HH:mm') )
		}

	}
</script>
