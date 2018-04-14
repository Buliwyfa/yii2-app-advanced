<?php
return [
    'components' => [
        'db' => [
            'class' => '\yii\db\Connection',
            'dsn' => 'mysql:host=mysql;dbname=yii2-app-advanced',
            'username' => 'root',
            'password' => 'root',
            'tablePrefix' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
        'customerProfileFileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '@web/uploads/profile',
            'filesystem' => [
                'class' => 'common\components\filesystem\LocalFlysystemBuilder',
                'path' => '@webroot/uploads/profile'
            ],
        ],
        'galleryFileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '/uploads/gallery',
            'filesystem' => [
                'class' => 'common\components\filesystem\LocalFlysystemBuilder',
                'path' => '@root/uploads/gallery'
            ],
        ],
    ],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            // uncomment and adjust the following to add your IP if you are not connecting from localhost.
            'allowedIPs' => ['*'],
        ],
    ],
    'bootstrap' => [
        'log',
        'debug',
    ],
];
