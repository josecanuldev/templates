<?php
session_start();
function __autoload($nombre_clase) {
    include ''.$nombre_clase .'.php';
}

$item_number=$_POST['idorden'];
$barcode=$_POST['barcode'];
$imagen=$_POST['imagen'];


?>

<?php

   $correoProcesandoOrden = new correoProcesandoOrdenOxxo($item_number,$barcode,$imagen);
					$correoProcesandoOrden->enviar();
					








?>