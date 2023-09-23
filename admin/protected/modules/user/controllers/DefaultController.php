<?php

class DefaultController extends Controller
{
	private $_model;
    
    
	/**
	 * Lists all models. Use this controller/action to list User for ALL PEOPLE
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>array(
		        'condition'=>'status>'.User::STATUS_BANNED,
		    ),
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
    
    /**
     * Displays a particular model.
     * This view 'view' makes use of the UserProfile scope: forAll().
     */
    public function actionView()
    {
        $model = $this->loadModel();
        $this->render('view',array(
            'model'=>$model,
        ));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
                $this->_model=User::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

}