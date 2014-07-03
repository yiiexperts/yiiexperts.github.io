<?php
//ob_start();
$theme = '/themes/yiiexpert';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="language" content="en" />

<!-- CSS -->
<link href="<?php echo Yii::app()->request->baseUrl.$theme; ?>/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl.$theme; ?>/css/bootstrap-yii.css" />
<link href="<?php echo Yii::app()->request->baseUrl.$theme; ?>/css/font-awesome.min.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl.$theme; ?>/css/animate.min.css" rel="stylesheet" media="screen">
<link href="<?php echo Yii::app()->request->baseUrl.$theme; ?>/css/style.css" rel="stylesheet" media="screen" title="default">
<link href="<?php echo Yii::app()->request->baseUrl.$theme; ?>/css/color-default.css" rel="stylesheet" media="screen" title="default">
<link href="<?php echo Yii::app()->request->baseUrl.$theme; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen" title="default">

<!-- Script -->
<script src="<?php echo Yii::app()->request->baseUrl.$theme; ?>/js/jquery.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl.$theme; ?>/js/jquery-ui.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl.$theme; ?>/js/rs-custom.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl.$theme; ?>/js/jquery.ba-bbq.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl.$theme; ?>/js/jquery.yiiactiveform.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl.$theme; ?>/js/jquery.yiigridview.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl.$theme; ?>/js/bootstrap.js"></script>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="<?php echo Yii::app()->request->baseUrl.$theme; ?>/js/html5shiv.js"></script>
      <script src="<?php echo Yii::app()->request->baseUrl.$theme; ?>/js/respond.min.js"></script>
<![endif]-->

<title><?php echo CHtml::encode($this->pageTitle).' - Yii Framework'; ?></title>
</head>
<body>

<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
	your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to
	improve your experience.</p>
<![endif]-->

<div class="boxed">
<header id="header" class="hidden-xs">
  <div class="container">
    <div id="header-title">
      <h1 class="animated fadeInDown"><a href="./"><span><?php echo CHtml::encode(Yii::app()->name); ?></span></a></h1>
      <p class="animated fadeInLeft">. ..Yii Programmer</p>
    </div>
    <?php 

$this->widget('application.extensions.socialLink.socialLink', array(
    'style'=>'left', //alignment - left, right
	'top'=>'30',  //in percentage
        'media' => array(
		'facebook'=>array(
			'url'=>'http://facebook.com/',
			'target'=>'_blank',
		),
        'twitter'=>array(
			'url'=>'http://twitter.com/',
			'target'=>'_blank',
		),
		'google-plus'=>array(
			'url'=>'https://plus.google.com/',
			'target'=>'_blank',
		),
		'linkedin'=>array(
			'url'=>'http://linkedin.com/',
			'target'=>'_blank',
		),
		'rss'=>array(
			'url'=>'http://rss.com/',
			'target'=>'_blank',
		), 
      )
));

?>
  </div>
  <!-- container --> 
</header>
<div id="rs-nav">
  <?php 

$this->widget('bootstrap.widgets.TbNavbar', array(
	'type' => 'static-top navbar-mind', // null or 'inverse'
	'brand' => false,
	//'encodeLabel' => false,
	'brandUrl' => false,
	//'brandOptions' => true,
	'collapse' => true, // requires bootstrap-responsive.css
	 'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
			   array('label'=>'Home', 'url'=>Yii::app()->createUrl('site/'), 'active'=>$this->id=='site'?true:false),
            ),
			'htmlOptions'=>array('class'=>'navbar-nav')
        ),	
	),
	
));

if (Yii::app()->user->isGuest): ?>
  <div class='rs-login-btn'>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'size' => 'large',
        'label' => 'login',
        'url' => '#login-modal',
        'htmlOptions' => array(
                        'data-toggle' => 'modal',
                        'onclick' => '$("#error-div").hide();$("#LoginForm_username").focus();'),
       )
     );
	 echo CHtml::link('SignUp', array('#'), array('visible'=>!Yii::app()->user->isGuest,'class'=>'btn btn-large', 'id'=>'signup'));
     echo '</span>';
	 
	 $login_form_model = new LoginForm();
	 $this->renderPartial("_ajax_login_form",  array( 
            'login_form_model' => $login_form_model,
       )
     );
	 
	 $this->widget('SignupWidget', array(
	  'crumbs' => array(
	   array('name' => "I'm Broadcaster", 'url' => array('channel/register'), 'lable' => 'broadcaster'),
	   array('name' => "I'm Executor", 'url' => array('agency/register'), 'lable' => 'executor')
	  )
	));
   
     //$this->renderPartial("_ajax_signup");
   
  else :
     
	 echo "<div class='rs-login-btn'>";
	 
	if(Yii::app()->session['utype']==='C'){
	 echo "<div class='btn-toolbar'>";
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'buttons'=>array(
            array('label'=>'My Account', 'items'=>array(
                array('label'=>'Profile', 'url'=>array('site/profile')),
                array('label'=>'Setting', 'url'=>array('site/setting')),
                '---',
                array('label'=>'Logout', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
			'htmlOptions'=>array('class'=>'rs-dropdown-list')),
        ),
    ));
     echo "</div>";
	 }
	 
	 
	 else if(Yii::app()->session['utype']==='A'){
	 echo "<div class='btn-toolbar'>";
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'buttons'=>array(
            array('label'=>'My Account', 'items'=>array(
                array('label'=>'Profile', 'url'=>array('site/profile')),
                array('label'=>'My Channels', 'url'=>array('/mychannels')),
                array('label'=>'Setting', 'url'=>array('site/setting')),
                '---',
                array('label'=>'Logout', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
			'htmlOptions'=>array('class'=>'rs-dropdown-list')),
        ),
    ));
     echo "</div>";
	 }
	echo "</div>";
	 
endif;

?>
  </div>
  <!--   <br/><br/><br/><br/>      -->
  <div class="container"> <?php echo $content; ?> </div>
  <div style="clear:both;"> </div>
  <footer id="footer">
    <p>&copy;
      <?=date('Y')?>
      <a href="http://yiiexpert.github.io">Yii Expert</a>, All rights reserved. <?php echo Yii::powered(); ?></p>
  </footer>
  <!-- footer --> 
  
</div>
<style type="text/css" media="print">
body {visibility:hidden;}
.printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
$('#signup').live('click',function(){
	$('#signup-modal').modal('show');	
	return false;
});
</script>
</body>
</html>
<?php //ob_flush(); ?>