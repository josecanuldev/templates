<?php
// Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/styles.scss');
$this->breadcrumbs=array(
	'Tarifas'=>array('index'),
	'Create',
);
$categorias = Categoriasdestinos::model()->findAll('estatus=1');
$rutas = Rutas::model()->findAll();
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

</style>

<div id="app" class="font-weight-bold">
	<section class="bg-light text-left">
		<div class="container pb-5 mt-4">
			<!-- <h4>Crear Tarifa</h4> -->
			<!-- <hr/> -->
			<?php 
			// $this->beginWidget('zii.widgets.CPortlet', array(
			// 	'htmlOptions'=>array(
			// 		'class'=>'container'
			// 	)
			// ));
			// $this->widget('bootstrap.widgets.TbMenu', array(
			// 	'type'=>'pills',
			// 	'items'=>array(
			// 		array('label'=>'Create', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'),'active'=>true, 'linkOptions'=>array()),
			//                 array('label'=>'List', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
			// 		array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
			// 	),
			// ));
			// $this->endWidget();
			?>

			<?php echo $this->renderPartial('_form', array('model'=>$model, 'categorias' => $categorias, 'rutas' => $rutas)); ?>
		</div>
	</section>
</div>