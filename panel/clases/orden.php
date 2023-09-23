<?php
include_once('conexion.php');
include_once('datosOrden.php');
include_once('detalle_orden.php');
include_once('cliente.php');
include_once('producto.php');
//include_once('productoxuserend.php');
include_once('herramientas.php');
include_once('rangoTransporte.php');

class orden{

	var $idOrden;
	var $idCliente;
	var $idProducto;
	var $idCombinacion;
	var $idTransporte;


	/**
	 * Variables generales para la orden
	 */
	var $fecha;
	var $horaPago;
	var $peso;
	var $cantidad;

	/**
	 * Variables para almacenar los precios
	 */
	var $subtotal;
	var $subtotalBase;
	var $precioTransporte;
	var $precioDescuento;
	var $importeTotal;

	/**
	 * Variables de estado de la orden
	 */
	var $status;
	var $tipoPago;
	var $visto;

	/**
	 * Varibles con arreglos y objetos
	 */
	var $orden;
	var $herramientas;
	var $transportes;
	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idOrden = 0){
		$this -> idOrden = $idOrden;
		$this -> orden = array();
		$this -> herramientas = new herramientas();
		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;
	}

	function createOrden(){
		$sql = "INSERT INTO orden(subtotal, cantidad, importeTotal, peso, status, fecha) VALUES (".$this -> subtotal.", ".$this -> cantidad.", ".$this -> importeTotal.", ".$this -> peso.", 0, '".$this -> fecha."')";
		$conexion = new conexion();
		$this -> idOrden = $conexion -> ejecutar_sentencia($sql);
		$sql2 = "INSERT INTO datosorden(idOrden) VALUES (".$this -> idOrden.")";
		$conexion -> ejecutar_sentencia($sql2);
	}
	/**
	 * modificar datos de los precios paso 1
	 */
	function updatePrecios(){
		$sql = "UPDATE orden SET subtotal = ".$this -> subtotal.", precioTransporte = ".$this -> precioTransporte.", precioDescuento = ".$this -> precioDescuento.", importeTotal = ".$this -> importeTotal." WHERE idOrden = ".$this -> idOrden;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenGeneral(){
		$sql = "UPDATE orden SET subtotal = ".$this -> subtotal.", cantidad = ".$this -> cantidad.", peso = ".$this -> peso.", importeTotal = ".$this -> importeTotal." WHERE idOrden = ".$this -> idOrden;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function addClienteOrden($idCliente){
		$sql = "UPDATE orden SET idCliente = ".$idCliente." WHERE idOrden = ".$this -> idOrden;
		$conexion  = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}


	function addOrden(){
		$fecha = date('Y-m-d');
		$importeTotal = $this -> subtotal + $this -> precioTransporte;
		$con = new conexion();
		$sql ="INSERT INTO orden(fecha, peso, cantidad, subtotal, precioTransporte, importeTotal, status, tipoPago) values ('".$fecha."', '".$this -> peso."', '".$this -> cantidad."', '".$this -> subtotal."', '".$this -> precioTransporte."', '".$importeTotal."', '1', '".$this -> tipoPago."')";
		$this -> idOrden = $con -> ejecutar_sentencia($sql);

	}

	function modificarOrdenPrecios(){
		$con = new conexion();
		$sql = "UPDATE orden SET cantidad = '".$this -> cantidad."', subtotal = '".$this->subtotal."' WHERE idOrden = ".$this->idOrden;
		$con->ejecutar_sentencia($sql);
	}

	function modificarDireccion(){
		$con = new conexion();
		$sql = "UPDATE orden SET idDireccion = ".$this -> idDireccion." where idOrden = ".$this->idOrden;
		$con->ejecutar_sentencia($sql);
	}

	function modificarTransporte(){
		$con = new conexion();
		$sql = "UPDATE orden SET idTransporte = ".$this -> idTransporte.", idRangoTransporte = ".$this -> idRangoTransporte.", precioTransporte = ".$this -> precioTransporte." WHERE idOrden = ".$this -> idOrden;
		$con->ejecutar_sentencia($sql);
	}

	function modificarPrecio(){
		$con = new conexion();
		$sql = "UPDATE orden SET subtotal = ".$this -> subtotal." where idOrden = ".$this->idOrden;
		$con->ejecutar_sentencia($sql);
	}

	function modificarPrecioNotmonday(){
		$con = new conexion();
		$sql = 'UPDATE orden SET importeTotal = '.$this -> importeTotal.' WHERE idOrden = '.$this -> idOrden;
		$con -> ejecutar_sentencia($sql);
	}
	/*
	function updateStatus(){
		$con= new conexion();
		$sql="update orden set status='".$this->status."' where idOrden=".$this->idOrden;
		$con->ejecutar_sentencia($sql);
	}
	*/

	function updateHoraPago(){
		date_default_timezone_set('America/Mexico_City');
		$currentHour = date('H:i:s');
		$con = new conexion();
		$sql = "UPDATE orden SET horaPago = '".$currentHour."' WHERE idOrden = ".$this -> idOrden;
		$con -> ejecutar_sentencia($sql);
	}
	function updateVistoOrden(){
		$con = new conexion();
		$sql = "UPDATE orden SET visto = 1 WHERE idOrden = ".$this -> idOrden;
		$con -> ejecutar_sentencia($sql);
	}
	function verifyDetalleCarro(){
		$con = new conexion();
		$sql = "SELECT count(idOrden) as total FROM detalle_orden WHERE idOrden = ".$this -> idOrden." GROUP BY idOrden";
		$temporal = $con -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		return $obj;
	}
	function cancelarOrden(){
		$con= new conexion();
		$sql="update orden set status = 1 where idOrden=".$this->idOrden;
		$con->ejecutar_sentencia($sql);
	}
	function eliminar_orden(){
		$con= new conexion();
		$sql="delete from orden where idOrden=".$this->idOrden;
		$con->ejecutar_sentencia($sql);
	}
	function listar_orden($condicion = false){
		if($condicion){
			$pedazo = 'WHERE (status = 3 OR status = 4) AND tipoPagoTransporte = "dilobonito"';
		}else{
			$pedazo = '';
		}
		$con= new conexion();
		$sql="select * from orden ".$pedazo." order by idOrden desc";
		$temporal=$con->ejecutar_sentencia($sql);
		$resultados=array();
		while($fila = mysqli_fetch_array($temporal)){
			$registro=array();
			$registro['idOrden']=$fila['idOrden'];
			$registro['fecha']=date("d/m/Y", strtotime($fila['fecha']));
			$registro['idCliente']=$fila['idCliente'];
			$clientes = new userend($registro['idCliente']);
			$clientes->obteneDatosUserend();
			$registro['nombre'] = $clientes->datosuserend->nombre;
			$registro['apellido'] = $clientes->datosuserend->apellido;
			$registro['cantidad']=$fila['cantidad'];
			$registro['subtotal']=$fila['subtotal'];
			$registro['status']=$fila['status'];
			$registro['idDireccion'] = $fila['idDireccion'];
			$registro['peso'] = $fila['peso'];
			$registro['tipoPago'] = $fila['tipoPago'];
			$registro['tipoPagoTransporte'] = $fila['tipoPagoTransporte'];
			if($fila['tipoPagoTransporte'] == 'dilobonito'){
				$kit = new kit($fila['idTransporte']);
				$kit -> getKit();
				$registro['ruta'] = $kit -> rutaKit;
				$registro['nombreKit'] = $kit -> tituloKit;
				$registro['precioTransporte'] = $fila['precioTransporte'];
			}
			$registro['statusEnvioBonito'] = $fila['statusEnvioBonito'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	/*
	function obtener_orden(){
		$con= new conexion();
		$sql="select * from orden where idOrden=".$this->idOrden;
		$temporal=$con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)){
			$this->idOrden=$fila['idOrden'];
			$this->fecha=date('d/m/Y', strtotime($fila['fecha']));
			$this->idCliente=$fila['idCliente'];
			$this->cantidad= $fila['cantidad'];
			$this->subtotal=$this->herramientas->numformat($fila['subtotal']);
			$this->preciofinal = $fila['subtotal'];
			$this->status=$fila['status'];
			$this->idTransporte=$fila['idTransporte'];
			$this->idRangoTransporte=$fila['idRangoTransporte'];
			$this->transportes = new rango_transporte($this->idRangoTransporte);
			$this->transportes->obtener_rango_transporte();
			$this->precioTransporte = $fila['precioTransporte'];
			$this->tipoPagoTransporte = $fila['tipoPagoTransporte'];
			$this->peso=$fila['peso'];
			$this->idDireccion = $fila['idDireccion'];
			$this->tipoPago = $fila['tipoPago'];
			$this -> fechaEntrega = $fila['fechaEntrega'];
			$this -> textoTarjeta = htmlspecialchars_decode($fila['textoTarjeta']);
			$this -> tipoPagoEntrega = $fila['tipoPagoEntrega'];
			$this -> importeTotal = $fila['importeTotal'];
			$this -> statusEnvioBonito = $fila['statusEnvioBonito'];

		}
		mysqli_free_result($temporal);
	}
	*/
	function obtenerTransporteOrden(){
		$con = new conexion();
		$sql = "SELECT transportes.idTransporte, nombre, tiempo_transito, peso_maximo,cargo_por_envio
				FROM transportes, rangos_transporte
				WHERE transportes.idTransporte = rangos_transporte.idTransporte
				AND rangos_transporte.idRangoTransporte = ".$this->idRangoTransporte."";
		$result = $con->ejecutar_sentencia($sql);
		$row = mysqli_fetch_object($result);
		return $row;
	}
	function valida_orden(){
		$bandera=0;
		$this->obtener_orden();
		if($this->idCliente != 0){
			$bandera=1;
		}
		else{
			$bandera=2;
		}
		return $bandera;
	}

	function recuperar_datos_orden(){
			$this->datosOrden->obtener_datos_Orden();
	}
	/** Metodos para Catalogo de Datos orden **/
	function asocia_usuario_orden($idCliente,$orden){
		$con= new conexion();
		$sql="update orden set idCliente='".$idCliente."' where idOrden=".$orden;
		return $con->ejecutar_sentencia($sql);
	}
	function agregar_datos_orden($nombre,$email,$telefono,$direccion){
		$datos_temp=new datosorden($this->idOrden,'','',0,'');
		$datos_temp->insertar_datos_Orden($idOrden);
	}
	function obtener_datosorden($id){
		 $con= new conexion();
		 $sql="select orden.idOrden, datosorden.nombre,email,telefono,direccion from orden, datosorden where orden.idOrden=datosorden.idOrden and orden.idOrden=".$id;
		 $resultados=$con->ejecutar_sentencia($sql);
		 while($row=mysqli_fetch_array($resultados)){
		  $this->idOrden=$row['idOrden'];
		  $this->nombre=$row['nombre'];
		  $this->email=$row['email'];
		  $this->telefono=$row['telefono'];
		  $this->direccion=$row['direccion'];
		}
		mysqli_free_result($resultados);
	}
	function insertar_Datos_Orden($nombre,$email,$telefono,$direccion){
		$this->datosOrden->nombre=$nombre;
		$this->datosOrden->email=$email;
		$this->datosOrden->telefono=$telefono;
		$this->datosOrden->direccion=$direccion;
		$this->datosOrden->insertar_datos_Orden();
	}
	function  modificar_Datos_Orden($nombre,$email,$telefono,$direccion){
		$this->datosOrden->nombre=$nombre;
		$this->datosOrden->email=$email;
		$this->datosOrden->telefono=$telefono;
		$this->datosOrden->direccion=$direccion;
		$this->datosOrden->modificar_datos_Orden();
	}
	function eliminar_Datos_Orden($idOrden){
		$datos= new datosorden($idOrden,'','',0,'');
		$datos->deleteDatosOrden();
	}
	function update_status(){
		$con=new conexion();
		$sql="UPDATE orden SET status=".$this->status." WHERE idOrden=".$this->idOrden.";";
		$result=$con->ejecutar_sentencia($sql);
	}

	/*===================================================
	 * Inicia Modificaciones de Luis
	 * =================================================*/

	 function listarclientesorden(){
	 	$con= new conexion();
		$sql="select idOrden,idCliente from orden group by idCliente";
		$temporal=$con->ejecutar_sentencia($sql);
		$resultados=array();
		while($fila = mysqli_fetch_array($temporal)){
			$registro=array();
			$registro['idOrden']=$fila['idOrden'];
			$registro['idCliente']=$fila['idCliente'];
			$clientes = new userend($registro['idCliente']);
			$clientes->obtener_userend();
			$registro['nombre'] = $clientes->nombre;
			$registro['apellido'] = $clientes->apellido;
			$registro['mail'] = $clientes->email;
			$registro['status'] = $fila['status'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	 }

	 function listarHistorial($idcliente)
	 {
		$con = new conexion();
		$sql="SELECT *
			FROM orden, detalleorden
			WHERE orden.idOrden = detalleorden.idOrden
			AND idCliente =".$idcliente."
			AND status = 3";
		$result=$con->ejecutar_sentencia($sql);
		$resultados= array();
		while($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['idproducto']=$row['idproducto'];
			$productos = new producto($registro['idproducto']);
			$productos->obtenerProducto();
			$registro['titulo'] = $productos->titulo;
			$registro['ruta'] = $productos->ruta;
			$registro['limite'] = $productos->limite;
			$registro['fecha'] = $row['fecha'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}

	function listarDescargas()
	{
		$con = new conexion();
		$sql="SELECT *
			FROM orden, detalleorden
			WHERE orden.idOrden = detalleorden.idOrden
			group by idproducto";
		$result=$con->ejecutar_sentencia($sql);
		$resultados= array();
		while($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['idproducto']=$row['idproducto'];
			$productos = new producto($registro['idproducto']);
			$productos->obtenerProducto();
			$registro['titulo'] = $productos->titulo;
			$registro['ruta'] = $productos->ruta;
			$registro['limite'] = $productos->limite;
			$registro['fecha'] = $row['fecha'];
			$registro['precio'] = $productos->precio;
			$PxC = new productoxcliente();
			$listaPxC = $PxC->listarProductosTodos($registro['idproducto']);
			$registro['totalproductos'] = count($listaPxC);
			array_push($resultados, $registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}

	function listarRecientes($idcliente){
		$con = new conexion();
		$sql="SELECT *
			FROM orden, detalleorden
			WHERE orden.idOrden = detalleorden.idOrden
			AND idCliente=".$idcliente."
			AND status = 3
			ORDER BY iddetalleorden DESC
			LIMIT 2";
		$result=$con->ejecutar_sentencia($sql);
		$resultados= array();
		while($row=mysqli_fetch_array($result))
		{
			$registro=array();
			$registro['idproducto']=$row['idproducto'];
			$productos = new producto($registro['idproducto']);
			$productos->obtenerProducto();
			$registro['titulo'] = $productos->titulo;
			$registro['ruta'] = $productos->ruta;
			$registro['limite'] = $productos->limite;
			$registro['fecha'] = $row['fecha'];
			$registro['precio'] = $row['precio'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}

	function listarTrasnportexProducto($idproducto){
		$resultados = array();
		$con = new conexion();
		$sql = "select productos_transportes.idTransporte, nombre, tiempo_transito, idRangoTransporte
				from productos_transportes, transportes, rangos_transporte
				where productos_transportes.idTransporte = transportes.idTransporte
				and productos_transportes.idTransporte = rangos_transporte.idTransporte
				and transportes.status = 1
				and id_producto = ".$idproducto." group by rangos_transporte.idTransporte";
		$result = $con->ejecutar_sentencia($sql);
		while($row = mysqli_fetch_array($result)){
			$registro = array();
			$registro['idTransporte'] = $row['idTransporte'];
			$registro['idRangoTransporte'] = $row['idRangoTransporte'];
			$registro['nombre'] = $row['nombre'];
			$registro['tiempo_transito'] = $row['tiempo_transito'];
			array_push($resultados, $registro);
		}
		return $resultados;
	}

	function obtenerTotalPesoOrden($idOrden,$pesoTotal){
		$con = new conexion();
		$sql2 = "update orden set peso =".$pesoTotal." where idOrden =".$idOrden;
		$con->ejecutar_sentencia($sql2);
	}

	function guardarCodigoBarras($idOrden, $total, $barcode, $img){
		$con  = new conexion();
		$sql = "INSERT INTO codigoBarras (idOrden, total, barcode, imagen) VALUES (".$idOrden.", '".$total."', '".$barcode."', '".$img."')";
		$con -> ejecutar_sentencia($sql);
	}

	function obtenerCodigoBarras(){
		$sql = "SELECT * FROM codigoBarras WHERE idOrden = ".$this -> idOrden;
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		return $obj;
	}

	function agregarTipoOrden($idOrden,$tipoPago){
		$con  = new conexion();
		$sql = "UPDATE orden SET tipoPago = '".$tipoPago."' WHERE idOrden = ".$idOrden;
		$con -> ejecutar_sentencia($sql);
	}

	function getLatestSales($limit = true){
		($limit) ? $_limit = ' LIMIT 5' : $_limit = '';
		$con = new conexion();
		$sql = "SELECT idOrden, datosuserend.nombre, datosuserend.apellido, precioTransporte, importeTotal, fecha, horaPago, tipoPagoTransporte FROM orden, datosuserend WHERE orden.idCliente = datosuserend.idCliente AND status = 3 AND visto = 0 ORDER BY idOrden DESC ".$_limit;
		$temporal = $con -> ejecutar_sentencia($sql);
		$resultados = array();
		while($row = mysqli_fetch_array($temporal)){
			$registro['idOrden'] = $row['idOrden'];
			$registro['nombre'] = $row['nombre'].' '.$row['apellido'];
			$registro['total'] = $row['precioTransporte'] + $row['importeTotal'];
			$registro['tipoPagoTransporte'] = $row['tipoPagoTransporte'];
			$fechaCompleta = $row['fecha'].' '.$row['horaPago'];
			$registro['tiempoTranscurrido'] = $this -> herramientas -> calculate_time_span($fechaCompleta);
			array_push($resultados, $registro);
		}
		return $resultados;
	}

	function updateStatusVisto(){
		$con = new conexion();
		$sql = "UPDATE orden SET visto = 1 WHERE visto = 0";
		$con -> ejecutar_sentencia($sql);
	}

	/*funciones carlos baas*/

	function getHistorialCliente(){
		$sql = "SELECT * FROM orden WHERE idCliente = ".$this -> idCliente." AND (status = 3 or status = 4 or status = 5) ORDER BY fecha DESC";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$resultados = array();
		while($row = mysqli_fetch_array($temporal)){
			$registro['idOrden'] = $row['idOrden'];
			$registro['fecha'] = date('d-m-Y', strtotime($row['fecha']));
			$registro['idCliente'] = $row['idCliente'];
			$status = $row['status'];
			if($status == 3)
				$registro['status'] = 'Pagado sin enviar';
			if($status == 4)
				$registro['status'] = 'Pagado y enviado';
			if($status == 5)
				$registro['status'] = 'Completado';
			$registro['importeTotal'] = $row['importeTotal'];
			$registro['cantidad'] = $row['cantidad'];
			$detalleOrden = new detalle_orden($row['idOrden']);
			$detalleOrden -> obtener_productos_orden();
			$registro['detalleOrden'] = $detalleOrden -> productos;
			array_push($resultados, $registro);
		}
		return $resultados;
	}

	function obtener_orden(){
		$con= new conexion();
		$sql="select * from orden where idOrden=".$this->idOrden;
		$temporal=$con->ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)){
			$this->idOrden=$fila['idOrden'];
			$this->fecha=date('d/m/Y', strtotime($fila['fecha']));
			$this->idCliente=$fila['idCliente'];
			$this->cantidad= $fila['cantidad'];
			$this->total_productos=$this->herramientas->numformat($fila['importeTotal']);
			$this->subtotal=$this->herramientas->numformat($fila['subtotal']);
			$this->subtotalBase = $fila['subtotal'];
			$this->transporte=$this->herramientas->numformat($fila['precioTransporte']);
			$total = $fila['importeTotal'];
			$this->total=$this->herramientas->numformat($total);
			$this->total_productosbase=$total;
			$this->importeTotal=$total;
			$this->status=$fila['status'];
			$this -> precioDescuento = $fila['precioDescuento'];
		}
		mysqli_free_result($temporal);
	}

	function listOrden($pagina = 1, $json = false, $backEnd=false, $busqueda=''){
		$resultados=array();
		if($busqueda != "")
		{
			$pedazo='AND (datosorden.nombreCliente LIKE "%' . trim($busqueda) . '%")';
		}
		$sql="select orden.idOrden, orden.fecha, datosorden.nombreCliente, orden.cantidad, orden.importeTotal, orden.status from orden, datosorden where orden.idOrden = datosorden.idOrden ".$pedazo." order by orden.idOrden desc";
		$con=new conexion();
		$temporal= $con->ejecutar_sentencia($sql);
		if(!$backEnd)
		{
			$this -> totalRegistros = mysqli_num_rows($temporal);
			$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);
			$paginaActual = $pagina;

			$sql .= ' LIMIT '.($pagina - 1) * $this->registrosPorPagina.','.$this->registrosPorPagina;
			$temporal2 = $con -> ejecutar_sentencia($sql);
			$final=$temporal2;
		}
		else{
			$final=$temporal;
		}
		$sql;
		while ($fila = mysqli_fetch_array($final))
		{
			$sql3="select * from metodopago where idorden='".$fila['idOrden']."'";
			$temporal3 = $con -> ejecutar_sentencia($sql3);
			$fila2 = mysqli_fetch_array($temporal3);
			$registro=array();
			$registro['idOrden']=$fila['idOrden'];
			$registro['fecha']=date("m/d/Y", strtotime($fila['fecha']));
			$registro['idCliente']=$fila['idCliente'];
			$registro['nombre'] = $fila['nombreCliente'];
			$registro['cantidad']=$fila['cantidad'];
			$registro['importeTotal']=$fila['importeTotal'];
			$registro['status']=$fila['status'];
			if($fila2['metodo']=="")
			{
				$registro['metodo']='Paypal';
			}else{
				$registro['metodo']=$fila2['metodo'];
			}
			$registro['totalRegistros']=$this->totalRegistros;
			if(!$backEnd)
			{
			$registro['ultimapagina']=$ultimaPagina;
			$registro['paginaanterior']=$pagina-1;
			$registro['paginasiguiente']=$pagina+1;
			$registro['pagina']=$pagina;
			}
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		if($json) echo json_encode($resultados); else return $resultados;
	}

	function deleteOrden(){
		$sql = "DELETE FROM orden WHERE idOrden = ".$this -> idOrden;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
		$sql2 = "DELETE FROM detalle_orden WHERE idOrden = ".$this -> idOrden;
		$conexion -> ejecutar_sentencia($sql2);
	}

	function desasigna_detalleorden(){
		$con = new conexion();
		$sql="delete from detalle_orden where idOrden=".$this->idOrden;
		$con->ejecutar_sentencia($sql);
	}

	function updateStatus($status){
		$con= new conexion();
		$sql="update orden set status='".$status."' where idOrden=".$this->idOrden;
		$con->ejecutar_sentencia($sql);
	}

}

?>
