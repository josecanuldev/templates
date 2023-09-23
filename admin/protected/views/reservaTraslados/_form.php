<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'reserva-traslados-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
	'type'=>'horizontal',
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data'
	)
)); ?>
     	<fieldset>
		<legend>
			<p class="note">Fields with <span class="required">*</span> are required.</p>
		</legend>

	<?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
        		
   <div class="control-group">		
			<div class="span4">

	<?php echo $form->textFieldRow($model,'codigo',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'folio',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_agencia',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_usuario',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fecha_llegada',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'hora_llegada',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'aerolinea_llegada',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'num_vuelo_llegada',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fecha_salida',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'hora_pick_up',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'hora_vuelo_salida',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'aerolinea_salida',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'num_vuelo_salida',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'tipo_viaje',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pasajeros',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'fecha_limite',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'observaciones',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'estatus',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'log',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'total',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'saldo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'tarifa_agencia',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'moneda',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'manual',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'motivo_cancelacion',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'politicas_cancelacion',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

                        </div>   
  </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'icon'=>'ok white',  
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
              <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
                        'icon'=>'remove',  
			'label'=>'Reset',
		)); ?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>

</div>
