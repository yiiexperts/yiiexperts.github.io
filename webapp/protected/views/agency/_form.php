<div id="user-info" class="col-md-9 col-sm-8">
  <div id="general" class="user-details">
    <div class="panel panel-primary">
    <div class="panel-heading"><i class="fa fa-user"></i> Join Now
        <p><?php echo CHtml::link('You\'r broadcaster?',array('channel/register')); ?> <?php echo CHtml::link('Already have an accout?',array('site/login')); ?></p>
      </div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lmi-agency-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); ?>

<table class="detail-view table table-bordered table-striped" id="yw0">
    <tbody>
    <tr class="even"><th colspan="2"><div class="title">Please fill the required information.</div></th></tr>
    <tr class="odd">
            <th><?php echo $form->labelEx($model,'AgencyName'); ?></th>
            <td><?php echo $form->textField($model,'AgencyName',array('size'=>60,'maxlength'=>150)); ?> <?php echo $form->error($model,'AgencyName'); ?></td>
          </tr>
      <tr class="even">
            <th><?php echo $form->labelEx($model,'FName'); ?></th>
            <td><?php echo $form->textField($model,'FName',array('size'=>60,'maxlength'=>100)); ?> <?php echo $form->error($model,'FName'); ?></td>
          </tr>
      <tr class="odd">
            <th><?php echo $form->labelEx($model,'LName'); ?></th>
            <td><?php echo $form->textField($model,'LName',array('size'=>60,'maxlength'=>100)); ?> <?php echo $form->error($model,'LName'); ?></td>
          </tr>
      <tr class="even">
            <th><?php echo $form->labelEx($model,'Mobile'); ?></th>
            <td><?php echo $form->textField($model,'Mobile',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($model,'Mobile'); ?></td>
          </tr>
     <tr class="odd">
            <th><?php echo $form->labelEx($model,'Email'); ?></th>
            <td><?php echo $form->textField($model,'Email',array('size'=>60,'maxlength'=>200)); ?> <?php echo $form->error($model,'Email'); ?></td>
          </tr>
      <tr class="even">
            <th><?php echo $form->labelEx($model,'Address'); ?></th>
            <td><?php echo $form->textArea($model,'Address',array('maxlength'=>500)); ?> <?php echo $form->error($model,'Address'); ?></td>
          </tr>
     <tr class="odd">
            <th><label class="required">Choose Channels <span class="required">*</span></label></th>
            <td><?php
	  $list = CHtml::listData(YiiChannel::model()->findAll(array('order' => 'ChannelName')), 'Id', 'ChannelName');
	  
	  echo $form->checkBoxList($channelagency, 'ChannelId', $list, array(
		'template'=>'<div class="rs-checkbox"><div class="rs-check">{input} </div><div class="rs-check-label">{label}</div></div>','separator'=>'','label'=>false));
	?></td>
          </tr>
     <?php if(CCaptcha::checkRequirements()): ?>
          <tr class="even">
            <th><?php echo $form->labelEx($model,'verifyCode'); ?></th>
            <td><?php echo $form->textField($model,'verifyCode'); ?>
              <?php $this->widget('CCaptcha',array('clickableImage' => false, 'showRefreshButton' => false)); ?>
              &nbsp; <?php echo $form->error($model,'verifyCode'); ?>
              <div class="hint">Please enter the letters as they are shown in the image above. <br/>
                Letters are not case-sensitive.</div></td>
          </tr>
          <?php endif; ?>
          <tr class="odd">
            <th></th>
            <td style="border-left:0;"><?php echo CHtml::submitButton($model->isNewRecord ? 'Register' : 'Save', array('class'=>'btn btn-large')); ?><div class="note">Fields with <span class="required">*</span> are required.</div></td>
          </tr>
    </tbody>
    </table>

<?php $this->endWidget(); ?>


    </div>
  </div><!-- form -->
</div>