<?php
return array(
    'components'=> array(
        'db' => array(
            'connections'=>array(
                'master'=>array(
                    'class'=>'CDbConnection',
                    'connectionString' => 'mysql:host=localhost;dbname=giny_master',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                    'type'=>CDbConnection::TYPE_MASTER
                ),
                'slave'=>array(
                    'class'=>'CDbConnection',
                    'connectionString' => 'mysql:host=localhost;dbname=giny_slave',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                    'type'=>CDbConnection::TYPE_SLAVE
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
