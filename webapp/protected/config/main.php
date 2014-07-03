<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CW ebApplication properties can be configured here.

  $db_name="sql445475";
  $db_user="sql445475";
  $db_host="sql4.freesqldatabase.com";
  $db_password="tZ4%hL1!";
  
  require_once( dirname(__FILE__) . '/../components/UserInfo.php');
	  
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii Expert',
	'timeZone' => 'Asia/Calcutta',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),
	

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'yiiexpert',
            'generatorPaths' => array(
                        'ext.ajaxgii',
						'ext.social',    
                  ),
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(     
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                'session' => array(
                        'autoStart'=>true,  
                            ), 
							
			// do not use built-in jquery.js library
		'clientScript'=>array(
			'class'=>'CClientScript',
			'scriptMap'=>array(
				'jquery.js'=>false,
				'jquery.ba-bbq.js'=>false,
				'jquery.yiilistview.js'=>false,
				'jquery.yiiactiveform.js'=>false,
				'jquery-ui.min.js'=>false,
				'bootstrap.js'=>false,
				'styles.css'=>false,
				'pager.css'=>false,
				'bootstrap.css'=>false,
				'bootstrap-yii.css'=>false,
				'bootstrap-responsive.css'=>false,
			),
			'coreScriptPosition'=>CClientScript::POS_BEGIN,
		),
		
                'bootstrap'=>array(
                        'class'=>'ext.bootstrap.components.Bootstrap',
                        'coreCss'=>true,
                        'responsiveCss'=>true,
						'yiiCss' => true,
                        'plugins'=>array(
                                        'transition'=>false,
                                        'tooltip'=>array(
                                               'selector'=>'a.tooltip',
                                               'options'=>array(
                                                         'placement'=>'bottom',
                                                         ),
                                                  ),
		                        			),
                                      ), 
								  
								  
								   
		// uncomment the following to enable URLs in path-format
		
		/*'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),*/
		
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host='.$db_host.';dbname='.$db_name,
			'emulatePrepare' => true,
			'username' => $db_user,
			'password' => $db_password,
			'charset' => 'utf8',
			'enableProfiling'=>true,
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ), 
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'yiiexpert@gmail.com',       
	),
);
