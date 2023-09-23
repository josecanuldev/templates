<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Change Password"),
);
?>

<h1><?php echo UserModule::t("Change Password"); ?></h1>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
    'type'=>'horizontal',
)); ?>

    <fieldset>
        
        <legend><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></legend>
        
        <?php echo $form->errorSummary($model); ?>
        
        <?php echo $form->passwordFieldRow($model,'password'); ?>
        <?php echo $form->passwordFieldRow($model,'verifyPassword'); ?>

    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'label'=>UserModule::t("Save"),
            'buttonType'=>'submit',
            'type'=>'primary',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
<?php /*
<div class="form">
<?php echo CHtml::beginForm(); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="row">
	<?php echo CHtml::activeLabelEx($form,'password'); ?>
	<?php echo CHtml::activePasswordField($form,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 8 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo CHtml::activeLabelEx($form,'verifyPassword'); ?>
	<?php echo CHtml::activePasswordField($form,'verifyPassword'); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(UserModule::t("Save")); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form --> */ ?>