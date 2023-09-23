<?php
$this->breadcrumbs=array(
	'Reserva Trasladoses'=>array('index'),
	$model->id_reservacion,
);
?>

<h1>View ReservaTraslados #<?php echo $model->id_reservacion; ?></h1>
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
		'id_reservacion',
		'codigo',
		'folio',
		'id_agencia',
		'id_usuario',
		'fecha_llegada',
		'hora_llegada',
		'aerolinea_llegada',
		'num_vuelo_llegada',
		'fecha_salida',
		'hora_pick_up',
		'hora_vuelo_salida',
		'aerolinea_salida',
		'num_vuelo_salida',
		'tipo_viaje',
		'pasajeros',
		'fecha_limite',
		'observaciones',
		'estatus',
		'log',
		'total',
		'saldo',
		'tarifa_agencia',
		'moneda',
		'manual',
		'motivo_cancelacion',
		'politicas_cancelacion',
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
