<?php 
$uid = Yii::app()->session['uid'];
$utype = Yii::app()->session['utype'];
?>

<div id="user-info" class="col-md-9 col-sm-8">
  <div id="general" class="user-details">
    <div class="panel panel-primary">
      <div class="panel-heading"><i class="fa fa-user"></i> Update Information
        <p><?php echo CHtml::link('View',array('site/profile','rel'=>'view-details','#'=>'general')); ?></p>
      </div>
      <?php if($utype === 'C'){ ?>
      <?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'lmi-channel-form',
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>true,
	)); ?>
      <table class="detail-view table table-bordered table-striped" id="yw0">
        <tbody>
          <tr class="odd">
            <th><?php echo $form->labelEx($channeluser,'ChannelName'); ?></th>
            <td><?php echo $form->textField($channeluser,'ChannelName',array('size'=>60,'maxlength'=>150)); ?> <?php echo $form->error($channeluser,'ChannelName'); ?></td>
          </tr>
          <tr class="even">
            <th><?php echo $form->labelEx($channeluser,'FName'); ?></th>
            <td><?php echo $form->textField($channeluser,'FName',array('size'=>60,'maxlength'=>100)); ?> <?php echo $form->error($channeluser,'FName'); ?></td>
          </tr>
          <tr class="odd">
            <th><?php echo $form->labelEx($channeluser,'LName'); ?></th>
            <td><?php echo $form->textField($channeluser,'LName',array('size'=>60,'maxlength'=>100)); ?> <?php echo $form->error($channeluser,'LName'); ?></td>
          </tr>
          <tr class="even">
            <th><?php echo $form->labelEx($channeluser,'Mobile'); ?></th>
            <td><?php echo $form->textField($channeluser,'Mobile',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($channeluser,'Mobile'); ?></td>
          </tr>
          <tr class="odd">
            <th><?php echo $form->labelEx($channeluser,'Phone'); ?></th>
            <td><?php echo $form->textField($channeluser,'Phone',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($channeluser,'Phone'); ?></td>
          </tr>
          <tr class="even">
            <th><?php echo $form->labelEx($channeluser,'ChannelDescription'); ?></th>
            <td><?php echo $form->textArea($channeluser,'ChannelDescription',array('maxlength'=>2000)); ?> <?php echo $form->error($channeluser,'ChannelDescription'); ?></td>
          </tr>
          <tr class="odd">
            <th></th>
            <td style="border-left:0;"><?php echo CHtml::submitButton($channeluser->isNewRecord ? 'Register' : 'Update', array('class'=>'btn btn-large')); ?>
              <div class="note">Fields with <span class="required">*</span> are required.</div></td>
          </tr>
        </tbody>
      </table>
      <?php }
	  else {?>
      <?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'lmi-agency-form',
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>true,
	)); ?>
      <table class="detail-view table table-bordered table-striped" id="yw0">
        <tbody>
          <tr class="odd">
            <th><?php echo $form->labelEx($agencyuser,'AgencyName'); ?></th>
            <td><?php echo $form->textField($agencyuser,'AgencyName',array('size'=>60,'maxlength'=>150)); ?> <?php echo $form->error($agencyuser,'AgencyName'); ?></td>
          </tr>
          <tr class="even">
            <th><?php echo $form->labelEx($agencyuser,'FName'); ?></th>
            <td><?php echo $form->textField($agencyuser,'FName',array('size'=>60,'maxlength'=>100)); ?> <?php echo $form->error($agencyuser,'FName'); ?></td>
          </tr>
          <tr class="odd">
            <th><?php echo $form->labelEx($agencyuser,'LName'); ?></th>
            <td><?php echo $form->textField($agencyuser,'LName',array('size'=>60,'maxlength'=>100)); ?> <?php echo $form->error($agencyuser,'LName'); ?></td>
          </tr>
          <tr class="even">
            <th><?php echo $form->labelEx($agencyuser,'Mobile'); ?></th>
            <td><?php echo $form->textField($agencyuser,'Mobile',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($agencyuser,'Mobile'); ?></td>
          </tr>
          <tr class="odd">
            <th><?php echo $form->labelEx($agencyuser,'Phone'); ?></th>
            <td><?php echo $form->textField($agencyuser,'Phone',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($agencyuser,'Phone'); ?></td>
          </tr>
          <tr class="even">
            <th><?php echo $form->labelEx($agencyuser,'Address'); ?></th>
            <td><?php echo $form->textArea($agencyuser,'Address',array('maxlength'=>500)); ?> <?php echo $form->error($agencyuser,'Address'); ?></td>
          </tr>
          <tr class="odd">
            <th></th>
            <td style="border-left:0;"><?php echo CHtml::submitButton($agencyuser->isNewRecord ? 'Register' : 'Update', array('class'=>'btn btn-large')); ?>
              <div class="note">Fields with <span class="required">*</span> are required.</div></td>
          </tr>
        </tbody>
      </table>
      <?php } ?>
      <?php $this->endWidget(); ?>
    </div>
  </div>
</div>
