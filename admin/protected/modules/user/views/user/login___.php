<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<h1><?php echo UserModule::t("Login"); ?></h1>

<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
    'type'=>'horizontal',
)); ?>

    <fieldset>
        
        <legend><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></legend>
        
        <?php echo $form->errorSummary($model); ?>
        
        <?php echo $form->textFieldRow($model,'username'); ?>

        <?php echo $form->passwordFieldRow($model,'password', 
            array('hint'=>CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl))
        ); ?>

        <?php echo $form->checkBoxRow($model,'rememberMe'); ?>

    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'label'=>UserModule::t("Login"),
            'buttonType'=>'submit',
            'type'=>'primary',
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'label'=>UserModule::t("Register"),
            'buttonType'=>'link',
            'type'=>'warning',
            'url'=>Yii::app()->getModule('user')->registrationUrl,
        )); ?>

    </div>

<?php $this->endWidget(); ?>