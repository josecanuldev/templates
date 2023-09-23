<?php

class SitiosController extends Controller
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
				'actions'=>array('index','view','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GeneratePdf','GenerateExcel','getSitios','list'),
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
	// public function actionCreate()
	// {
	// 	$model=new Sitios;

	// 	// Uncomment the following line if AJAX validation is needed
	// 	// $this->performAjaxValidation($model);

	// 	if(isset($_POST['Sitios']))
	// 	{
	// 		$model->attributes=$_POST['Sitios'];
	// 		if($model->save())
	// 			$this->redirect(array('view','id'=>$model->id_sitio));
	// 	}

	// 	$this->render('create',array(
	// 		'model'=>$model,
	// 	));
	// }

	public function actionCreate()
	{
		$model=new Sitios;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$error = true;
		$sitio = 0;
		if(isset($_POST['Sitios']))
		{
			$model->attributes=$_POST['Sitios'];
			$model->descripcion = $_POST['Sitios']['descripcion'];
			$model->id_arrivals = $_POST['Sitios']['id_arrivals'];
			if($model->save()){
				$sitio = $model->sitio;
				$error = false;
				// $this->redirect(array('view','id'=>$model->idorden));
			} else {
				echo CJSON::encode($model->getErrors());
			}
		}

		echo CJSON::encode(array('error' => $error,'sitio'=>$sitio));
		// $this->render('create',array(
		// 	'model'=>$model,
		// ));
	}

	public function actiongetSitios(){
		$sitios = Sitios::model()->findAll('estatus=1');
		$row = array();
		foreach ($sitios as $key => $val) {
		    $row[$key]['id_sitio'] = $val->id_sitio;
		    $row[$key]['sitio'] = $val->sitio;
		    $row[$key]['id_arrivals'] = $val->id_arrivals;
		}
		echo CJSON::encode($row);
	}

	public function actionList(){
		$sitios = Sitios::model()->findAll(array('order'=>'id_arrivals DESC'));
		$row = [];
		foreach ($sitios as $k => $v) {
			$destino = Arrivals::model()->findByPk($v->id_arrivals)->name;
		    $row[$k]['id_sitio'] = $v->id_sitio;
		    $row[$k]['id_arrivals'] = $v->id_arrivals;
		    $row[$k]['sitio'] = $v->sitio;
		    $row[$k]['destino'] = $destino;
		    $row[$k]['descripcion'] = $v->descripcion;
		    $row[$k]['estatus'] = $v->estatus;
		}
		echo $_GET['$callback'] . '({"row":' . CJSON::encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) . '"})';
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
		if(isset($_POST['Sitios']))
		{
			$model->attributes=$_POST['Sitios'];
			$model->descripcion = $_POST['Sitios']['descripcion'];
			$model->id_arrivals = $_POST['Sitios']['id_arrivals'];
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
        $this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Sitios('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Sitios']))
			$model->attributes=$_GET['Sitios'];

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
		$model=Sitios::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='sitios-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Sitios_records']))
               {
                $model=$session['Sitios_records'];
               }
               else
                 $model = Sitios::model()->findAll();

		
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

             if(isset($session['Sitios_records']))
               {
                $model=$session['Sitios_records'];
               }
               else
                 $model = Sitios::model()->findAll();



		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		//die($html);
		
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Sitios Report');
		$pdf->SetSubject('Sitios Report');
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
		$pdf->Output("Sitios_002.pdf", "I");
	}
}
