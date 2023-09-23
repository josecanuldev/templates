<?php
require_once('MYSQL.php');
include_once('herramientas.php');
include_once('archivo.php');
include_once('galeriaContenido.php');

class contenidoBlog extends Archivo{
	var $_idContenidoBlog;
	var $_idBlog;
	var $_descripcion;
	var $_directorio = '../img/imgBlog/contenido/';
	var $_imagen;
	var $_url;
	var $_tipo;
	var $_orden;

	var $_galeriaContenido;
	var $_herramientas;

	function __construct($_idContenidoBlog = 0, $_idBlog = '', $_tipo = '') {
		$this -> _idContenidoBlog = $_idContenidoBlog;
		$this -> _idBlog = $_idBlog;
		$this -> _tipo = $_tipo;
		$this -> _herramientas = new herramientas();

	}

	function addContenidoBlog(){
		$_MYSQL = new MYSQL();
		$_SQL = "INSERT INTO contenidoBlog(idBlog, tipo)VALUES(?,?)";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idBlog, $this -> _tipo));
		$this -> _idContenidoBlog = $_MYSQL -> conexion -> lastInsertId();
		$_O = "UPDATE contenidoBlog SET orden = ? WHERE idContenidoBlog = ?";
		$_MYSQL -> Execute($_O, array($this -> _idContenidoBlog, $this -> _idContenidoBlog));
	}

	function addImg($_ruta = '', $_tmp = ''){
		$_MYSQL = new MYSQL();
		if($_ruta != ''){
			$this -> getImagen();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $_tmp;
			$_ruta = $this -> obtenerExtensionArchivo($_ruta);
			if($this -> subir_archivo_imagen($_ruta)){
				$_SQL = "UPDATE contenidoBlog SET imagen = ? WHERE idContenidoBlog = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_SQL, array($_ruta, $this -> _idContenidoBlog));
			}
		}
	}

	function addVideo($_url = '', $_ruta = '', $_tmp = ''){
		$_MYSQL = new MYSQL();
		if($_ruta != ''){
			$this -> getImagen();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $_tmp;
			$_ruta = $this -> obtenerExtensionArchivo($_ruta);
			if($this -> subir_archivo_imagen($_ruta)){
				$_SQL = "UPDATE contenidoBlog SET imagen = ? WHERE idContenidoBlog = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_SQL, array($_ruta, $this -> _idContenidoBlog));
			}
		}
		$_SQL = "UPDATE contenidoBlog SET url = ? WHERE idContenidoBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_url, $this -> _idContenidoBlog));
	}

	function addTexto($_descripcion = ''){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE contenidoBlog SET descripcion = ? WHERE idContenidoBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_descripcion, $this -> _idContenidoBlog));
	}

	function updateOrdenContenidoBlog($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE contenidoBlog SET orden = ? WHERE idContenidoBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idContenidoBlog));
	}

	function getImagen(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT imagen FROM contenidoBlog WHERE idContenidoBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idContenidoBlog));
		$_obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$_obj -> imagen;
	}

	function deleteContenidoBlog(){
		$this -> getImagen();
		$this -> borrar_archivo();

		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM contenidoBlog WHERE idContenidoBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idContenidoBlog));
	}

	function listContenidoBlog(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM contenidoBlog WHERE idBlog = ? ORDER BY orden ASC";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idBlog));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idBlog'] = $_row['idBlog'];
			$_registro['idContenidoBlog'] = $_row['idContenidoBlog'];
			$_registro['descripcionCorta'] = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['descripcion'] = $_row['descripcion'];
			$_registro['imagen'] = $_row['imagen'];
			$_registro['tipo'] = $_row['tipo'];
			$this -> _idContenidoBlog = $_row['idContenidoBlog'];
			$this -> listarGaleriaContenido();
			$_registro['galeria'] = $this -> _galeriaContenido;
			$_registro['url'] = $_row['url'];
            $_typeVideo = $this->_herramientas->videoType($_row['url']);
            if ($_typeVideo == 'youtube') {
                $url = urldecode(rawurldecode($_row['url']));
                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
                $_registro['idVideo'] = $matches[1];
                $_registro['video'] = '<a href="http://www.youtube.com/embed/'.$matches[1].'?hd=1&wmode=opaque&controls=1&showinfo=0" data-type="video"></a>';
            } else if ($_typeVideo == 'vimeo') {
                $_idVideo = (int)substr(parse_url($_row['url'], PHP_URL_PATH), 1);
                $_registro['idVideo'] = $_idVideo;
                $_registro['video'] = '<a href="https://player.vimeo.com/video/'.$_idVideo.'?autoplay=1&color=E7E2DD&title=0&byline=0&portrait=0" data-type="video"></a>';
            }

						if($_typeVideo == 'youtube'){
							$url = urldecode(rawurldecode($_row['url']));
							preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
							//$registro['idVideo'] = $matches[1];
							$_registro['iframe']  = 'https://www.youtube.com/embed/'.$matches[1].'';
						}else if($_typeVideo == 'vimeo'){
							$_idVideo = (int) substr(parse_url($_row['url'], PHP_URL_PATH), 1);
							$_registro['iframe']  = 'https://player.vimeo.com/video/'.$_idVideo.'?color=696c6e&title=0&byline=0&portrait=0';
						}else{
							$_registro['iframe']  = '';
						}

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

/*==================================
 *	MAESTRO DE DETALLE GALERIA CONTENIDO
 *==================================*/
	function agregarGaleriaContenido($ruta, $tmp){
		$_galeriaContenido = new galeriaContenido(0,$this -> _idContenidoBlog, $ruta, $tmp);
		$_galeriaContenido -> addGaleriaContenido();
	}

	function modificarGaleriaContenido($idGaleriaContenido, $ruta, $tmp){
		$_galeriaContenido = new galeriaContenido($idGaleriaContenido, '', $ruta, $tmp);
		$_galeriaContenido -> updateGaleriaContenido();
	}

	function eliminarGaleriaContenido($idGaleriaContenido){
		$_galeriaContenido = new galeriaContenido($idGaleriaContenido);
		$_galeriaContenido -> deleteGaleriaContenido();
	}

	function modificarOrdenGaleriaContenido($idGaleriaContenido, $_orden){
		$_galeriaContenido = new galeriaContenido($idGaleriaContenido);
		$_galeriaContenido -> updateOrdenGaleriaContenido($_orden);
	}

	function listarGaleriaContenido(){
		$this -> _galeriaContenido = array();
		$_galeriaContenidoTemp = new galeriaContenido(0, $this -> _idContenidoBlog);
		$this -> _galeriaContenido = $_galeriaContenidoTemp -> listGaleriaContenido();
	}
}
?>
