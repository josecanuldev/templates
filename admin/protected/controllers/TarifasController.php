<?php

class TarifasController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','GeneratePdf','GenerateExcel','ListaTarifas','FormRutas','upload', 'GaleriaCollector', 'EliminarFoto', 'EliminarTarifa', 'UploadCK'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new Tarifas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tarifas']))
		{
			$model->attributes=$_POST['Tarifas'];
			$model->fecha_final = date('Y-m-d 23:59:59', $_POST['Tarifas']['fecha_final']);
			if($model->save()) {
				$categorias = Categoriasdestinos::model()->findAll();
				// echo '<textarea>'.CJSON::encode($model).'</textarea>';
				foreach ($categorias as $key => $categoria) {
					if (isset($_POST['TarifasDesglose_'.$categoria->id_categoria])) {
						$cont_categoria = count($_POST['TarifasDesglose_'.$categoria->id_categoria]['precio_publico']);
						// echo $cont_categoria;
						// echo '<textarea>'.CJSON::encode($_POST['TarifasDesglose_'.$categoria->id_categoria]['precio_publico']).'</textarea>';
						for ($c=0; $c < $cont_categoria; $c++) {
							if ((float) $_POST['TarifasDesglose_'.$categoria->id_categoria]['precio_publico'][$c] > 0) {
								$catModel = new TarifasDesglose;
								$catModel->id_tarifa = $model->id_tarifa;
								$catModel->id_categoria = $categoria->id_categoria;
								$catModel->min_pax = $_POST['TarifasDesglose_'.$categoria->id_categoria]['min_pax'][$c];
								$catModel->max_pax = $_POST['TarifasDesglose_'.$categoria->id_categoria]['max_pax'][$c];
								$catModel->precio_publico = $_POST['TarifasDesglose_'.$categoria->id_categoria]['precio_publico'][$c];
								if (!$catModel->save()) {
									// echo '<textarea>'.CJSON::encode($catModel->getErrors()).'</textarea>';
								}
							}
						}
					}
				}
				// $this->redirect(array('view','id'=>$model->id_tarifa));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Tarifas']))
		{
			$model->attributes=$_POST['Tarifas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_tarifa));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	// Upload Fotos
	public function actionUpload() {
		$model = new GaleriaCollector;
		$model->id = $_POST['idTarifa'];
		// echo json_encode($_FILES); exit;
		if (is_uploaded_file($_FILES['file']['tmp_name'])) {
			$fileName = $_FILES['file']['name'];
			$model->titulo = $fileName;
			$model->path = '/img/imgTarifario/' . date('Ymd') . '_' . $model->id . '_' . $fileName;
			$model->ubicacion = 'Tarifas';
			// echo CJSON::encode($model); exit;
			if ($model->save()) {
				$dir_model = date('Ymd') . '_' . $model->id . '_' . $fileName;
				$documentRoot = str_replace('admin', 'public_html', $_SERVER['DOCUMENT_ROOT']);
				$dir = $documentRoot . '/img/imgTarifario/' . $dir_model;
				if (!move_uploaded_file($_FILES['file']['tmp_name'], $dir)) {
					// echo "Fallo al subir archivo!";
					echo json_encode(array('success' => 0));
					// $this->redirect(array('index', 'id' => $model->id));
				} else {
					echo json_encode(array('success' => 1));
					// $this->redirect(array('index', 'id' => $model->id));
				}
			}
		}
	}
	public function actionGaleriaCollector() {
		$idTarifa = isset($_POST['idTarifa']) ? $_POST['idTarifa'] : 0;
		$fotos = GaleriaCollector::model()->findAll(array('condition'=>'id="'.$idTarifa.'"', 'order'=>'t.log DESC'));
		// echo '<textarea>'.CJSON::encode($fotos).'</textarea>';
		$this->renderPartial('_listaFotos', array('fotos' => $fotos));
	}
	public function actionEliminarFoto() {
		if(Yii::app()->request->isPostRequest) {
			$idFoto = (int)$_POST['idFoto'] > 0 ? $_POST["idFoto"] : 0;
			$foto = GaleriaCollector::model()->findByPk($idFoto);
			if ($foto->delete()) {
				echo CJSON::encode(array('success' => 1));
			} else {
				echo CJSON::encode(array('success' => 0, 'mensaje' => $foto->getErrors()));
			}
		}
	}

	public function actionEliminarTarifa() {
		if(Yii::app()->request->isPostRequest)  {
			$idTarifa = (int)$_POST['idTarifa'] > 0 ? $_POST["idTarifa"] : 0;
			$tarifa = Tarifas::model()->findByPk($idTarifa);
			if ($tarifa->delete()) {
				echo CJSON::encode(array('success' => 1));
			} else {
				echo CJSON::encode(array('success' => 0));
			}
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id = -1)
	{
		if ($id != -1) {
			$model=$this->loadModel($id);
		} else {
			$model=new Tarifas;
		}
		// echo '<textarea>'.CJSON::encode($model).'</textarea>';
			// echo "string"; exit;
		// $tarifas = Tarifas::model()->findAll(array('order'=>'last_updated DESC'));
		$categorias = Categoriasdestinos::model()->findAll('estatus=1');
		$rutas = Rutas::model()->findAll();
		$destinos = Arrivals::model()->findAll(array('condition' => 'estatus=1', 'order'=>'name ASC'));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tarifas']))
		{
			// echo '<textarea>'.CJSON::encode($_POST).'</textarea>'; exit;
			$model->attributes=$_POST['Tarifas'];
			$model->fecha_final = date('Y-m-d 23:59:59', strtotime($_POST['Tarifas']['fecha_final']));
			if($model->save()) {
				$categorias = Categoriasdestinos::model()->findAll();
				// echo '<textarea>'.CJSON::encode($model).'</textarea>';
				// Eliminar los registrados para generarlos de nuevo
				$auxCategorias = TarifasDesglose::model()->findAll('id_tarifa='.$model->id_tarifa);
				if (count($auxCategorias) > 0) {
					foreach ($auxCategorias as $key => $categoria) {
						$categoria->delete();
					}
				}
				// End eliminar
				foreach ($categorias as $key => $categoria) {
					if (isset($_POST['TarifasDesglose_'.$categoria->id_categoria])) {
						$cont_categoria = count($_POST['TarifasDesglose_'.$categoria->id_categoria]['precio_publico']);
						// echo $cont_categoria;
						// echo '<textarea>'.CJSON::encode($_POST['TarifasDesglose_'.$categoria->id_categoria]['precio_publico']).'</textarea>';
						for ($c=0; $c < $cont_categoria; $c++) {
							if ((float) $_POST['TarifasDesglose_'.$categoria->id_categoria]['precio_publico'][$c] > 0) {
								$min_pax = $_POST['TarifasDesglose_'.$categoria->id_categoria]['min_pax'][$c];
								$max_pax = $_POST['TarifasDesglose_'.$categoria->id_categoria]['max_pax'][$c];
								$precio_publico = $_POST['TarifasDesglose_'.$categoria->id_categoria]['precio_publico'][$c];
								$tarifaDesglose = TarifasDesglose::model()->find('id_tarifa='.$model->id_tarifa.' AND id_categoria='.$categoria->id_categoria.' AND min_pax='.$min_pax.' AND max_pax='.$max_pax);
								if(empty($tarifaDesglose)) $tarifaDesglose = new TarifasDesglose;
								$tarifaDesglose->id_tarifa = $model->id_tarifa;
								$tarifaDesglose->id_categoria = $categoria->id_categoria;
								$tarifaDesglose->min_pax = $min_pax;
								$tarifaDesglose->max_pax = $max_pax;
								$tarifaDesglose->precio_publico = $precio_publico;
								if (!$tarifaDesglose->save()) {
									// echo '<textarea>'.CJSON::encode($catModel->getErrors()).'</textarea>';
								}
							}
						}
					}
				}
				$this->redirect(array('index','id'=>$model->id_tarifa));
			}
		}

		$this->render('index',array(
			'model'=>$model,
			'categorias' => $categorias,
			'rutas' => $rutas,
			'destinos' => $destinos
		));
	}
	public function actionListaTarifas() {
		$id = -1;
		$name = '';
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
		}
		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		}
		$condition = '';
		if ($name != '') {
			$condition = 't.nombre_tarifa LIKE "%'.$name.'%" OR Origen.name LIKE "%'.$name.'%" OR Destino.name LIKE "%'.$name.'%" OR idTipoViaje.viaje LIKE"%'.$name.'%"';
		}
		$tarifas = Tarifas::model()->with(array('idRuta.Origen', 'idRuta.Destino', 'idTipoViaje', ))->findAll(array('condition'=>$condition, 'order'=>'t.last_updated DESC'));
		// echo '<textarea>'.CJSON::encode($tarifas).'</textarea>';
		$this->renderPartial('listaTarifas', array('tarifas' => $tarifas, 'id' => $id));
	}
	public function actionFormRutas() {
		$id_ruta = $_POST['id_ruta'];
		$rutas = Rutas::model()->findAll();
		$this->renderPartial('_formSelectRutas', array('id_ruta' => $id_ruta, 'rutas' => $rutas));
	}
	public function actionIndexV1()
	{
            $session=new CHttpSession;
            $session->open();		
            $criteria = new CDbCriteria();            

                $model=new Tarifas('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Tarifas']))
		{
                        $model->attributes=$_GET['Tarifas'];
			
			
                   	
                       if (!empty($model->id_tarifa)) $criteria->addCondition("id_tarifa = '".$model->id_tarifa."'");
                     
                    	
                       if (!empty($model->id_ruta)) $criteria->addCondition("id_ruta = '".$model->id_ruta."'");
                     
                    	
                       if (!empty($model->id_tipo_tarifa)) $criteria->addCondition("id_tipo_tarifa = '".$model->id_tipo_tarifa."'");
                     
                    	
                       if (!empty($model->nombre_tarifa)) $criteria->addCondition("nombre_tarifa = '".$model->nombre_tarifa."'");
                     
                    	
                       if (!empty($model->codigo)) $criteria->addCondition("codigo = '".$model->codigo."'");
                     
                    	
                       if (!empty($model->fecha_inicio)) $criteria->addCondition("fecha_inicio = '".$model->fecha_inicio."'");
                     
                    	
                       if (!empty($model->fecha_final)) $criteria->addCondition("fecha_final = '".$model->fecha_final."'");
                     
                    	
                       if (!empty($model->moneda)) $criteria->addCondition("moneda = '".$model->moneda."'");
                     
                    	
                       if (!empty($model->tipo_cambio)) $criteria->addCondition("tipo_cambio = '".$model->tipo_cambio."'");
                     
                    	
                       if (!empty($model->estatus)) $criteria->addCondition("estatus = '".$model->estatus."'");
                     
                    	
                       if (!empty($model->no_reembosable)) $criteria->addCondition("no_reembosable = '".$model->no_reembosable."'");
                     
                    	
                       if (!empty($model->restricciones)) $criteria->addCondition("restricciones = '".$model->restricciones."'");
                     
                    	
                       if (!empty($model->terminoscondiciones)) $criteria->addCondition("terminoscondiciones = '".$model->terminoscondiciones."'");
                     
                    	
                       if (!empty($model->politicas_cancelacion)) $criteria->addCondition("politicas_cancelacion = '".$model->politicas_cancelacion."'");
                     
                    	
                       if (!empty($model->id_tipoviaje)) $criteria->addCondition("id_tipoviaje = '".$model->id_tipoviaje."'");
                     
                    	
                       if (!empty($model->last_updated)) $criteria->addCondition("last_updated = '".$model->last_updated."'");
                     
                    			
                    $session['Tarifas_records']=Tarifas::model()->findAll($criteria); 
		}
       

                $this->render('index',array(
			'model'=>$model,
		));

	}

	public function actionUploadCK() {
		if (is_uploaded_file($_FILES['upload']['tmp_name'])) {
			$fileName = $_FILES['upload']['name'];
			$path = '/img/imgTarifario/' . date('Ymd') . '_' . $fileName;
			$documentRoot = str_replace('admin', 'public_html', $_SERVER['DOCUMENT_ROOT']);
			$host = str_replace('admin.', '', $_SERVER['HTTP_HOST']);
			$dir = $documentRoot . $path;
			if (!move_uploaded_file($_FILES['upload']['tmp_name'], $dir)) {
				// echo "Fallo al subir archivo!";
				echo json_encode(array('url' => ''));
			} else {
				echo json_encode(array('url' => 'https://'.$host.$path));
			}
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tarifas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tarifas']))
			$model->attributes=$_GET['Tarifas'];

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
		$model=Tarifas::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tarifas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Tarifas_records']))
               {
                $model=$session['Tarifas_records'];
               }
               else
                 $model = Tarifas::model()->findAll();

		
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

             if(isset($session['Tarifas_records']))
               {
                $model=$session['Tarifas_records'];
               }
               else
                 $model = Tarifas::model()->findAll();



		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		//die($html);
		
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Tarifas Report');
		$pdf->SetSubject('Tarifas Report');
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
		$pdf->Output("Tarifas_002.pdf", "I");
	}
}
