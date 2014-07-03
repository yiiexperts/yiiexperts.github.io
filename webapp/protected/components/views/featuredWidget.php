<div class="featured">
    <div class="title">Featured</div>
    <ul id="featured">
<?php
 $aid = Yii::app()->session['uid'];
	
 $sql = Yii::app()->db->createCommand();
 $sql->setFetchMode(PDO::FETCH_OBJ);
 
 $sql->select('a.Id, a.ChannelName, a.ChannelLogo, b.AgencyId As AgencyId, b.ChannelId As ChannelId')->from('yii_channel a')->leftjoin('yii_agency_channel b', 'a.Id=b.ChannelId')->leftjoin('yii_channel c', 'b.AgencyId=c.Id')->leftjoin('credential d', 'c.LoginId = d.LoginId')->order('rand()')->limit('1');
 
 //->where('b.Id is NULL')
	
	foreach ($sql->queryAll() as $row) { 
	
	$count = YiiAgencyChannel::model()->countByAttributes(array(
            'AgencyId' => $row->AgencyId, 'ChannelId' => $row->ChannelId
        ));
	
	  //$color = rand(1,10);

	  echo "<li id='featured-list' class='rstyle'>";
	  echo CHtml::image(Yii::app()->request->baseUrl."/images/".$row->ChannelLogo);
	  echo "<span class='del'><a href='#' class='featured-delete' title='remove' id='$row->Id'>X</a></span>";
	  echo CHtml::link(CHtml::encode($row->ChannelName),array('channel/detail','id'=>$row->Id),array('class'=>'channel-title'));
	  
	  
	 if($count==0 && isset(Yii::app()->session['uid'])){
		echo CHtml::ajaxLink('Subscribe', Yii::app()->createUrl('mychannels/subscribe'),
           array( // ajaxOptions
                'type' => 'POST',
                'beforeSend' => "function(request) {
                     $('li#featured-list .addas').html('".CHtml::image(Yii::app()->request->baseUrl."/images/load/ajax-loader-3.gif",'',array('class'=>'ajax-load'))."');  }",
				'success' => "function(data){ 
					 $('li#featured-list .addas').html('Book Now');
					 $('li#featured-list .addas').removeAttr('id');
					 $('li#featured-list .addas').attr('href', '".Yii::app()->createUrl('channel/book',array('id'=>$row->Id))."');
					 $('li#featured-list .addas').addClass('btn btn-small view');
					 $('li#featured-list .view').removeClass('addas');
					  }",
				'error' => "function(er){ $('li#featured-list .addas').html('Subscribe'); }",
                'data' => array('id'=>$row->Id)
           ),
           array( //htmlOptions
                'href' => Yii::app()->createUrl('mychannels/subscribe'),
				'class' => 'addas btn btn-small view',
           )
       ); 
	 }
	 else{
		echo CHtml::link('Book Now',array('channel/book','id'=>$row->Id),array('class'=>'btn btn-small view'));
	 }

	  echo "</li>";
	}

?>
</ul>
<table class="table table-bordered table-striped featured-table">
  <tr><td class="featured-date"><span class='fa fa-calendar-o'> <span>18, Jun</span></span></td><td class="featured-spots"><span class='fa fa-video-camera'> <span>1200 sec</span></span></td></tr>
  <tr><td class="featured-date"><span class='fa fa-calendar-o'> <span>19, Jun</span></span></td><td class="featured-spots"><span class='fa fa-video-camera'> <span>1500 sec</span></span></td></tr>
  <tr><td class="featured-date"><span class='fa fa-calendar-o'> <span>21, Jun</span></span></td><td class="featured-spots"><span class='fa fa-video-camera'> <span>1350 sec</span></span></td></tr>
  </table>
</div>

<script type="text/javascript" >
$(function () {
    $(".featured-delete").live('click',function() {
		$('.featured').fadeOut('slow');
		//$('.featured').remove();
        return false;
    });
	
});
</script>