<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change Password"),
);
$this->menu=array(
	array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin/admin'), 'visible'=>UserModule::isAdmin()),
    array('label'=>UserModule::t('List Users'), 'url'=>array('/user/default/index')),
    array('label'=>UserModule::t('Profile'), 'url'=>array('/user/profile/profile')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout/logout')),
);
?>

<h1><?php echo UserModule::t("Change password"); ?></h1>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
    'type'=>'horizontal',
    'id'=>'changepassword-form',
    'enableAjaxValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <fieldset>
        
        <legend><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></legend>
        
        <?php echo $form->errorSummary($model); ?>
        
        <?php echo $form->passwordFieldRow($model,'oldPassword'); ?>
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
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'oldPassword'); ?>
	<?php echo $form->passwordField($model,'oldPassword'); ?>
	<?php echo $form->error($model,'oldPassword'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	
	<div class="row submit">
	<?php echo CHtml::submitButton(UserModule::t("Save")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form --> */ ?>