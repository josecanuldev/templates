<?php
require_once('MYSQL.php');
require_once('herramientas.php');
require_once('productoxcategoria.php');
require_once('subcategoria.php');
require_once('archivo.php');

class categoria extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_idCategoria;
	var $_tituloEs;
	var $_tituloEn;
	var $_color;
	var $_fraseEs;
	var $_fraseEn;
	var $_imgPortada;
	var $_directorio = "../img/imgCategoria/";
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
	var $_subcategorias;

	function __construct($_idCategoria = 0, $_tituloEs = '', $_color = '', $_tipo = 0, $_tituloEn = '', $_fraseEs = '', $_fraseEn = '', $_imgPortada = '', $_tmp = ''){
		$this -> _idCategoria = $_idCategoria;
		$this -> _tituloEs = $_tituloEs;
		$this -> _tituloEn = $_tituloEn;
		$this -> _fraseEs = $_fraseEs;
		$this -> _fraseEn = $_fraseEn;
		$this -> _color = $_color;
		$this -> _tipo = $_tipo;
		($_imgPortada != '') ? $this -> _imgPortada = $this -> obtenerExtensionArchivo($_imgPortada) : $this -> _imgPortada = '';
		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;
		$this -> _herramientas = new herramientas();
		$this -> _subcategorias = array();
	}

	function addCategoria(){
		if($this->_tipo==1){
			if($this -> subir_archivo_imagen($this -> _imgPortada)){
				$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _tituloEs);
				$_MYSQL = new MYSQL();
				$_SQL = "INSERT INTO categoria(tituloEs, color, tipo, urlAmigable, status, tituloEn, fraseEs, fraseEn, imgPortada)VALUES(?,?,?,?,?,?,?,?,?)";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				if($_MYSQL -> Execute($_SQL, array($this -> _tituloEs, $this -> _color, $this -> _tipo, $this -> _urlAmigable, 1, $this -> _tituloEn, $this -> _fraseEs, $this -> _fraseEn, $this -> _imgPortada))){
					$this -> _idCategoria = $_MYSQL -> conexion -> lastInsertId();
					$_O = "UPDATE categoria SET orden = ? WHERE idCategoria = ?";
					$_MYSQL -> Execute($_O, array($this -> _idCategoria, $this -> _idCategoria));
					$_success = 2;
				}else{
					$this -> _idCategoria = 0;
					$_success = 1;
				}
			}else{
				$_success = 0;
			}
			return $_success;
		}
		else{
			$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _tituloEs);
			$_MYSQL = new MYSQL();
			$_SQL = "INSERT INTO categoria(tituloEs, color, tipo, urlAmigable, status, tituloEn)VALUES(?,?,?,?,?,?)";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			if($_MYSQL -> Execute($_SQL, array($this -> _tituloEs, $this -> _color, $this -> _tipo, $this -> _urlAmigable, 1, $this -> _tituloEn))){
				$this -> _idCategoria = $_MYSQL -> conexion -> lastInsertId();
				$_O = "UPDATE categoria SET orden = ? WHERE idCategoria = ?";
				$_MYSQL -> Execute($_O, array($this -> _idCategoria, $this -> _idCategoria));
				$_success = 2;
			}else{
				$this -> _idCategoria = 0;
				$_success = 1;
			}
			return $_success;
		}
	}

	function updateCategoria(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _tituloEs);
		$_MYSQL = new MYSQL();
		if($this -> _imgPortada != ''){
			$this -> getImgPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _imgPortada)){
				$_IMG = "UPDATE categoria SET imgPortada = ? WHERE idCategoria = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_IMG, array($this -> _imgPortada, $this -> _idCategoria));
			}
		}
		$_SQL = "UPDATE categoria SET tituloEs = ?, color = ?, urlAmigable = ?, tituloEn = ?, fraseEs = ?, fraseEn = ? WHERE idCategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _tituloEs, $this -> _color, $this -> _urlAmigable, $this -> _tituloEn, $this -> _fraseEs, $this -> _fraseEn, $this -> _idCategoria))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function deleteCategoria(){
		$this -> getImgPortada();
		$this -> borrar_archivo();
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM categoria WHERE idCategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idCategoria))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function getImgPortada(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT imgPortada FROM categoria WHERE idCategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idCategoria));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgPortada;
	}

	function updateStatusCategoria($_status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE categoria SET status = ? WHERE idCategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_status, $this -> _idCategoria));
	}

	function updateOrdenCategoria($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE categoria SET orden = ? WHERE idCategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idCategoria));
	}

	function getCategoria(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM categoria WHERE idCategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idCategoria));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idCategoria = $obj -> idCategoria;
		$this -> _tituloEs = $obj -> tituloEs;
		$this -> _tituloEn = $obj -> tituloEn;
		$this -> _color = $obj -> color;
		$this -> _fraseEs = $obj -> fraseEs;
		$this -> _fraseEn = $obj -> fraseEn;
		$this -> _imgPortada = $obj -> imgPortada;
	}

	function listCategoria($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_tipo = 1, $_frontEnd = false, $_lang = 'ES'){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = ' AND status != 3';
		($_busqueda != '') ? $_bus = " AND (tituloEs LIKE '%".$_busqueda."%')" : $_bus = '';

		$_MYSQL = new MYSQL();

		if($_paginador){
			$_TOTAL = "SELECT idCategoria, count(idCategoria) as totalRegistros FROM categoria WHERE 1 = 1 AND tipo = ".$_tipo." ".$_stat." ".$_bus." ORDER BY orden DESC";
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
		if($_frontEnd){
			$_SQL = "SELECT categoria.tituloEs, categoria.tituloEn, categoria.fraseEs, categoria.fraseEn, categoria.imgPortada, categoria.color, categoria.idCategoria, categoria.urlAmigable FROM categoria, productoxcategoria WHERE categoria.idCategoria = productoxcategoria.idCategoria AND tipo = ".$_tipo." AND categoria.status = 1 GROUP BY categoria.idCategoria ORDER BY categoria.orden DESC ";
		}else{
			$_SQL = "SELECT * FROM categoria WHERE 1 = 1 AND tipo = ".$_tipo." ".$_stat.$_bus." ORDER BY orden DESC ".$_paginacion;
		}

		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idCategoria'] = $_row['idCategoria'];
			$_registro['tituloEs'] = $_row['tituloEs'];
			$_registro['tituloEn'] = $_row['tituloEn'];
			$_registro['fraseEs'] = $_row['fraseEs'];
			$_registro['imgPortada'] = $_row['imgPortada'];
			$_registro['fraseEn'] = $_row['fraseEn'];
			$_registro['color'] = $_row['color'];
			if($_lang=='EN')
			{
				$_registro['titulo'] = $_row['color'];
			}
			elseif($_lang=='ES')
			{
				$_registro['titulo'] = $_row['tituloEs'];
			}
			$_registro['tipo'] = $_row['tipo'];
			($_tipo == 2) ? $_registro['total'] = $this -> getNumberBlogsxCategoria($_row['idCategoria']) : '';
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

	function listCategoriaFront($_tipo = 1){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM categoria WHERE tipo = ? AND status = ? ORDER BY orden DESC ";
		$_VALUES = array($_tipo,1);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idCategoria'] = $_row['idCategoria'];
			$_registro['tituloEs'] = $_row['tituloEs'];
			$_registro['tituloEn'] = $_row['tituloEn'];
			$_registro['imgPortada'] = $_row['imgPortada'];
			$_registro['fraseEs'] = $_row['fraseEs'];
			$_registro['fraseEn'] = $_row['fraseEn'];
			$_registro['color'] = $_row['color'];
			if($_lang=='EN')
			{
				$_registro['titulo'] = $_row['color'];
			}
			elseif($_lang=='ES')
			{
				$_registro['titulo'] = $_row['tituloEs'];
			}
			$_registro['tipo'] = $_row['tipo'];
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			$_registro['status'] = $_row['status'];
			$_registro['orden'] = $_row['orden'];
			$this -> _idCategoria = $_row['idCategoria'];
			$this -> listarSubcategoria(1);
			$_registro['subcategorias'] = $this -> _subcategorias;
			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function getNumberBlogsxCategoria($_idCategoria){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT count(idCategoria) as total FROM blog WHERE idCategoria = ? AND status = 1";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_idCategoria));
		$obj = $_MYSQL -> fetchobject();
		return $obj -> total;
	}

	/* ===================================
	 * N:N _PORTAFOLIOXCATEGORIA
	 * =================================== */
	function removerCategoriaxProducto(){
		$productoxcategoria = new productoxcategoria(0, $this -> _idCategoria);
		$productoxcategoria -> removeCategoriaxProducto();
	}

	function listNombreProductoxCategoria($_idCategoria = 0){
		$productoxcategoria = new productoxcategoria(0, $_idCategoria);
		$productoxcategoria -> listNombreProductoxCategoria();
		return $productoxcategoria -> _productos;
	}

	/* ===================================
	 * 1:N CATEGORIA CON SUBCATEGORIAS
	 * =================================== */

	function agregarSubcategoria($_nombre = ''){
		$subcategoria = new subcategoria(0, $this -> _idCategoria, $_nombre);
		$subcategoria -> addSubcategoria();
	}

	function modificarSubcategoria($_idSubcategoria = 0, $_nombre = ''){
		$subcategoria = new subcategoria($_idSubcategoria, 0, $_nombre);
		$subcategoria -> updateSubcategoria();
	}

	function eliminarSubcategoria($_idSubcategoria, $_all = false){
		$subcategoria = new subcategoria($_idSubcategoria, $this -> _idCategoria);
		$subcategoria -> deleteSubcategoria($_all);
	}

	function ordenSubcategoria($_orden, $_idSubcategoria){
		$subcategoria = new subcategoria($_idSubcategoria);
		$subcategoria -> updateOrdenSubcategoria($_orden);
	}

	function statusSubcategoria($_status, $_idSubcategoria){
		$subcategoria = new subcategoria($_idSubcategoria);
		$subcategoria -> updateStatusSubcategoria($_status);
	}

	function listarSubcategoria($_status = 0){
		$this -> _subcategorias = array();
		$subcategoria = new subcategoria(0, $this -> _idCategoria);
		$this -> _subcategorias = $subcategoria -> listSubcategoria($_status);
	}
}
?>
