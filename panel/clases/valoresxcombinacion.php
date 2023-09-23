<?php

require_once 'conexion.php';
include_once 'combinacionxgaleria.php';

class valoresxcombinacion{
	var $idCombinacion;
	var $idProducto;
	var $idTalla;
	var $idColor;
	var $idGaleria;
/**
 * Arreglos para los id
 */
	var $combinaciones;
	var $productos;
	var $tallas;
	var $colores;
	var $galerias;
	

	function __construct($idCombinacion = 0, $idProducto = 0, $idTalla = 0, $idColor = 0, $idGaleria = 0){
		$this -> idCombinacion = $idCombinacion;
		$this -> idProducto = $idProducto;
		$this -> idTalla = $idTalla;
		$this -> idColor = $idColor;
		$this -> idGaleria = $idGaleria;
		$this -> combinaciones = array();
		$this -> productos = array();
		$this -> tallas = array();
		$this -> colores = array();
		$this -> galerias = array();
	}

	function addCombinacionxValor(){
		$sql = "INSERT INTO valoresxcombinacion (idCombinacion, idProducto, idTalla, idGaleria) VALUES(".$this -> idCombinacion.", ".$this -> idProducto.", ".$this -> idTalla.", ".$this -> idGaleria.")";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function existCombinacionxValor(){
		$sql = "SELECT idCombinacion FROM valoresxcombinacion WHERE idCombinacion = ".$this -> idCombinacion." AND idProducto = ".$this -> idProducto." AND idTalla = ".$this -> idTalla." AND idGaleria = ".$this -> idGaleria." ";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}
	/* ===================================================================
	 * 		REMUEVE TODOS LOS VALORES POR EL ID DE LA COMBINACION
	 * =================================================================== */
	function removeValorxCombinacion(){
		$sql = "DELETE FROM valoresxcombinacion WHERE idCombinacion = ".$this -> idCombinacion." AND idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}
	/* ===================================================================
	 * 		REMUEVE TODOS LOS VALORES POR EL ID DEL PRODUCTO
	 * =================================================================== */
	function removeValorxProducto(){
		$sql = "DELETE FROM valoresxcombinacion WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}
	/* ===================================================================
	 * 		REMUEVE TODOS LOS VALORES POR EL ID DE LA TALLA
	 * =================================================================== */
	function removeValorxTalla(){
		$sql = "DELETE FROM valoresxcombinacion WHERE idTalla = ".$this -> idTalla;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}
	/* ===================================================================
	 * 		REMUEVE TODOS LOS VALORES POR EL ID DEL COLOR
	 * =================================================================== */
	function removeValorxColor(){
		$sql = "DELETE FROM valoresxcombinacion WHERE idColor = ".$this -> idColor;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}
	/* ===================================================================
	 * 		REMUEVE TODOS LOS VALORES POR EL ID DE LA GALERIA
	 * =================================================================== */
	function removeValorxGaleria(){
		$sql = "DELETE FROM valoresxcombinacion WHERE idGaleria = ".$this -> idGaleria;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}
	/* ===================================================================
	 * 		LISTA TODOS LOS VALORES POR EL _ID DE LA COMBINACION
	 * =================================================================== */
	function listValorxCombinacion(){
		$sql = "SELECT idCombinacion, idProducto, idTalla, idGaleria FROM valoresxcombinacion WHERE idCombinacion = ".$this -> idCombinacion;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idProducto'] = $row['idProducto'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['idColor'] = $row['idColor'];
			$registro['idGaleria'] = $row['idGaleria'];
			array_push($this -> combinaciones, $registro);
		}
	}

	/* ===================================================================
	 * 		LISTA TODOS LOS VALORES POR EL _ID DEL PRODUCTO
	 * =================================================================== */
	function listValorxProducto(){
		$sql = "SELECT idCombinacion, idProducto, idTalla, idColor, idGaleria FROM valoresxcombinacion WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idProducto'] = $row['idProducto'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['idColor'] = $row['idColor'];
			$registro['idGaleria'] = $row['idGaleria'];
			array_push($this -> productos, $registro);
		}
	}

	/* ===================================================================
	 * 		LISTA TODOS LOS VALORES POR EL _ID DE LA TALLA
	 * =================================================================== */
	function listValorxTalla(){
		$sql = "SELECT idCombinacion, idProducto, idTalla, idColor, idGaleria FROM valoresxcombinacion WHERE idTalla = ".$this -> idTalla;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idProducto'] = $row['idProducto'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['idColor'] = $row['idColor'];
			$registro['idGaleria'] = $row['idGaleria'];
			array_push($this -> tallas, $registro);
		}
	}

	/* ===================================================================
	 * 		LISTA TODOS LOS VALORES POR EL _ID DE LOS COLORES
	 * =================================================================== */
	function listColorxTalla(){
		$sql = "SELECT valoresxcombinacion.*, color.color, color.tipo, color.imagen, combinacion.stock, galeria.ruta  FROM valoresxcombinacion, combinacion, color, galeria WHERE valoresxcombinacion.idCombinacion = combinacion.idCombinacion AND valoresxcombinacion.idColor = color.idColor AND valoresxcombinacion.idGaleria = galeria.idGaleria  AND idTalla = ".$this -> idTalla." AND valoresxcombinacion.idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idProducto'] = $row['idProducto'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['idColor'] = $row['idColor'];
			$registro['_color'] = $row['color'];
			$registro['tipo'] = $row['tipo'];
			$registro['imagen'] = $row['imagen'];
			$registro['idGaleria'] = $row['idGaleria'];
			$registro['ruta'] = $row['ruta'];
			$registro['stock'] = $row['stock'];
			array_push($this -> colores, $registro);
		}
	}

	/* ===================================================================
	 * 		LISTA TODOS LOS VALORES POR EL _ID DE LA GALERIA
	 * =================================================================== */
	function listValorxGaleria(){
		$sql = "SELECT idCombinacion, idProducto, idTalla, idColor, idGaleria FROM valoresxcombinacion WHERE idGaleria = ".$this -> idGaleria;
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
		$sql = "SELECT idGaleria FROM valoresxcombinacion WHERE idCombinacion = ".$this -> idCombinacion." AND idTalla = ".$this -> idTalla." AND idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idGaleria = $obj -> idGaleria;
	}

	function listNombreValorxCombinacion(){
		$sql = "SELECT talla.idTalla, talla.nombre as tallaNombre, galeria.idGaleria, galeria.ruta, combinacion.stock, combinacion.precio, combinacion.peso, combinacion.idCombinacion 
			FROM valoresxcombinacion, talla, galeria, producto, combinacion 
			WHERE valoresxcombinacion.idTalla = talla.idTalla AND talla.status = 1 AND valoresxcombinacion.idGaleria = galeria.idGaleria AND valoresxcombinacion.idCombinacion = combinacion.idCombinacion AND valoresxcombinacion.idProducto = ".$this -> idProducto." AND combinacion.idCombinacion = ".$this -> idCombinacion." GROUP BY combinacion.idCombinacion";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['talla'] = $row['tallaNombre'];
			$registro['tipo'] = $row['tipo'];
			$registro['imagen'] = $row['imagen'];
			$registro['idGaleria'] = $row['idGaleria'];
			$registro['ruta'] = $row['ruta'];
			$registro['stock'] = $row['stock'];
			$registro['precio'] = $row['precio'];
			$registro['peso'] = $row['peso'];
			$registro['galeria'] = $this -> listarGaleriaxCombinacion($row['idCombinacion']);
			array_push($this -> productos, $registro);
		}
	}

	function listNombreValorxProducto(){
		$sql = "SELECT talla.idTalla, talla.nombre as tallaNombre, galeria.idGaleria, galeria.ruta, combinacion.stock, combinacion.precio, combinacion.peso, combinacion.idCombinacion 
			FROM valoresxcombinacion, talla, color, galeria, producto, combinacion 
			WHERE valoresxcombinacion.idTalla = talla.idTalla AND talla.status = 1 AND valoresxcombinacion.idGaleria = galeria.idGaleria AND valoresxcombinacion.idCombinacion = combinacion.idCombinacion AND valoresxcombinacion.idProducto = ".$this -> idProducto." GROUP BY combinacion.idCombinacion";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['talla'] = $row['tallaNombre'];
			$registro['tipo'] = $row['tipo'];
			$registro['imagen'] = $row['imagen'];
			$registro['idGaleria'] = $row['idGaleria'];
			$registro['ruta'] = $row['ruta'];
			$registro['stock'] = $row['stock'];
			$registro['precio'] = $row['precio'];
			$registro['peso'] = $row['peso'];
			$registro['galeria'] = $this -> listarGaleriaxCombinacion($row['idCombinacion']);
			array_push($this -> productos, $registro);
		}
	}

	function listNombreValoresxCombinacion(){
		$sql = "SELECT talla.idTalla, talla.nombre as tallaNombre, galeria.idGaleria, galeria.ruta, combinacion.stock, combinacion.precio, combinacion.peso, combinacion.idCombinacion 
			FROM valoresxcombinacion, talla, color, galeria, producto, combinacion 
			WHERE valoresxcombinacion.idTalla = talla.idTalla AND talla.status = 1 AND valoresxcombinacion.idGaleria = galeria.idGaleria AND valoresxcombinacion.idCombinacion = combinacion.idCombinacion AND valoresxcombinacion.idCombinacion = ".$this -> idCombinacion."  GROUP BY valoresxcombinacion.idCombinacion";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idTalla'] = $row['idTalla'];
			$registro['talla'] = $row['tallaNombre'];
			$registro['tipo'] = $row['tipo'];
			$registro['imagen'] = $row['imagen'];
			$registro['idGaleria'] = $row['idGaleria'];
			$registro['ruta'] = $row['ruta'];
			$registro['stock'] = $row['stock'];
			$registro['precio'] = $row['precio'];
			$registro['peso'] = $row['peso'];
			array_push($this -> combinaciones, $registro);
		}
	}

	function listTallasxProducto(){
		$sql = "SELECT talla.idTalla, talla.nombre as tallaNombre, valoresxcombinacion.idProducto FROM valoresxcombinacion, talla WHERE valoresxcombinacion.idTalla = talla.idTalla AND valoresxcombinacion.idProducto = ".$this -> idProducto." GROUP BY valoresxcombinacion.idTalla";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idTalla'] = $row['idTalla'];
			$registro['idProducto'] = $row['idProducto'];
			$registro['nombreTalla'] = $row['tallaNombre'];
			array_push($this -> tallas, $registro);
		}
	}

	function listarGaleriaxCombinacion($_idCombinacion){
		$combinacionxgaleria = new combinacionxgaleria($_idCombinacion);
		$combinacionxgaleria -> listDatosGaleriaxCombinacion();
		return $combinacionxgaleria -> galerias;
	}

}
?>