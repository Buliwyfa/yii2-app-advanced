<?php

use common\models\domain\User;
use yii\db\Migration;

class m170101_120005_add_users extends Migration
{

    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'name' => 'Administrator',
            'email' => 'paulo@prsolucoes.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('user@password'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'password_reset_token' => Yii::$app->getSecurity()->generatePasswordHash('user-reset-token'),
            'language_id' => 1,
            'status' => User::STATUS_ACTIVE,
            'root' => User::ROOT_YES,
            'gender' => User::GENDER_MALE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%user}}', ['email' => 'paulo@prsolucoes.com']);
    }

}
