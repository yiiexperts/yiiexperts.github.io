<?php
if(!isset(Yii::app()->session['uid'])){
	$this->redirect(array('/site'));
}

$this->breadcrumbs=array(
	'Lmi Channels'=>array('index'),
	$model->Id,
);

$utype = Yii::app()->session['utype'];
?>

<div id="user-info" class="col-md-9 col-sm-8">
<div id="general" class="user-details">
      <div class="panel panel-primary">
        <div class="panel-heading"><i class="fa fa-user"></i> General Information <p><?php echo CHtml::link('Update',array('site/update','rel'=>'update-details')); ?></p></div>
<?php  //CHtml::image(Yii::app()->request->baseUrl."/images/".$row->ChannelLogo);

if($utype === 'C'){
	$this->widget('bootstrap.widgets.TbDetailView',array(
	   'type'=>'bordered striped',
	   'data'=>$channeluser,
	   'attributes'=>array(
		  // 'Id',
		   array('name' => 'ChannelName', 'type' => 'raw', 'value' => $data->ChannelName),
		   array('name' => 'ChannelCode', 'type' => 'raw', 'value' => $data->ChannelCode),
		   array('name' => 'FName', 'type' => 'raw', 'value' => $data->FName),
		   array('name' => 'LName', 'type' => 'raw', 'value' => $data->LName),
		   array('name' => 'Mobile', 'type' => 'raw', 'value' => $data->Mobile),
		   array('name' => 'Phone', 'type' => 'raw', 'value' => $data->Phone),
		   array('name' => 'ChannelDescription', 'type' => 'raw', 'value' => $data->ChannelDescription),
		   array('name' => 'CreatedOn', 'type' => 'raw', 'value' => date_format(new DateTime($data->CreatedOn), 'd M, Y'),),
		   //array('name'=>'ChannelLogo','type'=>'image','value' => $data->ChannelLogo),
	   ),
	));
}
else{
	$this->widget('bootstrap.widgets.TbDetailView',array(
	   'type'=>'bordered striped',
	   'data'=>$agencyuser,
	   'attributes'=>array(
		 //  'Id',
		   array('name' => 'AgencyName', 'type' => 'raw', 'value' => $data->AgencyName),
		   array('name' => 'FName', 'type' => 'raw', 'value' => $data->FName),
		   array('name' => 'LName', 'type' => 'raw', 'value' => $data->LName),
		   array('name' => 'Mobile', 'type' => 'raw', 'value' => $data->Mobile),
		   array('name' => 'Phone', 'type' => 'raw', 'value' => $data->Phone),
		   array('name' => 'Address', 'type' => 'raw', 'value' => $data->Address),
		   array('name' => 'CreatedOn', 'type' => 'raw', 'value' => date_format(new DateTime($data->CreatedOn), 'd M, Y'),),
	   ),
	));
}
?>
 </div>
</div>

<div id="login" class="user-details">
 <div class="panel panel-primary">
   <div class="panel-heading"><i class="fa fa-user"></i> Login Information <p><?php echo CHtml::link('Update',array('site/setting','rel'=>'change-password')); ?></p></div>
<?php 
$this->widget('bootstrap.widgets.TbDetailView',array(
   'type'=>'bordered striped',
   'data'=>$model,
   'attributes'=>array(
       array('name' => 'Email', 'type' => 'raw', 'value' => $data->Email),
	   array('name' => 'Password', 'type' => 'raw', 'value' => '*******'),
       array('name' => 'Status', 'type' => 'raw', 'value' =>($data->Status==1)? '<span class=\'label label-important\'>Inactive</span>':'<span class=\'label label-success\'>Active</span>'),
    ),
  ));
?>
  </div>
 </div>
</div>


<div class="col-md-3 col-sm-24">
  <?php
$this->widget('FeaturedWidget', array(
  'crumbs' => array(
   array('name' => 'Featured channels list')
  )
));

if(isset(Yii::app()->session['uid']) && Yii::app()->session['utype']==='A'){

$this->widget('SuggestionWidget', array(
  'crumbs' => array(
   array('name' => 'Unsubscribe channels list')
  )
));
}
?>
</div>
