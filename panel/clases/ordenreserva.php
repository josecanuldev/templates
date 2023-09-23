<?php
include_once('conexion.php');

class ordenreserva
{
	var $idorden;
	var $idreserva;
	var $subtotal;
	var $total;
	var $status;
	var $tipo;
	var $descuento;
	var $idCodigoPromo;

	function __construct($idorden = 0, $idreserva = 0, $subtotal = '', $total = '', $status = '', $tipo = '', $descuento = '', $idCodigoPromo=0)
	{
		$this -> idorden = $idorden;
		$this -> idreserva = $idreserva;
		$this -> subtotal = $subtotal;
		$this -> total = $total;
		$this -> status = $status;
		$this -> tipo = $tipo;
		$this -> descuento = $descuento;
		$this -> idCodigoPromo = $idCodigoPromo;
	}

	function insertarorden(){
		$con=new conexion();
		$sql="insert into ordenreserva(idreserva,subtotal,total,status,tipo,descuento,idCodigoPromo) values
		(".$this -> idreserva.",
		'".$this -> subtotal."',
		'".$this -> total."',
		'".$this -> status."',
		'".$this -> tipo."',
		'".$this -> descuento."',
		'".$this -> idCodigoPromo."'
		)";
		$this -> idorden = $con->ejecutar_sentencia($sql);
	}


	function modificarStatusOrden(){
		$con = new conexion();
		$sql = "update ordenreserva set status = '".$this->status."' where idorden =".$this->idorden;
		$con -> ejecutar_sentencia($sql);
	}

	function eliminaordenReserva()
	{
		$con=new conexion();
		$sql="delete from ordenreserva where idorden=".$this->idorden.";";
		$con->ejecutar_sentencia($sql);
	}
	function eliminaordenReservaList()
	{
		$con=new conexion();
		$sql="delete from ordenreserva where idreserva=".$this->idreserva."";
		$con->ejecutar_sentencia($sql);
	}
	function eliminaordenReservaList2()
	{
		$con=new conexion();
		$sql="delete from ordenreserva where idreserva=".$this->idreserva."";
		$con->ejecutar_sentencia($sql);
	}



	function obtenerOrdenReserva(){
		$con = new conexion();
		$sql = "select * from ordenreserva where idreserva = ".$this -> idreserva."";
		$temporal = $con -> ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($temporal)){
			$this -> idorden = $fila['idorden'];
			$this -> idreserva = $fila['idreserva'];
			$this -> subtotal = $fila['subtotal'];
			$this -> total = $fila['total'];
			$this -> status = $fila['status'];
			$this -> tipo = $fila['tipo'];
			$this -> descuento = $fila['descuento'];
			$this -> idCodigoPromo = $fila['idCodigoPromo'];
		}
	}

	function obtenerOrden(){
		$con = new conexion();
		$sql = "select * from ordenreserva where idorden = ".$this -> idorden."";
		$temporal = $con -> ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($temporal)){
			$this -> idorden = $fila['idorden'];
			$this -> idreserva = $fila['idreserva'];
			$this -> subtotal = $fila['subtotal'];
			$this -> total = $fila['total'];
			$this -> status = $fila['status'];
			$this -> tipo = $fila['tipo'];
			$this -> descuento = $fila['descuento'];
			$this -> idCodigoPromo = $fila['idCodigoPromo'];
		}
	}

	function obtenerOrdenReserva2(){
		$con = new conexion();
		$sql = "select * from ordenreserva where idreserva = ".$this -> idreserva."";
		$temporal = $con -> ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($temporal)){
			$this -> idorden = $fila['idorden'];
			$this -> idreserva = $fila['idreserva'];
			$this -> subtotal = $fila['subtotal'];
			$this -> total = $fila['total'];
			$this -> status = $fila['status'];
			$this -> tipo = $fila['tipo'];
			$this -> descuento = $fila['descuento'];
			$this -> idCodigoPromo = $fila['idCodigoPromo'];
		}
	}

}
?>
