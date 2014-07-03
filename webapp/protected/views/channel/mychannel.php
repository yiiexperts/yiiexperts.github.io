<?php
/*$this->breadcrumbs=array(
	'Lmi Channels',
);*/

/*$this->menu=array(
	array('label'=>'Create YiiChannel', 'url'=>array('create')),
	array('label'=>'Manage YiiChannel', 'url'=>array('admin')),
);*/

$this->pageTitle=Yii::app()->name . ' | My Channels';
$this->breadcrumbs=array(
	'Lmi Channels'=>array('index'),
	'My Channels',
);
?>

<h2 class="section-title">My Channels</h2>

<?php 

/*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/ 

?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'ajaxtest-grid',
	'dataProvider'=>$dataProvider,
        'type'=>'striped bordered condensed',
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
		//'Id',
		'ChannelCode',
		'ChannelName',
		array(
		'name'=>'Status', // 
		'type'=>'raw',
		'value' =>'$data->Status? "Active": "Inactive"',
		),
		  //array('name'=>'Name', 'value'=>'$data->channelusers->Name'),
          array(
		     
		      'type'=>'raw',
		       'value'=>'"
		      <a href=\'javascript:return;\' onclick=\'renderView(".$data->Id.")\'   class=\'btn btn-small view\' ><i class=\'icon-eye-open\'></i></a>
		      <a href=\'javascript:return;\' onclick=\'renderUpdateForm(".$data->Id.")\'   class=\'btn btn-small view\' ><i class=\'icon-pencil\'></i></a>
		      <a href=\'javascript:return;\' onclick=\'delete_record(".$data->Id.")\'   class=\'btn btn-small view\' ><i class=\'icon-trash\'></i></a>
		     "',
		      'htmlOptions'=>array('style'=>'width:150px;')  
		     ),
        
	),
)); 


 //$this->renderPartial("_ajax_update");
 //$this->renderPartial("_ajax_view");

 ?>
