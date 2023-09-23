<?php
	include_once 'conexion.php';

	/**
	* Estados y municipios de mexico
	*/
	class mexico{
		var $id;
		var $clave;
		var $estado;
		
		function __construct($id = 0,$clave = "", $estado = ""){
			$this->id = $id;
			$this->clave = $clave;
			$this->estado = $estado;
		}

		function listarEstados(){
			$resultados = array();
			$sql = "select * from estados";
			$con = new conexion();
			$temporal = $con->ejecutar_sentencia($sql);
			while ($fila = mysqli_fetch_array($temporal)){
				$registro = array();
				$registro['idestado'] = $fila['id'];
				$registro['clave'] = $fila['estado'];
				$registro['estado'] = $fila['descripcion_municipio'];
				array_push($resultados, $registro);
			}
			mysqli_free_result($temporal);
			return $resultados;
		}

		function listarMucipios(){
			$resultados = array();
			$sql = "select * from municipios where estado = '".$this->clave."'";
			$con = new conexion();
			$temporal = $con->ejecutar_sentencia($sql);
			while ($fila = mysqli_fetch_array($temporal)) {
				$registro = array();
				$registro['estado'] = $fila['estado'];
				$registro['municipio'] = $fila['descripcion'];
				array_push($resultados, $registro);				
			}
			mysqli_free_result($temporal);
			return $resultados;
		}

		function obtenerEstado(){
			echo $sql ="select * from estados where id = ".$this->id;
			$con = new conexion();
			$temporal = $con->ejecutar_sentencia($sql);
			while ($fila = mysqli_fetch_array($temporal)) {
				$this->id = $fila['id'];
				$this->clave = $fila['estado'];
				$this->estado = $fila['descripcion_municipio'];
			}
			mysqli_free_result($temporal);
		}
	}
?>