<?php
$this->breadcrumbs=array(
	'Lmi Agencies',
);

$this->menu=array(
	array('label'=>'Create YiiAgency', 'url'=>array('create')),
	array('label'=>'Manage YiiAgency', 'url'=>array('admin')),
);
?>

<h1>Lmi Agencies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
