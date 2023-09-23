<?php
require_once 'conexion.php';
require_once 'transporte.php';

class descuentoxproducto{
	var $idDescuento;
	var $idProducto;
	var $descuentos;
	var $productos;

	function __construct($idDescuento = 0, $idProducto = 0){
		$this -> idDescuento = $idDescuento;
		$this -> idProducto = $idProducto;
		$this -> descuentos = array();
		$this -> productos = array();
	}

	function addDescuentoxProducto(){
		$sql = "INSERT INTO descuentoxproducto (idDescuento, idProducto) VALUES(".$this -> idDescuento.", ".$this -> idProducto.")";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function existDescuentoxProducto(){
		$sql = "SELECT idDescuento FROM descuentoxproducto WHERE idProducto = ".$this -> idProducto." AND idDescuento = ".$this -> idDescuento." ";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}


	function removeDescuento(){
		$sql = "DELETE FROM descuentoxproducto WHERE idDescuento = ".$this -> idDescuento;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function removeDescuentoxProducto(){
		$sql = "DELETE FROM descuentoxproducto WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}


	function listDescuentoxProducto(){
		$sql = "SELECT idDescuento FROM descuentoxproducto WHERE idProducto = ".$this -> idProducto;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idDescuento'] = $row['idDescuento'];
			array_push($this -> descuentos, $registro);
		}
	}

	function listProductosxDescuento(){
		$sql = "SELECT idProducto FROM descuentoxproducto WHERE idDescuento = ".$this -> idDescuento;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idProducto'] = $row['idProducto'];
			array_push($this -> productos, $registro);
		}
	}

	function listNombreDescuentosxProducto(){
		$sql = "SELECT descuento.idDescuento, descuento.nombre, descuento.tipo, descuento.tipoDescuento, descuento.precioDescuento FROM descuentoxproducto, descuento, producto WHERE descuentoxproducto.idProducto = producto.idProducto AND descuento.status = 1 AND descuentoxproducto.idProducto = ".$this -> idProducto." GROUP BY descuentoxproducto.idDescuento";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idDescuento'] = $row['idDescuento'];
			$registro['nombre'] = $row['nombre'];
			$registro['tipo'] = $row['tipo'];
			$registro['tipoDescuento'] = $row['tipoDescuento'];
			$registro['precioDescuento'] = $row['precioDescuento'];
			array_push($this -> descuentos, $registro);
		}
	}

	function listNombreProductoxDescuento(){
		$sql = "SELECT datosProducto.idProducto, datosProducto.titulo FROM descuentoxproducto, datosProducto WHERE descuentoxproducto.idProducto = datosProducto.idProducto AND descuentoxproducto.idDescuento = ".$this -> idDescuento." AND datosProducto.lang = 'ES' ";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($temporal)){
			$registro['idProducto'] = $row['idProducto'];
			$registro['titulo'] = $row['titulo'];
			array_push($this -> productos, $registro);
		}
	}
}
?>
