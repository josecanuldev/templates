<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Recover");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Recover"),
);
?>

<h1><?php echo UserModule::t("Recover password"); ?></h1>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
    'type'=>'horizontal',
)); ?>

    <fieldset>
        
        <legend><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></legend>
        
        <?php echo $form->errorSummary($model); ?>
        
        <?php echo $form->textFieldRow($model,'login_or_email',array('hint'=>UserModule::t("Please enter your login or email addres."))); ?>

    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton',array(
            'label'=>UserModule::t("Recover"),
            'buttonType'=>'submit',
            'type'=>'primary',
        )); ?>
    </div>

<?php $this->endWidget(); ?>


<?php /* if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="row">
		<?php echo CHtml::activeLabel($form,'login_or_email'); ?>
		<?php echo CHtml::activeTextField($form,'login_or_email') ?>
		<p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
	</div>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Recover")); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php endif; */?>