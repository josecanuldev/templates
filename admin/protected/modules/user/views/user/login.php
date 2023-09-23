<?php
// $this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Login");
?>
<style>
   @media (max-width: 576px) {
    .text-center-xs {
        text-align: center;
    }
   }
</style>
<div id="app" class="font-weight-bold">

    <div class="bg-light text-dark vh-100">
        <div class="container pb-3 text-left h-100vh">

            <div class="row">
                <div class="col-md-12 text-center-xs">
                    <img src="<?=Yii::app()->baseUrl;?>/images/<?=Yii::app()->params["logo"]?>" alt="<?=Yii::app()->params["appTitle"]?>" style="width: 130px;">
                </div>
               <!--  <div class="col-md-12">
                    <h2><?=Yii::app()->params["appTitle"]?></h2>
                </div> -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span> Por favor ingrese su nombre de usuario y contraseña. </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <?php $form = $this->beginWidget('ext.bootstrap.widgets.TbActiveForm', array(
            	'type' => 'horizontal',
            	'id' => 'frm_login',
            	'htmlOptions' => array(),
            ));?>
            <!-- <form> -->
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="user-field">Usuario</label>
                        <!-- <input id="user-field" type="email" placeholder="Email" required="required" aria-required="true" class="form-control"> -->
                        <?php echo $form->textField($model, 'username', array("placeholder" => "Email", "class" => "form-control", "autocomplete" => "off", "required" => true, "id" => "user-field")); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="password-field"> Contraseña </label>
                        <!-- <input id="password-field" type="password" placeholder="Contraseña" required="required" aria-required="true" class="form-control"> -->
                        <?php echo $form->passwordField($model, 'password', array("placeholder" => "Contraseña", "class" => "form-control", "autocomplete" => "off", "id" => "password-field", "required" => true)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                           'label' => UserModule::t("Entrar"),
                           'buttonType' => 'submit',
                           'type' => 'primary',
                           'htmlOptions' => array('class' => 'btn btn-primary btn-lg'),
                       ));?>
                       <!-- <button class="btn btn-primary btn-lg"> Entrar </button> -->
                   </div>
               </div>
               <!-- </form> -->
               <?php echo $form->errorSummary($model); ?>
               <?php $this->endWidget();?>
           </div>
       </div>
   </div>