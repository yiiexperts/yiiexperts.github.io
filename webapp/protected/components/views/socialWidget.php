<div id="social-header" class="hidden-xs">
  <?php 

	foreach($this->crumbs as $crumb) {
        if(isset($crumb['name'])) {

			echo CHtml::link($crumb['name'], $crumb['url'], array('class' => 'social-icon soc-'.$crumb["lable"].' animated fadeInDown animation-delay-3', 'target'=>'_blank', 'data-id'=>$crumb['lable']));

        }
    }
    ?>
</div>
