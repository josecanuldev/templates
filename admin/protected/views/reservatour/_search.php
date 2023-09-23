<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'search-reservatour-form',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));  ?>


	<?php echo $form->textFieldRow($model,'idreserva',array('class'=>'span5')); ?>

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

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Search')); ?>
               <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
	</div>

<?php $this->endWidget(); ?>


<?php $cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap/jquery-ui.css');
?>	
   <script>
	$(".btnreset").click(function(){
		$(":input","#search-reservatour-form").each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase(); // normalize case
		if (type == "text" || type == "password" || tag == "textarea") this.value = "";
		else if (type == "checkbox" || type == "radio") this.checked = false;
		else if (tag == "select") this.selectedIndex = "";
	  });
	});
   </script>

