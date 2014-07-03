<?php
$this->breadcrumbs=array(
	'Lmi Channels'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List YiiChannel', 'url'=>array('index')),
	array('label'=>'Create YiiChannel', 'url'=>array('create')),
	array('label'=>'Update YiiChannel', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete YiiChannel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage YiiChannel', 'url'=>array('admin')),
);
?>

<h1>View YiiChannel #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'ChannelName',
		'ChannelCode',
		'FName',
		'LName',
		'Mobile',
		'Phone',
		'Email',
		'Status',
		'wsldUrl',
		'LoginId',
		'Password',
	),
)); ?>
