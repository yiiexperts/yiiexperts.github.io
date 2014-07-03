<?php
$this->breadcrumbs=array(
	'Lmi Channels'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List YiiChannel', 'url'=>array('index')),
	array('label'=>'Create YiiChannel', 'url'=>array('create')),
	array('label'=>'View YiiChannel', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage YiiChannel', 'url'=>array('admin')),
);
?>

<h1>Update YiiChannel <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>