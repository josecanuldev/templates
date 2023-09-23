<?php

class DriversController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/transfer_home';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GeneratePdf','GenerateExcel','list','vans','delete','getDrivers','AddOperador','agrupados','getListDrivers'),
				'users'=>array('@'),
			),
			array(
				'allow',
				'actions' => array('enviarRelacionOperadores','imprimirpdf'),
				'users' => array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Drivers;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$error = false;
		if(isset($_POST['Drivers']))
		{
			$siteController = Yii::app()->createController('site')[0];
			$uuid = $siteController->guidv4();
			$model->attributes=$_POST['Drivers'];
			$model->uuid = $uuid;
			if(!$model->save()){
				$error = true;
				echo CJSON::encode($model->getErrors());
			}
		}

		echo CJSON::encode(array('error' => $error));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$error = false;
		if(isset($_POST['Drivers']))
		{
			$model->attributes=$_POST['Drivers'];
			$model->status = $_POST['Drivers']['status'] == "true" ? 1 : 0;
			$model->updated_at = date('Y-m-d H:i:s');
			if(!$model->save()){
				$error = true;
			}
		}

		echo CJSON::encode(array('error' => $error));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		echo CJSON::encode(array('error' => false));
		// if(Yii::app()->request->isPostRequest)
		// {
		// 	// we only allow deletion via POST request
		// 	$this->loadModel($id)->delete();

		// 	// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		// 	if(!isset($_GET['ajax']))
		// 		$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		// }
		// else
		// 	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex(){
		$this->render('index');
	}

	public function actionList(){
		$drivers = Drivers::model()->findAll(array('order'=>'id DESC'));
		$row = [];
		foreach ($drivers as $k => $v) {
		    switch ($v->status) {
		    	case 0:
		    			$v->status = "Ináctivo";
		    		break;
		    	case 1:
		    	default:
		    			$v->status = "Áctivo";
		    		break;
		    }
		    $row[$k]["id"] = $v->id;
		    $row[$k]["uuid"] = $v->uuid;
		    $row[$k]["name"] = $v->name;
		    $row[$k]["license"] = $v->license;
		    $row[$k]["telefono"] = $v->telefono;
		    $row[$k]["whatsapp"] = $v->whatsapp;
		    $row[$k]["correo"] = $v->correo;
		    $row[$k]["id_van"] = $v->id_van;
		    $row[$k]["status"] = $v->status;
		    $row[$k]["created_at"] = $v->created_at;
		    $row[$k]["van"] = $v->idVans->model;
		}
		echo $_GET['$callback'] . '({"row":' . CJSON::encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) . '"})';
	}

	public function actiongetDrivers(){
		$drivers = Drivers::model()->findAll(array('order'=>'id DESC'));
		$row = [];
		foreach ($drivers as $k => $v) {
		    $row[] = $v;
		}
		echo CJSON::encode($row);
	}

	public function actionAddOperador(){
		// echo json_encode($_POST);
		if (isset($_POST["Driver"]["idreserva"])) {
			$cupon = Reservatour::model()->find("idreserva=".$_POST['Driver']['idreserva']);
			$error = true;
			if (!empty($cupon)) {
				$cupon->id_driver = $_POST["Driver"]["id_driver"];
				if ($cupon->save()) {
					$error = false;
				}
			}
			echo CJSON::encode(array("error"=>$error));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndexV2()
	{
            $session=new CHttpSession;
            $session->open();		
            $criteria = new CDbCriteria();            

                $model=new Drivers('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Drivers']))
		{
                        $model->attributes=$_GET['Drivers'];
			
			
                   	
                       if (!empty($model->id)) $criteria->addCondition("id = '".$model->id."'");
                     
                    	
                       if (!empty($model->uuid)) $criteria->addCondition("uuid = '".$model->uuid."'");
                     
                    	
                       if (!empty($model->name)) $criteria->addCondition("name = '".$model->name."'");
                     
                    	
                       if (!empty($model->license)) $criteria->addCondition("license = '".$model->license."'");
                     
                    	
                       if (!empty($model->id_van)) $criteria->addCondition("id_van = '".$model->id_van."'");
                     
                    	
                       if (!empty($model->status)) $criteria->addCondition("status = '".$model->status."'");
                     
                    	
                       if (!empty($model->created_at)) $criteria->addCondition("created_at = '".$model->created_at."'");
                     
                    	
                       if (!empty($model->updated_at)) $criteria->addCondition("updated_at = '".$model->updated_at."'");
                     
                    	
                       if (!empty($model->deleted_at)) $criteria->addCondition("deleted_at = '".$model->deleted_at."'");
                     
                    			
                    $session['Drivers_records']=Drivers::model()->findAll($criteria); 
		}
       

                $this->render('index',array(
			'model'=>$model,
		));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Drivers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Drivers']))
			$model->attributes=$_GET['Drivers'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Drivers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='drivers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Drivers_records']))
               {
                $model=$session['Drivers_records'];
               }
               else
                 $model = Drivers::model()->findAll();

		
		Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('excelReport', array(
				'model'=>$model
			), true)
		);
	}
        public function actionGeneratePdf() 
	{
           $session=new CHttpSession;
           $session->open();
		Yii::import('application.extensions.bootstrap.gii.*');
		require_once('bootstrap/tcpdf/tcpdf.php');
		require_once('bootstrap/tcpdf/config/lang/eng.php');

             if(isset($session['Drivers_records']))
               {
                $model=$session['Drivers_records'];
               }
               else
                 $model = Drivers::model()->findAll();



		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		//die($html);
		
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Drivers Report');
		$pdf->SetSubject('Drivers Report');
		//$pdf->SetKeywords('example, text, report');
		$pdf->SetHeaderData('', 0, "Report", '');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Example Report by ".Yii::app()->name, "");
		$pdf->setHeaderFont(Array('helvetica', '', 8));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, 18, 15);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('dejavusans', '', 7);
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("Drivers_002.pdf", "I");
	}

	public function listaParaOperadores($data, $option) {
		if ($option == 1) {
			$this->actionimprimirpdf($data);
		} else {
			// $this->actionEnviarRelacionOperadores($data);
		}
	}

	public function actionEnviarRelacionOperadores($data = NULL) {
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		// setlocale(LC_ALL,"es_ES");
		$encabezados  = "MIME-Version: 1.0\n";
		$encabezados .= "Content-type: text/html; charset=UTF-8\n";
		$encabezados .= "From:  Transfer Holbox <no-reply@transferholbox.com>\n";
		$encabezados .= "X-Sender: <contacto web>\n";
		$encabezados .= "X-Mailer: PHP\n";
		$encabezados .= "X-Priority: 3\n";
		$encabezados .= "Return-Path: <web page>\n";
		$subject = "Asignaciones de reservas";

		// $operadores = Drivers::model()->findAll('status=1 AND correo IS NOT NULL AND correo != ""');

		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->Host = 'transferholbox.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'no-reply@transferholbox.com';
		$mail->Port = '26';
		$mail->Password = 'transferHB2022';
		$mail->SMTPKeepAlive = true;
		$mail->Mailer = "smtp";
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->CharSet = 'utf-8';
		$mail->SMTPDebug  = 0;
		$mail->SetFrom('no-reply@transferholbox.com', 'Transfer Holbox');
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		if ($data == NULL) return 0;
		$row = $data['row'];
		$agrupados = array();
		$agrupadosNoVacios = array();

		foreach ($row as $key => $operador) {
			if ($operador['id_driver'] == NULL || (int) $operador['id_driver'] == 0 || $operador['id_driver'] == '') continue;
			$agrupados[$operador['id_driver']][] = $operador;
			array_push($agrupadosNoVacios, $operador);
		}

		$ordersController = Yii::app()->createController('orders')[0];
		$countOperadores = 0;
		foreach ($agrupados as $key => $operador) {
			$data['row'] = $operador;
			$driver = Drivers::model()->find('status=1 AND correo IS NOT NULL AND correo != "" AND id="'.$key.'"');
			if ($driver == null || !is_object($driver)) continue;
			$message = "
				<div align='center' style='font-family:helvetica'>
					<img src='https://" . $_SERVER['SERVER_NAME'] . "/images/logo_tranfer.png' style='width:15%;'><br>
					<p>Estimado " .$driver->name. " por este medio se le adjunta las reservas asignadas a su nombre en las fechas: ".$data['date'].".</p>
					<p>Saludos Cordiales<br>Transfer Holbox.</p>
				</div>";

			$mail->ClearAttachments();
			$mail->ClearAddresses();
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			
			$html = $this->renderPartial('/orders/ordersPdf', $data, true);
			$pdfFile = $ordersController->actionDownloadPdf($html, $data['date'], true);
			$mail->addStringAttachment($pdfFile, 'Listado_de_reservas_'.date('d-m-Y_His').'.pdf');

			$mail->AddAddress($driver->correo, $driver->name);
			$countOperadores++;
			// $mail->Send();
		}

		if ($countOperadores > 0) {
			# code...
			$message = "
				<div align='center' style='font-family:helvetica'>
					<img src='https://" . $_SERVER['SERVER_NAME'] . "/images/logo_tranfer.png' style='width:15%;'><br>
					<p>Estimado Enrique por este medio se le adjunta las reservas asignadas a los operadores en las fechas: ".$data['date'].". 
						<br>
						<b>Nota: * Si el operador no tiene registrado su correo en el sistema, no es posible enviarle el correo</b>
					</p>
					<p>Saludos Cordiales<br>Transfer Holbox.</p>
				</div>";
			$mail->ClearAttachments();
			$mail->ClearAddresses();
			$mail->Subject = $subject;
			$mail->MsgHTML($message);

			$data['row'] = $agrupadosNoVacios;
			$html = $this->renderPartial('/orders/ordersPdf', $data, true);
			$pdfFile = $ordersController->actionDownloadPdf($html, $data['date'], true);
			$mail->addStringAttachment($pdfFile, 'Listado_de_reservas_'.date('d-m-Y_His').'.pdf');
			
			// al dueño
			// $mail->AddAddress('enriqueram691@hotmail.com', 'Enrique');
			// $mail->AddAddress('enrique_rmzjr@hotmail.com', 'Enrique');
			// $mail->AddAddress('enriqueram691@gmail.com', 'Enrique');
			$mail->AddAddress('josecanulisc@gmail.com', $agency->name);
			// $mail->AddBCC('josecanulisc@gmail.com', 'Jose Canul');
			$mail->AddBCC('giovanyz@hotmail.com', 'Giovanny Zapata');
			// $mail->Send();
		}

		return 1;
	}

	public function actionimprimirpdf($data) {
		if ($data == NULL) $data['row'] = [];
		$row = $data['row'];
		$agrupados = array();
		$agrupadosNoVacios = array();

		foreach ($row as $key => $operador) {
			if ($operador['id_driver'] == NULL || (int) $operador['id_driver'] == 0 || $operador['id_driver'] == '') continue;
			$agrupados[$operador['id_driver']][] = $operador;
			array_push($agrupadosNoVacios, $operador);
		}

		// usort($agrupadosNoVacios, function($a, $b) {
		//     return strcmp($a['operador'], $b['operador']);
		// });
		// echo '<textarea>'.CJSON::encode($agrupadosNoVacios).'</textarea>'; exit;

		$ordersController = Yii::app()->createController('orders')[0];
		$data['row'] = $agrupadosNoVacios;
		$html = $this->renderPartial('/orders/ordersPdf', $data, true);
		$ordersController->actionDownloadPdf($html, $data['date'], false);
	}

	public function actionagrupados(){
		$hoy = date('Y-m-d 00:00:00');
		$hoyMenos15Dias = date('Y-m-d 23:59:59', strtotime(date('Y-m-d').' -15 days'));
		$this->render('agrupados', array('hoy' => $hoy, 'hoyMenos15Dias' => $hoyMenos15Dias));
	}

	public function actionGetListDrivers($hoy, $hoyMenos15Dias, $id_operador, $rango){
		$hoy = implode('-', array_reverse(explode('/', $hoy)));
		$hoyMenos15Dias = implode('-', array_reverse(explode('/', $hoyMenos15Dias)));

		$hoy = date('Y-m-d', strtotime($hoy));
		$hoyMenos15Dias = date('Y-m-d', strtotime($hoyMenos15Dias));

		$orderBy = 'fechaLLegada ASC, horarioLLegada ASC, fechaSalida ASC, horarioPickup ASC';
		
		$condition = '(fechaLLegada BETWEEN "'.$hoyMenos15Dias.'" AND "'.$hoy.'" OR fechaSalida BETWEEN "'.$hoyMenos15Dias.'" AND "'.$hoy.'") AND estatus IN("PA", "A")';
		if ((int) $id_operador > 0) {
			$condition.=" AND id_driver=".$id_operador." ";
		} else {
			$condition.=" AND id_driver IS NOT NULL AND id_driver > 0 ";
		}
		// echo $condition; exit;
		$orders = Reservatour::model()->with('idOperador')->findAll(array('order'=>$orderBy, 'condition'=>$condition));

		$row = [];
		$costo = 0;
		$orders = json_decode(CJSON::encode($orders), true);

		foreach ($orders as $key => $value) {
			$pagos = Ordenreserva::model()->findAll('idreserva='.$value['idreserva']);
			$agencia = Agencies::model()->findByPk($value['id_agencia']);
			$origen = Arrivals::model()->findByPk($value['id_arrivals_from']);
			$destino = Arrivals::model()->findByPk($value['id_arrivals_to']);
			$operador = Drivers::model()->findByPk($value['id_driver']);

			$total = 0;
			foreach ($pagos as $cobro) {
				if (!in_array((int) $cobro->status, [3])) continue;
				$tipo_cambio=$cobro->tipo_cambio;
				$precio_unit=$cobro->total;
				if ((float) $tipo_cambio > 1 && $cobro->moneda == 'USD') $precio_unit= $precio_unit * $tipo_cambio;
				$total+=$precio_unit;
				$costo+=$precio_unit;
			}
			// if ($total == 0) continue;

			$hotel = '';
			$aerolinea_vuelo = '';
			$hora = '';
			$fecha = '';
			$fechaString = '';

			if (!empty($value['horarioPickup'])) {
				$hora = $value['horarioPickup'];
			}
			if ($value['tipoViaje'] == 'Redondo') {
				$hotel = !empty($value['hotel']) ? $value['hotel'] : ''; 
				$hotel.= !empty($value['hotelSalida']) ? ' / '.$value['hotelSalida'] : '';

				$aerolinea_vuelo = $value['aerolineaLlegada'].' '.$value['vueloLlegada'].' / '.$value['aerolinea'].' '.$value['numeroVuelo'];
				if (empty($hora)) $hora = $value['horarioLLegada'];
				$fecha = $value['fechaLLegada'];
				$fechaString = date('d/m/Y', strtotime($value['fechaLLegada'])).' - '.date('d/m/Y', strtotime($value['fechaSalida']));
			} else {
				if (!empty($value['fechaLLegada'])) {
					$hotel = $value['hotel'];
					$aerolinea_vuelo = $value['aerolineaLlegada'].' '.$value['vueloLlegada'];
					if (empty($hora)) $hora = $value['horarioLLegada'];
					$fecha = $value['fechaLLegada'];
					$fechaString = date('d/m/Y', strtotime($value['fechaLLegada']));
				} elseif (!empty($value['fechaSalida'])) {
					$hotel = $value['hotelSalida'];
					$aerolinea_vuelo = $value['aerolinea'].' '.$value['numeroVuelo'];
					if (empty($hora)) $hora = $value['horarioSalida'];
					$fecha = $value['fechaSalida'];
					$fechaString = date('d/m/Y', strtotime($value['fechaSalida']));
				}
			}

			$value['total'] = $total;
			$value['agencia'] = $agencia->name;
			$value['origen'] = $origen->name;
			$value['destino'] = $destino->name;
			$value['operador'] = is_object($operador) ? $operador->name : '';
			$value['aerolinea_vuelo'] = $aerolinea_vuelo;
			$value['hora'] = $hora;
			$value['fechaString'] = $fechaString;
			$value['fecha'] = $fecha;

			$row[] = $value;
		}

		// echo '<textarea>'.CJSON::encode($row).'</textarea>';

		usort($row, function ($a, $b) {
			$date_a = $a['fecha'].' '.$a['hora'];
			$date_b = $b['fecha'].' '.$b['hora'];
			if (strtotime($date_b) < strtotime($date_a))
				return 1;
			else if (strtotime($date_b) > strtotime($date_a))
				return -1;
			else
				return 0;
		});

		echo $_GET['$callback'] . '({"row":' . CJSON::encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) .'"})';

	}
}
