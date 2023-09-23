<?php
require_once('MYSQL.php');
include_once('herramientas.php');

class datosBlog {
	var $_idBlog;

	var $_titulo;
	var $_subtitulo;
	var $_descripcion;
	var $_tags;
	var $_tagsAmigables;
	var $_tagsMostrar;
	var $_urlAmigable;
	var $_lang;

	var $_herramientas;

	function __construct($_idBlog = 0, $_titulo = '', $_subtitulo = '', $_descripcion = '', $_tags = '', $_lang = '') {
		$this -> _idBlog = $_idBlog;

		$this -> _titulo = $_titulo;
		$this -> _subtitulo = $_subtitulo;
		$this -> _descripcion = $_descripcion;
		$this -> _tags = $_tags;
		$this -> _lang = $_lang;

		$this -> _herramientas = new herramientas();

	}

	function addDatosBlog(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _titulo);
		$this -> _tagsAmigables = $this -> _herramientas -> getUrlAmigable($this -> _tags);
		$_MYSQL = new MYSQL();
		$_SQL = "INSERT INTO datosBlog(idBlog, titulo, subtitulo, descripcion, tags, tagsAmigables, urlAmigable, lang)VALUES(?,?,?,?,?,?,?,?)";
		//var_dump(array($this -> _idBlog, $this -> _titulo, $this -> _subtitulo, $this -> _descripcion, $this -> _tags, $this -> _tagsAmigables, $this -> _urlAmigable, $this -> lang));
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idBlog, $this -> _titulo, $this -> _subtitulo, $this -> _descripcion, $this -> _tags, $this -> _tagsAmigables, $this -> _urlAmigable, $this -> _lang))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateDatosBlog(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _titulo);
		$this -> _tagsAmigables = $this -> _herramientas -> getUrlAmigable($this -> _tags);
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE datosBlog SET titulo = ?, subtitulo = ?, descripcion = ?, tags = ?, tagsAmigables = ?, urlAmigable = ? WHERE idBlog = ? AND lang = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _titulo, $this -> _subtitulo, $this -> _descripcion, $this -> _tags, $this -> _tagsAmigables, $this -> _urlAmigable, $this -> _idBlog, $this -> _lang))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function deleteDatosBlog(){
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM datosBlog WHERE idBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idBlog))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function getDatosBlog(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM datosBlog WHERE idBlog = ? AND lang = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idBlog, $this -> _lang));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idBlog = $obj -> idBlog;
		$this -> _titulo = $obj -> titulo;
		$this -> _subtitulo = $obj -> subtitulo;
		$this -> _descripcion = $obj -> descripcion;
		$this -> _tags = $obj -> tags;
		$this -> _urlAmigable = $obj -> urlAmigable;
		$this -> _tagsMostrar = $this -> _herramientas -> formatedTags($obj -> tagsAmigables, true);
	}

	function listDatosBlog($_frontEnd = false){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM datosBlog WHERE 1 = 1 AND lang = ? AND idBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog'] = $_row['idBlog'];
			$_registro['titulo'] = $_row['titulo'];
			$_registro['subtitulo'] = $_row['subtitulo'];
			$_registro['descripcion'] = $this -> herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
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
