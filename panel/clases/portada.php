<?php
require_once('MYSQL.php');
require_once('archivo.php');
require_once('herramientas.php');

class portada extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_id;
	var $_imgPortada;
	var $_imgPortadaMobile;
	var $_titulo;
	var $_tituloEn;
	var $_subtitulo;
	var $_subtituloEn;
	var $_estatus;
	var $_tmp;
	var $_tmp_movil;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_directorio = "../img/imgPortada/";
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;

	function __construct($_id = 0, $_titulo = '', $_tituloEn = '', $_subtitulo = '', $_subtituloEn = '', $_estatus = 1, $_imgPortada = '', $_imgPortadaMobile = '', $_tmp = '', $_tmp_movil = '') {
		$this -> _id = $_id;
		$this -> _titulo = $_titulo;
		$this -> _tituloEn = $_tituloEn;
		$this -> _subtitulo = $_subtitulo;
		$this -> _subtituloEn = $_subtituloEn;
		$this -> _estatus 		 = $_estatus;

		$this-> _tmp = $_tmp;
		$this-> _tmp_movil = $_tmp_movil;

		$this -> _imgPortada = $_imgPortada;
		$this -> _imgPortadaMobile = $_imgPortadaMobile;

		$this -> ruta_final = $this -> _directorio;
		$this -> _herramientas = new herramientas();
	}

	function updatePortada() {
		$_MYSQL = new MYSQL();
		$this->updateImg();
		$this->updateImgMovil();

		$_SQL = "UPDATE portada SET titulo = ?, tituloEn = ?,  subtitulo = ?,  subtituloEn = ?,  estatus = ? WHERE id = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _titulo, $this -> _tituloEn, $this -> _subtitulo, $this -> _subtituloEn, $this -> _estatus, $this -> _id))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateImg(){
		if($this-> _imgPortada != ''){
			$this -> getImgPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $this-> _tmp;
			$this-> _imgPortada = $this -> obtenerExtensionArchivo($this-> _imgPortada);
			$this -> subir_archivo_imagen($this-> _imgPortada);
			$_MYSQL = new MYSQL();
			$_SQL = "UPDATE portada SET imgPortada = ? WHERE id = ?";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			$_MYSQL -> Execute($_SQL, array($this-> _imgPortada, $this -> _id));
		}
	}

	function updateImgMovil(){
		if($this-> _imgPortadaMobile != ''){
			$this -> getImgMovil();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $this-> _tmp_movil;
			$this-> _imgPortadaMobile = $this -> obtenerExtensionArchivo($this-> _imgPortadaMobile);
			$this -> subir_archivo_imagen($this-> _imgPortadaMobile);
			$_MYSQL = new MYSQL();
			$_SQL = "UPDATE portada SET imgPortadaMobile = ? WHERE id = ?";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			$_MYSQL -> Execute($_SQL, array($this-> _imgPortadaMobile, $this -> _id));
		}
	}

	function getImgPortada() {
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT imgPortada FROM portada WHERE id = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _id));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio. $obj -> imgPortada;
	}

	function getImgMovil(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT imgPortadaMobile FROM portada WHERE id = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _id));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio. $obj -> imgPortadaMobile;
	}

	function getPortada(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM portada LIMIT 1";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['id'] = $_row['id'];
			$_registro['titulo'] = htmlentities($_row['titulo'], ENT_QUOTES);
			$_registro['tituloEn'] = $_row['tituloEn'];
			$_registro['subtitulo'] = htmlentities($_row['subtitulo'], ENT_QUOTES);
			$_registro['subtituloEn'] = $_row['subtituloEn'];
			$_registro['imgPortada'] = $_row['imgPortada'];
			$_registro['imgPortadaMobile'] = $_row['imgPortadaMobile'];
			$_registro['estatus'] = $_row['estatus'];
			array_push($_resultados, $_registro);
		}
		return count($_resultados) > 0 ? $_resultados[0] : $this;
	}
}
?>
