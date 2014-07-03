<?php
$this->breadcrumbs=array(
	'Lmi Channels',
);

$this->menu=array(
	array('label'=>'Create YiiChannel', 'url'=>array('create')),
	array('label'=>'Manage YiiChannel', 'url'=>array('admin')),
);
?>

<h1>Lmi Channels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
