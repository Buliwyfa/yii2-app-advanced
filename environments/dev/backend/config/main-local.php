<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
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
