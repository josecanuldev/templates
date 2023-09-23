<?php
require_once 'conexion.php';

class combinacionxgaleria{
	var $idCombinacion;
	var $idProducto;
	var $idTalla;
/**
 * Arreglos para los id
 */
	var $combinaciones;
	var $productos;
	var $galerias;


	function __construct($idCombinacion = 0, $idProducto = 0, $idGaleria = 0){
		$this -> idCombinacion = $idCombinacion;
		$this -> idProducto = $idProducto;
		$this -> idGaleria = $idGaleria;
		$this -> combinaciones = array();
		$this -> productos = array();
		$this -> galerias = array();
	}

	function addCombinacionxGaleria(){
		$sql = "INSERT INTO combinacionxgaleria (idCombinacion, idProducto, idGaleria) VALUES(".$this -> idCombinacion.", ".$this -> idProducto.", ".$this -> idGaleria.")";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function existCombinacionxValor(){
		$sql = "SELECT idCombinacion FROM combinacionxgaleria WHERE idCombinacion = ".$this -> idCombinacion." AND idProducto = ".$this -> idProducto." AND idGaleria = ".$this -> idGaleria." ";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}
	/* ===================================================================
	 * 		REMUEVE TODOS LOS VALORES POR EL ID DE LA COMBINACION
	 * =================================================================== */
	function removeValorxCombinacion(){
		$sql = "DELETE FROM combinacionxgaleria WHERE idCombinacion = ".$this -> idCombinacion." AND idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}
	/* ===================================================================
	 * 		REMUEVE TODOS LOS VALORES POR EL ID DEL PRODUCTO
	 * =================================================================== */
	function removeValorxProducto(){
		$sql = "DELETE FROM combinacionxgaleria WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}
	/* ===================================================================
	 * 		REMUEVE TODOS LOS VALORES POR EL ID DE LA GALERIA
	 * =================================================================== */
	function removeValorxGaleria(){
		$sql = "DELETE FROM combinacionxgaleria WHERE idGaleria = ".$this -> idGaleria;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}
	/* ===================================================================
	 * 		LISTA TODOS LOS VALORES POR EL _ID DE LA COMBINACION
	 * =================================================================== */
	function listValorxCombinacion(){
		$sql = "SELECT idCombinacion, idProducto, idGaleria FROM combinacionxgaleria WHERE idCombinacion = ".$this -> idCombinacion;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idProducto'] = $row['idProducto'];
			$registro['idGaleria'] = $row['idGaleria'];
			array_push($this -> combinaciones, $registro);
		}
	}

	/* ===================================================================
	 * 		LISTA TODOS LOS VALORES POR EL _ID DEL PRODUCTO
	 * =================================================================== */
	function listValorxProducto(){
		$sql = "SELECT idCombinacion, idProducto, idGaleria FROM combinacionxgaleria WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idProducto'] = $row['idProducto'];
			$registro['idGaleria'] = $row['idGaleria'];
			array_push($this -> productos, $registro);
		}
	}


	/* ===================================================================
	 * 		LISTA TODOS LOS VALORES POR EL _ID DE LA GALERIA
	 * =================================================================== */
	function listValorxGaleria(){
		$sql = "SELECT idCombinacion, idProducto, idTalla, idColor, idGaleria FROM combinacionxgaleria WHERE idGaleria = ".$this -> idGaleria;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idProducto'] = $row['idProducto'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['idColor'] = $row['idColor'];
			$registro['idGaleria'] = $row['idGaleria'];
			array_push($this -> galeria, $registro);
		}
	}

	function getValorxAtributo(){
		$sql = "SELECT idGaleria FROM combinacionxgaleria WHERE idCombinacion = ".$this -> idCombinacion." AND idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idGaleria = $obj -> idGaleria;
	}

	function listDatosGaleriaxCombinacion(){
		$sql = "SELECT galeria.idGaleria, galeria.ruta, combinacionxgaleria.idCombinacion
			FROM combinacionxgaleria, galeria
			WHERE combinacionxgaleria.idGaleria = galeria.idGaleria AND combinacionxgaleria.idCombinacion = ".$this -> idCombinacion." ORDER BY galeria.orden DESC";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			//$registro['imagen'] = $row['imagen'];
			$registro['idGaleria'] = $row['idGaleria'];
			$registro['ruta'] = $row['ruta'];
			array_push($this -> galerias, $registro);
		}
	}

	function listNombreValorxProducto(){
		$sql = "SELECT talla.idTalla, talla.nombre as tallaNombre, color.idColor, color.nombre as colorNombre, color.color, color.tipo, color.imagen, galeria.idGaleria, galeria.ruta, combinacion.stock, combinacion.idCombinacion
			FROM combinacionxgaleria, talla, color, galeria, producto, combinacion
			WHERE combinacionxgaleria.idTalla = talla.idTalla AND talla.status = 1 AND combinacionxgaleria.idColor = color.idColor AND color.status = 1 AND combinacionxgaleria.idGaleria = galeria.idGaleria AND combinacionxgaleria.idCombinacion = combinacion.idCombinacion AND combinacionxgaleria.idProducto = ".$this -> idProducto." GROUP BY combinacion.idCombinacion";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['talla'] = $row['tallaNombre'];
			$registro['idColor'] = $row['idColor'];
			$registro['colorNombre'] = $row['colorNombre'];
			$registro['color'] = $row['color'];
			$registro['tipo'] = $row['tipo'];
			$registro['imagen'] = $row['imagen'];
			$registro['idGaleria'] = $row['idGaleria'];
			$registro['ruta'] = $row['ruta'];
			$registro['stock'] = $row['stock'];
			array_push($this -> productos, $registro);
		}
	}

	function listNombrecombinacionxgaleria(){
		$sql = "SELECT talla.idTalla, talla.nombre as tallaNombre, color.idColor, color.nombre as colorNombre, color.color, color.tipo, color.imagen, galeria.idGaleria, galeria.ruta, combinacion.stock, combinacion.idCombinacion
			FROM combinacionxgaleria, talla, color, galeria, producto, combinacion
			WHERE combinacionxgaleria.idTalla = talla.idTalla AND talla.status = 1 AND combinacionxgaleria.idColor = color.idColor AND color.status = 1 AND combinacionxgaleria.idGaleria = galeria.idGaleria AND combinacionxgaleria.idCombinacion = combinacion.idCombinacion AND combinacionxgaleria.idCombinacion = ".$this -> idCombinacion."  GROUP BY combinacionxgaleria.idCombinacion";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['talla'] = $row['tallaNombre'];
			$registro['idColor'] = $row['idColor'];
			$registro['colorNombre'] = $row['colorNombre'];
			$registro['color'] = $row['color'];
			$registro['tipo'] = $row['tipo'];
			$registro['imagen'] = $row['imagen'];
			$registro['idGaleria'] = $row['idGaleria'];
			$registro['ruta'] = $row['ruta'];
			$registro['stock'] = $row['stock'];
			array_push($this -> combinaciones, $registro);
		}
	}

	function listTallasxProducto(){
		$sql = "SELECT talla.idTalla, talla.nombre as tallaNombre, combinacionxgaleria.idProducto FROM combinacionxgaleria, talla WHERE combinacionxgaleria.idTalla = talla.idTalla AND combinacionxgaleria.idProducto = ".$this -> idProducto." GROUP BY combinacionxgaleria.idTalla";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idTalla'] = $row['idTalla'];
			$registro['idProducto'] = $row['idProducto'];
			$registro['nombreTalla'] = $row['tallaNombre'];
			array_push($this -> tallas, $registro);
		}
	}

}
?>
