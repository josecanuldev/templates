<?php

include_once('conexion.php');
include_once('archivo.php');
include_once('servicioDatos.php');
include_once('galeria.php');
include_once('herramientas.php');

class servicio extends Archivo {
	
	var $idServicio;
	var $imgPortada;
	var $imgMovil;
	var $imgContenido;
	var $urlAmigable;
	var $mapLatitud;
	var $mapLongitud;
	var $destacado;
	var $status;
	var $orden;
	
	var $directorio = "../img/imgServicio/";
	var $registrosPorPagina;
	var $totalRegistros;
	var $herramientas;

	var $datos;
	
	function __construct($idServicio = 0, $mapLatitud = '', $mapLongitud = '', $titulo = '', $imgPortada = '', $tmp = '') {
		$this -> imgPortada         = ($imgPortada !== '') ? $this -> obtenerExtensionArchivo($imgPortada) : '';
		$this -> ruta_final         = $this -> directorio;
		$this -> ruta_temporal      = $tmp;
		$this -> herramientas       = new herramientas();
		
		$this -> registrosPorPagina = 20;
		$this -> idServicio          = $idServicio;
		$this -> imgContenido       = $imgContenido;
		$this -> urlAmigable        = $this -> herramientas -> getUrlAmigable($titulo);
		$this -> mapLatitud         = $mapLatitud;
		$this -> mapLongitud        = $mapLongitud;		
	}

	/**
	 * [agregarServicio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function agregarServicio() {
		$success = 0;

		if ($this -> subir_archivo_imagen($this -> imgPortada)) {

			$con = new conexion();
			$sql = "INSERT servicio SET imgPortada = '{$this -> imgPortada}', urlAmigable = '{$this -> urlAmigable}', mapLatitud = '{$this -> mapLatitud}', mapLongitud = '{$this -> mapLongitud}'";
			
			$this -> idServicio = $con -> ejecutar_sentencia($sql);

			if ($this -> idServicio > 0) {
				$sql2 = "UPDATE servicio SET orden = {$this -> idServicio} WHERE idServicio = {$this -> idServicio}";
				$con -> ejecutar_sentencia($sql2);
				
				$success = 1;
			}
		}

		return $success;
	}

	/**
	 * [editarServicio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function editarServicio() {
		$success = 0;
		$con     = new conexion();		
		
		if ($this -> imgPortada !== '') {
			$this -> obtenerPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> directorio;
			if ($this -> subir_archivo_imagen($this -> imgPortada)) {
				$img = "UPDATE servicio SET imgPortada = '{$this -> imgPortada}' WHERE idServicio = {$this -> idServicio}";
				$con -> ejecutar_sentencia($img);
			}
		}

		$sql = "
			UPDATE servicio 
			SET 
				-- imgContenido = '{$this -> imgContenido}', 
				urlAmigable = '{$this -> urlAmigable}', 
				mapLatitud = '{$this -> mapLatitud}', 
				mapLongitud = '{$this -> mapLongitud}' 
			WHERE idServicio = {$this -> idServicio}";		

		if ($con -> ejecutar_sentencia($sql))
			$success = 2;

		return $success;
	}

	// function updateImgMovil($_ruta = '', $tmp = '') {
	// 	if ($_ruta != '') {
	// 		$this -> getImgMovil();
	// 		$this -> borrar_archivo();

	// 		$this -> ruta_final = $this -> directorio;
	// 		$this -> ruta_temporal = $tmp;
	// 		$_ruta = $this -> obtenerExtensionArchivo($_ruta);
	// 		$this -> subir_archivo_imagen($_ruta);
	// 		$_MYSQL = new MYSQL();
	// 		$_SQL = "UPDATE servicio SET imgMovil = ? WHERE idServicio = ?";
	// 		$_CONECTADO = $_MYSQL -> Connect();
	// 		if (!$_CONECTADO) {
	// 			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
	// 			exit();
	// 		}
	// 		$_MYSQL -> Execute($_SQL, array($_ruta, $this -> idServicio));
	// 	}
	// }
	
	/**
	 * [agregarImagenContenido description]
	 * Actualizado 2016-11-16
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   string  $imagen  [description]
	 * @param   string  $temp    [description]
	 * @return  [type]           [description]
	 */
	function agregarImagenContenido($imagen = '', $temp = '') {
		$this -> imgContenido  = ($imagen !== '') ? $this -> obtenerExtensionArchivo($imagen) : '';
		$this -> ruta_final    = $this -> directorio;
		$this -> ruta_temporal = $temp;

		if ($this -> subir_archivo_imagen($this -> imgContenido)) {
			$con = new conexion();
			$sql = "UPDATE servicio SET imgContenido = '{$this -> imgContenido}' WHERE idServicio = {$this -> idServicio}";
			$con -> ejecutar_sentencia($sql);
		}
	}

	function editarImagenContenido($imagen = '', $temp = '') {
		if ($imagen !== '') {
			$this -> obtenerImagenContenido();
			$this -> borrar_archivo();
		
			$this -> imgContenido  = $this -> obtenerExtensionArchivo($imagen);
			$this -> ruta_final    = $this -> directorio;
			$this -> ruta_temporal = $temp;
		
			if ($this -> subir_archivo_imagen($this -> imgContenido)) {
				$con = new conexion();
				$sql = "UPDATE servicio SET imgContenido = '{$this -> imgContenido}' WHERE idServicio = {$this -> idServicio}";
				$con -> ejecutar_sentencia($sql);
			}
		}
	}

	/**
	 * [borrarServicio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function borrarServicio() {
		$this -> obtenerPortada();
		$this -> borrar_archivo();
		$this -> obtenerImagenContenido();
		$this -> borrar_archivo();
		 
		$success = 0; 
		$con     = new conexion();
		$sql     = "DELETE FROM servicio WHERE idServicio = {$this -> idServicio}";
		
		if ($con -> ejecutar_sentencia($sql))
			$success = 3;

		return $success;
	}

	/**
	 * [obtenerPortada description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerPortada() {
		$sql  = "SELECT imgPortada FROM servicio WHERE idServicio = {$this -> idServicio}";
		$con  = new conexion();
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);
		
		$this -> ruta_final = $this -> directorio.$obj -> imgPortada;
	}

	function obtenerImagenContenido() {
		$sql  = "SELECT imgContenido FROM servicio WHERE idServicio = {$this -> idServicio}";
		$con  = new conexion();
		$temp = $con -> ejecutar_sentencia($sql);
		$obj  = mysqli_fetch_object($temp);
		
		$this -> ruta_final = $this -> directorio.$obj -> imgContenido;
	}

	// function getImgMovil() {
	// 	$_MYSQL = new MYSQL();
	// 	$_SQL = "SELECT imgMovil FROM servicio WHERE idServicio = ?";
	// 	$_CONECTADO = $_MYSQL -> Connect();
	// 	if (!$_CONECTADO) {
	// 		echo 'Ocurrio un error, Por favor intentalo mas tarde.';
	// 		exit();
	// 	}
	// 	$_MYSQL -> Execute($_SQL, array($this -> idServicio));
	// 	$obj = $_MYSQL -> fetchobject();
	// 	$this -> ruta_final = $this -> directorio.$obj -> imgMovil;
	// }

	/**
	 * [cambiarStatusServicio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $status  [description]
	 * @return  [type]            [description]
	 */
	function cambiarStatusServicio($status = 0) {
		$con = new conexion();
		$sql = "UPDATE servicio SET status = {$status} WHERE idServicio = {$this -> idServicio}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [editarOrdenServicio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $orden  [description]
	 * @return  [type]           [description]
	 */
	function editarOrdenServicio($orden = 0) {
		$con = new conexion();
		$sql = "UPDATE servicio SET orden = {$orden} WHERE idServicio = {$this -> idServicio}";
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * [destacarServicio description]
	 * Actualizado 2016-11-28
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @param   integer  $status  [description]
	 * @return  [type]            [description]
	 */
	function destacarServicio($status = 0) {
		$success = 0;
		$con     = new conexion();
		$sql1    = "SELECT COUNT(`idServicio`) `total` FROM `servicio` WHERE `destacado` = 1 AND `status` = 1";
		$temp    = $con -> ejecutar_sentencia($sql1);
		$obj     = mysqli_fetch_object($temp);


		if ($obj -> total < 4 AND $status == 1) {
			$sql2 = "UPDATE `servicio` SET `destacado` = 1 WHERE `idServicio` = {$this -> idServicio}";
			$con -> ejecutar_sentencia($sql2);
			$success = 1;
		} else {
			$sql2 = "UPDATE `servicio` SET `destacado` = 0 WHERE `idServicio` = {$this -> idServicio}";
			$con -> ejecutar_sentencia($sql2);
		}

		return $success;
	}

	/**
	 * [obtenerServicio description]
	 * Actualizado 2016-11-15
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	function obtenerServicio() {
		$con      = new conexion();
		$sql      = "SELECT * FROM servicio WHERE idServicio = {$this -> idServicio}";
		$temporal = $con -> ejecutar_sentencia($sql);
		$obj      = mysqli_fetch_object($temporal);
		
		$this -> idServicio    = $obj -> idServicio;
		$this -> imgPortada   = $obj -> imgPortada;
		// $this -> imgMovil  = $obj -> imgMovil;
		$this -> imgContenido = $obj -> imgContenido;
		$this -> urlAmigable  = $obj -> urlAmigable;
		$this -> mapLatitud   = $obj -> mapLatitud;
		$this -> mapLongitud  = $obj -> mapLongitud;
		$this -> status       = $obj -> status;
		$this -> orden        = $obj -> orden;
	}

	function listaServicio($pagina = 1, $paginador = true, $status = '', $idioma = 'en', $busqueda = '', $registrosPorPagina = 20) {
		$stat   = ($status != '') ? "AND A.status = ".$status : '';
		$bus    = ($busqueda != '') ? "AND (B.titulo LIKE '%".$busqueda."%')" : '';

		$sql = "SELECT A.*, B.`titulo`, B.`ubicacion`, B.`descripcion` FROM servicio A INNER JOIN servicio_datos B USING(idServicio) WHERE 1 = 1 AND B.idioma LIKE '{$idioma}' ".$stat.$bus ." ORDER BY A.orden ASC";
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
			$registro['idServicio']    = $row['idServicio'];
			$registro['imgPortada']   = $row['imgPortada'];
			$registro['imgContenido'] = $row['imgContenido'];
			$registro['urlAmigable']  = $row['urlAmigable'];
			$registro['mapLatitud']   = $row['mapLatitud'];
			$registro['mapLongitud']  = $row['mapLongitud'];
			$registro['titulo']       = htmlspecialchars_decode($row['titulo']);
			$registro['ubicacion']    = htmlspecialchars_decode($row['ubicacion']);
			$registro['descripcion']  = htmlspecialchars_decode($row['descripcion']);
			$registro['destacado']    = $row['destacado'];
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

	/**
	 * [listaServicioDestacados description]
	 * Actualizado 2016-11-28
	 * Revisado por Alejandro Zapata <alejandro@locker.com.mx>
	 * @return  [type]  [description]
	 */
	public function listaServicioDestacados($idioma = 'en') {
		$con        = new conexion();
		$sql        = "SELECT A.*, B.`titulo`, B.`ubicacion`, B.`descripcion` FROM servicio A INNER JOIN servicio_datos B USING(idServicio) WHERE A.`status` = 1 AND A.`destacado`= 1 ORDER BY A.`orden` ASC LIMIT 4";
		$temp       = $con -> ejecutar_sentencia($sql);
		$resultados = array();
		while ($row = mysqli_fetch_array($temp)) {
			$registro['idServicio']    = $row['idServicio'];
			$registro['imgPortada']   = $row['imgPortada'];
			$registro['imgContenido'] = $row['imgContenido'];
			$registro['urlAmigable']  = $row['urlAmigable'];
			$registro['mapLatitud']   = $row['mapLatitud'];
			$registro['mapLongitud']  = $row['mapLongitud'];
			$registro['titulo']       = htmlspecialchars_decode($row['titulo']);
			$registro['ubicacion']    = htmlspecialchars_decode($row['ubicacion']);
			$registro['descripcion']  = htmlspecialchars_decode($row['descripcion']);
			$registro['destacado']    = $row['destacado'];
			$registro['status']       = $row['status'];
			$registro['orden']        = $row['orden'];

			array_push($resultados, $registro);
		}

		return $resultados;
	}

	/* Servicio datos
	   ========================================================================== */
	function agregarServicioDatos($titulo = '', $ubicacion = '', $descripcion = '', $actividades = '', $idioma = 'en') {
		$datos = new servicioDatos(0, $this -> idServicio, $titulo, $ubicacion, $descripcion, $actividades, $idioma);
		$datos -> agregarServicioDatos();
	}

	function obtenerServicioDatos($idioma = 'en') {
		$this -> datos = new servicioDatos(0, $this -> idServicio);
		$this -> datos -> obtenerServicioDatos($idioma);
	}

	function editarServicioDatos($titulo = '', $ubicacion = '', $descripcion = '', $actividades = '', $idioma = 'en') {
		$datos = new servicioDatos(0, $this -> idServicio, $titulo, $ubicacion, $descripcion, $actividades, $idioma);
		$datos -> editarServicioDatos();
	}

	function borrarServicioDatos() {
		$datos = new servicioDatos(0, $this -> idServicio);
		$datos -> borrarServicioDatos();
	}

	/* Slider
	   ========================================================================== */
	function agregarGaleria($titulo = '', $subtitulo = '', $texto = '', $inicial = '', $idioma = 'en', $imgPortada = '', $tmp = '') {
		// echo "galeria(0, {$this -> idServicio}, {$titulo}, {$subtitulo}, {$texto}, {$inicial}, 'Servicio', {$idioma}, {$imgPortada}, {$tmp});";exit;
		$galeria = new galeria(0, $this -> idServicio, $titulo, $subtitulo, $texto, $inicial, 'Servicio', $idioma, $imgPortada, $tmp);
		$galeria -> agregarGaleria();
	}

	function editarGaleria($id = 0, $titulo = '', $subtitulo = '', $texto = '', $inicial = '', $idioma = 'en', $imgPortada = '', $tmp = '') {
		// echo "galeria({$id}, {$this -> idServicio}, {$titulo}, {$subtitulo}, {$texto}, {$inicial}, 'Servicio', {$idioma}, {$imgPortada}, {$tmp});";exit;
		$galeria = new galeria($id, $this -> idServicio, $titulo, $subtitulo, $texto, $inicial, 'Servicio', $idioma, $imgPortada, $tmp);
		$galeria -> editarGaleria();
	}

	function listaGaleria($idioma = 'en') {
		$galeria = new galeria();
		
		return $galeria -> listaGaleria(1, false, $idioma, $this -> idServicio, 'Servicio');
	}
}
?>