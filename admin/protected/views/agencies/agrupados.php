<?php 
$this->renderPartial("/layouts/_call_css_kendo");
?>

<style type="text/css">
	#grid, #showOrders {
		font-size: 12px;
		color: initial;
	}

	[v-cloak] {
		display: none;
	}

	.group--header {
		font-weight: bolder;
    	font-size: 14px;
    	color: initial;
	}

	.btn-command {
		min-width:  initial !important;
	}

	.k-grouping-row p {
		padding: 5px 0.6em !important;
	}

</style>
<div id="app" class="font-weight-bold" v-cloak>
	<section class="bg-light text-left">
		<div class="container pb-5 pt-3" style="max-width: 1200px;">
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
					<h1 class="text-dark"> Agencias </h1>
					<span>Reservas </span><br><span>{{ hoyMenos15Dias }} - {{ hoy }}</span>
				</div>
				<?php $this->renderPartial('/layouts/_return_samy') ?>
			</div>
			<div class="row pb-3">
				<div class="col-md-3 col-sm-12">
					<label for="filter_agencies" class="form-label">Filtrar por agencia:</label>
					<select class="custom-select" id="id_agencia" @change="changeAgency">
						<option value="0" selected>Todos</option>
						<?php $agencias = Agencies::model()->findAll(); ?>
						<?php foreach ($agencias as $val) { ?>
							<option value="<?=$val->id?>"><?=$val->name?></option>				
							<?php
						} ?>
					</select>
				</div>
			</div>
			<div class="row">
				<input type="hidden" name="hoy" id="hoy" v-model="hoy">
				<input type="hidden" name="hoyMenos15Dias" id="hoyMenos15Dias" v-model="hoyMenos15Dias">
				<div class="col-xs-12 col-md-12 col-lg-12">
					<div id="grid"></div>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-12 text-right">
					<div class="d-flex flex-row-reverse">
						<form action="<?php echo Yii::app()->createUrl('agencies/getListAgencies'); ?>" method="get" id="form_send" class="ml-2">
							<!-- <input type="hidden" name="fecha_de" id="fecha_de" />
							<input type="hidden" name="fecha_hasta" id="fecha_hasta" />
							<input type="hidden" name="tipoFecha" id="tipoFechaPdf" />
							<input type="hidden" name="id_agencia" id="id_agencia_pdf" />
							<input type="hidden" name="PDF" value="TRUE" /> -->
							<button type="button" class="btn mb-2 btn-secondary" id="btn_send" data-toggle="tooltip" data-placement="top" title="Enviar estado de cuentas a las agencias." :disabled="is_loading_send" @click="sendEstadoCuentas"> 
								<span v-show="is_loading_send" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
								<i class="fas fa-mail-bulk"></i>
							</button>
						</form>
						<form action="<?php echo Yii::app()->createUrl('agencies/imprimirpdf'); ?>" method="get" id="form_pdf" target="_blank">
							<input type="hidden" name="fecha_start" id="fecha_start" />
							<input type="hidden" name="fecha_end" id="fecha_end" />
							<input type="hidden" name="id_agencia_pdf" id="id_agencia_pdf" />
							<input type="hidden" name="PDF" value="1" />
							<button type="button" class="btn mb-2 btn-secondary" id="btn_pdf"data-toggle="tooltip" data-placement="top" title="Imprimir PDF."> <i class="fas fa-print"></i> </button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
Yii::app()->clientScript->registerScript('header', '
	var hoy = "'.$hoy.'"
	var hoyMenos15Dias = "'.$hoyMenos15Dias.'"
', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/es-do.js', CClientScript::POS_END);

$this->renderPartial("/layouts/_call_js_kendo");

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/agenciasAgrupados.js?v='.time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/agenciasAgrupados_kendo.js?v='.time(), CClientScript::POS_END);
?>