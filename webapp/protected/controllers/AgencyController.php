<?php

class AgencyController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/signup-layout';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	
	public function actions()
	 {
	  return array(
	   'captcha'=>array(
		'class'=>'CCaptchaAction',
		 'backColor'=>0xFFFFFF,
	   ),
	 
	   'page'=>array(
		 'class'=>'CViewAction',
		),
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
				'actions'=>array('register','captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('@'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
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
		$model=new YiiAgency;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['YiiAgency']))
		{
			$model->attributes=$_POST['YiiAgency'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	

	public function actionRegister1806()
	{
		$model = new YiiAgency;
		//$channelagency = new YiiAgencyChannel;
		//$orders = array();
		
		if(isset($_POST['YiiAgency']))
		{
			
			$model->attributes=$_POST['YiiAgency'];
			//$channelagency->attributes=$_POST['YiiAgencyChannel'];
			
			$valid=$model->validate();
			
			$rnd = rand(0,9999).time(); // rand(1000,9999) optional
			$rnd = md5($rnd);
			
			$password = '123456';
			
			$cnt = count($_POST['YiiAgencyChannel']['ChannelId']);
	

			if($valid){
			  
			  $model->LoginId = 'LMI'.time();
			  $model->Password = md5($password);
			  
			  if($model->save(false)){ // use false parameter to disable validation
				  
				for($i=0; $i<$cnt; $i++){
				
				  //$insert_id = Yii::app()->db->getLastInsertID();
				  $channelagency->Id = time();
				  $channelagency->AgencyId = $model->Id;
				  $channelagency->ChannelId = $_POST['YiiAgencyChannel']['ChannelId'][$i];
				  $channelagency->isNewRecord = true;
				  $channelagency->save(false);
			  } 
			   
			   Yii::app()->session;
			   Yii::app()->session['asuccess'] = $model->Id;
					  				
			   $this->redirect(array('site/success', 'msg'=>'success'));
			  }
			}
		}
		
		$this->render('register',array(
			'model'=>$model,
			'channelagency'=>$channelagency,
		));

	}
	
	
	public function actionRegister()
	{
		$model = new YiiAgency;
		$channelagency = new YiiAgencyChannel;
		$orders = array();
		
		if(isset($_POST['YiiAgency']))
		{
			
			$model->attributes=$_POST['YiiAgency'];
			$channelagency->attributes=$_POST['YiiAgencyChannel'];
			
			$valid=$model->validate();
			
			$rnd = rand(0,9999).time(); // rand(1000,9999) optional
			$rnd = md5($rnd);
			
			$password = '123456';
			
			$cnt = count($_POST['YiiAgencyChannel']['ChannelId']);
			
			$caid1 = rand(0,999);
			//$caid2 = rand(0,999);
			
			/*echo $cnt;
			echo '<br />';
			echo '<br />';
			
			for($i=0; $i<$cnt; $i++){
				  echo $_POST['YiiAgencyChannel']['ChannelId'][$i];
				  echo '<br />';
			  }
			
			
			die;*/

			if($valid){
			  
			  $model->LoginId = 'LMI'.time();
			  $model->Password = md5($password);
			  
			  if($model->save(false)){ // use false parameter to disable validation
				  
				for($i=0; $i<$cnt; $i++){
					
				  $caid2 = rand(0,999);
				
				  $channelagency->Id = $caid1.$i.$caid2.$i;
				  $channelagency->AgencyId = $model->Id;
				  $channelagency->ChannelId = $_POST['YiiAgencyChannel']['ChannelId'][$i];
				  $channelagency->isNewRecord = true;
				  $channelagency->save(false);
			  } 
			   
			   Yii::app()->session;
			   Yii::app()->session['asuccess'] = $model->Id;
					  				
			   $this->redirect(array('site/success', 'msg'=>'success'));
			  }
			}
		}
		
		$this->render('register',array(
			'model'=>$model,
			'channelagency'=>$channelagency,
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

		if(isset($_POST['YiiAgency']))
		{
			$model->attributes=$_POST['YiiAgency'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$dataProvider=new CActiveDataProvider('YiiAgency');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new YiiAgency('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['YiiAgency']))
			$model->attributes=$_GET['YiiAgency'];

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
		$model=YiiAgency::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='lmi-agency-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
