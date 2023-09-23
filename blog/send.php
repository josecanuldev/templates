<?php
include_once('mailchimp/MCAPI.class.php');
include_once('include/path.php');

$apikey="1fdc2798ed3b0c38558956e3c1266e1d-us19";

$mailchimp = new MCAPI($apikey,true);

$nombre=$_REQUEST['nombre'];
$telefono=$_REQUEST['telefono'];
$correo=$_REQUEST['correo'];
$asunto="Mensaje de contacto";
$mensaje=$_REQUEST['mensaje'];
$descarga=$_REQUEST['descarga'];
$ciudad=$_REQUEST['ciudad'];
$interesa=$_REQUEST['interesa'];
$horario=$_REQUEST['horario'];
$pregunta=$_REQUEST['pregunta'];

$listId="721479fa4b";

$merge_vars = array('FNAME'=>$nombre,'EMAIL'=>$correo,'PHONE'=>$telefono,'MMERGE3'=>$ciudad,'MMERGE2'=>$interesa,'MMERGE5'=>$horario,'MMERGE6'=>$pregunta,'MMERGE7'=>$mensaje);

//habilitar en caso de ser necesario manejar campaña
$resultado=$mailchimp->listSubscribe( $listId, $correo, $merge_vars );

//Correo de información
$mensajedelsitio='Mensaje del Sitio Web - Aquarela';
$mensajedesde='Mensaje desde Aquarela';
$logo='logo-aquarela.png';
$logoAlt='Aquarela';

$owner_email = "webmaster@sloganpublicidad.com";
//$owner_email = "carlos@locker.com.mx";
$froms = "noreply@aquarela.mx"; // noreply de la página web
//$froms = "noreply@locker.com.mx"; // noreply de la página web
$headers = "From: " .strip_tags ($froms). "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$subject = $mensajedelsitio;
$messageBody = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>'.$mensajedesde.'</title> <!-- Nombre del sitio web -->


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
			<td align="center" style="padding:7px 0">
				<table class="table" bgcolor="#ffffff" style="width:100%">
					<tr>
						<td align="center" class="logo" style="border-bottom:4px solid #333333;padding:7px 0">
							<!-- Nombre del sitio web, url de la página, ruta del logo de la página y otra ves el nombre.-->
							<a title="'.$logoAlt.'" href="'.PATH.'" style="color:#337ff1">
								<img src="'.PATH.'img/'.$logo.'" alt="'.$logoAlt.'" width="150" />
							</a>
						</td>
					</tr>
					<tr>
						<td align="center" class="titleblock" style="padding:7px 0">
							<font size="2" face="Open-sans, sans-serif" color="#555454">
								<span class="subtitle" style="font-weight:500;font-size:16px;text-transform:uppercase;line-height:25px">Nuevo mensaje de contacto</span>
							</font>
						</td>
					</tr>
					<tr>
						<td class="space_footer" style="padding:0!important">&nbsp;</td>
					</tr>
					<tr>
						<td class="box" style="border:1px solid #D6D4D4;background-color:#f8f8f8;padding:7px 0">
							<table class="table" style="width:100%">
								<tr>
									<td width="10" style="padding:7px 0">&nbsp;</td>
									<td style="padding:7px 0">
										<font size="2" face="Open-sans, sans-serif" color="#555454">
											<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">
												Detalles</p>
											<span style="color:#777">
												Estos son los datos del mensaje:<br />
												<span style="color:#333"><strong>Nombre:</strong></span> '.$nombre.' <br />
												<span style="color:#333"><strong>Teléfono:</strong></span> '.$telefono.' <br />
												<span style="color:#333"><strong>Ciudad:</strong></span> '.$ciudad.' <br />
												<span style="color:#333"><strong>Interés en:</strong></span> '.$interesa.' <br />
												<span style="color:#333"><strong>Horario para contactar:</strong></span> '.$horario.' <br />
												<span style="color:#333"><strong>Medio en que se enteró:</strong></span> '.$pregunta.' <br />
												<span style="color:#333"><strong>Correo electrónico: <a href="mailto:'.$correo.'" style="color:#337ff1">'.$correo.'</a></strong></span><br />
												<span style="color:#333"><strong>Asunto:</strong></span> '.$asunto.' <br />
												<span style="color:#333"><strong>Mensaje:</strong></span> '.$mensaje.' <br />

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
						<td class="footer" style="border-top:4px solid #333333;padding:7px 0">
									<!-- url y nombre de la página web -->
							<span><a href="'.PATH.'" style="color:#337ff1">'.$logoAlt.'</a></span>
						</td>
					</tr>
				</table>
			</td>
			<td class="space" style="width:20px;padding:7px 0">&nbsp;</td>
		</tr>
	</table>
</body>
</html>';

//Controlamos los errores
if ($mailchimp->errorCode)
{
	if($mailchimp->errorCode==214){
		mail($owner_email, $subject, $messageBody, $headers);
		echo("Z^S1a[FTKNN7z{{h");
	}else{
		echo $mailchimp->errorCode;
	}
}
else
{
	 mail($owner_email, $subject, $messageBody, $headers);
   echo("Z^S1a[FTKNN7z{{h");
}
?>
