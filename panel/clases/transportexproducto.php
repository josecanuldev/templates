<?php
require_once 'conexion.php';
require_once 'transporte.php';

class transportexproducto{
	var $idProducto;
	var $idTransporte;
	var $productos;
	var $transportes;

	function __construct($idProducto = 0, $idTransporte = 0){
		$this -> idProducto = $idProducto;
		$this -> idTransporte = $idTransporte;
		$this -> productos = array();
		$this -> transportes = array();
	}

	function addProductoxTransporte(){
		$sql = "INSERT INTO transportexproducto (idProducto, idTransporte) VALUES(".$this -> idProducto.", ".$this -> idTransporte.")";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function existProductoxTransporte(){
		$sql = "SELECT idProducto FROM transportexproducto WHERE idTransporte = ".$this -> idTransporte." AND idProducto = ".$this -> idProducto."";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}

	function removeProductoxTransporte(){
		$sql = "DELETE FROM transportexproducto WHERE idTransporte = ".$this -> idTransporte;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function removeTransportexProducto(){
		$sql = "DELETE FROM transportexproducto WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function listProductoxTransporte(){
		$sql = "SELECT idProducto FROM transportexproducto WHERE idTransporte = ".$this -> idTransporte;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idProducto'] = $row['idProducto'];
			array_push($this -> productos, $registro);
		}
	}

	function listTransportexProducto(){
		$sql = "SELECT idTransporte FROM transportexproducto WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idTransporte'] = $row['idTransporte'];
			array_push($this -> transportes, $registro);
		}
	}

	function listNombreTransportexProducto(){
		$sql = "SELECT transporte.idTransporte, transporte.nombre, transporte.tiempoTransito, transporte.gratis, transporte.cantidadGratis FROM transportexproducto, transporte WHERE transportexproducto.idTransporte = transporte.idTransporte AND transporte.status = 1 AND idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idTransporte'] = $row['idTransporte'];
			$registro['nombre'] = $row['nombre'];
			$registro['tiempoTransito'] = $row['tiempoTransito'];
			$registro['gratis'] = $row['gratis'];
			$registro['cantidadGratis'] = $row['cantidadGratis'];
			$transporte = new transporte($row['idTransporte']);
			$transporte -> listarRango();
			$registro['rangos'] = $transporte -> rangos;

			array_push($this -> transportes, $registro);
		}
	}
}
