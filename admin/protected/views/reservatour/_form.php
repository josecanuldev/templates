<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'reservatour-form',
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

	<?php echo $form->textFieldRow($model,'idExperiencia',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pasajeros',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'tipoViaje',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'fechaLLegada',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'horarioLLegada',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'fechaSalida',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'horarioSalida',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'desde',array('class'=>'span5','maxlength'=>300)); ?>

	<?php echo $form->textFieldRow($model,'nombre',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'apellido',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'correo',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'telefono',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'pais',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'ciudad',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'idioma',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'fechaReservacion',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'concepto',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'conceptoEn',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'aerolinea',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'numeroVuelo',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'datePrivada',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'horaPrivada',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'abordaje',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'tipoVuelo',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'tipoPrivadoEstandar',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'hotel',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'hotelSalida',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'inverso',array('class'=>'span5','maxlength'=>15)); ?>

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
