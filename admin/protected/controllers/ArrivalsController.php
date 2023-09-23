<?php

class ArrivalsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column1';
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
				'actions'=>array('index','view', 'delete'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GeneratePdf','GenerateExcel','simple','vip','getSimpleArrivals','getVipArrivals','getArrivals','getArrivalSitios','radar','list'),
				'users'=>array('@'),
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


	public function actionSimple(){
		$siteController = Yii::app()->createController('site')[0];
		$mes = date('n');
		$traslateMonth = $siteController->traslateMonth($mes);
		$date = date('Y').'-'.$traslateMonth.'-'.date('d');
		$this->render('simple-arrivals', array('date'=>$date));
	}

	public function actionVip(){
		$siteController = Yii::app()->createController('site')[0];
		$mes = date('n');
		$traslateMonth = $siteController->traslateMonth($mes);
		$date = date('Y').'-'.$traslateMonth.'-'.date('d');
		$this->render('vip-arrivals', array('date'=>$date));
	}

	public function traslateMonth($numero){
		$fecha = DateTime::createFromFormat('!m', $numero);
		$mes = strftime("%B", $fecha->getTimestamp()); // marzo

		return strtoupper($mes);
	}

	public function actionGetSimpleArrivals(){
		$row[0]['operador'] = "";
		$row[0]['date'] = "2022-02-26";
		$row[0]['pickup'] = "2022-06-25";
		$row[0]['origen'] = "Aeropuerto";
		$row[0]['destino'] = "Holbox";
		$row[0]['agencia'] = "TransferHolbox";
		$row[0]['nombre'] = "Prueba";
		$row[0]['pax'] = 4;
		$row[0]['observaciones'] = "";
		echo $_GET['$callback'] . '({"row":' . json_encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) . '"})';
	}

	public function actionGetVipArrivals(){
		$row[0]['operador'] = "";
		$row[0]['date'] = "2022-02-26";
		$row[0]['pickup'] = "2022-06-25";
		$row[0]['origen'] = "Holbox";
		$row[0]['destino'] = "Aeropuerto";
		$row[0]['agencia'] = "TransferHolbox";
		$row[0]['nombre'] = "Prueba";
		$row[0]['pax'] = 4;
		$row[0]['observaciones'] = "";
		echo $_GET['$callback'] . '({"row":' . json_encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) . '"})';
	}

	public function actiongetArrivals(){
		$arrivals = Arrivals::model()->findAll('estatus=1');
		$row = array();
		foreach ($arrivals as $key => $val) {
		    $row[$key]['id'] = $val->id;
		    $row[$key]['name'] = $val->name;
		}
		echo CJSON::encode($row);
	}

	public function actiongetArrivalSitios(){
		$condition = '';
		if (isset($_POST['id'])) {
			$condition = "id_arrivals = ".$_POST['id'];
		}
		$sitios = Sitios::model()->findAll($condition);
		echo CJSON::encode($sitios);
	}

	public function actionradar(){
		$this->render('radar');
	}

	public function actionList(){
		$arrivals = Arrivals::model()->findAll(array('order'=>'id DESC'));
		$row = [];
		foreach ($arrivals as $k => $v) {
		    $row[] = $v;
		}
		echo $_GET['$callback'] . '({"row":' . CJSON::encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) . '"})';
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
		$model=new Arrivals;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$error = true;
		$id = 0;
		if(isset($_POST['Arrivals']))
		{
			$siteController = Yii::app()->createController('site')[0];
			$uuid = $siteController->guidv4();
			$model->attributes=$_POST['Arrivals'];
			$model->uuid = $uuid;
			if($model->save()){
				$id = $model->id;
				$error = false;
				// $this->redirect(array('view','id'=>$model->idorden));
			} else {
				echo CJSON::encode($model->getErrors());
			}
		}

		echo CJSON::encode(array('error' => $error,'id'=>$id));
		// $this->render('create',array(
		// 	'model'=>$model,
		// ));
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
		if(isset($_POST['Arrivals']))
		{
			$model->attributes=$_POST['Arrivals'];
			$model->updated_at = date('Y-m-d H:i:s');
			$model->codigo = $_POST['Arrivals']['codigo'];
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $session=new CHttpSession;
            $session->open();		
            $criteria = new CDbCriteria();            

                $model=new Ordenreserva('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Ordenreserva']))
		{
                        $model->attributes=$_GET['Ordenreserva'];
			
			
                   	
                       if (!empty($model->idorden)) $criteria->addCondition("idorden = '".$model->idorden."'");
                     
                    	
                       if (!empty($model->idreserva)) $criteria->addCondition("idreserva = '".$model->idreserva."'");
                     
                    	
                       if (!empty($model->subtotal)) $criteria->addCondition("subtotal = '".$model->subtotal."'");
                     
                    	
                       if (!empty($model->total)) $criteria->addCondition("total = '".$model->total."'");
                     
                    	
                       if (!empty($model->status)) $criteria->addCondition("status = '".$model->status."'");
                     
                    	
                       if (!empty($model->tipo)) $criteria->addCondition("tipo = '".$model->tipo."'");
                     
                    	
                       if (!empty($model->descuento)) $criteria->addCondition("descuento = '".$model->descuento."'");
                     
                    	
                       if (!empty($model->idCodigoPromo)) $criteria->addCondition("idCodigoPromo = '".$model->idCodigoPromo."'");
                     
                    			
                    $session['Ordenreserva_records']=Ordenreserva::model()->findAll($criteria); 
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
		$model=new Ordenreserva('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ordenreserva']))
			$model->attributes=$_GET['Ordenreserva'];

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
		$model=Arrivals::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ordenreserva-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Ordenreserva_records']))
               {
                $model=$session['Ordenreserva_records'];
               }
               else
                 $model = Ordenreserva::model()->findAll();

		
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

             if(isset($session['Ordenreserva_records']))
               {
                $model=$session['Ordenreserva_records'];
               }
               else
                 $model = Ordenreserva::model()->findAll();



		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		//die($html);
		
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Ordenreserva Report');
		$pdf->SetSubject('Ordenreserva Report');
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
		$pdf->Output("Ordenreserva_002.pdf", "I");
	}
}
