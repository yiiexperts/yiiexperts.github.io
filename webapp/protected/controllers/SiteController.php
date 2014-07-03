<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	 
   public $layout='//layouts/column';
	 
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
	 * @return array rules for the "accessControl" filter.
	 */

	
	public function accessRules()
	{
		return array(
		
		       array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('login','index','profile','subscribe','update','setting','checkout','error','captcha','signup','success','url'),
				'users'=>array('*'),
			),
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(
				                //'login',
				                 //'index',
				                 //'logout'
				                ),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	

 public function actionUrl(){
        $this->redirect($_GET['rd']);
    }


 public function actionLogin(){

	 //$this->layout = 'main';
	 $model = new LoginForm();
	 
	 if(!Yii::app()->user->isGuest)
      {
       $this->redirect(array('/site')); 
      }
	
	 if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
	 {
		echo CActiveForm::validate($model, array('username', 'password', 'verifyCode'));
		Yii::app()->end();
	 }

	 
	 if(Yii::app()->request->isAjaxRequest){
		 if (isset($_POST['LoginForm'])) {
		$model->attributes = $_POST['LoginForm'];
		
		if(($model->username!='') && ($model->password!=''))
			$response = 4;
		else if(($model->username=='') && ($model->password==''))
			$response = 3;
		else if(($model->username!='') && ($model->password==''))
			$response = 2;
		else if(($model->username=='') && ($model->password!=''))
			$response = 1;
		else
		   $response = 0; 
		
		
		if ($model->validate() and $model->login()) {			
			$array = array('login' => 'success','response' => $response);
			Yii::app()->user->setFlash('success', 'Successfully logged in.');
			$json = json_encode($array);
			echo $json;
			//$this->redirect(array('/site','msg'=>'Welcome to LMI'));
			Yii::app()->end();
		} 
		else{
			$array = array('login' => 'error','response' => $response);
			$json = json_encode($array);
			echo $json;
			Yii::app()->end();
		}
	   }
	 }
	 else{
	 
	 if (isset($_POST['LoginForm'])){
		 
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate(array('username', 'password')) && $model->login())
				$this->redirect(array('site/index'));
		}
	
	 }
	 $this->render('login', array(
		'model' => $model,
	  ));
	  
	}
        
        
        public function actionCheckout()
	{ 
	  $uid = Yii::app()->session['uid'];
	  $utype = Yii::app()->session['utype'];
          
          $aid = get_agency_id();
          $sessionId = Yii::app()->session->sessionID;
          
          if(isset(Yii::app()->session['uid']) && Yii::app()->session['utype']!='A'){
              $this->redirect(Yii::app()->homeUrl);
          }
          
          //$rawData=Yii::app()->db->createCommand("SELECT a.Id As Id, a.ProgramName As ProgramName, CONCAT(a.StartTime, ' - ', a.EndTime) As Schedule, a.AvailableSpot As AvailableSpot, DATE_FORMAT(a.TeleCastDate,'%d %b %Y') As TeleCastDate, a.SpotRate As Rate FROM yii_dialyfpc a LEFT JOIN yii_channel b ON a.ChannelCode = b.ChannelCode WHERE DATE(a.TeleCastDate) = DATE('".$date."') AND b.Id = ".$id)->queryAll();
		// or using: $rawData=User::model()->findAll();
          
          $rawData=Yii::app()->db->createCommand("SELECT @rn:=@rn+1 As Sr, a.Id As Id, b.Id As FPCId, c.Id As ChannelId, b.ProgramName As ProgramName, UNIX_TIMESTAMP(b.TeleCastDate) As ut, c.ChannelName As ChannelName, CONCAT(b.StartTime, ' - ', b.EndTime) As Schedule, b.AvailableSpot As AvailableSpot, DATE_FORMAT(b.TeleCastDate,'%d %b %Y') As TeleCastDate, b.SpotRate As Rate, a.Seconds As Seconds FROM yii_temp_fpc a LEFT JOIN yii_dialyfpc b ON a.FPCId = b.Id LEFT JOIN yii_channel c ON b.ChannelCode = c.ChannelCode LEFT JOIN yii_agency_channel d ON (a.AgencyId = d.AgencyId AND c.Id = d.ChannelId),(select @rn:=0) as r WHERE a.AgencyId = ".$aid." AND a.SessionId = '".$sessionId."' AND a.Seconds > 0 AND c.Status = 0 AND d.Status = 0 order by Sr")->queryAll();
		$dataProvider=new CArrayDataProvider($rawData, array(
			'id'=>'user',
			'sort'=>array(
				'attributes'=>array(
					 'Sr', 'Id', 'FPCId', 'ChannelId', 'ProgramName', 'ChannelName', 'Schedule', 'AvailableSpot', 'TeleCastDate', 'Rate', 'Seconds', 'ut'
				),
			),
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
		
		$this->render('checkout',array(
			'model'=>$model,'dataProvider'=>$dataProvider
		));
	  
	    //$this->render('checkout');
 
	}


	 
	/**
	 * This is the action that handles user's logout
	 */
	public function actionLogout()
	{
	    Yii::app()->user->logout();
            Yii::app()->session->clear();
            Yii::app()->session->destroy();
        
	    $this->redirect(Yii::app()->homeUrl);
	}


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{ 
	  $uid = Yii::app()->session['uid'];
	  $utype = Yii::app()->session['utype'];	
	  
	  if(!isset(Yii::app()->session['uid']))
		 $this->render('index');
	  else if(isset(Yii::app()->session['uid']) && Yii::app()->session['utype']==='C')
		 $this->render('channel_index');
	  else if(isset(Yii::app()->session['uid']) && Yii::app()->session['utype']==='A')
		 $this->render('agency_index');
	  else
	     $this->render('index');
 
	}
	
	
	public function actionSetting()
	{
		if(!isset(Yii::app()->session['uid'])){
			$this->redirect(array('/site'));
			exit;
		}
		
		
		$model = new User;
		$uid = Yii::app()->session['uid'];
		$utype = Yii::app()->session['utype'];
		
		$model = User::model()->findByAttributes(array('Id'=>$uid));
		$model->setScenario('changePwd');
		
		if($utype==='C'){
			
			$channeluser = YiiChannel::model()->findByAttributes(array('LoginId'=>$model->LoginId));
			$channeluser->setScenario('changePwd');
		}
		else if($utype==='A'){
			
			$agencyuser = YiiAgency::model()->findByAttributes(array('LoginId'=>$model->LoginId));
			$agencyuser->setScenario('changePwd');
		}
		

		if(isset($_POST['YiiAgency'])){
			
		    $agencyuser->attributes=$_POST['YiiAgency'];
			$valid = $agencyuser->validate();
				
			if($valid){
				
				$agencyuser->Password = md5($agencyuser->new_password);
				
				if($agencyuser->save())
					$this->redirect(array('setting','msg'=>'successfully changed password'));
				else
					$this->redirect(array('setting','msg'=>'password not changed'));
			}
	    }
		
		
		if(isset($_POST['YiiChannel'])){
			
		    $channeluser->attributes=$_POST['YiiChannel'];
			$valid = $channeluser->validate();
				
			if($valid){
				
				$channeluser->Password = md5($channeluser->new_password);
				
				if($channeluser->save())
					$this->redirect(array('setting','msg'=>'successfully changed password'));
				else
					$this->redirect(array('setting','msg'=>'password not changed'));
			}
	    }
		
		
		if($utype==='C')
		  $this->render('setting',array('model'=>$model,'channeluser'=>$channeluser));
		else if($utype==='A')
		  $this->render('setting',array('model'=>$model,'agencyuser'=>$agencyuser));
		
	}
	
	
	public function actionUpdate(){
		
		if(!isset(Yii::app()->session['uid'])){
			$this->redirect(array('/site'));
			exit;
		}
	   
	    $model = new User;
		$uid = Yii::app()->session['uid'];
		$utype = Yii::app()->session['utype'];
		
		$model = User::model()->findByAttributes(array('Id'=>$uid));
		
		
		$agencyuser = YiiAgency::model()->findByAttributes(array('LoginId'=>$model->LoginId));
		$channeluser = YiiChannel::model()->findByAttributes(array('LoginId'=>$model->LoginId));
		
		if(isset($_POST['YiiAgency'])){
			
		    $agencyuser->attributes=$_POST['YiiAgency'];
			$valid = $agencyuser->validate();
				
			if($valid){
				if($agencyuser->save())
					$this->redirect(array('update','msg'=>'successfully updated profile'));
				else
					$this->redirect(array('update','msg'=>'profile not updated'));
			}
	    }
		
		
		if(isset($_POST['YiiChannel'])){
			
		    $channeluser->attributes=$_POST['YiiChannel'];
			$valid = $channeluser->validate();
			
			if($valid){
				if($channeluser->save())
					$this->redirect(array('update','msg'=>'successfully updated profile'));
				else
					$this->redirect(array('update','msg'=>'profile not updated'));
			}
	    }
		
		
		//$this->render('update',array('model'=>$model,'channeluser'=>$channeluser));
		
		if($utype==='C')
		  $this->render('update',array('model'=>$model,'channeluser'=>$channeluser));
		else
		  $this->render('update',array('model'=>$model,'agencyuser'=>$agencyuser));

	}
	
	
	
	public function actionSetting22(){
		
		if(!isset(Yii::app()->session['uid'])){
			$this->redirect(array('/site'));
			exit;
		}
	   
	    $model = new User;
		$uid = Yii::app()->session['uid'];
		$utype = Yii::app()->session['utype'];
		
		$model = User::model()->findByAttributes(array('Id'=>$uid));
		
		
		$agencyuser = YiiAgency::model()->findByAttributes(array('LoginId'=>$model->LoginId));
		$channeluser = YiiChannel::model()->findByAttributes(array('LoginId'=>$model->LoginId));
		
		if(isset($_POST['YiiAgency'])){
			
		    $agencyuser->attributes=$_POST['YiiAgency'];
			$valid = $agencyuser->validate();
				
			if($valid){
				if($agencyuser->save())
					$this->redirect(array('setting','msg'=>'successfully updated profile'));
				else
					$this->redirect(array('setting','msg'=>'profile not updated'));
			}
	    }
		
		
		if(isset($_POST['YiiChannel'])){
			
		    $channeluser->attributes=$_POST['YiiChannel'];
			$valid = $channeluser->validate();
			
			if($valid){
				if($channeluser->save())
					$this->redirect(array('setting','msg'=>'successfully updated profile'));
				else
					$this->redirect(array('setting','msg'=>'profile not updated'));
			}
	    }
		
		
		//$this->render('setting',array('model'=>$model,'channeluser'=>$channeluser));
		
		if($utype==='C')
		  $this->render('setting',array('model'=>$model,'channeluser'=>$channeluser));
		else
		  $this->render('setting',array('model'=>$model,'agencyuser'=>$agencyuser));

	}
	
	
	public function actionSubscribe()
	{
		$this->render('subscribe');
	}
	
	public function actionProfile()
	{
		
		$model=new User;
		$uid = Yii::app()->session['uid'];
		$utype = Yii::app()->session['utype'];
		
		$model = User::model()->findByAttributes(array('Id'=>$uid));
		
		if($utype==='C'){
			$channeluser = YiiChannel::model()->findByAttributes(array('LoginId'=>$model->LoginId));
			$this->render('profile',array('model'=>$model,'channeluser'=>$channeluser));
		}
		else{
			$agencyuser = YiiAgency::model()->findByAttributes(array('LoginId'=>$model->LoginId));
			$this->render('profile',array('model'=>$model,'agencyuser'=>$agencyuser));
		}
		
		
	}
	
	
	public function actionProfile33()
	{
		
	  $this->render('profile',array('model'=>$model));
	}
	
	public function actionProfile22()
	{
	  
	  $aid = Yii::app()->session['uid'];
		//$dataProvider=new CActiveDataProvider('YiiAgencyChannel');
	
		$rawData=Yii::app()->db->createCommand("SELECT a.Id, a.ChannelId, a.AgencyId, a.Status, c.ChannelName, c.ChannelLogo FROM yii_agency_channel a LEFT OUTER JOIN yii_agency b ON a.AgencyId = b.Id LEFT OUTER JOIN yii_channel c ON a.ChannelId = c.Id LEFT OUTER JOIN credential d ON b.LoginId = d.LoginId WHERE d.Id = ".$aid)->queryAll();
		// or using: $rawData=User::model()->findAll();
		$dataProvider=new CArrayDataProvider($rawData, array(
			'id'=>'user',
			'sort'=>array(
				'attributes'=>array(
					 'Status',
				),
			),
			/*'pagination'=>array(
				'pageSize'=>10,
			),*/
		));

		$this->render('profile',array(
			'dataProvider'=>$dataProvider,
		));
		
	  //$this->render('profile');
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}


	public function actionAjaxCrop()
	{
	
	 $this->render('ajaxcrop');
	}
	public function actionDocrop()
	{
	  Yii::import('ext.jcrop.EJCropper');
	  $assetsDir = dirname(__FILE__).'/../assets';
	 // $imagetobecroped='689x1000.jpg';
	  $imagetobecroped='images.jpeg';
	  
	 //print_r($_REQUEST);
	  //exit;
	  $jcropper = new EJCropper();
	  $jcropper->thumbPath = $assetsDir."/cropedimage";
	  
	  // some settings ...
	  $jcropper->jpeg_quality = 95;
	  $jcropper->png_compression = 8;
	  
	  // get the image cropping coordinates (or implement your own method)
	   $coords = $jcropper->getCoordsFromPost('imageId');
	  
	  // returns the path of the cropped image, source must be an absolute path.
	  $thumbnail = $jcropper->crop($assetsDir."/". $imagetobecroped, $coords);
	} 
        public function actionIcrop()
        {
         Yii::import('ext.icrop.Icrop');
         $this->render("icrop");
        }

        public function actionIcropApi()
        {
         Yii::import('ext.icrop.Icrop');
         $this->render("icropapi");
        } 
        
      
		public function actionSuccess()
        {
          $this->render('success');
        }
       
}
