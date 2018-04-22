<?php

ini_set(’session.gc_maxlifetime’, 120*60); //30 min

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Wellpoint Dasmarinas EMR System',
        'theme'=>'classic',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
                'application.components.*',
                'application.modules.user.models.*',
                'application.modules.user.components.*',
                'application.modules.rights.models.*',
                'application.modules.rights.components.*',
	),

	'modules'=>array(
				'hmoarreports',
                'ProgrammedResults',
                'BloodChemResult',   
                'PrintDiagResult',
                'AddDiagResult',
			    'HmoWeekBill',  
                'ValuCare',  
                'MaxiCare', 
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'p@ssw0rd',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
                'user'=>array(
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
                'rights'=>array(
                        'superuserName'=>'Admin', // Name of the role with super user privileges.
                        'authenticatedName'=>'Authenticated', // Name of the authenticated user role.
                        'userIdColumn'=>'id', // Name of the user id column in the database.
                        'userNameColumn'=>'username', // Name of the user name column in the database.
                        'enableBizRule'=>false, // Whether to enable authorization item business rules.
                        'enableBizRuleData'=>false, // Whether to enable data for business rules.
                        'displayDescription'=>true, // Whether to use item description instead of name.
                        'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages.
                        'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.
                        'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested.
                        'install'=>false, // Whether to enable installer.
                        'debug'=>false, // Whether to enable debug mode.
                ),
	),

	// application components
	'components'=>array(
		'user'=>array(
                        // enable cookie-based authentication
                        'class' => 'RWebUser',
                        'allowAutoLogin'=>true,
                        'loginUrl' => array('/user/login'),
		),
                'authManager'=>array(
                        'class'=>'RDbAuthManager',
                ),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			//'connectionString' => 'mysql:host=localhost;dbname=wpemrdb',
			//'connectionString' => 'mysql:host=10.10.0.2;dbname=wpemrdb',
			'connectionString' => 'mysql:host=localhost;dbname=wpemrdlivedb',
			'emulatePrepare' => true,
			//'username' => 'root',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
                        'tablePrefix' => 'auth_',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
                        'errorAction'=>'site/error',
                ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'rom.gapuz@gmail.com',
	),
);
