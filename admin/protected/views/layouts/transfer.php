<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="shortcut icon" sizes="32x32" href="https://cancuntoislamujeres.com/img/favicon/favicon-32x32.png">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&amp;display=swap" rel="stylesheet">
	<title><?=Yii::app()->params["appTitle"]?></title>
	<link rel="stylesheet" href="<?=Yii::app()->baseUrl;?>/assets/bootstrap-4.6.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<style type="text/css">
		body {
			font-family: Roboto,sans-serif;
		}
	</style>
</head>
<body>
	<?php echo $content; ?>
	<script>
		var baseUrl = '<?=Yii::app()->baseUrl;?>'
	</script>
	<script type="text/javascript" src="<?=Yii::app()->baseUrl;?>/assets/js/jquery-3.6.0.min.js?v=<?=time()?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js?v=<?=time()?>"></script>
	<script type="text/javascript" src="<?=Yii::app()->baseUrl;?>/assets/bootstrap-4.6.1/js/bootstrap.min.js?v=<?=time()?>"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js?v=<?=time()?>"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js?v=<?=time()?>"></script>
	<script type="text/javascript" src="<?=Yii::app()->baseUrl;?>/assets/vue/vue.min.js?v=<?=time()?>"></script>
	<script type="text/javascript" src="<?=Yii::app()->baseUrl;?>/assets/vue/vue-resource.min.js?v=<?=time()?>"></script>
</body>
</html>