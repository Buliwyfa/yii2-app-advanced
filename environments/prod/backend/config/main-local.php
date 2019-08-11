<?php
return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
            'baseUrl' => '/admin',
        ],
        'userProfileFileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '/uploads/profile',
            'filesystem' => [
                'class' => 'common\components\filesystem\LocalFlysystemBuilder',
                'path' => '@root/uploads/profile'
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
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
    ]
];
