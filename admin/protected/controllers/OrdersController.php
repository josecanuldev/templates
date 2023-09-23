<?php
error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL & ~E_NOTICE);

Yii::import('application.extensions.phpmailer.JPhpMailer');
Yii::import('application.extensions.bootstrap.gii.*');
require_once('bootstrap/tcpdf/tcpdf.php');
require_once('bootstrap/tcpdf/config/lang/eng.php');

require_once(dirname(__FILE__).'/../vendors/phpword/autoload.php');
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;

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
        $this->header = '<table cellpadding="4">
			<tr>
				<td width="250">
					<img src="https://'.$_SERVER['SERVER_NAME'].'/images/logo-holbox-pdf.png" style="width: 150px;" />
				</td>
				<td width="250" style="margin-top: 10px; text-align: center; font-size: 18px;">
					<h4 style="font-size: 14px;"><b>Orden de Servicio</b></h4> <br />
					<h4 style="font-size: 10px;">'.$this->date.'</h4> <br>
				</td>
				<td width="250" style="text-align: center; letter-spacing: -1px; font-size: 11px;">
					<span><b>Transfer Holbox, S.A. de C.V.</b></span> <br />
					Igualdad Mza 6 Centro LT 1 <br />
					Isla de Holbox, Q. Roo 77310 <br />
					R.F.C. THO-080409-S31 <br />
				</td>
			</tr>
		</table>';
		$this->SetY(5);
        $this->SetFont('helvetica', '', 12);
        $this->writeHTML($this->header, true, false, false, false, "");
	}
}

class OrdersController extends Controller
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
				'actions'=>array('create','update','GeneratePdf','GenerateExcel','orders','DownloadPdf','DownloadDoc','chiquila','getOrders','Holbox','vip','getOrderReserva','list','changeStatusPista', 'delete'),
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

	public function actionIndex(){
		$siteController = Yii::app()->createController('site')[0];
		$diaSiguiente = date('Y-m-d', strtotime(date('Y-m-d').'+ 1 day'));
		$mes = date('n', strtotime($diaSiguiente));
		$traslateMonth = $siteController->traslateMonth($mes);
		$date = date('d', strtotime($diaSiguiente)).'-'.$traslateMonth.'-'.date('Y', strtotime($diaSiguiente));
		// echo $date; exit;
		$letreros = isset($_GET['type']) ? $_GET['type'] : "";
		$this->render('orders', array('date'=>$date,'title'=>'Ordenes de Servicio','type'=>'all', 'letreros' => $letreros));
	}

	public function actionChiquila(){
		$siteController = Yii::app()->createController('site')[0];
		$diaSiguiente = date('Y-m-d', strtotime(date('Y-m-d').'+ 1 day'));
		$mes = date('n', strtotime($diaSiguiente));
		$traslateMonth = $siteController->traslateMonth($mes);
		$date = date('d', strtotime($diaSiguiente)).'-'.$traslateMonth.'-'.date('Y', strtotime($diaSiguiente));
		$this->render('orders', array('date'=>$date,'type'=>'chiquila','title'=>'Chiquilá','letreros'=>""));
	}

	public function actionHolbox(){
		$siteController = Yii::app()->createController('site')[0];
		$diaSiguiente = date('Y-m-d', strtotime(date('Y-m-d').'+ 1 day'));
		$mes = date('n', strtotime($diaSiguiente));
		$traslateMonth = $siteController->traslateMonth($mes);
		$date = date('d', strtotime($diaSiguiente)).'-'.$traslateMonth.'-'.date('Y', strtotime($diaSiguiente));
		$this->render('orders', array('date'=>$date,'type'=>'holbox','title'=>'Holbox','letreros'=>""));
	}

	public function actionVip(){
		$siteController = Yii::app()->createController('site')[0];
		$diaSiguiente = date('Y-m-d', strtotime(date('Y-m-d').'+ 1 day'));
		$mes = date('n', strtotime($diaSiguiente));
		$traslateMonth = $siteController->traslateMonth($mes);
		$date = date('d', strtotime($diaSiguiente)).'-'.$traslateMonth.'-'.date('Y', strtotime($diaSiguiente));
		$type=$_GET['type'];
		if ($type == 'salidas') {
			$title = "Holbox - Salidas";
		} else {
			$title = "Holbox - Llegadas";
		}
		$this->render('orders', array('date'=>$date,'type'=>$type,'title'=>$title,'letreros'=>""));
	}

	public function traslateMonth($numero){
		$fecha = DateTime::createFromFormat('!m', $numero);
		$mes = strftime("%B", $fecha->getTimestamp()); // marzo

		return strtoupper($mes);
	}

	public function actiongetOrderReserva(){
		if ($_GET) {
			$order = Ordenreserva::model()->find("idreserva=".$_GET["id"]);
			if (empty($order)) {
				$order = null;
			}
			echo CJSON::encode($order);
		}
	}

	public function actionList(){
		$condition = "";
		if (isset($_GET['idreserva'])) {
			$condition = "idreserva=".$_GET["idreserva"];
		}
		$order = Ordenreserva::model()->findAll($condition);
		$row = array();
		foreach ($order as $val) {

			switch ($val->status) {
				case "1":
					$val->status = "Cancelado";
					break;				
				case "0":
					$val->status = "Incompleto";
					break;				
				case "2":
					$val->status = "Pendiente";
					break;				
				case "3":
					$val->status = "Pagado";
					break;				
				default:
					$val->status = "Áctivo";
					break;
			}
			$tipo_cambio=$val->tipo_cambio;
			$precio_unit=$val->total;
		    if ((float) $tipo_cambio > 1 && $val->moneda == 'USD') $precio_unit= $precio_unit * $tipo_cambio;
		   	$val->subtotal = $precio_unit;
			$row[] = $val;
		}
		echo $_GET['$callback'] . '({"row":' . CJSON::encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) .'"})';
	}

	public function actionChangeStatusPista($id){
		if ($id != null) {
			$reserva = Reservatour::model()->findByPk($id);


			if (!empty($reserva)) {
				$reserva->pista = $reserva->pista == '1' ? '0' : '1';
				$reserva->save();
			}

			echo CJSON::encode(array('success'=> 1));
		}
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
		$error = false;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ordenreserva']))
		{
			$flag = true;
			if (isset($_POST['ids'])) {
				if (count($_POST['ids']) > 1) {
					$flag = false;
					foreach ($_POST['ids'] as $key => $orden) {
						$model=new Ordenreserva;
						$model->attributes=$orden;
						$book = Reservatour::model()->findByPk($model->idreserva);
						$model->tipo = $book->concepto == "Transporte 35 USD" ? 1 : 2;
						$model->observaciones = $orden['observaciones'];
						$model->moneda = $orden['moneda'];
						$model->tipo_cambio = $orden['tipo_cambio'];
						$model->status = 3;
						$model->save();
					}
					$error = false;
				}
			}
			if ($flag) {
				$model=new Ordenreserva;
				// code...
				$model->attributes=$_POST['Ordenreserva'];
				$book = Reservatour::model()->findByPk($model->idreserva);
				$model->tipo = $book->concepto == "Transporte 35 USD" ? 1 : 2;
				$model->observaciones = $_POST['Ordenreserva']['observaciones'];
				$model->moneda = $_POST['Ordenreserva']['moneda'];
				$model->tipo_cambio = $_POST['Ordenreserva']['tipo_cambio'];
				$model->status = 3;
				// echo "<textarea>".CJSON::encode($model)."</textarea>"; exit;
				if(!$model->save()){
					$error = true;
					// $this->redirect(array('view','id'=>$model->idorden));
				}
			}
		}
		echo CJSON::encode(array('error'=>$error));

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
		if(isset($_POST['Ordenreserva']))
		{
			$model->attributes=$_POST['Ordenreserva'];
			$book = Reservatour::model()->findByPk($model->idreserva);
			$model->tipo = $book->concepto == "Transporte 35 USD" ? 1 : 2;
			if (in_array($_POST['Ordenreserva']['status'], array('0', '1', '2', '3'))) {
				$model->status = $_POST['Ordenreserva']['status'];
			} else {
				$model->status = 3;
			}
			$model->observaciones = $_POST['Ordenreserva']['observaciones'];
			$model->moneda = $_POST['Ordenreserva']['moneda'];
			$model->tipo_cambio = $_POST['Ordenreserva']['tipo_cambio'];
			if(!$model->save()){
				// echo "<textarea>".CJSON::encode($model->getErrors())."</textarea>";
				$error = true;
				// $this->redirect(array('view','id'=>$model->idorden));
			}
		}

		echo CJSON::encode(array('error'=>$error));

		// $this->render('update',array(
		// 	'model'=>$model,
		// ));
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
			$reserva = Reservatour::model()->findByPk($id);
			if ($reserva->delete()) {
				$orders = Ordenreserva::model()->findAll('idreserva='.$id);
				foreach ($orders as $key => $value) { $value->delete(); }
				$reservaDesglose = ReservatourDesglose::model()->findAll('idreserva='.$id);
				foreach ($reservaDesglose as $k => $v) { $v->delete(); }
			}

			echo CJSON::encode(array('success' => true));
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			// if(!isset($_GET['ajax']))
				// $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		// else
			// throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionGetOrders(){

		$condicion = "";
		$orderBy = "fechaLLegada ASC, horarioLLegada ASC, fechaSalida ASC, horarioPickup ASC";
		if ($_GET['fecha_de']) {
			$fecha_de = implode('-', array_reverse(explode('/', $_GET['fecha_de'])));
		}

		if ($_GET['fecha_hasta']) {
			$fecha_hasta = implode('-', array_reverse(explode('/', $_GET['fecha_hasta'])));
		}

		$tipoFecha = "All";
		if (isset($_GET['tipoFecha'])) {				
				if ($_GET['tipoFecha'] != "all") {
					$tipoFecha = $_GET['tipoFecha'];
					if ($tipoFecha == 0) {
						$orderBy = "fechaLLegada ASC, horarioLLegada ASC";
						$condicion .= " (fechaLLegada BETWEEN '".$fecha_de."' AND '".$fecha_hasta."') ";
					} else if ($tipoFecha == 1) {
						$orderBy = "fechaSalida ASC, horarioPickup ASC";
						$condicion .= " (fechaSalida BETWEEN '".$fecha_de."' AND '".$fecha_hasta."') ";
					}
					// $condicion .= " (fechaLLegada BETWEEN '".$fecha_de."' AND '".$fecha_hasta."' OR fechaSalida BETWEEN '".$fecha_de."' AND '".$fecha_hasta."') ";
				} else {
					$condicion .= " (fechaLLegada BETWEEN '".$fecha_de."' AND '".$fecha_hasta."' OR fechaSalida BETWEEN '".$fecha_de."' AND '".$fecha_hasta."') ";
				}
		} else {
			$condicion .= " (fechaLLegada BETWEEN '".$fecha_de."' AND '".$fecha_hasta."' OR fechaSalida BETWEEN '".$fecha_de."' AND '".$fecha_hasta."') ";
		}

		$type = "";
		if ($_GET["type"] != "all") {
			$type = $_GET["type"];
			if ($type == "chiquila") {
				if ($tipoFecha == 'All') {
					$condicion.= " AND (id_arrivals_from = 2 OR id_arrivals_to = 2) ";
				} else {
					$condicion.= ($tipoFecha == 1) ? " AND id_arrivals_from = 2 " : " AND id_arrivals_to = 2 ";
				}
				$condicion.=" AND (tipoPrivadoEstandar = '' OR tipoPrivadoEstandar IN('estandar','colectivo')) ";
			} else if ($type == "holbox") {
				if ($tipoFecha == 'All') {
					$condicion.= " AND (id_arrivals_from = 3 OR id_arrivals_to = 3) ";
				} else {
					$condicion.= ($tipoFecha == 1) ? " AND id_arrivals_from = 3 " : " AND id_arrivals_to = 3 ";
				}
				$condicion.=" AND tipoPrivadoEstandar IN ('premium', 'estandar') ";
			}
		}

		$id_agencia = 0;
		if ($_GET['id_agencia']) {
			$id_agencia = $_GET['id_agencia'];
			$condicion.=" AND id_agencia=".$id_agencia." ";
		}

		$tipoViaje = 0;
		if (isset($_GET['tipoViaje'])) {
			$tipoViaje = $_GET['tipoViaje'];
			if ($tipoViaje != "all") {
				$condicion.=" AND tipoViaje='".$tipoViaje."' ";
			}
		}

		$desglose = array();
		$desglose['chiquila']['adultos'] = 0;
		$desglose['chiquila']['menores'] = 0;
		$desglose['holbox']['adultos'] = 0;
		$desglose['holbox']['menores'] = 0;

		if (isset($_GET['PDF'])) {
			$condicion.= ' AND estatus!="C" ';
		}

		$orders = Reservatour::model()->findAll(array('order'=>$orderBy,'condition'=>$condicion));
		$row = []; $cont = 0;
		// echo $condicion;
		// echo "<textarea>".CJSON::encode($orders)."</textarea>"; exit;
		foreach ($orders as $key => $order) {
			if ($order->manual == '0' || !in_array($order->estatus, array('A', 'PA', 'C'))) continue; // 24/08/2022
			if ($order->tipoViaje == 'Redondo') {
				if (strtotime($order->fechaLLegada) >= strtotime($fecha_de) && strtotime($order->fechaLLegada) <= strtotime($fecha_hasta)) {
					$date = $order->fechaLLegada;
				} else if (strtotime($order->fechaSalida) >= strtotime($fecha_de) && strtotime($order->fechaSalida) <= strtotime($fecha_hasta)) {
					$date = $order->fechaSalida;
				}

				// if (strtotime($order->fechaLLegada) < strtotime(date('Y-m-d')) && strtotime($order->fechaSalida) < strtotime(date('Y-m-d'))) {
 			// 		$date = $order->fechaLLegada;
				// 	if (strtotime($order->fechaLLegada) < strtotime($fecha_de) && strtotime($order->fechaSalida) > strtotime($fecha_de)) {
				// 		$date = $order->fechaSalida;
				// 	}
				// } else if (strtotime($order->fechaLLegada) < strtotime(date('Y-m-d'))) {
	   //  			$date = $order->fechaSalida;
				// } else if (strtotime($order->fechaLLegada) < strtotime($fecha_de)) {
				// 	$date = $order->fechaSalida;
				// } else {
	   //  			$date = $order->fechaLLegada;
				// }
		    } else if ($order->tipoViaje == 'Sencillo') {
		    	// if ($order->inverso == "true") {
		    	// 	$date = $order->fechaSalida;
		    	// } else {
		    	// 	$date = $order->fechaLLegada;
		    	// }

		    	// if (empty($date)) {
		    		if (!empty($order->fechaLLegada)) {
		    			$date = $order->fechaLLegada;
		    		} else {
		    			$date = $order->fechaSalida;
		    		}
		    	// }
		    }

		    if (strtotime($date) >= strtotime($fecha_de) && strtotime($date) <= strtotime($fecha_hasta)) {
		    	$pagos = Ordenreserva::model()->findAll('idreserva='.$order->idreserva);
		    	$total = 0;
		    	$conversionTotal = 0;
		    	$pagados = 0;
		    	foreach ($pagos as $cobro) {
		    		$tipo_cambio=$cobro->tipo_cambio;
		    		$precio_unit=$cobro->total;
		    		if ((float) $tipo_cambio > 1 && $cobro->moneda == 'USD') $precio_unit= $precio_unit * $tipo_cambio;
		    	   $total+=$precio_unit;
		    	   $conversionTotal+= $order->estatus != 'C' ? $precio_unit : 0;
		    	   if ((int) $cobro->status == 3) $pagados++;
		    	}
		    	// if ($pagados == 0) continue;
		    	if ($total == 0) continue; // 24/08/2022
		    	if ($order->estatus == 'C') $total = 0;
			    $destino = "";
			    if (!empty($order->id_arrivals_to)) {
			    	$destino = $order->idArrivalsTo->name;
			    }

			    $agencia = "";
			    if (!empty($order->id_agencia)) {
			    	$agencia = $order->idAgencia->name;
			    }

			    $operador = "";
			    if (!empty($order->id_driver)) {
			    	$operador = $order->idOperador->name;
			    }

			    $paxes = ReservatourDesglose::model()->find("idreserva=".$order->idreserva);
			    $adultos = $order->pasajeros; $menores = 0;
			    $pax = $order->pasajeros;
			    $paxs = $pax.'.0';
			    if (!empty($paxes)) {
			    	$adultos = $paxes->adultos;
			    	$menores = $paxes->menores;
			    	$pax = $adultos + $menores;
			    	$paxs = $adultos.'.'.$menores;
			    }

			    // $origen = utf8_decode($order->desde);
			    // if (strtotime(date('Y-m-d',$order->fechaReservacion)) < strtotime(date('2022-03-09')) ) {
			    // if ($order->idreserva > 2885) {
			    	$origen = $order->desde;
			    // }
			    	
			    $horarioPickup = $order->horarioPickup;
			    // jccd 29/09/2022
			    if ($order->tipoViaje == 'Redondo') {
				    if ($date == $order->fechaLLegada) {
				    	$horarioPickup = $order->horarioLLegada;
				    } else if ($date == $order->fechaSalida) {
				    	$horarioPickup = $order->horarioPickup;
				    }
			    }
			    // jccd end

			    if (empty($horarioPickup) && $order->tipoViaje == 'Redondo') {
			    	$convertHorarioPickup = $order->fechaSalida.' '.$order->horarioSalida.':00';
			    	$horarioPickup = date('H:i', strtotime($convertHorarioPickup.' -5 hours'));
			    }

			    // jccd 19/06/2022
			    if (empty($horarioPickup) && !empty($order->horarioSalida)) {
			    	$convertHorarioPickup = $order->fechaSalida.' '.$order->horarioSalida.':00';
			    	$horarioPickup = date('H:i', strtotime($convertHorarioPickup.' -5 hours'));
			    }
			    
			    if (empty($horarioPickup) && !empty($order->horarioLLegada)) {
			    	$horarioPickup = $order->horarioLLegada;
			    }
			    // end jccd

			    // if ($tipoFecha != 'All') {
			    // 	// code...
				   //  if ($tipoFecha == 0) {
				   //  	$date = $order->fechaLLegada;
				   //  } else if ($tipoFecha == 1) {
				   //  	$date = $order->fechaSalida;
				   //  	// code...
				   //  }
			    // }

			   //  if ($order->idreserva < 2882 && ($order->id_arrivals_to == NULL || $order->id_arrivals_from == NULL)) {
			   //  	if ($order->tipoPrivadoEstandar == 'estandar' || empty($order->tipoPrivadoEstandar)) {
			   //  		$desglose['chiquila']['adultos'] += $adultos;
						// $desglose['chiquila']['menores'] += $menores;
				  //   	if ($destino == "") {
				  //   		$destino = "Chiquilá";
				  //   		if ($order->inverso == "true") {
				  //   			$destino = $order->desde;
				  //   		}
				  //   		if ($order->desde == "ChiquilÃ¡" && $order->concepto == "Transporte 35 USD") {
				  //   			$destino = "Aeropuerto Cancún";
				  //   		} 
				    		// else {
				    	// 		$destino = "Chiquila";
				    	// 	}
				    	// }
			   //  	} else if ($order->tipoPrivadoEstandar == 'premium' && $type == "holbox") {
			   //  		$desglose['holbox']['adultos'] += $adultos;
						// $desglose['holbox']['menores'] += $menores;
						// if ($destino == "") {
						// 	$destino = "Holbox";
						// 	if ($order->inverso == "true") {
				  //   			$destino = $order->desde;
				  //   		}
				  //   		if ($order->inverso == "true") {
				  //   			$destino = $order->desde;
				  //   		} else {
				  //   			$destino = "Holbox";
				  //   		}
				    	// }
			    	// }
			    // } else {
			    	if ($order->id_arrivals_to == 2 || $order->id_arrivals_from == 2) {
			    		$desglose['chiquila']['adultos'] += $adultos;
						$desglose['chiquila']['menores'] += $menores;
			    	} else if ($order->id_arrivals_to == 3 || $order->id_arrivals_from == 3) {
			    		$desglose['holbox']['adultos'] += $adultos;
						$desglose['holbox']['menores'] += $menores;
			    	}
			    // }

			    // if($orden->status == 0) Incompleto
                // if($orden->status == 1) Cancelado
                // if($orden->status == 2) Pendiente
                // if($orden->status == 3) Pagado

			    $estatus = "";
			    switch ($order->estatus) {
			    	case "PA":
			    		$estatus = "Pagado";
			    		break;
			    	case "C":
			    		$estatus = "Cancelado";
			    		break;
			    	case "P":
			    	case "A":
			    	default:
			    		$estatus = "Pendiente";
			    		break;
			    }

			    $categoria = $order->tipoPrivadoEstandar;
			    if (empty($order->tipoPrivadoEstandar)) {
			    	$categoria = 'colectivo';
			    }
			    $categoria = ucfirst($categoria);
			    $origenReserva = 'Manual';
			    if (empty($order->id_arrivals_to) && empty($order->id_arrivals_from)) {
			    	$origenReserva = 'Web';
			    }
			    $origenReserva = $order->manual == '0' ? 'Web' : 'Manual';
			    $numeroVuelo = '';
			    $vueloLlegada = '';
			    $aerolineaLlegada = '';
			    $aerolinea = '';

			    if ((int) $order->id_arrivals_to > 0 || (int) $order->id_arrivals_from > 0){
			    	if ($order->id_arrivals_from == 1){
					    $vueloLlegada = $order->vueloLlegada;
					    $aerolineaLlegada = $order->aerolineaLlegada;
			    	}
			    	if ($order->id_arrivals_to == 1){			    		
			    		$numeroVuelo = $order->numeroVuelo;
					    $aerolinea = $order->aerolinea;
			    	}
			    }
			    if (($order->id_arrivals_to == 0 || $order->id_arrivals_to == null) && ($order->id_arrivals_from == 0 || $order->id_arrivals_from == null)){
			    	$vueloLlegada = $order->vueloLlegada;
					$aerolineaLlegada = $order->aerolineaLlegada;
					$numeroVuelo = $order->numeroVuelo;
					$aerolinea = $order->aerolinea;
			    }

			    $referencia = '';
			    if ($order->referencia != '' || $order->referencia != null){
			    	$referencia = $order->referencia;
			    }

			    // jccd 02/10/2022
			    $hotel = $order->hotel;
			    $hotelSalida = $order->hotelSalida;
			    if ($order->tipoViaje == 'Redondo') {
			    	if (strtotime($fecha_de) > strtotime($order->fechaLLegada)) {
			    		$origen = $order->idArrivalsTo->name;
			    		$destino = $order->idArrivalsFrom->name;
			    		$hotel = $order->hotelSalida;
			    		$hotelSalida = $order->hotel;

			    		if ($order->id_arrivals_from == 1){
						    $aerolinea = $order->aerolinea;
						    $numeroVuelo = $order->numeroVuelo;
						    $aerolineaLlegada = "";
				    		$vueloLlegada = "";
				    	}
			    	}
			    }
			    // jccd end

			    // jccd 16/10/2022
			    $otrascategorias = Otrascategoriasreservas::model()->findAll('idreserva='.$order->idreserva);
			    $otrascategoriasString = '';
			    foreach ($otrascategorias as $key => $oCat) {
			    	$otrasCat = Otrascategorias::model()->findByPk($oCat->id_otrascategorias);
			    	if ($key > 0) $otrascategoriasString.=', ';
			    	$otrascategoriasString.= $otrasCat->name;
			    }

			    // jccd end

			    $row[$cont]["idreserva"] = $order->idreserva;
			    $row[$cont]["tipo"] = $order->tipoViaje;
			    $row[$cont]["date"] = $date;
			    $row[$cont]["pickup"] = $horarioPickup;
			    $row[$cont]["destino"] = $destino;
			    $row[$cont]["agencia"] = $agencia;
			    $row[$cont]["operador"] = $operador;
			    $row[$cont]["estatus"] = $estatus;
			    $row[$cont]["id_driver"] = $order->id_driver;
			    $row[$cont]["numeroVuelo"] = $numeroVuelo;
			    $row[$cont]["numeroVueloLlegada"] = $vueloLlegada;
			    $row[$cont]["aerolineaLlegada"] = $aerolineaLlegada;
			    $row[$cont]["aerolinea"] = $aerolinea;
			    $row[$cont]["referencia"] = $referencia;
			    $row[$cont]["hotelLlegada"] = $hotel;
			    $row[$cont]["hotelSalida"] = $hotelSalida;
			    $row[$cont]["inverso"] = $order->inverso;
			    $row[$cont]["id_arrivals_to"] = $order->id_arrivals_to;
			    $row[$cont]["id_arrivals_from"] = $order->id_arrivals_from;
			    $row[$cont]["idExperiencia"] = $order->idExperiencia;

			    $row[$cont]["pista"] = $order->pista;

			    // if (($order->id_arrivals_to == 0 || $order->id_arrivals_to == null) && ($order->id_arrivals_from == 0 || $order->id_arrivals_from == null)){
			    	// $row[$cont]["nombre"] = utf8_encode($order->nombre)." ".utf8_encode($order->apellido);
			    	// $row[$cont]["origen"] = utf8_encode($origen);
			    // } else {
			    	$row[$cont]["nombre"] = $order->nombre." ".$order->apellido;
			    	$row[$cont]["origen"] = $origen;
			    // }

			    $row[$cont]["pax"] = $paxs;
			    $row[$cont]["paxes"] = $paxs;
			    $row[$cont]["adultos"] = $adultos;
			    $row[$cont]["menores"] = $menores;
			    $row[$cont]["total"] = $total;
			    $row[$cont]["conversionTotal"] = $conversionTotal;
			    $row[$cont]["observaciones"] = $order->observaciones;
			    $row[$cont]["categoria"] = $categoria;
			    $row[$cont]["origenReserva"] = $origenReserva;
			    $row[$cont]["otrascategorias"] = $otrascategoriasString; // 16/10/2022

			    $cont++;
		    }
		}

		// jccd 08/07/2022 sort by datetime
		usort($row, function ($a, $b) {
			$date_a = $a['date'].' '.$a['pickup'];
			$date_b = $b['date'].' '.$b['pickup'];
			if (strtotime($date_b) < strtotime($date_a))
				return 1;
			else if (strtotime($date_b) > strtotime($date_a))
				return -1;
			else
				return 0;
		});

		$_estatusCancelados = array_filter($row, function($c) { return $c['estatus'] == 'Cancelado'; });
		$_estatusOthers = array_filter($row, function($a) { return $a['estatus'] != 'Cancelado'; });

		$row = array_merge(array_values($_estatusOthers), array_values($_estatusCancelados));

		if (isset($_GET['PDF'])) {
			$siteController = Yii::app()->createController('site')[0];

			// jccd 08/07/2022
			if (strtotime($fecha_de) == strtotime($fecha_hasta)){
				$mes = date('n', strtotime($fecha_de));
				$traslateMonth = $siteController->traslateMonth($mes);
				$date = date('d', strtotime($fecha_de)).'-'.$traslateMonth.'-'.date('Y', strtotime($fecha_de));
			} else {
				$mes_1 = date('n', strtotime($fecha_de));
				$mes_2 = date('n', strtotime($fecha_hasta)); 
				$traslateMonth_1 = $siteController->traslateMonth($mes_1);
				$traslateMonth_2 = $siteController->traslateMonth($mes_2);
				$date = date('d', strtotime($fecha_de)).'-'.$traslateMonth_1.'-'.date('Y', strtotime($fecha_de));
				$date.=' / ';
				$date.= date('d', strtotime($fecha_hasta)).'-'.$traslateMonth_2.'-'.date('Y', strtotime($fecha_hasta));
			}

			$data = array(
				'row' => $row,
				'desglose' => $desglose,
				'date' => $date,
				'type' => $_GET['type']
			);
			
			if (isset($_GET['sendPDF'])) {
				$driversController = Yii::app()->createController('drivers')[0];
				$imprimir = isset($_GET['imprimir']) ? 1 : 0;
				$sendResponse = $driversController->listaParaOperadores($data, $imprimir);
				echo json_encode(array('success' => $sendResponse));
			} else {
				$html = $this->renderPartial('ordersPdf',$data, true);
				$this->actionDownloadPdf($html, $date);
			}
		} else {
			echo $_GET['$callback'] . '({"row":' . CJSON::encode($row, JSON_NUMERIC_CHECK) . ', "__count": "' . count($row) . '", "desglose":'.CJSON::encode($desglose).'})';
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
		$model=Ordenreserva::model()->findByPk($id);
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

	public function actionDownloadPdf($html, $datetime = null, $send = false){
		$logo = 'https://'.$_SERVER['SERVER_NAME'] . "/images/logo-holbox.svg";
		$siteController = Yii::app()->createController('site')[0];
		$diaSiguiente = date('Y-m-d', strtotime(date('Y-m-d').'+ 1 day'));
		$mes = date('n', strtotime($diaSiguiente));
		$traslateMonth = $siteController->traslateMonth($mes);
		$date = date('d', strtotime($diaSiguiente)).'-'.$traslateMonth.'-'.date('Y', strtotime($diaSiguiente));
		if ($datetime != null) $date = $datetime;
		$data = array(
			'logo' => $logo
		);
		
		$pdf = new MYPDF();

		$pdf->setParams($date);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("TRANSFER HOLBOX S.A DE C.V");
		$pdf->SetTitle('Ordenes de Servicio');
		$pdf->SetSubject('Ordenes de Servicio');
		$pdf->setHeaderFont(Array('helvetica', '', 12));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, 24, 15);

		$pdf->setPrintHeader(true);
		$pdf->SetHeaderMargin(15);

		$pdf->setPrintFooter(true);
		$pdf->SetFooterMargin(10);

		 $pdf->setPageOrientation('L', '', 1);

		$pdf->SetAutoPageBreak(TRUE, 34);
		$pdf->SetFont('helvetica', '', 7.5);
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
			$filePDF = $pdf->Output("Ordenes_".date('H:i:s').".pdf", "S"); 
			return $filePDF;
		} else {
			$pdf->Output("Ordenes_".date('H:i:s').".pdf", "I");
		}
	}

	public function actionDownloadDoc(){

		$phpWord = new PhpWord();
		$section = $phpWord->addSection(array('orientation' => 'landscape'));

		$wordName = "Letreros_".date('dmY')."_".date('his').".docx";

		$ids = explode(',', $_POST['orders']);
		$cont = count($ids);

		$phpWord->addParagraphStyle('p2Style', array('align'=>'center', 'spaceAfter'=>100));
		foreach ($ids as $v => $val) {
		    $model = Reservatour::model()->findByPk($val);
		    $section->addText($model->nombre.' '.$model->apellido, array('bold'=>true, 'name'=>'Arial', 'size'=>110), 'p2Style');
		    $section->addText($model->idAgencia->name, array('bold'=>true, 'name'=>'Arial', 'size'=>25), 'p2Style');
		    if ($cont !== ($v+1)) {
		    	$section->addPageBreak();
		    }
		}

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save($wordName);

		header("Content-Disposition: attachment; filename=".$wordName."");
		echo file_get_contents($wordName);

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
