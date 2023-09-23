<?php
session_start();
function __autoload($nombre_clase) {
    include ''.$nombre_clase .'.php';
}
require_once("../../pagos/conekta.php");
Conekta::setApiKey("key_X5i6nqY1km8ZFLALDkC8vQ");

$reference_id=$_REQUEST['reference_id'];
$importe=$_REQUEST['importe'] * 100;

try{
  $charge = Conekta_Charge::create(array(
    "amount"=> $importe,
    "currency"=> "MXN",
    "description"=> "Orden de compra Lanita",
    "reference_id"=> "".$reference_id."",
    "card"=> $_POST['conektaTokenId']
 //"tok_a4Ff0dD2xYZZq82d9"
  ));
}catch (Conekta_Error $e){
  $error=$e->getMessage();
  header('location:../../carrito-2.php?success='.$error.'');
}
$status=$charge->status;
?>

<?php


$item_name= $charge->description;


$item_number= $charge->reference_id;

			switch($status)
			{
				case 'paid':							
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
	        				$codigo -> updateStatusCodigo(0);
	        			}else{
	        				$clientexcodigo = new clientexcodigo($orden -> idCliente, $codigo -> idCodigo);
	        				if(!$clientexcodigo -> existClientexCodigo()){
	        					$clientexcodigo -> addClientexCodigo();
	        				}
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
					$correoStaff = new correoNotificacionStaff(3);
        			$correoStaff->enviar(); 
					
					$con= new conexion();
					$metodo='Tarjeta';			
					$sqlr = "insert into metodopago (idorden, metodo) 
					values (
					'".$reference_id."',
					'".$metodo."'
					);";
					
					$consulta = $con -> ejecutar_sentencia($sqlr);

					
					
					echo '<script type="text/javascript"> 
    location.href="http://clientes.locker.com.mx/la-anita/carrito-3"; 
</script> ';
				   
				break;
				case 'created':
					$orden = new orden($item_number,'','','','',2);
					$orden->updateStatus();
				break;
				case 'refunded':
					$orden = new orden($item_number,'','','','',1);
					$orden->updateStatus();
					
				break;
			}
	

	


?>