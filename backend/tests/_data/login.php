<?php
return [
    [
        'name' => 'Administrator',
        'email' => 'paulo@prsolucoes.com',
        'auth_key' => '2G62gPD4AlEcnMxWDhTPNPT40JWjis7H',
        'password_hash' => '$2y$13$NxkjVJOLFLM3gKAI7F7lzeAqzDl8Cz/RBa1.FdglsMPdakxA98BJS', // user@password
        'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
        'status' => 'active',
        'root' => 'yes',
        'gender' => 'male',
        'language_id' => 1,
        'created_at' => '1565479063',
        'updated_at' => '1565479063',
    ],
];
