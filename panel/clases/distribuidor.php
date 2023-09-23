<?php
require_once 'conexion.php';
require_once 'datosDistribuidor.php';

class distribuidor{
	var $idDistribuidor;
	var $nombre;
	var $descripcion;
	var $latitud;
	var $longitud;
	var $_datosDistribuidor;
	var $orden;
	var $status;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idDistribuidor = 0,  $nombre = '', $descripcion = '', $latitud = '', $longitud = ''){
		$this -> idDistribuidor = $idDistribuidor;
		$this -> nombre = $nombre;
		$this -> descripcion = $descripcion;
		$this -> latitud = $latitud;
		$this -> longitud = $longitud;
		$this -> _datosDistribuidor = array();
		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addDistribuidor(){
		$sql = "INSERT INTO distribuidor(nombre, descripcion, latitud, longitud, status) VALUES ('".htmlspecialchars($this -> nombre, ENT_QUOTES)."', '".htmlspecialchars($this -> descripcion, ENT_QUOTES)."', '".$this -> latitud."', '".$this -> longitud."', 1)";
		$conexion = new conexion();
		$this -> idDistribuidor = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE distribuidor SET orden = ".$this -> idDistribuidor." WHERE idDistribuidor = ".$this -> idDistribuidor;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateDistribuidor(){
		$sql = "UPDATE distribuidor SET nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', descripcion = '".htmlspecialchars($this -> descripcion, ENT_QUOTES)."', latitud = '".$this -> latitud."', longitud = '".$this -> longitud."' WHERE idDistribuidor = ".$this -> idDistribuidor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteDistribuidor(){
		$sql = "DELETE FROM distribuidor WHERE idDistribuidor = ".$this -> idDistribuidor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenDistribuidor($orden){
		$sql = "UPDATE distribuidor SET orden = ".$orden." WHERE idDistribuidor = ".$this -> idDistribuidor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusDistribuidor($status){
		$sql = "UPDATE distribuidor SET status = ".$status." WHERE idDistribuidor = ".$this -> idDistribuidor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getDistribuidor(){
		$sql = "SELECT * FROM distribuidor WHERE idDistribuidor = ".$this -> idDistribuidor;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idDistribuidor = $obj -> idDistribuidor;
		$this -> nombre = $obj -> nombre;
		$this -> descripcion = $obj -> descripcion;
		$this -> latitud = $obj -> latitud;
		$this -> longitud = $obj -> longitud;
	}

	function listDistribuidor($pagina = 1, $busqueda = "", $_status = '', $_paginador = true){
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%') " : $palabra = '';
		($_status != '') ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM distribuidor WHERE 1 = 1".$palabra.$status." ORDER BY orden DESC";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);

		if($_paginador){
			$this -> totalRegistros = mysqli_num_rows($temporal);
			$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);
			$paginaActual = $pagina;

			$sql .= ' LIMIT '.($pagina - 1) * $this -> registrosPorPagina.', '.$this -> registrosPorPagina;
			$temporal2 = $conexion -> ejecutar_sentencia($sql);
			$final = $temporal2;
		}
		else{
			$final = $temporal;
		}

		$resultados = array();
		while($row = mysqli_fetch_array($final)){
			$registro['idDistribuidor'] = $row['idDistribuidor'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['descripcion'] = htmlspecialchars_decode($row['descripcion']);
			$registro['latitud'] = $row['latitud'];
			$registro['longitud'] = $row['longitud'];
			$registro['status'] = $row['status'];
			$registro['orden'] = $row['orden'];
			if($_paginador){
				$registro['ultimapagina']=$ultimaPagina;
				$registro['paginaanterior']=$pagina-1;
				$registro['paginasiguiente']=$pagina+1;
				$registro['pagina']=$pagina;
			}
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listDistribuidorFront(){
		$sql = "SELECT * FROM distribuidor WHERE status = 1 ORDER BY orden DESC";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$resultados = array();
		while($row = mysqli_fetch_array($temporal)){
			$registro['idDistribuidor'] = $row['idDistribuidor'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['descripcion'] = htmlspecialchars_decode($row['descripcion']);
			$registro['latitud'] = $row['latitud'];
			$registro['longitud'] = $row['longitud'];
			$registro['status'] = $row['status'];
			$registro['orden'] = $row['orden'];
			$this -> idDistribuidor = $row['idDistribuidor'];
			$this -> listarDatosDistribuidor();
			$registro['datosDist'] = $this -> _datosDistribuidor;
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function arrayMaps(){
		$sql = "SELECT * FROM distribuidor WHERE status = 1 ORDER BY orden DESC";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$resultados = array();
		array_push($resultados, array(1, '', 20.125239, -88.922251, 'sacv', 'pin.png'));
		while($row = mysqli_fetch_array($temporal)){
			array_push($resultados, array($row['idDistribuidor'], '', (float)$row['latitud'], (float)$row['longitud'], $row['nombre'], 'pin-suc.png'));
		}
		echo json_encode($resultados);
	}
	/**
	 * MAESTRO DETALLE DATOS DISTRIBUIDOR
	 */

	function agregarDatosDistribuidor($nombre = '', $descripcion = ''){
		$datosDistribuidor = new datosDistribuidor(0, $this -> idDistribuidor, $nombre, $descripcion);
		$datosDistribuidor -> addDatosDistribuidor();
	}

	function modificarDatosDistribuidor($idDatosDistribuidor = 0, $nombre = '', $descripcion = ''){
		$datosDistribuidor = new datosDistribuidor($idDatosDistribuidor, 0, $nombre, $descripcion);
		$datosDistribuidor -> updateDatosDistribuidor();
	}

	function eliminarDatosDistribuidor($idDatosDistribuidor = 0, $all = false){
		$datosDistribuidor = new datosDistribuidor($idDatosDistribuidor, $this -> idDistribuidor);
		$datosDistribuidor -> deleteDatosDistribuidor($all);
	}

	function changeStatusDatosDistribuidor($idDatosDistribuidor = 0, $status = 0){
		$datosDistribuidor = new datosDistribuidor($idDatosDistribuidor);
		$datosDistribuidor -> updateDatosDistribuidor($status);
	}

	function ordenarDatosDistribuidor($idDatosDistribuidor = 0, $orden = 0){
		$datosDistribuidor = new datosDistribuidor($idDatosDistribuidor);
		$datosDistribuidor -> updateOrdenDatosDistribuidor($orden);
	}

	function listarDatosDistribuidor(){
		$this -> _datosDistribuidor = array();
		$datosDistribuidor = new datosDistribuidor(0, $this -> idDistribuidor);
		$this -> _datosDistribuidor = $datosDistribuidor -> listDatosDistribuidor();
	}

}
?>
