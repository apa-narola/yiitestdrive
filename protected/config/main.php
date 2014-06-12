<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Yii Framework Demo - Ashish Patel',
    'defaultController' => 'site',
    'sourceLanguage'=>'en',
    // Associates a behavior-class with the onBeginRequest event.
    // By placing this within the primary array, it applies to the application as a whole
    'behaviors'=>array(
        'onBeginRequest' => array(
            'class' => 'application.components.behaviors.BeginRequest'
        ),
    ),
 
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
	'application.models.*',
	'application.components.*',
	'application.modules.user.models.*',
	'application.modules.user.components.*',
	'application.extensions.yii-mail.*'
    ),
    'modules' => array(
	'user' => array(
	    # encrypting method (php hash function)
	    'hash' => 'md5',
	    # send activation email
	    'sendActivationMail' => true,
	    # allow access for non-activated users
	    'loginNotActiv' => false,
	    # activate user on registration (only sendActivationMail = false)
	    'activeAfterRegister' => false,
	    # automatically login from registration
	    'autoLogin' => true,
	    # registration path
	    'registrationUrl' => array('/user/registration'),
	    # recovery password path
	    'recoveryUrl' => array('/user/recovery'),
	    # login form path
	    'loginUrl' => array('/user/login'),
	    # page after login
	    'returnUrl' => array('/user/profile'),
	    # page after logout
	    'returnLogoutUrl' => array('/user/login'),
	),
	// uncomment the following to enable the Gii tool
	'gii' => array(
	    'class' => 'system.gii.GiiModule',
	    'password' => 'ashish123',
	    // If removed, Gii defaults to localhost only. Edit carefully to taste.
	    'ipFilters' => array('127.0.0.1', '::1'),
	),
    ),
    // application components
    'components' => array(
	// for language purpose
	 'request'=>array(
            'enableCookieValidation'=>true,
            'enableCsrfValidation'=>true,
        ),
	'Smtpmail' => array(
	    'class' => 'application.extensions.smtpmail.PHPMailer',
	    'Host' => "smtp.1and1.com",
	    'Username' => 'apa.narola@narolainfotech.com',
	    'Password' => 'PDh4kf638PZ4NNd',
	    'Mailer' => 'smtp',
	    'Port' => 587,
	    'SMTPAuth' => true,
	),
	'mail' => array(
	    'class' => 'ext.yii-mail.YiiMail',
	    'transportType' => 'smtp',
	    'transportOptions' => array(
		'host' => 'smtp.1and1.com',
		'username' => 'apa.narola@narolainfotech.com',
		'password' => 'PDh4kf638PZ4NNd',
		'port' => '587',
		'encryption' => 'tls',
	    ),
	    'viewPath' => 'application.views.mail',
	    'logging' => true,
	    'dryRun' => false
	),
	'user' => array(
	    // enable cookie-based authentication
	    'class' => 'WebUser',
	    'allowAutoLogin' => true,
	    'loginUrl' => array('/user/login'),
	),
	
	// uncomment the following to enable URLs in path-format

	/* 'urlManager'=>array(
	  'urlFormat'=>'path',
	  'rules'=>array(
	  //'page/show/<id:\d+>/<title:\w+>'=>'page/show',
	  //'<controller:\w+>/<id:\d+>'=>'<controller>/view',
	  //'<controller:\w+>/<action:\w+>/<id:\d+>/<title:\w+>'=>'<controller>/<action>',
	  //'<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
	  'page/<id:\d+>/<title>'=>'page/show',

	  ),
	  'showScriptName'=>false,
	  'urlSuffix'=>".html"
	  ), */


	/* 'db'=>array(
	  'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	  ), */
	// uncomment the following to use a MySQL database
	'db' => array(
	    'connectionString' => 'mysql:host=localhost;dbname=yiitestdrive',
	    'emulatePrepare' => true,
	    'username' => 'root',
	    'password' => '',
	    'charset' => 'utf8',
	    'tablePrefix' => 'tbl_',
	),
	'errorHandler' => array(
	    // use 'site/error' action to display errors
	    'errorAction' => 'site/error',
	),
	/* 'log'=>array(
	  'class'=>'CLogRouter',
	  'routes'=>array(
	  array(
	  'class'=>'CFileLogRoute',
	  'levels'=>'error, warning',
	  ),
	  // uncomment the following to show log messages on web pages

	  array(
	  'class'=>'CWebLogRoute',
	  ),

	  ),
	  ), */
	'log' => array(
	    'class' => 'CLogRouter',
	    'routes' => array(
		array(
		    'class' => 'CFileLogRoute',
		    'levels' => 'trace, info, error, warning, vardump',
		),
		// uncomment the following to show log messages on web pages
		array(
		    'class' => 'CWebLogRoute',
		    'enabled' => YII_DEBUG,
		    'levels' => 'error, warning, trace, notice',
		    'categories' => 'application',
		    'showInFireBug' => false,
		),
	    ),
	),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
	// this is used in contact page
	'adminEmail' => 'apa.narola@narolainfotech.com',
	'adminFromEmail' => 'info@narolainfotech.com',
	'pathImagesDir' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR,
	 'languages'=>array('tr'=>'Türkçe', 'en'=>'English', 'de'=>'Deutsch'),
    ),
);