<?php
include_once('conexion.php');
require_once('archivo.php');
require_once('herramientas.php');

class productoxsolucion
{

	var $productos;
	var $soluciones;
	var $idProducto;
	var $idSolucion;
	var $herramientas;

function __construct($idSolucion=0,$idProducto=0)
{
	$this->productos=array();
	$this->soluciones=array();
	$this->idProducto=$idProducto;
	$this->idSolucion=$idSolucion;
	$this -> herramientas       = new herramientas();
}

function asigna_productoxsolucion()
{
	$sql = "INSERT INTO productoxsolucion (idSolucion, idProducto) VALUES ('".$this->idSolucion."', '".$this->idProducto."')";
	$con=new conexion();
	//$sql='INSERT INTO productoxsolucion (idProducto,idSolucion) VALUES ('.idProducto.','.idSolucion.')';
	$con->ejecutar_sentencia($sql);
}

function existe_productoxsolucion($idSolucion, $idProducto)
{
	$con=new conexion();
	$sql='SELECT idSolucion, idProducto FROM productoxsolucion WHERE idSolucion='.$idSolucion.' AND idProducto='.$idProducto;
	$datos = $con ->ejecutar_sentencia($sql);
	$resultados= array();
	while ($row = mysqli_fetch_array($datos)) {
		$registro = array();
		$registro['idProducto'] = $row['idProducto'];
		$registro['idSolucion'] = $row['idSolucion'];
		array_push($resultados, $registro);
	}
	mysqli_free_result($datos);
	return $resultados;
}

function obtener_solucionesxproducto()
{
	$con=new conexion();
	$sql='select idSolucion from productoxsolucion where idProducto='.$this->idProducto;
	$resultados=$con->ejecutar_sentencia($sql);
	while ($fila=mysqli_fetch_array($resultados))
	{
	array_push($this->soluciones,$fila['idSolucion']);
	}
}
function obtener_productosxsolucion()
{
	$con=new conexion();
	$sql='select idProducto from productoxsolucion where idSolucion='.$this->idSolucion;
	$resultados=$con->ejecutar_sentencia($sql);
	while ($fila=mysqli_fetch_array($resultados))
	{
	array_push($this->productos,$fila['idProducto']);
	}
}



function desasignar_solucionxproducto()
{
	$con=new conexion();
	$sql='DELETE FROM productoxsolucion WHERE idSolucion='.$this->idSolucion;
	$con->ejecutar_sentencia($sql);
}

function getsolucionesxproducto($idProducto,$idioma){
	if($idioma=='en'){
		$idiomaR=1;
	}
	else{
		$idiomaR=0;
	}
	$sql = "SELECT * FROM blog, datosBlog, productoxsolucion WHERE blog.idBlog=productoxsolucion.idSolucion AND datosBlog.idBlog = productoxsolucion.idSolucion AND blog.idioma=".$idiomaR." AND productoxsolucion.idProducto=".$idProducto;
		$conexion = new conexion();
		$datos = $conexion ->ejecutar_sentencia($sql);
		$resultados= array();
		while ($row = mysqli_fetch_array($datos)) {
			$registro['idSolucion'] = $row['idBlog'];
			$registro['titulo'] = $row['titulo'];
			$registro['fechaCreacion'] = $this -> herramientas -> getFormatedDate($row['fechaCreacion']);
			$registro['portada']= $row['portada'];
			$registro['urlAmigable']= $row['urlAmigable'];
			$registro['descripcion']=$this -> herramientas -> cortarTexto(htmlspecialchars_decode($row['descripcionCorta']), 100);
			array_push($resultados, $registro);
		}
		mysqli_free_result($datos);
		return $resultados;
		
}
function getproductoxsolucion($idSolucion){
	$sql = "SELECT * FROM producto, productoxsolucion WHERE producto.idProducto=productoxsolucion.idProducto AND productoxsolucion.idSolucion=".$idSolucion;
		$conexion = new conexion();
		$datos = $conexion ->ejecutar_sentencia($sql);
		$resultados= array();
		while ($row = mysqli_fetch_array($datos)) {
			$registro['idProducto'] = $row['idProducto'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($datos);
		return $resultados;
		
}





}
?>