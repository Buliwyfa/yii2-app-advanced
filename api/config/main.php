<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'name' => 'Y2AA',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => array(
            'baseUrl' => '/api',
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,
        ),
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false
        ],
        'i18n' => [
            'translations' => [
                'api*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    'basePath' => '@api/messages',
                ],
            ],
        ],
    ],
    'params' => $params,
    'bootstrap' => [
        [
            'class' => 'backend\components\LanguageSelector',
            'supportedLanguages' => $params['supportedLanguages'],
        ],
    ]
];
