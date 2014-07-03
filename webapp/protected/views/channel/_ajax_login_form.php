<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
            'id' => 'login-modal'
           )
          ); ?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>login</h3>
    </div>
    <div class="modal-body">
    <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'login-modal',
			//'action' => Yii::app()->createUrl('site/login'),
            'htmlOptions' => array(
                'class' => 'well',
				'onsubmit'=>'return false;', 
				'onkeypress'=>'if(event.keyCode == 13){ send(); }'
				),
				'clientOptions' => array(
					'validateOnSubmit'=>true,
                    //'validateOnChange'=>true,
                   // 'validateOnType'=>false,
				),
				'enableClientValidation' => true,
				'enableAjaxValidation'=>true,
            )
         );
?>
    <div id="error-div" class="alert alert-block alert-error" style="display:none;">
    </div>
    
    <?php echo Yii::app()->user->getFlash('success');?>
     
    <?php echo $form->textFieldRow($login_form_model, 'username', array(
                            'class' => 'span3'
                            )
                      ); ?>
    <?php echo $form->passwordFieldRow($login_form_model, 'password', array(
                             'class' => 'span3'
                             )
                      ); ?>
                      
    <?php echo $form->hiddenField($login_form_model,'rec',array('value'=>'1','class' => 'span3')); ?>
                      
    <?php 
	
	echo CHtml::tag('button',
                array('class' => 'btn', 'id' => 'login-ajax', 'type' => 'Submit', 'name' => 'button1', 'value' => '1'),
                '<i class="icon-user"></i> Login');
    ?>
   <!-- <input type="submit" class="btn" name="button1" id="login-ajax" value="login" />-->
     <?php $this->endWidget(); ?>
     </div>
<?php $this->endWidget(); ?>


<script type="text/javascript">
$('body').on('click','#login-ajax',function(){jQuery.ajax({'success':function(data){
        var obj = $.parseJSON(data);
	
        if(obj.login=="success"){
            $("#login-modal").modal("hide");
            setTimeout(function(){location.reload(true);},400);
        }
		else if(obj.login=="error" && obj.response=="4"){
			$("#error-div").show();
            $("#error-div").html("Email id/username or password incorrect.");
        }
		else if(obj.login=="error" && obj.response=="3"){
			$("#error-div").show();
            $("#error-div").html("Please enter your email id/username or password.");
        }
		else if(obj.login=="error" && obj.response=="2"){
			$("#error-div").show();
            $("#error-div").html("Please enter your password.");
        }
		else if(obj.login=="error" && obj.response=="1"){
			$("#error-div").show();
            $("#error-div").html("Please enter your email id/username.");
        }
		else{
			$("#error-div").html("");
            $("#error-div").hide();
        }
    },'type':'POST','url':'?r=site/login','cache':false,'data':jQuery(this).parents("form").serialize()});return false;});
</script>
