<?php

$this->pageTitle=Yii::app()->name . ' | Update Profile';
$this->breadcrumbs=array(
	'Lmi Agencies'=>array('update'),
	'Create',
);
?>

<!--<h2 class="section-title">Create Agency Account</h2>-->
<?php 
$uid = Yii::app()->session['uid'];
$utype = Yii::app()->session['utype'];

//print_r($channeluser);

 if($utype==='C')
	echo $this->renderPartial('_form', array('model'=>$model, 'channeluser'=>$channeluser));
 else
	echo $this->renderPartial('_form', array('model'=>$model, 'agencyuser'=>$agencyuser));
?>