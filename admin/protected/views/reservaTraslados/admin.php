<?php
$this->breadcrumbs=array(
	'Reserva Trasladoses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ReservaTraslados','url'=>array('index')),
	array('label'=>'Create ReservaTraslados','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('reserva-traslados-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Reserva Trasladoses</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'reserva-traslados-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_reservacion',
		'codigo',
		'folio',
		'id_agencia',
		'id_usuario',
		'fecha_llegada',
		/*
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
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
