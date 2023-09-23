<?php

class ReservatourController extends Controller
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
				'actions'=>array('create','update','GeneratePdf','GenerateExcel','getReservaforupdate'),
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Reservatour']))
		{
			$error = array(); $ids = array();
			$formatosController = Yii::app()->createController('formatos')[0];
			foreach ($_POST['Rutas'] as $k => $ruta) {

				$model=new Reservatour;
				$respuesta = $this->guardarReservacion($model, $ruta, $k);
				if($respuesta['error'] == 0){
					$model = $respuesta['model'];
					// descomentar despues de 1 mes
					$formatosController->actionCupon($model->idreserva, 1);
					array_push($ids, $model->idreserva);
				} else {
					array_push($error, $respuesta['model']);
				}
				// code...
			}

			echo CJSON::encode(array('error'=>$error,'ids'=>$ids));
		}
	}

	public function guardarReservacion($model, $ruta, $i){

		$isWeb = true;
		if ((!empty($_POST['Reservatour']['id_arrivals_to']) && !empty($_POST['Reservatour']['id_arrivals_from'])) || ((int) $_POST['Reservatour']['id_arrivals_to'] > 0 && (int) $_POST['Reservatour']['id_arrivals_from'] > 0)) {
			$isWeb = false;
	    }
	    if ((int) $_POST['Reservatour']['manual'] == 1) {
	    	$isWeb = false;
	    }
	    // exit;
	    if ($isWeb) unset($_POST['Reservatour']['fechaReservacion']);

		$model->attributes=$_POST['Reservatour'];
		$model->attributes=$ruta;
		$model->idreserva = ((int) $_POST['Reservatour']['idreserva']) + $i;
		$model->manual = $_POST['Reservatour']['manual'];

		$model->pasajeros = (int) $_POST['ReservatourDesglose']['adultos'] +  (int) $_POST['ReservatourDesglose']['menores'];

		$idFromName = Arrivals::model()->findByPk($ruta["id_arrivals_from"]);
		$idToName = Arrivals::model()->findByPk($ruta["id_arrivals_to"]);

	    if (!$isWeb) {
	    	$model->idExperiencia = 79;
	    	$model->desde = $idFromName->name;
	    }

		if (($ruta["id_arrivals_from"] == 1 && $ruta["id_arrivals_to"] == 2 || $ruta["id_arrivals_from"] == 2 && $ruta["id_arrivals_to"] == 1) && $model->tipoPrivadoEstandar == 'colectivo') {
			$model->concepto = 'Transporte 35 USD';
			$model->conceptoEn = '35 USD Transportation';
		}

		if (($ruta["id_arrivals_to"] == 2 || $ruta["id_arrivals_from"] == 2) && $model->tipoPrivadoEstandar == 'premium') {
			$model->concepto = 'Transporte privado';
			$model->conceptoEn = 'Private transport';
			$model->tipoPrivadoEstandar = 'estandar';
			if ($ruta["id_arrivals_from"] == 1) {
				$model->datePrivada = $model->fechaLLegada;
				$model->horaPrivada = $model->horarioLLegada;
			}
		}

		if ($ruta["id_arrivals_from"] == 2 && $ruta["tipoViaje"] == "Sencillo") {
			$model->inverso = "true";
		}

		if (($ruta["id_arrivals_to"] == 3 || $ruta["id_arrivals_from"] == 3) && $model->tipoPrivadoEstandar == 'premium') {
			$model->concepto = 'Transporte privado';
			$model->conceptoEn = 'Private transport';
			$model->tipoPrivadoEstandar = 'premium';
			if ($ruta["id_arrivals_from"] == 1) {
				$model->datePrivada = $ruta["fechaLLegada"];
				$model->horaPrivada = $ruta["horarioLLegada"];
			}
		}

		if ($ruta["id_arrivals_from"] == 3 && $ruta["tipoViaje"] == "Sencillo") {
			$model->inverso = "true";
		}

		if ($ruta["tipoViaje"] == 'Sencillo' && $ruta["id_arrivals_from"] == 1) {
			$model->fechaSalida = "";
			$model->horarioSalida = "";
			$model->horarioPickup = "";
		} else if ($ruta["tipoViaje"] == 'Sencillo' && $ruta["id_arrivals_to"] == 1) {
			$model->fechaLLegada = "";
			$model->horarioLLegada = "";
		} else if($ruta["tipoViaje"] == 'Sencillo'){
			$model->fechaSalida = "";
			$model->horarioSalida = "";
			$model->horarioPickup = "";
		}

		// echo "<textarea>".CJSON::encode($model)."</textarea>"; exit; 
		if (!$isWeb) $model->fechaReservacion = date('Y-m-d H:i:s');
		if (!empty($model->fechaSalida)) {
			$model->fechaSalida = implode('-', array_reverse(explode('/', $ruta["fechaSalida"])));
			$model->horarioPickup = $ruta["horarioPickup"];
		}
		if (!empty($model->fechaLLegada)) {
			$model->fechaLLegada = implode('-', array_reverse(explode('/', $ruta["fechaLLegada"])));
		}
		if (!empty($model->datePrivada)) {
			$model->datePrivada = implode('-', array_reverse(explode('/', $model->datePrivada)));
		}

		if ($model->save()) {

			if ($_POST['ReservatourDesglose']["id_reservatour_desglose"] != 0) {
				$desglose = ReservatourDesglose::model()->findByPk($_POST['ReservatourDesglose']["id_reservatour_desglose"]);
			} else {
				$desglose = new ReservatourDesglose;
			}
			$desglose->attributes = $_POST['ReservatourDesglose'];
			$desglose->idreserva = $model->idreserva;
			if(!$desglose->save()){
				// echo CJSON::encode($desglose->getErrors());
			}

			$modelHoteles = ReservatourCircuito::model()->findAll("idreserva=".$model->idreserva);
			foreach ($modelHoteles as $value) {
			  $value->delete();
			}

			if ($_POST['ReservatourCircuito']) {
				$hoteles = $_POST['ReservatourCircuito'];
				foreach ($hoteles as $value) {
					if (!empty($value['hotel'])) {						
						$modelHoteles = new ReservatourCircuito;
						$modelHoteles->attributes = $value;
						$modelHoteles->idreserva = $model->idreserva;
						$modelHoteles->fechaServicio = implode('-', array_reverse(explode('/', $value['fechaServicio'])));
						$modelHoteles->horarioServicio = $value['horarioServicio'];
						if(!$modelHoteles->save()){
							// echo CJSON::encode($desglose->getErrors());
						}
					}
				}
			}

			// jccd 16/10/2022
			$modelOtrasCategorias = Otrascategoriasreservas::model()->findAll("idreserva=".$model->idreserva);
			foreach ($modelOtrasCategorias as $vCat) { $vCat->delete(); }

			if ($ruta['Otrascategoriasreservas']) {
				$otrascategorias = $ruta['Otrascategoriasreservas'];
				foreach ($otrascategorias as $cat) {
					$otracategoria = new Otrascategoriasreservas;
					$otracategoria->id_otrascategorias = $cat;
					$otracategoria->idreserva = $model->idreserva;
					$otracategoria->save();
				}
			}
			// jccd end

			return array('model' => $model, 'error' => 0);
		} else {
			return array('model' => $model->getErrors(), 'error' => 1);
			// print_r($model->getErrors());
		}


	}

	public function actiongetReservaforupdate(){
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			
			$data = array();
			// $reservas = array();
			$fechaReservacion = "";
			$addCondition = "";
			$exist = false;
			if (isset($_POST['id'])) {
			 	if (!empty($_POST['id'])) {
					$addCondition = " idreserva='".$_POST['id']."' ";
					$exist = true;
			 	} 
			}

			$exist2 = false;
			if (isset($_POST['fechaReservacion'])) {
			 	if (!empty($_POST['fechaReservacion'])) {
			 	 	// code...
					$fechaReservacion = implode('-', array_reverse(explode('/', $_POST['fechaReservacion'])));
					$addCondition.= $exist ? " AND " : "";
					$addCondition.= " (fechaLLegada='".$fechaReservacion."' OR fechaSalida='".$fechaReservacion."') ";
					$exist2 = true;
			 	} 
			} 

			$exist3 = false;
			if (isset($_POST['referencia'])) {
			 	if (!empty($_POST['referencia'])) {
					$addCondition.= $exist || $exist2 ? " AND " : "";
					$addCondition.= " referencia='".$_POST['referencia']."' ";
					$exist3 = true;
			 	} 
			} 

			$exist4 = false;
			if (isset($_POST['nombre'])) {
			 	if (!empty($_POST['nombre'])) {
					$addCondition.= $exist || $exist2 || $exist4 ? " AND " : "";
					$addCondition.= " nombre LIKE '%".$_POST['nombre']."%' ";
					$exist4 = true;
			 	} 
			}

			if(!$exist && !$exist2 && !$exist3 && !$exist4) {
				$addCondition = array('condition' => " fechaReservacion >= '".date('Y-m-d')."'", 'limit' => 10);
			}
			// echo $addCondition; exit;
			$reserva = Reservatour::model()->findAll($addCondition);
			if (!empty($reserva)) {
				foreach ($reserva as $key => $value) {
					$model = array();
					// code...
					$desglose = ReservatourDesglose::model()->find('idreserva='.$value->idreserva);
					$circuitos = ReservatourCircuito::model()->findAll('idreserva='.$value->idreserva);
					$ordenreserva = Ordenreserva::model()->findAll(array('condition'=>'idreserva="'.$value->idreserva.'"', 'order'=>'idorden DESC'));
					if (($value->referencia == NULL || empty($value->referencia)) && ($value->id_arrivals_from == NULL || $value->id_arrivals_from == 0) && ($value->id_arrivals_to == NULL || $value->id_arrivals_to == 0)) {
						$value->referencia = $this->getReferenceBook($value->tipoPrivadoEstandar);
						// $value->referencia.= $value->idreserva;
						$value->referencia.= (count($ordenreserva) > 0 ? '-' . sprintf('%04d', $ordenreserva[0]->idorden) : '');
						if($value->manual == 0) {
							$id_arrivals = 0;
							if($value->tipoPrivadoEstandar=="estandar"){
								$id_arrivals = 2;
							}else if($value->tipoPrivadoEstandar=="premium"){
								$id_arrivals = 19;
							}else{
								$id_arrivals = 2;
							}
							
							if ($ordenreserva[0]->tipo == 2) {
								$consultaExperiencia = Experiencia::model()->find('idExperiencia = "'.$value->idExperiencia.'"');
								
								if($value->inverso == "true" && $consultaExperiencia != null){
									$value->id_arrivals_from = $id_arrivals;
									$value->id_arrivals_to = $consultaExperiencia->id_arrivals;
								} else if ($consultaExperiencia != null) {
									$value->id_arrivals_from = $consultaExperiencia->id_arrivals;
									$value->id_arrivals_to = $id_arrivals;
								}
							} else {
								if ($value->desde == 'Aeropuerto CancÃºn' || $value->desde == 'Aeropuerto Cancún') {
									$value->id_arrivals_from = 1;
									$value->id_arrivals_to = 2;
								} else {
									$value->id_arrivals_from = 2;
									$value->id_arrivals_to = 1;
								}
							}
						}
					}
					if ($value->manual == '0') {
						if ((int) $value->id_arrivals_from == 1 && $value->vueloLlegada == NULL && $value->aerolineaLlegada == NULL) {
						    $value->vueloLlegada = $value->aerolinea;
						    $value->aerolineaLlegada = $value->numeroVuelo;
				    	}

				    	if ($value->horaPrivada != NULL && $value->tipoViaje == 'Redondo') {
				    		$value->horarioPickup = $value->horaPrivada;
				    	}
					}

					$model["model"] = $value;
					$model["desglose"] = $desglose;
					$model["orders"] = count($ordenreserva) > 0 ? $ordenreserva : null;
					$model["circuitos"] = $circuitos ? $circuitos : null;

					// jccd 16/10/2022
					$model["Otrascategoriasreservas"] = array();
					$otrascategoriasreservas = Otrascategoriasreservas::model()->findAll('idreserva='.$value->idreserva);
					foreach ($otrascategoriasreservas as $kCats => $vCats) {
						array_push($model["Otrascategoriasreservas"], $vCats->id_otrascategorias);
					}
					// jccd end
					array_push($data, $model);
				}
			}

			echo CJSON::encode($data);
		}
	}

	public function getReferenceBook($tipo = NULL){
		$ref = '';
		switch ($tipo) {
			case 'premium':
				$ref = 'Privpre';
				break;
			case 'estandar':
				$ref = 'Privstan';
				break;
			default:
				$ref = 'Shut';
				break;
		}
		return $ref;
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		if(isset($_POST['Reservatour']))
		{
			$error = array(); $ids = array();
			foreach ($_POST['Rutas'] as $k => $ruta) {
				$model=$this->loadModel($id);

				$respuesta = $this->guardarReservacion($model, $ruta, $k);

				if($respuesta['error'] == 0){
					$model = $respuesta['model'];

					$ordenesPago = Ordenreserva::model()->findAll('idreserva='.$model->idreserva);
					$status = 0;
					switch ($model->estatus) {
				    	case "P":
				    	case "A":
				    		$status = 2;
				    		break;
				    	case "PA":
				    		$status = 3;
				    		break;
				    	case "C":
				    		$status = 1;
				    		break;
				    	default:
				    		$status = 0;
				    		// code...
				    		break;
				    }
					foreach ($ordenesPago as $key => $val) {
						$val->status = $status;
						$val->save();
					}
					array_push($ids, $model->idreserva);
				} else {
					array_push($error, $respuesta['model']);
				}
				// code...
			}

			echo CJSON::encode(array('error'=>$error,'ids'=>$ids));

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
	public function actionIndex()
	{

		$siteController = Yii::app()->createController('site')[0];
		$mes = date('n');
		$traslateMonth = $siteController->traslateMonth($mes);
		$date = date('d').'-'.$traslateMonth.'-'.date('Y');
       
		$reserva = Reservatour::model()->find(array('order'=>'idreserva DESC'));
		$lastInsertID = $reserva->idreserva + 1;
        $this->render('index',array(
        	'lastInsertID' => $lastInsertID,
			'model' => $model,
			'date' => $date
		));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Reservatour('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reservatour']))
			$model->attributes=$_GET['Reservatour'];

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
		$model=Reservatour::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='reservatour-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Reservatour_records']))
               {
                $model=$session['Reservatour_records'];
               }
               else
                 $model = Reservatour::model()->findAll();

		
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

             if(isset($session['Reservatour_records']))
               {
                $model=$session['Reservatour_records'];
               }
               else
                 $model = Reservatour::model()->findAll();



		$html = $this->renderPartial('expenseGridtoReport', array(
			'model'=>$model
		), true);
		
		//die($html);
		
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(Yii::app()->name);
		$pdf->SetTitle('Reservatour Report');
		$pdf->SetSubject('Reservatour Report');
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
		$pdf->Output("Reservatour_002.pdf", "I");
	}
}
