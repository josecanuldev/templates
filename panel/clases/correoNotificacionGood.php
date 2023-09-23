<?php

include_once('class.phpmailer.php');
include_once('settingsEmail.php');

class correoNotificacionGood{

	/**
	 * Variable que contiene la instancia de PHPMailer.
	 * @var Object
	 */
	var $correo;
	var $path  = "https://cancuntoislamujeres.com/";

	/**
	 * Variable que contiene la instancia de settingsEmail.
	 * @var Object
	 */
	var $settingsEmail;

	var $emailPrueba;
	/**
	 * Metodo constructor de correo.
	 */
	function correoNotificacionGood($idorden=0){
		$this -> idorden = $idorden;
		$this -> settingsEmail = new settingsEmail(1);
		$this -> settingsEmail -> obtener_settingsEmail();

		$this -> correo = new PHPMailer();
		//$this -> correo -> IsSMTP();
		$this -> SMTPSecure = "ssl";
		$this -> Mailer = "smtp";
		$this -> correo -> Host = $this -> settingsEmail -> host;
		$this -> correo -> SMTPDebug = 1;
		$this -> correo -> SMTPAuth = true;
		$this -> correo -> Port = $this -> settingsEmail -> port;
		$this -> correo -> Username = $this -> settingsEmail -> username;
		$this -> correo -> Password = $this -> settingsEmail -> password;

		$this -> correo -> From = $this -> settingsEmail -> username;
		$this -> correo -> FromName = $this -> settingsEmail -> fromname;

		$this -> correo -> AddReplyTo($this -> settingsEmail -> noReply);
		//$this -> correo -> AddCC($this -> settingsEmail -> addCC);
		$this -> correo -> IsHTML(true);
		$this -> correo -> CharSet = 'UTF-8';
	}


	function genera_mensaje(){
		$item_number=$this->idorden;
		$idorden = $item_number;
		$orden = new ordenreserva($item_number);
		$orden->obtenerOrden();
		$reserva= new reservatour($orden->idreserva);
		$reserva->obtenerReservaTour();
		$conceptoReserva=$reserva->concepto;
		$desde=$reserva->desde;
		$salidaText='Salida';

		if($reserva->tipoPrivadoEstandar=="estandar"){
			$tipoPrivadoEstandar="Chiquilá";
			$prefixPrivado="Privstan";
		}elseif($reserva->tipoPrivadoEstandar=="premium"){
			$tipoPrivadoEstandar="Isla Holbox";
			$prefixPrivado="Privpre";
		}else{
			$prefixPrivado="Shut";
		}

		if($orden->tipo==1){
			if($desde=="Aeropuerto Cancún"){
				$buttonTexto="Aeropuerto Cancún - Chiquilá";
			}
			else{
				$buttonTexto="Chiquilá - Aeropuerto Cancún";
			}
		}
		else{

			if($reserva->inverso=="true"){
				$buttonTexto=$tipoPrivadoEstandar.' - '.$reserva->desde.' - '.$salidaText;
			}else{
				$buttonTexto=$reserva->desde.' - '.$tipoPrivadoEstandar;
			}

		}

		$aerolinea='Aerolínea';
		$numeroVuelo='Número de vuelo';
		$datePrivada='Fecha';
		$horaPrivada='Hora de llegada del vuelo';
		$abordaje='Lugar del abordaje del traslado';
		$tipoVuelo='Tipo de vuelo';

		if($reserva->fechaLLegada == ""){
			$oculto="display:none;";
		}
		else{
			$oculto="";
		}
		if($reserva->horarioLLegada == ""){
			$oculto2="display:none;";
		}
		else{
			$oculto2="";
		}
		if($reserva->fechaSalida == ""){
			$oculto3="display:none;";
		}
		else{
			$oculto3="";
		}
		if($reserva->horarioSalida == ""){
			$oculto4="display:none;";
		}
		else{
			$oculto4="";
		}

		if($reserva->aerolinea == ""){
			$oculto5="display:none;";
		}
		else{
			$oculto5="";
		}

		if($reserva->numeroVuelo == ""){
			$oculto6="display:none;";
		}
		else{
			$oculto6="";
		}

		if($reserva->datePrivada == ""){
			$oculto7="display:none;";
		}
		else{
			$oculto7="";
		}

		if($reserva->horaPrivada == ""){
			$oculto8="display:none;";
		}
		else{
			$oculto8="";
		}

		if($reserva->abordaje == ""){
			$oculto9="display:none;";
		}
		else{
			$oculto9="";
		}

		if($reserva->tipoVuelo == ""){
			$oculto10="display:none;";
		}
		else{
			$oculto10="";
		}

		if($reserva->hotel == ""){
			$oculto11="display:none;";
		}
		else{
			$oculto11="";
		}

		if($reserva->hotelSalida == ""){
			$oculto12="display:none;";
		}
		else{
			$oculto12="";
		}

		if($orden->idCodigoPromo != 0){
			$codigoPromo=new codigo($orden->idCodigoPromo);
			$codigoPromo->obtenercodigo();
			$numeroCodigo=$codigoPromo->codigo;
			$partCodigo='(Código de promoción:'.$numeroCodigo.')';
		}

		if($reserva->idioma=='en'){
			$moneda='USD';
		}
		else{
			$moneda='MXN';
		}

		$folio=sprintf('%04d',$orden->idorden);


$this -> correo -> Body .= '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>Transfer Holbox '.$prefixPrivado.'-'.$folio.'</title> <!-- Nombre del sitio web -->
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
							<a title="Transfer Holbox" href="'.$this->path.'" style="color:#337ff1">
								<img src="'.$this->path.'img/logo-footer.png" alt="Transfer Holbox" width="150" />
							</a>
						</td>
					</tr>
					<tr>
						<td class="titleblock" style="padding:7px 0">
						<table style="width:100%">
						<tr>
						<td style="vertical-align:top">
							<font size="2" face="Open-sans, sans-serif" color="#555454">
							</font>
							</td>
							</tr>
							</table>
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
											<p data-html-only="1" style="border-bottom:1px solid #D6D4D4;margin:3px 0 7px;font-weight:500;font-size:14px;padding-bottom:10px">Folio ('.$prefixPrivado.'-'.$folio.') - Detalles de la reservación
												</p>
												<span style="color:#777">
												<span style="color:#333"><strong>Concepto</strong></span> '.$conceptoReserva.' ('.$buttonTexto.') <br />
												<span style="color:#333"><strong>Folio</strong></span> '.$prefixPrivado.'-'.$folio.' <br />
												<span style="color:#333"><strong>Nombre</strong></span> '.$reserva->nombre.' <br />
												<span style="color:#333"><strong>Apellido</strong></span> '.$reserva->apellido.' <br />
												<span style="color:#333"><strong>Correo</strong></span> '.$reserva->correo.' <br />
												<span style="color:#333"><strong>Teléfono</strong></span> '.$reserva->telefono.' <br />
												<span style="color:#333"><strong>País</strong></span> '.$reserva->pais.' <br />
												<span style="color:#333"><strong>Ciudad</strong></span> '.$reserva->ciudad.' <br />
												<span style="color:#333"><strong>Fecha de reservación</strong></span> '.$reserva->fechaReservacion.' <br />
												<span style="color:#333"><strong>Pasajeros</strong></span> '.$reserva->pasajeros.' <br />
												<span style="color:#333"><strong>Tipo de viaje</strong></span> '.$reserva->tipoViaje.' <br />
												<span style="color:#333;'.$oculto.'"><strong>Fecha de llegada</strong></span> '.$reserva->fechaLLegada.' <br style="'.$oculto.'" />
												<span style="color:#333;'.$oculto2.'"><strong>Horario de llegada</strong></span> '.$reserva->horarioLLegada.' <br style="'.$oculto2.'" />
												<span style="color:#333;'.$oculto3.'"><strong>Fecha de salida</strong></span> '.$reserva->fechaSalida.' <br style="'.$oculto3.'" />
												<span style="color:#333;'.$oculto4.'"><strong>Horario de salida</strong></span> '.$reserva->horarioSalida.' <br style="'.$oculto4.'" />
												<span style="color:#333;'.$oculto5.'"><strong>Aerolínea</strong></span> '.$reserva->aerolinea.' <br style="'.$oculto5.'" />
												<span style="color:#333;'.$oculto6.'"><strong>Número de vuelo</strong></span> '.$reserva->numeroVuelo.' <br style="'.$oculto6.'" />
												<span style="color:#333;'.$oculto7.'"><strong>Fecha</strong></span> '.$reserva->datePrivada.' <br style="'.$oculto7.'" />
												<span style="color:#333;'.$oculto8.'"><strong>Hora de llegada del vuelo</strong></span> '.$reserva->horaPrivada.' <br style="'.$oculto8.'" />
												<span style="color:#333;'.$oculto9.'"><strong>Lugar del abordaje del traslado</strong></span> '.$reserva->abordaje.' <br style="'.$oculto9.'" />
												<span style="color:#333;'.$oculto11.'"><strong>Hotel de llegada</strong></span> '.$reserva->hotel.' <br style="'.$oculto11.'" />
												<span style="color:#333;'.$oculto12.'"><strong>Hotel de salida</strong></span> '.$reserva->hotelSalida.' <br style="'.$oculto12.'" />
												<span style="color:#333;'.$oculto10.'"><strong>Tipo de vuelo</strong></span> '.$reserva->tipoVuelo.' <br style="'.$oculto10.'" />
												<br />
												<span style="color:#333"><strong>Subtotal</strong></span> $ '.number_format($orden->subtotal, 2, '.', ',').' <br />
												<span style="color:#333"><strong>- Descuento '.$partCodigo.'</strong></span> $ '.number_format($orden->descuento, 2, '.', ',').' <br />
												<span style="color:#333"><strong>Total</strong></span> $ '.number_format($orden->total, 2, '.', ',').' '.$moneda.'<br /><br />
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
							<span><a href="'.$this->path.'" style="color:#337ff1">Transfer Holbox</a></span>
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

	function genera_asunto(){
		$this -> correo -> Subject= 'Transfer Holbox Testing';
	}

	function genera_destino(){
		$this -> correo -> AddAddress('cdbs_3@hotmail.com');
	}

	function enviarCopias(){
		if($this -> settingsEmail -> addCC != ''){
			$emails = explode(",", $this -> settingsEmail -> addCC);
			foreach ($emails as $email) {
				$this -> correo -> AddCC($email);
			}
		}
	}

	function enviar(){
		$this->genera_asunto();
		$this->genera_destino();
		$this->genera_mensaje();
		$this->enviarCopias();

		if($this->correo->Send()){
			return true;
		}
		else{
			echo 'Error'.$this->correo->ErrorInfo;
			return false;
		}
	}
}
?>
