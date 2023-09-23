<?php
include_once("correo.php");
include_once("contacto.php");
include_once("aspirante.php");
/*
    Los tipos de correo son:
    1: Envia un correo al solicitante.
    2: Envía un correo al Staff.
*/

class correoNotificacion extends correo
{
    var $tipo;
    var $contacto;
    var $aspirante;
    var $path  = "http://";

    function correoNotificacion($tipo = 0, $idAspirante = 0){
        $this -> correo();
        $this -> tipo = $tipo;
		$this -> contacto = new contacto();
        $this -> contacto -> obtener_contacto();
        $this -> aspirante = new aspirante($idAspirante);
        $this -> aspirante -> getAspirante();

    }

    function genera_asunto(){
        $motivo = '';
        if($this -> tipo == 1)
            $motivo = 'GRUPO LOGRA TE A ENVIADO UN MENSAJE';
        if($this -> tipo == 2)
            $motivo = 'NUEVA SOLICITUD';
        $this -> correo -> Subject = $motivo;
    }

    function genera_destino(){
        if($this -> tipo == 1)
            $this -> correo -> AddAddress($this -> aspirante -> correo);
        else
            $this -> correo -> AddAddress($this -> contacto -> correo);
    }

    function genera_mensaje(){
    $this -> correo -> Body='
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Mensaje desde Grupo Logra</title> <!-- Nombre del sitio web -->


        <style>
            p.tituloPrincipal{font-size: 40px; color:#00345B; text-align: center; line-height: 1;}
            span.subtitulo{font-size: 18px; color:#febd21; line-height: 1;}
            span.titulo3{font-size: 18px; color:#febd21;}
            td.footer > center > img{margin: 10px 35px 50px 35px}
            p.body-content{color: #404040; font-size: 18px;}
            p.body-content > span{color:#b0b0b0; font-size: 18px;}
            span.grey{font-size: 36px !important;}
            span.white{font-size: 36px !important; color: white !important}
            span.titulo4{color:#fd6b0d !important;}
            a.btn-download{background-color: #FEBD21; padding: 10px 20px; text-decoration: none; color: #404040; font-size: 14px; line-height: 1; font-weight: bold;}
            span.footer-text{color: white; font-size: 14px; font-weight: 100;}
            span.footer-text-2{color: #fff; font-size: 14px; font-weight: bold;}
            @media only screen and (max-width: 300px){
                body {
                    width:218px !important;
                    margin:auto !important;
                    background-color: #fff;
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
                .table {width:100%!important;margin:auto!important;}
                .logo, .titleblock, .linkbelow, .box, .footer, .space_footer{width:auto!important;display: block!important;}
                .table-recap table, .table-recap thead, .table-recap tbody, .table-recap th, .table-recap td, .table-recap tr {
                    display: block !important;
                }
                .table-recap{width: 293px !important;}
                .table-recap tr td, .conf_body td{text-align:center !important;}

            }
            @media only screen and (min-width: 501px) and (max-width: 768px) {
                body {width:478px!important;margin:auto!important;}
                .table {width:100%!important;margin:auto!important;}
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
            @media (min-width: 600px) {
                .table {width:100%!important;margin:auto!important;}
                .tableContent{width: 640px !important;}
            }
            .title{font-size: 18px !important;}
        </style>
    </head>
    <body style="-webkit-text-size-adjust:none;background-color:#fff;width:100% !important;font-family:Open-sans, sans-serif;color:#555454;font-size:13px;line-height:18px;margin:auto">
        <table class="table table-mail" bgcolor="#fff" style="width:100% !important;margin-top:-11px !important;">
            <tr>
                <td align="center" style="padding:7px 0">
                    <table class="table" bgcolor="#fff" style="width:100%">
                        <tr>
                            <td align="center" class="logo" style="padding:7px 0; background-color: #fff">
                                <!-- Nombre del sitio web, url de la página, ruta del logo de la página y otra ves el nombre.-->
                                <a title="Grupo Logra" href="'.$this -> path.'" style="color:#337ff1">
                                    <img src="'.$this -> path.'img/logo.png" alt="Grupo Logra"/>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <table class="tableContent" style="width:100%; border-top: 2px solid white; border-bottom: 2px solid white;">
                                <tr>
                                    <td class="space_footer" style="padding:0!important">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="box" style="padding:7px 0">';
            if($this -> tipo = 2){
                $this -> correo -> Body.= '<table class="table"  style="width:80%">
                                            <tr>
                                                <td style="width: 20%"></td>
                                                <td style="width: 60%" style="padding:7px 0">
                                                    <p class="tituloPrincipal">NUEVA SOLICITUD <br>
                                                        <center>
                                                            <span class="subtitulo">DATOS DEL ASPIRANTE</span>
                                                            <p class="body-content">
                                                                <span>Nombre:</span><br> '.$this -> aspirante -> nombre.' '.$this -> aspirante -> apellido.'<br><br>
                                                                <span>Correo:</span><br> '.$this -> aspirante -> correo.'<br><br>
                                                                <span>Teléfono:</span><br> '.$this -> aspirante -> telefono.'<br><br>
                                                                <span>Estado:</span><br> '.$this -> aspirante -> estado.'<br><br>
                                                                <span>Ciudad:</span><br> '.$this -> aspirante -> ciudad.'<br><br>
                                                                <span>Puesto :</span><br> '.$this -> aspirante -> nombreEmpleo.'<br><br>
                                                            </p>

                                                            <a class="btn-download" download="'.$this -> path.'curriculums/'.$this -> aspirante -> curriculum.'" href="'.$this -> path.'curriculums/'.$this -> aspirante -> curriculum.'">DESCARGAR CURRICULUM</a>
                                                        </center>
                                                    </p>
                                                </td>
                                                <td style="width: 20%"></td>
                                            </tr>
                                        </table>';
            }else{
                $this -> correo -> Body.= '<table class="table"  style="width:80%">
                                            <tr>
                                                <td style="width: 20%"></td>
                                                <td style="width: 60%" style="padding:7px 0">
                                                    <p style="text-transform: uppercase" class="tituloPrincipal">HOLA '.$this -> aspirante -> nombre.' '.$this -> aspirante -> apellido.'
                                                        <br>
                                                        <center>
                                                            <span class="subtitulo">¡GRACIAS POR ENVIAR TU SOLICITUD! Estos son tus datos:</span><br>
                                                            <p class="body-content">
                                                                <span>Nombre:</span><br> '.$this -> aspirante -> nombre.' '.$this -> aspirante -> apellido.'<br><br>
                                                                <span>Correo:</span><br> '.$this -> aspirante -> correo.'<br><br>
                                                                <span>Teléfono:</span><br> '.$this -> aspirante -> telefono.'<br><br>
                                                                <span>Estado:</span><br> '.$this -> aspirante -> estado.'<br><br>
                                                                <span>Ciudad:</span><br> '.$this -> aspirante -> ciudad.'<br><br>
                                                                <span>Puesto :</span><br> '.$this -> aspirante -> nombreEmpleo.'<br><br>
                                                            </p>
                                                        </center>
                                                    </p>
                                                </td>
                                                <td style="width: 20%"></td>
                                            </tr>
                                        </table>';
            }
        $this -> correo -> Body.='  </td>
                                </tr>
                            </table>
                        </tr>
                        <tr>
                            <td class="footer" style="background-color: #00345B; padding: 40px 0px">
                                <center>
                                    <a href="#"><img src="'.$this -> path.'img/resources/logo-fb.png"></a>
                                    <a href="#"><img src="'.$this -> path.'img/resources/logo-twt.png"></a>
                                    <a href="#"><img src="'.$this -> path.'img/resources/logo-ln.png"></a><br>
                                    <img src="'.$this -> path.'img/logo2.png"></img></br>
                                    <span class="footer-text">Teléfono:</span> <span class="footer-text-2">(01)(800)890-2631</span><br>
                                    <span class="footer-text">Correo:</span> <span class="footer-text-2">contacto@logranegocios.com</span><br>
                                </center>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>';
    }
}
?>
