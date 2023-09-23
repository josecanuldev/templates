<?php
$this->breadcrumbs=array(
	'Tarifases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Tarifas','url'=>array('index')),
	array('label'=>'Create Tarifas','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tarifas-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tarifases</h1>

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
	'id'=>'tarifas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_tarifa',
		'id_ruta',
		'id_tipo_tarifa',
		'nombre_tarifa',
		'codigo',
		'fecha_inicio',
		/*
		'fecha_final',
		'moneda',
		'tipo_cambio',
		'estatus',
		'no_reembosable',
		'restricciones',
		'terminoscondiciones',
		'politicas_cancelacion',
		'id_tipoviaje',
		'last_updated',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
