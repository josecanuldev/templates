<?php
$this->breadcrumbs=array(
	'Reservatours'=>array('index'),
	$model->idreserva,
);
?>

<h1>View Reservatour #<?php echo $model->idreserva; ?></h1>
<hr />
<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Create', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>'List', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
                array('label'=>'Update', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('update',array('id'=>$model->id)), 'linkOptions'=>array()),
		//array('label'=>'Search', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
		array('label'=>'Print', 'icon'=>'icon-print', 'url'=>'javascript:void(0);return false', 'linkOptions'=>array('onclick'=>'printDiv();return false;')),

)));
$this->endWidget();
?>
<div class='printableArea'>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'idreserva',
		'idExperiencia',
		'pasajeros',
		'tipoViaje',
		'fechaLLegada',
		'horarioLLegada',
		'fechaSalida',
		'horarioSalida',
		'desde',
		'nombre',
		'apellido',
		'correo',
		'telefono',
		'pais',
		'ciudad',
		'idioma',
		'fechaReservacion',
		'concepto',
		'conceptoEn',
		'aerolinea',
		'numeroVuelo',
		'datePrivada',
		'horaPrivada',
		'abordaje',
		'tipoVuelo',
		'tipoPrivadoEstandar',
		'hotel',
		'hotelSalida',
		'inverso',
	),
)); ?>
</div>
<style type="text/css" media="print">
body {visibility:hidden;}
.printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
function printDiv()
{

window.print();

}
</script>
