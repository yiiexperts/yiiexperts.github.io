<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AgencyId')); ?>:</b>
	<?php echo CHtml::encode($data->AgencyId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ChannelId')); ?>:</b>
	<?php echo CHtml::encode($data->ChannelId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />


</div>