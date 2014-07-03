<div id='signup-modal' class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header"> <a class="close" data-dismiss="modal">×</a>
    <h3>Sign Up</h3>
  </div>
  <div class="modal-body">
    <div id="signup-header" class="hidden-xs">
      <?php 

	foreach($this->crumbs as $crumb) {
        if(isset($crumb['name'])) {

			echo CHtml::link($crumb['name'], $crumb['url'], array('class' => 'animated', 'target'=>'_self', 'data-id'=>$crumb['lable']));

        }
    }
    ?>
    </div>
  </div>
</div>
