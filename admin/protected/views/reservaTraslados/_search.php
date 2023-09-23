<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'search-reserva-traslados-form',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));  ?>


	<?php echo $form->textFieldRow($model,'id_reservacion',array('class'=>'span5')); ?>

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
		$(":input","#search-reserva-traslados-form").each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase(); // normalize case
		if (type == "text" || type == "password" || tag == "textarea") this.value = "";
		else if (type == "checkbox" || type == "radio") this.checked = false;
		else if (tag == "select") this.selectedIndex = "";
	  });
	});
   </script>

