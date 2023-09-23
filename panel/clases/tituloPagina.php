<?php
require_once('MYSQL.php');
require_once('herramientas.php');

class tituloPagina{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_idTituloPagina;
	var $_titulo;
	var $_tituloEs;
	var $_tituloEn;
	/**
	 * 1 = productos
	 * 2 = blog
	 * @var [int]
	 */
	var $_tipo;
	var $_urlAmigable;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;

	function __construct($_idTituloPagina = 0, $_tituloEs = '', $_tituloEn = ''){
		$this -> _idTituloPagina = $_idTituloPagina;
		$this -> _tituloEs = $_tituloEs;
		$this -> _tituloEn = $_tituloEn;
		$this -> _herramientas = new herramientas();
	}

	function addTituloPagina(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _tituloEs);
		$_MYSQL = new MYSQL();
		$_SQL = "INSERT INTO tituloPagina(tituloEs, tituloEn, urlAmigable, status)VALUES(?,?,?,?)";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _tituloEs, $this -> _tituloEn, $this -> _urlAmigable, 1))){
			$this -> _idTituloPagina = $_MYSQL -> conexion -> lastInsertId();
			$_O = "UPDATE tituloPagina SET orden = ? WHERE idTituloPagina = ?";
			$_MYSQL -> Execute($_O, array($this -> _idTituloPagina, $this -> _idTituloPagina));
			$_success = 2;
		}else{
			$this -> _idTituloPagina = 0;
			$_success = 1;
		}
		return $_success;
	}

	function updateTituloPagina(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _tituloEs);
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE tituloPagina SET tituloEs = ?, tituloEn = ?, urlAmigable = ? WHERE idTituloPagina = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _tituloEs, $this -> _tituloEn, $this -> _urlAmigable, $this -> _idTituloPagina))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function deleteTituloPagina(){
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM tituloPagina WHERE idTituloPagina = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idTituloPagina))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateStatusTituloPagina($_status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE tituloPagina SET status = ? WHERE idTituloPagina = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_status, $this -> _idTituloPagina));
	}

	function updateOrdenTituloPagina($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE tituloPagina SET orden = ? WHERE idTituloPagina = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idTituloPagina));
	}

	function getTituloPagina($_lang = 'ES'){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM tituloPagina WHERE idTituloPagina = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idTituloPagina));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idTituloPagina = $obj -> idTituloPagina;
		$this -> _tituloEs = $obj -> tituloEs;
		$this -> _tituloEn = $obj -> tituloEn;
		($_lang == 'ES') ? $this -> _titulo = $obj -> tituloEs : $this -> _titulo = $obj -> tituloEn;
	}

	function listTituloPagina($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_frontEnd = false, $_lang = 'ES'){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (tituloEs LIKE '%".$_busqueda."%')" : $_bus = '';

		$_MYSQL = new MYSQL();

		if($_paginador){
			$_TOTAL = "SELECT idTituloPagina, count(idTituloPagina) as totalRegistros FROM tituloPagina WHERE 1 = 1 ".$_stat." ".$_bus." ORDER BY orden DESC";
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

		$_SQL = "SELECT * FROM tituloPagina WHERE 1 = 1 ".$_stat.$_bus." ORDER BY orden DESC ".$_paginacion;


		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idTituloPagina'] = $_row['idTituloPagina'];
			if($_lang=='EN')
			{
				$_registro['titulo'] = $_row['tituloEn'];
			}
			elseif($_lang=='ES')
			{
				$_registro['titulo'] = $_row['tituloEs'];
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
}
?>
