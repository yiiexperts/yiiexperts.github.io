<?php
$this->pageTitle=Yii::app()->name . ' | Create Broadcaster Account';
$this->breadcrumbs=array(
	'Lmi Channels'=>array('index'),
	'Create',
);
?>

<h2 class="section-title">Create Broadcaster Account</h2>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>