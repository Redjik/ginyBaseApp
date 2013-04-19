<?php
return array(
    'components'=> array(
//        'db' => array(
//            'schemaCachingDuration'=>1000,
//            'connections'=>array(
//                'master'=>array(
//                    'class'=>'CDbConnection',
//                    'connectionString' => 'mysql:host=localhost;dbname=giny_master',
//                    'emulatePrepare' => true,
//                    'username' => 'root',
//                    'password' => '',
//                    'charset' => 'utf8',
//                    'type'=>CDbConnection::TYPE_MASTER
//                ),
//                'slave'=>array(
//                    'class'=>'CDbConnection',
//                    'connectionString' => 'mysql:host=localhost;dbname=giny_slave',
//                    'emulatePrepare' => true,
//                    'username' => 'root',
//                    'password' => '',
//                    'charset' => 'utf8',
//                    'type'=>CDbConnection::TYPE_SLAVE
//                )
//            )
//        ),
        'mail' => array(
            'class'=>'GMailComponent',
            'components'=> array(
                'transport'=>array(
                    'class'=>'Swift_SmtpTransport',
                    'arguments'=>array(
                        'host'=>'smtp.example.org',
                        'port'=>25
                    ),
                    'methods'=>array(
                        'setUsername'=>array('username'),
                        'setPassword'=>array('password'),
                    ),
                ),
                'message'=>array(
                    'class'=>'Swift_Message',
                    'arguments'=>array(
                        'subject'=>'Test',
                        'body'=>'Test',
                    ),
                    'methods'=>array(
                        'setTo'=>array(array('receiver@domain.org', 'other@domain.org' => 'A name')),
                        'setFrom'=>array(array('john@doe.com' => 'John Doe')),
                    )
                ),
                'mailer'=>array(
                    'class'=>'Swift_Mailer',
                    'arguments'=>array(
                        'transport'=>'%transport'
                    ),
                    'methods'=>array(
                        'send'=>array('message'=>'%message'),
                    )
                )
            )
        )
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
