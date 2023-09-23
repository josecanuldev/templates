<?php
require_once 'conexion.php';
require_once 'herramientas.php';

class productoxatributo{
	var $idProducto;
	var $idAtributo;
	var $productos;
	var $atributos;
	var $orden;

	function __construct($idProducto = 0, $idAtributo = 0 , $orden = 0){
		$this -> idProducto = $idProducto;
		$this -> idAtributo = $idAtributo;
		$this -> orden = $orden;
		$this -> productos = array();
		$this -> atributos = array();
	}

	function addProductoxAtributo(){
		$sql = "INSERT INTO productoxatributo (idProducto, idAtributo, orden) VALUES(".$this -> idProducto.", ".$this -> idAtributo.", ".$this -> orden.")";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenProductoxAtributo($orden){
		$sql = "UPDATE productoxatributo SET orden = ".$orden." WHERE idProducto = ".$this -> idProducto." AND idAtributo = ".$this -> idAtributo;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function existProductoxAtributo(){
		$sql = "SELECT idProducto FROM productoxatributo WHERE idAtributo = ".$this -> idAtributo." AND idProducto = ".$this -> idProducto."";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}

	function existAtributoxProducto(){
		$sql = "SELECT idAtributo FROM productoxatributo WHERE idProducto = ".$this -> idProducto." AND idAtributo = ".$this -> idAtributo."";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}

	function removeProductoxAtributo(){
		$sql = "DELETE FROM productoxatributo WHERE idAtributo = ".$this -> idAtributo;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function removeAtributoxProducto(){
		$sql = "DELETE FROM productoxatributo WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function listProductoxAtributo(){
		$sql = "SELECT idProducto FROM productoxatributo WHERE idAtributo = ".$this -> idAtributo;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idProducto'] = $row['idProducto'];
			array_push($this -> productos, $registro);
		}
	}

	function listAtributoxProducto(){
		$sql = "SELECT idAtributo FROM productoxatributo WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idAtributo'] = $row['idAtributo'];
			array_push($this -> atributos, $registro);
		}
	}

	function listNombreAtributoxProducto(){
		$sql = "SELECT atributo.idAtributo, atributo.nombre FROM productoxatributo, atributo WHERE productoxatributo.idAtributo = atributo.idAtributo AND atributo.status = 1 AND idProducto = ".$this -> idProducto." ORDER BY productoxatributo.orden ASC";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$herramientas = new herramientas();
		while($row = mysqli_fetch_array($temporal)){
			$registro['idAtributo'] = $row['idAtributo'];
			$registro['nombre'] = $row['nombre'];
			$registro['name_input'] = $herramientas -> getUrlAmigable($row['nombre']);
			array_push($this -> atributos, $registro);
		}
	}

}
?>
