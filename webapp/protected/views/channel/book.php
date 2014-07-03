<?php
$this->breadcrumbs=array(
	'Lmi Channels'=>array('book'),
	$model->Id,
);

$timestamp = isset($_GET['rel'])?$_GET['rel']:strtotime(date('Y-m-d'));
$date = date('Y-m-d', $timestamp);
$fdate = date('d M, Y', $timestamp);

?>

<div id="channel-list" class="col-md-9 col-sm-8">
  <h4>Book Now</h4>
  <div class="channel-content">
    <?php
	$sql = Yii::app()->db->createCommand();
	$sql->setFetchMode(PDO::FETCH_OBJ); //fetch each row as Object
	$sql->select()->from('yii_channel')->where('Id = '.$model->Id.' AND Status = 0');
	
	foreach ($sql->queryAll() as $row) { ?>
    <div>
      <div class="mind-box">
        <div class="big-preview"><?php echo CHtml::image(Yii::app()->request->baseUrl."/images/".$row->ChannelLogo); ?></div>
        <h4 class="mind-box-big-title"><?php echo CHtml::link($row->ChannelName,array('channel/detail','id'=>$model->Id),array('class'=>'spot-book-now')); ?></h4>
        <div class="spot-booking view-booking">
          <div class="available-spot"><span class="fa fa-video-camera"> <span><?php echo get_spot_availabilty($model->Id); ?></span></span></div>
          <div class="spot-time"><span class="fa fa-calendar-o"> <span>Today</span></span></div>
          <?php echo CHtml::link('View Details',array('channel/detail','id'=>$model->Id),array('class'=>'spot-book-now')); ?></div>
      </div>
    </div>
    <?php }
	?>
    
   <div class="channel-spot-list full-width margin-top-20">
    <h4>Available Spot Details of <?php echo $fdate; ?></h4>
      <?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'mychannels-grid',
	'dataProvider'=>$dataProvider, //$model->users  //$dataProvider
	//'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
		'Sr',				
		'ProgramName',
                'TeleCastDate',
                'Schedule',
                array('name'=>'AvailableSpot',
		   'type'=>'raw',
                   'value'=>'"<span class=\'avspot-".$data[Id]."\'>".$data[AvailableSpot]."</span>"',
		  ),
                'Rate',
            array( 'name'=>'Seconds',
		   'type'=>'raw',
                   'value'=>'CHtml::textField("Text", "$data[Seconds]", array("rel"=>$data[Id], "class"=>"inputsec", "width"=>30, "maxlength"=>4, "style"=>"width:30px"))',
		   'htmlOptions'=>array('style'=>'width:70px;')  
		  ),
            
	),
          'htmlOptions'=>array('style'=>'padding-top:0px;')
));
      
?>  
 </div>
    
  </div>
</div>
<div class="col-md-3 col-sm-24">
    
<?php

$this->widget('MycartWidget', array(
  'crumbs' => array(
   array('name' => 'My cart list')
  )
));

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

<script type="text/javascript">
    
    $(".inputsec").each(function() {
       $(this).keyup(function(){
           
          var i = this.value;
          var h = $(this).attr('rel');
          var sec = $('.avspot-'+h).text();  
          var data = "id="+h+"&sec="+i;
          
	  if(parseFloat(this.value)>parseFloat(sec)){
		alert("Sorry! you can't enter more than "+sec+" seconds.");
		m = (i.slice(0, -1));
		$(this).val(m);
		return false;
	   }
           
         else{
             
           if(isNaN(this.value)) {
              
              alert('Please Enter Number Only.');
	      $(this).val('');
              i = '';
           }
          
          data = "id="+h+"&sec="+i;
          
          $.ajax({
            type: 'POST',
             url: '<?php echo Yii::app()->createAbsoluteUrl("channel/tempbook"); ?>',
            data:data,
            success:function(data1){
                        var obj = $.parseJSON(data1);
                        $('.tchannel').html(obj.channel);
                        $('.tsecond').html(obj.second);
                       },
            error: function(data2) { // if error occured
                    alert("An error occured, please try again!");
             }
           });
        }
       return false; 
     });
    });

</script>

