<?php
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Lmi'=>array('index'),
	'Lmi',
);
?>

<div id="channel-list" class="col-md-9 col-sm-8">
<?php
if(isset(Yii::app()->session['uid']) && Yii::app()->session['utype']==='A'){

$aid = get_agency_id();

$sql = Yii::app()->db->createCommand();
$sql->setFetchMode(PDO::FETCH_OBJ); //fetch each row as Object
 
//$sql->select()->from('yii_channel');

$sql->select('a.Id, a.AgencyId As AgencyId, a.ChannelId As ChannelId, c.ChannelName As ChannelName, c.ChannelLogo As ChannelLogo')->leftjoin('yii_agency b','a.AgencyId = b.Id')->leftjoin('yii_channel c','a.ChannelId = c.Id')->from('yii_agency_channel a')->where('b.Id = '.$aid.' AND a.Status = 0')->order('rand()');

$count = count($sql->queryAll());

if($count!=0){

?>
  <h4>SUBSCRIBED CHANNELS</h4>
  <div class="channel-content subscribe-list">
<?php

foreach ($sql->queryAll() as $row) {
	//echo $row->Id;
	echo "<div class='col-md-5 col-sm-6'>";
	echo "<div class='mind-box mind-box-sml'>";
	echo "<div class='sml-preview'>";
	echo CHtml::image(Yii::app()->request->baseUrl."/images/".$row->ChannelLogo);
	echo "</div>";
	echo "<h4 class='mind-box-sml-title'>".CHtml::link($row->ChannelName,array('channel/detail','id'=>$row->ChannelId))."</h4>";
	echo "<div class='spot-booking'>";
	echo "<div class='available-spot'><span class='fa fa-video-camera'> <span>12 mins</span></span></div>";
	echo "<div class='spot-time'><span class='fa fa-calendar-o'> <span>".date('d M, Y')."</span></span></div>";
	echo CHtml::link('Book Now',array('channel/book','id'=>$row->ChannelId),array('class'=>'spot-book-now'));
	echo "</div></div>";
	echo "</div>";
 }

?>
  </div>
  <div class="clearfix"></div>
  <div class="hr-divide"></div>
  <?php }
	} ?>
  <?php 
if(isset(Yii::app()->session['uid']) && Yii::app()->session['utype']==='A'){ 
   $this->widget('UnsubscribeWidget', array(
    'crumbs' => array(
     array('name' => 'Unsubscribe channels list')
    )
  ));
}
?>
</div>
<div class="col-md-3 col-sm-24">
<?php

if(Yii::app()->session['utype']!='C'){
	$this->widget('FeaturedWidget', array(
	  'crumbs' => array(
	   array('name' => 'Featured channels list')
	  )
  ));
}
?>
</div>
