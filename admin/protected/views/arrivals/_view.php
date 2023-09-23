<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idorden')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idorden),array('view','id'=>$data->idorden)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idreserva')); ?>:</b>
	<?php echo CHtml::encode($data->idreserva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento')); ?>:</b>
	<?php echo CHtml::encode($data->descuento); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('idCodigoPromo')); ?>:</b>
	<?php echo CHtml::encode($data->idCodigoPromo); ?>
	<br />

	*/ ?>

</div>