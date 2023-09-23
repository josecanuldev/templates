<?php
session_start();
function __autoload($nombre_clase) {
    include ''.$nombre_clase .'.php';
}
require_once("../../pagos/conekta.php");


Conekta::setApiKey("key_X5i6nqY1km8ZFLALDkC8vQ");
$reference_id=$_REQUEST['reference_idoxxo'];
$importedecimal=$_REQUEST['importeoxxo'];
$importe=$_REQUEST['importeoxxo'] * 100;
try{
  $charge = Conekta_Charge::create(array(
    "amount"=> $importe,
    "currency"=> "MXN",
    "description"=> "Orden de Compra Oxxo Lanita",
	"reference_id"=> "".$reference_id."",
    "cash"=> array(
      "type"=>"oxxo"
      
    )
  ));
}catch (Conekta_Error $e){
  echo $e->getMessage();
  header('location:../../carrito-2.php?success='.$error.'');
 //Un error ocurrió al procesar el pago
}
$imagen=$charge->payment_method->barcode_url;
$barcode=$charge->payment_method->barcode;
//echo $charge->payment_method->expires_at;
// Ejemplo Respuesta

?>

<?php
$item_name= $charge->description;

   $item_number= $charge->reference_id;
   $orden = new orden($item_number);
   $orden->updateStatus(2);
   $correoProcesandoOrden = new correoProcesandoOrdenOxxo($item_number,$barcode,$imagen);
   $correoProcesandoOrden->enviar();
   $correoStaff = new correoNotificacionStaff(4);
   $correoStaff->enviar();
   


$con= new conexion();
$sqlr = "insert into codigobarras (idorden, total, ruta, barcode) 
		values (
		'".$reference_id."',
		'".$importedecimal."',
		'".$imagen."',
		'".$barcode."'
		);";
		
		$consulta = $con -> ejecutar_sentencia($sqlr);



$metodo='Oxxo';
$sqlm = "insert into metodopago (idorden, metodo) 
		values (
		'".$reference_id."',
		'".$metodo."'
		);";
		
		$consulta2 = $con -> ejecutar_sentencia($sqlm);

                    

echo '<script type="text/javascript"> 
    location.href="http://clientes.locker.com.mx/la-anita/carrito-3"; 
</script> ';
?>