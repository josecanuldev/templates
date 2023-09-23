<?php
require_once('MYSQL.php');
require_once('archivo.php');
require_once('herramientas.php');

class incentivo extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_idIncentivo;
	var $_titulo;
	var $_tituloEn;
	var $_link;
	var $_imgPortada;
	var $_imgMovil;
	var $_descripcion;
	var $_descripcionEn;
	var $_textoBoton;
	var $_textoBotonEn;
	var $_linkVideo;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_directorio = "../img/imgIncentivo/";
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;
	
	function __construct($_idIncentivo = 0, $_titulo = '', $_link = '', $_imgPortada = '', $_tmp = '', $_tituloEn = '', $_descripcion = '', $_descripcionEn = ''){
		$this -> _idIncentivo = $_idIncentivo;
		$this -> _titulo = $_titulo;
		$this -> _tituloEn = $_tituloEn;
		$this -> _link = $_link;
		$this -> _descripcion = $_descripcion;
		$this -> _descripcionEn = $_descripcionEn;
		
		($_imgPortada != '') ? $this -> _imgPortada = $this -> obtenerExtensionArchivo($_imgPortada) : $this -> _imgPortada = '';
		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;
		$this -> _herramientas = new herramientas();
	}

	function addIncentivo(){
		if($this -> subir_archivo_imagen($this -> _imgPortada)){
			$_MYSQL = new MYSQL();
			$_SQL = "INSERT INTO incentivo(titulo, link, imgPortada, status, tituloEn, descripcion, descripcionEn)VALUES(?,?,?,?,?,?,?)";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			if($_MYSQL -> Execute($_SQL, array($this -> _titulo, $this -> _link, $this -> _imgPortada, 1, $this -> _tituloEn, $this -> _descripcion, $this -> _descripcionEn))){
				$this -> _idIncentivo = $_MYSQL -> conexion -> lastInsertId();
				$_O = "UPDATE incentivo SET orden = ? WHERE idIncentivo = ?";
				$_MYSQL -> Execute($_O, array($this -> _idIncentivo, $this -> _idIncentivo));
				$_success = 2;
			}else{
				$this -> _idIncentivo = 0;	
				$_success = 1;
			} 	
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateIncentivo(){
		$_MYSQL = new MYSQL();
		if($this -> _imgPortada != ''){
			$this -> getImgPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _imgPortada)){
				$_IMG = "UPDATE incentivo SET imgPortada = ? WHERE idIncentivo = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_IMG, array($this -> _imgPortada, $this -> _idIncentivo));
			}
		}
		$_SQL = "UPDATE incentivo SET titulo = ?, link = ?, tituloEn = ?,  descripcion = ?,  descripcionEn = ? WHERE idIncentivo = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _titulo, $this -> _link, $this -> _tituloEn, $this -> _descripcion, $this -> _descripcionEn, $this -> _idIncentivo))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateImgMovil($_ruta = '', $_tmp = ''){
		if($_ruta != ''){
			$this -> getImgMovil();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $_tmp;
			$_ruta = $this -> obtenerExtensionArchivo($_ruta);
			$this -> subir_archivo_imagen($_ruta);
			$_MYSQL = new MYSQL();
			$_SQL = "UPDATE incentivo SET imgMovil = ? WHERE idIncentivo = ?";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			$_MYSQL -> Execute($_SQL, array($_ruta, $this -> _idIncentivo));
		}
	}

	function deleteIncentivo(){
		$this -> getImgPortada();
		$this -> borrar_archivo();
		$this -> getImgMovil();
		$this -> borrar_archivo();

		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM incentivo WHERE idIncentivo = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idIncentivo))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function getImgPortada(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT imgPortada FROM incentivo WHERE idIncentivo = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idIncentivo));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgPortada;
	}

	function getImgMovil(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT imgMovil FROM incentivo WHERE idIncentivo = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idIncentivo));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgMovil;
	}


	function updateStatusIncentivo($_status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE incentivo SET status = ? WHERE idIncentivo = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_status, $this -> _idIncentivo));
	}

	function updateOrdenIncentivo($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE incentivo SET orden = ? WHERE idIncentivo = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idIncentivo));
	}

	function getIncentivo(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM incentivo WHERE idIncentivo = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idIncentivo));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idIncentivo = $obj -> idIncentivo;
		$this -> _titulo = $obj -> titulo;
		$this -> _tituloEn = $obj -> tituloEn;
		$this -> _link = $obj -> link;
		$this -> _imgPortada = $obj -> imgPortada;
		$this -> _descripcion = $obj -> descripcion;
		$this -> _descripcionEn = $obj -> descripcionEn;
	}

	function listIncentivo($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lastID = ''){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (titulo LIKE '%".$_busqueda."%')" : $_bus = '';
		
		$_MYSQL = new MYSQL();
		$_TOTAL = "SELECT idIncentivo, count(idIncentivo) as totalRegistros FROM incentivo WHERE 1 = 1 ".$_stat." ".$_bus." ORDER BY orden DESC";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_paginador){
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
		
		$_SQL = "SELECT * FROM incentivo WHERE 1 = 1 ".$_stat.$_bus." ORDER BY orden DESC ".$_paginacion;
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idIncentivo'] = $_row['idIncentivo'];
			$_registro['titulo'] = $_row['titulo'];
			$_registro['tituloEn'] = $_row['tituloEn'];
			$_registro['link'] = $_row['link'];
			$_registro['descripcion'] = $_row['descripcion'];
			$_registro['descripcionEn'] = $_row['descripcionEn'];
			$_registro['imgPortada'] = $_row['imgPortada'];
			$_registro['imgMovil'] = $_row['imgMovil'];
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
	function videoType($url) {
	    if (strpos($url, 'youtube') > 0) {
	        return 'youtube';
	    } elseif (strpos($url, 'vimeo') > 0) {
	        return 'vimeo';
	    } else {
	        return 'unknown';
	    }
	}
}
?>