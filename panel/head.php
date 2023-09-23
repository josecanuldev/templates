<?php
    if(isset($_SESSION['idusuario']))
        $idusuario=$_SESSION['idusuario'];
    else
        $idusuario=0;

    $usuario=new usuario($idusuario,'','','',0);
    $usuario->obten_usuario();
    $usuario->datosusuario->obtener_datos_usuario();
    $conf='conf';
    $page = $_SERVER['SCRIPT_NAME'];
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel Make It Web">
    <meta name="author" content="Carlos David Baas Santiago">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Add custom CSS here -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/b0a941b1a8.css">
    <link href="js/summernote/summernote.css" rel="stylesheet">
    <link href="css/bootstrap-notify.css" rel="stylesheet">
	<link href="css/alert-bangtidy.css" rel="stylesheet">
	<link href="css/alert-blackgloss.css" rel="stylesheet">
	<link href="js/multi-select/css/multi-select.css" rel="stylesheet">
    <link href="css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/alertify.css" />

    <link href="css/bootstrap-colorpicker.min.css" rel="stylesheet">
