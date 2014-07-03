<?php

class ChannelController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	/*public function actions()
	{
	 return array(
	  // captcha action renders the CAPTCHA image displayed on the contact page
	  'captcha'=>array(
	   'class'=>'CCaptchaAction',
	   'backColor'=>0xFFFFFF,
	  ),
	 );
	}*/
	
	
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
				'actions'=>array('register','detail','book','captcha','tempbook'),
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
        
        
        public function actionTempbook()
	{
            $id = $_REQUEST["id"];
            $sec = $_REQUEST["sec"];
            $aid = get_agency_id();
            
            $sessionId = Yii::app()->session->sessionID;
            
            if(Yii::app()->request->isAjaxRequest)
	       {
                $count = YiiTempfpc::model()->countByAttributes(array(
                'AgencyId' => $aid, 'FPCId' => $id, 'SessionId' => $sessionId
                 ));
                
                if($count==0){
                
                  $sql = "INSERT INTO yii_temp_fpc (FPCId, AgencyId, SessionId, Seconds) values (:FPCId, :AgencyId, :SessionId, :Seconds)";
		  $parameters = array(':FPCId' => $id, ':AgencyId' => $aid, ':SessionId' => $sessionId, ':Seconds' => $sec);
	
		  Yii::app()->db->createCommand($sql)->execute($parameters);
                  
                  //echo 'true';
                }
                else{
    
                   $sql = "UPDATE yii_temp_fpc SET Seconds = '".$sec."' WHERE FPCId=:FPCId AND AgencyId=:AgencyId AND SessionId=:SessionId";
                   $parameters = array(':FPCId' => $id, ':AgencyId' => $aid, ':SessionId' => $sessionId);
                   Yii::app()->db->createCommand($sql)->execute($parameters);
    
                   //echo 'update';
                }
                
                
                $sql = Yii::app()->db->createCommand();
                $sql->setFetchMode(PDO::FETCH_OBJ);

                $sql->select('Id, AgencyId, count(*) As channel, sum(Seconds) As second')
                        ->from('yii_temp_fpc')
                        ->where('AgencyId = '.$aid.' AND SessionId = "'.$sessionId.'" AND Seconds > 0')
                        ->group('AgencyId, SessionId')
                        ->limit('1');
                
                foreach ($sql->queryAll() as $row) { 
                       $tchannel = $row->channel;
                       $tsecond = $row->second;
                }
                
                //$tchannel = 10;
                //$tsecond = 12;
                
                
                $array = array('channel' => $tchannel,'second' => $tsecond);
		$json = json_encode($array);
		echo $json;
   
                Yii::app()->end();
            }
        }
	
	
	public function actionDetail($id)
	{	
            
            $rawData=Yii::app()->db->createCommand("SELECT b.Id As Id, CASE WHEN DATE(a.TeleCastDate) = DATE(NOW()) THEN 'Today' ELSE DATE_FORMAT(a.TeleCastDate,'%d %b %Y') END As TeleCastDate, UNIX_TIMESTAMP(a.TeleCastDate) As ut, sum(AvailableSpot) As AvailableSpot, b.ChannelName As ChannelName FROM yii_dialyfpc a LEFT JOIN yii_channel b ON a.ChannelCode = b.ChannelCode WHERE a.TeleCastDate BETWEEN DATE(NOW()) AND DATE_ADD(DATE(NOW()), INTERVAL +1 MONTH) AND b.Id = ".$id." GROUP BY a.ChannelCode, a.TeleCastDate Order By a.TeleCastDate")->queryAll();
		// or using: $rawData=User::model()->findAll();
		$dataProvider=new CArrayDataProvider($rawData, array(
			'id'=>'user',
			'sort'=>array(
				'attributes'=>array(
					 'Id', 'ChannelName', 'AvailableSpot', 'TeleCastDate', 'ut',
				),
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
            
		$this->render('detail',array(
			'model'=>$this->loadModel($id),'dataProvider'=>$dataProvider
		));
	}
	
	public function actionBook($id)
	{
		if(!isset(Yii::app()->session['uid']) || Yii::app()->session['utype']!='A'){
			$this->redirect(array('channel/detail','id'=>$id));
			exit;
		}
                
                $aid = get_agency_id();
                $sessionId = Yii::app()->session->sessionID;
                
                $count = YiiAgencyChannel::model()->countByAttributes(array(
                  'AgencyId' => $aid, 'ChannelId' => $id, 'Status' => 0
                 ));
                
                if($count==0){
		   $this->redirect(array('channel/detail','id'=>$id));
		   exit;
		}
                
                
                $timestamp = isset($_GET['rel'])?$_GET['rel']:strtotime(date('Y-m-d'));
                
                
                $date = date('Y-m-d', $timestamp);
                
                //SELECT a.Id, a.ChannelCode, a.TeleCastDate FROM yii_dialyfpc a LEFT JOIN yii_channel b ON a.ChannelCode = b.ChannelCode WHERE DATE(a.TeleCastDate) > DATE(NOW()) AND b.Id = 7
                
                //$rawData=Yii::app()->db->createCommand("SELECT @rn:=@rn+1 As Sr, a.Id As Id, a.ProgramName As ProgramName, CONCAT(a.StartTime, ' - ', a.EndTime) As Schedule, a.AvailableSpot As AvailableSpot, DATE_FORMAT(a.TeleCastDate,'%d %b %Y') As TeleCastDate, a.SpotRate As Rate FROM yii_dialyfpc a LEFT JOIN yii_channel b ON a.ChannelCode = b.ChannelCode,(select @rn:=0) as r WHERE DATE(a.TeleCastDate) = DATE('".$date."') AND b.Id = ".$id." order by Sr")->queryAll();
		// or using: $rawData=User::model()->findAll();
                
                $rawData=Yii::app()->db->createCommand("SELECT @rn:=@rn+1 As Sr, a.Id As Id, a.ProgramName As ProgramName, CONCAT(a.StartTime, ' - ', a.EndTime) As Schedule, a.AvailableSpot As AvailableSpot, DATE_FORMAT(a.TeleCastDate,'%d %b %Y') As TeleCastDate, a.SpotRate As Rate, c.Seconds As Seconds FROM yii_dialyfpc a LEFT JOIN yii_channel b ON a.ChannelCode = b.ChannelCode LEFT JOIN yii_temp_fpc c ON (a.Id = c.FPCId AND c.AgencyId = ".$aid." AND SessionId = '".$sessionId."'),(select @rn:=0) as r WHERE DATE(a.TeleCastDate) = DATE('".$date."') AND b.Id = ".$id." order by Sr")->queryAll();
		$dataProvider=new CArrayDataProvider($rawData, array(
			'id'=>'user',
			'sort'=>array(
				'attributes'=>array(
					 'Sr' ,'Id', 'ProgramName', 'Schedule', 'AvailableSpot', 'TeleCastDate', 'Rate', 'Seconds'
				),
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
		
		$this->render('book',array(
			'model'=>$this->loadModel($id),'dataProvider'=>$dataProvider
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	/*public function actionCreate()
	{
		$model=new YiiChannel;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['YiiChannel']))
		{
			$model->attributes=$_POST['YiiChannel'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}*/
	
	
	public function actionRegister()
	{
		$model=new YiiChannel;

		if(isset($_POST['YiiChannel']))
		{
			$model->attributes=$_POST['YiiChannel'];
			
			$valid=$model->validate();
			
			$rnd = rand(0,9999).time(); // rand(1000,9999) optional
			$rnd = md5($rnd);
 			
			 //Generate Random Password
			 
			 /*$length = 10;
			 $chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
			 shuffle($chars);
			 $password = implode(array_slice($chars, 0, $length));*/
			 
			 $password = '123456';
	
			 if($valid){
				 
				 //$chnuser->CreatedOn = date('Y-m-d H:i:s');
				 
				 $logo = CUploadedFile::getInstance($model,'ChannelLogo');
				 $fileName = "{$rnd}-{$logo}";
				 
				 $model->ChannelLogo = $fileName;
				 $model->LoginId = 'LMI'.time();
				 $model->Password = md5($password);
				 
				 $model->save();
				 
				 if($model->save()){
					 
					 $logo->saveAs(Yii::app()->basePath.'/../images/'.$fileName);
					 
					 Yii::app()->session;
					 Yii::app()->session['csuccess'] = $model->Id;
					 
					 $this->redirect(array('site/success', 'msg'=>'success'));
				 }

			 }
		}

		$this->render('register',array(
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

		if(isset($_POST['YiiChannel']))
		{
			$model->attributes=$_POST['YiiChannel'];
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
		$dataProvider=new CActiveDataProvider('YiiChannel');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	public function actionMychannel()
	{
		$dataProvider=new CActiveDataProvider('YiiChannel');
		$this->render('mychannel',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new YiiChannel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['YiiChannel']))
			$model->attributes=$_GET['YiiChannel'];

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
		$model=YiiChannel::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='lmi-channel-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
