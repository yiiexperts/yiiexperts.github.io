<?php
$this->breadcrumbs=array(
	'Lmi Agencies'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List YiiAgency', 'url'=>array('index')),
	array('label'=>'Create YiiAgency', 'url'=>array('create')),
	array('label'=>'Update YiiAgency', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete YiiAgency', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage YiiAgency', 'url'=>array('admin')),
);
?>

<h1>View YiiAgency #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'AgencyName',
		'FName',
		'LName',
		'Mobile',
		'Email',
		'Phone',
		'Address',
		'Status',
		'ModifiedOn',
		'LoginId',
		'Password',
	),
)); ?>
