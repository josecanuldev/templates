<?php

include_once('conexion.php');
include_once('herramientas.php');

class ubicacion {
	
	var $idUbicacion;
	var $nombre;
	var $idioma;
	var $status;
	var $orden;
	
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;
	
	function __construct($idUbicacion = 0, $nombre = '', $idioma = 'en') {
		$this -> idUbicacion        = $idUbicacion;
		$this -> nombre             = htmlentities($nombre, ENT_QUOTES);
		$this -> idioma             = $idioma;
		
		$this -> herramientas       = new herramientas();
		$this -> registrosPorPagina = 20;
	}

	/**
	 * [agregarUbicacion description]
	 * Actualizado 2016-11-24
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarUbicacion() {
		$success = 0;

		$con = new conexion();
		$sql = "INSERT ubicacion SET nombre = '{$this -> nombre}', idioma = '{$this -> idioma}'";
		
		$this -> idUbicacion = $con -> ejecutar_sentencia($sql);

		if ($this -> idUbicacion > 0) {
			$sql2 = "UPDATE ubicacion SET orden = {$this -> idUbicacion} WHERE idUbicacion = {$this -> idUbicacion}";
			$con -> ejecutar_sentencia($sql2);
			
			$success = 1;
		}

		return $success;
	}

	/**
	 * [editarUbicacion description]
	 * Actualizado 2016-11-24
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarUbicacion() {
		$success = 0;
		$con     = new conexion();		
		
		$sql = "
			UPDATE ubicacion 
			SET nombre = '{$this -> nombre}', idioma = '{$this -> idioma}' 
			WHERE idUbicacion = {$this -> idUbicacion}";		

		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	/**
	 * [borrarUbicacion description]
	 * Actualizado 2016-11-24
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarUbicacion() {
		$success = 0; 
		$con     = new conexion();
		$sql     = "DELETE FROM ubicacion WHERE idUbicacion = {$this -> idUbicacion}";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [cambiarStatusUbicacion description]
	 * Actualizado 2016-11-24
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $status  [description]
	 * @return  [type]            [description]
	 */
	function cambiarStatusUbicacion($status = 0) {
		$con = new conexion();
		$sql = "UPDATE ubicacion SET status = {$status} WHERE idUbicacion = {$this -> idUbicacion}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [editarOrdenUbicacion description]
	 * Actualizado 2016-11-24
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $orden  [description]
	 * @return  [type]           [description]
	 */
	function editarOrdenUbicacion($orden = 0) {
		$con = new conexion();
		$sql = "UPDATE ubicacion SET orden = {$orden} WHERE idUbicacion = {$this -> idUbicacion}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [obtenerUbicacion description]
	 * Actualizado 2016-11-24
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerUbicacion() {
		$con      = new conexion();
		$sql      = "SELECT * FROM ubicacion WHERE idUbicacion = {$this -> idUbicacion}";
		$temporal = $con -> ejecutar_sentencia($sql);
		$obj      = mysqli_fetch_object($temporal);
		
		$this -> idUbicacion = $obj -> idUbicacion;
		$this -> nombre       = htmlspecialchars_decode($obj -> nombre);
		$this -> idioma       = $obj -> idioma;
	}

	/**
	 * [listaUbicacion description]
	 * Actualizado 2016-11-24
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $pagina              [description]
	 * @param   boolean  $paginador           [description]
	 * @param   string   $status              [description]
	 * @param   string   $idioma              [description]
	 * @param   string   $busqueda            [description]
	 * @param   integer  $registrosPorPagina  [description]
	 * @return  [type]                        [description]
	 */
	function listaUbicacion($pagina = 1, $paginador = true, $status = '', $idioma = 'en', $busqueda = '', $registrosPorPagina = 20) {
		$stat   = ($status != '') ? "AND status = ".$status : '';
		$bus    = ($busqueda != '') ? "AND (nombre LIKE '%".$busqueda."%')" : '';

		$sql = "SELECT * FROM ubicacion WHERE 1 = 1 AND idioma LIKE '{$idioma}' ".$stat.$bus ." ORDER BY orden ASC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		
		if ($paginador) {
			$this -> totalRegistros = mysqli_num_rows($temporal);
			$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);	
			$paginaActual = $pagina;				
				
			$sql .= ' LIMIT '.($pagina - 1) * $this -> registrosPorPagina.', '.$this -> registrosPorPagina;
			$temporal2 = $con -> ejecutar_sentencia($sql);
			$final     = $temporal2;
		} else {
			$final = $temporal;
		}

		$resultados = array();
		while ($row = mysqli_fetch_array($final)) {
			$registro['idUbicacion'] = $row['idUbicacion'];
			$registro['nombre']       = htmlspecialchars_decode($row['nombre']);
			$registro['idioma']       = $row['idioma'];
			$registro['status']       = $row['status'];
			$registro['orden']        = $row['orden'];
			
			if ($paginador) {
				$registro['ultimapagina']    = $ultimaPagina;
				$registro['paginaanterior']  = $pagina - 1;
				$registro['paginasiguiente'] = $pagina + 1;
				$registro['pagina']          = $pagina;
			}

			array_push($resultados, $registro);
		}

		return $resultados;
	}
}
?>