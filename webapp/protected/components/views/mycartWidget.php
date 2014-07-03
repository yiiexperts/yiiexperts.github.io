<?php
error_reporting(0);

$sessionId = Yii::app()->session->sessionID;
$aid = get_agency_id();
	 
$count = YiiTempfpc::model()->countByAttributes(array(
          'AgencyId' => $aid, 'SessionId' => $sessionId
    ));
	
if($count>0 || isset(Yii::app()->session->sessionID)){
?>
<div class="addcart">
  <div class="title">My Cart &nbsp;<span class="fa fa-shopping-cart"></span></div>
    <?php

	 $sql = Yii::app()->db->createCommand();
	 $sql->setFetchMode(PDO::FETCH_OBJ);
 
	 $sql->select('Id, AgencyId, count(*) As channel, sum(Seconds) As second')->from('yii_temp_fpc')->where('AgencyId = '.$aid.' AND SessionId = "'.$sessionId.'" AND Seconds > 0')->group('AgencyId, SessionId')->limit('1');
	 
	 foreach ($sql->queryAll() as $row) { 
	 	$channel = $row->channel;
		$second = $row->second;
	 }
?>
  <table class="table table-bordered table-striped addcart-table">
    <tr>
      <td class="width-40">Channels</td>
      <td class="width-60"><span class="tchannel"><?php echo $channel; ?></span></td>
    </tr>
    <tr>
      <td>Seconds</td>
      <td><span class="tsecond"><?php echo $second; ?></span></td>
    </tr>
  </table>
  <?php echo CHtml::link('checkout <span class="fa fa-angle-double-right"></span>',array('site/checkout'),array('class'=>'checkout')); ?>
</div>
<?php } ?>