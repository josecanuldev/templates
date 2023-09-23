<?php
require_once 'conexion.php';
require_once 'empleo.php';
require_once 'herramientas.php';
require_once 'archivo.php';

class aspirante extends Archivo{
	var $idAspirante;
	var $idEmpleo;
	var $nombre;
	var $apellido;
	var $correo;
	var $telefono;
	var $estado;
	var $ciudad;
	var $curriculum;

	var $nombreEmpleo;

	var $directorio = 'curriculums/';
	var $orden;
	var $status;

	var $herramientas;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idAspirante = 0, $idEmpleo = 0, $nombre = '', $apellido = '', $correo = '', $telefono = '', $estado = '', $ciudad = '', $curriculum = '', $tmp = ''){
		$this -> idAspirante = $idAspirante;
		$this -> idEmpleo = $idEmpleo;
		$this -> nombre = $nombre;
		$this -> apellido = $apellido;
		$this -> correo = $correo;
		$this -> telefono = $telefono;
		$this -> estado = $estado;
		$this -> ciudad = $ciudad;
		($curriculum != '') ? $this -> curriculum = $this -> obtenerExtensionArchivo($curriculum, $nombre) : $this -> curriculum = '';

		$this -> ruta_final = $this -> directorio.$this -> curriculum;
		$this -> ruta_temporal = $tmp;

		$this -> herramientas = new herramientas();

		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addAspirante(){
		$sql = "INSERT INTO aspirante(idEmpleo, nombre, apellido, correo, telefono, estado, ciudad, curriculum, status) VALUES (".$this -> idEmpleo.", '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', '".htmlspecialchars($this -> apellido, ENT_QUOTES)."', '".htmlspecialchars($this -> correo, ENT_QUOTES)."', '".htmlspecialchars($this -> telefono, ENT_QUOTES)."', '".htmlspecialchars($this -> estado, ENT_QUOTES)."', '".htmlspecialchars($this -> ciudad, ENT_QUOTES)."', '".$this -> curriculum."', 1)";
		$conexion = new conexion();
		$this -> idAspirante = $conexion -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
		$sqlOrden = "UPDATE aspirante SET orden = ".$this -> idEmpleo." WHERE idAspirante = ".$this -> idEmpleo;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateAspirante(){
		if($this -> curriculum != ''){
			$this -> getRutaArchivo();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> directorio.$this -> curriculum;
			$rutaPedazo = " curriculum = '".$this -> curriculum."', ";
			$this -> subir_archivo();
		}else{
			$rutaPedazo = '';
		}

		$sql = "UPDATE aspirante SET nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', ".$rutaPedazo." apellido = '".htmlspecialchars($this -> apellido, ENT_QUOTES)."', correo = '".htmlspecialchars($this -> correo, ENT_QUOTES)."', telefono = '".htmlspecialchars($this -> telefono, ENT_QUOTES)."', estado = '".htmlspecialchars($this -> estado, ENT_QUOTES)."', ciudad =  '".htmlspecialchars($this -> ciudad, ENT_QUOTES)."' WHERE idAspirante = ".$this -> idAspirante;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteAspirante(){
		$this -> getRutaArchivo();
		$this -> borrar_archivo();

		$sql = "DELETE FROM aspirante WHERE idAspirante = ".$this -> idAspirante;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenAspirante($orden){
		$sql = "UPDATE aspirante SET orden = ".$orden." WHERE idAspirante = ".$this -> idAspirante;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusAspirante($status){
		$sql = "UPDATE aspirante SET status = ".$status." WHERE idAspirante = ".$this -> idAspirante;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getRutaArchivo(){
		$sql = "SELECT curriculum FROM aspirante WHERE idAspirante = ".$this -> idAspirante;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> ruta_final = '../'.$this -> directorio.$obj -> curriculum;
	}

	function getAspirante(){
		$sql = "SELECT * FROM aspirante WHERE idAspirante = ".$this -> idAspirante;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idAspirante = $obj -> idAspirante;
		$this -> idEmpleo = $obj -> idEmpleo;
		$this -> nombre = htmlspecialchars_decode($obj -> nombre);
		$this -> apellido = htmlspecialchars_decode($obj -> apellido);
		$this -> correo = htmlspecialchars_decode($obj -> correo);
		$this -> telefono = htmlspecialchars_decode($obj -> telefono);
		$this -> estado = htmlspecialchars_decode($obj -> estado);
		$this -> ciudad = htmlspecialchars_decode($obj -> ciudad);
		$this -> curriculum = $obj -> curriculum;
		$empleo = new empleo($obj -> idEmpleo);
		$empleo -> getEmpleo();
		$this -> nombreEmpleo = $empleo -> titulo;
	}

	function listAspirante($pagina = 1, $idEmpleo = 0, $busqueda = "", $frontEnd = false){
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%' OR apellido LIKE '%".$busqueda."%' OR correo LIKE '%".$busqueda."%' OR telefono LIKE '%".$busqueda."%') " : $palabra = '';
		($idEmpleo != 0) ? $filtroEmpleo = " AND idEmpleo = ".$idEmpleo." " : $filtroEmpleo = '';
		($fronEnd) ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM aspirante WHERE 1 = 1".$filtroEmpleo.$palabra.$status;
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
			$registro['idAspirante'] = $row['idAspirante'];
			$registro['idEmpleo'] = $row['idEmpleo'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['apellido'] = htmlspecialchars_decode($row['apellido']);
			$registro['correo'] = htmlspecialchars_decode($row['correo']);
			$registro['telefono'] = htmlspecialchars_decode($row['telefono']);
			$registro['estado'] = htmlspecialchars_decode($row['estado']);
			$registro['ciudad'] = htmlspecialchars_decode($row['ciudad']);
			$registro['curriculum'] = $row['curriculum'];
			$registro['status'] = $row['status'];
			$registro['orden'] = $row['orden'];
			$empleo = new empleo($row['idEmpleo']);
			$empleo -> getEmpleo();
			$registro['puesto'] = $empleo -> titulo;
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
}
?>
