<?php
$this->breadcrumbs=array(
	'Lmi Channels'=>array('index'),
	$model->Id,
);

$timestamp = isset($_GET['rel'])?$_GET['rel']:strtotime(date('Y-m-d'));
$date = date('Y-m-d', $timestamp);

?>

<div id="channel-list" class="col-md-9 col-sm-8">
  <div class="channel-content">
    <?php

$sql = Yii::app()->db->createCommand();
$sql->setFetchMode(PDO::FETCH_OBJ); //fetch each row as Object
$sql->select()->from('yii_channel')->where('Id = '.$model->Id.' AND Status = 0');

foreach ($sql->queryAll() as $row) { ?>
    <div>
      <div class="mind-box">
        <div class="big-preview"><?php echo CHtml::image(Yii::app()->request->baseUrl."/images/".$row->ChannelLogo); ?></div>
        <h4 class="mind-box-big-title"><?php echo CHtml::link($row->ChannelName,array('channel/book','id'=>$model->Id),array('class'=>'spot-book-now')); ?></h4>
        <div class="channel-descriptions"><?php echo $row->ChannelDescription; ?></div>
        <div class="spot-booking view-booking">
          <div class="available-spot"><span class="fa fa-video-camera"> <span><?php echo get_spot_availabilty($model->Id); ?></span></span></div>
          <div class="spot-time"><span class="fa fa-calendar-o"> <span>Today</span></span></div>
          <?php echo CHtml::link('Book Now',array('channel/book','id'=>$model->Id),array('class'=>'spot-book-now')); ?></div>
      </div>
    </div>
    <?php }
?>
  </div>
 
<div class="channel-spot-list full-width margin-top-20">
    <h4>Available Spot Details</h4>
      <?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'mychannels-grid',
	'dataProvider'=>$dataProvider, //$model->users  //$dataProvider
	//'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
		//'Id',				
		'ChannelName',
                'AvailableSpot',
                'TeleCastDate',
                //'ut',
            array( 'name'=>'Action',
		   'type'=>'raw',
		      //'value'=>'"<a href=\'#\'  class=\'btn btn-small view\' >Book Now</a>"',
                      //'value'=>"CHtml::link('Book Now', array('channel/book','id'=>".$data['Id']."), array('class'=>'btn btn-small view'))",
                      'value'=>'CHtml::link("Book Now", array("channel/book","id"=>$data[Id],"rel"=>$data[ut]), array("class"=>"btn btn-small view"))',
		      'htmlOptions'=>array('style'=>'width:100px;')  
		     ),
	),
          'htmlOptions'=>array('style'=>'padding-top:0px;')
)); 
?>  
 </div>
</div>      

<div class="col-md-3 col-sm-24">
  <?php

if(isset(Yii::app()->session['uid']) && Yii::app()->session['utype']==='A'){
    
 $this->widget('MycartWidget', array(
   'crumbs' => array(
    array('name' => 'My cart list')
   )
 ));
}

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
<?php 

/*$this->widget('bootstrap.widgets.TbDetailView',array(
   'type'=>'bordered condensed',
   'data'=>$model,
   'attributes'=>array(
       'Id',
       array('name' => 'Status', 'type' => 'text', 'value' => '1'),
   ),
));

$this->widget('zii.widgets.CDetailView', array(
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
)); 
*/
?>
