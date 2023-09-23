<?php
Yii::import('application.extensions.phpmailer.JPhpMailer');
Yii::import('application.extensions.bootstrap.gii.*');
require_once('bootstrap/tcpdf/tcpdf.php');
require_once('bootstrap/tcpdf/config/lang/eng.php');

class MYPDF extends TCPDF
{
	public $header = "";
	public $quincena = "";
	public $agencia = null;
	public $costo = 0;

	function setParams($quincena, $agencia, $costo)
	{
		$this->quincena = $quincena;
		$this->agencia = $agencia;
		$this->costo = $costo;
	}

	//Page header
	public function Header()
	{
        // Set font
        $this->header = $this->agencia != null ? '
        <table cellpadding="4">
			<tr>
				<td width="250"></td>
				<td width="250" style="margin-top: 10px; text-align: center; font-size: 16px;">
					<h4 style="font-size: 14px;"><b>'.$this->agencia.'</b></h4>
					<span style="font-size: 12px;">'.ucfirst(strtolower($this->quincena)).'</span> <br>
				</td>
				<td width="250" style="text-align: center; letter-spacing: -1px; font-size: 11px;">
					<span><b>Total:</b></span> <br />
					$ '.number_format($this->costo, 2).' <br />
				</td>
			</tr>
		</table>' : '
		<table cellpadding="4">
			<tr>
				<td width="250"></td>
				<td width="250" style="margin-top: 10px; text-align: center; font-size: 16px;">
					<span style="font-size: 12px;">'.ucfirst(strtolower($this->quincena)).'</span> <br>
				</td>
			</tr>
		</table>';
		$this->SetY(5);
        $this->SetFont('helvetica', '', 10);
        $this->writeHTML($this->header, true, false, false, false, "");
	}
}

class AgenciesController extends Controller
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
				'actions'=>array('create','update','GeneratePdf','GenerateExcel','List','save','delete','getAgencies','buscarAgencia','agrupados','GetListAgencies'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array(
				'allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array(
					'EnviarEstadoCuenta', 'imprimirpdf'
				),
				'users' => array('*'),
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
		$model=new Agencies;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Agencies']))
		{
			$model->attributes=$_POST['Agencies'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionSave()
	{
		$model=new Agencies;
		$error = false;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Agencies']))
		{
			$siteController = Yii::app()->createController('site')[0];
			$uuid = $siteController->guidv4();
			$model->attributes=$_POST['Agencies'];
			$model->uuid = $uuid;
			$model->cellphone = $_POST['Agencies']['cellphone'];
			$model->cellphone_2 = $_POST['Agencies']['cellphone_2'];
			if (in_array($_POST['Agencies']['status'], array("true","false",true,false))) {
				$model->status = $_POST['Agencies']['status'] ? 1 : 0;
			}
			// echo "<textarea>".CJSON::encode($model)."</textarea>"; exit;
			if(!$model->save()){
				$error = true;
				echo CJSON::encode($model->getErrors());
			} 
			// else {

			// }
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
		if(isset($_POST['Agencies']))
		{
			$model->attributes=$_POST['Agencies'];
			$model->cellphone = $_POST['Agencies']['cellphone'];
			$model->cellphone_2 = $_POST['Agencies']['cellphone_2'];
			$model->status = $_POST['Agencies']['status'] ? 1 : 0;
			$model->updated_at = date('Y-m-d H:i:s');
			// echo "<textarea>".CJSON::encode($model)."</textarea>"; exit;
			if(!$model->save()){
				$error = true;
				// $this->redirect(array('view','id'=>$model->id));
				echo CJSON::encode($model->getErrors());
			} 
		}

		echo CJSON::encode(array('error' => $error));
		// $this->render('update',array(
		// 	'model'=>$model,
		// ));
	}

	public function actionBuscarAgencia($id){
		$agency = Agencies::model()->findByPk($id);
		// echo CJSON::encode($agency); exit;
		$correo = '';
		$cellphone = '';
		$name = '';
		$last_name = '';
		if(!empty($agency)){
			$correo = $agency->email;
			$cellphone = $agency->cellphone != null ? $agency->cellphone : '';
			$dividir = $agency->attendant != null ? explode(' ', $agency->attendant) : null;
			if ($dividir != null) 
				foreach ($dividir as $k => $e) {
					if ($k == 0) $name = $e;
					if ($k > 0) $last_name = $e.' '; 
				}
		} 

		echo CJSON::encode(array('correo'=>$correo, 'attendant' => $name, 'last_name' => $last_name, 'cellphone' => $cellphone));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		// if(Yii::app()->request->isPostRequest)
		// {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			echo CJSON::encode(array('error' => false));
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			// if(!isset($_GET['ajax']))
				// $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		// }
		// else
			// throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex(){
		$this->render('index');
	}

	public function actionList(){

		$agencies = Agencies::model()->findAll(array('order'=>'id DESC'));
		$row = [];
		foreach ($agencies as $v) {
		    switch ($v->status) {
		    	case 0:
		    			$v->status = "Ináctivo";
		    		break;
		    	case 1:
		    	default:
		    			$v->status = "Áctivo";
		    		break;
		    }
		    $row[] = $v;
		}
		echo $_GET['$callback'] . '({"row":' . CJSON::encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) . '"})';
	
	}

	public function actionagrupados(){
		$hoy = date('Y-m-d 00:00:00');
		$diaHoy = date('d', $hoy);

		if ($diaHoy <= 15) {
			$hoyMenos15Dias = date('Y-m-1 00:00:00');
			$hoy = date('Y-m-15 23:59:59');
		} else {
			$hoyMenos15Dias = date('Y-m-16 00:00:00');
			$hoy = date('Y-m-t 23:59:59');
		}

		$this->render('agrupados', array('hoy' => $hoy, 'hoyMenos15Dias' => $hoyMenos15Dias));
	}

	public function actionGetListAgencies($hoy, $hoyMenos15Dias, $id_agencia, $PDF = false, $send = false){
		$hoy = implode('-', array_reverse(explode('/', $hoy)));
		$hoyMenos15Dias = implode('-', array_reverse(explode('/', $hoyMenos15Dias)));

		$hoy = date('Y-m-d', strtotime($hoy));
		$hoyMenos15Dias = date('Y-m-d', strtotime($hoyMenos15Dias));

		$orderBy = 'fechaLLegada ASC, horarioLLegada ASC, fechaSalida ASC, horarioPickup ASC';
		
		$condition = '(fechaLLegada BETWEEN "'.$hoyMenos15Dias.'" AND "'.$hoy.'" OR fechaSalida BETWEEN "'.$hoyMenos15Dias.'" AND "'.$hoy.'") AND estatus IN("PA", "A")';
		if ((int) $id_agencia > 0) {
			$condition.=" AND id_agencia=".$id_agencia." ";
		}
		// echo $condition; exit;
		$orders = Reservatour::model()->with('idAgencia')->findAll(array('order'=>$orderBy, 'condition'=>$condition));

		$row = [];
		$costo = 0;
		$orders = json_decode(CJSON::encode($orders), true);

		foreach ($orders as $key => $value) {
			if ($value['manual'] == 0) continue;
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

		if ($PDF) {
			$siteController = Yii::app()->createController('site')[0];
			$fechaQuincenal = $hoyMenos15Dias.' - '.$hoy;
			$agency = Agencies::model()->findByPk($id_agencia);

			$mes_1 = date('n', strtotime($hoyMenos15Dias));
			$mes_2 = date('n', strtotime($hoy));
			$traslateMonth_1 = $siteController->traslateMonth($mes_1);
			$traslateMonth_2 = $siteController->traslateMonth($mes_2);
			$date = date('d', strtotime($hoyMenos15Dias)).'-'.$traslateMonth_1.'-'.date('Y', strtotime($hoyMenos15Dias));
			$date.=' al ';
			$date.= date('d', strtotime($hoy)).'-'.$traslateMonth_2.'-'.date('Y', strtotime($hoy));

			$data = array(
				'row' => $row,
				'date' => $date,
				'agencia' => $agency,
				'costo' => $costo
			);
			return $data;
			// $html = $this->renderPartial('agrupadosPDF', $data, true);
			// $this->actionDownloadPdf($html, $data['date'], $agency->name, $data['costo'], false);
		} else {
			echo $_GET['$callback'] . '({"row":' . CJSON::encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) .'"})';
		}

	}

	public function actionGetAgencies(){
		$agencies = Agencies::model()->findAll(array('order'=>'name ASC'));
		$row = array();
		foreach ($agencies as $key => $val) {
		    $row[$key]['id'] = $val->id;
		    $row[$key]['name'] = $val->name;
		}
		echo CJSON::encode($row);
	}

	public function actionEnviarEstadoCuenta() {
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		// setlocale(LC_ALL,"es_ES");
		$encabezados  = "MIME-Version: 1.0\n";
		$encabezados .= "Content-type: text/html; charset=UTF-8\n";
		$encabezados .= "From:  Transfer Holbox <no-reply@transferholbox.com>\n";
		$encabezados .= "X-Sender: <contacto web>\n";
		$encabezados .= "X-Mailer: PHP\n";
		$encabezados .= "X-Priority: 3\n";
		$encabezados .= "Return-Path: <web page>\n";

		if (isset($_GET['hoy']) && isset($_GET['hoyMenos15Dias'])) {
			$hoy = $_GET['hoy'];
			$hoyMenos15Dias = $_GET['hoyMenos15Dias'];
		} else {
			$hoy = date('d/m/Y');
			$hoyMenos15Dias = date('d/m/Y', strtotime(date('Y-m-d').' -15 days'));
		}

		if (isset($_GET['id_agencia']) && (int) $_GET['id_agencia'] > 0) {
			$agencies = Agencies::model()->findAll('id = '.$_GET['id_agencia']);
		} else {
			$agencies = Agencies::model()->findAll('status=1');
			// $agencies = Agencies::model()->findAll('status=1 AND id IN(1, 13)');
		}

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

		$args = array(
			'grupo' => true,
			'agencias' => array()
		);
		foreach ($agencies as $key => $agency) {
			if ($agency->email_two == NULL || $agency->email_two == '') continue;
			$data = $this->actionGetListAgencies($hoyMenos15Dias, $hoy, $agency->id, true, true);

			if (count($data['row']) == 0) continue;
			array_push($args['agencias'], $data);
			$subject = "Estado de cuenta ".$agency->name;

			$mail->ClearAttachments();
			$mail->ClearAddresses();
			$mail->Subject = $subject;
			$mail->Body = $this->renderPartial('agrupadosHTML', $data, true);

			$html = $this->renderPartial('agrupadosPDF', $data, true);
			$pdfFile = $this->actionDownloadPdf($html, $data['date'], $agency->name, $data['costo'], true);
			$mail->addStringAttachment($pdfFile, 'Estado_Cuenta_'.date('d-m-Y_His').'.pdf');
			
			// $mail->AddAddress($agency->email_two, $agency->name);
			$mail->AddAddress('josecanulisc@gmail.com', $agency->name);
			$mail->Send();
		}

		$mail->ClearAttachments();
		$mail->ClearAddresses();
		$mail->Subject = "Estados de cuenta enviadas a las agencias";
		$mail->Body = $this->renderPartial('agrupadosHTML', $args, true);

		$html = $this->renderPartial('agrupadosPDF', $args, true);
		$allPDF = $this->actionDownloadPdf($html, $args['agencias'][0]['date'], null, 0, true);
		$mail->addStringAttachment($allPDF, 'Estados_Cuenta_'.date('d-m-Y_His').'.pdf');

		// al dueño
		// $mail->AddAddress('enriqueram691@hotmail.com', 'Enrique');
		// $mail->AddAddress('enrique_rmzjr@hotmail.com', 'Enrique');
		// $mail->AddAddress('enriqueram691@gmail.com', 'Enrique');
		$mail->AddAddress('josecanulisc@gmail.com', $agency->name);
		// $mail->AddBCC('josecanulisc@gmail.com', 'Jose Canul Dzul');
		// $mail->AddBCC('giovanyz@hotmail.com', 'Giovanny Zapata');
		$mail->Send();
		return 1;
	}

	public function actionimprimirpdf() {
		// echo '<textarea>'.CJSON::encode($_GET).'</textarea>'; exit;
		if (isset($_GET['fecha_start']) && isset($_GET['fecha_end'])) {
			$hoy = $_GET['fecha_start'];
			$hoyMenos15Dias = $_GET['fecha_end'];
		} else {
			$hoy = date('d/m/Y');
			$hoyMenos15Dias = date('d/m/Y', strtotime(date('Y-m-d').' -15 days'));
		}

		if (isset($_GET['id_agencia_pdf']) && (int) $_GET['id_agencia_pdf'] > 0) {
			$agencies = Agencies::model()->findAll(array('order'=>'name ASC', 'condition'=>'id = '.$_GET['id_agencia_pdf']));
		} else {
			$agencies = Agencies::model()->findAll(array('order'=>'name ASC', 'condition'=>'status=1'));
		}

		$args = array(
			'grupo' => true,
			'agencias' => array()
		);

		foreach ($agencies as $key => $agency) {
			$data = $this->actionGetListAgencies($hoyMenos15Dias, $hoy, $agency->id, true, true);

			if (count($data['row']) == 0) continue;
			array_push($args['agencias'], $data);
		}
		$html = $this->renderPartial('agrupadosPDF', $args, true);
		$this->actionDownloadPdf($html, $args['agencias'][0]['date'], null, 0, false);
	}

	public function actionDownloadPdf($html, $quincena, $nombre_agencia, $costo, $send = false){
		$logo = 'https://'.$_SERVER['SERVER_NAME'] . "/images/logo-holbox.svg";
		
		$pdf = new MYPDF();
		$padding = ($nombre_agencia == null) ? 15 : 26 ;

		$pdf->setParams($quincena, $nombre_agencia, $costo);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor($nombre_agencia);
		$pdf->SetTitle('Estado de cuenta '.$nombre_agencia);
		$pdf->SetSubject('Estado de cuenta '.$nombre_agencia);
		$pdf->setHeaderFont(Array('helvetica', '', 12));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, $padding, 15);

		$pdf->setPrintHeader(true);
		$pdf->SetHeaderMargin(15);

		$pdf->setPrintFooter(true);
		$pdf->SetFooterMargin(10);

		 $pdf->setPageOrientation('L', '', 1);

		$pdf->SetAutoPageBreak(TRUE, 30);
		$pdf->SetFont('helvetica', '', 8.5);
		$pdf->AddPage();

		//get the current page break margin:
		$bMargin = $pdf->getBreakMargin();   

		//get current auto-page-break mode:
		$auto_page_break = $pdf->getAutoPageBreak();

		//enable auto page break:
		$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
		
		$pdf->setPageMark();

		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->LastPage();
		if ($send) {
			$filePDF = $pdf->Output("EstadoCuenta_".date('H:i:s').".pdf", "S"); 
			return $filePDF;
		} else {
			$pdf->Output("Estados_Cuenta_".date('H:i:s').".pdf", "I");
		} 
	}

	public function actionIndexV2()
	{
            $session=new CHttpSession;
            $session->open();		
            $criteria = new CDbCriteria();            

                $model=new Agencies('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Agencies']))
		{
                        $model->attributes=$_GET['Agencies'];
			
			
                   	
                       if (!empty($model->id)) $criteria->addCondition("id = '".$model->id."'");
                     
                    	
                       if (!empty($model->uuid)) $criteria->addCondition("uuid = '".$model->uuid."'");
                     
                    	
                       if (!empty($model->name)) $criteria->addCondition("name = '".$model->name."'");
                     
                    	
                       if (!empty($model->description)) $criteria->addCondition("description = '".$model->description."'");
                     
                    	
                       if (!empty($model->email)) $criteria->addCondition("email = '".$model->email."'");
                     
                    	
                       if (!empty($model->attendant)) $criteria->addCondition("attendant = '".$model->attendant."'");
                     
                    	
                       if (!empty($model->status)) $criteria->addCondition("status = '".$model->status."'");
                     
                    	
                       if (!empty($model->created_at)) $criteria->addCondition("created_at = '".$model->created_at."'");
                     
                    	
                       if (!empty($model->updated_at)) $criteria->addCondition("updated_at = '".$model->updated_at."'");
                     
                    	
                       if (!empty($model->deleted_at)) $criteria->addCondition("deleted_at = '".$model->deleted_at."'");
                     
                    	
                       if (!empty($model->email_two)) $criteria->addCondition("email_two = '".$model->email_two."'");
                     
                    			
                    $session['Agencies_records']=Agencies::model()->findAll($criteria); 
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
		$model=new Agencies('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Agencies']))
			$model->attributes=$_GET['Agencies'];

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
		$model=Agencies::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='agencies-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Agencies_records']))
               {
                $model=$session['Agencies_records'];
               }
               else
                 $model = Agencies::model()->findAll();

		
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

             if(isset($session['Agencies_records']))
               {
                $model=$session['Agencies_records'];
               }
               else
                 $model = Agencies::model()->findAll();



		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		//die($html);
		
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Agencies Report');
		$pdf->SetSubject('Agencies Report');
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
		$pdf->Output("Agencies_002.pdf", "I");
	}
}
