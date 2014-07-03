<?php
$this->breadcrumbs=array(
	'Lmi Agency Channels'=>array('index'),
	$model->Id,
);

?>

<h1>View YiiAgencyChannel #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'AgencyId',
		'ChannelId',
		'Status',
		//'channel.ChannelName',
	),
)); 
?>

<style type="text/css" media="print">
body {visibility:hidden;}
.printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
function printDiv(){
window.print();
}
</script>