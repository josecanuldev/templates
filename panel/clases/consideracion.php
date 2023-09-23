<?php
require_once 'conexion.php';

class consideracion{ 
	var $idConsideracion;
	var $nombre;
	var $nombreEn;

	var $orden;
	var $status;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idConsideracion = 0,  $nombre = '',  $nombreEn = ''){
		$this -> idConsideracion = $idConsideracion;
		$this -> nombre = $nombre;
		$this -> nombreEn = $nombreEn;
		
		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addConsideracion(){
		$sql = "INSERT INTO consideracion(nombre, status, nombreEn) VALUES ('".htmlspecialchars($this -> nombre, ENT_QUOTES)."', 1, '".htmlspecialchars($this -> nombreEn, ENT_QUOTES)."')";
		$conexion = new conexion();
		$this -> idConsideracion = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE consideracion SET orden = ".$this -> idConsideracion." WHERE idConsideracion = ".$this -> idConsideracion;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateConsideracion(){
		$sql = "UPDATE consideracion SET nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', nombreEn = '".htmlspecialchars($this -> nombreEn, ENT_QUOTES)."' WHERE idConsideracion = ".$this -> idConsideracion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteConsideracion(){
		$sql = "DELETE FROM consideracion WHERE idConsideracion = ".$this -> idConsideracion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenConsideracion($orden){
		$sql = "UPDATE consideracion SET orden = ".$orden." WHERE idConsideracion = ".$this -> idConsideracion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusConsideracion($status){
		$sql = "UPDATE consideracion SET status = ".$status." WHERE idConsideracion = ".$this -> idConsideracion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getConsideracion(){
		$sql = "SELECT * FROM consideracion WHERE idConsideracion = ".$this -> idConsideracion;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idConsideracion = $obj -> idConsideracion;
		$this -> nombre = $obj -> nombre;
		$this -> nombreEn = $obj -> nombreEn;
	}

	function listConsideracion($pagina = 1, $busqueda = "", $_status = '', $_paginador = true){
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%') " : $palabra = '';
		($_status != '') ? $status = ' AND status = 1 ' : $status = '';
		
		$sql = "SELECT * FROM consideracion WHERE 1 = 1".$palabra.$status." ORDER BY nombre ASC";
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
			$registro['idConsideracion'] = $row['idConsideracion'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['nombreEn'] = htmlspecialchars_decode($row['nombreEn']);
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
}
?>