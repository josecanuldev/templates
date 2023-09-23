<?php
require_once('MYSQL.php');
require_once('archivo.php');
require_once('datosBlog.php');
require_once('contenidoBlog.php');
require_once('herramientas.php');

class blog extends Archivo {
	var $_idBlog;
	var $_idCategoria;
	var $_idSubcategoria;
	var $_tituloCategoria;
	var $_portada;
	var $idioma;

	var $_fechaOriginal;
	var $_fechaCreacion;
	var $_fechaModificacion;
	var $_status;
	var $descripcionCorta;
	var $subtitulo;

	var $_contenidoBlog;
	var $_datosBlog;
	var $_directorio = '../img/imgBlog/';

	var $_herramientas;
	var $_orden;

	var $_idContenidoBlog;

	/*Variables para el paginador*/
	var $_totalRegistros;
	var $_registrosPorPagina;
	// var $_paginaActual;

	function __construct($_idBlog = 0, $_idCategoria = 0, $_idSubcategoria= 0, $_portada = '', $tmp = '', $idioma = '', $descripcionCorta = '', $subtitulo = '') {
		$this -> _idBlog      = $_idBlog;
		$this -> _idCategoria = $_idCategoria;
		$this -> idioma = $idioma;
		$this -> descripcionCorta = $descripcionCorta;
		$this -> subtitulo = $subtitulo;
		$this -> _idSubcategoria = $_idSubcategoria;
		($_portada != '') ? $this -> _portada = $this -> obtenerExtensionArchivo($_portada) :  $this -> _portada = '';

		$this -> _contenidoBlog      = array();

		$this -> ruta_final          = $this -> _directorio;
		$this -> ruta_temporal       = $tmp;

		$this -> _totalRegistros     = 0;
		$this -> _registrosPorPagina = 10;
		// $this -> _paginaActual       = 1;

		$this -> _herramientas       = new herramientas();

	}

	function addBlog(){
		if($this -> subir_archivo_imagen($this -> _portada)){
			$this -> _fechaCreacion = date('Y-m-d');
			$_MYSQL = new MYSQL();
			$_SQL = "INSERT INTO blog(idCategoria, fechaCreacion, portada, status, idioma, descripcionCorta, subtitulo)VALUES(?,?,?,?,?,?,?)";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			if($_MYSQL -> Execute($_SQL, array($this -> _idCategoria, $this -> _fechaCreacion, $this -> _portada, 1, $this -> idioma, $this -> descripcionCorta,$this -> subtitulo))){
				$this -> _idBlog = $_MYSQL -> conexion -> lastInsertId();
				$_O = "UPDATE blog SET orden = ? WHERE idBlog = ?";
				$_MYSQL -> Execute($_O, array($this -> _idBlog, $this -> _idBlog));
				$_success = 2;
			}else{
				$this -> _idBlog = 0;
				$_success = 1;
			}
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateBlog(){
		$_MYSQL = new MYSQL();
		if($this -> _portada != ''){
			$this -> getImgPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _portada)){
				$_IMG = "UPDATE blog SET portada = ? WHERE idBlog = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_IMG, array($this -> _portada, $this -> _idBlog));
			}
		}
		$this -> _fechaModificacion = date('Y-m-d');
		$_SQL = "UPDATE blog SET idCategoria = ?, fechaModificacion = ?, descripcionCorta = ?, subtitulo = ?, idioma = ? WHERE idBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_MYSQL -> Execute($_SQL, array($this -> _idCategoria, $this -> _fechaModificacion, $this -> descripcionCorta, $this -> subtitulo, $this -> idioma, $this -> _idBlog))){
			$_success = 2;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function deleteBlog(){
		$this -> getImgPortada();
		$this -> borrar_archivo();

		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM blog WHERE idBlog = ?";
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

	function updateStatusBlog($_status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE blog SET status = ? WHERE idBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_status, $this -> _idBlog));
	}

	function updateOrdenBlog($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE blog SET orden = ? WHERE idBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idBlog));
	}


	function getImgPortada(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT portada FROM blog WHERE idBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idBlog));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$obj -> portada;
	}

	function getBlog($_lang = 'ES'){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM blog WHERE idBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idBlog));
		$obj = $_MYSQL -> fetchobject();

		$this -> _idBlog          = $obj -> idBlog;
		$this -> _idCategoria     = $obj -> idCategoria;
		$this -> _idSubcategoria  = $obj -> idSubcategoria;
		$this -> descripcionCorta  = htmlspecialchars_decode($obj -> descripcionCorta);
		$this -> subtitulo  = htmlspecialchars_decode($obj -> subtitulo);
		$this -> _tituloCategoria = $this -> getNameCategoria($obj -> idCategoria, $_lang);
		$this -> _portada         = $obj -> portada;
		$this -> _fechaOriginal   = $obj -> fechaCreacion;
		$this -> _fechaCreacion   = $this -> _herramientas ->  getFormatedDateF($obj -> fechaCreacion);
		$this -> _fechaCreacionI   = $this -> _herramientas ->  getFormatedDateFE($obj -> fechaCreacion);
		$this -> _fechaCreacionEng   = $this -> _herramientas ->  getFormatedDateFI($obj -> fechaCreacion);
		$this -> idioma           = $obj -> idioma;
		$this -> listarContenidoBlog();
	}

	function listBlog($_pagina = 1, $_paginador = true, $_idCategoria = '', $_status = '', $_busqueda = '', $_tags = '', $_registrosPorPagina = 20, $_frontEnd = true, $_lang = 'ES',$idioma=0){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (datosBlog.titulo LIKE '%".$_busqueda."%' OR blog.descripcionCorta LIKE '%".$_busqueda."%')" : $_bus = '';
		($_idCategoria != '') ? $_cat = " AND blog.idCategoria = ".$_idCategoria." " : $_cat = "";
		($_tags != '') ? $_tag = " AND (datosBlog.tagsAmigables LIKE '%".$_tags."%' or datosBlog.tags LIKE '%".$_tags."%')" : $_tag = '';
		($idioma != '') ? $idio = " AND blog.idioma = ".$idioma." " : $idio = "";


		$_MYSQL = new MYSQL();
		$_TOTAL = "SELECT blog.idBlog, count(blog.idBlog) as totalRegistros FROM blog, datosBlog WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ? ".$_cat.$_bus.$_tag.$_stat." ORDER BY orden DESC";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		if($_paginador){
			$_MYSQL -> Execute($_TOTAL, array($_lang));
			$obj = $_MYSQL -> fetchobject();
			$this -> _totalRegistros = $obj -> totalRegistros;
			$this -> _registrosPorPagina = $_registrosPorPagina;
			// $this -> _paginaActual = $_pagina;
			$_ultimaPagina = ceil($this -> _totalRegistros / $this -> _registrosPorPagina);
			$_paginaActual = $_pagina;
			$_paginacion   = ' LIMIT '.($_pagina - 1) * $this -> _registrosPorPagina.','.$this -> _registrosPorPagina;
		}else{
			$_paginacion = '';
		}
		// echo "SELECT blog.idBlog, blog.idCategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, (SELECT CB.descripcion FROM contenidoBlog CB WHERE CB.idBlog = blog.idBlog AND CB.tipo = 1 LIMIT 1) AS descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable FROM blog, datosBlog WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = '{$_lang}' ".$_cat.$_bus.$_tag.$_stat." ORDER BY orden DESC ".$_paginacion;
		$_SQL = "SELECT blog.idBlog, blog.idCategoria, blog.idioma, blog.descripcionCorta, blog.subtitulo as subtituloBlog, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable FROM blog, datosBlog WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ? ".$_cat.$_bus.$_tag.$_stat.$idio." ORDER BY orden DESC ".$_paginacion;
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']	= $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['subtituloBlog']         = $_row['subtituloBlog'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcionCorta']), 100);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], $_frontEnd);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaOriginal']     = $_row['fechaCreacion'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaCreacionFormato']     = $this -> _herramientas -> getFormatedDateFE($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];
			$_registro['idioma']            = $_row['idioma'];
			if($_paginador){
				$_registro['ultimapagina']    = $_ultimaPagina;
				$_registro['paginaanterior']  = $_pagina - 1;
				$_registro['paginasiguiente'] = $_pagina + 1;
				$_registro['pagina']          = $_pagina;
			}
			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listBlogPrev($_lang = 'ES',$idioma=0,$idBlog=0,$idCategoria=0){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable FROM blog, datosBlog WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ?  AND blog.status = ? AND blog.idioma = ? AND blog.idBlog < ? AND blog.idCategoria = ? ORDER BY blog.orden DESC LIMIT 0, 1";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang, 1, $idioma, $idBlog, $idCategoria));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']    = $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaCreacionFormato']     = $this -> _herramientas -> getFormatedDateFE($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['fecha']             = $_row['fechaCreacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listBlogNext($_lang = 'ES',$idioma=0,$idBlog=0,$idCategoria=0){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable FROM blog, datosBlog WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ?  AND blog.status = ? AND blog.idioma = ? AND blog.idBlog > ? AND blog.idCategoria = ? ORDER BY blog.orden DESC LIMIT 0, 1";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang, 1, $idioma, $idBlog, $idCategoria));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']    = $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['fecha']             = $_row['fechaCreacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listRecentBlog($_lang = 'ES',$idioma=0){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo as subtituloBlog, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable FROM blog, datosBlog WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ?  AND blog.status = ? AND blog.idioma = ? ORDER BY fechaCreacion DESC LIMIT 0, 3";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang, 1, $idioma));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']    = $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['subtituloBlog']         = $_row['subtituloBlog'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaCreacionFormato']     = $this -> _herramientas -> getFormatedDateFE($_row['fechaCreacion']);
			$_registro['fechaCreacionFormatoI']     = $this -> _herramientas -> getFormatedDateFI($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['fecha']             = $_row['fechaCreacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listPopularBlog($_lang = 'ES',$idioma=0){
		$_MYSQL = new MYSQL();
		// $_SQL = "SELECT DISTINCT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo as subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, (SELECT COUNT(*) FROM visitas
        // WHERE blog.idBlog = visitas.idBlog) AS visitas FROM blog, datosBlog, visitas WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ?  AND blog.status = ? AND blog.idioma = ? ORDER BY visitas DESC LIMIT 0, 3";
        $_SQL ="SELECT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo as subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, COUNT(visitas.idBlog) AS visitas
			FROM
			    blog
			JOIN
			    datosBlog ON blog.idBlog = datosBlog.idBlog
			LEFT JOIN
			    visitas ON blog.idBlog = visitas.idBlog
			WHERE
			    datosBlog.lang = ? 
			    AND blog.status = ? 
			    AND blog.idioma = ? 
			GROUP BY
			    blog.idBlog
			ORDER BY
			    visitas DESC LIMIT 0, 3;";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang, 1, $idioma));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']    = $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['visitas']         = $_row['visitas'];
			$_registro['subtituloBlog']         = $_row['subtituloBlog'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['descripcionCorta']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcionCorta']), 191);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaCreacionFormato']     = $this -> _herramientas -> getFormatedDateFE($_row['fechaCreacion']);
			$_registro['fechaCreacionFormatoI']     = $this -> _herramientas -> getFormatedDateFI($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['fecha']             = $_row['fechaCreacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listPopularBlogRecientes($_lang = 'ES',$idioma=0){
		$_MYSQL = new MYSQL();
		// $_SQL = "SELECT DISTINCT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo as subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, (SELECT COUNT(*) FROM visitas
        // WHERE blog.idBlog = visitas.idBlog) AS visitas FROM blog, datosBlog, visitas WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ?  AND blog.status = ? AND blog.idioma = ? ORDER BY blog.orden DESC";
        $_SQL = "SELECT
    		blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo as subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, COUNT(visitas.idBlog) AS visitas
		FROM
		    blog
		JOIN
		    datosBlog ON blog.idBlog = datosBlog.idBlog
		LEFT JOIN
		    visitas ON blog.idBlog = visitas.idBlog
		WHERE
		    datosBlog.lang = ? 
		    AND blog.status = ? 
		    AND blog.idioma = ? 
		GROUP BY blog.idBlog ORDER BY blog.orden DESC;";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang, 1, $idioma));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']    = $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['visitas']         = $_row['visitas'];
			$_registro['subtituloBlog']         = $_row['subtituloBlog'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['descripcionCorta']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcionCorta']), 191);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaCreacionFormato']     = $this -> _herramientas -> getFormatedDateFE($_row['fechaCreacion']);
			$_registro['fechaCreacionFormatoI']     = $this -> _herramientas -> getFormatedDateFI($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['fecha']             = $_row['fechaCreacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listPopularBlogPopulares($_lang = 'ES',$idioma=0){
		$_MYSQL = new MYSQL();
		// $_SQL = "SELECT DISTINCT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo as subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, (SELECT COUNT(*) FROM visitas
        // WHERE blog.idBlog = visitas.idBlog) AS visitas FROM blog, datosBlog, visitas WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ?  AND blog.status = ? AND blog.idioma = ? ORDER BY visitas DESC";
        $_SQL ="SELECT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo as subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, COUNT(visitas.idBlog) AS visitas
			FROM
			    blog
			JOIN
			    datosBlog ON blog.idBlog = datosBlog.idBlog
			LEFT JOIN
			    visitas ON blog.idBlog = visitas.idBlog
			WHERE
			    datosBlog.lang = ? 
			    AND blog.status = ? 
			    AND blog.idioma = ? 
			GROUP BY
			    blog.idBlog
			ORDER BY
			    visitas DESC;";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang, 1, $idioma));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']    = $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['visitas']         = $_row['visitas'];
			$_registro['subtituloBlog']         = $_row['subtituloBlog'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['descripcionCorta']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcionCorta']), 191);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaCreacionFormato']     = $this -> _herramientas -> getFormatedDateFE($_row['fechaCreacion']);
			$_registro['fechaCreacionFormatoI']     = $this -> _herramientas -> getFormatedDateFI($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['fecha']             = $_row['fechaCreacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listBlogCategoria($_lang = 'ES',$idioma=0,$idCategoria=0){
		$_MYSQL = new MYSQL();
		// $_SQL = "SELECT DISTINCT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo as subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, (SELECT COUNT(*) FROM visitas
        // WHERE blog.idBlog = visitas.idBlog) AS visitas, (SELECT COUNT(*) FROM blog) AS registros FROM blog, datosBlog, visitas WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ?  AND blog.status = ? AND blog.idioma = ? AND blog.idCategoria = ? ORDER BY blog.orden DESC";
        $_SQL = "SELECT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo AS subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, COUNT(visitas.idBlog) AS visitas, COUNT(*) AS registros
			FROM
			    blog
			INNER JOIN datosBlog ON blog.idBlog = datosBlog.idBlog
			LEFT JOIN visitas ON blog.idBlog = visitas.idBlog
			WHERE
			    datosBlog.lang = ? AND
			    blog.status = ? AND
			    blog.idioma = ? AND
			    blog.idCategoria = ?
			GROUP BY
			    blog.idBlog
			ORDER BY
			    blog.orden DESC";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang, 1, $idioma, $idCategoria));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['registros']            = $_row['registros'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']    = $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['visitas']         = $_row['visitas'];
			$_registro['subtituloBlog']         = $_row['subtituloBlog'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['descripcionCorta']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcionCorta']), 191);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaCreacionFormato']     = $this -> _herramientas -> getFormatedDateFE($_row['fechaCreacion']);
			$_registro['fechaCreacionFormatoI']     = $this -> _herramientas -> getFormatedDateFI($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['fecha']             = $_row['fechaCreacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listBlogRand($_lang = 'ES',$idioma=0){
		$_MYSQL = new MYSQL();
		// $_SQL = "SELECT DISTINCT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo as subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, (SELECT COUNT(*) FROM visitas
        // WHERE blog.idBlog = visitas.idBlog) AS visitas, (SELECT COUNT(*) FROM blog) AS registros FROM blog, datosBlog, visitas WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ?  AND blog.status = ? AND blog.idioma = ? ORDER BY RAND() LIMIT 0,4";
        $_SQL = "SELECT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, blog.subtitulo AS subtituloBlog, blog.descripcionCorta, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable, COUNT(visitas.idBlog) AS visitas, COUNT(blog.idBlog) AS registros
			FROM blog
			INNER JOIN datosBlog ON blog.idBlog = datosBlog.idBlog
			LEFT JOIN visitas ON blog.idBlog = visitas.idBlog
			WHERE
			    datosBlog.lang = ? AND
			    blog.status = ? AND
			    blog.idioma = ?
			GROUP BY
			    blog.idBlog
			ORDER BY
			    RAND()
			LIMIT 0, 4";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang, 1, $idioma));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['registros']            = $_row['registros'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']    = $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['visitas']         = $_row['visitas'];
			$_registro['subtituloBlog']         = $_row['subtituloBlog'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['descripcionCorta']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcionCorta']), 191);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaCreacionFormato']     = $this -> _herramientas -> getFormatedDateFE($_row['fechaCreacion']);
			$_registro['fechaCreacionFormatoI']     = $this -> _herramientas -> getFormatedDateFI($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['fecha']             = $_row['fechaCreacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listRecentBlog1($_lang = 'ES',$idioma=0){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT blog.idBlog, blog.idCategoria, blog.idSubcategoria, blog.portada, blog.fechaCreacion, blog.fechaModificacion, blog.status, blog.orden, datosBlog.titulo, datosBlog.subtitulo, datosBlog.descripcion, datosBlog.tags, datosBlog.tagsAmigables, datosBlog.urlAmigable FROM blog, datosBlog WHERE blog.idBlog = datosBlog.idBlog AND datosBlog.lang = ?  AND blog.status = ? AND blog.idioma = ? ORDER BY blog.orden DESC LIMIT 0, 1";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_lang, 1, $idioma));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog']            = $_row['idBlog'];
			$_registro['idCategoria']       = $_row['idCategoria'];
			$_registro['idSubcategoria']    = $_row['idSubcategoria'];
			$_registro['tituloCategoria']   = $this -> getNameCategoria($_row['idCategoria'], $_lang);
			$_registro['urlAmigableCat']   = $this ->_herramientas -> getUrlAmigable($this -> getNameCategoria($_row['idCategoria'], $_lang));
			$_registro['portada']           = $_row['portada'];
			$_registro['titulo']            = $_row['titulo'];
			$_registro['subtitulo']         = $_row['subtitulo'];
			$_registro['descripcion']       = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 120);
			$_registro['tags']              = $this -> _herramientas -> formatedTags($_row['tags'], $_frontEnd);
			$_registro['tagsAmigables']     = $this -> _herramientas -> formatedTags($_row['tagsAmigables'], true);
			$_registro['urlAmigable']       = $_row['urlAmigable'];
			$_registro['fechaCreacion']     = $this -> _herramientas -> getFormatedDate($_row['fechaCreacion']);
			$_registro['fechaModificacion'] = $_row['fechaModificacion'];
			$_registro['fecha']             = $_row['fechaCreacion'];
			$_registro['status']            = $_row['status'];
			$_registro['orden']             = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function getNameCategoria($_idCategoria, $_lang){
		$_MYSQL = new MYSQL();
		($_lang == 'ES') ? $_SQL = "SELECT nombre FROM categoria WHERE idcategoria = ?" : $_SQL = "SELECT tituloEn FROM categoria WHERE idCategoria = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_idCategoria));
		$obj = $_MYSQL -> fetchobject();
		if($_lang == 'ES') return $obj -> nombre; else return $obj -> tituloEn;

	}
	function allTags($_lang = 'ES'){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT datosBlog.tagsAmigables FROM blog, datosBlog WHERE blog.idBlog = datosBlog.idBlog AND blog.status = ? AND datosBlog.lang = ? ORDER BY RAND() LIMIT 0,30" ;
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array(1, $_lang));
		while($_row = $_MYSQL -> fetchrow()){
			$_tags .= $_row['tagsAmigables'].'-';
		}
		$_tagsComparar = $this -> _herramientas -> separateTags($_tags, '-');
		$_finalTags = array();
		foreach ($_tagsComparar as $_t) {
			if(!in_array($_t, $_finalTags)){
				array_push($_finalTags, $_t);
			}
		}
		return $_finalTags;
	}

//visitas
function addVisita($idBlog=0,$hoy='',$ip=''){
	$_MYSQL = new MYSQL();
	$_SQL = "INSERT INTO visitas(ip, fecha, idBlog)VALUES(?,?,?)";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	if($_MYSQL -> Execute($_SQL, array($ip, $hoy, $idBlog))){
		$this -> id_visita = $_MYSQL -> conexion -> lastInsertId();
		$_success = 1;
	}else{
		$this -> id_visita = 0;
		$_success = 0;
	}
	return $_success;
}

function listaVisitaExistente($idBlog=0,$hoy='',$ip=''){
	$_MYSQL = new MYSQL();
	$_SQL = "SELECT id_visita,ip,fecha,idBlog FROM visitas WHERE idBlog = ?  AND fecha = ? AND ip = ?";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	$_MYSQL -> Execute($_SQL, array($idBlog, $hoy, $ip));
	$_resultados = array();
	while($_row = $_MYSQL -> fetchrow()){
		$_registro['id_visita'] = $_row['id_visita'];
		$_registro['ip'] = $_row['ip'];

		array_push($_resultados, $_registro);
	}
	return $_resultados;
}

function getVisitas($idBlog){
	$_MYSQL = new MYSQL();
	$_SQL = "SELECT COUNT(*) as visitas FROM visitas WHERE idBlog = ?";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	$_MYSQL -> Execute($_SQL, array($idBlog));
	$obj = $_MYSQL -> fetchobject();

	$this -> visitas          = $obj -> visitas;
}



//rating
function addRating($idBlog=0,$ip='',$valor=0){
	$_MYSQL = new MYSQL();
	$_SQL = "INSERT INTO rating(ip,idBlog,num)VALUES(?,?,?)";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	if($_MYSQL -> Execute($_SQL, array($ip, $idBlog, $valor))){
		$this -> id_rating = $_MYSQL -> conexion -> lastInsertId();
		$_success = 1;
	}else{
		$this -> id_rating = 0;
		$_success = 0;
	}
	return $_success;
}

function addRatingDefault(){
	$_MYSQL = new MYSQL();
	$_SQL = "INSERT INTO rating(idBlog)VALUES(?)";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	if($_MYSQL -> Execute($_SQL, array($this->_idBlog))){
		$this -> id_rating = $_MYSQL -> conexion -> lastInsertId();
		$_success = 1;
	}else{
		$this -> id_rating = 0;
		$_success = 0;
	}
	return $_success;
}

function addVisitaDefault(){
	$_MYSQL = new MYSQL();
	$_SQL = "INSERT INTO visitas(idBlog)VALUES(?)";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	if($_MYSQL -> Execute($_SQL, array($this->_idBlog))){
		$this -> id_visita = $_MYSQL -> conexion -> lastInsertId();
		$_success = 1;
	}else{
		$this -> id_visita = 0;
		$_success = 0;
	}
	return $_success;
}

function listaRatingExistente($idBlog=0,$ip=''){
	$_MYSQL = new MYSQL();
	$_SQL = "SELECT id_rating,ip,fecha,idBlog FROM rating WHERE idBlog = ? AND ip = ?";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	$_MYSQL -> Execute($_SQL, array($idBlog, $ip));
	$_resultados = array();
	while($_row = $_MYSQL -> fetchrow()){
		$_registro['id_rating'] = $_row['id_rating'];
		$_registro['ip'] = $_row['ip'];

		array_push($_resultados, $_registro);
	}
	return $_resultados;
}

function getRating($idBlog){
	$_MYSQL = new MYSQL();
	$_SQL = "SELECT SUM(num) as rating, COUNT(id_rating) as totalPersonas FROM rating WHERE idBlog = ?";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	$_MYSQL -> Execute($_SQL, array($idBlog));
	$obj = $_MYSQL -> fetchobject();

	$this -> rating          = $obj -> rating;
	$this -> personas          = $obj -> totalPersonas;
	$this -> calificacionPre = $obj -> rating / $obj -> totalPersonas;
	$this -> calificacionFinal = round($this -> calificacionPre);
}

/*Comentarios*/

function addComentarioBlog($idBlog=0,$nombre='',$correo='',$mensaje='',$fecha=''){
	$_MYSQL = new MYSQL();
	$_SQL = "INSERT INTO comentarios(idBlog, nombre, correo, mensaje, fecha) VALUES (?,?,?,?,?)";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	if($_MYSQL -> Execute($_SQL, array($idBlog, $nombre, $correo, $mensaje, $fecha))){
		$this -> idComentario = $_MYSQL -> conexion -> lastInsertId();
		$_success = 1;
	}else{
		$this -> idComentario = 0;
		$_success = 0;
	}
	return $_success;
}

function listaComentarios($idBlog=0){
	$_MYSQL = new MYSQL();
	$_SQL = "SELECT nombre,correo,mensaje,fecha FROM comentarios WHERE idBlog = ? order by fecha asc";
	$_CONECTADO = $_MYSQL -> Connect();
	if(!$_CONECTADO){
		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
		exit();
	}
	$_MYSQL -> Execute($_SQL, array($idBlog));
	$_resultados = array();
	while($_row = $_MYSQL -> fetchrow()){
		$_registro['nombre'] = $_row['nombre'];
		$_registro['correo'] = $_row['correo'];
		$_registro['mensaje'] = $_row['mensaje'];
		$_registro['fecha'] = $_row['fecha'];

		array_push($_resultados, $_registro);
	}
	return $_resultados;
}

/*==================================
 *	MAESTRO DE DETALLE GALERIA
 *==================================*/
	function agregarContenidoBlog($_tipo = ''){
		$_contenidoBlog = new contenidoBlog(0,$this -> _idBlog, $_tipo);
		$_contenidoBlog -> addContenidoBlog();
		return $_contenidoBlog -> _idContenidoBlog;
	}

	function agregarTexto($_idContenidoBlog = 0, $_descripcion = ''){
		$_contenidoBlog = new contenidoBlog($_idContenidoBlog);
		$_contenidoBlog -> addTexto($_descripcion);
	}

	function agregarImagen($_idContenidoBlog = 0, $_ruta = '', $_tmp = ''){
		$_contenidoBlog = new contenidoBlog($_idContenidoBlog);
		$_contenidoBlog -> addImg($_ruta, $_tmp);
	}

	function agregarVideo($_idContenidoBlog = 0, $_url = '', $_ruta = '', $_tmp = ''){
		$_contenidoBlog = new contenidoBlog($_idContenidoBlog);
		$_contenidoBlog -> addVideo($_url,$_ruta, $_tmp);
	}

	function insertarGaleriaContenido($_idContenidoBlog, $_name, $_tmp){
		$_contenidoBlog = new contenidoBlog($_idContenidoBlog);
		$_contenidoBlog ->  agregarGaleriaContenido($_name, $_tmp);
	}

	function modGaleriaContenido($_idGaleriaContenido, $_name, $_tmp){
		$_contenidoBlog = new contenidoBlog();
		$_contenidoBlog ->  modificarGaleriaContenido($_idGaleriaContenido, $_name, $_tmp);
	}

	function listarGaleriaContenido($_idContenidoBlog){
		$_contenidoBlog = new contenidoBlog($_idContenidoBlog);
		$_contenidoBlog -> listarGaleriaContenido();
		return $_contenidoBlog -> _galeriaContenido;
	}

	function delGaleriaContenido($_idGaleriaContenido){
		$_contenidoBlog = new contenidoBlog();
		$_contenidoBlog -> eliminarGaleriaContenido($_idGaleriaContenido);
	}

	function eliminarContenidoBlog($idContenidoBlog){
		$_contenidoBlog = new contenidoBlog($idContenidoBlog);
		$_contenidoBlog -> deleteContenidoBlog();
	}

	function modificarOrdenContenidoBlog($idContenidoBlog, $_orden){
		$_contenidoBlog = new contenidoBlog($idContenidoBlog);
		$_contenidoBlog -> updateOrdenContenidoBlog($_orden);
	}

	function listarContenidoBlog(){
		$_contenidoBlogTemp = new contenidoBlog(0, $this -> _idBlog);
		$this -> _contenidoBlog = $_contenidoBlogTemp -> listContenidoBlog();
	}
/*==================================
 * 1:1 BLOG : DATOS BLOG
 *==================================*/
	function agregarDatosBlog($_titulo = '', $_subtitulo = '', $_descripcion = '', $_tags = '', $_lang = ''){
		$_datosBlog = new datosBlog($this -> _idBlog, $_titulo, $_subtitulo, $_descripcion, $_tags, $_lang);
		$_datosBlog -> addDatosBlog();
	}

	function modificarDatosBlog($_titulo = '', $_subtitulo = '', $_descripcion = '', $_tags = '', $_lang = ''){
		$_datosBlog = new datosBlog($this -> _idBlog, $_titulo, $_subtitulo, $_descripcion, $_tags, $_lang);
		$_datosBlog -> updateDatosBlog();
	}

	function eliminarDatosBlog(){
		$_datosBlog = new datosBlog($this -> _idBlog);
		$_datosBlog -> deleteDatosBlog();
	}

	function obtenerDatosBlog($_lang){
		$this -> _datosBlog = new datosBlog($this -> _idBlog);
		$this -> _datosBlog -> _lang = $_lang;
		$this -> _datosBlog -> getDatosBlog();
	}

	function listarDatosBlog($_lang){
		$_datosBlog = new datosBlog($this -> _idBlog);
		$_datosBlog -> _lang = $_lang;
		$_resultado = $_datosBlog -> listDatosBlog();
		return $_resultado;
	}
	/**********************************/
	/* AGREGAR PRODUCTO X SOLUCIONES */
	/**********************+*********/
	/*function agregarProductoxSoluciones($idSolucion){
		$datoProductoxSolucion = new productoxsolucion($idSolucion, $this-> idBlog);
		$datoProductoxSolucion -> asigna_productoxsolucion();
	}*/

	function agregarProductosxSoluciones($idProducto){
		$productoxsolucion = new productoxsolucion($this -> _idBlog, $idProducto);
		$productoxsolucion -> asigna_productoxsolucion();
	}
	function eliminarProductosxSoluciones(){
		$delproductoxsolucion = new productoxsolucion($this -> _idBlog);
		$delproductoxsolucion -> desasignar_solucionxproducto();

	}

}
?>
