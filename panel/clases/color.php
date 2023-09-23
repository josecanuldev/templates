<?php
require_once 'conexion.php';
require_once 'archivo.php';

class color extends Archivo{
	var $idColor;
	var $nombre;
	var $color;
	/**
	 * valores
	 * SOLIDO || PATRON
	 */
	var $tipo;
	var $imagen;

	var $directorio = '../img/colores/';

	var $orden;
	var $status;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idColor = 0,  $nombre = '', $color = '', $tipo = '', $imagen = '', $tmp = ''){
		$this -> idColor = $idColor;
		$this -> nombre = $nombre;
		$this -> color = $color;
		$this -> tipo = $tipo;
		($imagen != '') ? $this -> imagen = $this -> obtenerExtensionArchivo($imagen) :  $this -> imagen = '';

		$this -> ruta_final = $this -> directorio;
		$this -> ruta_temporal = $tmp;

		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addColor(){
		if($this -> imagen != ''){
			$this -> subir_archivo_imagen($this -> imagen);
		}
		$sql = "INSERT INTO color(nombre, color, tipo, imagen, status) VALUES ('".htmlspecialchars($this -> nombre, ENT_QUOTES)."', '".htmlspecialchars($this -> color, ENT_QUOTES)."', '".htmlspecialchars($this -> tipo, ENT_QUOTES)."', '".htmlspecialchars($this -> imagen, ENT_QUOTES)."', 1)";
		$conexion = new conexion();
		$this -> idColor = $conexion -> ejecutar_sentencia($sql);
		if($this -> idColor != 0){
			$sqlOrden = "UPDATE color SET orden = ".$this -> idColor." WHERE idColor = ".$this -> idColor;
			$conexion -> ejecutar_sentencia($sqlOrden);
			$_success = 1;
		}else{
			$_success == 0;
		}

		return $_success;
	}

	function updateColor(){
		$_imagen = '';
		if($this -> imagen != ''){
			$this -> getRutaImagen();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> directorio;
			if($this -> subir_archivo_imagen($this -> imagen)){
				$_imagen = " imagen = '".$this -> imagen."', ";
			}
		}
		$sql = "UPDATE color SET ".$_imagen." nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', color = '".htmlspecialchars($this -> color, ENT_QUOTES)."' WHERE idColor = ".$this -> idColor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteColor(){
		$this -> getRutaImagen();
		$this -> borrar_archivo();

		$sql = "DELETE FROM color WHERE idColor = ".$this -> idColor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenColor($orden){
		$sql = "UPDATE color SET orden = ".$orden." WHERE idColor = ".$this -> idColor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusColor($status){
		$sql = "UPDATE color SET status = ".$status." WHERE idColor = ".$this -> idColor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getRutaImagen(){
		$sql = "SELECT imagen FROM color WHERE idColor = ".$this -> idColor;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> ruta_final = $this -> directorio.$obj -> imagen;
	}

	function getColor(){
		$sql = "SELECT * FROM color WHERE idColor = ".$this -> idColor;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idColor = $obj -> idColor;
		$this -> nombre = $obj -> nombre;
		$this -> color = $obj -> color;
		$this -> tipo = $obj -> tipo;
		$this -> imagen = $obj -> imagen;
	}

	function listColor($pagina = 1, $busqueda = "", $_status = '', $_paginador = true){
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%') " : $palabra = '';
		($_status != '') ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM color WHERE 1 = 1".$palabra.$status." ORDER BY orden DESC";
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
			$registro['idColor'] = $row['idColor'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['color'] = htmlspecialchars_decode($row['color']);
			$registro['tipo'] = htmlspecialchars_decode($row['tipo']);
			$registro['imagen'] = htmlspecialchars_decode($row['imagen']);
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
