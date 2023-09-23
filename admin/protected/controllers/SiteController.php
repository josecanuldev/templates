<?php
setlocale(LC_TIME, 'es_ES');
class SiteController extends Controller
{

	public $layout = '//layouts/transfer_home';

	/**
	 * Declares the behaviors.
	 * @return array the behaviors
	 */
	public function behaviors()
	{
		return array(
			'seo'=>'ext.seo.components.SeoControllerBehavior',
		);
	}

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('error'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 * @return array the actions
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/transfer';
		$this->render('index', array());
	}

	public function traslateMonth($numero){
		$fecha = DateTime::createFromFormat('!m', $numero);
		$mes = strftime("%B", $fecha->getTimestamp()); // marzo

		return strtoupper($mes);
	}

	public function actionSetup()
	{
		$parser = new CMarkdownParser();
		Yii::app()->clientScript->registerCss('TextHighligther', file_get_contents($parser->getDefaultCssFile()));

		$this->render('setup', array(
			'parser'=>$parser,
		));
	}

	public function actionMaintenance()
	{
		$this->layout = '/layouts/maintenance';
		$this->render('maintenance');
	}

	public function guidv4($data = null) {
	    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
	    $data = $data ?? random_bytes(16);
	    assert(strlen($data) == 16);

	    // Set version to 0100
	    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
	    // Set bits 6-7 to 10
	    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

	    // Output the 36 character UUID.
	    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

    public function getTabularFormTabs($form, $model)
    {
        $tabs = array();
        $count = 0;

        foreach (array('en'=>'English', 'fi'=>'Finnish', 'sv'=>'Swedish') as $locale => $language)
        {
            $tabs[] = array(
                'active'=>$count++ === 0,
                'label'=>$language,
                'content'=>$this->renderPartial('_tabular', array(
                    'form'=>$form,
                    'model'=>$model,
                    'locale'=>$locale,
                    'language'=>$language,
                ), true),
            );
        }

        return $tabs;
    }
}
