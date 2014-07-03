<?php
$this->breadcrumbs=array(
	'Lmi Agencies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List YiiAgency', 'url'=>array('index')),
	array('label'=>'Manage YiiAgency', 'url'=>array('admin')),
);
?>

<h1>Create YiiAgency</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>