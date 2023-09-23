<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';
}
$precioBase=$_REQUEST["precioBase"];
$lote = new tarifaDatos();
$listaLote=$lote->listaTarifaDatosUpdate();
foreach($listaLote as $elementoLote){
  //echo 'Lote: '.$elementoLote['lote'].' ';
  $precioFinal=$elementoLote["conceptoEn"];
  $precioFinalPrecio=$precioFinal*$precioBase;
  $updateLote=new tarifaDatos($elementoLote["idTarifaDatos"]);
  $updateLote->editarTarifaDatosUpdate($precioFinalPrecio);
}
?>
