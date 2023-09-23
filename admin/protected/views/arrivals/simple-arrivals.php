<?php 
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/kendo/css/kendo.common.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/kendo/css/kendo.default.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/kendo/css/kendo.default.mobile.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/kendo/css/kendo.metro.min.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/kendo/css/kendo.metro.mobile.min.css');

?>

<style type="text/css">
	#grid{
		/*font-size: 12px;*/
	}
</style>
<div id="app" class="font-weight-bold">
	<section class="bg-light text-left">
		<div class="container pb-5 pt-5">
			<div class="row">
				<?php $this->renderPartial('/layouts/_logo_transfer') ?>
				<div class="col-md-6 align-items-center text-center">
					<h1 class="text-dark"> Holbox - Llegadas </h1>
					<span>Servicios de transportación</span><br><span><?=$date?></span>
				</div>
				<?php $this->renderPartial('/layouts/_return_samy') ?>
			</div>
			<div class="row">
				<div id="example">
					<div id="grid"></div>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-md-3 col-sm-12 text-center">
					<div class="row border border-dark">
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
									<span>0</span>
								</div>
								<div class="col-md-6 col-sm-6">
									Menores
								</div>
								<div class="col-md-6 col-sm-6">
									<span>0</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-sm-12 text-right">
					<a class="btn mb-2 btn-secondary"> <i class="fas fa-print"></i> </a>
				</div>
			</div>
		</div>
	</section>
</div>

<?php 
Yii::app()->clientScript->registerScript('url_site', '

	var url_site = "/arrivals/getSimpleArrivals";

	', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/kendo/js/jszip.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/kendo/js/kendo.all.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/kendo/js/cultures/kendo.culture.es-MX.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/kendo/js/messages/kendo.messages.es-MX.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/listadoSimpleArrivals.js?v='.time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/changeValues.js?v='.time(), CClientScript::POS_END);

?>

<script type="text/javascript">

</script>