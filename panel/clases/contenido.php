<?php
require_once 'MYSQL.php';
require_once 'herramientas.php';
require_once 'archivo.php';

class contenido extends Archivo{
	var $_idContenido;
	var $_idSeccion;
	var $_ruta;

	var $_directorio = '../img/lookbook/';
	var $_orden;

	var $_herramientas;

	function __construct($_idContenido = 0, $_idSeccion = '', $_ruta = '', $_tmp = ''){
		$this -> _idContenido = $_idContenido;
		$this -> _idSeccion = $_idSeccion;
		($_ruta != '') ? $this -> _ruta = $this -> obtenerExtensionArchivo($_ruta) : $this -> _ruta = '';

		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;

		$this -> _herramientas = new herramientas();
	}

	function addContenido(){
		if($this -> subir_archivo_imagen($this -> _ruta)){
			$_MYSQL = new MYSQL();
			$_SQL = "INSERT INTO contenido(idSeccion, ruta) VALUES (?,?)";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			if($_MYSQL -> Execute($_SQL, array($this -> _idSeccion, $this -> _ruta))){
				$this -> _idContenido = $_MYSQL -> conexion -> lastInsertId();
				$_O = "UPDATE contenido SET orden = ? WHERE idContenido = ?";
				$_MYSQL -> Execute($_O, array($this -> _idContenido, $this -> _idContenido));
			}
		}
	}

	function updateContenido(){
		$_MYSQL = new MYSQL();
		if($this -> _ruta != ''){
			$this -> getRutaArchivo();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _ruta)){
				$_IMG = "UPDATE contenido SET ruta = ? WHERE idContenido = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_IMG, array($this -> _ruta, $this -> _idContenido));
			}
		}
	}

	function deleteContenido(){
		$this -> getRutaArchivo();
		$this -> borrar_archivo();
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM contenido WHERE idContenido = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idContenido));
	}

	function updateOrdenContenido($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE contenido SET orden = ? WHERE idContenido = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idContenido));
	}


	function getRutaArchivo(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT ruta FROM contenido WHERE idContenido = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idContenido));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$obj -> ruta;
	}

	function getContenido(){
		$sql = "SELECT * FROM contenido WHERE idContenido = ".$this -> idContenido;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idContenido = $obj -> idContenido;
		$this -> idSeccion = htmlspecialchars_decode($obj -> idSeccion);
		$this -> ruta = $obj -> ruta;
	}

	function listContenido(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM contenido WHERE idSeccion = ? ORDER BY orden ASC";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idSeccion));
		$resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$registro['idContenido'] = $_row['idContenido'];
			$registro['idSeccion'] = $_row['idSeccion'];
			$registro['ruta'] = $_row['ruta'];
			$registro['orden'] = $_row['orden'];
			array_push($resultados, $registro);
		}
		return $resultados;
	}

}
?>
