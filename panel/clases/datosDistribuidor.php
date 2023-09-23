<?php
require_once 'conexion.php';
require_once 'datosDistribuidor.php';

class datosDistribuidor{
	var $idDatosDistribuidor;
	var $idDistribuidor;
	var $nombre;
	var $descripcion;

	var $orden;
	var $status;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idDatosDistribuidor = 0, $idDistribuidor = 0,  $nombre = '', $descripcion = ''){
		$this -> idDatosDistribuidor = $idDatosDistribuidor;
		$this -> idDistribuidor = $idDistribuidor;
		$this -> nombre = $nombre;
		$this -> descripcion = $descripcion;

		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addDatosDistribuidor(){
		$sql = "INSERT INTO datosDistribuidor(idDistribuidor, nombre, descripcion, status) VALUES (".$this -> idDistribuidor.", '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', '".htmlspecialchars($this -> descripcion, ENT_QUOTES)."', 1)";
		$conexion = new conexion();
		$this -> idDistribuidor = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE datosDistribuidor SET orden = ".$this -> idDatosDistribuidor." WHERE idDatosDistribuidor = ".$this -> idDatosDistribuidor;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateDatosDistribuidor(){
		$sql = "UPDATE datosDistribuidor SET nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', descripcion = '".htmlspecialchars($this -> descripcion, ENT_QUOTES)."' WHERE idDatosDistribuidor = ".$this -> idDatosDistribuidor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteDatosDistribuidor($all  = false){
		($all) ? $sql = "DELETE FROM datosDistribuidor WHERE idDistribuidor = ".$this -> idDistribuidor : $sql = "DELETE FROM datosDistribuidor WHERE idDatosDistribuidor = ".$this -> idDatosDistribuidor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenDatosDistribuidor($orden){
		$sql = "UPDATE datosDistribuidor SET orden = ".$orden." WHERE idDatosDistribuidor = ".$this -> idDatosDistribuidor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusDatosDistribuidor($status){
		$sql = "UPDATE datosDistribuidor SET status = ".$status." WHERE idDatosDistribuidor = ".$this -> idDatosDistribuidor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getDatosDistribuidor(){
		$sql = "SELECT * FROM datosDistribuidor WHERE idDatosDistribuidor = ".$this -> idDatosDistribuidor;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idDistribuidor = $obj -> idDistribuidor;
		$this -> nombre = $obj -> nombre;
		$this -> descripcion = htmlspecialchars_decode($obj -> descripcion);
	}

	function listDatosDistribuidor($pagina = 1, $busqueda = "", $_status = '', $_paginador = true){
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%') " : $palabra = '';
		($_status != '') ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM datosDistribuidor WHERE idDistribuidor =  ".$this -> idDistribuidor." ".$palabra.$status;
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
			$registro['idDatosDistribuidor'] = $row['idDatosDistribuidor'];
			$registro['idDistribuidor'] = $row['idDistribuidor'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['descripcion'] = htmlspecialchars_decode($row['descripcion']);
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
