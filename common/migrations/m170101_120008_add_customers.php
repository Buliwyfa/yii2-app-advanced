<?php

use common\models\domain\Customer;
use yii\db\Migration;

class m170101_120008_add_customers extends Migration
{

    public function safeUp()
    {
        $this->insert('{{%customer}}', [
            'first_name' => 'Paulo',
            'last_name' => 'Coutinho',
            'email' => 'paulo@prsolucoes.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('customer@password'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'password_reset_token' => Yii::$app->getSecurity()->generatePasswordHash('customer-reset-token'),
            'status' => Customer::STATUS_ACTIVE,
            'gender' => Customer::GENDER_MALE,
            'language_id' => 1,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%customer}}', ['email' => 'paulo@prsolucoes.com']);
    }

}
