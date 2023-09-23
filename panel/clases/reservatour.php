<?php
include_once('conexion.php');

class reservatour
{
	//<------variables generales------->
	var $idreserva;
	var $idExperiencia;
	var $pasajeros;
	var $tipoViaje;
	var $fechaLLegada;
	var $horarioLLegada;
	var $fechaSalida;
	var $horarioSalida;
	var $desde;
	var $nombre;
	var $apellido;
	var $correo;
	var $telefono;
	var $pais;
	var $ciudad;
	var $idioma;
	var $fechaReservacion;
	var $concepto;
	var $conceptoEn;
	var $aerolinea;
	var $numeroVuelo;
	var $datePrivada;
	var $horaPrivada;
	var $abordaje;
	var $tipoVuelo;
	var $tipoPrivadoEstandar;
	var $hotel;
	var $hotelSalida;
	var $inverso;

	function __construct($idreserva = 0, $idExperiencia = 0,$pasajeros = 0,$tipoViaje="",$fechaLLegada="",$horarioLLegada="",$fechaSalida="",$horarioSalida="",$desde="",$nombre="",$apellido="",$correo="",$telefono="",$pais="",$ciudad="",$idioma="",$fechaReservacion="",$concepto="",$conceptoEn="",$aerolinea="",$numeroVuelo="",$datePrivada="",$horaPrivada="",$abordaje="",$tipoVuelo="",$tipoPrivadoEstandar="",$hotel="",$hotelSalida="",$inverso="")
	{
		$this -> idreserva = $idreserva;
		$this -> idExperiencia= $idExperiencia;
		$this -> pasajeros= $pasajeros;
		$this -> tipoViaje= $tipoViaje;
		$this -> fechaLLegada= $fechaLLegada;
		$this -> horarioLLegada= $horarioLLegada;
		$this -> fechaSalida= $fechaSalida;
		$this -> horarioSalida= $horarioSalida;
		$this -> desde= $desde;
		$this -> nombre= $nombre;
		$this -> apellido= $apellido;
		$this -> correo= $correo;
		$this -> telefono= $telefono;
		$this -> pais= $pais;
		$this -> ciudad= $ciudad;
		$this -> idioma= $idioma;
		$this -> fechaReservacion= $fechaReservacion;
		$this -> concepto= $concepto;
		$this -> conceptoEn= $conceptoEn;
		$this -> aerolinea= $aerolinea;
		$this -> numeroVuelo= $numeroVuelo;
		$this -> datePrivada= $datePrivada;
		$this -> horaPrivada= $horaPrivada;
		$this -> abordaje= $abordaje;
		$this -> tipoVuelo= $tipoVuelo;
		$this -> tipoPrivadoEstandar= $tipoPrivadoEstandar;
		$this -> hotel= $hotel;
		$this -> hotelSalida= $hotelSalida;
		$this -> inverso= $inverso;
	}


	function insertareserva() {
		$sql = "insert into reservatour (idExperiencia,id_agencia,id_driver,referencia,pasajeros,tipoViaje,fechaLLegada,horarioLLegada,fechaSalida,horarioSalida,horarioPickup,id_arrivals_from,id_arrivals_to,desde,nombre,apellido,correo,telefono,pais,ciudad,idioma,fechaReservacion,concepto,conceptoEn,aerolineaLlegada,vueloLlegada,aerolinea,numeroVuelo,datePrivada,horaPrivada,abordaje,tipoVuelo,tipoPrivadoEstandar,hotel,hotelSalida,inverso,estatus,pista,observaciones)
		values (
		'".$this -> idExperiencia."',
		1,
		null,
		null,
		'".$this -> pasajeros."',
		'".$this -> tipoViaje."',
		'".$this -> fechaLLegada."',
		'".$this -> horarioLLegada."',
		'".$this -> fechaSalida."',
		'".$this -> horarioSalida."',
		null,
		null,
		null,
		'".$this -> desde."',
		'".$this -> nombre."',
		'".$this -> apellido."',
		'".$this -> correo."',
		'".$this -> telefono."',
		'".$this -> pais."',
		'".$this -> ciudad."',
		'".$this -> idioma."',
		'".$this -> fechaReservacion."',
		'".$this -> concepto."',
		'".$this -> conceptoEn."',
		null,
		null,
		'".$this -> aerolinea."',
		'".$this -> numeroVuelo."',
		'".$this -> datePrivada."',
		'".$this -> horaPrivada."',
		'".$this -> abordaje."',
		'".$this -> tipoVuelo."',
		'".$this -> tipoPrivadoEstandar."',
		'".$this -> hotel."',
		'".$this -> hotelSalida."',
		'".$this -> inverso."',
		'P',
		0,
		null
		);";
		$con = new conexion();
		$this -> idreserva = $con -> ejecutar_sentencia($sql);

	}


	function eliminareserva()
	{
		$con=new conexion();
		$sql="delete from reservatour where idreserva=".$this->idreserva.";";
		$con->ejecutar_sentencia($sql);
		$sql2="delete from ordenreserva where idreserva=".$this->idreserva." and tipo='1'";
		$con->ejecutar_sentencia($sql2);
	}



	function listareserva()
	{
		$resultados=array();
		$con=new conexion();
		$sql="select * from reservatour where manual=0 order by idreserva desc";
		$temporal=$con->ejecutar_sentencia($sql);
		while($fila= mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idreserva']=$fila['idreserva'];
			$registro['idExperiencia']=$fila['idExperiencia'];
			$registro['nombre']=$fila['nombre'];
			$registro['apellido']=$fila['apellido'];
			$registro['fechaReservacion']=$fila['fechaReservacion'];
			$registro['concepto']=$fila['concepto'];
			$registro['inverso']=$fila['inverso'];
			array_push($resultados,$registro);
		}

		mysqli_free_result($temporal);
		return($resultados);
	}

	function obtenerReservaTour(){
		$con  = new conexion();
		$sql = "select * from reservatour where idreserva=".$this->idreserva;
		$temporal = $con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
		$this->idreserva = $fila['idreserva'];
		$this -> idExperiencia= $fila['idExperiencia'];
		$this -> pasajeros= $fila['pasajeros'];
		$this -> tipoViaje= $fila['tipoViaje'];
		$this -> fechaLLegada= $fila['fechaLLegada'];
		$this -> horarioLLegada= $fila['horarioLLegada'];
		$this -> fechaSalida= $fila['fechaSalida'];
		$this -> horarioSalida= $fila['horarioSalida'];
		$this -> desde= $fila['desde'];
		$this -> nombre= $fila['nombre'];
		$this -> apellido= $fila['apellido'];
		$this -> correo= $fila['correo'];
		$this -> telefono= $fila['telefono'];
		$this -> pais= $fila['pais'];
		$this -> ciudad= $fila['ciudad'];
		$this -> idioma= $fila['idioma'];
		$this -> fechaReservacion= $fila['fechaReservacion'];
		$this -> concepto= $fila['concepto'];
		$this -> conceptoEn= $fila['conceptoEn'];
		$this -> aerolinea= $fila['aerolinea'];
		$this -> numeroVuelo= $fila['numeroVuelo'];
		$this -> datePrivada= $fila['datePrivada'];
		$this -> horaPrivada= $fila['horaPrivada'];
		$this -> abordaje= $fila['abordaje'];
		$this -> tipoVuelo= $fila['tipoVuelo'];
		$this -> tipoPrivadoEstandar= $fila['tipoPrivadoEstandar'];
		$this -> hotel= $fila['hotel'];
		$this -> hotelSalida= $fila['hotelSalida'];
		$this -> inverso= $fila['inverso'];
		}
	}

	function getReservationsCount() {
		$mysql_connection = new conexion();
		$query = "select count(*) as total from reservatour where manual=0";
		$result = $mysql_connection->ejecutar_sentencia($query);
		$values  =  mysqli_fetch_assoc($result); 
		$total_rows  =  $values['total'];
		
		return($total_rows);
	}

	function getReservationsPaged($page, $rows_per_page) {
		// Calculation pages 
		$mysql_connection = new conexion();
		$offset = ($page - 1) * $rows_per_page;

		// $query = "select * from reservatour limit ". $offset .",". $rows_per_page;
		$query = "select * from reservatour where manual=0 order by fechaReservacion desc limit ". $offset .",". $rows_per_page;
		$result = $mysql_connection->ejecutar_sentencia($query);
		$reservations = [];
		while($fila = mysqli_fetch_array($result))
		{
			$registro = [];
			$registro['idreserva'] = $fila['idreserva'];
			$registro['idExperiencia'] = $fila['idExperiencia'];
			$registro['nombre'] = $fila['nombre'];
			$registro['apellido'] = $fila['apellido'];
			$registro['fechaReservacion'] = $fila['fechaReservacion'];
			$registro['concepto'] = $fila['concepto'];
			$registro['inverso'] = $fila['inverso'];
			array_push($reservations, $registro);
		}
		mysqli_free_result($result);
		
		return($reservations);
	}


}
?>
