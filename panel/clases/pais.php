<?php
require_once 'conexion.php';

class pais{
	var $idPais;
	var $nombre;

	var $orden;
	var $status;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idPais = 0,  $nombre = ''){
		$this -> idPais = $idPais;
		$this -> nombre = $nombre;

		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addPais(){
		$sql = "INSERT INTO pais(nombre, status) VALUES ('".htmlspecialchars($this -> nombre, ENT_QUOTES)."', 1)";
		$conexion = new conexion();
		$this -> idPais = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE pais SET orden = ".$this -> idPais." WHERE idPais = ".$this -> idPais;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updatePais(){
		$sql = "UPDATE pais SET nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."' WHERE idPais = ".$this -> idPais;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deletePais(){
		$sql = "DELETE FROM pais WHERE idPais = ".$this -> idPais;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenPais($orden){
		$sql = "UPDATE pais SET orden = ".$orden." WHERE idPais = ".$this -> idPais;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusPais($status){
		$sql = "UPDATE pais SET status = ".$status." WHERE idPais = ".$this -> idPais;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getPais(){
		$sql = "SELECT * FROM pais WHERE idPais = ".$this -> idPais;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idPais = $obj -> idPais;
		$this -> nombre = $obj -> nombre;
	}

	function listPais($pagina = 1, $busqueda = "", $_status = '', $_paginador = true){
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%') " : $palabra = '';
		($_status != '') ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM pais WHERE 1 = 1".$palabra.$status;
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
			$registro['idPais'] = $row['idPais'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$_word = strtolower($row['nombre']);
			if($_word == 'mexico' OR $_word == 'méxico' or $_word == 'mex'){
				$registro['oxxo'] = 1;
			}else{
				$registro['oxxo'] = 0;
			}
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
