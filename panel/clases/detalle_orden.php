<?php

include_once('conexion.php');
include_once('producto.php');

class detalle_orden
{

var $ordenes;
var $productos;
var $idOrden;
var $idProducto;
var $idCombinacion;
var $precio;
var $cantidad;
var $nombreProducto;
var $descripcion;
var $ruta;
var $descuento;
var $atributos;

function detalle_orden($idOrden=0, $idProducto=0, $idCombinacion=0, $precio=0, $cantidad=0, $nombreProducto='', $descripcion='', $ruta='', $descuento='', $atributos='')
{
$this->ordenes=array();
$this->productos=array();
$this->idOrden=$idOrden;
$this->idProducto=$idProducto;
$this->idCombinacion=$idCombinacion;
$this->precio=$precio;
$this->cantidad=$cantidad;
$this->nombreProducto=$nombreProducto;
$this->descripcion=$descripcion;
$this->ruta=$ruta;
$this->descuento=$descuento;
$this->atributos=$atributos;
}

function asigna_productos_orden()
{
$con=new conexion();
$sql='insert into detalle_orden (idOrden,idProducto,idCombinacion,precio,cantidad,nombre,descripcion,ruta,descuento,atributos) values('.$this->idOrden.','.$this->idProducto.','.$this->idCombinacion.',"'.$this->precio.'",'.$this->cantidad.',"'.$this->nombreProducto.'","'.$this->descripcion.'","'.$this->ruta.'","'.$this->descuento.'","'.$this->atributos.'")';
$con->ejecutar_sentencia($sql);

}

function obtener_producto_detalle($idorden)
{
$con= new Conexion();
$sql="select * from detalle_orden where idOrden=".$this->idOrden;
$result=$conexion->ejecutar_sentencia($sql);
		
$resultados= array();
		
while($row=mysqli_fetch_array($result))
{
$registro=array();
$registro['idProducto']=$row['idProducto'];
$registro['idCombinacion']=$row['idCombinacion'];
$registro['cantidad']=$row['cantidad'];
$registro['precio']=$row['precio'];
$registro['nombre']=$row['nombre'];
$registro['descripcion']=$row['descripcion'];
$registro['ruta']=$row['ruta'];
$registro['descuento']=$row['descuento'];
$registro['atributos']=$row['atributos'];
array_push($resultados, $registro);
}
mysqli_free_result($result);
return $resultados;
}

function eliminarOrdenes(){
	$con = new conexion();
	$sql = "delete from detalle_orden where idOrden =".$this->idOrden;
	$con->ejecutar_sentencia($sql);
}
function obtener_productos_orden()
{
$con= new conexion();
$sql='select * from detalle_orden where idOrden='.$this->idOrden.'';

$resultado=$con->ejecutar_sentencia($sql); 

while($fila=mysqli_fetch_array($resultado))
{
$temporal=new producto();
$temporal->idProducto = $fila['idProducto'];
$temporal->idCombinacion = $fila['idCombinacion'];
$temporal->nombre = $fila['nombre'];
$temporal->precio = $fila['precio'];
$temporal->cantidad = $fila['cantidad'];
$temporal->descripcion = $fila['descripcion'];
$temporal->ruta = $fila['ruta'];
$temporal->descuento = $fila['descuento'];
$temporal->atributos = $fila['atributos'];
array_push($this->productos,$temporal);
}
}


}
?>