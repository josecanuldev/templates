<?php

include_once('conexion.php');
include_once('herramientas.php');

class experienciaDatos {
	
	var $idExperienciaDatos;
	var $idExperiencia;
	var $nombre;
	var $subnombre;
	var $inicial;
	var $concepto;
	var $titulo;
	var $descripcion;
	var $capacidad1;
	var $capacidad2;
	var $duracion;
	var $politicas;
	var $idioma;
	var $descripcionEn;
	var $politicasEn;
	var $nombreEn;
	
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;
	
	function __construct($idExperienciaDatos = 0, $idExperiencia = 0, $nombre = '', $subnombre = '', $inicial = '', $concepto = '', $titulo = '', $descripcion = '', $capacidad1 = '', $capacidad2 = '', $duracion = '', $politicas = '', $idioma = 'en', $descripcionEn = '', $politicasEn = '', $nombreEn = '') {
		$this -> idExperienciaDatos = $idExperienciaDatos;
		$this -> idExperiencia      = $idExperiencia;
		$this -> nombre             = htmlentities($nombre, ENT_QUOTES);
		$this -> subnombre          = htmlentities($subnombre, ENT_QUOTES);
		$this -> inicial            = htmlentities($inicial, ENT_QUOTES);
		$this -> concepto            = htmlentities($concepto, ENT_QUOTES);
		$this -> titulo             = htmlentities($titulo, ENT_QUOTES);
		$this -> descripcion        = htmlentities($descripcion, ENT_QUOTES);
		$this -> capacidad1         = htmlentities($capacidad1, ENT_QUOTES);
		$this -> capacidad2         = htmlentities($capacidad2, ENT_QUOTES);
		$this -> duracion           = htmlentities($duracion, ENT_QUOTES);
		$this -> descripcionEn        = htmlentities($descripcionEn, ENT_QUOTES);
		$this -> nombreEn             = htmlentities($nombreEn, ENT_QUOTES);

		$this -> politicas          = htmlentities($politicas, ENT_QUOTES);
		$this -> politicasEn          = htmlentities($politicasEn, ENT_QUOTES);
		$this -> idioma             = $idioma;
		
		$this -> herramientas       = new herramientas();
		$this -> registrosPorPagina = 20;
	}

	/**
	 * [agregarExperienciaDatos description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarExperienciaDatos() {
		$success = 0;

		$con = new conexion();
		$sql = "INSERT experiencia_datos SET idExperiencia = {$this -> idExperiencia}, nombre = '{$this -> nombre}', subnombre = '{$this -> subnombre}', inicial = '{$this -> inicial}', concepto = '{$this -> concepto}', titulo = '{$this -> titulo}', descripcion = '{$this -> descripcion}', capacidad1 = '{$this -> capacidad1}', capacidad2 = '{$this -> capacidad2}', duracion = '{$this -> duracion}', politicas = '{$this -> politicas}', idioma = '{$this -> idioma}', descripcionEn = '{$this -> descripcionEn}', politicasEn = '{$this -> politicasEn}', nombreEn = '{$this -> nombreEn}'";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 1;

		return $success;
	}

	/**
	 * [editarExperienciaDatos description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarExperienciaDatos() {
		$success = 0;
		$con     = new conexion();
		$sql     = "UPDATE experiencia_datos SET nombre = '{$this -> nombre}', subnombre = '{$this -> subnombre}', inicial = '{$this -> inicial}', concepto = '{$this -> concepto}', titulo = '{$this -> titulo}', descripcion = '{$this -> descripcion}', capacidad1 = '{$this -> capacidad1}', capacidad2 = '{$this -> capacidad2}', duracion = '{$this -> duracion}', politicas = '{$this -> politicas}', descripcionEn = '{$this -> descripcionEn}', politicasEn = '{$this -> politicasEn}', nombreEn = '{$this -> nombreEn}', idioma = '{$this -> idioma}' WHERE idExperiencia = {$this -> idExperiencia} AND idioma LIKE '{$this -> idioma}'";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	/**
	 * [borrarExperienciaDatos description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarExperienciaDatos() {
		$success = 0; 
		$con     = new conexion();
		$sql     = "DELETE FROM experiencia_datos WHERE idExperiencia = {$this -> idExperiencia}";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [obtenerExperienciaDatos description]
	 * Actualizado 2016-11-18
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerExperienciaDatos($idioma = 'en') {
		$con  = new conexion();
		$sql  = "SELECT * FROM experiencia_datos WHERE idExperiencia = {$this -> idExperiencia} AND idioma LIKE '{$idioma}'";
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);
		
		$this -> idExperienciaDatos = $obj -> idExperienciaDatos;
		$this -> idExperiencia      = $obj -> idExperiencia;
		$this -> nombre             = htmlspecialchars_decode($obj -> nombre);
		$this -> subnombre          = htmlspecialchars_decode($obj -> subnombre);
		$this -> inicial            = htmlspecialchars_decode($obj -> inicial);
		$this -> concepto           = htmlspecialchars_decode($obj -> concepto);
		$this -> titulo             = htmlspecialchars_decode($obj -> titulo);
		$this -> descripcion        = htmlspecialchars_decode($obj -> descripcion);
		$this -> capacidad1         = htmlspecialchars_decode($obj -> capacidad1);
		$this -> capacidad2         = htmlspecialchars_decode($obj -> capacidad2);
		$this -> duracion           = htmlspecialchars_decode($obj -> duracion);
		$this -> politicas          = htmlspecialchars_decode($obj -> politicas);
		$this -> politicasEn          = htmlspecialchars_decode($obj -> politicasEn);
		$this -> descripcionEn        = htmlspecialchars_decode($obj -> descripcionEn);
		$this -> idioma             = $obj -> idioma;
		$this -> nombreEn             = htmlspecialchars_decode($obj -> nombreEn);
	}
}
?>