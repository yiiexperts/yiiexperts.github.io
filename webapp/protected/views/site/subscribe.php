<?php
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
	'Lmi'=>array('subscribe'),
	'Lmi',
);
?>

<div id="channel-list" class="col-md-9 col-sm-8">
<?php 
if(isset(Yii::app()->session['uid']) && Yii::app()->session['utype']==='A'){ 
   $this->widget('AllunsubscribeWidget', array(
    'crumbs' => array(
     array('name' => 'Unsubscribe channels list')
    )
  ));
}
?>
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
