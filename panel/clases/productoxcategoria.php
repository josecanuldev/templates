<?php
require_once 'MYSQL.php';

class productoxcategoria{
	var $_idProducto;
	var $_idCategoria;
	var $_productos;
	var $_categorias;

	function __construct($_idProducto = 0, $_idCategoria = 0){
		$this -> _idProducto = $_idProducto;
		$this -> _idCategoria = $_idCategoria;
		$this -> _productos = array();
		$this -> _categorias = array();
	}

	function addProductoxCategoria(){
		$_SQL = "INSERT INTO productoxcategoria (idProducto, idCategoria) VALUES(?,?)";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idProducto, $this -> _idCategoria));
	}

	function existProductoxCategoria(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT idCategoria FROM productoxcategoria WHERE idProducto = ? AND idCategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idProducto, $this -> _idCategoria));
		if($_MYSQL -> numrows() > 0) return true; else return false;
	}

	function removeCategoriaxProducto(){
		$_SQL = "DELETE FROM productoxcategoria WHERE idCategoria = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idCategoria));
	}

	function removeProductoxCategoria(){
		$_SQL = "DELETE FROM productoxcategoria WHERE idProducto = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idProducto));
	}

	function listProductoxCategoria(){
		$_SQL = "SELECT idProducto FROM productoxcategoria WHERE idCategoria = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idCategoria));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idProducto'] = $_row['idProducto'];
			array_push($this -> _productos, $_registro);
		}
	}

	function listCategoriaxProducto(){
		$_SQL = "SELECT idCategoria FROM productoxcategoria WHERE idProducto = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idProducto));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idCategoria'] = $_row['idCategoria'];
			array_push($this -> _categorias, $_registro);
		}
	}

	function listNombreCategoriaxProducto($_lang = 'ES'){
		$_SQL = "SELECT categoria.idCategoria, categoria.tituloEs, categoria.tituloEn, categoria.urlAmigable FROM productoxcategoria, categoria WHERE productoxcategoria.idCategoria = categoria.idCategoria AND categoria.status = ? AND idProducto = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array(1, $this -> _idProducto));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idCategoria'] = $_row['idCategoria'];
			($_lang == 'ES') ? $_registro['titulo'] = $_row['tituloEs'] : $_registro['titulo'] = $_row['tituloEn'];
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			array_push($this -> _categorias, $_registro);
		}
	}

	function listNombreProductoxCategoria(){
		$_SQL = "SELECT datosProducto.idProducto, datosProducto.titulo FROM productoxcategoria, datosProducto, producto WHERE productoxcategoria.idProducto = datosProducto.idProducto AND productoxcategoria.idProducto = producto.idProducto AND producto.status = ? AND idCategoria = ? AND datosProducto.lang = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array(1, $this -> _idCategoria, 'ES'));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idProducto'] = $_row['idProducto'];
			$_registro['titulo'] = $_row['titulo'];
			array_push($this -> _productos, $_registro);
		}
	}

	function countParticipantesxImagen($idProducto){
		$sql = "SELECT count(idCategoria) AS total FROM productoxcategoria WHERE idProducto = ".$idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		return $obj -> total;
	}

}
?>
