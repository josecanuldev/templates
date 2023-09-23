<?php
include_once('conexion.php');
require_once('archivo.php');
require_once('herramientas.php');

class ingredientexproducto
{

	var $ingredientes;
	var $productos;
	var $idIngrediente;
	var $idProducto;
	var $herramientas;

function __construct($idProducto=0,$idIngrediente=0)
{
	$this->ingredientes=array();
	$this->productos=array();
	$this->idIngrediente=$idIngrediente;
	$this->idProducto=$idProducto;
	$this -> herramientas       = new herramientas();
}

function asigna_ingredientexproducto()
{
	$sql = "INSERT INTO ingredientexproducto (idProducto, idIngrediente) VALUES ('".$this->idProducto."', '".$this->idIngrediente."')";
	$con=new conexion();
	//$sql='INSERT INTO productoxsolucion (idProducto,idSolucion) VALUES ('.idProducto.','.idSolucion.')';
	$con->ejecutar_sentencia($sql);
}

function existe_ingredientexproducto($idProducto, $idIngrediente)
{
	$con=new conexion();
	$sql='SELECT idProducto, idIngrediente FROM ingredientexproducto WHERE idProducto='.$idProducto.' AND idIngrediente='.$idIngrediente;
	$datos = $con ->ejecutar_sentencia($sql);
	$resultados= array();
	while ($row = mysqli_fetch_array($datos)) {
		$registro = array();
		$registro['idProducto'] = $row['idProducto'];
		$registro['idIngrediente'] = $row['idIngrediente'];
		array_push($resultados, $registro);
	}
	mysqli_free_result($datos);
	return $resultados;
}

function obtener_productosxingrediente()
{
	$con=new conexion();
	$sql='select idProducto from ingredientexproducto where idIngrediente='.$this->idIngrediente;
	$resultados=$con->ejecutar_sentencia($sql);
	while ($fila=mysqli_fetch_array($resultados))
	{
	array_push($this->productos,$fila['idProducto']);
	}
}
function obtener_ingredientesxproducto()
{
	$con=new conexion();
	$sql='select idIngrediente from ingredientexproducto where idProducto='.$this->idProducto;
	$resultados=$con->ejecutar_sentencia($sql);
	while ($fila=mysqli_fetch_array($resultados))
	{
	array_push($this->ingredientes,$fila['idIngrediente']);
	}
}



function desasignar_productoxingrediente()
{
	$con=new conexion();
	$sql='DELETE FROM ingredientexproducto WHERE idProducto='.$this->idProducto;
	$con->ejecutar_sentencia($sql);
}

/*function getsolucionesxproducto($idProducto){
	$sql = "SELECT * FROM blog, datosBlog, productoxsolucion WHERE blog.idBlog=productoxsolucion.idSolucion AND datosBlog.idBlog = productoxsolucion.idSolucion AND productoxsolucion.idProducto=".$idProducto;
		$conexion = new conexion();
		$datos = $conexion ->ejecutar_sentencia($sql);
		$resultados= array();
		while ($row = mysqli_fetch_array($datos)) {
			$registro['idSolucion'] = $row['idBlog'];
			$registro['titulo'] = $row['titulo'];
			$registro['fechaCreacion'] = $this -> herramientas -> getFormatedDate($row['fechaCreacion']);
			$registro['portada']= $row['portada'];
			$registro['urlAmigable']= $row['urlAmigable'];

			array_push($resultados, $registro);
		}
		mysqli_free_result($datos);
		return $resultados;
		
}*/
function getingredientexproducto($idProducto){
	$sql = "SELECT * FROM ingredientexproducto, ingrediente WHERE ingrediente.status=1 AND ingrediente.idIngrediente=ingredientexproducto.idIngrediente AND ingredientexproducto.idProducto=".$idProducto." order by ingrediente.orden DESC";
		$conexion = new conexion();
		$datos = $conexion ->ejecutar_sentencia($sql);
		$resultados= array();
		while ($row = mysqli_fetch_array($datos)) {
			$registro['idIngrediente'] = $row['idIngrediente'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['nombreEn'] = htmlspecialchars_decode($row['nombreEn']);

			array_push($resultados, $registro);
		}
		mysqli_free_result($datos);
		return $resultados;
		
}





}
?>