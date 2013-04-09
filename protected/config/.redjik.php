<?php
return array(
    'components'=> array(
        'db' => array(
            'class'=>'CDbServiceLocator',
            'service_class'=>array(
                'class'=>'CDbSingleConnectionRouter',
                'connection'=>array(
                    'class'=>'CDbConnection',
                    'connectionString' => 'mysql:host=localhost;dbname=step_up',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                )
            )
        ),
    ),
    'modules' => array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'1',
            'generatorPaths' => array(
                'ext.egii.generators'
            ),
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('*','::1'),
        ),
    )
);
