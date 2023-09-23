<?php
require_once 'conexion.php';

class talla{
	var $idTalla;
	var $nombre;

	var $orden;
	var $status;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idTalla = 0,  $nombre = ''){
		$this -> idTalla = $idTalla;
		$this -> nombre = $nombre;

		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addTalla(){
		$sql = "INSERT INTO talla(nombre, status) VALUES ('".htmlspecialchars($this -> nombre, ENT_QUOTES)."', 1)";
		$conexion = new conexion();
		$this -> idTalla = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE talla SET orden = ".$this -> idTalla." WHERE idTalla = ".$this -> idTalla;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateTalla(){
		$sql = "UPDATE talla SET nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."' WHERE idTalla = ".$this -> idTalla;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteTalla(){
		$sql = "DELETE FROM talla WHERE idTalla = ".$this -> idTalla;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenTalla($orden){
		$sql = "UPDATE talla SET orden = ".$orden." WHERE idTalla = ".$this -> idTalla;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusTalla($status){
		$sql = "UPDATE talla SET status = ".$status." WHERE idTalla = ".$this -> idTalla;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getTalla(){
		$sql = "SELECT * FROM talla WHERE idTalla = ".$this -> idTalla;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idTalla = $obj -> idTalla;
		$this -> nombre = $obj -> nombre;
	}

	function listTalla($pagina = 1, $busqueda = "", $_status = '', $_paginador = true){
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%') " : $palabra = '';
		($_status != '') ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM talla WHERE 1 = 1".$palabra.$status." ORDER BY orden DESC";
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
			$registro['idTalla'] = $row['idTalla'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
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
