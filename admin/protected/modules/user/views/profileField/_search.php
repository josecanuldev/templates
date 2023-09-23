<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
        <?php echo $form->textFieldRow($model,'id'); ?>
        <?php echo $form->textFieldRow($model,'varname',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->textFieldRow($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->dropDownListRow($model,'field_type',ProfileField::itemAlias('field_type')); ?>
        <?php echo $form->textFieldRow($model,'field_size'); ?>
        <?php echo $form->textFieldRow($model,'field_size_min'); ?>
        <?php echo $form->dropDownListRow($model,'required',ProfileField::itemAlias('required')); ?>
        <?php echo $form->textFieldRow($model,'match',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->textFieldRow($model,'range',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->textFieldRow($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->textFieldRow($model,'other_validator',array('size'=>60,'maxlength'=>5000)); ?>
        <?php echo $form->textFieldRow($model,'default',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->textFieldRow($model,'widget',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->textFieldRow($model,'widgetparams',array('size'=>60,'maxlength'=>5000)); ?>
        <?php echo $form->textFieldRow($model,'position'); ?>
        <?php echo $form->dropDownListRow($model,'visible',ProfileField::itemAlias('visible')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'primary',
            'buttonType'=>'submit',
            'label'=>UserModule::t('Search'),
        )); ?>
    </div>

<?php $this->endWidget(); ?>