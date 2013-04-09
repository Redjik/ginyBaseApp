<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
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
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
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