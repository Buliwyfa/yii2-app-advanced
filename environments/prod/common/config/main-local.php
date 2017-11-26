<?php
return [
    'components' => [
        'db'=>[
            'class'=>'\yii\db\Connection',
            'dsn' => 'mysql:host=mysql;dbname=yii2-app-advanced',
            'username' => 'root',
            'password' => 'root',
            'tablePrefix' => '',
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
        ],
        'backendMailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@backend/mail',
            'useFileTransport' => true,
        ],
        'frontendMailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@frontend/mail',
            'useFileTransport' => true,
        ],
        'consoleMailer' => [
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
    'bootstrap' => [
        'log',
    ],
];
