<?php
return yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/main.php',
    require __DIR__ . '/main-local.php',
    require __DIR__ . '/test.php',
    [
        'components' => [
            'db' => [
                'dsn' => 'mysql:host=mysql;dbname=yii2-app-advanced-test',
                'username' => 'root',
                'password' => 'root',
                'tablePrefix' => '',
                'charset' => 'utf8',
            ]
        ],
    ]
);
