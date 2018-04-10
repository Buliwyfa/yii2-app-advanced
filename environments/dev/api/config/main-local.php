<?php

$config = [
    'components' => [
        'jwt' => [
            'class' => 'common\components\jwt\JWT',
            'key' => '@@[[CHANGE-THE-KEY-HERE]]@@',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
}

return $config;
