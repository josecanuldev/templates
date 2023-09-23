<?php
require_once 'conexion.php';

class ingrediente{ 
	var $idIngrediente;
	var $nombre;
	var $nombreEn;

	var $orden;
	var $status;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idIngrediente = 0,  $nombre = '',  $nombreEn = ''){
		$this -> idIngrediente = $idIngrediente;
		$this -> nombre = $nombre;
		$this -> nombreEn = $nombreEn;
		
		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addIngrediente(){
		$sql = "INSERT INTO ingrediente(nombre, status, nombreEn) VALUES ('".htmlspecialchars($this -> nombre, ENT_QUOTES)."', 1, '".htmlspecialchars($this -> nombreEn, ENT_QUOTES)."')";
		$conexion = new conexion();
		$this -> idIngrediente = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE ingrediente SET orden = ".$this -> idIngrediente." WHERE idIngrediente = ".$this -> idIngrediente;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateIngrediente(){
		$sql = "UPDATE ingrediente SET nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', nombreEn = '".htmlspecialchars($this -> nombreEn, ENT_QUOTES)."' WHERE idIngrediente = ".$this -> idIngrediente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteIngrediente(){
		$sql = "DELETE FROM ingrediente WHERE idIngrediente = ".$this -> idIngrediente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenIngrediente($orden){
		$sql = "UPDATE ingrediente SET orden = ".$orden." WHERE idIngrediente = ".$this -> idIngrediente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusIngrediente($status){
		$sql = "UPDATE ingrediente SET status = ".$status." WHERE idIngrediente = ".$this -> idIngrediente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getIngrediente(){
		$sql = "SELECT * FROM ingrediente WHERE idIngrediente = ".$this -> idIngrediente;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idIngrediente = $obj -> idIngrediente;
		$this -> nombre = $obj -> nombre;
		$this -> nombreEn = $obj -> nombreEn;
	}

	function listIngrediente($pagina = 1, $busqueda = "", $_status = '', $_paginador = true){
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%') " : $palabra = '';
		($_status != '') ? $status = ' AND status = 1 ' : $status = '';
		
		$sql = "SELECT * FROM ingrediente WHERE 1 = 1".$palabra.$status." ORDER BY nombre ASC";
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
			$registro['idIngrediente'] = $row['idIngrediente'];
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