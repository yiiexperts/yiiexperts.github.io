<?php
if(isset(Yii::app()->session['uid'])){
	$this->redirect(array('/site'));
}

$this->pageTitle=Yii::app()->name . ' | Create Broadcaster Account';
$this->breadcrumbs=array(
	'Lmi Channels'=>array('index'),
	'Register',
);
?>

<h2 class="section-title">Create Broadcaster Account</h2>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>