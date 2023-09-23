<?php
class carrito{

	var $productos;
	var $peso;
	var $cantidadTotal = 0;
	var $importeTotal = 0;
	var $status = 0;

	function __construct(){
		if(isset($_SESSION['carrito'])){
			$this -> productos = $_SESSION['carrito'];
		}else{
			$this -> productos = array();
			$_SESSION['carrito'] = array();
		}
	}

	function guardarCarro(){
		$_SESSION['carrito'] = $this -> productos;
	}

	function agregarProducto($idProducto = 0, $idCombinacion = 0, $cantidad = 0, $precio = 0, $peso = 0, $status = 0){
		$bandera = 0;

		foreach($this -> productos as $elemento){
			if($elemento[0] == $idProducto and $elemento[1] == $idCombinacion)
				$bandera = 1;
		}

		if($bandera == 0){
			$pesoFinal = $peso * $cantidad;
			array_push($this -> productos, array($idProducto, $idCombinacion, $cantidad, $precio, $pesoFinal, $status));
			$this -> guardarCarro();
		}
	}

	function modificarProducto($idProducto = 0, $idCombinacion = 0, $cantidad = 0, $precio = 0, $peso = 0, $status = 0){
		for($i = 0; $i < count($this -> productos); $i++){
			if($this -> productos[$i][0] == $idProducto and $this -> productos[$i][1] == $idCombinacion){
				$this -> productos[$i][1] = $idCombinacion;
				$this -> productos[$i][2] = $cantidad;
				$this -> productos[$i][3] = $precio;
				$this -> productos[$i][4] = $peso * $cantidad;
				$this -> productos[$i][5] = $status;

				$this -> guardarCarro();
				break;
			}
		}
	}

	function eliminarProducto($idProducto = 0, $idCombinacion = 0){
		$bandera = -1;
		$i = 0;
		foreach($this -> productos as $elemento){
			if($elemento[0] == $idProducto and $elemento[1] == $idCombinacion)
				$bandera = $i;
			$i++;
		}

		if($bandera != -1){
			array_splice($this -> productos, $bandera, 1);
	    }
	    $this -> guardarCarro();
	}

	function obtenerTotales(){
		$num = 0;
		$importe = 0;
		for ($i = 0; $i < count($this -> productos); $i++){
			$peso = $peso + $this -> productos[$i][4];
			$num = $num + $this -> productos[$i][2];
			$importe = $importe + ($this -> productos[$i][2] * $this -> productos[$i][3]);
			$this -> peso = $peso;
			$this -> cantidadTotal = $num;
			$this -> importeTotal = $importe;
		}

	}
}
?>
