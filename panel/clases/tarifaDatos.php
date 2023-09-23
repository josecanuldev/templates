<?php

include_once('conexion.php');
// include_once('archivo.php');
include_once('herramientas.php');

class tarifaDatos {

	var $idTarifaDatos;
	var $idTarifa;
	var $concepto;
	var $precio1;
	var $precio2;
	var $moneda;
	var $idioma;
	var $status;
	var $orden;
	var $conceptoEn;
	var $horaEn;

	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;

	function __construct($idTarifaDatos = 0, $idTarifa = 0, $concepto = '', $precio1 = 0, $precio2 = 0, $moneda = '', $idioma = '', $conceptoEn = '', $horaEn = '') {
		$this -> idTarifaDatos      = $idTarifaDatos;
		$this -> idTarifa           = $idTarifa;
		$this -> concepto           = htmlentities($concepto, ENT_QUOTES);
		$this -> precio1            = $precio1;
		$this -> precio2            = $precio2;
		$this -> moneda             = $moneda;
		$this -> idioma             = $idioma;
		$this -> conceptoEn           = htmlentities($conceptoEn, ENT_QUOTES);
		$this -> horaEn             = $horaEn;

		$this -> herramientas       = new herramientas();
		$this -> registrosPorPagina = 20;
	}

	/**
	 * [agregarTarifaDatos description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarTarifaDatos() {
		$success = 0;

		$con = new conexion();
		$sql = "INSERT tarifa_datos SET idTarifa = {$this -> idTarifa}, concepto = '{$this -> concepto}', precio1 = '{$this -> precio1}', precio2 = '{$this -> precio2}', moneda = '{$this -> moneda}', idioma = '{$this -> idioma}', conceptoEn = '{$this -> conceptoEn}', horaEn = '{$this -> horaEn}'";

		$this -> idTarifaDatos = $con -> ejecutar_sentencia($sql);

		if ($this -> idTarifaDatos > 0) {
			$sql2 = "UPDATE tarifa_datos SET orden = {$this -> idTarifaDatos} WHERE idTarifaDatos = {$this -> idTarifaDatos}";
			$con -> ejecutar_sentencia($sql2);

			$success = 1;
		}

		return $success;
	}

	/**
	 * [editarTarifaDatos description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarTarifaDatos() {
		$success = 0;
		$con     = new conexion();
		$sql     = "
			UPDATE tarifa_datos
			SET
				concepto = '{$this -> concepto}',
				conceptoEn = '{$this -> conceptoEn}',
				horaEn = '{$this -> horaEn}',
				precio1  = '{$this -> precio1}',
				precio2  = '{$this -> precio2}',
				moneda   = '{$this -> moneda}',
				idioma   = '{$this -> idioma}'
			WHERE idTarifaDatos = {$this -> idTarifaDatos}";

		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	function editarTarifaDatosUpdate($precioUpdate=0) {
		$success = 0;
		$con     = new conexion();
		$sql     = "
			UPDATE tarifa_datos SET concepto = '{$precioUpdate}' WHERE idTarifaDatos = {$this -> idTarifaDatos}";

		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	/**
	 * [borrarTarifaDatos description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarTarifaDatos() {
		$success = 0;
		$con     = new conexion();
		$sql     = "DELETE FROM tarifa_datos WHERE idTarifaDatos = {$this -> idTarifaDatos}";

		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [borrarTodosTarifaDatos description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarTodosTarifaDatos() {
		$success = 0;
		$con     = new conexion();
		$sql     = "DELETE FROM tarifa_datos WHERE idTarifa = {$this -> idTarifa}";

		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [cambiarStatusTarifaDatos description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $status  [description]
	 * @return  [type]            [description]
	 */
	function cambiarStatusTarifaDatos($status = 0) {
		$con = new conexion();
		$sql = "UPDATE tarifa_datos SET status = {$status} WHERE idTarifaDatos = {$this -> idTarifaDatos}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [editarOrdenTarifaDatos description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $orden  [description]
	 * @return  [type]           [description]
	 */
	function editarOrdenTarifaDatos($orden = 0) {
		$con = new conexion();
		$sql = "UPDATE tarifa_datos SET orden = {$orden} WHERE idTarifaDatos = {$this -> idTarifaDatos}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [obtenerTarifaDatos description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerTarifaDatos() {
		$con      = new conexion();
		$sql      = "SELECT * FROM tarifa_datos WHERE idTarifaDatos = {$this -> idTarifaDatos}";
		$temporal = $con -> ejecutar_sentencia($sql);
		$obj      = mysqli_fetch_object($temporal);

		$this -> idTarifaDatos = $obj -> idTarifaDatos;
		$this -> idTarifa      = $obj -> idTarifa;
		$this -> concepto      = htmlspecialchars_decode($obj -> concepto);
		$this -> precio1       = $obj -> precio1;
		$this -> precio2       = $obj -> precio2;
		$this -> moneda        = $obj -> moneda;
		$this -> idioma        = $obj -> idioma;
		$this -> status        = $obj -> status;
		$this -> orden         = $obj -> orden;
		$this -> conceptoEn      = htmlspecialchars_decode($obj -> conceptoEn);
		$this -> horaEn      = htmlspecialchars_decode($obj -> horaEn);
	}

	/**
	 * [listaTarifaDatos description]
	 * Actualizado 2016-11-22
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $pagina              [description]
	 * @param   boolean  $paginador           [description]
	 * @param   string   $status              [description]
	 * @param   string   $idioma              [description]
	 * @param   string   $busqueda            [description]
	 * @param   integer  $registrosPorPagina  [description]
	 * @return  [type]                        [description]
	 */
	function listaTarifaDatos($pagina = 1, $paginador = true, $status = '', $idioma = 'en', $desde = 0, $busqueda = '', $registrosPorPagina = 20) {
		$dsd  = ($desde > 0) ? " AND idTarifa = {$desde} " : '';
		$secc = '';
		$stat = ($status != '') ? " AND status = ".$status : '';
		$bus  = ($busqueda != '') ? " AND (concepto LIKE '%".$busqueda."%')" : '';

		$sql  = "SELECT * FROM tarifa_datos WHERE 1 = 1 AND idTarifa = {$this -> idTarifa} AND idioma LIKE '{$idioma}' {$dsd}{$secc}{$stat}{$bus} ORDER BY orden ASC";
		$con  = new conexion();
		$temp = $con -> ejecutar_sentencia($sql);

		if ($paginador) {
			$this -> totalRegistros = mysqli_num_rows($temp);
			$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);
			$paginaActual = $pagina;

			$sql   .= ' LIMIT '.($pagina - 1) * $this -> registrosPorPagina.', '.$this -> registrosPorPagina;
			$temp2 = $con -> ejecutar_sentencia($sql);
			$final = $temp2;
		} else {
			$final = $temp;
		}

		$resultados = array();
		while ($row = mysqli_fetch_array($final)) {
			$registro['idTarifaDatos'] = $row['idTarifaDatos'];
			$registro['idTarifa']      = $row['idTarifa'];
			$registro['concepto']      = htmlspecialchars_decode($row['concepto']);
			$registro['precio1']       = $row['precio1'];
			$registro['precio2']       = $row['precio2'];
			$registro['moneda']        = $row['moneda'];
			$registro['status']        = $row['status'];
			$registro['orden']         = $row['orden'];
			$registro['conceptoEn']      = htmlspecialchars_decode($row['conceptoEn']);
			$registro['horaEn']      = htmlspecialchars_decode($row['horaEn']);

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

	function listaTarifaDatosUpdate() {

		$sql  = "SELECT * FROM tarifa_datos WHERE idTarifa != 2 ORDER BY orden ASC";
		$con  = new conexion();
		$temp = $con -> ejecutar_sentencia($sql);


		$final = $temp;


		$resultados = array();
		while ($row = mysqli_fetch_array($final)) {
			$registro['idTarifaDatos'] = $row['idTarifaDatos'];
			$registro['idTarifa']      = $row['idTarifa'];
			$registro['concepto']      = htmlspecialchars_decode($row['concepto']);
			$registro['precio1']       = $row['precio1'];
			$registro['precio2']       = $row['precio2'];
			$registro['moneda']        = $row['moneda'];
			$registro['status']        = $row['status'];
			$registro['orden']         = $row['orden'];
			$registro['conceptoEn']      = htmlspecialchars_decode($row['conceptoEn']);
			$registro['horaEn']      = htmlspecialchars_decode($row['horaEn']);

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

	function obtenerTarifasDirectas($idSeccion = 0, $seccion = 'Unique') {
		$sql  = "SELECT A.* FROM `tarifa_datos` A INNER JOIN `tarifa` B USING(`idTarifa`) WHERE B.`idSeccion` = {$idSeccion} AND B.`seccion` LIKE '{$seccion}' ORDER BY `idTarifaDatos` ASC";
		$con  = new conexion();
		$temp = $con -> ejecutar_sentencia($sql);

		$resultados = array();
		while ($row = mysqli_fetch_array($temp)) {
			$registro['concepto'] = htmlspecialchars_decode($row['concepto']);
			$registro['precio']   = $row['precio1'];

			array_push($resultados, $registro);
		}

		return $resultados;
	}
}
?>
