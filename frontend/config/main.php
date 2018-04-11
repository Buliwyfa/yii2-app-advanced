<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'Y2AA',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\domain\Customer',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => ['site/login'],
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => 'gallery/<id:\d+>/<title:\S+>',
                    'route' => 'gallery/index',
                ],
                [
                    'pattern' => 'about-us',
                    'route' => 'content/index',
                    'defaults' => ['tag' => 'about-us', 'language' => 'auto'],
                ],
                [
                    'pattern' => 'privacy-policy',
                    'route' => 'content/index',
                    'defaults' => ['tag' => 'privacy-policy', 'language' => 'auto'],
                ],
                [
                    'pattern' => 'terms-of-use',
                    'route' => 'content/index',
                    'defaults' => ['tag' => 'terms-of-use', 'language' => 'auto'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    'basePath' => '@frontend/messages',
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
