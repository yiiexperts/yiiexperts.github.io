<?php
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Lmi'=>array('index'),
	'Lmi',
);
?>

<div id="channel-list" class="col-md-9 col-sm-8">
<?php
//$aid = get_agency_id();

$sql = Yii::app()->db->createCommand();
$sql->setFetchMode(PDO::FETCH_OBJ); //fetch each row as Object

$sql->select("b.Id As ChannelId, b.ChannelName As ChannelName, b.ChannelLogo As ChannelLogo, sum(AvailableSpot) As fpc, CASE WHEN DATE(a.TeleCastDate) = DATE(NOW()) THEN 'Today' ELSE DATE_FORMAT(a.TeleCastDate,'%d %b %Y') END As TeleCastDate")
        ->from('yii_dialyfpc a')
        ->leftjoin('yii_channel b','a.ChannelCode = b.ChannelCode')
        ->where('a.TeleCastDate BETWEEN DATE(NOW()) AND DATE_ADD(DATE(NOW()), INTERVAL +1 MONTH) AND b.Status = 0')
        ->group('a.ChannelCode, a.TeleCastDate')
        ->order('a.TeleCastDate, rand()')
        ->limit('20');

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
	echo "<div class='available-spot'><span class='fa fa-video-camera'> <span>".$row->fpc." sec</span></span></div>";
	echo "<div class='spot-time'><span class='fa fa-calendar-o'> <span>".$row->TeleCastDate."</span></span></div>";
	echo CHtml::link('Book Now',array('channel/book','id'=>$row->ChannelId),array('class'=>'spot-book-now'));
	echo "</div></div>";
	echo "</div>";
 }

?>
  </div>
  <div class="clearfix"></div>
  <div class="hr-divide"></div>
<?php } ?>

</div>
<div class="col-md-3 col-sm-24">
<?php
$this->widget('FeaturedWidget', array(
	  'crumbs' => array(
	   array('name' => 'Featured channels list')
	  )
  ));
?>
</div>
