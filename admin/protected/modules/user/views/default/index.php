<?php
$this->breadcrumbs=array(
	UserModule::t("Users"),
);
?>

<h1><?php echo UserModule::t("List Users"); ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("view","id"=>$data->id))',
		),
		'create_at',
		'lastvisit_at',
	),
)); ?>
