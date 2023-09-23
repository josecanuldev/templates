<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_sitio')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_sitio),array('view','id'=>$data->id_sitio)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sitio')); ?>:</b>
	<?php echo CHtml::encode($data->sitio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estatus')); ?>:</b>
	<?php echo CHtml::encode($data->estatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log')); ?>:</b>
	<?php echo CHtml::encode($data->log); ?>
	<br />


</div>