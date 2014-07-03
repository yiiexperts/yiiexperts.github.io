<?php

class MychannelsController extends Controller
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','subscribe','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
	/*public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}*/
	
	
	public function actionView()
	{
		$id = $_REQUEST["id"];
	     
	       if(Yii::app()->request->isAjaxRequest)
	       {
	        $model=$this->loadModel($id);

			$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'button',
				'type'=>'primary',
				'icon'=>'trash white', 
				'label'=>'Delete',
				'htmlOptions'=>array('onclick'=>'delete_record('.$model->Id.');'),
			));
			
			echo " ";
			$this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'button',
				'type'=>'primary',
				'icon'=>'print white', 
				'label'=>'Print',
				'htmlOptions'=>array('onclick'=>'print();'),
			));
			
			
			 echo "<div class='printableArea'>";
				 echo "<div class='channel-logo-small'>".CHtml::image(Yii::app()->request->baseUrl."/images/".$model->channel->ChannelLogo)."</div><hr />";
				 
				 $this->widget('bootstrap.widgets.TbDetailView',array(
				 'type'=>'striped bordered condensed',
				'data'=>$model,
				'attributes'=>array(
					//'Id',
					//'ChannelId',
					//'AgencyId',
					//'channel.ChannelName',
					/*array(
					'name'=>'Status', // 
					'type'=>'raw',
					'value'=>CHtml::encode($model->channel->ChannelName),
					),*/
		
					array(              
					'label'=>'Channel',
					'type'=>'raw',
					'value'=>CHtml::link(CHtml::encode($model->channel->ChannelName),
							array('channel/detail','id'=>$model->channel->Id)),
				    ),
					array(
					'name'=>'Status', // 
					'type'=>'raw',
					'value'=>(CHtml::encode($model->Status)==1)? "<span class=\"label label-important\">Inactive</span>":"<span class=\"label label-success\">Active</span>",
					),
					array(              
					'label'=>'Spots Available',
					'type'=>'raw',
					'value'=>CHtml::link('Book Now',
						array('channel/book','id'=>$model->channel->Id),
						array('class' => 'btn btn-primary btn-small')),
				    ),

				),
			));
		
	         echo "</div>";
	      
	        
	       }
	       else
	       {
			   
			   $this->render('view',array(
					'model'=>$this->loadModel($id),
				));

	  }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new YiiAgencyChannel;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['YiiAgencyChannel']))
		{
			$model->attributes=$_POST['YiiAgencyChannel'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Id));
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

		if(isset($_POST['YiiAgencyChannel']))
		{
			$model->attributes=$_POST['YiiAgencyChannel'];
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
	/*public function actionDelete($id)
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
	}*/
	
	
	
	public function actionDelete()
	{
	    $id=$_POST["id"];
	   
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model=$this->loadModel($id);
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset(Yii::app()->request->isAjaxRequest))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			else
			   echo "true";
		}
		else
		{
		    if(!isset($_GET['ajax']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		    else
			   echo "false"; 	
	        }	
	}

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('YiiAgencyChannel');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/
	
	public function actionIndex()
	{
		if(!isset(Yii::app()->session['uid']) || Yii::app()->session['utype']!='A'){
			$this->redirect(array('/site'));
			exit;
		}
		
		$aid = Yii::app()->session['uid'];
		//$dataProvider=new CActiveDataProvider('YiiAgencyChannel');
	
		$rawData=Yii::app()->db->createCommand("SELECT a.Id, a.ChannelId, a.AgencyId, a.Status, c.ChannelName, c.ChannelLogo FROM yii_agency_channel a LEFT OUTER JOIN yii_agency b ON a.AgencyId = b.Id LEFT OUTER JOIN yii_channel c ON a.ChannelId = c.Id LEFT OUTER JOIN credential d ON b.LoginId = d.LoginId WHERE d.Id = ".$aid)->queryAll();
		
		/*$rawData = Yii::app()->db->createCommand();
		$rawData->select('a.Id, a.ChannelId, a.AgencyId, a.Status, c.ChannelName, c.ChannelLogo')
		->from('yii_agency_channel a')
		->leftjoin('yii_agency b','a.AgencyId = b.Id')
		->leftjoin('yii_channel c','a.ChannelId = c.Id')
		->leftjoin('credential d','b.LoginId = d.LoginId')
		->where('d.Id = '.$aid);
		
		$rawData->queryAll();*/
		
		
		//$sql->select()->from('yii_channel')->where('Id = '.$model->Id.' AND Status = 0');
		// or using: $rawData=User::model()->findAll();
		$dataProvider=new CArrayDataProvider($rawData, array(
			'id'=>'user',
			'sort'=>array(
				'attributes'=>array(
					 'Id', 'AgencyId', 'ChannelId', 'Status', 'ChannelName', 'ChannelLogo',
				),
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	public function actionSubscribe()
	{
		$uid = Yii::app()->session['uid'];
		$cid = $_POST['id'];
		$aid = get_agency_id();
                
		  
	$count = YiiAgencyChannel::model()->countByAttributes(array(
            'AgencyId' => $aid, 'ChannelId' => $cid
            ));
		
		
		//$aid = UserInfo::is_home_page();
		
	if(Yii::app()->request->isAjaxRequest){
		
	 $count = YiiAgencyChannel::model()->countByAttributes(array(
            'AgencyId' => $aid, 'ChannelId' => $cid
         ));
		
		if($count==0){
			
			$caid1 = rand(0,999);
			$caid2 = rand(0,999);
			
			$mid = $caid1.$cid.$caid2.$cid;
			
			
			$sql = "INSERT INTO yii_agency_channel (Id, AgencyId, ChannelId) values (:Id, :AgencyId, :ChannelId)";
			$parameters = array(':Id' => $mid, ':AgencyId' => $aid, ':ChannelId' => $cid);
		
			/*$sql = "INSERT INTO yii_agency_channel (AgencyId, ChannelId) values (:AgencyId, :ChannelId)";
			$parameters = array(":AgencyId" => $aid, ':ChannelId' => $cid);*/
			Yii::app()->db->createCommand($sql)->execute($parameters);
			
			echo 'true';
		}
		else
		    echo 'false';
			
			Yii::app()->end();
		}
		else
		   $this->redirect(array('site/subscribe'));
		  
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new YiiAgencyChannel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['YiiAgencyChannel']))
			$model->attributes=$_GET['YiiAgencyChannel'];

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
		$model=YiiAgencyChannel::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='lmi-agency-channel-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
