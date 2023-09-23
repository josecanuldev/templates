<?php 
require_once('MYSQL.php');
require_once('archivo.php');
require_once('herramientas.php');

/**
 * summary
 */
class banners extends Archivo
{
    /**
     * summary
     */
    var $_idBanner;
	var $_link;
	var $_titulo;
	var $_tituloEn;
	var $_imgPortada;
	var $_imgMovil;
	var $_descripcion;
	var $_descripcionEn;
	var $_textoBoton;
	var $_textoBotonEn;
	var $_linkVideo;
	var $_tipo;

	var $_status;
	var $_orden;
	var $_directorio = "../img/";
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;

    function __construct($_idBanner = 0, $_titulo = '', $_link = '', $_imgPortada = '', $_tmp = '', $_tituloEn = '', $_descripcion = '', $_descripcionEn = '', $_textoBoton = '', $_textoBotonEn = '', $_linkVideo = '', $_tipo=1){
		$this -> _idBanner = $_idBanner;
		$this -> _titulo = $_titulo;
		$this -> _tituloEn = $_tituloEn;
		$this -> _link = $_link;
		$this -> _descripcion = $_descripcion;
		$this -> _descripcionEn = $_descripcionEn;
		$this -> _textoBoton = $_textoBoton;
		$this -> _textoBotonEn = $_textoBotonEn;
		$this -> _linkVideo = $_linkVideo;
		$this -> _tipo 		 = $_tipo;

		($_imgPortada != '') ? $this -> _imgPortada = $this -> obtenerExtensionArchivo($_imgPortada) : $this -> _imgPortada = '';
		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;
		$this -> _herramientas = new herramientas();
	}

	function addSlide(){
		if($this -> subir_archivo_imagen($this -> _imgPortada)){
			$_MYSQL = new MYSQL();
			$_SQL = "INSERT INTO otros_servicios(titulo, link, imgPortada, status, tituloEn, descripcion, descripcionEn, textoBoton, textoBotonEn, linkVideo, tipo)VALUES(?,?,?,?,?,?,?,?,?,?,?)";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			if($_MYSQL -> Execute($_SQL, array($this -> _titulo, $this -> _link, $this -> _imgPortada, 1, $this -> _tituloEn, $this -> _descripcion, $this -> _descripcionEn, $this -> _textoBoton, $this -> _textoBotonEn, $this -> _linkVideo, $this -> _tipo))){
				$this -> _idBanner = $_MYSQL -> conexion -> lastInsertId();
				$_O = "UPDATE otros_servicios SET orden = ? WHERE idBanner = ?";
				$_MYSQL -> Execute($_O, array($this -> _idBanner, $this -> _idBanner));
				$_success = 2;
			}else{
				$this -> _idBanner = 0;
				$_success = 1;
			}
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateSlide(){
		$_MYSQL = new MYSQL();
		if($this -> _imgPortada != ''){
			$this -> getImgPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _imgPortada)){
				$_IMG = "UPDATE otros_servicios SET imgPortada = ? WHERE idBanner = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_IMG, array($this -> _imgPortada, $this -> _idBanner));
			}
		}
		$_SQL = "UPDATE otros_servicios SET titulo = ?, link = ?, tituloEn = ?,  descripcion = ?,  descripcionEn = ?,  textoBoton = ?,  textoBotonEn = ?, linkVideo = ? WHERE idBanner = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _titulo, $this -> _link, $this -> _tituloEn, $this -> _descripcion, $this -> _descripcionEn, $this -> _textoBoton, $this -> _textoBotonEn, $this -> _linkVideo, $this -> _idBanner))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function deleteSlide(){
		$this -> getImgPortada();
		$this -> borrar_archivo();
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM otros_servicios WHERE idBanner = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idBanner))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function getSlide(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM otros_servicios WHERE idBanner = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idBanner));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idBanner = $obj -> idBanner;
		$this -> _titulo = $obj -> titulo;
		$this -> _tituloEn = $obj -> tituloEn;
		$this -> _link = $obj -> link;
		$this -> _imgPortada = $obj -> imgPortada;
		$this -> _descripcion = $obj -> descripcion;
		$this -> _descripcionEn = $obj -> descripcionEn;
		$this -> _textoBoton = $obj -> textoBoton;
		$this -> _textoBotonEn = $obj -> textoBotonEn;
		$this -> _linkVideo = $obj -> linkVideo;
	}

	function listSlide($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lastID = '', $tipo=0){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (titulo LIKE '%".$_busqueda."%')" : $_bus = '';
		($tipo != '') ? $_tip = " AND tipo = ".$tipo : $_tip = '';

		$_MYSQL = new MYSQL();
		$_TOTAL = "SELECT idBanner, count(idBanner) as totalRegistros FROM otros_servicios WHERE 1 = 1 ".$_stat." ".$_bus." ".$_tip." ORDER BY orden DESC";

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

		$_SQL = "SELECT * FROM otros_servicios WHERE 1 = 1 ".$_stat.$_bus.$_tip." ORDER BY orden DESC ".$_paginacion;
		$_CONECTADO = $_MYSQL -> Connect();
		// echo $_SQL; exit;
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBanner'] = $_row['idBanner'];
			$_registro['titulo'] = $_row['titulo'];
			$_registro['tituloEn'] = $_row['tituloEn'];
			$_registro['link'] = $_row['link'];
			$_registro['descripcion'] = $_row['descripcion'];
			$_registro['descripcionEn'] = $_row['descripcionEn'];
			$_registro['textoBoton'] = $_row['textoBoton'];
			$_registro['textoBotonEn'] = $_row['textoBotonEn'];
			$_registro['linkVideo'] = $_row['linkVideo'];
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

	function getImgPortada(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT imgPortada FROM otros_servicios WHERE idBanner = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idSlide));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgPortada;
	}
}


?>