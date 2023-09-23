<?php
include_once('conexion.php');

class rangoTransporte

{
	var $idRangoTransporte;
	var $idTransporte;
	var $pesoMaximo;
	var $pesoMinimo;
	var $cargoPorEnvio;
	var $tiempoTransito;

	var $status;

	function __construct($idRangoTransporte = 0, $idTransporte = 0, $pesoMaximo = "", $pesoMinimo = "", $cargoPorEnvio = ""){
		$this -> idRangoTransporte = $idRangoTransporte;
		$this -> idTransporte = $idTransporte;
		$this -> pesoMaximo = $pesoMaximo;
		$this -> pesoMinimo = $pesoMinimo;
		$this -> cargoPorEnvio = $cargoPorEnvio;
	}

	function addRangoTransporte(){
		$sql = "INSERT INTO rangoTransporte(idTransporte, pesoMaximo, pesoMinimo, cargoPorEnvio, status) values ('".$this -> idTransporte."', '".$this -> pesoMaximo."', '".$this -> pesoMinimo."', '".$this -> cargoPorEnvio."', 1);";
		$con = new conexion();
		$this -> idRangoTransporte = $con->ejecutar_sentencia($sql);
	}

	function updateRangoTransporte(){
		$sql = "UPDATE rangoTransporte SET pesoMinimo = '".$this -> pesoMinimo."', pesoMaximo = '".$this -> pesoMaximo."', cargoPorEnvio = '".$this -> cargoPorEnvio."' WHERE idRangoTransporte = ".$this -> idRangoTransporte.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function updateStatusRangoTransporte($status){
		$sql = "UPDATE rangoTransporte SET status = ".$status." WHERE idRangoTransporte = ".$this -> idRangoTransporte;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteRangoTransporte(){
		$sql = "DELETE FROM rangoTransporte WHERE idRangoTransporte = ".$this->idRangoTransporte;
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function obtenerRangoTransporte(){
		$sql = "SELECT * FROM rangoTransporte WHERE idRangoTransporte = ".$this->idRangoTransporte;
		$con = new conexion();
		$resultados = $con->ejecutar_sentencia($sql);

		$obj = mysqli_fetch_object($resultados);
		$this -> idRangoTransporte = $obj -> idRangoTransporte;
		$this -> idTransporte = $obj -> idTransporte;
		$this -> pesoMinimo = $obj -> pesoMinimo;
		$this -> pesoMaximo = $obj -> pesoMaximo;
		$this -> cargoPorEnvio = $obj -> cargoPorEnvio;
		$this -> status = $obj -> status;
	}
	function obtenerRangoTransporteFinal(){
		$con = new conexion();
		$sql = "SELECT transporte.idTransporte, nombre, tiempoTransito, idRangoTransporte, cargoPorEnvio
				FROM transporte, rangoTransporte
				where transporte.idTransporte = rangoTranporte.idTransporte
				and idRangoTransporte = ".$this -> idRangoTransporte;
		$resultados= $con->ejecutar_sentencia($sql);

		$obj = mysqli_fetch_object($resultados);
		$this -> idRangoTransporte = $obj -> idRangoTransporte;
		$this -> idTransporte = $obj -> idTransporte;
		$this -> nombre = $obj -> nombre;
		$this -> tiempoTransito = $obj -> tiempoTransito;
		$this -> cargoPorEnvio = $obj -> cargoPorEnvio;
		$this -> status = $obj -> status;
	}

	function listRangoTranporte(){
		$resultados = array();
		$sql = "SELECT * FROM rangoTransporte WHERE idTransporte = ".$this -> idTransporte." ORDER BY pesoMinimo ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)){
			$registro['idRangoTransporte'] = $fila['idRangoTransporte'];
			$registro['pesoMaximo'] = $fila['pesoMaximo'];
			$registro['pesoMinimo'] = $fila['pesoMinimo'];
			$registro['cargoPorEnvio'] = $fila['cargoPorEnvio'];
			$registro['idTransporte'] = $fila['idTransporte'];
			$registro["status"] = $fila["status"];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
}
?>
