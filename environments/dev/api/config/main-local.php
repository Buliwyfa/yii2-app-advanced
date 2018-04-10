<?php

$config = [
    'components' => [
        'jwt' => [
            'class' => 'sizeg\jwt\Jwt',
            'key' => '@@[CHANGE-IT-HERE]@@',
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
