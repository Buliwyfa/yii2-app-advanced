<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-ws',
    'name' => 'Y2AA',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'ws\controllers',
    'components' => [
        'request' => array(
            'baseUrl' => '/api',
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,
        ),
        'response' => [
            'class' => 'yii\web\Response',
            'format' => 'json',
            'on beforeSend' => function ($event) {
                $response = $event->sender;

                if ($response->data instanceof \common\models\web\Response) {
                    $response->data = [
                        'success' => $response->data->isSuccess(),
                        'message' => $response->data->getMessage(),
                        'data' => $response->data->getData(),
                    ];
                }
            },
        ],
        'user' => [
            'identityClass' => 'common\models\domain\Customer',
            'enableAutoLogin' => false,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error/index',
        ],
        'i18n' => [
            'translations' => [
                'ws*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    'basePath' => '@ws/messages',
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/',
        ],
    ],
    'params' => $params,
    'bootstrap' => [
        [
            'class' => 'backend\components\LanguageSelector',
            'supportedLanguages' => $params['supportedLanguages'],
            'createCookie' => false,
        ],
    ]
];
