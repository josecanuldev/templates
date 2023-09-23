<?php
require_once 'conexion.php';
require_once 'datosCliente.php';
require_once 'direccion.php';

class cliente{
	var $idCliente;
	var $username;
	var $password;
	var $email;
	var $token;
	var $fuid;

	var $orden;
	var $status;
	var $cliente;
	var $direccion;
	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idCliente = 0,  $username = '', $password = '', $email = '', $fuid = ''){
		$this -> idCliente = $idCliente;
		$this -> username = $username;
		$this -> password = $password;
		$this -> email = $email;
		$this -> fuid = $fuid;

		$this -> direccion = array();

		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addCliente(){
		$sql = "INSERT INTO cliente(username, password, email, token, fuid, status) VALUES ('".htmlspecialchars($this -> username, ENT_QUOTES)."', md5('".$this -> password."'), '".$this -> email."', md5('".$this -> email."'), '".$this -> fuid."', 1)";
		$conexion = new conexion();
		$this -> idCliente = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE cliente SET orden = ".$this -> idCliente." WHERE idCliente = ".$this -> idCliente;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateCliente(){
		$conexion = new conexion();
		if($this -> username != ''){
			$username = "UPDATE cliente SET username = '".htmlspecialchars($this -> username, ENT_QUOTES)."' WHERE idCliente =".$this -> idCliente;
			$conexion -> ejecutar_sentencia($username);
		}

		if($this -> password != ''){
			$password = "UPDATE cliente SET password = md5('".$this -> password."') WHERE idCliente = ".$this -> idCliente;
			$conexion -> ejecutar_sentencia($password);
		}

		if($this -> email != ''){
			$email = "UPDATE cliente SET email = '".htmlspecialchars($this -> email, ENT_QUOTES)."', token = md5('".$this -> token."') WHERE idCliente = ".$this -> idCliente;
			$conexion -> ejecutar_sentencia($email);
		}
	}

	function resetPass($_token = '', $_pass = ''){
		$conexion = new conexion();
		$password = "UPDATE cliente SET password = md5('".$_pass."') WHERE token = '".$_token."' ";
		$conexion -> ejecutar_sentencia($password);
	}

	function updateFuidCliente(){
		$fuid = "UPDATE cliente SET fuid = '".$this -> fuid."' WHERE email = '".$this -> email."'";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($fuid);
		$sql = "SELECT idCliente FROM cliente WHERE email = '".$this -> email."'";
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idCliente = $obj -> idCliente;
	}

	function verificarCliente($tipo = 0, $valor = '', $fuid = ''){
		$conexion = new conexion();
		if($tipo == 1){
			$username = "SELECT username FROM cliente WHERE username = '".$valor."' ";
			$temporal = $conexion -> ejecutar_sentencia($username);
			$contar = mysqli_num_rows($temporal);
			if($contar == 0) return true; else return false;
		}else if($tipo == 2){
			$email = "SELECT email FROM cliente WHERE email = '".$valor."' ";
			$temporal = $conexion -> ejecutar_sentencia($email);
			$contar = mysqli_num_rows($temporal);
			if($contar == 0) return true; else return false;
		}else if($tipo == 3){
			$sql = "SELECT fuid FROM cliente WHERE email = '".$valor."' OR fuid = '".$fuid."'";
			$temporal = $conexion -> ejecutar_sentencia($sql);
			$contar = mysqli_num_rows($temporal);
			if($contar > 0) return false; else return true;
		}else if($tipo == 4){
			$sql = "SELECT fuid FROM cliente WHERE email = '".$valor."' AND fuid = '".$fuid."'";
			$temporal = $conexion -> ejecutar_sentencia($sql);
			$contar = mysqli_num_rows($temporal);
			if($contar > 0) return true; else return false;
		}
	}

	function existCorreo($_correo = ''){
		$conexion = new conexion();
		$sql = "SELECT email FROM cliente WHERE email = '".$_correo."' AND status = 1";
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$contar = mysqli_num_rows($temporal);
		if($contar > 0) return true; else return false;
	}

	function deleteCliente(){
		$sql = "DELETE FROM cliente WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenCliente($orden){
		$sql = "UPDATE cliente SET orden = ".$orden." WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusCliente($status){
		$sql = "UPDATE cliente SET status = ".$status." WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getCliente(){
		$sql = "SELECT * FROM cliente WHERE idCliente = ".$this -> idCliente;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idCliente = $obj -> idCliente;
		$this -> username = $obj -> username;
		$this -> email = $obj -> email;
		$this -> obtenerDatosCliente();
		//$this -> listDireccion();
	}

	function getToken($_correo){
		$conexion = new conexion();
		$sql = "SELECT token FROM cliente WHERE email = '".$_correo."' ";
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> token = $obj -> token;
	}

	function listCliente($pagina = 1, $busqueda = "", $frontEnd = false){
		($busqueda != '') ? $palabra = " AND (username LIKE '%".$busqueda."%') " : $palabra = '';
		($fronEnd) ? $status = ' AND status = 1 ' : $status = '';

		$sql = "SELECT * FROM cliente WHERE 1 = 1".$palabra.$status;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);

		if(!$frontEnd){
			$this -> totalRegistros = mysqli_num_rows($temporal);
			$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);
			$paginaActual = $pagina;

			$sql .= ' LIMIT '.($pagina - 1) * $this -> registrosPorPagina.', '.$this -> registrosPorPagina;
			$temporal2 = $conexion -> ejecutar_sentencia($sql);
			$final = $temporal2;
		}
		else{
			$final = $temporal;
		}

		$resultados = array();
		while($row = mysqli_fetch_array($final)){
			$registro['idCliente'] = $row['idCliente'];
			$registro['username'] = htmlspecialchars_decode($row['username']);
			$registro['email'] = $row['email'];
			$registro['status'] = $row['status'];
			$registro['orden'] = $row['orden'];
			if(!$frontEnd){
				$registro['ultimapagina']=$ultimaPagina;
				$registro['paginaanterior']=$pagina-1;
				$registro['paginasiguiente']=$pagina+1;
				$registro['pagina']=$pagina;
			}
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function login($email = '', $password = ''){
		$sql = "SELECT idCliente FROM cliente WHERE email = '".$email."' AND password = md5('".$password."')";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		if(mysqli_num_rows($temporal) > 0){
			$obj = mysqli_fetch_object($temporal);
			$this -> idCliente = $obj -> idCliente;
		}
	}

	function errorLogin($email = ''){
		$sql = "SELECT email FROM cliente WHERE email = '".$email."'";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		if(mysqli_num_rows($temporal) > 0){
			$bandera = 1;
		}else{
			$bandera = 0;
		}
		return $bandera;
	}

	function disponibilidadCorreoFront($correo)
	{
		$conexion=new conexion();
		$sql="SELECT email FROM cliente where email='".$correo."'";
		$result=$conexion->ejecutar_sentencia($sql);
		$resultados = mysqli_num_rows($result);
		if ($resultados > 0){
			return false;
		}else{
			return true;
		}
	}

	function agregarDatosCliente($nombre = '', $apellido = '', $telefono = '', $direccion = '', $estado = '', $ciudad = '', $cp = ''){
		$temporalDatosCliente = new datosCliente($this -> idCliente, $nombre, $apellido, $direccion, $telefono, $estado, $ciudad, $cp);
		$temporalDatosCliente -> addDatosCliente();
	}

	function modificarDatosCliente($nombre = '', $apellido = '', $telefono = '', $direccion = '', $estado = '', $ciudad = '', $cp = ''){
		$temporalDatosCliente = new datosCliente($this -> idCliente, $nombre, $apellido, $direccion, $telefono, $estado, $ciudad, $cp);
		$temporalDatosCliente -> updateDatosCliente();
	}

	function elmininarDatosCliente(){
		$temporalDatosCliente = new datosCliente($this -> idCliente);
		$temporalDatosCliente -> deleteDatosCliente();
	}

	function obtenerDatosCliente(){
		$temporalDatosCliente = new datosCliente($this -> idCliente);
		$this -> datosCliente = $temporalDatosCliente -> getDatosCliente();
	}

	function agregarDireccion($nombreDireccion = '', $nombre = '', $apellido = '', $email = '', $direccion = '', $telefono = '', $estado = '', $ciudad = '', $cp = ''){
		$direccion = new direccion(0,$this -> idCliente, $nombreDireccion, $nombre, $apellido, $email, $direccion, $telefono, $estado, $ciudad, $cp);
		$direccion -> addDireccion();
	}
	function modificarDireccion($idDireccion = 0, $nombreDireccion = '', $nombre = '', $apellido = '', $email = '', $direccion = '', $telefono = '', $estado = '', $ciudad = '', $cp = ''){
		$direccion = new direccion($idDireccion, $this -> idCliente, $nombreDireccion, $nombre, $apellido, $email, $direccion, $telefono, $estado, $ciudad, $cp);
		$direccion -> updateDireccion();
	}
	function eliminarDireccion($idDireccion = 0){
		$direccion = new direccion($idDireccion);
		$direccion -> deleteDireccion();
	}
	function listDireccion(){
		$temporalDireccion = new direccion(0,$this -> idCliente);
		$this -> direccion = $temporalDireccion -> listDireccion();
	}

}
?>
