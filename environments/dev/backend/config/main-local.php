<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '6EFB8C06A75463D23289B0687CAF6A2B3CC6CF02D9A7E87807519242162C84A78A158EB23E8AF86609AE5DB1352C82F90D0716B4FF452BB47EFAD98B912BA78A',
        ],
        'userProfileFileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '/uploads/profile',
            'filesystem' => [
                'class' => 'common\components\filesystem\LocalFlysystemBuilder',
                'path' => '@root/uploads/profile'
            ],
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'backend' => '@backend/gii/templates/crud',
                ],
                'template' => 'backend',
                'messageCategory' => 'backend'
            ],
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' => [
                    'backend' => '@backend/gii/templates/model',
                ],
                'template' => 'backend',
                'messageCategory' => 'common',
                'ns' => 'common\models\domain',
                'queryNs' => 'common\models\query',
                'generateQuery' => true,
                'useTablePrefix' => true,
                'useSchemaName' => true,
            ]
        ]
    ];

    $config['modules']['gridview'] = [
        'class' => '\kartik\grid\Module'
    ];
}

return $config;
