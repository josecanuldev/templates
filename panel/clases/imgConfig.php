<?php
include_once('conexion.php');

class imgConfig
{
	  var $idconfiguracion;
	  var $alto;
	  var $ancho;
	  var $calidad;
	  var $prefijo;
	  
	  
	  function __construct($idc=1,$alto='',$ancho='',$calidad='',$prefijo = '')
	  {
		  $this->idconfiguracion=$idc;
		  $this->alto=$alto;
		  $this->ancho=$ancho;
		  $this->calidad=$calidad;
		  $this->prefijo = $prefijo;
	  }
	  
	  function insertarimgconfig()
	  {
		  $sql="insert into imgconfig(alto,ancho,calidad,prefijo) values ('".$this->alto."','".$this->ancho."','".$this->calidad."','".htmlspecialchars($this->prefijo, ENT_QUOTES)."');";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
		  //echo $sql;
	  }
	  
	  function modificarimgconfig()
	  {
		  $sql="update imgconfig set alto='".$this->alto."',ancho='".$this->ancho."',calidad='".$this->calidad."', prefijo = '".htmlspecialchars($this->prefijo, ENT_QUOTES)."' where idconfiguracion=".$this->idconfiguracion.";";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
	  }

	function obtenerimgconfig()
	{
	  $sql="select * from imgconfig where idconfiguracion=".$this->idconfiguracion.";";
	  $con=new conexion();
	  $resultados=$con->ejecutar_sentencia($sql);
	  while ($fila=mysqli_fetch_array($resultados))
	  {
		$this->idconfiguracion=$fila['idconfiguracion'];
		$this->altomaximo=$fila['alto'];
		$this->anchomaximo=$fila['ancho'];
		$this->calidad=$fila['calidad'];
		$this->prefijo = $fila['prefijo'];
	  }
	  mysqli_free_result($resultados);
	}
	
	function listarimgconfig() {
		$resultados = array();
		$sql = "select * from imgconfig";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idconfiguracion'] = $fila['idconfiguracion'];
			$registro['altomaximo'] = $fila['alto'];
			$registro['anchomaximo'] = $fila['ancho'];
			$registro['calidad'] = $fila['calidad'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

}
?>