<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'id'=>'search-vans-form',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
));  ?>


	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'uuid',array('class'=>'span5','maxlength'=>36)); ?>

	<?php echo $form->textFieldRow($model,'model',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'plates',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'max_passenger',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'created_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'updated_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'deleted_at',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'brand',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'seats_remove',array('class'=>'span5')); ?>

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
		$(":input","#search-vans-form").each(function() {
		var type = this.type;
		var tag = this.tagName.toLowerCase(); // normalize case
		if (type == "text" || type == "password" || tag == "textarea") this.value = "";
		else if (type == "checkbox" || type == "radio") this.checked = false;
		else if (tag == "select") this.selectedIndex = "";
	  });
	});
   </script>

