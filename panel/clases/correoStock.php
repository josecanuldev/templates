<?php
include_once 'producto.php';
include_once 'correo.php';

class correoStock extends correo
{
    var $path  = "http://";

    function correoStock()
    {
        $this -> correo();

    }

    function genera_asunto()
    {
        $this -> correo -> Subject = 'Stock La Anita';
    }

    function genera_destino()
    {
        $this -> correo -> AddAddress('carlos@locker.com.mx');
    }

    function genera_mensaje()
    {
    $producto = new producto();
    $_productos = $producto -> listProductoOutStock();
    $_tabla  = '';
    /*echo '<pre>';
        print_r($_productos);
    echo '</pre>';*/
    if(isset($_productos)){
        foreach ($_productos as $_row) {
            $_tabla .= '<table style="width:100%; border-top: 1px solid #e2e2e2; border-bottom: 1px solid #e2e2e2; margin-bottom: 10px;">
                            <tr>
                                <td valign="middle" width="150" style="padding-left: 50px;"><img width="50" height="50" src="'.$this -> path.'/img/producto/galeria/'.$_row["ruta"].'"/></td>
                                <td valign="middle" >'.$_row["titulo"].' <br> Presentación: '.$_row['talla'].'</td>
                            </tr>
                        </table>';
        }
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
                        <tr>
                            <td align="left" class="titleblock" style="padding:7px 0">
                                <font size="2" color="#000">
                                    <span class="subtitle" style="font-size:18px;line-height:33px;font-weight:700">Productos Fuera Stock</span>
                                </font>
                            </td>
                        </tr>
                        <tr>
                            <td class="box" style="padding:7px 0">
                                <table class="table" style="width:100%">
                                    <tr>
                                        <td width="10" style="padding:7px 0">&nbsp;</td>
                                        <td style="padding:25px;">';
            $this -> correo -> Body .= $_tabla;
            $this -> correo -> Body .=' </td>
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
//echo $this -> correo -> Body;
    }
}
?>
