<?php
$this->pageTitle=Yii::app()->name . ' | Checkout';
$this->breadcrumbs=array(
	'Checkout',
);
?>
<div class="col-md-9 col-sm-8">
  <h4><span class="fa fa-shopping-cart"></span>&nbsp; Checkout</h4>
  <div class="channel-content">
   <div class="channel-spot-list full-width">
      <?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'mychannels-grid',
	'dataProvider'=>$dataProvider, //$model->users  //$dataProvider
	//'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
		'Sr',				
		'ProgramName',
		//'ChannelName',
		array('name'=>'ChannelName',
		     'type'=>'raw',
             'value'=>'CHtml::link("$data[ChannelName]", array("channel/detail","id"=>$data[ChannelId]), array("class"=>""))',
		      
		  ),
		array('name'=>'TeleCastDate',
		     'type'=>'raw',
             'value'=>'CHtml::link("$data[TeleCastDate]", array("channel/book","id"=>$data[ChannelId], "rel"=>$data[ut]), array("class"=>""))',
		      
		  ),
        'Schedule',
         array('name'=>'AvailableSpot',
		     'type'=>'raw',
             'value'=>'"<span class=\'avspot-".$data[Id]."\'>".$data[AvailableSpot]."</span>"',
		  ),
                
         'Rate',
            array('name'=>'Seconds',
		   		  'type'=>'raw',
                  'value'=>'CHtml::textField("Text", "$data[Seconds]", array("rel"=>$data[FPCId], "class"=>"inputsec", "width"=>30, "maxlength"=>4, "style"=>"width:30px"))',
		   'htmlOptions'=>array('style'=>'width:70px;')  
		  ),
            array(
		     'name'=>'Del',
		      'type'=>'raw',
		       'value'=>'"<a href=\'javascript:return;\' onclick=\'delete_record33(".$data[Id].")\'   class=\'btn btn-small view\' ><i class=\'icon-trash\'></i></a>
		     "',
		      'htmlOptions'=>array('style'=>'width:30px;')  
		     ),
            
	),
          'htmlOptions'=>array('style'=>'padding-top:0px;')
));
      
?>  
 </div>
 
 <div class="clearfix"></div>
 <div class="channel-spot-list full-width">
 <?php
	 $sessionId = Yii::app()->session->sessionID;
	 $aid = get_agency_id();

	 $sql = Yii::app()->db->createCommand();
	 $sql->setFetchMode(PDO::FETCH_OBJ);
 
	 $sql->select('Id, AgencyId, count(*) As channel, sum(Seconds) As second')->from('yii_temp_fpc')->where('AgencyId = '.$aid.' AND SessionId = "'.$sessionId.'" AND Seconds > 0')->group('AgencyId, SessionId')->limit('1');
	 
	 foreach ($sql->queryAll() as $row) { 
	 	$channel = $row->channel;
		$second = $row->second;
	 }
?>
 <div class="checkout-cart">
 <table class="table table-bordered table-striped checkout-cart-table">
    <tr>
      <td class="width-40">Total Channels</td>
      <td class="width-60"><span class="tchannel"><?php echo $channel; ?></span></td>
    </tr>
    <tr>
      <td>Total Seconds</td>
      <td><span class="tsecond"><?php echo $second; ?></span></td>
    </tr>
    <tr>
      <td>Total Amount</td>
      <td><span class="tsecond"><?php echo $amount; ?></span></td>
    </tr>
  </table>
 </div>
  </div>
    
  </div>
</div>

