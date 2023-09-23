<?php
require_once 'conexion.php';

class categoriaxsubcategoria{
	var $idCategoria;
	var $idSubcategoria;
	var $categorias;
	var $subcategorias;

	function __construct($idCategoria = 0, $idSubcategoria = 0){
		$this -> idCategoria = $idCategoria;
		$this -> idSubcategoria = $idSubcategoria;
		$this -> categorias = array();
		$this -> subcategorias = array();
	}

	function addCategoriaxSubcategoria(){
		$sql = "INSERT INTO categoriaxsubcategoria (idCategoria, idSubcategoria) VALUES(".$this -> idCategoria.", ".$this -> idSubcategoria.")";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function existCategoriaxSubcategoria(){
		$sql = "SELECT idCategoria FROM categoriaxsubcategoria WHERE idSubcategoria = ".$this -> idSubcategoria." AND idCategoria = ".$this -> idCategoria."";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}

	function existSubcategoriaxCategoria(){
		$sql = "SELECT idSubcategoria FROM categoriaxsubcategoria WHERE idCategoria = ".$this -> idCategoria." AND idSubcategoria = ".$this -> idSubcategoria."";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}

	function removeCategoriaxSubcategoria(){
		$sql = "DELETE FROM categoriaxsubcategoria WHERE idSubcategoria = ".$this -> idSubcategoria;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function removeSubcategoriaxCategoria(){
		$sql = "DELETE FROM categoriaxsubcategoria WHERE idCategoria = ".$this -> idCategoria;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function listCategoriaxSubcategoria(){
		$sql = "SELECT idCategoria FROM categoriaxsubcategoria WHERE idSubcategoria = ".$this -> idSubcategoria;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCategoria'] = $row['idCategoria'];
			array_push($this -> categorias, $registro);
		}
	}

	function listSubcategoriaxCategoria(){
		$sql = "SELECT idSubcategoria FROM categoriaxsubcategoria WHERE idCategoria = ".$this -> idCategoria;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idSubcategoria'] = $row['idSubcategoria'];
			array_push($this -> subcategorias, $registro);
		}
	}

	function listNombreSubcategoriaxCategoria(){
		$sql = "SELECT subcategoria.idSubcategoria, subcategoria.nombre, subcategoria.ruta, subcategoria.urlAmigable FROM categoriaxsubcategoria, subcategoria WHERE categoriaxsubcategoria.idSubcategoria = subcategoria.idSubcategoria AND subcategoria.status = 1 AND idCategoria = ".$this -> idCategoria;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idSubcategoria'] = $row['idSubcategoria'];
			$registro['nombre'] = $row['nombre'];
			$registro['ruta'] = $row['ruta'];
			$registro['urlAmigable'] = $row['urlAmigable'];
			$registro['totalProducto'] = $this -> countProductosxSubcategoria($row['idSubcategoria']);
			array_push($this -> subcategorias, $registro);
		}
	}

	function countProductosxSubcategoria($idSubcategoria){
		$sql = "SELECT count(idProducto) AS total FROM producto WHERE idSubcategoria = ".$idSubcategoria;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		return $obj -> total;
	}

}
?>
