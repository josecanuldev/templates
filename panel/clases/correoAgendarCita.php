<?php
include_once 'contacto.php';
class correoAgendarCita extends correo
{
    var $path  = "http://";
    var $_nombre;
    var $_apellidos;
    var $_correoPersonal;
    var $_telefono;
    var $_prendas;
    var $_fecha;
    var $_mensaje;

    var $_contacto;


    function correoAgendarCita($_nombre = '', $_apellidos = '', $_correoPersonal = '', $_telefono = '', $_prendas = '', $_fecha = '', $_mensaje = '', $_tipo = 0)
    {
        $this -> correo();
        $this -> _nombre = $_nombre;
        $this -> _apellidos = $_apellidos;
        $this -> _correoPersonal = $_correoPersonal;
        $this -> _telefono = $_telefono;
        $this -> _prendas = $_prendas;
        $this -> _fecha = $_fecha;
        $this -> _mensaje = $_mensaje;
        $this -> _tipo = $_tipo;

        $this -> _contacto = new contacto(1);
        $this -> _contacto -> obtener_contacto();
    }

    function genera_asunto()
    {
        ($this -> _tipo == 1) ? $this -> correo -> Subject = 'Agendar Cita Estefiabraham' : $this -> correo -> Subject = 'Cita Agendada Estefiabraham';

    }

    function genera_destino()
    {
        ($this -> _tipo == 1) ? $this -> correo -> AddAddress($this -> _contacto -> correo) : $this -> correo -> AddAddress($this -> _correoPersonal);

    }

    function genera_mensaje()
    {

    $this -> correo -> Body .= '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Mensaje desde Estefiabraham Sitio Web</title> <!-- Nombre del sitio web -->


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
                                    <img src="'.$this -> path.'img/logo.png" alt="Estefiabraham" style="width:130px"/>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="space_footer" style="padding:0!important; border-bottom:1px solid #ccc;">&nbsp;</td>
                        </tr>
                        <!--<tr>
                            <td align="left" class="titleblock" style="padding:7px 0">
                                <font size="2" face="Palatino" color="#b7985b">
                                    <span class="subtitle" style="font-size:33px;line-height:33px">AGENDA DE CITAS.</span>
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
                                                <span class="subtitle" style="font-size:33px;line-height:33px">Detalles de la cita.</span>
                                            </font><br /><br />
                                            <font size="2" face="Roboto" color="#000000">
                                                <p style="font-size: 15px; font-weight:100; font-family:\'Roboto\'">
                                                    <strong>Nombre: </strong> '.$this -> _nombre.' '.$this -> _apellidos.' <br>
                                                    <strong>Correo: </strong> '.$this -> _correoPersonal.' <br>
                                                    <strong>Telefono: </strong> '.$this -> _telefono.' <br>
                                                    <strong>PRENDAS: </strong>'.$this -> _prendas.'<br>
                                                    <strong>Fecha: </strong> '.$this -> _fecha.' <br>
                                                    <strong>Mensaje: </strong> '.$this -> _mensaje.' <br>
                                                </p>
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
</html>';
    }
}
?>
