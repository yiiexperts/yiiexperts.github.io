<div class="suggestions">
    <div class="title">Suggestions</div>
    <ul id="subscribe">
<?php
 $aid = Yii::app()->session['uid'];
	
 $sql = Yii::app()->db->createCommand();
 $sql->setFetchMode(PDO::FETCH_OBJ);
 
 $sql->select('a.Id, a.ChannelName, a.ChannelLogo')->from('yii_channel a')->leftjoin('yii_agency_channel b', 'a.Id=b.ChannelId')->leftjoin('yii_channel c', 'b.AgencyId=c.Id')->leftjoin('credential d', 'c.LoginId = d.LoginId')->where('b.Id is NULL')->order('rand()')->limit('10');
 
	
	foreach ($sql->queryAll() as $row) { 
	
	  $color = rand(1,10);

	  echo "<li id='list$row->Id' class='rstyle-$color'>";
	  echo CHtml::image(Yii::app()->request->baseUrl."/images/".$row->ChannelLogo);
	  echo "<span class='del'><a href='#' class='delete' title='remove' id='$row->Id'>X</a></span>";
	  echo CHtml::link(CHtml::encode($row->ChannelName),array('channel/detail','id'=>$row->Id),array('class'=>'channel-title'));
	  //echo CHtml::link('Subscribe','javascript:return false;',array('class'=>'addas btn btn-small view','id'=>$row->Id,'onclick'=>'subscribe_now('.$row->Id.')'));
	
	 
	 echo CHtml::ajaxLink('Subscribe', Yii::app()->createUrl('mychannels/subscribe'),
           array( // ajaxOptions
                'type' => 'POST',
                'beforeSend' => "function(request) {
                     $('li#list' + $row->Id + ' .addas').html('".CHtml::image(Yii::app()->request->baseUrl."/images/load/ajax-loader-3.gif",'',array('class'=>'ajax-load'))."');  }",
				'success' => "function(data){ 
				$('li#list' + $row->Id).fadeOut('slow', function () {
						$(this).remove();
					}); }",
				'error' => "function(er){ $('li#list' + $row->Id + ' .addas').html('Subscribe'); }",
                'data' => array('id'=>$row->Id)
           ),
           array( //htmlOptions
                'href' => Yii::app()->createUrl('mychannels/subscribe'),
				'class' => 'addas btn btn-small view',
           )
     );

	  
	  echo "</li>";
	}

?>
    </ul>
    <div class="title">
    <?php
	echo CHtml::link('view all',array('site/subscribe'),array('class'=>'view-all','id'=>'all-channels'));
	?>
    </div>
  </div>
<script type="text/javascript" >
$(function () {
    $(".delete").live('click',function() {
        var element = $(this);
        var I = element.attr("id");
        $('li#list' + I).fadeOut('slow', function () {
            $(this).remove();
        });
        return false;
    });
	
});
</script>