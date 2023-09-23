<?php
$this->breadcrumbs=array(
	'Agencies',
);

?>
<?php 
$this->renderPartial("/layouts/_call_css_kendo");
?>
<style>
	#grid{
		font-size: 13px;
		color: initial;
	}

	#grid.k-grid tbody .k-button {
		min-width: 40px;
	}
</style>
<div id="agencies" class="font-weight-bold">
	<section class="bg-light text-left">
		<div class="container pb-5 pt-5">
			<div class="row">
				<?php $this->renderPartial('/layouts/_logo_transfer') ?>
				<div class="col-md-6 align-items-center text-center">
					<h1 class="text-dark"> Agencias </h1>
				</div>
				<?php $this->renderPartial('/layouts/_return_samy') ?>
			</div>
			<div class="row pb-3">
				<div class="col-md-12 text-right">
					<a class="btn mb-2 btn-info" @click="openModal"> <i class="fa fa-plus"></i> Agencia </a>
				</div>
				<div id="example">
					<div id="grid"></div>
				</div>
			</div>
		</div>
		<?php $this->renderPartial("_agenciesModal",array("idModal" => "agenciesModal")); ?>
	</section>
</div>

<?php 

Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js?v='.time(), CClientScript::POS_END);

$this->renderPartial("/layouts/_call_js_kendo");

Yii::app()->clientScript->registerScript('modal', '
	var agenciesModal = "agenciesModal";
', CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js?v='.time(), CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/agencies_kendo.js?v='.time(), CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/agencies.js?v='.time(), CClientScript::POS_END);

?>

