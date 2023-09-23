<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ruta')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_ruta),array('view','id'=>$data->id_ruta)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_origen')); ?>:</b>
	<?php echo CHtml::encode($data->id_origen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_destino')); ?>:</b>
	<?php echo CHtml::encode($data->id_destino); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menor_paga')); ?>:</b>
	<?php echo CHtml::encode($data->menor_paga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('edad_menor_paga')); ?>:</b>
	<?php echo CHtml::encode($data->edad_menor_paga); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_updated')); ?>:</b>
	<?php echo CHtml::encode($data->last_updated); ?>
	<br />


</div>