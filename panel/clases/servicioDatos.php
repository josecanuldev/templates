<?php

include_once('conexion.php');
include_once('herramientas.php');

class servicioDatos {
	
	var $idServicioDatos;
	var $idServicio;
	var $titulo;
	var $ubicacion;
	var $descripcion;
	var $actividades;
	var $idioma;
	
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;
	
	function __construct($idServicioDatos = 0, $idServicio = 0, $titulo = '', $ubicacion = '', $descripcion = '', $actividades = '', $idioma = 'en') {
		$this -> idServicioDatos     = $idServicioDatos;
		$this -> idServicio          = $idServicio;
		$this -> titulo             = htmlentities($titulo, ENT_QUOTES);
		$this -> ubicacion          = htmlentities($ubicacion, ENT_QUOTES);
		$this -> descripcion        = htmlentities($descripcion, ENT_QUOTES);
		$this -> actividades        = htmlentities($actividades, ENT_QUOTES);
		$this -> idioma             = $idioma;
		
		$this -> herramientas       = new herramientas();
		$this -> registrosPorPagina = 20;
	}

	/**
	 * [agregarServicioDatos description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarServicioDatos() {
		$success = 0;

		$con = new conexion();
		$sql = "INSERT servicio_datos SET idServicio = {$this -> idServicio}, titulo = '{$this -> titulo}', ubicacion = '{$this -> ubicacion}', descripcion = '{$this -> descripcion}', actividades = '{$this -> actividades}', idioma = '{$this -> idioma}'";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 1;

		return $success;
	}

	/**
	 * [editarServicioDatos description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarServicioDatos() {
		$success = 0;
		$con     = new conexion();
		$sql     = "UPDATE servicio_datos SET titulo = '{$this -> titulo}', ubicacion = '{$this -> ubicacion}', descripcion = '{$this -> descripcion}', actividades = '{$this -> actividades}', idioma = '{$this -> idioma}' WHERE idServicio = {$this -> idServicio} AND idioma LIKE '{$this -> idioma}'";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	/**
	 * [borrarServicioDatos description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarServicioDatos() {
		$success = 0; 
		$con     = new conexion();
		$sql     = "DELETE FROM servicio_datos WHERE idServicio = {$this -> idServicio}";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [obtenerServicioDatos description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerServicioDatos($idioma = 'en') {
		$con  = new conexion();
		$sql  = "SELECT * FROM servicio_datos WHERE idServicio = {$this -> idServicio} AND idioma LIKE '{$idioma}'";
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);
		
		$this -> idServicioDatos = $obj -> idServicioDatos;
		$this -> idServicio      = $obj -> idServicio;
		$this -> titulo         = htmlspecialchars_decode($obj -> titulo);
		$this -> ubicacion      = htmlspecialchars_decode($obj -> ubicacion);
		$this -> descripcion    = htmlspecialchars_decode($obj -> descripcion);
		$this -> actividades    = htmlspecialchars_decode($obj -> actividades);
		$this -> idioma         = $obj -> idioma;
	}
}
?>