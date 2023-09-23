<?php
$this->breadcrumbs=array(
	'Agencies'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Agencies','url'=>array('index')),
	array('label'=>'Create Agencies','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('agencies-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Agencies</h1>

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
	'id'=>'agencies-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'uuid',
		'name',
		'description',
		'email',
		'attendant',
		/*
		'status',
		'created_at',
		'updated_at',
		'deleted_at',
		'email_two',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
