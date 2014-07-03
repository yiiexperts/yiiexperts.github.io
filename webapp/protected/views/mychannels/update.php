<?php
$this->breadcrumbs=array(
	'Lmi Agency Channels'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List YiiAgencyChannel', 'url'=>array('index')),
	array('label'=>'Create YiiAgencyChannel', 'url'=>array('create')),
	array('label'=>'View YiiAgencyChannel', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage YiiAgencyChannel', 'url'=>array('admin')),
);
?>

<h1>Update YiiAgencyChannel <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>