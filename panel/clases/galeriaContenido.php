<?php
require_once 'MYSQL.php';
require_once 'herramientas.php';
require_once 'archivo.php';

class galeriaContenido extends Archivo{
	var $_idGaleriaContenido;
	var $_idContenidoBlog;
	var $_ruta;

	var $_directorio = '../img/imgBlog/contenido/galeria/';
	var $_orden;

	var $_herramientas;

	function __construct($_idGaleriaContenido = 0, $_idContenidoBlog = '', $_ruta = '', $_tmp = ''){
		$this -> _idGaleriaContenido = $_idGaleriaContenido;
		$this -> _idContenidoBlog = $_idContenidoBlog;
		($_ruta != '') ? $this -> _ruta = $this -> obtenerExtensionArchivo($_ruta) : $this -> _ruta = '';

		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;

		$this -> _herramientas = new herramientas();
	}

	function addGaleriaContenido(){
		if($this -> subir_archivo_imagen($this -> _ruta)){
			$_MYSQL = new MYSQL();
			$_SQL = "INSERT INTO galeriaContenido(idContenidoBlog, ruta) VALUES (?,?)";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			if($_MYSQL -> Execute($_SQL, array($this -> _idContenidoBlog, $this -> _ruta))){
				$this -> _idGaleriaContenido = $_MYSQL -> conexion -> lastInsertId();
				$_O = "UPDATE galeriaContenido SET orden = ? WHERE idGaleriaContenido = ?";
				$_MYSQL -> Execute($_O, array($this -> _idGaleriaContenido, $this -> _idGaleriaContenido));
			}
		}
	}

	function updateGaleriaContenido(){
		$_MYSQL = new MYSQL();
		if($this -> _ruta != ''){
			$this -> getRutaArchivo();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _ruta)){
				$_IMG = "UPDATE galeriaContenido SET ruta = ? WHERE idGaleriaContenido = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_IMG, array($this -> _ruta, $this -> _idGaleriaContenido));
			}
		}
	}

	function deleteGaleriaContenido(){
		$this -> getRutaArchivo();
		$this -> borrar_archivo();
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM galeriaContenido WHERE idGaleriaContenido = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idGaleriaContenido));
	}

	function updateOrdenGaleriaContenido($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE galeriaContenido SET orden = ? WHERE idGaleriaContenido = ? AND tipo = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idGaleriaContenido, 'galeriaContenido'));
	}


	function getRutaArchivo(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT ruta FROM galeriaContenido WHERE idGaleriaContenido = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idGaleriaContenido));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$obj -> ruta;
	}

	function getGaleriaContenido(){
		$_SQL = "SELECT * FROM galeriaContenido WHERE idContenidoBlog = ? AND tipo = ?";
		$_MYSQL = new MYSQL();
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idContenidoBlog, 'otro'));
		$obj = $_MYSQL -> fetchobject();
		return $obj;
	}

	function listGaleriaContenido(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM galeriaContenido WHERE idContenidoBlog = ? ORDER BY orden DESC";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idContenidoBlog));
		$resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$registro['idGaleriaContenido'] = $_row['idGaleriaContenido'];
			$registro['idContenidoBlog'] = $_row['idContenidoBlog'];
			$registro['ruta'] = $_row['ruta'];
			$registro['orden'] = $_row['orden'];
			array_push($resultados, $registro);
		}
		return $resultados;
	}

}
?>
