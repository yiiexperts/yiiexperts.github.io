<?php
$this->breadcrumbs=array(
	'Lmi Agency Channels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List YiiAgencyChannel', 'url'=>array('index')),
	array('label'=>'Manage YiiAgencyChannel', 'url'=>array('admin')),
);
?>

<h1>Create YiiAgencyChannel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>