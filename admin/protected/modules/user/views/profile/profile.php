<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);
$this->menu=array(
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin/admin'), 'visible'=>UserModule::isAdmin()),
    array('label'=>UserModule::t('List Users'), 'url'=>array('/user/user/index')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout/logout')),
); ?>
<h1><?php echo UserModule::t('Your profile'); ?></h1>

<?php
 
    $attributes = array(
        'username',
        'email',
    );
    
    $profileFields=ProfileField::model()->forOwner()->sort()->findAll();
    if ($profileFields) {
        foreach($profileFields as $field) {
            array_push($attributes,array(
                    'label' => UserModule::t($field->title),
                    'name' => $field->varname,
                    'type'=>'raw',
                    'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
                ));
        }
    }
    
    array_push($attributes,
        'create_at',
        'lastvisit_at',
        array(
            'name' => 'status',
            'value' => User::itemAlias("UserStatus",$model->status),
        )
    );
    
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'data'=>$model,
        'attributes'=>$attributes,
    ));
?>