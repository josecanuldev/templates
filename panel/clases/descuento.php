<?php

require_once 'conexion.php';
require_once 'descuentoxproducto.php';
require_once 'herramientas.php';
require_once 'categoria.php';

class descuento{
	/* =================================
	 * VARIABLES PARA LA ENTIDAD CODIGO
	 * ================================= */
	var $idDescuento;
	var $idCategoria;
	var $nombre;
	var $fechaExpiracion;
	var $fechaExpMostrar;
	var $fechaInicio;
	var $fechaIniMostrar;
	/* 
	 * Este tipo es para las personas que va dirigido los cuales son
	 * 1 = SOLO CATEOGORIAS
	 * 2 = PRODUCTOS DE LA CATEGORIA
	 */
	var $tipo;
	/* 
	 * El limite de uso se define por el tipo de descuento ya sea
	 * por PUBLICO o REGISTRADOS
	 */
	var $limiteUso;
	/*
	 * Este tipo es para los descuentos donde
	 * 1 = PORCENTAJE
	 * 2 = EFECTIVO
	 * 3 = ENVIO GRATIS
	 */
	var $tipoDescuento;
	var $precioDescuento;
	var $prioridad;
	
	var $herramientas;
	var $orden;
	var $status;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idDescuento = 0, $idCategoria = 0, $nombre = '', $fechaInicio = '', $fechaExpiracion = '', $tipo = 0, $limiteUso = '', $tipoDescuento = '', $precioDescuento = 0, $prioridad = 0){
		$this -> idDescuento = $idDescuento;
		$this -> idCategoria = $idCategoria;
		$this -> nombre = $nombre;
		$this -> fechaInicio = $fechaInicio;
		$this -> fechaExpiracion = $fechaExpiracion;
		$this -> tipo = $tipo;
		$this -> limiteUso = $limiteUso;
		$this -> tipoDescuento = $tipoDescuento;
		$this -> precioDescuento = $precioDescuento;
		$this -> prioridad = $prioridad;
		
		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addDescuento(){
		$sql = "INSERT INTO descuento(idCategoria, nombre, fechaInicio, fechaExpiracion, tipo, limiteUso, tipoDescuento, precioDescuento, prioridad, status) VALUES (".$this -> idCategoria.", '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', '".$this -> fechaInicio."', '".$this -> fechaExpiracion."', ".$this -> tipo.", ".$this -> limiteUso.", '".$this -> tipoDescuento."', ".$this -> precioDescuento.", ".$this -> prioridad.", 1)";
		$conexion = new conexion();
		$this -> idDescuento = $conexion -> ejecutar_sentencia($sql);
		$sqlOrden = "UPDATE descuento SET orden = ".$this -> idDescuento." WHERE idDescuento = ".$this -> idDescuento;
		$conexion -> ejecutar_sentencia($sqlOrden);
	}

	function updateDescuento(){
		$sql = "UPDATE descuento SET idCategoria = ".$this -> idCategoria.", nombre = '".htmlspecialchars($this -> nombre, ENT_QUOTES)."', fechaInicio = '".$this -> fechaInicio."', fechaExpiracion = '".$this -> fechaExpiracion."', limiteUso = ".$this -> limiteUso.", tipoDescuento = '".$this -> tipoDescuento."', precioDescuento = ".$this -> precioDescuento.", prioridad = ".$this -> prioridad." WHERE idDescuento = ".$this -> idDescuento;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateTipo($_tipo){
		$sql = "UPDATE descuento SET tipo = ".$_tipo." WHERE idDescuento = ".$this -> idDescuento;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteDescuento(){
		$this -> _removeProductoxDescuento();
		$sql = "DELETE FROM descuento WHERE idDescuento = ".$this -> idDescuento;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateOrdenDescuento($orden){
		$sql = "UPDATE descuento SET orden = ".$orden." WHERE idDescuento = ".$this -> idDescuento;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateStatusDescuento($status){
		$sql = "UPDATE descuento SET status = ".$status." WHERE idDescuento = ".$this -> idDescuento;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function getDescuento(){
		$herramientas = new herramientas();
		$sql = "SELECT * FROM descuento WHERE idDescuento = ".$this -> idDescuento;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idDescuento = $obj -> idDescuento;
		$this -> idCategoria = $obj -> idCategoria;
		$this -> nombre = $obj -> nombre;
		$this -> fechaInicio = $obj -> fechaInicio;
		$this -> fechaIniMostrar = $herramientas -> getFormatedDate($obj -> fechaInicio);
		$this -> fechaExpiracion = $obj -> fechaExpiracion;
		$this -> fechaExpMostrar = $herramientas -> getFormatedDate($obj -> fechaExpiracion);
		$this -> tipo = $obj -> tipo;
		$this -> tipoDescuento = $obj -> tipoDescuento;
		$this -> precioDescuento = $obj -> precioDescuento;
		$this -> prioridad = $obj -> prioridad;
	}

	function getDescuentoxCategoria(){
		$herramientas = new herramientas();
		$sql = "SELECT * FROM descuento WHERE idCategoria = ".$this -> idCategoria;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idDescuento = $obj -> idDescuento;
		$this -> idCategoria = $obj -> idCategoria;
		$this -> nombre = $obj -> nombre;
		$this -> fechaInicio = $obj -> fechaInicio;
		$this -> fechaIniMostrar = $herramientas -> getFormatedDate($obj -> fechaInicio);
		$this -> fechaExpiracion = $obj -> fechaExpiracion;
		$this -> fechaExpMostrar = $herramientas -> getFormatedDate($obj -> fechaExpiracion);
		$this -> tipo = $obj -> tipo;
		$this -> tipoDescuento = $obj -> tipoDescuento;
		$this -> precioDescuento = $obj -> precioDescuento;
		$this -> prioridad = $obj -> prioridad;
	}


	function existeDescuento($_idCategoria = 0, $_frontEnd = false){
		$_currentDate = date('Y-m-d');
		($_frontEnd) ? $status = " AND status = 1 AND fechaInicio <= '".$_currentDate."' AND fechaExpiracion >= '".$_currentDate."' " : $status = "";
		$sql = "SELECT count(idCategoria) as total FROM descuento WHERE  idCategoria = ".$_idCategoria.$status;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		if($obj -> total > 0) return true; else return false;
	}

	function listDescuento($pagina = 1, $busqueda = "", $frontEnd = false, $registrosPorPagina = 20, $_idCategoria = 0){
		$_currentDate = date('Y-m-d');
		($busqueda != '') ? $palabra = " AND (nombre LIKE '%".$busqueda."%') " : $palabra = '';
		($fronEnd) ? $status = " AND status = 1 AND fechaInicio >= '".$_currentDate." AND fechaExpiracion <= '".$_currentDate."' " : $status = "";
		($_idCategoria != 0) ? $_pedazoCat = ' AND idCategoria = '.$_idCategoria : $_pedazoCat = '';
		
		$sql = "SELECT * FROM descuento WHERE 1 = 1".$_pedazoCat.$palabra.$status;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$herramientas = new herramientas();
		if(!$frontEnd){
			$this -> totalRegistros = mysqli_num_rows($temporal);
			$ultimaPagina = ceil($this -> totalRegistros / $registrosPorPagina);	
			$paginaActual = $pagina;				
				
			$sql .= ' LIMIT '.($pagina - 1) * $registrosPorPagina.', '.$registrosPorPagina;
			$temporal2 = $conexion -> ejecutar_sentencia($sql);
			$final = $temporal2;
		}
		else{
			$final = $temporal;
		}

		$categoria = new categoria();

		$resultados = array();
		while($row = mysqli_fetch_array($final)){
			$registro['idDescuento'] = $row['idDescuento'];
			$registro['idCategoria'] = $row['idCategoria'];
			$registro['nombre'] = htmlspecialchars_decode($row['nombre']);
			$registro['fechaInicio'] = $row['fechaInicio'];
			$registro['fechaInicioMostrar'] = $herramientas -> getFormatedDate($row['fechaInicio']);
			$registro['fechaExpiracion'] = $row['fechaExpiracion'];
			$registro['fechaExpiracionMostrar'] = $herramientas -> getFormatedDate($row['fechaExpiracion']);
			$registro['tipo'] = $row['tipo'];
			if($row['tipo'] == 1){
				$categoria -> _idCategoria = $row['idCategoria'];
				$categoria -> getCategoria();
				$registro['tipoMostrar'] = 'A toda la categoria: '.$categoria -> _tituloEs;
			}else{
				$this -> idDescuento = $row['idDescuento'];
				$registro['tipoMostrar'] = 'A los productos: '.$this -> _listProductosxDescuento(true);
			} 
			$registro['limiteUso'] = $row['limiteUso'];
			$registro['tipoDescuento'] = $row['tipoDescuento'];
			$registro['precioDescuento'] = $row['precioDescuento'];
			if($row['tipoDescuento'] == 1){
				$registro['descuento'] = number_format($row['precioDescuento']).'%';
				$registro['tipoDescuentoMostrar'] = "PORCENTAJE";
			}else if($row['tipoDescuento'] == 2){
				$registro['descuento'] = '$'.number_format($row['precioDescuento'], 2);
				$registro['tipoDescuentoMostrar'] = "EFECTIVO";
			}else if($row['tipoDescuento'] == 3){
				$registro['descuento'] = 'ENVIO GRATIS';
				$registro['tipoDescuentoMostrar'] = "EFECTIVO";
			}
			$registro['prioridad'] = $row['prioridad'];
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

	function getDescuentoDescuento($cupon = ''){
		$sql = "SELECT * FROM descuento WHERE nombre = '".$cupon."'";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$resultado = Array(
			0 => Array('tipoDescuento' => $obj -> tipoDescuento, 'precioDescuento' => $obj -> precioDescuento)
		);
		echo json_encode($resultado);
	}

	function getDescuentoByName($cupon = ''){
		$sql = "SELECT * FROM descuento WHERE nombre = '".$cupon."'";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> idDescuento = $obj -> idDescuento;
		$this -> tipo = $obj -> tipo;
	}

	function validarDescuento($idCategoria = 0, $idProducto = 0, $nombre = '', $num = 1){
		$sql = "SELECT * FROM descuento WHERE nombre = '".$nombre."' AND status = 1";
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		if(mysqli_num_rows($temporal) > 0){
			$obj = mysqli_fetch_object($temporal);
			if($obj -> tipo == 1){
				$descuentoxproducto = new descuentoxproducto($idCliente, $obj -> idDescuento);
				if(!$descuentoxproducto -> existClientexDescuento()){
					if($num == 2){
						$descuentoxproducto -> addClientexDescuento();
						$this -> idDescuento = $obj -> idDescuento;
						$this -> updateStatusDescuento(0);
					}					
					return 1; //Descuento unico aceptado y asignado al usuario.
				}else{
					return 2; //Descuento unico usado. 
				}
			}else{
				$_currentDate = date('Y-m-d');
				if($obj -> fechaExpiracion < $_currentDate){
					$this -> idDescuento = $obj -> idDescuento;
					$this -> updateStatusDescuento(0);
					return 3; //Descuento muchos expirado.
				}else{
					$descuentoxproducto = new descuentoxproducto($idCliente, $obj -> idDescuento);
					if(!$descuentoxproducto -> existClientexDescuento()){
						if($num == 2){
							$descuentoxproducto -> addClientexDescuento();
						}							
						return 4; //Descuento muchos aceptado y asignado al usuario.
					}else{
						return 5; //Descuento muchos usado por este cliente. 
					}
				}
			}	
		}else{
			return 6; //Descuento inválido o caducado
		}
	}


	function _addDescuentoxProducto($_idProducto = 0){
		$descuentoxproducto = new descuentoxproducto($this -> idDescuento, $_idProducto);
		$descuentoxproducto -> addDescuentoxProducto();
	}

	function _listProductosxDescuento($_labels = false){
		$descuentoxproducto = new descuentoxproducto($this -> idDescuento);
		$descuentoxproducto -> listNombreProductoxDescuento();
		if($_labels){
			foreach ($descuentoxproducto -> productos as $_p) {
				$_label .= '<span class="label label-info">'.$_p['titulo'].'</span> ';
			}
			return $_label;
		}else{
			return $descuentoxproducto -> productos;
		}

	}

	function _existProductoxDescuento($_idProducto = 0){
		$descuentoxproducto = new descuentoxproducto($this -> idDescuento, $_idProducto);
		$_response = $descuentoxproducto -> existDescuentoxProducto();
		return $_response;
	}

	function _removeProductoxDescuento(){
		$descuentoxproducto = new descuentoxproducto($this -> idDescuento);
		$descuentoxproducto -> removeDescuento();
	}

	function listCombinacionxProducto($_idProducto = 0){
		$descuentoxproducto = new descuentoxproducto(0, $_idProducto);
		$descuentoxproducto -> listNombreDescuentosxProducto();
		return $descuentoxproducto -> descuentos;
	}
}
?>