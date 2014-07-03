<?php
if(isset(Yii::app()->session['uid'])){
	$this->redirect(array('/site'));
}

$this->pageTitle=Yii::app()->name . ' | Create Agency Account';
$this->breadcrumbs=array(
	'Lmi Agencies'=>array('index'),
	'Create',
);
?>

<h2 class="section-title">Create Agency Account</h2>
<?php 
echo $this->renderPartial('_form', array('model'=>$model, 'channelagency'=>$channelagency)); 
?>