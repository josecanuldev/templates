<?php
require_once 'conexion.php';
require_once 'direccion.php';

class direccion{
	var $idDireccion;
	var $idCliente;
	var $nombreDireccion;
	var $nombre;
	var $apellido;
	var $email;
	var $direccion;
	var $telefono;
	var $estado;
	var $ciudad;
	var $cp;
	var $principal;

	function __construct($idDireccion = 0, $idCliente = 0, $nombreDireccion = '', $nombre = '', $apellido = '', $email = '', $direccion = '', $telefono = '', $estado = '', $ciudad = '', $cp = ''){
		$this -> idDireccion = $idDireccion;
		$this -> idCliente = $idCliente;
		$this -> nombreDireccion = $nombreDireccion;
		$this -> nombre = $nombre;
		$this -> apellido = $apellido;
		$this -> email = $email;
		$this -> direccion = $direccion;
		$this -> telefono = $telefono;
		$this -> estado = $estado;
		$this -> ciudad = $ciudad;
		$this -> cp = $cp;
	}

	function addDireccion(){
		$sql = "INSERT INTO direccion(idCliente, nombreDireccion, nombre, apellido, email, direccion, telefono, estado, ciudad, cp, principal) VALUES (".$this -> idCliente.", '".htmlspecialchars($this -> nombreDireccion, ENT_QUOTES)."', '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', '".htmlspecialchars($this -> apellido, ENT_QUOTES)."', '".htmlspecialchars($this -> email, ENT_QUOTES)."', '".htmlspecialchars($this -> direccion, ENT_QUOTES)."', '".htmlspecialchars($this -> telefono, ENT_QUOTES)."', '".htmlspecialchars($this -> estado, ENT_QUOTES)."', '".htmlspecialchars($this -> ciudad, ENT_QUOTES)."', '".$this -> cp."', 1)";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateDireccion(){
		$sql = "UPDATE direccion SET nombreDireccion = '".htmlspecialchars($this -> nombreDireccion, ENT_QUOTES)."', nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', apellido = '".htmlspecialchars($this -> apellido, ENT_QUOTES)."', email = '".htmlspecialchars($this -> email, ENT_QUOTES)."', direccion = '".htmlspecialchars($this -> direccion, ENT_QUOTES)."', telefono = '".htmlspecialchars($this -> telefono, ENT_QUOTES)."', estado = '".htmlspecialchars($this -> estado, ENT_QUOTES)."', ciudad = '".htmlspecialchars($this -> ciudad, ENT_QUOTES)."', cp = '".$this -> cp."' WHERE idDireccion = ".$this -> idDireccion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updatePrincipal(){
		$sql = "UPDATE direccion SET principal = 0 WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
		$sql2 = "UPDATE direccion SET principal = 1 WHERE idDireccion = ".$this -> idDireccion;
		$conexion -> ejecutar_sentencia($sql2);
	}

	function deleteDireccion(){
		$sql = "DELETE FROM direccion WHERE idDireccion = ".$this -> idDireccion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getDireccion(){
		$sql = "SELECT * FROM direccion WHERE idDireccion = ".$this -> idDireccion;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		return $obj;
	}

	function listDireccion(){
		$sql = "SELECT * FROM direccion WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$resultado = array();
		while($row = mysqli_fetch_array($temporal)){
			$registro['idDireccion'] = $row['idDireccion'];
			$registro['idCliente'] = $row['idCliente'];
			$registro['nombreDireccion'] = $row['nombreDireccion'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['apellido'] = htmlspecialchars_decode($row['apellido']);
			$registro['email'] = htmlspecialchars_decode($row['email']);
			$registro['direccion'] = htmlspecialchars_decode($row['direccion']);
			$registro['telefono'] = $row['telefono'];
			$registro['estado'] = $row['estado'];
			$registro['ciudad'] = $row['ciudad'];
			$registro['cp'] = $row['cp'];
			array_push($resultado, $registro);
		}
		return $resultado;
	}
}
?>
