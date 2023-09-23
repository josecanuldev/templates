<?php
$this->breadcrumbs=array(
	'Camionetas',
);

?>
<?php 
// Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/bootstrap-datepicker/bootstrap-datepicker.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/styles.scss');
Yii::app()->clientScript->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css');
$this->renderPartial("/layouts/_call_css_kendo");
?>
<style>
	#grid, #gridV{
		font-size: 13px;
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
</style>
<div id="drivers" class="font-weight-bold">
	<section class="bg-light text-left">
		<div class="container pb-5 pt-5">
			<div class="row">
				<?php $this->renderPartial('/layouts/_logo_transfer') ?>
				<div class="col-md-6 align-items-center text-center">
					<h1 class="text-dark"> Camionetas y Operadores </h1>
				</div>
				<?php $this->renderPartial('/layouts/_return_samy') ?>
			</div>
			<div class="row pb-3">
				<div class="col-md-6 col-xs-12">
					<h4><b>Operadores</b></h4>
				</div>
				<div class="col-md-6 col-xs-12 text-right">
					<a class="btn mb-2 btn-info" @click="openModal('driversModal')"> <i class="fa fa-plus"></i> Operador </a>
				</div>
				<div id="example">
					<div id="grid"></div>
				</div>
			</div>
			<div class="row pb-3 mt-4 border-top">
				<div class="col-md-6 col-xs-12 mt-4">
					<h4><b>Camionetas</b></h4>
				</div>
				<div class="col-md-6 col-xs-12 mt-4 text-right">
					<a class="btn mb-2 btn-info" @click="openModal('vansModal')"> <i class="fa fa-plus"></i> Camioneta </a>
				</div>
				<div id="example">
					<div id="gridV"></div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->renderPartial("_driversModal"); ?>
	<?php $this->renderPartial("_vansModal"); ?>
</div>

<?php 

Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js?v='.time(), CClientScript::POS_END);

$this->renderPartial("/layouts/_call_js_kendo");

// Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/es-do.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js?v='.time(), CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/drivers_kendo.js?v='.time(), CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/drivers.js?v='.time(), CClientScript::POS_END);

?>

