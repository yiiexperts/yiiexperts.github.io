<?php
$this->pageTitle=Yii::app()->name . ' | Successfully Registration';
$this->breadcrumbs=array(
	'Success',
);
?>
<?php

if(isset(Yii::app()->session['csuccess'])){ //Channel Registration

	$scid = Yii::app()->session['csuccess'];

	$dbC = Yii::app()->db->createCommand();
	$dbC->setFetchMode(PDO::FETCH_OBJ); //fetch each row as Object
 
	$dbC->select('Id, ChannelCode, ChannelName, FName, LName, Email')->where('Id='.$scid)->from('yii_channel');
	
	foreach ($dbC->queryAll() as $row) {
	  $uname = $row->FName;
	  $email = $row->Email;
	}
	
	unset(Yii::app()->session['csuccess']);
	Yii::app()->session->clear();
	Yii::app()->session->destroy();	
}

else if(isset(Yii::app()->session['asuccess'])){ //Agency Registration

	$scid = Yii::app()->session['asuccess'];

	$dbC = Yii::app()->db->createCommand();
	$dbC->setFetchMode(PDO::FETCH_OBJ); //fetch each row as Object
 
	$dbC->select('Id, AgencyName, FName, LName, Email')->where('Id='.$scid)->from('yii_agency');
	
	foreach ($dbC->queryAll() as $row) {
	  $uname = $row->FName;
	  $email = $row->Email;
	}
	
	unset(Yii::app()->session['asuccess']);
	Yii::app()->session->clear();
	Yii::app()->session->destroy();	
}
else{
	//echo 'Not set';
	$this->redirect(array('site/login'));
}

  ?>

<h2 class="section-title">Account Created</h2>
<div class="alert in alert-block fade alert-success"><strong>Congrats! <?=$uname?></strong><br />Your account has been successfully created. Your login details has been sent on your registered email address <strong><?=$email?></strong>.</div>

