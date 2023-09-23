<?php
require_once('MYSQL.php');
include_once 'contenido.php';

class seccion{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_idSeccion;
	var $_idLookbook;
	/**
	 * 1 = Una imagen
	 * 2 = Muchas imagenes
	 * @var [int]
	 */
	var $_tipo;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_contenido;

	function __construct($_idSeccion = 0, $_idLookbook = '', $_tipo = ''){
		$this -> _idSeccion = $_idSeccion;
		$this -> _idLookbook = $_idLookbook;
		$this -> _tipo = $_tipo;
		$this -> _contenido = array();
	}

	function addSeccion(){
		$_MYSQL = new MYSQL();
		$_SQL = "INSERT INTO seccion(idLookbook, tipo, status)VALUES(?,?,?)";
		//echo "INSERT INTO seccion(idLookbook, tipo, status)VALUES(".$this -> _idLookbook.",".$this -> _tipo.",1)";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idLookbook, $this -> _tipo, 1))){
			$this -> _idSeccion = $_MYSQL -> conexion -> lastInsertId();
			$_O = "UPDATE seccion SET orden = ? WHERE idSeccion = ?";
			$_MYSQL -> Execute($_O, array($this -> _idSeccion, $this -> _idSeccion));
			$_success = 2;
		}else{
			$this -> _idSeccion = 0;
			$_success = 1;
		}
		return $_success;
	}

	function updateSeccion(){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE seccion SET idLookbook = ?, tipo = ? WHERE idSeccion = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idLookbook, $this -> _tipo, $this -> _idSeccion))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function deleteSeccion(){
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM seccion WHERE idSeccion = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idSeccion))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateStatusSeccion($_status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE seccion SET status = ? WHERE idSeccion = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_status, $this -> _idSeccion));
	}

	function updateOrdenSeccion($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE seccion SET orden = ? WHERE idSeccion = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idSeccion));
	}

	function getSeccion(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM seccion WHERE idSeccion = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idSeccion));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idSeccion = $obj -> idSeccion;
		$this -> _idLookbook = $obj -> idLookbook;
		$this -> _tipo = $obj -> tipo;
	}

	function listSeccionOld($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_frontEnd = false, $_lang = 'ES'){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (idLookbook LIKE '%".$_busqueda."%')" : $_bus = '';

		$_MYSQL = new MYSQL();

		if($_paginador){
			$_TOTAL = "SELECT idSeccion, count(idSeccion) as totalRegistros FROM seccion WHERE 1 = 1 ".$_stat." ".$_bus." ORDER BY orden DESC";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			$_MYSQL -> Execute($_TOTAL, array());
			$obj = $_MYSQL -> fetchobject();
			$this -> _totalRegistros = $obj -> totalRegistros;
			$this -> _registrosPorPagina = $_registrosPorPagina;
			$_ultimaPagina = ceil($this -> _totalRegistros / $this -> _registrosPorPagina);
			$_paginaActual = $_pagina;
			$_paginacion = ' LIMIT '.($_pagina - 1) * $this -> _registrosPorPagina.','.$this -> _registrosPorPagina;
		}else{
			$_paginacion = '';
		}

		$_SQL = "SELECT * FROM seccion WHERE 1 = 1 ".$_stat.$_bus." ORDER BY orden DESC ".$_paginacion;


		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idSeccion'] = $_row['idSeccion'];
			if($_lang=='EN')
			{
				$_registro['titulo'] = $_row['tipo'];
			}
			elseif($_lang=='ES')
			{
				$_registro['titulo'] = $_row['idLookbook'];
			}
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			$_registro['status'] = $_row['status'];
			$_registro['orden'] = $_row['orden'];
			if($_paginador){
				$_registro['ultimapagina'] = $_ultimaPagina;
				$_registro['paginaanterior'] = $_pagina - 1;
				$_registro['paginasiguiente'] = $_pagina + 1;
				$_registro['pagina'] = $_pagina;
			}
			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listSeccion($_status = ''){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM seccion WHERE idLookbook = ? ".$_stat." ORDER BY orden ASC ";
		//echo "SELECT * FROM seccion WHERE idLookbook = ".$this -> _idLookbook." ".$_stat." ORDER BY orden ASC ";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idLookbook));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idSeccion'] = $_row['idSeccion'];
			$_registro['idLookbook'] = $_row['idLookbook'];
			$_registro['tipo'] = $_row['tipo'];
			$_registro['status'] = $_row['status'];
			$_registro['orden'] = $_row['orden'];
			$this -> _idSeccion = $_row['idSeccion'];
			$this -> listarContenido();
			$_registro['contenido'] = $this -> _contenido;
			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	/* ==================================================================
	 * MAESTRO DETALLE CONTENIDO PAGINA
	 * ================================================================== */

	function agregarContenido($_ruta = '', $_tmp = ''){
		$contenido = new contenido(0, $this -> _idSeccion, $_ruta, $_tmp);
		$contenido -> addContenido();
	}

	function modificarContenido($_idContenido = 0, $_ruta = '', $_tmp = ''){
		$contenido = new contenido($_idContenido, 0, $_ruta, $_tmp);
		$contenido -> updateContenido();
	}

	function eliminarContenido($_idContenido = 0){
		$contenido = new contenido($_idContenido);
		$contenido -> deleteContenido();
	}

	function listarContenido(){
		$this -> _contenido = array();
		$contenido = new contenido(0, $this -> _idSeccion);
		$this -> _contenido = $contenido -> listContenido();
	}
}
?>
