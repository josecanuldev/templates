<?php
/*function __autoload($nombre_clase) {
    include ''.$nombre_clase .'.php';
}*/

class correoProcesandoOrden extends correo
{
    var $path  = "http://";

    function correoProcesandoOrden($idorden)
    {
        $this->correo();
        $this->orden = new orden($idorden);
		$this->orden->obtener_orden();
        $this->destino=new datosOrden($idorden);
		$this->destino->getDatosOrden();
    }

    function genera_asunto()
    {
        $this->correo->Subject='La Anita Orden';
    }

    function genera_destino()
    {
        $this->correo->AddAddress($this->destino->emailCliente);
    }

    function genera_mensaje()
    {
        $_total = $this -> orden -> importeTotal;

        $datosOrden = new datosOrden($this->orden->idOrden);
		$datosOrden->getDatosOrden();

        $_descuento = 0;
        $_textoDescuento = '- Sin descuento';
        if($datosOrden -> cuponDescuento != ''){
            if($datosOrden -> tipoDescuento == 3){
                $_descuento = $this -> orden -> precioDescuento;
                $_textoDescuento = '- Envío Gratis';
            }else if($datosOrden -> tipoDescuento == 1){
                $_textoDescuento = '$ '.number_format($this -> orden -> precioDescuento,2);
            }else if($datosOrden -> tipoDescuento == 2){
                $_textoDescuento = '$ '.number_format($this -> orden -> precioDescuento,2);
            }
        }
        $_total = $_total - $_descuento;

        $detalleOrden = new detalle_orden($this->orden->idOrden);
		$detalleOrden->obtener_productos_orden();

    $LANG='ES';
    $listaArticulos = "<!--HTML PARA LOS PRODUCTOS-->";
    foreach ($detalleOrden->productos as $keyProd) {
		$producto = new producto($keyProd->idProducto);
		$producto -> getProducto();
		$producto -> obtenerDatosProducto('ES');
		/*$productoxatributo = new productoxatributo($keyProd -> idProducto);
		$productoxatributo -> listNombreAtributoxProducto();
		$detalles = '';
		if($keyProd->idCombinacion != 0){
		foreach ($productoxatributo -> atributos as $keyAttr){
			$valoresxcombinacion = new valoresxcombinacion($keyProd->idCombinacion, $keyAttr['idAtributo'], $producto -> idProducto);
			$valoresxcombinacion -> getValorxAtributo();
			$detalles .= '<strong>'.$keyAttr['nombre'].':</strong> '.$valoresxcombinacion -> valor.' <br>';
		}
		}
		else{
			$detalles=$producto->material;
		}*/
        $listaArticulos .= '
                    <tr>
                        <td><strong>'.$keyProd->cantidad.'x</strong> '.$producto -> _datosProducto -> _titulo.'</td>
                        <td valign="top">$'.number_format($keyProd -> precio, 2, '.', '').'</td>
                        <td valign="top" align="right">$'.number_format($keyProd -> cantidad * $keyProd -> precio, 2, '.', '').'</td>
                    </tr>
        ';
    }

$this -> correo -> Body .= '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Message from La Anita Website</title> <!-- Nombre del sitio web -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

        <style>


            @media only screen and (max-width: 300px){
                body {
                    width:218px !important;
                    margin:auto !important;
					font-family: "Open Sans", sans-serif;
                }
                .table {width:195px !important;margin:auto !important;}
                .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto !important;display: block !important;}
                span.title{font-size:20px !important;line-height: 23px !important}
                span.subtitle{font-size: 14px !important;line-height: 18px !important;padding-top:10px !important;display:block !important;}
                td.box p{font-size: 12px !important;font-weight: bold !important;}
                .table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
                    display: block !important;
                }
                .table-recap{width: 200px!important;}
                .table-recap tr td, .conf_body td{text-align:center !important;}
                .address{display: block !important;margin-bottom: 10px !important;}
                .space_address{display: none !important;}
            }
            @media only screen and (min-width: 301px) and (max-width: 500px) {
                body {width:308px!important;margin:auto!important;}
                .table {width:285px!important;margin:auto!important;}
                .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
                .table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
                    display: block !important;
                }
                .table-recap{width: 293px !important;}
                .table-recap tr td, .conf_body td{text-align:center !important;}

            }
            @media only screen and (min-width: 501px) and (max-width: 768px) {
                body {width:478px!important;margin:auto!important;}
                .table {width:450px!important;margin:auto!important;}
                .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
            }
            @media only screen and (max-device-width: 480px) {
                body {width:308px!important;margin:auto!important;}
                .table {width:285px;margin:auto!important;}
                .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}

                .table-recap{width: 285px!important;}
                .table-recap tr td, .conf_body td{text-align:center!important;}
                .address{display: block !important;margin-bottom: 10px !important;}
                .space_address{display: none !important;}
            }
        </style>
    </head>
    <body style="-webkit-text-size-adjust:none;background-color:#fff;width:650px;font-family:Open-sans, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
        <table class="table table-mail" style="width:100%;margin-top:10px;">
            <tr>
                <td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
                <td align="center" style="padding:0">
                    <table class="table" bgcolor="#ffffff" style="width:100%">
                        <tr>
                            <td align="center" class="logo" style="padding:7px 0;">
                                <!-- Nombre del sitio web, url de la página, ruta del logo de la página y otra ves el nombre.-->
                                <a title="La Anita" href="'.$this -> path.'" style="color:#337ff1">
                                    <img src="'.$this -> path.'img/logo-la-anita-2.png" alt="La Anita" style="width:160px"/>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="space_footer" style="padding:0!important; border-bottom:1px solid #ccc;">&nbsp;</td>
                        </tr>
                        <!--<tr>
                            <td align="left" class="titleblock" style="padding:7px 0">
                                <font size="2" color="#b7985b">
                                    <span class="subtitle" style="font-size:33px;line-height:33px; font-weight:700">Nuevo mensaje de La Anita.</span>
                                </font>
                            </td>
                        </tr>   -->
                        <tr>
                            <td class="box" style="padding:7px 0">
                                <table class="table" style="width:100%">
                                    <tr>
                                        <td width="10" style="padding:7px 0">&nbsp;</td>
                                        <td style="padding:25px;">
                                            <font size="2" color="#000">
                                                <span class="subtitle" style="font-size:33px;line-height:33px; font-weight:700">Tu compra ha sido registrada.</span>
                                            </font><br /><br />
                                            <font size="2" face="Roboto" color="#000000">
                                                <p style="font-size: 15px; font-weight:100; font-family:\'Roboto\'">
                                                    Hola '.$datosOrden -> nombreCliente.' <br><br>
                                                    ¡Gracias por comprar con nosotros! Tu pedido está siendo procesado. Te enviaremos una notificación cuando se confirme y se envíe. <br> <br>
                                                    Estos son los detalles de tu pedido. <br> <br>
                                                    <strong>Información y dirección de envío:</strong><br>
                                                    '.$datosOrden -> nombreCliente.' <br>
                                                    '.$datosOrden -> direccionCliente.'<br>
                                                    '.$datosOrden -> ciudadCliente.', '.$datosOrden -> estadoCliente.' C.P. '.$datosOrden -> cpCliente.'<br><br>
                                                    Teléfono: '.$datosOrden -> telefonoCliente.' <br>
                                                    E-mail: '.$datosOrden -> emailCliente.' <br><br>
                                                    <strong>Tu orden: </strong><span class="red">'.$this -> orden -> idorden.'</span>
                                                </p>
                                            </font>
                                            <table class="table table-producto" style="font-size: 13px; font-weight:200; font-family:\'Roboto\'">
                                                <tr>
                                                    <th align="left" width="50%">Producto</th>
                                                    <th align="left" width="25%">Costo</th>
                                                    <th align="right" width="25%">Total</th>
                                                </tr>
                                                '.$listaArticulos.'
                                                <tr>
                                                    <td width="50%"></td>
                                                    <td valign="top" align="right" width="20%">Subtotal</td>
                                                    <td valign="top" align="right" width="30%">$'.$this -> orden -> subtotal.'</td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"></td>
                                                    <td valign="top" align="right" width="20%">Envío</td>
                                                    <td valign="top" align="right" width="30%">$'.number_format($this -> orden -> transporte, 2, '.', '').'</td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"></td>
                                                    <td valign="top" align="right" width="20%">Descuento</td>
                                                    <td valign="top" align="right" width="30%">'.$_textoDescuento.'</td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"></td>
                                                    <td valign="top" align="right" width="20%" style="color:#068dc7">Total</td>
                                                    <td valign="top" align="right" width="30%" style="color:#068dc7">$'.number_format($_total, 2, '.', '').'</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="10" style="padding:7px 0">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="space_footer" style="padding:0!important">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="space_footer" style="padding:0!important">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="footer" style="background-color:#068dc7; padding:10px 25px;">
                                <table style="width:100%;">
                                <tr>
                                    <td width="10" style="padding:7px 0">&nbsp;</td>
                                    <td>
                                        <font face="Roboto" color="#fff">
                                            <p style="font-size:14px; font-weight:700">Contacto<br />
                                            <span style="font-size:12px; font-weight:400;">contacto@laanita.com</span>
                                            </p>
											<p style="font-size:14px; font-weight:700">Dirección<br />
                                            <span style="font-size:12px; font-weight:400;">Calle 19 No. 425 Ciudad Industrial<br>Mérida, Yucatán, MX</span>
                                            </p>
                                        </font>
                                    </td>
                                    <td style="padding-top:20px;" align="center">
                                        <a href="https://www.facebook.com/" style="margin-right:5px; color:#fff"><img src="'.$this -> path.'img/facebook.png"></a>
                                        <a href="https://www.instagram.com/" style="margin-right:5px; color:#fff""><img src="'.$this -> path.'img/instagram.png"></a>
                                    </td>
                                    <td align="right">
                                        <p style="color:#ffffff; font-size:9px;line-height:13px;"><a style="color:#ffffff; text-decoration:underline;" href="'.$this -> path.'privacy-policy">Aviso de privacidad.</a><br>
                                            Todos los derechos reservados. 2017</p>
                                    </td>
                                    <td width="10" style="padding:7px 0">&nbsp;</td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
            </tr>
        </table>
    </body>
</html>';
    }
}
?>
