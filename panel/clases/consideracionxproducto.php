<?php
include_once('conexion.php');
require_once('archivo.php');
require_once('herramientas.php');

class consideracionxproducto
{

	var $consideraciones;
	var $productos;
	var $idConsideracion;
	var $idProducto;
	var $herramientas;

function __construct($idProducto=0,$idConsideracion=0)
{
	$this->consideraciones=array();
	$this->productos=array();
	$this->idConsideracion=$idConsideracion;
	$this->idProducto=$idProducto;
	$this -> herramientas       = new herramientas();
}

function asigna_consideracionxproducto()
{
	$sql = "INSERT INTO consideracionxproducto (idProducto, idConsideracion) VALUES ('".$this->idProducto."', '".$this->idConsideracion."')";
	$con=new conexion();
	//$sql='INSERT INTO productoxsolucion (idProducto,idSolucion) VALUES ('.idProducto.','.idSolucion.')';
	$con->ejecutar_sentencia($sql);
}

function existe_consideracionxproducto($idProducto, $idConsideracion)
{
	$con=new conexion();
	$sql='SELECT idProducto, idConsideracion FROM consideracionxproducto WHERE idProducto='.$idProducto.' AND idConsideracion='.$idConsideracion;
	$datos = $con ->ejecutar_sentencia($sql);
	$resultados= array();
	while ($row = mysqli_fetch_array($datos)) {
		$registro = array();
		$registro['idProducto'] = $row['idProducto'];
		$registro['idConsideracion'] = $row['idConsideracion'];
		array_push($resultados, $registro);
	}
	mysqli_free_result($datos);
	return $resultados;
}

function obtener_productosxconsideracion()
{
	$con=new conexion();
	$sql='select idProducto from consideracionxproducto where idConsideracion='.$this->idConsideracion;
	$resultados=$con->ejecutar_sentencia($sql);
	while ($fila=mysqli_fetch_array($resultados))
	{
	array_push($this->productos,$fila['idProducto']);
	}
}
function obtener_ingredientesxproducto()
{
	$con=new conexion();
	$sql='select idConsideracion from consideracionxproducto where idProducto='.$this->idProducto;
	$resultados=$con->ejecutar_sentencia($sql);
	while ($fila=mysqli_fetch_array($resultados))
	{
	array_push($this->ingredientes,$fila['idConsideracion']);
	}
}



function desasignar_productoxconsideracion()
{
	$con=new conexion();
	$sql='DELETE FROM consideracionxproducto WHERE idProducto='.$this->idProducto;
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
		
}
*/
function getconsideracionxproducto($idProducto){
	$sql = "SELECT * FROM consideracionxproducto, consideracion WHERE consideracion.status=1 AND consideracion.idConsideracion=consideracionxproducto.idConsideracion AND consideracionxproducto.idProducto=".$idProducto." order by consideracion.orden DESC";
		$conexion = new conexion();
		$datos = $conexion ->ejecutar_sentencia($sql);
		$resultados= array();
		while ($row = mysqli_fetch_array($datos)) {
			$registro['idConsideracion'] = $row['idConsideracion'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['nombreEn'] = htmlspecialchars_decode($row['nombreEn']);

			array_push($resultados, $registro);
		}
		mysqli_free_result($datos);
		return $resultados;
		
}





}
?>