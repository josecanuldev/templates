<?php
require_once('MYSQL.php');
include_once('herramientas.php');

class datosProducto {
	var $_idProducto;
	
	var $_titulo;
	var $_descripcion;
	var $_tags;
	var $_tagsAmigables;
	var $_tagsMostrar;
	var $_urlAmigable;
	var $_lang;

	var $_herramientas;
	
	function __construct($_idProducto = 0, $_titulo = '', $_descripcion = '', $_tags = '', $_lang = '') {
		$this -> _idProducto = $_idProducto;
		
		$this -> _titulo = $_titulo;
		$this -> _descripcion = $_descripcion;
		$this -> _tags = $_tags;
		$this -> _lang = $_lang;

		$this -> _herramientas = new herramientas();
		
	}		

	function addDatosProducto(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _titulo);
		$this -> _tagsAmigables = $this -> _herramientas -> getUrlAmigable($this -> _tags);
		$_MYSQL = new MYSQL();
		$_SQL = "INSERT INTO datosProducto(idProducto, titulo, descripcion, urlAmigable, lang)VALUES(?,?,?,?,?)";
		//var_dump(array($this -> _idProducto, $this -> _titulo, $this -> _descripcion, $this -> _tags, $this -> _tagsAmigables, $this -> _urlAmigable, $this -> _lang));
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idProducto, $this -> _titulo, $this -> _descripcion, $this -> _urlAmigable, $this -> _lang))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateDatosProducto(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _titulo);
		$this -> _tagsAmigables = $this -> _herramientas -> getUrlAmigable($this -> _tags);
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE datosProducto SET titulo = ?, descripcion = ?, urlAmigable = ? WHERE idProducto = ? AND lang = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _titulo, $this -> _descripcion, $this -> _urlAmigable, $this -> _idProducto, $this -> _lang))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function deleteDatosProducto(){
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM datosProducto WHERE idProducto = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idProducto))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}
		
	function getDatosProducto(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM datosProducto WHERE idProducto = ? AND lang = ?";
		//var_dump(array($this -> _idProducto, $this -> _lang));
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idProducto, $this -> _lang));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idProducto = $obj -> idProducto;
		$this -> _titulo = $obj -> titulo;
		$this -> _descripcion = $obj -> descripcion;
		$this -> _urlAmigable = $obj -> urlAmigable;
		$this -> _tagsMostrar = $this -> _herramientas -> formatedTags($obj -> tagsAmigables, true);
	}	

	function listDatosProducto($_frontEnd = false){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM datosProducto WHERE 1 = 1 AND lang = ? AND idProducto = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idProducto'] = $_row['idProducto'];
			$_registro['titulo'] = $_row['titulo'];
			$_registro['descripcion'] = $this -> herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['shortDesc'] = $_row['tags'];
			$_registro['tags'] = $this -> herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables'] = $this -> herramientas -> formatedTags($_row['tagsAmigables'], $_frontEnd);
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			$_registro['lang'] = $_row['lang'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}
}
?>