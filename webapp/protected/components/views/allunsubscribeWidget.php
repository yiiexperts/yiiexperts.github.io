<h4>UNSUBSCRIBE CHANNELS</h4>
<div class="channel-content unsubscribe-list">
<?php
 $aid = Yii::app()->session['uid'];
	
 $sql = Yii::app()->db->createCommand();
 $sql->setFetchMode(PDO::FETCH_OBJ);
 
 $sql->select('a.Id, a.ChannelName As ChannelName, a.ChannelLogo As ChannelLogo')->from('yii_channel a')->leftjoin('yii_agency_channel b', 'a.Id=b.ChannelId')->leftjoin('yii_channel c', 'b.AgencyId=c.Id')->leftjoin('credential d', 'c.LoginId = d.LoginId')->where('b.Id is NULL')->order('rand()');
 
	
 foreach ($sql->queryAll() as $row) {
	//echo $row->Id;
	echo "<div  id='unsublist$row->Id' class='col-md-4 col-sm-6'>";
	echo "<div class='mind-box'>";
	echo "<div class='preview'><p class='thumb'>";
	echo CHtml::image(Yii::app()->request->baseUrl."/images/".$row->ChannelLogo);
	echo "</p></div>";
	echo "<h4 class='mind-box-title'>".CHtml::link($row->ChannelName,array('channel/detail','id'=>$row->Id))."</h4>";
	echo "<div class='spot-booking'>";
	echo "<div class='available-spot'><span class='fa fa-video-camera'> <span>11 mins</span></span></div>";
	
	//echo CHtml::link('Book Now',array('channel/view','id'=>$row->Id),array('class'=>'spot-book-now'));
	
	echo CHtml::ajaxLink('Subscribe', Yii::app()->createUrl('mychannels/subscribe'),
           array( // ajaxOptions
                'type' => 'POST',
                'beforeSend' => "function(request) {
					 $('div#unsublist' + $row->Id + ' .addas').removeClass('spot-book-now');
					 
                     $('div#unsublist' + $row->Id + ' .addas').html('".CHtml::image(Yii::app()->request->baseUrl."/images/load/ajax-loader-3.gif",'',array('class'=>'ajax-load'))."');  }",
				'success' => "function(data){ 
					$('div#unsublist' + $row->Id).fadeOut('slow', function () {
							$(this).remove();
						});
				 }",
				'error' => "function(er){ 
					$('div#unsublist' + $row->Id + ' .addas').addClass('spot-book-now');
					$('div#unsublist' + $row->Id + ' .addas').html('Subscribe'); }",
                'data' => array('id'=>$row->Id)
           ),
           array( //htmlOptions
                'href' => Yii::app()->createUrl('mychannels/subscribe'),
				'class' => 'addas spot-book-now',
           )
     );
	
	echo "</div></div>";
	echo "</div>";
 }

?>

  </div>