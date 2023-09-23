<?php
require_once 'conexion.php';
require_once 'datosCliente.php';

class datosCliente{
	var $idCliente;
	var $nombre;
	var $apellido;
	var $direccion;
	var $telefono;
	var $estado;
	var $ciudad;
	var $cp;

	function __construct($idCliente = 0,  $nombre = '', $apellido = '', $direccion = '', $telefono = '', $estado = '', $ciudad = '', $cp = ''){
		$this -> idCliente = $idCliente;
		$this -> nombre = $nombre;
		$this -> apellido = $apellido;
		$this -> direccion = $direccion;
		$this -> telefono = $telefono;
		$this -> estado = $estado;
		$this -> ciudad = $ciudad;
		$this -> cp = $cp;
	}

	function addDatosCliente(){
		$sql = "INSERT INTO datosCliente(idCliente, nombre, apellido, direccion, telefono, estado, ciudad, cp) VALUES (".$this -> idCliente.", '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', '".htmlspecialchars($this -> apellido, ENT_QUOTES)."', '".htmlspecialchars($this -> direccion, ENT_QUOTES)."', '".htmlspecialchars($this -> telefono, ENT_QUOTES)."', '".htmlspecialchars($this -> estado, ENT_QUOTES)."', '".htmlspecialchars($this -> ciudad, ENT_QUOTES)."', '".$this -> cp."')";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateDatosCliente(){
		$sql = "UPDATE datosCliente SET nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', apellido = '".htmlspecialchars($this -> apellido, ENT_QUOTES)."', direccion = '".htmlspecialchars($this -> direccion, ENT_QUOTES)."', telefono = '".htmlspecialchars($this -> telefono, ENT_QUOTES)."', estado = '".htmlspecialchars($this -> estado, ENT_QUOTES)."', ciudad = '".htmlspecialchars($this -> ciudad, ENT_QUOTES)."', cp = '".$this -> cp."' WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteDatosCliente(){
		$sql = "DELETE FROM datosCliente WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}


	function getDatosCliente(){
		$sql = "SELECT * FROM datosCliente WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		return $obj;
	}
}
?>
