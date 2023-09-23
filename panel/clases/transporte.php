<?php
include_once('conexion.php');
include_once('archivo.php');
include_once('rangoTransporte.php');

class transporte extends Archivo
{
	var $idTransporte;
	var $nombre;
	var $tiempoTransito;
	var $gratis;
	var $cantidadGratis;
	var $ruta;
	var $directorio = '../img/imgTransporte/';

	var $orden;
	var $status;

	var $rangos;
	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idTransporte = 0, $nombre = "", $tiempoTransito = "", $gratis = 0, $cantidadGratis = 0, $ruta = '', $tmp = ''){
		$this -> idTransporte = $idTransporte;
		$this -> nombre = $nombre;
		$this -> tiempoTransito = $tiempoTransito;
		$this -> gratis = $gratis;
		$this -> cantidadGratis = $cantidadGratis;
		$this -> rangos = array();

		($ruta != '') ? $this -> ruta = $this -> obtenerExtensionArchivo($ruta) : $this -> ruta = '';
		$this -> ruta_final = $this -> directorio;
		$this -> ruta_temporal = $tmp;

		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;
	}


	function addTransporte(){
		$sql = "INSERT INTO transporte (nombre, tiempoTransito, gratis, cantidadGratis, ruta, status) values ('".htmlspecialchars($this->nombre, ENT_QUOTES)."', '".htmlspecialchars($this -> tiempoTransito, ENT_QUOTES)."', '".$this -> gratis."', '".$this -> cantidadGratis."', '".htmlspecialchars($this -> ruta, ENT_QUOTES)."', 1);";
		$con = new conexion();
		$this -> idTransporte = $con->ejecutar_sentencia($sql);
		if($this -> idTransporte != 0)
			$this -> subir_archivo_imagen($this -> ruta);
	}


	function updateTransporte(){
		if($this -> ruta != ''){
			$this -> getRutaArchivo();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> directorio;
			$rutaPedazo = " ruta = '".$this -> ruta."', ";
			$this -> subir_archivo_imagen($this -> ruta);
		}else{
			$rutaPedazo = '';
		}

		$sql="UPDATE transporte SET ".$rutaPedazo." nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', tiempoTransito = '".$this -> tiempoTransito."', gratis = '".$this -> gratis."', cantidadGratis = '".$this-> cantidadGratis."' WHERE idTransporte = ".$this -> idTransporte.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}

	function updateOrdenTransporte($orden){
		$sql = "UPDATE transporte SET orden = ".$orden." WHERE idTransporte = ".$this -> idTransporte;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusTransporte($status){
		$sql = "UPDATE transporte SET status = ".$status." WHERE idTransporte = ".$this -> idTransporte;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteTransporte(){
		$this -> getRutaArchivo();
		$this -> borrar_archivo();

		$sql="DELETE FROM transporte WHERE idTransporte = ".$this -> idTransporte;
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}

	function getRutaArchivo(){
		$sql = "SELECT ruta FROM transporte WHERE idTransporte = ".$this -> idTransporte;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> ruta_final = $this -> directorio.$obj -> ruta;
	}

	function listTransporteFrontEnd(){
		$resultados = array();
		$con = new conexion();
		$sql = "SELECT transporte.idTransporte, nombre, tiempoTransito, idRangoTranporte, cargoPorEnvio
				FROM transporte, rangosTransporte
				WHERE transporte.idTransporte = rangosTransporte.idTransporte
				AND transporte.status = 1
				AND rangosTransporte.status = 1
				GROUP BY transporte.idTransporte";
		$temporal = $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)){
			$registro['idTransporte'] = $fila['idTransporte'];
			$registro['nombre'] = $fila['nombre'];
			$registro['tiempoTransito'] = $fila['tiempoTransito'];
			$registro["idRangoTranporte"] = $fila["idRangoTranporte"];
			$registro["cargoPorEnvio"] = $fila["cargoPorEnvio"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function getTransporte(){
		$sql = "SELECT * FROM transporte WHERE idTransporte = ".$this->idTransporte;
		$con = new conexion();
		$resultados = $con->ejecutar_sentencia($sql);

		$obj = mysqli_fetch_object($resultados);
		$this -> idTransporte = $obj -> idTransporte;
		$this -> nombre = $obj -> nombre;
		$this -> tiempoTransito = $obj -> tiempoTransito;
		$this -> gratis = $obj -> gratis;
		$this -> cantidadGratis = $obj -> cantidadGratis;
		$this -> ruta = $obj -> ruta;
		$this -> listarRango();
	}

	function obtenerMaxTransporte($idTransporte){
		$con = new conexion();
		$sql = "SELECT transporte.idTransporte, nombre, tiempoTransito, peso_maximo,cargoPorEnvio, idRangoTranporte
				FROM transporte, rangosTransporte
				WHERE transporte.idTransporte = rangosTransporte.idTransporte
				AND peso_maximo = (
				SELECT MAX( peso_maximo )
				FROM rangosTransporte
				WHERE rangosTransporte.idTransporte = ".$idTransporte." )
				AND transporte.idTransporte =".$idTransporte;
		$result = $con->ejecutar_sentencia($sql);
		$row = mysqli_fetch_object($result);
		return $row;
	}

	function listTransporte($pagina = 1, $busqueda = "", $frontEnd = false){
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%') " : $palabra = '';
		($frontEnd) ? $pedazo = ' AND status = 1' : $pedazo = '';

		$sql = "SELECT * FROM transporte WHERE 1 = 1".$palabra." ".$pedazo." ORDER BY orden DESC";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);

		if(!$frontEnd){
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
			$registro['idTransporte'] = $row['idTransporte'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['tiempoTransito'] = htmlspecialchars_decode($row['tiempoTransito']);
			$registro['status'] = $row['status'];
			$registro['ruta'] = $row['ruta'];
 			$registro['orden'] = $row['orden'];
 			$registro['gratis'] = $row['gratis'];
 			$registro['cantidadGratis'] = $row['cantidadGratis'];

 			if($frontEnd){
 				$this -> idTransporte = $row['idTransporte'];
	 			$this -> listarRango();
	 			$registro['rangos'] = $this -> rangos;
	 			$this -> rangos = array();
 			}

			if(!$frontEnd){
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

	/* ======================================
	 * Maestro detalle Rango Transporte
	 * ====================================== */

	function agregarRango($pesoMin = '', $pesoMax = '', $cargo = ''){
		$rangoTransporte = new rangoTransporte(0,$this -> idTransporte, $pesoMax, $pesoMin, $cargo);
		$rangoTransporte -> addRangoTransporte();
		return $rangoTransporte -> idRangoTransporte;
	}

	function modificarRango($idRango = 0, $pesoMin = '', $pesoMax = '', $cargo = ''){
		$rangoTransporte = new rangoTransporte($idRango, $this -> idTransporte, $pesoMax, $pesoMin, $cargo);
		$rangoTransporte -> updateRangoTransporte();
	}

	function modificarStatusRango($idRango, $status){
		$rangoTransporte = new rangoTransporte($idRango);
		$rangoTransporte -> updateStatusRangoTransporte($status);
	}

	function eliminarRango($idRango = 0){
		$rangoTransporte = new rangoTransporte($idRango);
		$rangoTransporte -> deleteRangoTransporte();
	}

	function listarRango(){
		$rangoTransporte = new rangoTransporte(0, $this -> idTransporte);
		$this -> rangos = $rangoTransporte -> listRangoTranporte();
	}

}
?>
