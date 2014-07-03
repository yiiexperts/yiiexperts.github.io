<div class="suggestions">
    <div class="title">Suggestions</div>
    <ul id="subscribe">
<?php
 $aid = Yii::app()->session['uid'];
	
 $sql = Yii::app()->db->createCommand();
 $sql->setFetchMode(PDO::FETCH_OBJ);
 
 $sql->select('a.Id, a.ChannelName, a.ChannelLogo')->from('yii_channel a')->leftjoin('yii_agency_channel b', 'a.Id=b.ChannelId')->leftjoin('yii_channel c', 'b.AgencyId=c.Id')->leftjoin('credential d', 'c.LoginId = d.LoginId')->where('b.Id is NULL')->order('rand()')->limit('10');
 
	
	foreach ($sql->queryAll() as $row) { 

	  echo "<li id='list$row->Id'>";
	  echo CHtml::image(Yii::app()->request->baseUrl."/images/".$row->ChannelLogo);
	  echo "<span class='del'><a href='#' class='delete' title='remove' id='$row->Id'>X</a></span>";
	  echo CHtml::link(CHtml::encode($row->ChannelName),array('channel/view','id'=>$row->Id),array('class'=>'channel-title'));
	  echo CHtml::link('Subscribe',array('channel/view'),array('class'=>'addas btn btn-small view','id'=>$row->Id));
	  //echo "<a class='addas btn btn-small view'>Subscribe</a>";
	  echo "</li>";
	}

?>
    </ul>
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
	
	$(".addas").live('click',function() {
        var element = $(this);
		var I = element.attr("id");
        alert(I);
        return false;
    });
});
</script>