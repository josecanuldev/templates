<?php
include_once("correo.php");
include_once("contacto.php");
/*
    Los tipos de correo son:
    1: Envia un correo al solicitante.
    2: Envía un correo al Staff.
*/

class correoContacto extends correo
{
    var $contacto;
    var $nombre;
    var $correo_mensaje;
    var $telefono;
    var $motivo;
    var $mensaje;
    var $path  = "http://clientes.locker.com.mx/estefiabraham2/";

    function correoContacto($nombre = '', $correo = '', $telefono = '', $motivo = '', $mensaje = ''){    
        $this -> correo();
        $this -> nombre = $nombre;
        $this -> correo_mensaje = $correo;
        $this -> telefono = $telefono;
        $this -> motivo = $motivo;
        $this -> mensaje = $mensaje;
		$this -> contacto = new contacto();
        $this -> contacto -> obtener_contacto();
    }
    
    function genera_asunto(){		
        $this -> correo -> Subject = 'NUEVO MENSAJE SACV';
    }
    
    function genera_destino(){
        $this -> correo -> AddAddress($this -> contacto -> correo);
    }
    
    function genera_mensaje(){						
        $this -> correo -> Body = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Mensaje desde SACV Sitio Web</title> <!-- Nombre del sitio web -->
        

        <style>
            @font-face{ font-family: Roboto; src:url("'.$this -> path.'fonts/roboto/Roboto-Bold.ttf") format("truetype"), url("'.$this -> path.'fonts/roboto/Roboto-Bold.woff") format("woff") ; font-weight:700} 
            @font-face{ font-family: Roboto; src:url("'.$this -> path.'fonts/roboto/Roboto-Medium.ttf") format("truetype"), url("'.$this -> path.'fonts/roboto/Roboto-Medium.woff") format("woff") ; font-weight:500} 
            @font-face{ font-family: Roboto; src:url("'.$this -> path.'fonts/roboto/Roboto-Regular.ttf") format("truetype"), url("'.$this -> path.'fonts/roboto/Roboto-Regular.woff") format("woff") ; font-weight:400}
            @font-face{ font-family: Roboto; src:url("'.$this -> path.'fonts/roboto/Roboto-Light.ttf") format("truetype"), url("'.$this -> path.'fonts/roboto/Roboto-Light.woff") format("woff") ; font-weight:300}
                
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
                                <a title="Selfix" href="'.$this -> path.'" style="color:#337ff1">
                                    <img src="'.$this -> path.'img/logo.png" alt="SACV" style="width:130px"/>
                                </a>                                   
                            </td>
                        </tr>
                        <tr>
                            <td class="space_footer" style="padding:0!important; border-bottom:1px solid #ccc;">&nbsp;</td>
                        </tr>
                        <!--<tr>
                            <td align="left" class="titleblock" style="padding:7px 0">
                                <font size="2" face="Palatino" color="#b7985b">                                 
                                    <span class="subtitle" style="font-size:33px;line-height:33px">Has recibido un nuevo mensaje.</span>
                                </font>
                            </td>
                        </tr>   -->                 
                        <tr>
                            <td class="box" style="padding:7px 0">
                                <table class="table" style="width:100%">
                                    <tr>
                                        <td width="10" style="padding:7px 0">&nbsp;</td>
                                        <td style="padding:25px;">
                                            <font size="2" face="Palatino" color="#000">                                 
                                                <span class="subtitle" style="font-size:33px;line-height:33px">Has recibido un nuevo mensaje.</span>
                                            </font><br /><br />
                                            <font size="2" face="Roboto" color="#000000">
                                                <p data-html-only="1" style="margin:3px 0 7px;font-weight:300;font-size:15px;padding-bottom:10px">Detalles del mensaje</p>
                                                <span style="color:#000;font-weight:300;font-size:15px;">Estos son los datos del mensaje:<br /> 
                                                    <span style="color:#000"><strong>Nombre:</strong></span> '.$this -> nombre.' <br />
                                                    <span style="color:#000"><strong>Correo electrónico: <a href="mailto:'.$this -> correo_mensaje.'" style="color:#d6a279">'.$this -> correo_mensaje.'</a></strong></span><br />
                                                    <span style="color:#000"><strong>Teléfono:</strong></span> '.$this -> telefono.' <br />
                                                    <span style="color:#000"><strong>Motivo:</strong></span> '.$this -> motivo.' <br />
                                                    <span style="color:#000"><strong>Mensaje:</strong></span> '.$this -> mensaje.'<br />
                                                </span>
                                            </font>
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
                            <td class="footer" style="background-color:#212121; padding:10px 25px;">
                                <table style="width:100%;">
                                <tr>
                                    <td width="10" style="padding:7px 0">&nbsp;</td>
                                    <td>
                                        <font face="Roboto" color="#fff">
                                            <p style="font-size:14px; font-weight:700">Contacto<br />
                                            <span style="font-size:12px; font-weight:400;">Tel: +52 (999) 123-45678</span>
                                            </p>
                                        </font>
                                    </td>
                                    <td style="padding-top:20px;" align="center">
                                        <a href="https://www.facebook.com/estefiabrahammx/" style="margin-right:5px;"><img src="'.$this -> path.'img/facebook.png"></a>
                                        <a href="https://www.instagram.com/estefiabrahammx/"><img src="'.$this -> path.'img/instagram.png"></a>
                                    </td>                               
                                    <td align="right">
                                        <p style="color:#ffffff; font-size:9px;line-height:13px;"><a style="color:#ffffff; text-decoration:underline;" href="'.$this -> path.'aviso-de-privacidad">Aviso de privacidad.</a><br>
                                            Todos los derechos reservados. 2016</p>
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
</html>
';
    }
}
?>