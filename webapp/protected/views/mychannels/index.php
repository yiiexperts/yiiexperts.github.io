<?php
$this->pageTitle=Yii::app()->name . ' | My Channels';
$this->breadcrumbs=array(
	'Lmi Channels'=>array('index'),
	'My Channels',
);

?>

<h2 class="section-title">My Channels</h2>
<div class="channel-spot-list col-md-9 col-sm-8">
  <?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'mychannels-grid',
	'dataProvider'=>$dataProvider, //$model->users  //$dataProvider
	//'filter' => $model,
        'type'=>'striped bordered condensed',
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
		//'Id',
		//'ChannelId',
		//'AgencyId',
		//'ChannelLogo',				
		array(
		'name'=>'ChannelLogo', // 
		'type'=>'raw',
		'value' =>'"<div class=\"channel-logo\">".CHtml::image(Yii::app()->request->baseUrl."/images/".$data[ChannelLogo])."</div>"',
		'htmlOptions'=>array('style'=>'width:100px;') 
		),
		'ChannelName',
		array(
		'name'=>'Status', // 
		'type'=>'raw',
		'value' =>'($data[Status]==1)? "<span class=\"label label-important\">Inactive</span>": "<span class=\"label label-success\">Active</span>"',
		),

		/*$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Click me',
    'type'=>'danger',
    'htmlOptions'=>array('data-title'=>'A Title', 'data-content'=>'And here\'s some amazing content. It\'s very engaging. right?', 'rel'=>'popover'),
));*/
		
          array(
		     'name'=>'Action',
		      'type'=>'raw',
		       'value'=>'"
		      <a href=\'javascript:return;\' onclick=\'renderView(".$data[Id].")\'   class=\'btn btn-small view\' ><i class=\'icon-eye-open\'></i></a>
		      <a href=\'javascript:return;\' onclick=\'delete_record(".$data[Id].")\'   class=\'btn btn-small view\' ><i class=\'icon-trash\'></i></a>
		     "',
		      'htmlOptions'=>array('style'=>'width:100px;')  
		     ),
	),
)); 

 $this->renderPartial("_ajax_view");

?>
</div>
<div class="col-md-3 col-sm-24">
  <?php
$this->widget('SuggestionWidget', array(
  'crumbs' => array(
   array('name' => 'Unsubscribe channels list')
  )
));
?>
</div>
<script type="text/javascript"> 
function delete_record(id)
{
 
  if(!confirm("Are you sure you want delete this?"))
   return;
    
   var data="id="+id;

  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("mychannels/delete"); ?>',
   data:data,
success:function(data){
                 if(data=="true")
                  {
                     $('#mychannels-view-modal').modal('hide');
                     $.fn.yiiGridView.update('mychannels-grid', {
                    });
                  } 
                 else
                   alert("deletion failed");
              },
   error: function(data) { // if error occured
          alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
       //  alert(data);
    },

  dataType:'html'
  });

}
</script>