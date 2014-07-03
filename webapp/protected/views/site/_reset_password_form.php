<?php
$uid = Yii::app()->session['uid'];
$utype = Yii::app()->session['utype'];

if($utype==='C'){
	$ca = $channeluser;
}
else{
	$ca = $agencyuser;
}

?>

<div id="user-info" class="col-md-9 col-sm-8">
  <div id="general" class="user-details">
    <div class="panel panel-primary">
      <div class="panel-heading"><i class="fa fa-user"></i> Reset Your Password </div>
      <div class="form">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id' => 'chnage-password-form',
				'enableClientValidation' => true,
				'htmlOptions' => array('class' => 'well'),
				'clientOptions' => array(
					'validateOnSubmit' => true,
				),
			));

?>
        <div class="row"> <?php echo $form->labelEx($ca,'old_password'); ?> <?php echo $form->passwordField($ca,'old_password'); ?> <?php echo $form->error($ca,'old_password'); ?> </div>
        <div class="row"> <?php echo $form->labelEx($ca,'new_password'); ?> <?php echo $form->passwordField($ca,'new_password'); ?> <?php echo $form->error($ca,'new_password'); ?> </div>
        <div class="row"> <?php echo $form->labelEx($ca,'repeat_password'); ?> <?php echo $form->passwordField($ca,'repeat_password'); ?> <?php echo $form->error($ca,'repeat_password'); ?> </div>
        <div class="row submit">
          <?php //echo CHtml::submitButton(UserModule::t("Save"));
		$this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Update', 'icon' => '')); ?>
        </div>
        <?php $this->endWidget(); ?>
      </div>
      <!-- form --> 
      
    </div>
  </div>
</div>
<!-- form -->
</div>
