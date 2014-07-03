<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AgencyName')); ?>:</b>
	<?php echo CHtml::encode($data->AgencyName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FName')); ?>:</b>
	<?php echo CHtml::encode($data->FName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LName')); ?>:</b>
	<?php echo CHtml::encode($data->LName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Mobile')); ?>:</b>
	<?php echo CHtml::encode($data->Mobile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Phone')); ?>:</b>
	<?php echo CHtml::encode($data->Phone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Address')); ?>:</b>
	<?php echo CHtml::encode($data->Address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ModifiedOn')); ?>:</b>
	<?php echo CHtml::encode($data->ModifiedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LoginId')); ?>:</b>
	<?php echo CHtml::encode($data->LoginId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	*/ ?>

</div>