<?php
require_once('MYSQL.php');
require_once('herramientas.php');
//include_once('galeriaLB.php');
include_once('seccion.php');

class lookbook{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_idLookbook;
	var $_tituloEs;
	var $_tituloEn;
	var $_fechaFormated;
	var $_fecha;
	var $_urlAmigable;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;
	var $_galeriaLB;

	var $_seccion;

	function __construct($_idLookbook = 0, $_tituloEs = '', $_tituloEn = '', $_fecha = ''){
		$this -> _idLookbook = $_idLookbook;
		$this -> _tituloEs = $_tituloEs;
		$this -> _tituloEn = $_tituloEn;
		$this -> _fecha = $_fecha;
		$this -> _herramientas = new herramientas();
		$this -> _galeriaLB = array();
	}

	function addLookbook(){
		$_MYSQL = new MYSQL();
		$_SQL = "INSERT INTO lookbook(tituloEs, tituloEn, fecha, status)VALUES(?,?,?,?)";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _tituloEs, $this -> _tituloEn, $this -> _fecha, 1))){
			$this -> _idLookbook = $_MYSQL -> conexion -> lastInsertId();
			$_O = "UPDATE lookbook SET orden = ? WHERE idLookbook = ?";
			$_MYSQL -> Execute($_O, array($this -> _idLookbook, $this -> _idLookbook));
			$_success = 2;
		}else{
			$this -> _idLookbook = 0;
			$_success = 1;
		}
		return $_success;
	}

	function updateLookbook(){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE lookbook SET tituloEs = ?, tituloEn = ?, fecha = ? WHERE idLookbook = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _tituloEs, $this -> _tituloEn, $this -> _fecha, $this -> _idLookbook))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function deleteLookbook(){
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM lookbook WHERE idLookbook = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idLookbook))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateStatusLookbook($_status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE lookbook SET status = ? WHERE idLookbook = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_status, $this -> _idLookbook));
	}

	function updateOrdenLookbook($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE lookbook SET orden = ? WHERE idLookbook = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idLookbook));
	}

	function getLookbook($_lang = 'ES'){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM lookbook WHERE idLookbook = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idLookbook));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idLookbook = $obj -> idLookbook;
		if($_lang=='ES')
		{
			$this -> _titulo = $obj -> tituloEs;
			$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($obj -> tituloEs);
		}
		elseif($_lang=='EN'){
			$this -> _titulo = $obj -> tituloEn;
		}
		$this -> _tituloEs = $obj -> tituloEs;
		$this -> _tituloEn = $obj -> tituloEn;
		$this -> _fecha = $obj -> fecha;
		$this -> _fechaFormated = $this -> _herramientas -> getFormatedDate($obj -> fecha);
		$this -> _listGaleriaLB();
	}

	function getTituloLookBook($_id, $_lang){
		$_MYSQL = new MYSQL();
		($_lang == 'ES') ? $_SQL = "SELECT tituloEs FROM lookbook WHERE idLookbook = ?" : $_SQL = "SELECT tituloEn FROM lookbook WHERE idLookbook = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_idCategoria));
		$obj = $_MYSQL -> fetchobject();
		if($_lang == 'ES') return $obj -> tituloEs; else return $obj -> tituloEn;

	}

	function listLookbook($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lastID = '', $_frontEnd = false, $_lang = 'ES'){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (tituloEs LIKE '%".$_busqueda."%')" : $_bus = '';

		$_MYSQL = new MYSQL();

		if($_paginador){
			$_TOTAL = "SELECT idLookbook, count(idLookbook) as totalRegistros FROM lookbook WHERE 1 = 1 ".$_stat." ".$_bus." ORDER BY fecha DESC";
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

		$_SQL = "SELECT * FROM lookbook WHERE 1 = 1 ".$_stat.$_bus." ORDER BY orden DESC ".$_paginacion;

		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idLookbook'] = $_row['idLookbook'];
			if($_lang=='ES')
			{
				$_registro['titulo'] = $_row['tituloEs'];
				$_registro['urlAmigable'] = $this -> _herramientas -> getUrlAmigable($_row['tituloEs']);
			}
			elseif($_lang=='EN'){
				$_registro['titulo'] = $_row['tituloEn'];
				$_registro['urlAmigable'] = $this -> _herramientas -> getUrlAmigable($_row['tituloEn']);
			}
			$_registro['tituloEs'] = $_row['tituloEs'];
			$_registro['tituloEn'] = $_row['tituloEn'];
			$_registro['fecha'] = $_row['fecha'];
			$_registro['status'] = $_row['status'];
			$_registro['orden'] = $_row['orden'];
			$_registro['imgPortada'] = $this -> getPortadaLookBook($_row['idLookbook']);
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

	function getLookbookLast($_lang = 'ES'){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM lookbook WHERE status=1 order by fecha DESC LIMIT 0,1";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idLookbook));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idLookbook = $obj -> idLookbook;
		if($_lang=='ES')
		{
			$this -> _titulo = $obj -> tituloEs;
		}
		elseif($_lang=='EN'){
			$this -> _titulo = $obj -> tituloEn;
		}
		$this -> _fecha = $obj -> fecha;
		$this -> _fechaFormated = $this -> _herramientas -> getFormatedDate($obj -> fecha);
		$this -> _listGaleriaLB();
	}
/* ========================================================================================================
 *				_MAESTRO DETALLE GALERIALB
 * ========================================================================================================  */
	function _addGaleriaLB($_name = '', $_tmp = ''){
		$galeriaLB = new galeriaLB(0, $this -> _idLookbook, $_name, $_tmp);
		$galeriaLB -> addGaleriaLB();
	}

	function _updateGaleriaLB($_idGaleriaLB = 0, $_name = '', $_tmp = ''){
		$galeriaLB = new galeriaLB($_idGaleriaLB, $this -> _idLookbook, $_name, $_tmp);
		$galeriaLB -> updateGaleriaLB();
	}

	function _deleteGaleriaLB($_idGaleriaLB = 0){
		$galeriaLB = new galeriaLB($_idGaleriaLB);
		$galeriaLB -> deleteGaleriaLB();
	}

	function _updateOrdenGaleriaLB($_idGaleriaLB = 0, $_orden = 0){
		$galeriaLB = new galeriaLB($_idGaleriaLB);
		$galeriaLB -> updateOrdenGaleriaLB($_orden);
	}

	function _listGaleriaLB(){
		$galeriaLB = new galeriaLB(0 , $this -> _idLookbook);
		$this -> _galeriaLB = $galeriaLB -> listGaleriaLB();
	}

	/*function getPortadaLookBook($_idLookbook){
		$galeriaLB = new galeriaLB(0 , $_idLookbook);
		$portada = $galeriaLB -> listGaleriaLB();
		return $portada[0]['ruta'];
	}*/

	function getPortadaLookBook($_idLookbook){
		$seccion = new seccion(0 , $_idLookbook);
		$portada = $seccion -> listSeccion();
		return $portada[0]['contenido'][0]['ruta'];
	}

}
?>
