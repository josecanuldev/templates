<?php

class VansController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
				'actions'=>array('create','update','GeneratePdf','GenerateExcel','list','GetVans','delete'),
				'users'=>array('@'),
			),
			array(
				'allow',
				'actions' => array('validarFechaVencimiento'),
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
		$model=new Vans;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$error = false;
		if(isset($_POST['Vans']))
		{
			$siteController = Yii::app()->createController('site')[0];
			$uuid = $siteController->guidv4();
			$model->attributes=$_POST['Vans'];
			if (!empty($_POST['Vans']['fecha_alta'])) $model->fecha_alta = implode('-', array_reverse(explode('/', $_POST['Vans']['fecha_alta'])));
			if (!empty($_POST['Vans']['fecha_vencimiento'])) $model->fecha_vencimiento = implode('-', array_reverse(explode('/', $_POST['Vans']['fecha_vencimiento'])));
			if (!empty($_POST['Vans']['fecha_seguro'])) $model->fecha_seguro = implode('-', array_reverse(explode('/', $_POST['Vans']['fecha_seguro'])));
			if (!empty($_POST['Vans']['fecha_mantenimiento'])) $model->fecha_mantenimiento = implode('-', array_reverse(explode('/', $_POST['Vans']['fecha_mantenimiento'])));
			$model->uuid = $uuid;
			if(!$model->save()){
				$error = true;
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
		if(isset($_POST['Vans']))
		{
			$model->attributes=$_POST['Vans'];
			$model->updated_at = date('Y-m-d H:i:s');
			if (!empty($_POST['Vans']['fecha_alta'])) $model->fecha_alta = implode('-', array_reverse(explode('/', $_POST['Vans']['fecha_alta'])));
			if (!empty($_POST['Vans']['fecha_vencimiento'])) $model->fecha_vencimiento = implode('-', array_reverse(explode('/', $_POST['Vans']['fecha_vencimiento'])));
			if (!empty($_POST['Vans']['fecha_seguro'])) $model->fecha_seguro = implode('-', array_reverse(explode('/', $_POST['Vans']['fecha_seguro'])));
			if (!empty($_POST['Vans']['fecha_mantenimiento'])) $model->fecha_mantenimiento = implode('-', array_reverse(explode('/', $_POST['Vans']['fecha_mantenimiento'])));
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

	public function actionList(){
		$vans = Vans::model()->findAll(array('order'=>'id DESC'));
		$row = [];
		foreach ($vans as $k => $v) {
		    $row[] = $v;
		}
		echo $_GET['$callback'] . '({"row":' . CJSON::encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) . '"})';
	}

	public function actionGetVans(){
		$vans = Vans::model()->findAll(array('order'=>'id DESC'));
		$row = [];
		foreach ($vans as $k => $v) {
		    $row[] = $v;
		}
		echo CJSON::encode($row);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $session=new CHttpSession;
            $session->open();		
            $criteria = new CDbCriteria();            

                $model=new Vans('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Vans']))
		{
                        $model->attributes=$_GET['Vans'];
			
			
                   	
                       if (!empty($model->id)) $criteria->addCondition("id = '".$model->id."'");
                     
                    	
                       if (!empty($model->uuid)) $criteria->addCondition("uuid = '".$model->uuid."'");
                     
                    	
                       if (!empty($model->model)) $criteria->addCondition("model = '".$model->model."'");
                     
                    	
                       if (!empty($model->plates)) $criteria->addCondition("plates = '".$model->plates."'");
                     
                    	
                       if (!empty($model->max_passenger)) $criteria->addCondition("max_passenger = '".$model->max_passenger."'");
                     
                    	
                       if (!empty($model->created_at)) $criteria->addCondition("created_at = '".$model->created_at."'");
                     
                    	
                       if (!empty($model->updated_at)) $criteria->addCondition("updated_at = '".$model->updated_at."'");
                     
                    	
                       if (!empty($model->deleted_at)) $criteria->addCondition("deleted_at = '".$model->deleted_at."'");
                     
                    	
                       if (!empty($model->brand)) $criteria->addCondition("brand = '".$model->brand."'");
                     
                    	
                       if (!empty($model->seats_remove)) $criteria->addCondition("seats_remove = '".$model->seats_remove."'");
                     
                    			
                    $session['Vans_records']=Vans::model()->findAll($criteria); 
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
		$model=new Vans('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vans']))
			$model->attributes=$_GET['Vans'];

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
		$model=Vans::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='vans-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Vans_records']))
               {
                $model=$session['Vans_records'];
               }
               else
                 $model = Vans::model()->findAll();

		
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

             if(isset($session['Vans_records']))
               {
                $model=$session['Vans_records'];
               }
               else
                 $model = Vans::model()->findAll();



		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		//die($html);
		
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Vans Report');
		$pdf->SetSubject('Vans Report');
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
		$pdf->Output("Vans_002.pdf", "I");
	}

	public function actionValidarFechaVencimiento(){
		// if ($_SERVER['REMOTE_ADDR'] != '187.184.167.98')
			// throw new CHttpException(403, 'Access denied.');

		$hoy = date('Y-m-d');
		$semanadespues = date('Y-m-d', strtotime($hoy.'+7 days'));

		$alertaverfAmbiental = Vans::model()->findAll('fecha_vencimiento="'.$semanadespues.'"');
		$alertaseguros = Vans::model()->findAll('fecha_seguro="'.$semanadespues.'"');
		$alertamantenimientos = Vans::model()->findAll('fecha_mantenimiento="'.$semanadespues.'"');
		// echo 'fecha_vencimiento='.$semanadespues;
		// echo '<textarea>'.CJSON::encode($model).'</textarea>';
		$vansporcodigoverificacion = '';
		$vansporseguro = '';
		$vanspormantenimiento = '';
		$style='style="border: 1px solid #ccc;text-align: center;line-height: 1.8;font-size: 1em;"';
		foreach ($alertaverfAmbiental as $row) {
			$vansporcodigoverificacion .= '<tr>
				<td '.$style.'>' . $row->model . '</td>
				<td '.$style.'>' . $row->brand . '</td>
				<td '.$style.'>' . $row->plates . '</td>
				<td '.$style.'>' . $row->max_passenger . '</td>
				<td '.$style.'>' . $row->codigo_verificacion . '</td>
				<td '.$style.'>' . date('d/m/Y', strtotime($row->fecha_alta)) . '</td>
				<td '.$style.'>' . date('d/m/Y', strtotime($row->fecha_vencimiento)) . '</td>
			</tr>';
		}

		foreach ($alertaseguros as $row) {
			$vansporseguro .= '<tr>
				<td '.$style.'>' . $row->model . '</td>
				<td '.$style.'>' . $row->brand . '</td>
				<td '.$style.'>' . $row->plates . '</td>
				<td '.$style.'>' . $row->max_passenger . '</td>
				<td '.$style.'>' . date('d/m/Y', strtotime($row->fecha_alta)) . '</td>
				<td '.$style.'>' . date('d/m/Y', strtotime($row->fecha_seguro)) . '</td>
			</tr>';
		}

		foreach ($alertamantenimientos as $row) {
			$vanspormantenimiento .= '<tr>
				<td '.$style.'>' . $row->model . '</td>
				<td '.$style.'>' . $row->brand . '</td>
				<td '.$style.'>' . $row->plates . '</td>
				<td '.$style.'>' . $row->max_passenger . '</td>
				<td '.$style.'>' . date('d/m/Y', strtotime($row->fecha_alta)) . '</td>
				<td '.$style.'>' . date('d/m/Y', strtotime($row->fecha_mantenimiento)) . '</td>
			</tr>';
		}

		// echo $vansporcodigoverificacion.'---';
		// setlocale(LC_ALL,"es_ES");
		// $fecha_español = strftime("%A %d de %B del %Y", strtotime($semanadespues));
		// echo $fecha_español;
		$this->emailFechaVencimiento($vansporcodigoverificacion, $vansporseguro, $vanspormantenimiento, $semanadespues);
	}

	public function emailFechaVencimiento($vansAmbiental, $vansSeguro, $vansMantenimiento, $fecha) {
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		setlocale(LC_ALL,"es_ES");
		$encabezados  = "MIME-Version: 1.0\n";
		$encabezados .= "Content-type: text/html; charset=UTF-8\n";
		$encabezados .= "From:  Transfer Holbox <no-reply@transferholbox.com>\n";
		$encabezados .= "X-Sender: <contacto web>\n";
		$encabezados .= "X-Mailer: PHP\n";
		$encabezados .= "X-Priority: 3\n";
		$encabezados .= "Return-Path: <web page>\n";

		$style='style="border: 1px solid #ccc;text-align: center;line-height: 1.8;font-size: 1em;"';
		$fecha_español = strftime("%A %d de %B del %Y", strtotime($fecha));
		$p_ambiental = '';
		$p_seguro = '';
		$p_mantenimiento = '';

		if ($vansAmbiental != '') {
			$p_ambiental = "Estimado Enrique por este medio se le informa que la verificación ambiental de las siguientes camionetas vencen el día " . $fecha_español . ". Por lo cual le sugerimos tener en cuenta su renovación.";
		}

		if ($vansSeguro != '') {
			$p_seguro = "Estimado Enrique por este medio se le informa que el seguro de auto para las siguientes camionetas vencen el día " . $fecha_español . ". Por lo cual le sugerimos tener en cuenta su renovación.";
		}

		if ($vansMantenimiento != '') {
			$p_mantenimiento = "Estimado Enrique por este medio se le informa que las siguientes camionetas tendrán mantenimiento el día " . $fecha_español . ". Por lo cual le sugerimos tener en cuenta su visita con el servicio automotriz.";
		}
		

		$inicioTable = "
			<div align='center' style='font-family:helvetica'>
				<img src='https://" . $_SERVER['SERVER_NAME'] . "/images/logo_tranfer.png' style='width:15%;'><br>";

		$finTable = "
				</table>
				<p>Saludos Cordiales<br>Transfer Holbox.</p>
			</div>";

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

		if ($vansAmbiental != '') {
			$mail->ClearAddresses();
			$subject = "Aviso de Vencimiento de verificación ambiental";
			$tableBody ="
				<p>".$p_ambiental."</p>
				<table border='1' width='80%' style='border: 1px solid #ccc;margin-bottom: 1em;border-collapse: collapse;'>";
			$tableBody.= "<tr>
					<th ".$style.">Modelo</th>
					<th ".$style.">Marca</th>
					<th ".$style.">Placas</th>
					<th ".$style.">Max. pasajeros</th>
					<th ".$style.">Código verificación</th>
					<th ".$style.">Fecha alta</th>
					<th ".$style.">Fecha vencimiento</th>
				</tr>";
			$message = $inicioTable.$tableBody.$vansAmbiental.$finTable;
			
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			// $mail->AddAddress('enriqueram691@hotmail.com', 'Enrique');
			// $mail->AddAddress('enrique_rmzjr@hotmail.com', 'Enrique');
			// $mail->AddAddress('enriqueram691@gmail.com', 'Enrique');
			$mail->AddAddress('josecanulisc@gmail.com', $agency->name);
			// $mail->AddBCC('josecanulisc@gmail.com', 'Jose Canul Dzul');
			$mail->AddBCC('giovanyz@hotmail.com', 'Giovanny Zapata');
			$mail->Send();
		}

		if ($vansSeguro != '') {
			$mail->ClearAddresses();
			$subject = "¡Aviso! Vencimiento de seguros de autos";
			$tableBody ="
				<p>".$p_seguro."</p>
				<table border='1' width='80%' style='border: 1px solid #ccc;margin-bottom: 1em;border-collapse: collapse;'>";
			$tableBody.= "<tr>
					<th ".$style.">Modelo</th>
					<th ".$style.">Marca</th>
					<th ".$style.">Placas</th>
					<th ".$style.">Max. pasajeros</th>
					<th ".$style.">Fecha alta</th>
					<th ".$style.">Fecha vencimiento de Seguro</th>
				</tr>";
			$message = $inicioTable.$tableBody.$vansSeguro.$finTable;
			
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			// $mail->AddAddress('enriqueram691@hotmail.com', 'Enrique');
			// $mail->AddAddress('enrique_rmzjr@hotmail.com', 'Enrique');
			// $mail->AddAddress('enriqueram691@gmail.com', 'Enrique');
			$mail->AddAddress('josecanulisc@gmail.com', $agency->name);
			// $mail->AddBCC('josecanulisc@gmail.com', 'Jose Canul Dzul');
			$mail->AddBCC('giovanyz@hotmail.com', 'Giovanny Zapata');
			$mail->Send();
		}

		if ($vansMantenimiento != '') {
			$mail->ClearAddresses();
			$subject = "¡Aviso! Próximos mantenimientos a los siguientes vehículos";
			$tableBody = "
				<p>".$p_mantenimiento."</p>
				<table border='1' width='80%' style='border: 1px solid #ccc;margin-bottom: 1em;border-collapse: collapse;'>";
			$tableBody.= "<tr>
					<th ".$style.">Modelo</th>
					<th ".$style.">Marca</th>
					<th ".$style.">Placas</th>
					<th ".$style.">Max. pasajeros</th>
					<th ".$style.">Fecha alta</th>
					<th ".$style.">Próx. mantenimiento</th>
				</tr>";
			$message = $inicioTable.$tableBody.$vansMantenimiento.$finTable;
			
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
			// $mail->AddAddress('enriqueram691@hotmail.com', 'Enrique');
			// $mail->AddAddress('enrique_rmzjr@hotmail.com', 'Enrique');
			// $mail->AddAddress('enriqueram691@gmail.com', 'Enrique');
			$mail->AddAddress('josecanulisc@gmail.com', $agency->name);
			// $mail->AddBCC('josecanulisc@gmail.com', 'Jose Canul Dzul');
			$mail->AddBCC('giovanyz@hotmail.com', 'Giovanny Zapata');
			$mail->Send();
		}

	}
}
