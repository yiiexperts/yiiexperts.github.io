<?php
$this->pageTitle = Yii::app()->name . ' - Login';

?>

<div class="container" style="margin-top:40px">
  <div class="span12">
    <div class="span5 offset3">
      <h2 style="text-align: center">Login</h2>
      <div class="form">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
				'id' => 'login-form',
				'enableClientValidation' => true,
				'htmlOptions' => array('class' => 'well'),
				'clientOptions' => array(
					'validateOnSubmit' => true,
				),
			)); ?>
        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span3'));?> <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3'));?>
         <?php echo $form->checkBoxRow($model, 'rememberMe');?>
        <div class="form-actions">
          <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Login', 'icon' => 'user'));?>
          <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'reset', 'label' => 'Reset'));?>
         
        </div>
        <p style="margin:0px;"><?php echo CHtml::link('forgot password?',array('site/recovery')); ?><br /><?php echo CHtml::link('Create a broadcaster acccount?',array('channel/register')); ?><br /><?php echo CHtml::link('Create a agency acccount?',array('agency/register')); ?></p>
        <?php $this->endWidget(); ?>
      </div>
      <!-- form --> 
    </div>
  </div>
</div>
<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css">
