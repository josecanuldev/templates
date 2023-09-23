<?php
require_once 'MYSQL.php';
require_once 'herramientas.php';
require_once 'archivo.php';

class galeriaLB extends Archivo{
	var $_idGaleriaLB;
	var $_idLookbook;
	var $_ruta;

	var $_directorio = '../img/lookbook/';
	var $_orden;

	var $_herramientas;

	function __construct($_idGaleriaLB = 0, $_idLookbook = '', $_ruta = '', $_tmp = ''){
		$this -> _idGaleriaLB = $_idGaleriaLB;
		$this -> _idLookbook = $_idLookbook;
		($_ruta != '') ? $this -> _ruta = $this -> obtenerExtensionArchivo($_ruta) : $this -> _ruta = '';

		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;

		$this -> _herramientas = new herramientas();
	}

	function addGaleriaLB(){
		if($this -> subir_archivo_imagen($this -> _ruta)){
			$_MYSQL = new MYSQL();
			$_SQL = "INSERT INTO galeriaLB(idLookbook, ruta) VALUES (?,?)";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			if($_MYSQL -> Execute($_SQL, array($this -> _idLookbook, $this -> _ruta))){
				$this -> _idGaleriaLB = $_MYSQL -> conexion -> lastInsertId();
				$_O = "UPDATE galeriaLB SET orden = ? WHERE idGaleriaLB = ?";
				$_MYSQL -> Execute($_O, array($this -> _idGaleriaLB, $this -> _idGaleriaLB));
			}
		}
	}

	function updateGaleriaLB(){
		$_MYSQL = new MYSQL();
		if($this -> _ruta != ''){
			$this -> getRutaArchivo();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _ruta)){
				$_IMG = "UPDATE galeriaLB SET ruta = ? WHERE idGaleriaLB = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_IMG, array($this -> _ruta, $this -> _idGaleriaLB));
			}
		}
	}

	function deleteGaleriaLB(){
		$this -> getRutaArchivo();
		$this -> borrar_archivo();
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM galeriaLB WHERE idGaleriaLB = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idGaleriaLB));
	}

	function updateOrdenGaleriaLB($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE galeriaLB SET orden = ? WHERE idGaleriaLB = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idGaleriaLB));
	}


	function getRutaArchivo(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT ruta FROM galeriaLB WHERE idGaleriaLB = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idGaleriaLB));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$obj -> ruta;
	}

	function getGaleriaLB(){
		$sql = "SELECT * FROM galeriaLB WHERE idGaleriaLB = ".$this -> idGaleriaLB;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idGaleriaLB = $obj -> idGaleriaLB;
		$this -> idLookbook = htmlspecialchars_decode($obj -> idLookbook);
		$this -> ruta = $obj -> ruta;
	}

	function listGaleriaLB(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM galeriaLB WHERE idLookbook = ? ORDER BY orden DESC";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idLookbook));
		$resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$registro['idGaleriaLB'] = $_row['idGaleriaLB'];
			$registro['idLookbook'] = $_row['idLookbook'];
			$registro['ruta'] = $_row['ruta'];
			$registro['orden'] = $_row['orden'];
			array_push($resultados, $registro);
		}
		return $resultados;
	}

}
?>
