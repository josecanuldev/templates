<?php
require_once('MYSQL.php');
require_once('archivo.php');
require_once('herramientas.php');
require_once('galeria.php');
require_once('productoxcategoria.php');
require_once 'datosProducto.php';
require_once 'combinacion.php';
include_once 'valoresxcombinacion.php';
include_once 'descuento.php';

class producto{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_idProducto;
	var $_idCategoria;
	var $_objCat;
	var $_idSubcategoria;
	var $_objSubCat;
	var $_nameEtiqueta;
	var $_idEtiqueta;
	var $_idPortada;

	var $_destacado;
	var $_precio;
	var $_peso;
	var $_stock;
	var $codigo;

	var $_precioMostrar;
	var $_aplicarDescuento;
	var $_aplicarDescuentoProducto;
	var $_tipoDescuento;
	var $_valorDescuento;
	var $_precioFinal;
	var $_precioFinalProducto;
	var $_precioGuardar;
	var $_sincombinacion;

	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_status;
	var $_orden;

	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;
	var $_galeria;
	var $_productoxcategoria;
	var $_datosProducto;
	var $_combinaciones;
	var $_categorias;

	function __construct($_idProducto = 0, $_idCategoria = 0, $_precio = 0, $_peso = 0, $_stock = 0, $codigo = 0){
		$this -> _idProducto = $_idProducto;
		$this -> _idCategoria = $_idCategoria;
		$this -> _precio = $_precio;
		$this -> _peso = $_peso;
		$this -> _stock = $_stock;
		$this -> codigo = $codigo;

		$this -> _herramientas = new herramientas();
		$this -> _galeria = array();
		$this -> _combinaciones = array();
		$this -> _categorias = array();
	}

	function addProducto(){
		$_MYSQL = new MYSQL();
		$_SQL = "INSERT INTO producto(idCategoria, precio, peso, stock, status, codigo)VALUES(?,?,?,?,?,?)";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idCategoria, $this -> _precio, $this -> _peso, $this -> _stock, 1, $this -> codigo))){
			$this -> _idProducto = $_MYSQL -> conexion -> lastInsertId();
			$_O = "UPDATE producto SET orden = ? WHERE idProducto = ?";
			$_MYSQL -> Execute($_O, array($this -> _idProducto, $this -> _idProducto));
			$_success = 2;
		}else{
			$this -> _idProducto = 0;
			$_success = 1;
		}
		return $_success;
	}

	function updateProducto(){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE producto SET idCategoria = ?, precio = ?, peso = ?, stock = ?, codigo = ? WHERE idProducto = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idCategoria, $this -> _precio, $this -> _peso, $this -> _stock, $this -> codigo, $this -> _idProducto))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateDescuento($_aplicarDescuento = 0, $_tipoDescuento = 0, $_valorDescuento = 0){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE producto SET aplicarDescuento = ?, tipoDescuento = ?, valorDescuento = ? WHERE idProducto = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_aplicarDescuento, $_tipoDescuento, $_valorDescuento, $this -> _idProducto));
	}

	function deleteProducto(){
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM producto WHERE idProducto = ?";
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



	function updateStatusProducto($_status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE producto SET status = ? WHERE idProducto = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_status, $this -> _idProducto));
	}

	function updateDestacarProducto($_status){
		$_MYSQL = new MYSQL();
		$_SQLT = "SELECT COUNT(idProducto) as total FROM producto WHERE destacado = 1";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQLT, array());
		$obj = $_MYSQL -> fetchobject();
		if($obj -> total < 9 AND $_status == 1){
			$_SQL = "UPDATE producto SET destacado = ? WHERE idProducto = ?";
			$_MYSQL -> Execute($_SQL, array($_status, $this -> _idProducto));
			$_success = 1;
		}else{
			$_SQL = "UPDATE producto SET destacado = ? WHERE idProducto = ?";
			$_MYSQL -> Execute($_SQL, array($_status, $this -> _idProducto));
			$_success = 0;
		}

		return $_success;
	}

	function updateOrdenProducto($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE producto SET orden = ? WHERE idProducto = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idProducto));
	}

	function validarStock($_cantidad){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT stock FROM producto WHERE idProducto = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idProducto));
		$obj = $_MYSQL -> fetchobject();
		//echo 'cantidad'.$_cantidad.' > '.$obj -> stock;
		if($_cantidad > $obj -> stock) return false; else return true;
	}

	function disminuir_inventario ($_cantidad){
	 	$_MYSQL = new MYSQL();
	 	$_SQL="update producto set stock = stock - ? where idProducto = ?";
	 	$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_cantidad, $this -> _idProducto));
	}

	function getProducto(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM producto WHERE idProducto = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idProducto));
		$obj = $_MYSQL -> fetchobject();
		$this -> _idProducto = $obj -> idProducto;
		$this -> _idCategoria = $obj -> idCategoria;
		$this -> _objCat = $this -> getNameCategoria($obj -> idCategoria);
		$this -> _idSubcategoria = $obj -> idSubcategoria;
		$this -> _objSubCat = $this -> getNameSubCategoria($obj -> idSubcategoria);
		$this -> _idEtiqueta = $obj -> idEtiqueta;
		$this -> _nameEtiqueta = $this -> getNameEtiqueta($obj -> idEtiqueta, 'ES');
		$this -> _precio = $obj -> precio;
		$this -> urlAmigable = $obj -> urlAmigable;
		$this -> codigo = $obj -> codigo;
		$this -> _precioMostrar = number_format($obj -> precio,2);
		$this -> _tipoDescuento = $obj -> tipoDescuento;
		$this -> _valorDescuento = $obj -> valorDescuento;
		$_descxcat = $this -> calcularDescuentoxCategoria($obj -> idCategoria, $obj -> precio, $obj -> aplicarDescuento);
		if($_descxcat != 'sin descuento'){
			$this -> _aplicarDescuento = 1;
			$this -> _aplicarDescuentoProducto = 0;
			$this -> _precioFinal = number_format($_descxcat,2);
			$this -> _precioFinalProducto = number_format($obj -> precio,2);
			$this -> _precioGuardar = $_descxcat;
				//echo 'entre al descuento';
		}else if($obj -> tipoDescuento == 1){
			$this -> _aplicarDescuento = 1;
			$this -> _aplicarDescuentoProducto = 1;
			if($obj -> tipoDescuento == 1){
				$_tmpPrice = ($obj -> precio * $obj -> valorDescuento) / 100;
				$this -> _precioFinal = number_format($obj -> precio - $_tmpPrice, 2);
				$this -> _precioFinalProducto = number_format($obj -> precio - $_tmpPrice, 2);
				$this -> _precioGuardar = $obj -> precio - $_tmpPrice;
			}else{
				$this -> _precioFinal = number_format($obj -> precio - $obj -> valorDescuento,2);
				$this -> _precioFinalProducto = number_format($obj -> precio - $_tmpPrice, 2);
				$this -> _precioGuardar = $obj -> precio - $obj -> valorDescuento;
			}
			//echo 'entre al descuento por producto';
		}else{
			$this -> _aplicarDescuento = 0;
			$this -> _aplicarDescuentoProducto = 0;
			$this -> _precioFinal = number_format($obj -> precio,2);
			$this -> _precioFinalProducto = number_format($obj -> precio,2);
			$this -> _precioGuardar = $obj -> precio;
			//echo 'entre al sin descuento';
		}
		$this -> _peso = $obj -> peso;
		$this -> _stock = $obj -> stock;
		$this -> _lugar = $obj -> lugar;
		$this -> _superficie = $obj -> superficie;
		$this -> _tipo = $obj -> tipo;
		$this -> _cliente = $obj -> cliente;
		//$this -> _categorias = $this -> listLabelCategorias($obj -> idProducto, false);

		$this -> listarGaleria('secundaria');
		$this -> listarCombinaciones();
		(count($this -> _combinaciones) == 0) ? $this -> _sincombinacion = 0 : $this -> _sincombinacion = 1;
		$this -> getPortadaGaleria();
		$this -> getFondoGaleria();
	}

	function listProducto($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_idCategoria = 0, $_idSubcategoria = 0, $_sort = '', $_lang = 'ES', $_frontEnd = false, $idIngrediente=0, $idConsideracion=0){
		($_status != '') ? $_stat = " AND producto.status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (datosProducto.titulo LIKE '%".$_busqueda."%' OR datosProducto.tags LIKE '%".$_busqueda."%')" : $_bus = '';
		($_idCategoria != 0) ? $_cat = " AND producto.idCategoria = ".$_idCategoria : $_cat = '';
		//($_idSubcategoria != 0) ? $_subcat = " AND producto.idSubcategoria = ".$_idSubcategoria : $_subcat = '';
		($_sort != '') ? $_orderBy = ' ORDER BY '.$_sort.' ' : $_orderBy = ' ORDER BY producto.orden DESC ';
		($idIngrediente != 0) ? $ing = " AND ingredientexproducto.idIngrediente = ".$idIngrediente : $ing = '';
		($idConsideracion != 0) ? $cons = " AND consideracionxproducto.idConsideracion = ".$idConsideracion : $cons = '';

		$_MYSQL = new MYSQL();
		/*if($_idCategoria != 0){
			$_TOTAL = "SELECT count(producto.idProducto) as totalRegistros, datosProducto.*, productoxcategoria.idCategoria FROM producto, datosProducto, productoxcategoria WHERE producto.idProducto = productoxcategoria.idProducto AND datosProducto.idProducto = producto.idProducto AND productoxcategoria.idCategoria = ? AND datosProducto.lang = ? ".$_stat.$_bus." GROUP by producto.idProducto";
			//echo "SELECT count(producto.idProducto) as totalRegistros, datosProducto.*, productoxcategoria.idCategoria FROM producto, datosProducto, productoxcategoria WHERE producto.idProducto = productoxcategoria.idProducto AND datosProducto.idProducto = producto.idProducto AND productoxcategoria.idCategoria = ".$_idCategoria." AND datosProducto.lang = '".$_lang."' ".$_stat.$_bus." GROUP by producto.idProducto";
			$_array = array($_idCategoria, $_lang);
		}else{
			$_TOTAL = "SELECT count(producto.idProducto) as totalRegistros FROM producto, datosProducto WHERE datosProducto.idProducto = producto.idProducto AND datosProducto.lang = ? ".$_stat." ".$_bus." ORDER BY orden DESC";
			//echo "SELECT count(producto.idProducto) as totalRegistros FROM producto, datosProducto WHERE datosProducto.idProducto = producto.idProducto AND datosProducto.lang = '".$_lang."' ".$_stat." ".$_bus." ORDER BY orden DESC";
			$_array = array($_lang);
		}*/
		if($_frontEnd){
			$_TOTAL = "SELECT count(producto.idProducto) as totalRegistros FROM producto, datosProducto, combinacion WHERE datosProducto.idProducto = producto.idProducto AND producto.idProducto = combinacion.idProducto AND datosProducto.lang = ? ".$_cat.$_subcat.$_stat.$_bus.' GROUP BY producto.idProducto'.$_orderBy;
		}else{
			$_TOTAL = "SELECT count(producto.idProducto) as totalRegistros FROM producto, datosProducto WHERE datosProducto.idProducto = producto.idProducto AND datosProducto.lang = ? ".$_cat.$_subcat.$_stat.$_bus.$_orderBy;
		}

		$_array = array($_lang);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_paginador){
			$_MYSQL -> Execute($_TOTAL, $_array);
			$totalRegistros = $_MYSQL -> numrows();
			$this -> _totalRegistros = $totalRegistros;
			$this -> _registrosPorPagina = $_registrosPorPagina;
			$_ultimaPagina = ceil($this -> _totalRegistros / $this -> _registrosPorPagina);
			$_paginaActual = $_pagina;
			$_paginacion = ' LIMIT '.($_pagina - 1) * $this -> _registrosPorPagina.','.$this -> _registrosPorPagina;
		}else{
			$_paginacion = '';
		}

		/*if($_idCategoria != 0){
			$_SQL = "SELECT producto.*, datosProducto.*, productoxcategoria.idCategoria, galeria.ruta FROM producto, datosProducto, productoxcategoria, galeria WHERE producto.idProducto = productoxcategoria.idProducto AND datosProducto.idProducto = producto.idProducto AND producto.idProducto = galeria.idProducto AND galeria.tipo = ?  AND productoxcategoria.idCategoria = ? AND datosProducto.lang = ? ".$_stat.$_bus." GROUP by producto.idProducto ".$_order.$_paginacion;
			$_array2 = array('portada', $_idCategoria, $_lang);
		}else{
			$_SQL = "SELECT producto.*, datosProducto.*, galeria.ruta FROM producto, datosProducto, galeria WHERE datosProducto.idProducto = producto.idProducto AND producto.idProducto = galeria.idProducto AND galeria.tipo = ? AND datosProducto.lang = ? ".$_stat.$_bus." GROUP by producto.idProducto ".$_order.$_paginacion;
			//echo "SELECT producto.*, datosProducto.*, galeria.ruta FROM producto, datosProducto, galeria WHERE datosProducto.idProducto = producto.idProducto  AND producto.idProducto = galeria.idProducto AND galeria.tipo = 'portada' AND datosProducto.lang = '".$_lang."' ".$_stat.$_bus." GROUP by producto.idProducto ".$_order.$_paginacion;
			$_array2 = array('portada', $_lang);
		}*/
		if($_frontEnd){
			$_SQL = "SELECT producto.*, datosProducto.*, galeria.ruta, (SELECT MIN(D.precio) FROM `combinacion` D WHERE D.`idProducto` = producto.`idProducto` LIMIT 1) AS `precio` FROM producto, datosProducto, galeria, combinacion, ingredientexproducto, consideracionxproducto WHERE datosProducto.idProducto = producto.idProducto AND producto.idProducto = combinacion.idProducto AND producto.idProducto = galeria.idProducto AND producto.idProducto=ingredientexproducto.idProducto AND producto.idProducto=consideracionxproducto.idProducto AND galeria.tipo = ? AND datosProducto.lang = ? ".$_cat.$_subcat.$_stat.$_bus.$ing.$cons." GROUP by producto.idProducto ".$_orderBy.$_paginacion;
		}else{
			$_SQL = "SELECT producto.*, datosProducto.*, galeria.ruta FROM producto, datosProducto, galeria WHERE datosProducto.idProducto = producto.idProducto AND producto.idProducto = galeria.idProducto AND galeria.tipo = ? AND datosProducto.lang = ? ".$_cat.$_subcat.$_stat.$_bus." GROUP by producto.idProducto ".$_orderBy.$_paginacion;
		}

			//echo "SELECT producto.*, datosProducto.*, galeria.ruta FROM producto, datosProducto, galeria WHERE datosProducto.idProducto = producto.idProducto  AND producto.idProducto = galeria.idProducto AND galeria.tipo = 'portada' AND datosProducto.lang = '".$_lang."' ".$_stat.$_bus." GROUP by producto.idProducto ".$_order.$_paginacion;
		$_array2 = array('portada', $_lang);

		//$_SQL = "SELECT * FROM producto WHERE 1 = 1 ".$_stat.$_bus." ORDER BY orden DESC".$_paginacion;
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		//echo $_SQL;
		$_MYSQL -> Execute($_SQL, $_array2);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idProducto'] = $_row['idProducto'];
			$_registro['idCategoria'] = $_row['idCategoria'];
			$_objCat = $this -> getNameCategoria($_row['idCategoria']);
			$_registro['nombreCat'] = $_objCat -> tituloEs;
			$_registro['idSubcategoria'] = $_row['idSubcategoria'];
			$_registro['idEtiqueta'] = $_row['idEtiqueta'];
			$_registro['nombreEtiqueta'] = $this -> getNameEtiqueta($_row['idEtiqueta'], $_lang);
			$_registro['titulo'] = $_row['titulo'];
			$_registro['codigo'] = $_row['codigo'];
			$_registro['descripcion'] = $this -> _herramientas -> cortarTexto($_row['descripcion'], 50);
			$_registro['shortDesc'] = $_row['tags'];
			$_registro['tags'] = $this -> _herramientas -> formatedTags($_row['tags'], true);
			$_registro['tagsAmigables'] = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			$_registro['precio'] = $_row['precio'];
			$_descxcat = $this -> calcularDescuentoxCategoria($_row['idCategoria'], $_row['precio'], $_row['aplicarDescuento']);
			if($_descxcat != 'sin descuento'){
				$_registro['aplicarDescuento'] = 1;
				$_registro['precioDescuento'] = number_format($_descxcat,2);
				//echo 'entre al descuento';
			}else if($_row['aplicarDescuento'] == 1){
				$_registro['aplicarDescuento'] = 1;
				if($_row['tipoDescuento'] == 1){
					$_tmpPrice = ($_row['precio'] * $_row['valorDescuento']) / 100;
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_tmpPrice, 2);
				}else{
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_row['valorDescuento'],2);
				}
				//echo 'entre al descuento por producto';
			}else{
				$_registro['aplicarDescuento'] = 0;
				$_registro['precioDescuento'] = number_format($_row['precio'],2);
				//echo 'entre al sin descuento';
			}
			$_registro['stock'] = $_row['stock'];
			$_registro['tipoDescuento'] = $_row['tipoDescuento'];
			$_registro['valorDescuento'] = $_row['valorDescuento'];
			($_row['tipoDescuento'] == 1) ? $_registro['descuentoMostrar']=$_row['valorDescuento'].'%' : $_registro['descuentoMostrar']='$'.number_format($_row['valorDescuento'], 2);
 			$_registro['peso'] = $_row['peso'];
			$_registro['imgPortada'] = $_row['ruta'];
			$_registro['status'] = $_row['status'];
			$_registro['destacado'] = $_row['destacado'];
			$_registro['orden'] = $_row['orden'];
			//$_registro['categorias'] = $this -> listLabelCategorias($_row['idProducto']);
			$_registro['tallas'] = $this -> listTallasProducto(true, $_row['idProducto']);
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

	function listProductosDestacados($_lang = 'ES'){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT producto.*, datosProducto.*, galeria.ruta FROM producto, datosProducto, galeria WHERE datosProducto.idProducto = producto.idProducto AND producto.idProducto = galeria.idProducto AND datosProducto.lang = ? ".$_stat.$_bus." GROUP by producto.idProducto ORDER BY orden DESC";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		//echo $_SQL;
		$_MYSQL -> Execute($_SQL, array($_lang));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idProducto'] = $_row['idProducto'];
			$_registro['idEtiqueta'] = $_row['idEtiqueta'];
			$_registro['nombreEtiqueta'] = $this -> getNameEtiqueta($_row['idEtiqueta'], $_lang);
			$_registro['titulo'] = $_row['titulo'];
			$_registro['descripcion'] = $_row['descripcion'];
			$_registro['tags'] = $this -> _herramientas -> formatedTags($_row['tags'], true);
			$_registro['tagsAmigables'] = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			$_registro['precio'] = $_row['precio'];
			$_descxcat = $this -> calcularDescuentoxCategoria($_row['idCategoria'], $_row['precio'], $_row['aplicarDescuento']);
			if($_descxcat != 'sin descuento'){
				$_registro['aplicarDescuento'] = 1;
				$_registro['precioDescuento'] = number_format($_descxcat,2);
				//echo 'entre al descuento';
			}else if($_row['aplicarDescuento'] == 1){
				$_registro['aplicarDescuento'] = 1;
				if($_row['tipoDescuento'] == 1){
					$_tmpPrice = ($_row['precio'] * $_row['valorDescuento']) / 100;
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_tmpPrice, 2);
				}else{
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_row['valorDescuento'],2);
				}
				//echo 'entre al descuento por producto';
			}else{
				$_registro['aplicarDescuento'] = 0;
				$_registro['precioDescuento'] = number_format($_row['precio'],2);
				//echo 'entre al sin descuento';
			}
			$_registro['peso'] = $_row['peso'];
			$_registro['imgPortada'] = $_row['ruta'];
			$_registro['status'] = $_row['status'];
			$_registro['destacado'] = $_row['destacado'];
			$_registro['orden'] = $_row['orden'];
			$_registro['categorias'] = $this -> listLabelCategorias($_row['idProducto']);
			$_registro['tallas'] = $this -> listTallasProducto(true, $_row['idProducto']);
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

	function listProductosRelacionados($_lang = 'ES'){
		$_MYSQL = new MYSQL();

		$_tag = explode(',', $this -> _datosProducto -> _tags);

		$_SQL = "SELECT producto.*, datosProducto.*, galeria.ruta FROM producto, datosProducto, galeria WHERE datosProducto.idProducto = producto.idProducto AND producto.idProducto = galeria.idProducto AND galeria.tipo = 'portada' AND producto.status = 1 AND datosProducto.lang = ? AND producto.idProducto != ? AND datosProducto.tags LIKE '%".$_tag[0]."%' ORDER BY RAND() LIMIT 2";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}

		$_MYSQL -> Execute($_SQL, array($_lang, $this -> _idProducto));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idProducto'] = $_row['idProducto'];
			$_registro['idEtiqueta'] = $_row['idEtiqueta'];
			$_registro['nombreEtiqueta'] = $this -> getNameEtiqueta($_row['idEtiqueta'], $_lang);
			$_registro['titulo'] = $_row['titulo'];
			$_registro['descripcion'] = $_row['descripcion'];
			$_registro['tags'] = $this -> _herramientas -> formatedTags($_row['tags'], true);
			$_registro['tagsAmigables'] = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			$_registro['precio'] = $_row['precio'];
			$_descxcat = $this -> calcularDescuentoxCategoria($_row['idCategoria'], $_row['precio'], $_row['aplicarDescuento']);
			if($_descxcat != 'sin descuento'){
				$_registro['aplicarDescuento'] = 1;
				$_registro['precioDescuento'] = number_format($_descxcat,2);
				//echo 'entre al descuento';
			}else if($_row['aplicarDescuento'] == 1){
				$_registro['aplicarDescuento'] = 1;
				if($_row['tipoDescuento'] == 1){
					$_tmpPrice = ($_row['precio'] * $_row['valorDescuento']) / 100;
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_tmpPrice, 2);
				}else{
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_row['valorDescuento'],2);
				}
				//echo 'entre al descuento por producto';
			}else{
				$_registro['aplicarDescuento'] = 0;
				$_registro['precioDescuento'] = number_format($_row['precio'],2);
				//echo 'entre al sin descuento';
			}
			$_registro['peso'] = $_row['peso'];
			$_registro['imgPortada'] = $_row['ruta'];
			$_registro['status'] = $_row['status'];
			$_registro['destacado'] = $_row['destacado'];
			$_registro['orden'] = $_row['orden'];
			$_registro['categorias'] = $this -> listLabelCategorias($_row['idProducto']);
			$_registro['tallas'] = $this -> listTallasProducto(true, $_row['idProducto']);
			if($_paginador){
				$_registro['ultimapagina'] = $_ultimaPagina;
				$_registro['paginaanterior'] = $_pagina - 1;
				$_registro['paginasiguiente'] = $_pagina + 1;
				$_registro['pagina'] = $_pagina;
			}
			array_push($_resultados, $_registro);
		}

		$_SQL2 = "SELECT producto.*, datosProducto.*, galeria.ruta FROM producto, datosProducto, galeria WHERE datosProducto.idProducto = producto.idProducto AND producto.idProducto = galeria.idProducto AND galeria.tipo = 'portada' AND producto.status = 1 AND datosProducto.lang = ? AND producto.idProducto != ? AND producto.precio = ? ORDER BY RAND() LIMIT 1";

		$_MYSQL -> Execute($_SQL2, array($_lang, $this -> _idProducto, $this -> _precio));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idProducto'] = $_row['idProducto'];
			$_registro['idEtiqueta'] = $_row['idEtiqueta'];
			$_registro['nombreEtiqueta'] = $this -> getNameEtiqueta($_row['idEtiqueta'], $_lang);
			$_registro['titulo'] = $_row['titulo'];
			$_registro['descripcion'] = $_row['descripcion'];
			$_registro['tags'] = $this -> _herramientas -> formatedTags($_row['tags'], true);
			$_registro['tagsAmigables'] = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			$_registro['precio'] = $_row['precio'];
			$_descxcat = $this -> calcularDescuentoxCategoria($_row['idProducto'], $_row['precio'], $_row['aplicarDescuento']);
			if($_descxcat != 'sin descuento'){
				$_registro['aplicarDescuento'] = 1;
				$_registro['precioDescuento'] = number_format($_descxcat,2);
				//echo 'entre al descuento';
			}else if($_row['aplicarDescuento'] == 1){
				$_registro['aplicarDescuento'] = 1;
				if($_row['tipoDescuento'] == 1){
					$_tmpPrice = ($_row['precio'] * $_row['valorDescuento']) / 100;
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_tmpPrice, 2);
				}else{
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_row['valorDescuento'],2);
				}
				//echo 'entre al descuento por producto';
			}else{
				$_registro['aplicarDescuento'] = 0;
				$_registro['precioDescuento'] = number_format($_row['precio'],2);
				//echo 'entre al sin descuento';
			}
			$_registro['peso'] = $_row['peso'];
			$_registro['imgPortada'] = $_row['ruta'];
			$_registro['status'] = $_row['status'];
			$_registro['destacado'] = $_row['destacado'];
			$_registro['orden'] = $_row['orden'];
			$_registro['categorias'] = $this -> listLabelCategorias($_row['idProducto']);
			$_registro['tallas'] = $this -> listTallasProducto(true, $_row['idProducto']);
			if($_paginador){
				$_registro['ultimapagina'] = $_ultimaPagina;
				$_registro['paginaanterior'] = $_pagina - 1;
				$_registro['paginasiguiente'] = $_pagina + 1;
				$_registro['pagina'] = $_pagina;
			}
			if(!$this -> in_array_r($_row['idProducto'], $_resultados)){
				array_push($_resultados, $_registro);
			}

		}

		$_idCategoria = $this -> listLabelCategorias($this -> _idProducto, false, $_lang);

		$_SQL3 = "SELECT producto.*, datosProducto.*, productoxcategoria.idCategoria, galeria.ruta FROM producto, datosProducto, productoxcategoria, galeria WHERE producto.idProducto = productoxcategoria.idProducto AND datosProducto.idProducto = producto.idProducto AND producto.idProducto = galeria.idProducto AND galeria.tipo = 'portada'  AND productoxcategoria.idCategoria = ? AND datosProducto.lang = ? AND producto.idProducto != ? AND producto.status = 1  ORDER BY RAND() LIMIT 1";

		$_MYSQL -> Execute($_SQL3, array($_idCategoria[0]['idCategoria'], $_lang, $this -> _idProducto));
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idProducto'] = $_row['idProducto'];
			$_registro['idEtiqueta'] = $_row['idEtiqueta'];
			$_registro['nombreEtiqueta'] = $this -> getNameEtiqueta($_row['idEtiqueta'], $_lang);
			$_registro['titulo'] = $_row['titulo'];
			$_registro['descripcion'] = $_row['descripcion'];
			$_registro['tags'] = $this -> _herramientas -> formatedTags($_row['tags'], true);
			$_registro['tagsAmigables'] = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			$_registro['precio'] = $_row['precio'];
			$_descxcat = $this -> calcularDescuentoxCategoria($_row['idProducto'], $_row['precio'], $_row['aplicarDescuento']);
			if($_descxcat != 'sin descuento'){
				$_registro['aplicarDescuento'] = 1;
				$_registro['precioDescuento'] = number_format($_descxcat,2);
				//echo 'entre al descuento';
			}else if($_row['aplicarDescuento'] == 1){
				$_registro['aplicarDescuento'] = 1;
				if($_row['tipoDescuento'] == 1){
					$_tmpPrice = ($_row['precio'] * $_row['valorDescuento']) / 100;
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_tmpPrice, 2);
				}else{
					$_registro['precioDescuento'] = number_format($_row['precio'] - $_row['valorDescuento'],2);
				}
				//echo 'entre al descuento por producto';
			}else{
				$_registro['aplicarDescuento'] = 0;
				$_registro['precioDescuento'] = number_format($_row['precio'],2);
				//echo 'entre al sin descuento';
			}
			$_registro['peso'] = $_row['peso'];
			$_registro['imgPortada'] = $_row['ruta'];
			$_registro['status'] = $_row['status'];
			$_registro['destacado'] = $_row['destacado'];
			$_registro['orden'] = $_row['orden'];
			$_registro['categorias'] = $this -> listLabelCategorias($_row['idProducto']);
			$_registro['tallas'] = $this -> listTallasProducto(true, $_row['idProducto']);
			if($_paginador){
				$_registro['ultimapagina'] = $_ultimaPagina;
				$_registro['paginaanterior'] = $_pagina - 1;
				$_registro['paginasiguiente'] = $_pagina + 1;
				$_registro['pagina'] = $_pagina;
			}
			if(!$this -> in_array_r($_row['idProducto'], $_resultados)){
				array_push($_resultados, $_registro);
			}

		}
		return $_resultados;
	}
	//Faltante Correos, faltante metodo que lista combinaciones fuera de stock
	//Hacer una vista en el panel donde se listen las combinaciones fuera de stock
	//y en el correo solo poner el link para que lleve a esa vista
	/*SELECT talla.idTalla, talla.nombre as tallaNombre, color.idColor, color.nombre as colorNombre, color.color, color.tipo, color.imagen, galeria.idGaleria, galeria.ruta, combinacion.stock, combinacion.idCombinacion
			FROM valoresxcombinacion, talla, color, galeria, producto, combinacion
			WHERE valoresxcombinacion.idTalla = talla.idTalla AND talla.status = 1 AND valoresxcombinacion.idColor = color.idColor AND color.status = 1 AND valoresxcombinacion.idGaleria = galeria.idGaleria AND valoresxcombinacion.idCombinacion = combinacion.idCombinacion AND valoresxcombinacion.idProducto = 17 AND combinacion.stock <= 0 GROUP BY combinacion.idCombinacion*/
	function listProductoOutStock(){
		$_productos = $this -> listProducto(1, false);
		$_response = array();
		foreach($_productos as $_prod) {
			$_registro['titulo'] = $_prod['titulo'];
			$_combs = $this -> listCombOutStock($_prod['idProducto']);
			if(count($_combs) > 0){
				foreach ($_combs as $row) {
					$_registro['idCombinacion'] = $row['idCombinacion'];
					$_registro['idTalla'] = $row['idTalla'];
					$_registro['talla'] = $row['talla'];
					$_registro['idColor'] = $row['idColor'];
					$_registro['colorNombre'] = $row['colorNombre'];
					$_registro['color'] = $row['color'];
					$_registro['tipo'] = $row['tipo'];
					$_registro['imagen'] = $row['imagen'];
					$_registro['idGaleria'] = $row['idGaleria'];
					$_registro['ruta'] = $row['ruta'];
					$_registro['stock'] = $row['stock'];
					array_push($_response, $_registro);
				}
			}
		}
		return $_response;
	}

	function listCombOutStock($_idProducto = 0){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT talla.idTalla, talla.nombre as tallaNombre, color.idColor, color.nombre as colorNombre, color.color, color.tipo, color.imagen, galeria.idGaleria, galeria.ruta, combinacion.stock, combinacion.idCombinacion
				 FROM valoresxcombinacion, talla, color, galeria, producto, combinacion
				 WHERE valoresxcombinacion.idTalla = talla.idTalla AND talla.status = ?
				 AND valoresxcombinacion.idColor = color.idColor AND color.status = ?
				 AND valoresxcombinacion.idGaleria = galeria.idGaleria
				 AND valoresxcombinacion.idCombinacion = combinacion.idCombinacion
				 AND valoresxcombinacion.idProducto = ?
				 AND combinacion.stock <= ? GROUP BY combinacion.idCombinacion";
		/*echo '<pre>SELECT talla.idTalla, talla.nombre as tallaNombre, color.idColor, color.nombre as colorNombre, color.color, color.tipo, color.imagen, galeria.idGaleria, galeria.ruta, combinacion.stock, combinacion.idCombinacion
				 FROM valoresxcombinacion, talla, color, galeria, producto, combinacion
				 WHERE valoresxcombinacion.idTalla = talla.idTalla AND talla.status = 1
				 AND valoresxcombinacion.idColor = color.idColor AND color.status = 1
				 AND valoresxcombinacion.idGaleria = galeria.idGaleria
				 AND valoresxcombinacion.idCombinacion = combinacion.idCombinacion
				 AND valoresxcombinacion.idProducto = '.$_idProducto.'
				 AND combinacion.stock <= 0 GROUP BY combinacion.idCombinacion</pre>';*/
		$_VALUES = array(1, 1, $_idProducto, 0);
		$_CONECTADO = $_MYSQL -> Connect();
		$_RESPONSE = array();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
		while ($row = $_MYSQL -> fetchrow()) {
			$_registro['idCombinacion'] = $row['idCombinacion'];
			$_registro['idTalla'] = $row['idTalla'];
			$_registro['talla'] = $row['tallaNombre'];
			$_registro['idColor'] = $row['idColor'];
			$_registro['colorNombre'] = $row['colorNombre'];
			$_registro['color'] = $row['color'];
			$_registro['tipo'] = $row['tipo'];
			$_registro['imagen'] = $row['imagen'];
			$_registro['idGaleria'] = $row['idGaleria'];
			$_registro['ruta'] = $row['ruta'];
			$_registro['stock'] = $row['stock'];
			array_push($_RESPONSE, $_registro);
		}
		return $_RESPONSE;
	}

	function in_array_r($needle, $haystack, $strict = false) {
	    foreach ($haystack as $item) {
	        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this -> in_array_r($needle, $item, $strict))) {
	            return true;
	        }
	    }

	    return false;
	}

	function getNameCategoria($_idCategoria){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT tituloEs, urlAmigable FROM categoria WHERE idCategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_idCategoria));
		$obj = $_MYSQL -> fetchobject();
		return $obj;

	}

	function getNameSubCategoria($_idSubcategoria){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT nombre, urlAmigable FROM subcategoria WHERE idSubcategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_idSubcategoria));
		$obj = $_MYSQL -> fetchobject();
		return $obj;

	}

	function getNameEtiqueta($_idEtiqueta = 0, $_lang = 'ES'){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT tituloEs, tituloEn FROM etiqueta WHERE idEtiqueta = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_idEtiqueta));
		$obj = $_MYSQL -> fetchobject();
		($_lang == 'ES') ? $_titulo = $obj -> tituloEs : $_titulo = $obj -> tituloEn;
		return $_titulo;
	}


/* ===================================
 * MAESTRO DETALLE _GALERIA
 * =================================== */
	function agregarGaleria($_imagen, $_tipo, $_tmp){
		$galeria = new galeria(0, $this -> _idProducto, $_tipo, $_imagen, $_tmp);
		$galeria -> addGaleria();
	}

	function modificarGaleria($_idGaleria, $_imagen, $_tmp){
		$galeria = new galeria($_idGaleria, '', '', $_imagen, $_tmp);
		$galeria -> updateGaleria();
	}

	function eliminarGaleria($_idGaleria){
		$galeria = new galeria($_idGaleria);
		$galeria -> deleteGaleria();
	}

	function modificarOrdenGaleria($_idGaleria, $_orden){
		$galeria = new galeria($_idGaleria);
		$galeria -> updateOrdenGaleria($_orden);
	}

	function getPortadaGaleria(){
		$galeria = new galeria(0, $this -> _idProducto);
		$galeria  -> getGaleriaPortada();
		$this -> _imgPortada = $galeria -> _ruta;
		$this -> _idPortada = $galeria -> _idGaleria;
	}

	function getFondoGaleria(){
		$galeria = new galeria(0, $this -> _idProducto);
		$galeria  -> getGaleriaFondo();
		$this -> _imgFondo = $galeria -> _ruta;
		$this -> _idFondo = $galeria -> _idGaleria;
	}

	function listarGaleria($_tipo = 'secundaria'){
		$galeria = new galeria(0, $this -> _idProducto);
		$this -> _galeria = $galeria -> listGaleria($_tipo);
	}
/* ===================================
 * N:N _PORTAFOLIOXCATEGORIA
 * =================================== */
	function listLabelCategorias($_idProducto = 0, $_labels = true, $_lang = 'ES'){
		$productoxcategoria = new productoxcategoria($_idProducto);
		$productoxcategoria -> listNombreCategoriaxProducto();
		if($_labels){
			$_label = '';
			foreach ($productoxcategoria -> _categorias as $_c) {
				$_label .= '<span class="label label-primary">'.$_c['titulo'].'</span>  ';
			}
			return $_label;
		}else{
			return $productoxcategoria -> _categorias;
		}

	}

	function agregarCategoriaxProducto($_idCategoria){
		$productoxcategoria = new productoxcategoria($this -> _idProducto, $_idCategoria);
		$productoxcategoria -> addProductoxCategoria();
	}

	function removerCategoriaxProducto(){
		$productoxcategoria = new productoxcategoria($this -> _idProducto);
		$productoxcategoria -> removeProductoxCategoria();
	}

	function existeCategoriaxProducto($_idCategoria){
		$productoxcategoria = new productoxcategoria($this -> _idProducto, $_idCategoria);
		$_response = $productoxcategoria -> existProductoxCategoria();
		return $_response;
	}
/* ===================================
 * 1:1 _DATOS_PRODUCTO
 * =================================== */
	function agregarDatosProducto($_titulo = '', $_descripcion = '', $_tags = '' , $_lang =''){
		$datosProducto = new datosProducto($this -> _idProducto, $_titulo, $_descripcion, $_tags, $_lang);
		$datosProducto -> addDatosProducto();
	}
	function modificarDatosProducto($_titulo = '',  $_descripcion = '', $_tags = '', $_lang = ''){
		$_datosProducto = new datosProducto($this -> _idProducto, $_titulo, $_descripcion, $_tags, $_lang);
		$_datosProducto -> updateDatosProducto();
	}

	function eliminarDatosProducto(){
		$_datosProducto = new datosProducto($this -> _idProducto);
		$_datosProducto -> deleteDatosProducto();
	}

	function obtenerDatosProducto($_lang){
		$this -> _datosProducto = new datosProducto($this -> _idProducto);
		$this -> _datosProducto -> _lang = $_lang;
		$this -> _datosProducto -> getDatosProducto();
	}

	function listarDatosProducto($_lang){
		$_datosProducto = new datosProducto($this -> _idProducto);
		$_datosProducto -> _lang = $_lang;
		$_resultado = $_datosProducto -> listDatosProducto();
		return $_resultado;
	}

/* ===================================
 * 1:N _COMBINACION
 * =================================== */
	function listarCombinaciones(){
		$combinacion = new combinacion(0, $this -> _idProducto);
		$this -> _combinaciones = $combinacion -> _listNombreValorxProducto();
	}

	function getCombinacion($_idCombinacion = 0){
		$valoresxcombinacion = new valoresxcombinacion($_idCombinacion);
		$valoresxcombinacion -> listNombreValoresxCombinacion();
		return $valoresxcombinacion -> combinaciones;
	}

	function validarStockCombinacion($_idCombinacion = 0, $_cantidad = 0){
		$combinacion = new combinacion($_idCombinacion);
		return $combinacion -> validarStock($_cantidad);
	}

	function validarCombinacion($_idProducto){
		$combinacion = new combinacion(0, $_idProducto);
		$_valid = $combinacion -> existCombinacion();
		return $_valid;
	}

/* ===================================
 * N:N VALORES X PRODUCTO
 * =================================== */
	function listTallasProducto($_frontEnd = false, $_idProducto = 0){
		$valoresxcombinacion = new valoresxcombinacion(0, $_idProducto);
		$valoresxcombinacion -> listTallasxProducto();
		if($_frontEnd){
			$_total = count($valoresxcombinacion -> tallas);
			$_c = 1;
			foreach ($valoresxcombinacion -> tallas as $_talla) {
				($_total == $_c OR $_c == 4) ? $_signo = '' :  $_signo = ', ';
				if($_c < 5)
					$_tallas .= $_talla['nombreTalla'].$_signo;
				$_c++;
			}
			return $_tallas;
		}else{
			return $valoresxcombinacion -> tallas;
		}
	}

	function coloresxtalla($_idTalla){
		//$idCombinacion = 0, $idProducto = 0, $idTalla = 0, $idColor = 0, $idGaleria = 0
		$valoresxcombinacion = new valoresxcombinacion(0, $this -> _idProducto, $_idTalla);
		$valoresxcombinacion -> listColorxTalla();
		$color = array();
		if(isset($valoresxcombinacion -> colores)){
			foreach ($valoresxcombinacion -> colores as $_color) {
				$registro['idCombinacion'] = $_color['idCombinacion'];
				$registro['idProducto'] = $_color['idProducto'];
				$registro['idTalla'] = $_color['idTalla'];
				$registro['idColor'] = $_color['idColor'];
				$registro['_color'] = $_color['_color'];
				$registro['tipo'] = $_color['tipo'];
				$registro['imagen'] = $_color['imagen'];
				$registro['idGaleria'] = $_color['idGaleria'];
				$registro['ruta'] = $_color['ruta'];
				$registro['stock'] = $_color['stock'];
				$registro['galeriaxcolor'] = $this -> galeriaxcolor($_color['idCombinacion']);
				array_push($color, $registro);

			}
		}
		return $color;
	}

	function galeriaxcolor($_idCombinacion){
		$valoresxcombinacion = new valoresxcombinacion();
		$galeria = $valoresxcombinacion -> listarGaleriaxCombinacion($_idCombinacion);
		return $galeria;
	}

	function listarTallasxProductoConColores(){
		$_tallas = $this -> listTallasProducto(false, $this -> _idProducto);
		//print_r($_tallas);
		if(isset($_tallas)){
			$_talla = array();
			foreach ($_tallas as $_t) {
				$_registro['nombreTalla'] = $_t['nombreTalla'];
				$_registro['colores'] = $this -> coloresxtalla($_t['idTalla']);
				array_push($_talla, $_registro);
			}
		}
		return $_talla;
	}

	function calcularDescuentoxCategoria($_idCategoria = 0, $_precio = 0, $_aplicarDescuento = 0){
		$descuento = new descuento(0, $_idCategoria);
		if($descuento -> existeDescuento($_idCategoria, true)){
			//echo '<code>Existe Descuento para esta categoria</code>';
			$descuento -> getDescuentoxCategoria();
			if($descuento -> prioridad == 1){
				//echo '<code>Aplica sobre otras promociones</code>';
 				if($descuento -> tipoDescuento == 1){
			 		$_tmpPrice = ($_precio * $descuento -> precioDescuento) / 100;
			 		$_precio = $_precio - $_tmpPrice;
			 	}else{
			 		$_precio = $_precio - $descuento -> precioDescuento;
			 	}
	 		}else if($_aplicarDescuento == 0){
	 			//echo '<code>El producto no tiene descuento propio</code>';
	 			if($descuento -> tipoDescuento == 1){
			 		$_tmpPrice = ($_precio * $descuento -> precioDescuento) / 100;
			 		$_precio = $_precio - $_tmpPrice;
			 	}else{
			 		$_precio = $_precio - $descuento -> precioDescuento;
			 	}
	 		}else{
	 			//echo '<code>El producto si tiene descuento propio</code>';
	 			$_precio = 'sin descuento';
	 		}
		}else{
			//echo '<code>No hay descuento para esta categoria</code>';
			$_precio = 'sin descuento';
		}
		//echo '<code>Precio '.$_precio.'</code>';
		return $_precio;
	}

	//ingredientes x producto
	function agregarIngredientesxProductos($idIngrediente){
		$ingredientexproducto = new ingredientexproducto($this -> _idProducto, $idIngrediente);
		$ingredientexproducto -> asigna_ingredientexproducto();
	}
	function eliminarIngredientesxProductos(){
		$delingredientexproducto = new ingredientexproducto($this -> _idProducto);
		$delingredientexproducto -> desasignar_productoxingrediente();

	}

	//consideraciones x producto
	function agregarConsideracionesxProductos($idConsideracion){
		$consideracionxproducto = new consideracionxproducto($this -> _idProducto, $idConsideracion);
		$consideracionxproducto -> asigna_consideracionxproducto();
	}
	function eliminarConsideracionesxProductos(){
		$delconsideracionxproducto = new consideracionxproducto($this -> _idProducto);
		$delconsideracionxproducto -> desasignar_productoxconsideracion();

	}

/* ===================================
 * N:N VALORES X PRODUCTO
 * ===================================
 	function calcularDescuentoxCategoria($_idProducto = 0, $_precio = 0, $_aplicarDescuento = 0){
 		$_categoriasxproducto = $this -> listLabelCategorias($_idProducto, false);
 		$_descuentosFinalesCP = array();
 		$_descuentosFinalesSP = array();
 		$_contadorP = 0;
 		$_contadorSP = 0;
 		$_idDescuento = 0;
 		foreach($_categoriasxproducto as $_cxp){
 			$descuento = new descuento(0, $_cxp['idCategoria']);
 			if($descuento -> existeDescuento($_cxp['idCategoria'], true)){
 				$descuento -> getDescuentoxCategoria();
 				if($descuento -> prioridad == 1){
 					$_contadorP ++;
 					array_push($_descuentosFinalesCP, $descuento -> idDescuento);
 					//echo 'entre a descuento con prioridad';
	 			}else{
	 				$_contadorSP ++;
	 				array_push($_descuentosFinalesSP, $descuento -> idDescuento);
	 				//echo 'entre a descuento sin prioridad';
	 			}
 			}
 		}

 		if($_contadorP > 1){
 			$_idDescuento = max($_descuentosFinalesCP);
 			$descuento -> idDescuento = $_idDescuento;
		 	$descuento -> getDescuento();
		 	if($descuento -> tipoDescuento == 1){
		 		$_tmpPrice = ($_precio * $descuento -> precioDescuento) / 100;
		 		$_precio = $_precio - $_tmpPrice;
		 	}else{
		 		$_precio = $_precio - $descuento -> precioDescuento;
		 	}
		 	//echo 'entre contadorP muchos <br>';
	 	}else if($_contadorP == 1){
	 		$_idDescuento = $_descuentosFinalesCP[0];
	 		$descuento -> idDescuento = $_idDescuento;
		 	$descuento -> getDescuento();
		 	if($descuento -> tipoDescuento == 1){
		 		$_tmpPrice = ($_precio * $descuento -> precioDescuento) / 100;
		 		$_precio = $_precio - $_tmpPrice;
		 	}else{
		 		$_precio = $_precio - $descuento -> precioDescuento;
		 	}
		 	//echo 'entre contadorP unico <br>';
	 	}else if($_contadorSP > 1){
	 		$_idDescuento = max($_descuentosFinalesSP);
	 		if($_aplicarDescuento == 0){
	 			$descuento -> idDescuento = $_idDescuento;
			 	$descuento -> getDescuento();
			 	if($descuento -> tipoDescuento == 1){
			 		$_tmpPrice = ($_precio * $descuento -> precioDescuento) / 100;
			 		$_precio = $_precio - $_tmpPrice;
			 	}else{
			 		$_precio = $_precio - $descuento -> precioDescuento;
			 	}
	 		}else{
	 			$_precio = 'sin descuento';
	 		}
	 		//echo 'entre contadorSP muchos <br>';
	 	}else if($_contadorSP == 1){
	 		$_idDescuento = $_descuentosFinalesSP[0];
	 		if($_aplicarDescuento == 0){
	 			$descuento -> idDescuento = $_idDescuento;
			 	$descuento -> getDescuento();
			 	if($descuento -> tipoDescuento == 1){
			 		$_tmpPrice = ($_precio * $descuento -> precioDescuento) / 100;
			 		$_precio = $_precio - $_tmpPrice;
			 	}else{
			 		$_precio = $_precio - $descuento -> precioDescuento;
			 	}
	 		}else{
	 			$_precio = 'sin descuento';
	 		}
	 		//echo 'entre contadorSP unico idDescuento'.$_idDescuento.' <br>';
	 	}else{
	 		$_precio = 'sin descuento';
	 	}
	 	//echo 'aqui esta el precio'.$_precio;
	 	return $_precio;
 	}	*/
}
?>
