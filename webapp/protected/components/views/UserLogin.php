<?php if(Yii::app()->user->isGuest) : ?>
 
<?php 
if($form->getErrors() != null) {
   $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
     'id'=>'userloginwidget',
     'cssFile'=>'jquery-ui-1.8.7.custom.css',
     'theme'=>'redmond',
     'themeUrl'=>Yii::app()->request->baseUrl.'/css/ui',
     'options'=>array(
         'title'=>'User Login Errors',
         'autoOpen'=>true,
         'modal'=>true,
         'width'=>350,
     ),
   ));
}else{
   $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
     'id'=>'userloginwidget',
     'cssFile'=>'jquery-ui-1.8.7.custom.css',
     'theme'=>'redmond',
     'themeUrl'=>Yii::app()->request->baseUrl.'/css/ui',
     'options'=>array(
         'title'=>'User Login',
         'autoOpen'=>false,
         'modal'=>true,
         'width'=>300,
     ),
   ));
}
?>
 
<?php echo CHtml::beginForm(Yii::app()->homeUrl); ?>
 
<?php echo CHtml::activeLabel($form,'email'); ?>
<?php echo CHtml::activeTextField($form,'email') ?>
 
<?php echo CHtml::activeLabel($form,'password'); ?>
<?php echo CHtml::activePasswordField($form,'password') ?>
 
<?php /*echo CHtml::activeCheckBox($form,'rememberMe'); ?>
<?php echo CHtml::activeLabel($form,'rememberMe');*/ ?>
 
<?php echo CHtml::submitButton('Submit'); ?>
 
<?php echo CHtml::error($form,'password'); ?>
<?php echo CHtml::error($form,'email'); ?>
 
<?php echo CHtml::endForm(); ?>
 
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
<?php endif; ?>