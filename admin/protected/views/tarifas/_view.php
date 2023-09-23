<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tarifa')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_tarifa),array('view','id'=>$data->id_tarifa)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ruta')); ?>:</b>
	<?php echo CHtml::encode($data->id_ruta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_tarifa')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_tarifa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_tarifa')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_tarifa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo')); ?>:</b>
	<?php echo CHtml::encode($data->codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_final')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_final); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('moneda')); ?>:</b>
	<?php echo CHtml::encode($data->moneda); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_cambio')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_cambio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estatus')); ?>:</b>
	<?php echo CHtml::encode($data->estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_reembosable')); ?>:</b>
	<?php echo CHtml::encode($data->no_reembosable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('restricciones')); ?>:</b>
	<?php echo CHtml::encode($data->restricciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('terminoscondiciones')); ?>:</b>
	<?php echo CHtml::encode($data->terminoscondiciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('politicas_cancelacion')); ?>:</b>
	<?php echo CHtml::encode($data->politicas_cancelacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipoviaje')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipoviaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_updated')); ?>:</b>
	<?php echo CHtml::encode($data->last_updated); ?>
	<br />

	*/ ?>

</div>