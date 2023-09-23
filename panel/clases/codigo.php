<?php
include_once('conexion.php');
class codigo

{
	var $idCodigo;
	var $codigo;
	var $fechaInicio;
	var $fechaTermino;
	var $codigoUsuario;
	var $tipoDescuento;
	var $valor;
	var $tipoCodigo;
	var $limite;
	var $descripcionEs;
	var $descripcionEn;
	var $status;

	function __construct($idCodigo = 0,$codigo = '',$fechaInicio = '',$fechaTermino = '',$codigoUsuario = 0,$tipoDescuento = 0,$valor = 0,$tipoCodigo = 0,$limite = 0,$descripcionEs = '',$descripcionEn = '',$status = 0)
	{
		$this->idCodigo=$idCodigo;
		$this->codigo=$codigo;
		$this->codigoUsuario=$codigoUsuario;
		$this->tipoDescuento=$tipoDescuento;
		$this->valor=$valor;
		$this->tipoCodigo=$tipoCodigo;
		$this->limite=$limite;
		$this->descripcionEs=$descripcionEs;
		$this->descripcionEn=$descripcionEn;
		$this->status=$status;
		$this -> fechar = str_replace('/', '-', $fechaInicio);
        $this -> fechaInicio= date('Y-m-d', strtotime($this->fechar));
		$this -> fechar2 = str_replace('/', '-', $fechaTermino);
        $this -> fechaTermino= date('Y-m-d', strtotime($this->fechar2));
	}



	function insertacodigo()
	{

		$sql = "insert into codigo (codigo,fechaInicio,fechaTermino,codigoUsuario,tipoDescuento,valor,tipoCodigo,limite,descripcionEs,descripcionEn,status) values ('".$this->codigo."','".$this->fechaInicio."','".$this->fechaTermino."','".$this->codigoUsuario."','".$this->tipoDescuento."','".$this->valor."','".$this->tipoCodigo."','".$this->limite."','".htmlspecialchars($this->descripcionEs,ENT_QUOTES)."','".htmlspecialchars($this->descripcionEn,ENT_QUOTES)."',1);";
		$con = new conexion();
		$this -> idCodigo = $con->ejecutar_sentencia($sql);
	}


	function modificacodigo()
	{

		$sql="update codigo set codigo='".$this->codigo."', fechaInicio='".$this->fechaInicio."', fechaTermino='".$this->fechaTermino."', codigoUsuario='".$this->codigoUsuario."', tipoDescuento='".$this->tipoDescuento."', valor='".$this->valor."', tipoCodigo='".$this->tipoCodigo."', limite='".$this->limite."', descripcionEs = '".htmlspecialchars($this->descripcionEs, ENT_QUOTES)."', descripcionEn = '".htmlspecialchars($this->descripcionEn, ENT_QUOTES)."', status=".$this->status." where idCodigo=".$this->idCodigo.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);

	}


	function Desactivacodigo()
		{
			$con=new conexion();
			$sql="update codigo set status=0 where idCodigo=".$this->idCodigo;
			//echo $sql;
			$con->ejecutar_sentencia($sql);
		}

	function activacodigo()
		{
			$con=new conexion();
			$sql="update codigo set status=1 where idCodigo=".$this->idCodigo;
			//echo $sql;
			$con->ejecutar_sentencia($sql);
		}

	function eliminacodigo()
	{

		$sql="delete from codigo where idCodigo=".$this->idCodigo.";";
		$con= new conexion();
		$con->ejecutar_sentencia($sql);
	}

	function obtenercodigo()
	{
		$sql="select * from codigo where idCodigo=".$this->idCodigo.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);

		while ($fila=mysqli_fetch_array($resultados))
		{
			$this->idCodigo=$fila['idCodigo'];
			$this->codigo=$fila['codigo'];
			$this->codigoUsuario=$fila['codigoUsuario'];
			$this->tipoDescuento=$fila['tipoDescuento'];
			$this->valor=$fila['valor'];
			$this->tipoCodigo=$fila['tipoCodigo'];
			$this->limite=$fila['limite'];
			$this->descripcionEs=$fila['descripcionEs'];
			$this->descripcionEn=$fila['descripcionEn'];
			$this->status=$fila['status'];
			$this->fechaInicio=$fila['fechaInicio'];
			$this->fechaTermino=$fila['fechaTermino'];
		}
	}

	function obtenercodigoxcodigo($codigo,$tipoCodigo)
	{
		$sql="select * from codigo where codigo='".$codigo."' and tipoCodigo='".$tipoCodigo."';";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);

		while ($fila=mysqli_fetch_array($resultados))
		{
			$this->idCodigo=$fila['idCodigo'];
			$this->codigo=$fila['codigo'];
			$this->codigoUsuario=$fila['codigoUsuario'];
			$this->tipoDescuento=$fila['tipoDescuento'];
			$this->valor=$fila['valor'];
			$this->tipoCodigo=$fila['tipoCodigo'];
			$this->limite=$fila['limite'];
			$this->descripcionEs=$fila['descripcionEs'];
			$this->descripcionEn=$fila['descripcionEn'];
			$this->status=$fila['status'];
			$this->fechaInicio=$fila['fechaInicio'];
			$this->fechaTermino=$fila['fechaTermino'];
		}
	}

	function listarcodigo()
	{
		$resultados=array();
		$sql="select * from codigo order by idCodigo DESC";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idCodigo']=$fila['idCodigo'];
			$registro['codigo']=$fila['codigo'];
			$registro['codigoUsuario']=$fila['codigoUsuario'];
			$registro['tipoDescuento']=$fila['tipoDescuento'];
			$registro['valor']=$fila['valor'];
			$registro['tipoCodigo']=$fila['tipoCodigo'];
			$registro['limite']=$fila['limite'];
			$registro['descripcionEs']=$fila['descripcionEs'];
			$registro['descripcionEn']=$fila['descripcionEn'];
			$registro['status']=$fila['status'];
			$registro['fechaInicio']=$fila['fechaInicio'];
			$registro['fechaTermino']=$fila['fechaTermino'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function existencia($codigo,$tipoCodigo)
	{
		$conexion=new conexion();
		$sql="SELECT codigo FROM codigo where codigo='".$codigo."' and tipoCodigo='".$tipoCodigo."'";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > 0){
			return true;
		}
		else{
			return false;
		}
	}
}
?>
