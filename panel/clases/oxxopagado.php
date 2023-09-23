<?php
session_start();
function __autoload($nombre_clase) {
    include ''.$nombre_clase .'.php';
}
?>

<?php
$body = @file_get_contents('php://input');
$event_json = json_decode($body);


$item_number=$event_json->data->object->reference_id;
$item_name=$event_json->data->object->description;
?>


<?php



			switch($event_json->type)
			{
				case 'charge.paid':
				    if($item_name=='Orden de Compra Oxxo Lanita')
					{
						
					$orden = new orden($item_number);
					$orden->updateStatus(3);
					$orden->obtener_orden();
					
					$detalle=new detalle_orden($item_number);
        			$detalle->obtener_productos_orden();
        			
        			$datosOrden = new datosOrden($item_number);
        			$datosOrden -> getDatosOrden();

        			if($datosOrden -> cuponDescuento != ''){
	        			$codigo = new codigo();
	        			$codigo -> getCodigoByName($datosOrden -> cuponDescuento);
	        			if($codigo -> tipo == 1){
	        				$codigo -> aumentarUso();
	        				$codigo -> getCodigo();
	        				if($codigo -> contadorDeUso >= $codigo -> limiteUso){
	        					$codigo -> updateStatusCodigo(0);
	        				}
	        			}else{
	        				$clientexcodigo = new clientexcodigo($orden -> idCliente, $codigo -> idCodigo);
							$clientexcodigo -> addClientexCodigo();
	        			}
	        		}
        			

        			foreach($detalle->productos as $elemento){
						if($elemento->idCombinacion == 0){  
                        $prod=new producto($elemento->idProducto);
                        $prod->disminuir_inventario($elemento->cantidad);
						}
						else{
						$comb = new combinacion($elemento->idCombinacion);
                        $comb->disminuir_inventario($elemento->cantidad);	
						}
                        	
                    }
					
					if($datosOrden->crear==1){
						$cliente = new cliente(0, $datosOrden -> emailCliente, $datosOrden -> password, $datosOrden -> emailCliente);
						$cliente -> addCliente();
						$cliente -> agregarDatosCliente($datosOrden -> nombreCliente, "", $datosOrden -> telefonoCliente, $datosOrden -> direccionCliente, $datosOrden -> estadoCliente, $datosOrden ->ciudadCliente, $datosOrden ->cpCliente);
					}

                    $correoProcesandoOrden = new correoProcesandoOrden($item_number);
					$correoProcesandoOrden->enviar();
					$correoStaff = new correoNotificacionStaff(5);
        			$correoStaff->enviar(); 	
					
								
					
					}
					
					 
				   
				break;
				
			}
	

	


?>