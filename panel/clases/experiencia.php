<?php

include_once('conexion.php');
include_once('archivo.php');
include_once('experienciaDatos.php');
include_once('experienciaAnexo.php');
include_once('galeria.php');
include_once('resenia.php');
include_once('tarifa.php');
include_once('herramientas.php');

class experiencia extends Archivo {

	var $idExperiencia;
	var $idUbicacion;
	var $imgPortada;
	var $urlAmigable;
	var $seccion;
	var $status;
	var $orden;

	var $tarifa;

	var $directorio = "../img/__SECCION__/";
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;

	var $datos;

	function __construct($idExperiencia = 0, $idUbicacion = 0, $seccion = '', $nombre = '', $imgPortada = '', $tmp = '') {
		$this -> imgPortada         = ($imgPortada !== '') ? $this -> obtenerExtensionArchivo($imgPortada) : '';
		$this -> ruta_final         = str_replace('__SECCION__', 'img'. $seccion, $this -> directorio);
		$this -> ruta_temporal      = $tmp;
		$this -> herramientas       = new herramientas();
		$this -> registrosPorPagina = 20;

		$this -> idExperiencia      = $idExperiencia;
		$this -> idUbicacion        = $idUbicacion;
		$this -> urlAmigable        = $this -> herramientas -> getUrlAmigable($nombre);
		$this -> seccion            = htmlentities($seccion, ENT_QUOTES);
	}

	/**
	 * [agregarExperiencia description]
	 * Actualizado 2016-11-25
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarExperiencia() {
		$success = 0;

		if($this->seccion=='NoDestino' || $this->seccion=='35' || $this->seccion=='ServicioPremium' || $this->seccion=='ServicioEstandar'){
			  $con = new conexion();
			  $sql = "INSERT experiencia SET idUbicacion = '{$this -> idUbicacion}', urlAmigable = '{$this -> urlAmigable}', seccion = '{$this -> seccion}'";

			  $this -> idExperiencia = $con -> ejecutar_sentencia($sql);

			  if ($this -> idExperiencia > 0) {
				  $sql2 = "UPDATE experiencia SET orden = {$this -> idExperiencia} WHERE idExperiencia = {$this -> idExperiencia}";
				  $con -> ejecutar_sentencia($sql2);

				  $success = 1;
			  }
		}
		else{

			if ($this -> subir_archivo_imagen($this -> imgPortada)) {

				$con = new conexion();
				$sql = "INSERT experiencia SET imgPortada = '{$this -> imgPortada}', urlAmigable = '{$this -> urlAmigable}', seccion = '{$this -> seccion}'";

				$this -> idExperiencia = $con -> ejecutar_sentencia($sql);

				if ($this -> idExperiencia > 0) {
					$sql2 = "UPDATE experiencia SET orden = {$this -> idExperiencia} WHERE idExperiencia = {$this -> idExperiencia}";
					$con -> ejecutar_sentencia($sql2);

					$success = 1;
				}
			}

		}

		return $success;
	}

	/**
	 * [editarExperiencia description]
	 * Actualizado 2016-11-25
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarExperiencia() {
		$success = 0;
		$con     = new conexion();

		if ($this -> imgPortada !== '') {
			$this -> obtenerPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = str_replace('__SECCION__', 'img'. $this -> seccion, $this -> directorio);
			if ($this -> subir_archivo_imagen($this -> imgPortada)) {
				$img = "UPDATE experiencia SET imgPortada = '{$this -> imgPortada}' WHERE idExperiencia = {$this -> idExperiencia}";
				$con -> ejecutar_sentencia($img);
			}
		}
		// print_r($this);
		// exit;

		$sql = "
			UPDATE experiencia
			SET
				idUbicacion = '{$this -> idUbicacion}',
				-- imgContenido = '{$this -> imgContenido}',
				-- urlAmigable = '{$this -> urlAmigable}',
				seccion = '{$this -> seccion}'
			WHERE idExperiencia = {$this -> idExperiencia}";

		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	/**
	 * [borrarExperiencia description]
	 * Actualizado 2016-11-25
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarExperiencia() {
		$this -> obtenerPortada();
		$this -> borrar_archivo();

		$success = 0;
		$con     = new conexion();
		$sql     = "DELETE FROM experiencia WHERE idExperiencia = {$this -> idExperiencia}";

		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [obtenerPortada description]
	 * Actualizado 2016-11-25
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerPortada() {
		$sql  = "SELECT imgPortada FROM experiencia WHERE idExperiencia = {$this -> idExperiencia}";
		$con  = new conexion();
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);

		$this -> ruta_final = $this -> directorio.$obj -> imgPortada;
	}

	// function getImgMovil() {
	// 	$_MYSQL = new MYSQL();
	// 	$_SQL = "SELECT imgMovil FROM experiencia WHERE idExperiencia = ?";
	// 	$_CONECTADO = $_MYSQL -> Connect();
	// 	if (!$_CONECTADO) {
	// 		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
	// 		exit();
	// 	}
	// 	$_MYSQL -> Execute($_SQL, array($this -> idExperiencia));
	// 	$obj = $_MYSQL -> fetchobject();
	// 	$this -> ruta_final = $this -> directorio.$obj -> imgMovil;
	// }

	/**
	 * [cambiarStatusExperiencia description]
	 * Actualizado 2016-11-25
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $status  [description]
	 * @return  [type]            [description]
	 */
	function cambiarStatusExperiencia($status = 0) {
		$con = new conexion();
		$sql = "UPDATE experiencia SET status = {$status} WHERE idExperiencia = {$this -> idExperiencia}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [editarOrdenExperiencia description]
	 * Actualizado 2016-11-25
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $orden  [description]
	 * @return  [type]           [description]
	 */
	function editarOrdenExperiencia($orden = 0) {
		$con = new conexion();
		$sql = "UPDATE experiencia SET orden = {$orden} WHERE idExperiencia = {$this -> idExperiencia}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [obtenerExperiencia description]
	 * Actualizado 2016-11-25
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerExperiencia() {
		$con  = new conexion();
		$sql  = "SELECT * FROM experiencia WHERE idExperiencia = {$this -> idExperiencia}";
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);

		$this -> idExperiencia  = $obj -> idExperiencia;
		$this -> idUbicacion = $obj -> idUbicacion;
		$this -> imgPortada  = $obj -> imgPortada;
		$this -> urlAmigable = $obj -> urlAmigable;
		$this -> seccion     = $obj -> seccion;
		$this -> status      = $obj -> status;
		$this -> orden       = $obj -> orden;
	}

	function obtenerExperienciaPrev($idExperiencia=0,$seccion="") {
		$con  = new conexion();
		$sql  = "SELECT * FROM experiencia WHERE idExperiencia < {$idExperiencia} AND seccion='{$seccion}' AND status=1 LIMIT 0,1";
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);

		$this -> idExperiencia  = $obj -> idExperiencia;
		$this -> idUbicacion = $obj -> idUbicacion;
		$this -> imgPortada  = $obj -> imgPortada;
		$this -> urlAmigable = $obj -> urlAmigable;
		$this -> seccion     = $obj -> seccion;
		$this -> status      = $obj -> status;
		$this -> orden       = $obj -> orden;
	}

	function obtenerExperienciaNext($idExperiencia=0,$seccion="") {
		$con  = new conexion();
		$sql  = "SELECT * FROM experiencia WHERE idExperiencia > {$idExperiencia} AND seccion='{$seccion}' AND status=1 LIMIT 0,1";
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);

		$this -> idExperiencia  = $obj -> idExperiencia;
		$this -> idUbicacion = $obj -> idUbicacion;
		$this -> imgPortada  = $obj -> imgPortada;
		$this -> urlAmigable = $obj -> urlAmigable;
		$this -> seccion     = $obj -> seccion;
		$this -> status      = $obj -> status;
		$this -> orden       = $obj -> orden;
	}

	function listaExperiencia($pagina = 1, $paginador = true, $status = '', $seccion = '', $idioma = 'en', $busqueda = '', $registrosPorPagina = 20, $_rangoA = '', $_rangoB = '', $_orderBy = '', $_ubicacion = '') {
		$secc = ($seccion !== '') ? "AND A.seccion LIKE '{$seccion}'" : '';
		$stat = ($status != '') ? "AND A.status = ".$status : '';
		$bus  = ($busqueda != '') ? "AND (B.nombre LIKE '%".$busqueda."%')" : '';
		$range = ($_rangoA != '' AND $_rangoB != '') ? " AND (B.inicial > ".$_rangoA." AND B.inicial < ".$_rangoB.") " : '';
		$sort = ($_orderBy != '') ? " ORDER BY ".$_orderBy : " ORDER BY A.orden ASC ";
		$location = ($_ubicacion != '') ? " AND A.idUbicacion = '".$_ubicacion."' " : '';

		$sql  = "SELECT A.*, B.*, IF(A.idUbicacion > 0, (SELECT C.nombre FROM ubicacion C WHERE C.idUbicacion = A.idUbicacion LIMIT 1), '-') ubicacion FROM experiencia A INNER JOIN experiencia_datos B USING(idExperiencia) WHERE 1 = 1 AND B.idioma LIKE '{$idioma}' {$range}{$location}{$secc}{$stat}{$bus} {$sort}";
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
			$registro['idExperiencia']  = $row['idExperiencia'];
			$registro['idUbicacion'] = $row['idUbicacion'];
			$registro['ubicacion']   = $row['ubicacion'];
			$registro['imgPortada']  = $row['imgPortada'];
			$registro['urlAmigable'] = $row['urlAmigable'];
			$registro['seccion']     = $row['seccion'];
			$registro['nombre']      = $row['nombre'];
			$registro['nombreEn']      = $row['nombreEn'];
			$registro['capacidad']   = $row['capacidad1'];
			$registro['capacidad2']   = $row['capacidad2'];
			$registro['subnombre']   = $row['subnombre'];
			$registro['duracion']    = $row['duracion'];
			$registro['tipo']        = $row['tipo'];
			$registro['inicial']     = $row['inicial'];
			$registro['concepto']     = $row['concepto'];
			$registro['descripcion'] = $row['descripcion'];
			$registro['descripcionEn'] = $row['descripcionEn'];
			$registro['politicas']   = $row['politicas'];
			$registro['status']      = $row['status'];
			$registro['orden']       = $row['orden'];

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

	/* Experiencia datos
	   ========================================================================== */
	function agregarExperienciaDatos($nombre = '', $subnombre = '', $inicial = '', $concepto = '', $titulo = '', $descripcion = '', $capacidad1 = 0, $capacidad2 = 0, $duracion = '', $politicas = '', $idioma = 'en', $descripcionEn = '', $politicasEn = '', $nombreEn = '') {
		// function __construct($idExperienciaDatos = 0, $idExperiencia = 0, $nombre = '', $subnombre = '', $inicial = '', $titulo = '', $descripcion = '', $capacidad1 = '', $capacidad2 = '', $duracion = '', $politicas = '', $idioma = 'en');
		$datos = new experienciaDatos(0, $this -> idExperiencia, $nombre, $subnombre, $inicial, $concepto, $titulo, $descripcion, $capacidad1, $capacidad2, $duracion, $politicas, $idioma, $descripcionEn, $politicasEn, $nombreEn);
		$datos -> agregarExperienciaDatos();
	}

	function obtenerExperienciaDatos($idioma = 'en') {
		$this -> datos = new experienciaDatos(0, $this -> idExperiencia);
		$this -> datos -> obtenerExperienciaDatos($idioma);
	}

	function editarExperienciaDatos($nombre = '', $subnombre = '', $inicial = '', $concepto = '', $titulo = '', $descripcion = '', $capacidad1 = 0, $capacidad2 = 0, $duracion = '', $politicas = '', $idioma = 'en', $descripcionEn = '', $politicasEn = '', $nombreEn = '') {
		$datos = new experienciaDatos(0, $this -> idExperiencia, $nombre, $subnombre, $inicial, $concepto, $titulo, $descripcion, $capacidad1, $capacidad2, $duracion, $politicas, $idioma, $descripcionEn, $politicasEn, $nombreEn);
		$datos -> editarExperienciaDatos();
	}

	function borrarExperienciaDatos() {
		$datos = new experienciaDatos(0, $this -> idExperiencia);
		$datos -> borrarExperienciaDatos();
	}

	/* Experiencia anexo
	   ========================================================================== */
	function agregarExperienciaAnexo($titulo = '', $periodo = '', $descripcion = '', $tipo = '', $idioma = 'en') {
		$anexo = new experienciaAnexo(0, $this -> idExperiencia, $titulo, $periodo, $descripcion, $tipo, $idioma);
		$anexo -> agregarExperienciaAnexo();
	}

	function obtenerExperienciaAnexo($idioma = 'en') {
		$this -> anexo = new experienciaAnexo(0, $this -> idExperiencia);
		$this -> anexo -> obtenerExperienciaAnexo($idioma);
	}

	function editarExperienciaAnexo($id = 0, $titulo = '', $periodo = '', $descripcion = '', $tipo = '', $idioma = 'en') {
		$anexo = new experienciaAnexo($id, $this -> idExperiencia, $nombre, $subnombre, $inicial, $titulo, $descripcion, $capacidad1, $capacidad2, $duracion, $politicas, $idioma);
		$anexo -> editarExperienciaAnexo();
	}

	// function borrarExperienciaAnexo($id = 0, $idioma = 'en') {
	// 	$anexo = new experienciaAnexo($id, $this -> idExperiencia);
	// 	$anexo -> borrarExperienciaAnexo($idioma);
	// }

	function listaExperienciaAnexo($idioma = 'en', $tipo = '') {
		$anexo = new experiencia(0, $this -> idExperiencia);

		return $anexo -> listaExperienciaAnexo(1, false, '', $tipo, $idioma);
	}

	/* Slider
	   ========================================================================== */
	function agregarGaleria($nombre = '', $subnombre = '', $texto = '', $inicial = '', $seccion = '', $idioma = 'en', $imgPortada = '', $tmp = '') {
		// echo "galeria(0, {$this -> idExperiencia}, {$nombre}, {$subnombre}, {$texto}, {$inicial}, 'Transportacion', {$idioma}, {$imgPortada}, {$tmp});";exit;
		$galeria = new galeria(0, $this -> idExperiencia, $nombre, $subnombre, $texto, $inicial, $seccion, $idioma, $imgPortada, $tmp);
		$galeria -> agregarGaleria();
	}

	function editarGaleria($id = 0, $nombre = '', $subnombre = '', $texto = '', $inicial = '', $seccion = '', $idioma = 'en', $imgPortada = '', $tmp = '') {
		// echo "galeria({$id}, {$this -> idExperiencia}, {$nombre}, {$subnombre}, {$texto}, {$inicial}, 'Transportacion', {$idioma}, {$imgPortada}, {$tmp});";exit;
		$galeria = new galeria($id, $this -> idExperiencia, $nombre, $subnombre, $texto, $inicial, $seccion, $idioma, $imgPortada, $tmp);
		$galeria -> editarGaleria();
	}

	function listaGaleria($idioma = 'en', $seccion = '') {
		$galeria = new galeria(0, $this -> idExperiencia);

		return $galeria -> listaGaleria(1, false, $idioma, $this -> idExperiencia, $seccion);
	}

	/* Reseñas
	   ========================================================================== */
	function listaResenia($idioma = 'en', $seccion = '') {
		$resenia = new resenia(0, $this -> idExperiencia);

		return $resenia -> listaResenia(1, false, '', $idioma, $this -> idExperiencia, $seccion);
	}

	function agregarResenia($nombre = '', $fecha = '', $texto = '', $idioma = 'en', $seccion = '', $textoEn = '') {
		$resenia = new resenia(0, $this -> idExperiencia, $nombre, $texto, $idioma, $fecha, $seccion, $textoEn);
		$resenia -> agregarResenia();
	}

	function editarResenia($id = 0, $nombre = '', $fecha = '', $texto = '', $idioma = 'en', $seccion = '', $textoEn = '') {
		$resenia = new resenia($id, $this -> idExperiencia, $nombre, $texto, $idioma, $fecha, $seccion, $textoEn);
		$resenia -> editarResenia();
	}

	/* Tarifa
	   ========================================================================== */
	function listaTarifa($idioma = 'en', $seccion = '') {
		$tarifa = new tarifa(0, $this -> idExperiencia);

		return $tarifa -> listaTarifa(1, false, '', $idioma, $this -> idExperiencia, $seccion);
	}

	function obtenerTarifa($idioma = 'en', $seccion = '') {
		$this -> tarifa = new tarifa(0, $this -> idExperiencia, '', '', '', '', '', $idioma, $seccion);
		$this -> tarifa -> obtenerTarifa();
	}

	function agregarTarifa($concepto = '', $precio1 = 0, $precio2 = 0, $moneda = 'USD', $idioma = 'en', $seccion = '', $conceptoEn = '', $horaEn = '') {
		$tarifa = new tarifa(0, $this -> idExperiencia, $concepto, $precio1, $precio2, $moneda, $idioma, $seccion, $conceptoEn, $horaEn);
		$tarifa -> agregarTarifa();
	}

	function editarTarifa($id = 0, $concepto = '', $precio1 = 0, $precio2 = 0, $moneda = 'USD', $idioma = 'en', $seccion = '', $conceptoEn = '', $horaEn = '') {
		$tarifa = new tarifa($id, $this -> idExperiencia, $concepto, $precio1, $precio2, $moneda, $idioma, $seccion, $conceptoEn, $horaEn);
		$tarifa -> editarTarifa();
	}

	function listaPrecios($idTarifa = 0, $idioma = 'en') {
		$tarifa = new tarifa();
		return $tarifa -> listarTarifaDatos($idTarifa, $idioma);
	}

	//obtener precios de las Tarifas
	function obtener_precio_por_ajax($tipoViaje="",$regreso=0){
		$resultados=array();
		$sql="SELECT A.idSeccion,B.idTarifaDatos,B.concepto,B.conceptoEn from tarifa as A,tarifa_datos as B WHERE A.idTarifa=B.idTarifa AND B.horaEn='{$tipoViaje}' AND B.regreso={$regreso} AND A.idSeccion =".$this -> idExperiencia;
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idExperiencia'] = $fila['idSeccion'];
			$registro['idTarifaDatos'] = $fila['idTarifaDatos'];
			$registro['precio'] = $fila['concepto'];
			$registro['precioEn'] = $fila['conceptoEn'];

			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}

	function obtener_precio_por_ajax_privadoPremiumS($tipoViaje="",$pasajeros="") {
		$con  = new conexion();
		$sql  = "SELECT A.idSeccion,B.idTarifaDatos,B.concepto,B.conceptoEn from tarifa as A,tarifa_datos as B WHERE A.idTarifa=B.idTarifa AND B.horaEn='{$tipoViaje}' AND B.precio1='{$pasajeros}' AND A.idSeccion =".$this -> idExperiencia;
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);

		$this -> idExperiencia = $obj -> idSeccion;
		$this -> idTarifaDatos = $obj -> idTarifaDatos;
		$this -> precio = $obj -> concepto;
		$this -> precioEn = $obj -> conceptoEn;
	}

	function obtener_precio_por_ajax_privadoPremium($tipoViaje="",$pasajeros=""){
		$resultados=array();
		$sql="SELECT A.idSeccion,B.idTarifaDatos,B.concepto,B.conceptoEn from tarifa as A,tarifa_datos as B WHERE A.idTarifa=B.idTarifa AND B.horaEn='{$tipoViaje}' AND B.precio1='{$pasajeros}' AND A.idSeccion =".$this -> idExperiencia;
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		while ($fila=mysqli_fetch_array($temporal))
		{
			$registro=array();
			$registro['idExperiencia'] = $fila['idSeccion'];
			$registro['idTarifaDatos'] = $fila['idTarifaDatos'];
			$registro['precio'] = $fila['concepto'];
			$registro['precioEn'] = $fila['conceptoEn'];

			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}
}
?>
