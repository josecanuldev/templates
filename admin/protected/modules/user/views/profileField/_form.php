<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array()); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>
	<div class="formrow varname">
	   <?php echo (($model->id)?$form->textFieldRow($model,'varname',array('class'=>'varname','size'=>60,'maxlength'=>50,'readonly'=>true)):$form->textFieldRow($model,'varname',array('class'=>'varname','size'=>60,'maxlength'=>50,'hint'=>UserModule::t("Allowed lowercase letters and digits.")))); ?>
    </div>
    <div class="formrow title">
	   <?php echo $form->textFieldRow($model,'title',array('class'=>'title','size'=>60,'maxlength'=>255,'hint'=>UserModule::t('Field name, named in the language of "sourceLanguage".'))); ?>
	</div>
	<div class="formrow field_type">
	   <?php echo (($model->id)?$form->textFieldRow($model,'field_type',array('class'=>'field_type','size'=>60,'maxlength'=>50,'readonly'=>true,'id'=>'field_type')):$form->DropDownListRow($model,'field_type',ProfileField::itemAlias('field_type'),array('class'=>'field_type','id'=>'field_type','hint'=>UserModule::t('Field type column in the database.')))); ?>
	</div>
	<div class="formrow field_size">
	   <?php echo (($model->id)?$form->textFieldRow($model,'field_size',array('class'=>'field_size','readonly'=>true)):$form->textFieldRow($model,'field_size',array('class'=>'field_size','hint'=>UserModule::t('Field size column in the database.')))); ?>
	</div>
	<div class="formrow field_size_min">
	   <?php echo $form->textFieldRow($model,'field_size_min',array('class'=>'field_size_min','hint'=>UserModule::t('The minimum value of the field (form validator).'))); ?>
	</div>
	<div class="formrow required">
	   <?php echo $form->dropDownListRow($model,'required',ProfileField::itemAlias('required'),array('class'=>'required','hint'=>UserModule::t('Required field (form validator).'))); ?>
	</div>
	<div class="formrow match">
	   <?php echo $form->textFieldRow($model,'match',array('class'=>'match','size'=>60,'maxlength'=>255,'hint'=>UserModule::t("Regular expression (example: '/^[A-Za-z0-9\s,]+$/u')."))); ?>
	</div>
	<div class="formrow range">
	   <?php echo $form->textFieldRow($model,'range',array('class'=>'range','size'=>60,'maxlength'=>5000,'hint'=>UserModule::t('Predefined values (example: 1;2;3;4;5 or 1==One;2==Two;3==Three;4==Four;5==Five).'))); ?>
	</div>
	<div class="formrow error_message">
	   <?php echo $form->textFieldRow($model,'error_message',array('class'=>'error_message','size'=>60,'maxlength'=>255,'hint'=>UserModule::t('Error message when you validate the form.'))); ?>
	</div>
	<div class="formrow other_validator">
	   <?php echo $form->textFieldRow($model,'other_validator',array('class'=>'other_validator','size'=>60,'maxlength'=>255,'hint'=>UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('file'=>array('types'=>'jpg, gif, png'))))))); ?>
	</div>
	<div class="formrow default">
	   <?php echo (($model->id)?$form->textFieldRow($model,'default',array('class'=>'default','size'=>60,'maxlength'=>255,'readonly'=>true)):$form->textFieldRow($model,'default',array('hint'=>'default','size'=>60,'maxlength'=>255,'hint'=>UserModule::t('The value of the default field (database).')))); ?>
	</div>
	<div class="formrow widget">
    	<?php 
            list($widgetsList) = ProfileFieldController::getWidgets($model->field_type);
            echo $form->dropDownListRow($model,'widget',$widgetsList,array('class'=>'widget','id'=>'widgetlist','hint'=>UserModule::t('Widget name.')));
        ?>
    </div>
    <div class="formrow widgetparams">
        <?php echo $form->textFieldRow($model,'widgetparams',array('class'=>'widgetparams','size'=>60,'maxlength'=>5000,'id'=>'widgetparams','hint'=>UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('param1'=>array('val1','val2'),'param2'=>array('k1'=>'v1','k2'=>'v2'))))))); ?>
	</div>
	<div class="formrow position">
	   <?php echo $form->textFieldRow($model,'position',array('class'=>'position','hint'=>UserModule::t('Display order of fields.'))); ?>
	</div>
	<div class="formrow visible">
	   <?php echo $form->dropDownListRow($model,'visible',ProfileField::itemAlias('visible'),array('class'=>'visible')); ?>
	</div>
	<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'primary',
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),
        )); ?>
    </div>
	
	<?php /*
	<div class="row varname">
		<?php echo CHtml::activeLabelEx($model,'varname'); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'varname',array('size'=>60,'maxlength'=>50,'readonly'=>true)):CHtml::activeTextField($model,'varname',array('size'=>60,'maxlength'=>50))); ?>
		<?php echo CHtml::error($model,'varname'); ?>
		<p class="hint"><?php echo UserModule::t("Allowed lowercase letters and digits."); ?></p>
	</div>

	<div class="row title">
		<?php echo CHtml::activeLabelEx($model,'title'); ?>
		<?php echo CHtml::activeTextField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'title'); ?>
		<p class="hint"><?php echo UserModule::t('Field name, named in the language of "sourceLanguage".'); ?></p>
	</div>

	<div class="row field_type">
		<?php echo CHtml::activeLabelEx($model,'field_type'); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'field_type',array('size'=>60,'maxlength'=>50,'readonly'=>true,'id'=>'field_type')):CHtml::activeDropDownList($model,'field_type',ProfileField::itemAlias('field_type'),array('id'=>'field_type'))); ?>
		<?php echo CHtml::error($model,'field_type'); ?>
		<p class="hint"><?php echo UserModule::t('Field type column in the database.'); ?></p>
	</div>

	<div class="row field_size">
		<?php echo CHtml::activeLabelEx($model,'field_size'); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'field_size',array('readonly'=>true)):CHtml::activeTextField($model,'field_size')); ?>
		<?php echo CHtml::error($model,'field_size'); ?>
		<p class="hint"><?php echo UserModule::t('Field size column in the database.'); ?></p>
	</div>

	<div class="row field_size_min">
		<?php echo CHtml::activeLabelEx($model,'field_size_min'); ?>
		<?php echo CHtml::activeTextField($model,'field_size_min'); ?>
		<?php echo CHtml::error($model,'field_size_min'); ?>
		<p class="hint"><?php echo UserModule::t('The minimum value of the field (form validator).'); ?></p>
	</div>

	<div class="row required">
		<?php echo CHtml::activeLabelEx($model,'required'); ?>
		<?php echo CHtml::activeDropDownList($model,'required',ProfileField::itemAlias('required')); ?>
		<?php echo CHtml::error($model,'required'); ?>
		<p class="hint"><?php echo UserModule::t('Required field (form validator).'); ?></p>
	</div>

	<div class="row match">
		<?php echo CHtml::activeLabelEx($model,'match'); ?>
		<?php echo CHtml::activeTextField($model,'match',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'match'); ?>
		<p class="hint"><?php echo UserModule::t("Regular expression (example: '/^[A-Za-z0-9\s,]+$/u')."); ?></p>
	</div>

	<div class="row range">
		<?php echo CHtml::activeLabelEx($model,'range'); ?>
		<?php echo CHtml::activeTextField($model,'range',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo CHtml::error($model,'range'); ?>
		<p class="hint"><?php echo UserModule::t('Predefined values (example: 1;2;3;4;5 or 1==One;2==Two;3==Three;4==Four;5==Five).'); ?></p>
	</div>

	<div class="row error_message">
		<?php echo CHtml::activeLabelEx($model,'error_message'); ?>
		<?php echo CHtml::activeTextField($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'error_message'); ?>
		<p class="hint"><?php echo UserModule::t('Error message when you validate the form.'); ?></p>
	</div>

	<div class="row other_validator">
		<?php echo CHtml::activeLabelEx($model,'other_validator'); ?>
		<?php echo CHtml::activeTextField($model,'other_validator',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'other_validator'); ?>
		<p class="hint"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('file'=>array('types'=>'jpg, gif, png'))))); ?></p>
	</div>

	<div class="row default">
		<?php echo CHtml::activeLabelEx($model,'default'); ?>
		<?php echo (($model->id)?CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255,'readonly'=>true)):CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255))); ?>
		<?php echo CHtml::error($model,'default'); ?>
		<p class="hint"><?php echo UserModule::t('The value of the default field (database).'); ?></p>
	</div>

	<div class="row widget">
		<?php echo CHtml::activeLabelEx($model,'widget'); ?>
		<?php 
		list($widgetsList) = ProfileFieldController::getWidgets($model->field_type);
		echo CHtml::activeDropDownList($model,'widget',$widgetsList,array('id'=>'widgetlist'));
		//echo CHtml::activeTextField($model,'widget',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo CHtml::error($model,'widget'); ?>
		<p class="hint"><?php echo UserModule::t('Widget name.'); ?></p>
	</div>

	<div class="row widgetparams">
		<?php echo CHtml::activeLabelEx($model,'widgetparams'); ?>
		<?php echo CHtml::activeTextField($model,'widgetparams',array('size'=>60,'maxlength'=>5000,'id'=>'widgetparams')); ?>
		<?php echo CHtml::error($model,'widgetparams'); ?>
		<p class="hint"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('param1'=>array('val1','val2'),'param2'=>array('k1'=>'v1','k2'=>'v2'))))); ?></p>
	</div>

	<div class="row position">
		<?php echo CHtml::activeLabelEx($model,'position'); ?>
		<?php echo CHtml::activeTextField($model,'position'); ?>
		<?php echo CHtml::error($model,'position'); ?>
		<p class="hint"><?php echo UserModule::t('Display order of fields.'); ?></p>
	</div>

	<div class="row visible">
		<?php echo CHtml::activeLabelEx($model,'visible'); ?>
		<?php echo CHtml::activeDropDownList($model,'visible',ProfileField::itemAlias('visible')); ?>
		<?php echo CHtml::error($model,'visible'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div> */ ?>

<?php $this->endWidget(); ?>

<div id="dialog-form" title="<?php echo UserModule::t('Widget parameters'); ?>">
	<form>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
		<label for="value">Value</label>
		<input type="text" name="value" id="value" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
