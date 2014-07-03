<?php
$this->breadcrumbs=array(
	'Lmi Agencies'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List YiiAgency', 'url'=>array('index')),
	array('label'=>'Create YiiAgency', 'url'=>array('create')),
	array('label'=>'View YiiAgency', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage YiiAgency', 'url'=>array('admin')),
);
?>

<h1>Update YiiAgency <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>