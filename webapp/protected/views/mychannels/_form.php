<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lmi-agency-channel-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Id'); ?>
		<?php echo $form->textField($model,'Id'); ?>
		<?php echo $form->error($model,'Id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AgencyId'); ?>
		<?php echo $form->textField($model,'AgencyId'); ?>
		<?php echo $form->error($model,'AgencyId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ChannelId'); ?>
		<?php echo $form->textField($model,'ChannelId'); ?>
		<?php echo $form->error($model,'ChannelId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
		<?php echo $form->textField($model,'Status'); ?>
		<?php echo $form->error($model,'Status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->