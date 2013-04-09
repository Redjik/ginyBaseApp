<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),



	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

        'db' => array(
            'class'=>'CDbServiceLocator',
            'service_class'=>array(
                'class'=>'CDbSingleConnectionRouter',
                'connection'=>array(
                    'class'=>'CDbConnection',
                    'connectionString' => 'mysql:host=localhost;dbname=giny_master',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                )
            )
        ),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'',
                    'categories'=>array('system.db.CDbConnection')
				),
				// uncomment the following to show log messages on web pages

				array(
					'class'=>'CWebLogRoute',
				),

			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);

// Path to directory for author defenition
$path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'author' . DIRECTORY_SEPARATOR;

$dir = dir($path);
while (($entry = $dir->read()) !== false) {
    if (is_file($path . $entry) && $entry[0] === '.' && $entry != '.gitignore') {
        $YII_ENVIRONMENT = substr($entry, 1);
        break;
    }
}
unset($dir);

if (isset($YII_ENVIRONMENT) && file_exists(__DIR__ . '/.' . $YII_ENVIRONMENT . '.php')) {
    $custom = include(__DIR__ . '/.' . $YII_ENVIRONMENT . '.php');
    $config = CMap::mergeArray($config, $custom);
}
return $config;