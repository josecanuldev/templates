<?php
require_once('MYSQL.php');
require_once('herramientas.php');

class etiqueta{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_idEtiqueta;
	var $_tituloEs;
	var $_tituloEn;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;

	function __construct($_idEtiqueta = 0, $_tituloEs = '', $_tituloEn = ''){
		$this -> _idEtiqueta = $_idEtiqueta;
		$this -> _tituloEs = $_tituloEs;
		$this -> _tituloEn = $_tituloEn;
		$this -> _herramientas = new herramientas();
	}

	function addEtiqueta(){
		$_MYSQL = new MYSQL();
		$_SQL = "INSERT INTO etiqueta(tituloEs, tituloEn, status)VALUES(?,?,?)";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _tituloEs, $this -> _tituloEn, 1))){
			$this -> _idEtiqueta = $_MYSQL -> conexion -> lastInsertId();
			$_O = "UPDATE etiqueta SET orden = ? WHERE idEtiqueta = ?";
			$_MYSQL -> Execute($_O, array($this -> _idEtiqueta, $this -> _idEtiqueta));
			$_success = 2;
		}else{
			$this -> _idEtiqueta = 0;
			$_success = 1;
		}
		return $_success;
	}

	function updateEtiqueta(){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE etiqueta SET tituloEs = ?, tituloEn = ? WHERE idEtiqueta = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _tituloEs, $this -> _tituloEn, $this -> _idEtiqueta))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function deleteEtiqueta(){
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM etiqueta WHERE idEtiqueta = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idEtiqueta))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateStatusEtiqueta($_status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE etiqueta SET status = ? WHERE idEtiqueta = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_status, $this -> _idEtiqueta));
	}

	function updateOrdenEtiqueta($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE etiqueta SET orden = ? WHERE idEtiqueta = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idEtiqueta));
	}

	function getEtiqueta(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM etiqueta WHERE idEtiqueta = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idEtiqueta));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idEtiqueta = $obj -> idEtiqueta;
		$this -> _tituloEs = $obj -> tituloEs;
		$this -> _tituloEn = $obj -> tituloEn;
	}

	function listEtiqueta($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lastID = '', $_frontEnd = false){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (tituloEs LIKE '%".$_busqueda."%')" : $_bus = '';

		$_MYSQL = new MYSQL();

		if($_paginador){
			$_TOTAL = "SELECT idEtiqueta, count(idEtiqueta) as totalRegistros FROM etiqueta WHERE 1 = 1 ".$_stat." ".$_bus." ORDER BY orden DESC";
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

		$_SQL = "SELECT * FROM etiqueta WHERE 1 = 1 ".$_stat.$_bus." ORDER BY orden DESC ".$_paginacion;

		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idEtiqueta'] = $_row['idEtiqueta'];
			$_registro['tituloEs'] = $_row['tituloEs'];
			$_registro['tituloEn'] = $_row['tituloEn'];
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
}
?>
