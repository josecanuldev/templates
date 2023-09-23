<?php 
$this->renderPartial("/layouts/_call_css_kendo");
Yii::app()->clientScript->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css');

$date_now = date('d-m-Y');
$date_future = strtotime('+1 day', strtotime($date_now));
$date_future = date('d/m/Y', $date_future);
?>

<style type="text/css">
	#grid, #showOrders{
		font-size: 12px;
		color: initial;
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

	[v-cloak] {
		display: none;
	}

	.btn-command{
		min-width:  initial !important;
	}

	html .k-tooltip, .k-tooltip.k-popup, .k-tooltip.k-widget{
		border-color: #ffffff !important;
    	color: #000 !important;
    	background-color: #ffffff !important;
	}

	.container{
		max-width: 1210px !important;
	}

	#writePrice{
		z-index: 2000;
	}

	.badge{
		font-size: 100% !important;
	}

	.reserva--activa, .reserva--pagado {}
</style>
<div id="app" class="font-weight-bold" v-cloak>
	<section class="bg-light text-left">
		<div class="container pb-5 pt-3">
			<div class="row mt-2">
					<div class="col-6 text-dark">
						<span class="text-danger"> {{ rows }} Encontrados </span>
					</div>
					<div class="col-6 text-dark text-right">
						<button class="btn btn-outline-secondary" type="button" @click="back()"><i class="fas fa-angle-left"></i></button>
						<button class="btn btn-outline-secondary pr-2" type="button" @click="next()"><i class="fas fa-angle-right"></i></button>
					</div>
				</div>
			<div class="row">
				<?php $this->renderPartial('/layouts/_logo_transfer') ?>
				<div class="col-md-6 align-items-center text-center">
					<h1 class="text-dark"> <?=$title?> </h1>
					<span>Servicios de transportación</span><br><span><?=$date?></span>
				</div>
				<?php $this->renderPartial('/layouts/_return_samy') ?>
			</div>
			<div class="row pb-3">
				<div class="col-md-3 col-sm-12">
					<label for="arrival_date" class="form-label">Desde:</label>
					<div class="date input-group">
						<input type="text" class="form-control" id="fechaLlegada" value="<?=$date_future?>">
						<div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar"></i></span></div>
					</div>
				</div>
				<div class="col-md-3 col-sm-12">
					<label for="arrival_date" class="form-label">Hasta:</label>
					<div class="date input-group">
						<input type="text" class="form-control" id="fechaSalida" value="<?=$date_future?>">
						<div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar"></i></span></div>
					</div>
				</div>
				<?php if ($type == "all"): ?>
					<div class="col-md-3 col-sm-12">
						<label for="arrival_date" class="form-label">Tipo de Servicio:</label>
						<select class="custom-select" id="tipoFecha" @change="changeTipoFecha">
							<option value="all">Selecciona una opción</option>
							<option value="0">Llegada</option>
							<option value="1">Salida</option>
						</select>
					</div>
				<?php endif ?>
				<?php if ($type == 'salidas'): ?>
					<input type="hidden" name="fechaSalidas" id="tipoFecha" value="1">
					<?php 
					$type="holbox";
					?>
				<?php endif ?>
				<?php if ($type == 'entradas'): ?>
					<input type="hidden" name="fechaLLegada" id="tipoFecha" value="0">
					<?php 
					$type="holbox";
					?>
				<?php endif ?>
				<div class="col-md-3 col-sm-12">
					<label for="arrival_date" class="form-label">Filtrar por agencia:</label>
					<select class="custom-select" id="id_agencia" @change="changeAgency">
						<option value="0" selected>Todos</option>
						<?php $agencias = Agencies::model()->findAll(); ?>
						<?php foreach ($agencias as $val) { ?>
							<option value="<?=$val->id?>"><?=$val->name?></option>				
							<?php
						} ?>
					</select>
				</div>
				<div class="col-md-3 col-sm-12">
					<label for="arrival_date" class="form-label">Tipo de Viaje:</label>
					<select class="custom-select" id="id_tipoViaje" @change="changeTipoViaje">
						<option value="all">Todos</option>
						<option value="Sencillo">Sencillo</option>
						<option value="Redondo">Redondo</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-lg-12">
					<div id="grid"></div>
				</div>
			</div>
			<div class="row mt-5">
				<?php if (($type == 'all' || $type == 'holbox') && $letreros == ""): ?>
					<div class="col-md-3 col-sm-12 text-center">
						<div class="row border border-dark mr-2">
							<div class="col-12">
								<h4>HOLBOX</h4>
								<div class="row border border-dark" style="margin-right: 1px; margin-left: 1px; margin-bottom: 15px;">
									<div class="col-md-12">
										<span>Boletos Totales</span>
									</div>
									<div class="col-md-6 col-sm-6">
										Adultos
									</div>
									<div class="col-md-6 col-sm-6">
										<span>{{holbox.adultos}}</span>
									</div>
									<div class="col-md-6 col-sm-6">
										Menores
									</div>
									<div class="col-md-6 col-sm-6">
										<span>{{holbox.menores}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif ?>
				<?php if (($type == 'all' || $type == 'chiquila') && $letreros == ""): ?>
					<div class="col-md-3 col-sm-12 text-center">
						<div class="row border border-dark mr-2">
							<div class="col-12">
								<h4>CHIQUILÁ</h4>
								<div class="row border border-dark" style="margin-right: 1px; margin-left: 1px; margin-bottom: 15px;">
									<div class="col-md-12">
										<span>Boletos Totales</span>
									</div>
									<div class="col-md-6 col-sm-6">
										Adultos
									</div>
									<div class="col-md-6 col-sm-6">
										<span>{{chiquila.adultos}}</span>
									</div>
									<div class="col-md-6 col-sm-6">
										Menores
									</div>
									<div class="col-md-6 col-sm-6">
										<span>{{chiquila.menores}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif ?>
				<?php 
				$disabled = "d-none";
				$col = "col-md-6";
				if ($type != 'all') {
					$col = "col-md-9";
				} else if ($letreros == "letreros") {
					$col = "col-md-12";
					$addFlex = "d-flex flex-row-reverse";
					$disabled = "";
				}

				?>
				<div class="<?=$col?> col-sm-12 text-right <?=$addFlex?>">
					<div class="d-flex flex-row-reverse">
						<form action="<?php echo Yii::app()->createUrl('orders/getOrders'); ?>" method="get" id="form_send" class="ml-2">
							<button type="button" class="btn mb-2 btn-secondary" id="btn_send_pdf"data-toggle="tooltip" data-placement="top" title="Enviar PDF a operadores." :disabled="is_loading_sendPdf" @click="sendPdfOperadores"> 
								<span v-show="is_loading_sendPdf" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
								<i class="fas fa-mail-bulk"></i>
							</button>
						</form>
						<form action="<?php echo Yii::app()->createUrl('orders/getOrders'); ?>" method="get" id="form_fechas" target="_blank">
							<input type="hidden" name="type" id="typePdf" />
							<input type="hidden" name="fecha_de" id="fecha_de" />
							<input type="hidden" name="fecha_hasta" id="fecha_hasta" />
							<input type="hidden" name="tipoFecha" id="tipoFechaPdf" />
							<input type="hidden" name="id_agencia" id="id_agencia_pdf" />
							<input type="hidden" name="PDF" value="TRUE" />
							<button type="button" class="btn mb-2 btn-secondary" id="btn_pdf"data-toggle="tooltip" data-placement="top" title="Imprimir PDF."> <i class="fas fa-print"></i> </button>
						</form>
					</div>
					<form action="<?php echo Yii::app()->createUrl('orders/downloadDoc'); ?>" method="post" id="form_descargas" class="<?=$disabled?>">
						<input type="hidden" name="orders" id="ordersIds">
						<button type="button" class="btn mb-2 btn-secondary" id="btn_word" data-toggle="tooltip" data-placement="top" title="Descargar letreros seleccionados."> <i class="fas fa-file-word"></i> </button>
					</form>
				</div>
			</div>
			<?php $this->renderPartial('/reservatour/_modal_orders'); ?>
			<?php $this->renderPartial('_desglose_orders'); ?>
		</div>
	</section>
	<div class="modal fade" id="driversModal" data-backdrop="static" tabindex="-1" aria-labelledby="driversLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content text-dark">
				<div class="modal-header">
					<h5 class="modal-title" id="driversLabel">Agregar/Editar un operador</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" id="form_driver">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="inputOrdenReservaSubtotal">Operador *</label>
									<select class="custom-select" v-model="driver.id_driver">
										<option v-for="(driver, i) in driversItems" :key="i" :value="driver.id">{{driver.name}}</option>
									</select>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" @click="addOperador">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
$drivers = Drivers::model()->findAll(array('order'=>'id DESC'));
Yii::app()->clientScript->registerScript('url_site', '

	var url_site = "/orders/getOrders";
	var is_order = 1;
	var type = "'.$type.'"
	var letreros = "'.$letreros.'"
	var drivers = '.CJSON::encode($drivers).';

	', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/es-do.js', CClientScript::POS_END);

$this->renderPartial("/layouts/_call_js_kendo");

Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/orders.js?v='.time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/orders_kendo.js?v='.time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/desglose_kendo.js?v='.time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScript('pdf', '

	$("#btn_pdf").click(function(e) {
		var fecha_start = $("#fechaLlegada").val();
		var fecha_end = $("#fechaSalida").val();
		var tipoFecha = $("#tipoFecha").val();
		var id_agencia = $("#id_agencia").val();

		$("#typePdf").val(type);
		$("#fecha_de").val(fecha_start);
		$("#fecha_hasta").val(fecha_end);
		$("#tipoFechaPdf").val(tipoFecha);
		$("#id_agencia_pdf").val(id_agencia);

		$("#form_fechas").submit();
	});

	', CClientScript::POS_END);
?>