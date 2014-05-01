<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Yii Framework Demo - Ashish Patel',
    'defaultController' => 'site',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
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
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'CWebUser',
            'autoUpdateFlash' => false, // add this line to disable the flash counter
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
        'adminEmail' => 'webmaster@example.com',
    ),
);