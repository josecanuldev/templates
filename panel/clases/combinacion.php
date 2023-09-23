<?php
require_once 'conexion.php';
require_once 'valoresxcombinacion.php';
require_once 'combinacionxgaleria.php';

class combinacion{
	var $idCombinacion;
	var $idProducto;
	var $stock;
	var $precio;
	var $peso;

	var $orden;
	var $status;

	function __construct($idCombinacion = 0,  $idProducto = 0, $stock = 0, $precio = 0, $peso = 0){
		$this -> idCombinacion = $idCombinacion;
		$this -> idProducto = $idProducto;
		$this -> stock = $stock;
		$this -> precio = $precio;
		$this -> peso = $peso;
	}

	function addCombinacion(){
		$sql = "INSERT INTO combinacion(idProducto, stock, status, precio, peso) VALUES (".$this -> idProducto.", ".$this -> stock.", 1, '".$this -> precio."',  '".$this -> peso."')";
		$conexion = new conexion();
		$this -> idCombinacion = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE combinacion SET orden = ".$this -> idCombinacion." WHERE idCombinacion = ".$this -> idCombinacion;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateCombinacion(){
		$sql = "UPDATE combinacion SET stock = ".$this -> stock.", precio = ".$this -> precio.", peso = ".$this -> peso." WHERE idCombinacion = ".$this -> idCombinacion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteCombinacion(){
		$sql = "DELETE FROM combinacion WHERE idCombinacion = ".$this -> idCombinacion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenCombinacion($orden){
		$sql = "UPDATE combinacion SET orden = ".$orden." WHERE idCombinacion = ".$this -> idCombinacion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusCombinacion($status){
		$sql = "UPDATE combinacion SET status = ".$status." WHERE idCombinacion = ".$this -> idCombinacion;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getCombinacion(){
		$sql = "SELECT * FROM combinacion WHERE idCombinacion = ".$this -> idCombinacion;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idCombinacion = $obj -> idCombinacion;
		$this -> idProducto = $obj -> idProducto;
		$this -> stock = $obj -> stock;
		$this -> precio = $obj -> precio;
		$this -> status = $obj -> status;
		$this -> peso = $obj -> peso;
	}

	function listCombinacion($frontEnd = false){
		($frontEnd) ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM combinacion WHERE 1 = 1 AND idProducto = ".$this -> idProducto." ".$status." ORDER BY orden ASC";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);

		$resultados = array();
		while($row = mysqli_fetch_array($temporal)){
			$registro['idCombinacion'] = $row['idCombinacion'];
			$registro['idProducto'] = htmlspecialchars_decode($row['idProducto']);
			$registro['stock'] = $row['stock'];
			$registro['status'] = $row['status'];
			$registro['orden'] = $row['orden'];
			$registro['precio'] = $row['precio'];
			$registro['peso'] = $row['peso'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function existCombinacion(){
		$sql = "SELECT idCombinacion FROM combinacion WHERE idProducto = ".$this -> idProducto." AND status = 1";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$_total = mysqli_num_rows($temporal);
		if($_total > 0) return true; else return false;
	}

	function validarStock($cantidad){
		$sql = "SELECT stock FROM combinacion WHERE idCombinacion = ".$this -> idCombinacion;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		if($cantidad > $obj -> stock) return false; else return true;
	}

	function disminuir_inventario ($cantidad){
	 	$conexion=new conexion();
	 	$sql='update combinacion set stock = stock-'.$cantidad.' where idCombinacion='.$this -> idCombinacion;
	 	$resultados=$conexion->ejecutar_sentencia($sql);
	}

	function _addValorXCombinacion($idTalla = 0, $idColor = 0, $idGaleria = 0){
		$valoresxcombinacion = new valoresxcombinacion($this -> idCombinacion, $this -> idProducto, $idTalla, $idColor, $idGaleria);
		$valoresxcombinacion -> addCombinacionxValor();
	}
	function _listNombreValorxCombinacion(){
		$valoresxcombinacion = new valoresxcombinacion($this -> idCombinacion, $this -> idProducto);
		$valoresxcombinacion -> listNombreValorxCombinacion();
		return $valoresxcombinacion -> productos;
	}
	function _listNombreValorxProducto(){
		$valoresxcombinacion = new valoresxcombinacion(0, $this -> idProducto);
		$valoresxcombinacion -> listNombreValorxProducto();
		return $valoresxcombinacion -> productos;
	}
	function _removeValorxCombinacion(){
		$valoresxcombinacion = new valoresxcombinacion($this -> idCombinacion, $this -> idProducto);
		$valoresxcombinacion -> removeValorxCombinacion();
	}
/* =======================================
 * RELACION N:N COMBINACION X GALERIA
 * ======================================= */
	function agregarCombinacioxGaleria($_idGaleria){
		$combinacionxgaleria = new combinacionxgaleria($this -> idCombinacion, $this -> idProducto, $_idGaleria);
		$combinacionxgaleria -> addCombinacionxGaleria();
	}

	function removerGaleriaxCombinacion(){
		$combinacionxgaleria = new combinacionxgaleria($this -> idCombinacion, $this -> idProducto);
		$combinacionxgaleria -> removeValorxCombinacion();
	}

}
?>
