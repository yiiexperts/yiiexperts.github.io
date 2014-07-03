<div id='signup-modal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
    <h3>Sign Up</h3>
  </div>
  <div class="modal-body">
    <?php 
	$this->widget('SignupWidget', array(
  'crumbs' => array(
   array('name' => "I'm Broadcaster", 'url' => array('facebook.com'), 'lable' => 'broadcaster'),
   array('name' => "I'm Executor", 'url' => array('twitter.com'), 'lable' => 'executor'),
  )
)); ?>
  </div>
</div>
<script>
$('#signup').live('click',function(){
	$('#signup-modal').modal('show');	
	return false;
});
</script> 
