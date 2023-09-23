<?php
require_once 'MYSQL.php';
require_once 'herramientas.php';

class subcategoria{
	var $idSubcategoria;
	var $idCategoria;
	var $nombre;
	var $urlAmigable;

	var $orden;
	var $status;

	var $herramientas;

	function __construct($idSubcategoria = 0, $idCategoria = 0, $nombre = ''){
		$this -> idSubcategoria = $idSubcategoria;
		$this -> idCategoria = $idCategoria;
		$this -> nombre = $nombre;
		$this -> herramientas = new herramientas();
	}

	function addSubcategoria(){
		$urlAmigable = $this -> herramientas -> getUrlAmigable($this -> nombre);
		$_MYSQL = new MYSQL();
		$_SQL = "INSERT INTO subcategoria(idCategoria, nombre, urlAmigable, status) VALUES (?,?,?,?)";
		$_VALUES = array($this -> idCategoria, $this -> nombre, $urlAmigable, 1);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
		$this -> idSubcategoria = $_MYSQL -> conexion -> lastInsertId();
		$_O = "UPDATE subcategoria SET orden = ? WHERE idSubcategoria = ?";
		$_MYSQL -> Execute($_O, array($this -> idSubcategoria, $this -> idSubcategoria));
	}

	function updateSubcategoria(){
		$urlAmigable = $this -> herramientas -> getUrlAmigable($this -> nombre);
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE subcategoria SET nombre = ?, urlAmigable = ? WHERE idSubcategoria = ?";
		$_VALUES = array($this -> nombre, $urlAmigable, $this -> idSubcategoria);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
	}

	function deleteSubcategoria($_ALL = false){
		$_MYSQL = new MYSQL();
		if($_ALL){
			$_SQL = "DELETE FROM subcategoria WHERE idCategoria = ?";
			$_VALUES = array($this -> idCategoria);
		}else{
			$_SQL = "DELETE FROM subcategoria WHERE idSubcategoria = ?";
			$_VALUES = array($this -> idSubcategoria);
		}
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
	}

	function updateOrdenSubcategoria($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE subcategoria SET orden = ? WHERE idSubcategoria = ?";
		$_VALUES = array($_orden, $this -> idSubcategoria);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);

	}

	function updateStatusSubcategoria($_status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE subcategoria SET status = ? WHERE idSubcategoria = ?";
		$_VALUES = array($_status, $this -> idSubcategoria);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
	}

	function getSubcategoria(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM subcategoria WHERE idSubcategoria = ?";
		$_VALUES = array($this -> idSubcategoria);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
		$_OBJ = $_MYSQL -> fetchobject();
		$this -> idSubcategoria = $_OBJ -> idSubcategoria;
		$this -> idCategoria = $_OBJ -> idCategoria;
		$this -> nombre = $_OBJ -> nombre;
		$this -> urlAmigable = $_OBJ -> urlAmigable;
	}

	function listSubcategoria($_status = 0){
		$_MYSQL = new MYSQL();
		if($_status == 0){
			$_SQL = "SELECT * FROM subcategoria WHERE idCategoria = ? ORDER BY orden DESC";
			$_VALUES = array($this -> idCategoria);
		}else{
			$_SQL = "SELECT * FROM subcategoria WHERE idCategoria = ? AND status = ? ORDER BY orden DESC";
			$_VALUES = array($this -> idCategoria, $_status);
		}
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
		$_RESPONSE = array();
		while($_row = $_MYSQL -> fetchrow()){
			$registro['idSubcategoria'] = $_row['idSubcategoria'];
			$registro['idCategoria'] = $_row['idCategoria'];
			$registro['nombre'] = $_row['nombre'];
			$registro['urlAmigable'] = $_row['urlAmigable'];
			$registro['status'] = $_row['status'];
			$registro['orden'] = $_row['orden'];
			array_push($_RESPONSE, $registro);
		}
		return $_RESPONSE;
	}
}
?>
