<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

        <?php echo $form->textFieldRow($model,'id'); ?>
        <?php echo $form->textFieldRow($model,'username',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->textFieldRow($model,'activkey',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->textFieldRow($model,'create_at'); ?>
        <?php echo $form->textFieldRow($model,'lastvisit_at'); ?>
        <?php echo $form->dropDownListRow($model,'superuser',$model->itemAlias('AdminStatus'), array('prompt'=>'')); ?>
        <?php echo $form->dropDownListRow($model,'status',$model->itemAlias('UserStatus'), array('prompt'=>'')); ?>
    
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'type'=>'primary',
            'buttonType'=>'submit',
            'label'=>UserModule::t('Search'),
        )); ?>
    </div>

<?php $this->endWidget(); ?>