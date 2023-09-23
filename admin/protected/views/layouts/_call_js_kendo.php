<?php

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/kendo/js/jszip.min.js?v='.time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/kendo/js/kendo.all.min.js?v='.time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/kendo/js/cultures/kendo.culture.es-MX.min.js?v='.time(), CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/kendo/js/messages/kendo.messages.es-MX.min.js?v='.time(), CClientScript::POS_END);

?>