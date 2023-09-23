<?php
error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL & ~E_NOTICE);

Yii::import('application.extensions.bootstrap.gii.*');
require_once('bootstrap/tcpdf/tcpdf.php');
require_once('bootstrap/tcpdf/config/lang/eng.php');

class MYPDF extends TCPDF
{
	public $header = "";
	public $date = "";

	function setParams($date)
	{
		$this->date = $date;
	}

	//Page header
	public function Header()
	{
		//Cell($w, $h=0, $texto='', $border=0, $ln=0, $text-align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
		// Cell( float $w, [float $h = 0], [string $txt = ''], [mixed $border = 0], [int $ln = 0], [string $align = ''], [int $fill = 0], [mixed $link = ''], [int $stretch = 0], [boolean $ignore_min_height = false], [string $calign = 'T'], [string $valign = 'M'])
		// https://ideateorienta.com.mx/reactivos/libs/tcpdf/doc/com-tecnick-tcpdf/TCPDF.html#methodCell
		// Set font
		// $this->Image(("https://" . $_SERVER['SERVER_NAME'] . "/images/logo-holbox-pdf.png"), 20, 5, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// $this->SetFont('helvetica', 'B', 12);
		// Title
		// $this->Cell(0, 0, 'TRANSFER HOLBOX S.A DE C.V', 0, 1, 'C', 0, '', 0);
		// $this->Cell(0, 10, 'Calle Damero, Centro, 77310 Q.R', 'B', false, 'C', 0, '', 0, false, 'M', 'M');
    	// $this->Cell(0, 0, '', 0, 1, 'C', 0, '', 0);
		// $this->Cell(0, 0, '', 0, 1, 'C', 0, '', 1);
		//$this->writeHTML("AAAAAAAAAAAAAAAAAAA", true, false, false, false, "");
		// $image_file = K_PATH_IMAGES.'logo_example.jpg';
		// $this->Image("https://" . $_SERVER['SERVER_NAME'] . "/images/logo-holbox-pdf.png", 10, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
  //       $this->header = '<table cellpadding="4">
		// 	<tr>
		// 		<td width="150">
		// 			<img src="https://'.$_SERVER['SERVER_NAME'].'/images/logo-holbox-pdf.png" style="width: 130px;" />
		// 		</td>
		// 		<td width="200" style="margin-top: 10px; text-align: center;">
		// 			<h3><b>TRANSFER HOLBOX S.A DE C.V</b></h3> <br />
		// 			Calle Damero, Centro, 77310 Q.R <br />
		// 			'.$this->date.' <br>
		// 		</td>
		// 		<td width="100"></td>
		// 	</tr>
		// </table>';
		// $this->SetY(5);
  //       $this->SetFont('helvetica', '', 8);
  //       $this->writeHTML($this->header, true, false, false, false, "");
        // Title
        // $this->Cell(0, 15, 'TRANSFER HOLBOX S.A DE C.V', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer()
	{
		
	}
}

class FormatosController extends Controller
{
	public $layout = "//layouts/mail";
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionCupon($id, $mail = null){

			$data = $this->getDataCupon($id);
			$reenvio = isset($_GET['reenvio']) ? true : false;
			if ($id) {
				if ($_POST["Reservatour"]) {
					$html = $this->renderPartial('cupon',$data, true);
					// echo json_encode($data); exit;
					// echo '<textarea>'.CJSON::encode($data).'</textarea>'; exit;
					if (!empty($data['cupon']->correo)) {
						if ($data['cupon']->id_agencia == 1) {
							$this->actionMail($id, $html, $reenvio);
						} else {
							$this->actionMailCliente($id, $data["data"], $reenvio);
						}
					}
				} else {
					$html = $this->renderPartial('confirmation',$data, true);
					$this->actionDownloadPdf($html);
				}
			}
	}

	public  function getDataCupon($id){

		$cupon = Reservatour::model()->findByPk($id);
		$data = array();

		if (empty($cupon)) {
			exit;
		}

		$destino = "";
		$origen = $cupon->desde;

		if (!empty($cupon->id_arrivals_to)) {
			$destino = $cupon->idArrivalsTo->name;
		}

		if ($cupon->idreserva < 2882 && ($cupon->id_arrivals_to == NULL || $cupon->id_arrivals_from == NULL)) {
			if ($cupon->tipoPrivadoEstandar == 'estandar' || empty($cupon->tipoPrivadoEstandar)) {
				if ($destino == "") {
					$destino = "Chiquilá";
					if ($cupon->inverso == "true") {
						$destino = $cupon->desde;
					}
					if ($cupon->desde == "ChiquilÃ¡" && $cupon->concepto == "Transporte 35 USD") {
						$destino = "Aeropuerto Cancún";
					} 
				}
			} else if ($cupon->tipoPrivadoEstandar == 'premium') {
				if ($destino == "") {
					$destino = "Holbox";
					if ($cupon->inverso == "true") {
						$destino = $cupon->desde;
					}
				}
			}
		}

		if ($cupon->idioma == 'en') {
			if ($cupon->id_arrivals_to == 1 || $destino == 'Aeropuerto Cancún') {
	      		$destino = 'Cancun Airport';
			}
			if ($cupon->id_arrivals_from == 1) {
	      		$origen = 'Cancun Airport';
			}
	    }

		$esAeropuerto1 = "";
		if ($cupon->id_arrivals_from == 1 && !empty($cupon->vueloLlegada)) {
			$esAeropuerto1=" (".$cupon->vueloLlegada.") ";
		}

		$esAeropuerto2 = "";
		if (($cupon->id_arrivals_to == 1 || $cupon->id_arrivals_from) && !empty($cupon->numeroVuelo)) {
			$esAeropuerto2=" (".$cupon->numeroVuelo.") ";
		}

		$tieneHotelSalida = "";
		if (!empty($cupon->hotelSalida)) {
			$tieneHotelSalida = " (".$cupon->hotelSalida.") ";
		}

		$tieneHotelLlegada = "";
		if (!empty($cupon->hotel)) {
			$tieneHotelLlegada = " (".$cupon->hotel.") ";
		}
		$data["tipoViaje"] = $cupon->tipoViaje;

		$data["llegada"]["Fecha"] = $cupon->fechaLLegada;
		$data["llegada"]["Nombre"] = $cupon->nombre. " " .$cupon->apellido;
		$data["llegada"]["Telefono"] = $cupon->telefono;
		$data["llegada"]["Correo"] = $cupon->correo;
		$data["llegada"]["TipoVuelo"] = $cupon->tipoVuelo;
		$data["llegada"]["Pais"] = $cupon->ciudad. " - " .$cupon->pais;
		$data["llegada"]["Pax"] = $cupon->pasajeros;
		$data["llegada"]["Servicios"] = $origen.$esAeropuerto1.$tieneHotelLlegada." - ".$destino.$tieneHotelSalida;
		$data["llegada"]["Hora"] = $cupon->horarioLLegada;

		$data["salida"]["Fecha"] = $cupon->fechaSalida;
		$data["salida"]["Nombre"] = $cupon->nombre. " " .$cupon->apellido;
		$data["salida"]["Telefono"] = $cupon->telefono;
		$data["salida"]["Correo"] = $cupon->correo;
		$data["salida"]["TipoVuelo"] = $cupon->tipoVuelo;
		$data["salida"]["Pais"] = $cupon->ciudad. " - " .$cupon->pais;
		$data["salida"]["Pax"] = $cupon->pasajeros;
		$data["salida"]["Pickup"] = "";
		$data["salida"]["Hora"] = $cupon->id_arrivals_to == 1 ? $cupon->horarioSalida : '';
		if (!empty($cupon->horarioPickup) && ($cupon->tipoViaje == "Redondo" || $cupon->id_arrivals_to == 1)) {
			$data["salida"]["Pickup"] = $cupon->horarioPickup;
		}
		$data["salida"]["Servicios"] = $origen.$tieneHotelLlegada." - ".$destino.$esAeropuerto2.$tieneHotelSalida;
		if ($cupon->tipoViaje=="Redondo") {
				// $origen="";
				// $esAeropuerto2="";
			$data["salida"]["Servicios"] = $destino.$tieneHotelSalida." - ".$origen.$esAeropuerto2.$tieneHotelLlegada;
		}

		$data["observaciones"] = $cupon->observaciones;

		$tours = ReservatourCircuito::model()->findAll("idreserva=".$cupon->idreserva);
		$estour = "";
		if (!empty($tours)) {
				// $estour = "<br> ".$destino.$tieneHotelSalida;
			foreach ($tours as $t => $tour) {
				$estour.= $tour->hotel;
				if ($t == 0) {
					$estour.=" - ";
				}
				if ($t == 3 || $t == 5) {
					$estour.="<br>";
				}
					// $data["tour"][] = $tour;
			}
			$estour.=" - ".$destino.$tieneHotelSalida;
			if ($cupon->tipoViaje == 'Redondo') {
				$estour.= " - ".$origen.$esAeropuerto2;
			}
			$data["llegada"]["Servicios"] = $origen.$esAeropuerto1.$tieneHotelLlegada." - ".$tours[0]->hotel;
			$data["salida"]["Servicios"] = $estour;
		}
			// echo "<textarea>".CJSON::encode($data)."</textarea>"; exit;

			// $this->render("cupon");
		$siteController = Yii::app()->createController('site')[0];
		$mes = date('n');
		$traslateMonth = $siteController->traslateMonth($mes);
		if ($cupon->idioma == 'es') {
			$date = date('d').'-'.$traslateMonth.'-'.date('Y');
		} else if ($cupon->idioma == 'en') {
			$traslateMonth = $this->traslateEn($traslateMonth);
			$date = date('d').'-'.$traslateMonth.'-'.date('Y');
		}
		$data = array(
			'date' => $date,
			'id' => $id,
			'data' => $data,
			'cupon' => $cupon
		);
		return $data;
	}

	public function actionSendFromCoral() {
		$ids = Yii::app()->request->getPost('ids', 0);
		if ($ids != null) {
			$ids = json_decode($ids, true);
			if (is_array($ids)) {
				foreach ($ids as $id) {
					$data = $this->getDataCupon($id);
					$data['orden'] = Ordenreserva::model()->find('idreserva=' . $id);
					$html = $this->renderPartial('cupon', $data, true);
					if (!empty($data['cupon']->correo)) {
						// if ($data['cupon']->id_agencia == 1) {
							$this->actionMail($id, $html, false);
						// } else {
						// 	$this->actionMailCliente($id, $data["data"], $reenvio);
						// }
					}
				}
			}
		}
		echo 'success';
	}

	public function traslateEn($month){
		$date = '';
		switch ($month) {
			case 'ENERO':
				$date = 'January';
				break;
			case 'FEBRERO':
				$date = 'Febraury';
				break;
			case 'MARZO':
				$date = 'March';
				break;
			case 'ABRIL':
				$date = 'April';
				break;
			case 'MAYO':
				$date = 'May';
				break;
			case 'JUNIO':
				$date = 'June';
				break;
			case 'JULIO':
				$date = 'July';
				break;
			case 'AGOSTO':
				$date = 'August';
				break;
			case 'SEPTIEMBRE':
				$date = 'September';
				break;
			case 'OCTUBRE':
				$date = 'October';
				break;
			case 'NOVIEMBRE':
				$date = 'November';
				break;
			case 'DICIEMBRE':
				$date = 'December';
				break;
		}
		return $date;
	}

	public function actionDownloadPdf($html){

		Yii::import('application.extensions.bootstrap.gii.*');
		require_once('bootstrap/tcpdf/tcpdf.php');
		require_once('bootstrap/tcpdf/config/lang/eng.php');
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		// $pdf->setPageOrientation('L', $autopagebreak = '', $bottommargin = '');
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Confirmación #'.$id);
		$pdf->SetSubject('TRANSFER HOLBOX S.A DE C.V');
		$pdf->SetHeaderData("", "", "");
		$pdf->setHeaderFont(array('helvetica', '', 8));
		$pdf->setFooterFont(array('helvetica', '', 6));
		$pdf->SetMargins(15, 5, 15);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(10);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->SetAutoPageBreak(TRUE, 15);
		$pdf->SetFont('helvetica', '', 14);
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("Confirmación_".$id.".pdf", "I");
	}

	public function actionMail($id, $html = null, $reenvio = false){
		
		// $data = $this->actionCupon($id, "1");
		// $html = $this->renderPartial('cupon', $data, true);
		$cupon = Reservatour::model()->findByPk($id);
		$agencia = Agencies::model()->find("id=".$cupon->id_agencia);
		// $subject = "Estado de Resultados";
		// $data = array(
		// 	'date' => "date",
		// 	'type' => 1
		// );
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		if ($cupon->idioma == 'es') {
			$subject = "Orden ".$id." Confirmado";
		} else {
			$subject = "Order ".$id." Confirmed";
		}

		if ($reenvio) {
			$subject = 'Se actualizaron datos en su reserva. Verifique y confirme con su agencia.';
		}

		// if ($agencia->cellphone_2) {
			
		// }
		// $message = "
		// 	<body style='padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #464646;'>
		// 		<div>
		// 			<b>".$agencia->name."</b><br>
		// 			<h2>TRANSFER ".$cupon->referencia." ".$cupon->tipoViaje." ".$cupon->pasajeros."PAX</h2>
		// 			<br>
		// 			Buen día, <br>
		// 			Confirmo servicio <br><br>
		// 			<span><a href=".$enlaceCierre.">Ver movimientos</a></span><br><br>
		// 			Fecha/Hora de corte: ".date('d/m/Y H:i:s',strtotime($model->fecha_corte))." <br><br><br><br>

		// 			<b>ATENTAMENTE,</b><br><br>
		// 			<b>".$agencia->attendant.".</b> Cel: 
		// 		</div>
		// 	</body>
		// 	";
		$settingsEmail = SettingsEmail::model()->findAll();
		$settings = array();
		if (count($settingsEmail) > 0) {
			$settings = $settingsEmail[0];
		} else {
			$settings["port"] = 587;
			$settings["password"] = "jZoTiRull5sO";
			$settings["noReply"] = "no-reply@cancuntoislamujeres.com";
			$settings["fromname"] = "Cancun To Isla Mujeres";
			$settings["addCC"] = "josecanulisc@gmail.com,giovanyz@hotmail.com,admon@cancuntoislamujeres.com";
			$settings = json_decode(json_encode($settings));
		}
		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = 'cancuntoislamujeres.com';
		$mail->SMTPAuth = true;
		$mail->Username = $settings->noReply;
		$mail->Port = (int)$settings->port;
		$mail->Password = $settings->password;
		$mail->SMTPKeepAlive = true;
		$mail->Mailer = "smtp";
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->CharSet = 'utf-8';
		$mail->SMTPDebug  = 0;
		$mail->SetFrom($settings->noReply, $settings->fromname);
		$mail->Subject = $subject;
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->Body = $html;
		// $message = $html;
		// $mail->MsgHTML($message);
		
		$mail->AddAddress($cupon->correo, $cupon->nombre." ".$cupon->apellido);

		$_addBCC = explode(",", $settings["addCC"]);
		if (is_array($_addBCC)) {
			foreach ($_addBCC as $key => $bcc) {
				$mail->addBCC($bcc, $bcc);
			}
		}
		// $mail->addBCC("josecanulisc@gmail.com", "Jose Canul");
		// $mail->AddBCC('transfercholbox@gmail.com');
		// $mail->AddBCC('enrique_rmzjr@hotmail.com');
		// $mail->AddBCC('enriqueram691@gmail.com');
		// $mail->AddBCC('giovanyz@hotmail.com');
		// $mail->AddBCC('admon@cancuntoislamujeres.com');

		if ($mail->Send()) {

			// $mail->ClearAddresses();
			// $mail->addBCC($agencia->email, $agencia->attendant);
			// $mail->AddAddress($cupon->correo, $cupon->nombre." ".$cupon->apellido);

			// echo json_encode(array("error" => false));
		} else {
			// echo json_encode(array("error" => true));
		}
		// $mail->Send();
	}

	public function actionMailCliente($id, $data, $reenvio = false){

		$cupon = Reservatour::model()->findByPk($id);
		$agencia = Agencies::model()->find("id=".$cupon->id_agencia);

		Yii::import('application.extensions.phpmailer.JPhpMailer');
		if ($cupon->idioma == 'es') {
			$subject = "Orden ".$cupon->referencia." Confirmado";
		} else {
			$subject = "Order ".$cupon->referencia." Confirmed";
		}

		if ($reenvio) {
			$subject = 'Se actualizaron datos en su reserva. Verifique y confirme con su agencia.';
		}

		if ($cupon->tipoViaje == 'Redondo') {
			$servicio = $cupon->nombre." ".$cupon->apellido."<br><br>";
			if ($cupon->idioma == 'es') {
				$servicio.= "LLEGADA <br>";
			} else {
				$servicio.= "ARRIVAL <br>";
			}
			$servicio.= $data["llegada"]["Servicios"]." <br> ";
			$servicio.= date('d/m/Y', strtotime($cupon->fechaLLegada))." <br>";
			$servicio.= $cupon->pasajeros."PAX <br>";
			$servicio.= $cupon->horarioLLegada." Hrs. <br>";

			$servicio.= "<br><br>";

			if ($cupon->idioma == 'es') {
				$servicio.= "SALIDA <br>";
			} else {
				$servicio.= "RETURN <br>";
			}
			$servicio.= $data["salida"]["Servicios"]." <br> ";
			$servicio.= date('d/m/Y', strtotime($cupon->fechaSalida))." <br>";
			$servicio.= $cupon->pasajeros."PAX <br>";
			$servicio.= $cupon->horarioPickup." Hrs. <br>";
			
			$servicio.= "<br><br>";
		}

		if ($cupon->tipoViaje == 'Sencillo') {
			if ($cupon->idioma == 'es') {
				$servicio.= "SERVICIO - ";
			} else {
				$servicio.= "SERVICES - ";
			}
			if ($cupon->id_arrivals_to == 1) {
				$servicio.= $cupon->idioma == 'es' ? "SALIDA" : "DEPARTURE";
				$servicio.="<br><br>";
				$servicio.= $data["salida"]["Servicios"];
			} else {
				if (in_array($cupon->id_arrivals_to, [2, 3])) {
					# code...
					$servicio.= $cupon->idioma == 'es' ? 'LLEGADA' : 'ARRIVAL';
				} else if (in_array($cupon->id_arrivals_from, [2, 3])) {
					# code...
					$servicio.= $cupon->idioma == 'es' ? "SALIDA" : "DEPARTURE";
				} else {
					$servicio.= $cupon->idioma == 'es' ? 'LLEGADA' : 'ARRIVAL';
				}
				$servicio.="<br><br>";
				$servicio.= $data["llegada"]["Servicios"];
			}
			$servicio.="<br>";
			$servicio.= $cupon->nombre." ".$cupon->apellido."<br>";

			if (!empty($cupon->fechaLLegada)) {
				// code...
				$servicio.= date('d/m/Y', strtotime($cupon->fechaLLegada))." <br>";
				$horaServicio = $cupon->horarioLLegada." Hrs. <br>";
			}

			if (!empty($cupon->fechaSalida)) {
				// code...
				$servicio.= date('d/m/Y', strtotime($cupon->fechaSalida))." <br>";
				$horaServicio = $cupon->horarioPickup." Hrs. <br>";
			}
			$servicio.= $cupon->pasajeros."PAX <br>";
			$servicio.= $horaServicio;

			$servicio.= "<br><br>";
		}

		$contacto = "";
		if (!empty($agencia->cellphone)) {
			$contacto.= " Tel: ".$agencia->cellphone." <br>";
		}
		if (!empty($agencia->cellphone_2)) {
			$contacto.= " WPP: ".$agencia->cellphone_2." <br>";
		}
		if (!empty($agencia->email)) {
			$contacto.= " ".$agencia->email."  <br><br><br>";
		}

		if ($cupon->idioma == 'es') {
			$letter1 = "Buen día";
			$letter2 = "Confirmó servicio";
			$letter3 = "Saludos Cordiales, y que tenga un excelente día.";
			$letter4 = "ATENTAMENTE";
			$tipoViaje = $cupon->tipoViaje;
		} else {
			$letter1 = "Good day";
			$letter2 = "Confirmed service";
			$letter3 = "Have a great day.";
			$letter4 = "Yours Sincerely";
			$tipoViaje = $cupon->tipoViaje == 'Redondo' ? 'Round' : 'Single';
		}

		// <h4><b>".$agencia->name."</b></h4>
		$message = "
			<body style='padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #464646;'>
				<div>
					<h2>TRANSFER ".$cupon->referencia." ".$tipoViaje." ".$cupon->pasajeros."PAX</h2>
					<br>
					".$letter1.", <br>
					".$letter2." <br><br>
					
					".$servicio."

					<span>".$letter3."</span><br><br>

					<b>".$letter4.",</b><br><br>
					<b>Transfer Holbox</b><br>
					<b>Michelle Ramirez</b><br>
					<b>Louis Ramirez. Cel: <a href='tel:9841697279'>9841697279</a></b><br>
					<b>Tel: <a href='tel:9848752104'>(984) 8752104</a> & <a href='tel:9848752342'>(984) 8752342</a></b><br>
					<b>WPP<img src='https://admin.transferholbox.com/images/WhatsApp.svg.png' width='20' />: <a href='https://wa.me/529848752104?text=Hola%20me%20podría%20ayudar'>9848752104</a></b><br>
					<b>Cel: <a href='tel:9841369340'>9841369340</a></b><br>
				</div>
			</body>
			";
			// <b>".$agencia->name.".</b><br>
			// <b>".$agencia->attendant.".</b><br>
			// ".$contacto."

		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = 'cancuntoislamujeres.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'no-reply@cancuntoislamujeres.com';
		$mail->Port = '26';
		$mail->Password = 'brVj2BYrZNXn';
		$mail->SMTPKeepAlive = true;
		$mail->Mailer = "smtp";
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->CharSet = 'utf-8';
		$mail->SMTPDebug  = 0;
		$mail->SetFrom('no-reply@cancuntoislamujeres.com', 'Cancun To Isla Mujeres');
		$mail->Subject = $subject;
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->Body = $message;

		$mail->AddAddress($cupon->correo, $cupon->nombre." ".$cupon->apellido);
		$mail->AddBCC('josecanulisc@gmail.com');
		// $mail->AddBCC('transfercholbox@gmail.com');
		// $mail->AddBCC('enrique_rmzjr@hotmail.com');
		// $mail->AddBCC('enriqueram691@gmail.com');
		$mail->AddBCC('giovanyz@hotmail.com');
		$mail->AddBCC('admon@cancuntoislamujeres.com');

		if (!$mail->Send()) {
			// echo 'fallo';
		}
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}