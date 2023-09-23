<?php
require_once 'conexion.php';
require_once 'transporte.php';

class clientexcodigo{
	var $idCliente;
	var $idCodigo;
	var $clientes;
	var $codigos;

	function __construct($idCliente = 0, $idCodigo = 0){
		$this -> idCliente = $idCliente;
		$this -> idCodigo = $idCodigo;
		$this -> clientes = array();
		$this -> codigos = array();
	}

	function addClientexCodigo(){
		$sql = "INSERT INTO clientexcodigo (idCliente, idCodigo) VALUES(".$this -> idCliente.", ".$this -> idCodigo.")";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function existClientexCodigo(){
		$sql = "SELECT idCliente FROM clientexcodigo WHERE idCodigo = ".$this -> idCodigo." AND idCliente = ".$this -> idCliente."";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}

	function removeClientexCodigo(){
		$sql = "DELETE FROM clientexcodigo WHERE idCodigo = ".$this -> idCodigo;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function removeCodigoxCliente(){
		$sql = "DELETE FROM clientexcodigo WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function listClientexCodigo(){
		$sql = "SELECT idCliente FROM clientexcodigo WHERE idCodigo = ".$this -> idCodigo;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCliente'] = $row['idCliente'];
			array_push($this -> clientes, $registro);
		}
	}

	function listCodigoxCliente(){
		$sql = "SELECT idCodigo FROM clientexcodigo WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCodigo'] = $row['idCodigo'];
			array_push($this -> codigos, $registro);
		}
	}

	function listNombreCodigoxCliente(){
		$sql = "SELECT transporte.idCodigo, transporte.nombre, transporte.tiempoTransito, transporte.gratis, transporte.cantidadGratis FROM clientexcodigo, transporte WHERE clientexcodigo.idCodigo = transporte.idCodigo AND transporte.status = 1 AND idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCodigo'] = $row['idCodigo'];
			$registro['nombre'] = $row['nombre'];
			$registro['tiempoTransito'] = $row['tiempoTransito'];
			$registro['gratis'] = $row['gratis'];
			$registro['cantidadGratis'] = $row['cantidadGratis'];
			$transporte = new transporte($row['idCodigo']);
			$transporte -> listarRango();
			$registro['rangos'] = $transporte -> rangos;

			array_push($this -> codigos, $registro);
		}
	}
}
