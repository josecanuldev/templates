<?php
include_once 'conexion.php';
class datosOrden{
	var $idOrden;
	var $nombreCliente;
	var $emailCliente;
	var $telefonoCliente;
	var $direccionCliente;
	var $ciudadCliente;
	var $estadoCliente;
	var $cpCliente;
	
	var $cuponDescuento;
	var $aplicarDescuentoA;
	var $tipoDescuento;


	var $nombreTransporte;
	var $diasTransporte;
	var $precioTransporte;

	var $facturar;
	var $rfc;
	var $persona;
	var $nombrePersona;
	var $apellidoPersona;
	var $razonSocial;

	var $nombreFactura;
	var $correoFactura;
	var $telefonoFactura;
	var $direccionFactura;
	var $estadoFactura;
	var $ciudadFactura;
	var $cpFactura;

	var $numeroGuia;

	function __construct($idOrden){
		$this -> idOrden = $idOrden;
	}

	function addDatosClienteOrden($nombre = '', $email = '', $telefono = '', $direccion = '', $ciudad = '', $estado = '', $codigoPostal = '', $precioTransporte = 0, $descuento = 0, $cuponDescuento = '', $aplicarDescuentoA = 0){
		$conexion = new conexion();
		$sql = "UPDATE datosorden SET nombreCliente = '".htmlspecialchars($nombre, ENT_QUOTES)."', emailCliente = '".htmlspecialchars($email, ENT_QUOTES)."', telefonoCliente = '".htmlspecialchars($telefono, ENT_QUOTES)."', direccionCliente = '".htmlspecialchars($direccion, ENT_QUOTES)."', ciudadCliente = '".htmlspecialchars($ciudad, ENT_QUOTES)."', estadoCliente = '".htmlspecialchars($estado, ENT_QUOTES)."', cpCliente = '".htmlspecialchars($codigoPostal, ENT_QUOTES)."', precioTransporte = '".$precioTransporte."', nombreTransporte = '".$nombreTransporte."', diasTransporte = '".$diasTransporte."', descuento = '".$descuento."', codigoDescuento = '".$cuponDescuento."', aplicarDescuentoA = '".$aplicarDescuentoA."' WHERE idOrden = ".$this -> idOrden;
		$conexion -> ejecutar_sentencia($sql);
	}
	
	function updateDatosClienteOrden($nombre = '', $email = '', $telefono = '', $direccion = '', $ciudad = '', $estado = '', $codigoPostal = '', $password = '', $crear = 0){
		$conexion = new conexion();
		$sql = "UPDATE datosorden SET nombreCliente = '".htmlspecialchars($nombre, ENT_QUOTES)."', emailCliente = '".htmlspecialchars($email, ENT_QUOTES)."', telefonoCliente = '".htmlspecialchars($telefono, ENT_QUOTES)."', direccionCliente = '".htmlspecialchars($direccion, ENT_QUOTES)."', ciudadCliente = '".htmlspecialchars($ciudad, ENT_QUOTES)."', estadoCliente = '".htmlspecialchars($estado, ENT_QUOTES)."', cpCliente = '".htmlspecialchars($codigoPostal, ENT_QUOTES)."', password = '".htmlspecialchars($password, ENT_QUOTES)."', crearPerfil = '".htmlspecialchars($crear, ENT_QUOTES)."' WHERE idOrden = ".$this -> idOrden;
		$conexion -> ejecutar_sentencia($sql);
	}
		
	function updateDatosFacturacion($facturar = '', $rfc = '', $persona = '', $nombrePersona = '', $apellidoPersona = '', $razonSocial = '', $nombreFactura = '', $correoFactura = '', $telefonoFactura = '', $direccionFactura = '', $estadoFactura = '', $ciudadFactura = '', $cpFactura = ''){
		$conexion = new conexion();	
		$sql = "UPDATE datosorden SET facturar = '".$facturar."', rfc = '".$rfc."', persona = '".$persona."', nombrePersona = '".$nombrePersona."', apellidoPersona = '".$apellidoPersona."', razonSocial = '".$razonSocial."', nombreFactura = '".$nombreFactura."', correoFactura = '".$correoFactura."', telefonoFactura = '".$telefonoFactura."', direccionFactura = '".$direccionFactura."', estadoFactura = '".$estadoFactura."', ciudadFactura = '".$ciudadFactura."', cpFactura = '".$cpFactura."' WHERE idOrden = ".$this -> idOrden;
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateNumeroGuia($_numeroGuia = ''){
		$conexion = new conexion();	
		$sql = "UPDATE datosorden SET numeroGuia = '".$_numeroGuia."' WHERE idOrden = ".$this -> idOrden;
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateDatosDescuento(){
		($this -> tipoDescuento != 'ninguno') ? $_descuento = $this -> tipoDescuento : $_descuento = 0;
		$sql = "UPDATE datosorden SET codigoDescuento = '".$this -> cuponDescuento."', aplicarDescuentoA = '".$this -> aplicarDescuentoA."', tipoDescuento = ".$_descuento." WHERE idOrden = ".$this -> idOrden;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateDatosTransporte(){
		$sql = "UPDATE datosorden SET nombreTransporte = '".$this -> nombreTransporte."', diasTransporte = '".$this -> diasTransporte."' WHERE idOrden = ".$this -> idOrden;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getDatosOrden(){
		$con= new conexion();
		$sql="select * from datosorden where idOrden=".$this->idOrden;
		$temporal=$con->ejecutar_sentencia($sql);		
		while ($fila = mysqli_fetch_array($temporal)){
			$this -> idOrden = $fila['idOrden'];
			$this -> nombreCliente = $fila['nombreCliente'];			
			$this -> emailCliente = $fila['emailCliente'];
			$this -> telefonoCliente = $fila['telefonoCliente'];
			$this -> direccionCliente = $fila['direccionCliente'];
			$this -> ciudadCliente = $fila['ciudadCliente'];
			$this -> estadoCliente = $fila['estadoCliente'];
			$this -> cpCliente = $fila['cpCliente'];
			$this -> nombreTransporte = $fila['nombreTransporte'];
			$this -> diasTransporte = $fila['diasTransporte'];
			$this -> precioTransporte = $fila['precioTransporte'];
			//$this -> codigoDescuento = strtoupper($fila['codigoDescuento']);
			$this -> tipoDescuento = $fila['tipoDescuento'];
			$this -> aplicarDescuentoA = $fila['aplicarDescuentoA'];
			$this -> cuponDescuento = strtoupper($fila['codigoDescuento']);
			$this -> password = $fila['password'];
			$this -> crear = $fila['crearPerfil'];
			$this -> numeroGuia = $fila['numeroGuia'];

			$this -> facturar = $fila['facturar'];
			$this -> rfc = $fila['rfc'];
			$this -> persona = $fila['persona'];
			$this -> nombrePersona = $fila['nombrePersona'];
			$this -> apellidoPersona = $fila['apellidoPersona'];
			$this -> razonSocial = $fila['razonSocial'];
			$this -> nombreFactura = $fila['nombreFactura'];
			$this -> correoFactura = $fila['correoFactura'];
			$this -> telefonoFactura = $fila['telefonoFactura'];
			$this -> direccionFactura = $fila['direccionFactura'];
			$this -> estadoFactura = $fila['estadoFactura'];
			$this -> ciudadFactura = $fila['ciudadFactura'];
			$this -> cpFactura = $fila['cpFactura'];
		}
		mysqli_free_result($temporal);
	}

	function deleteDatosOrden(){
		$sql = "DELETE FROM datosorden WHERE idOrden = ".$this -> idOrden;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}
	
}
?>