<?php
$this->pageTitle=Yii::app()->name . ' | Reset Password';
$this->breadcrumbs=array(
	'Lmi Channels'=>array('setting'),
	'Reset Password',
);

$uid = Yii::app()->session['uid'];
$utype = Yii::app()->session['utype'];
?>

<h2 class="section-title">Reset Password</h2>
<?php
 if($utype==='C')
	echo $this->renderPartial('_reset_password_form', array('model'=>$model,'channeluser'=>$channeluser));
 else
	echo $this->renderPartial('_reset_password_form', array('model'=>$model,'agencyuser'=>$agencyuser))
?>