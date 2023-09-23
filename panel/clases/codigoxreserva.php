<?php
include_once('conexion.php');
class codigoxreserva

{
	var $codigo;
	var $correo;
	var $idOrden;
	var $tipo;
	var $monto;

	function __construct($codigo = 0,$correo = '',$idOrden = 0,$tipo = 0,$monto=0)
	{
		$this->codigo=$codigo;
		$this->correo=$correo;
		$this->idOrden=$idOrden;
		$this->tipo=$tipo;
		$this->monto=$monto;
	}



	function insertacodigoxreserva()
	{

		$sql = "insert into codigoxreserva (codigo,correo,idOrden,tipo,monto) values ('".$this->codigo."','".$this->correo."','".$this->idOrden."','".$this->tipo."','".$this->monto."');";
		$con = new conexion();
		$this -> idCodigoxReserva = $con->ejecutar_sentencia($sql);
	}


	function eliminacodigoxreserva()
	{

		$sql="delete from codigoxreserva where codigo=".$this->codigo.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}


	function obtenercodigoxreserva($idOrden,$tipo)
	{
		$sql="select * from codigoxreserva where idOrden=".$idOrden." and tipo='".$tipo."';";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);

		while ($fila=mysqli_fetch_array($resultados))
		{
			$this->idCodigoxReserva=$fila['idCodigoxReserva'];
			$this->codigo=$fila['codigo'];
			$this->correo=$fila['correo'];
			$this->idOrden=$fila['idOrden'];
			$this->tipo=$fila['tipo'];
			$this->monto=$fila['monto'];
		}
	}

	function codigoUsuario($codigo,$correo,$numero,$tipoCodigo)
	{
		$conexion=new conexion();
		$sql="SELECT * FROM codigoxreserva where codigo='".$codigo."' and correo='".$correo."' and tipo='".$tipoCodigo."'";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados >= $numero){
			return false;
		}
		else{
			return true;
		}
	}

	function limite($codigo,$numero,$tipoCodigo)
	{
		$conexion=new conexion();
		$sql="SELECT * FROM codigoxreserva where codigo='".$codigo."' and tipo='".$tipoCodigo."'";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > $numero){
			return false;
		}
		else{
			return true;
		}
	}
}
?>
