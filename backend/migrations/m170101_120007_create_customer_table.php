<?php

use yii\db\Migration;

class m170101_120007_create_customer_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%customer}}', [
            'id' => $this->bigPrimaryKey(20),
            'first_name' => $this->string(50)->null(),
            'last_name' => $this->string(50)->null(),
            'email' => $this->string(255)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255)->unique(),
            'status' => "ENUM('active', 'inactive')",
            'gender' => "ENUM('male', 'female')",
            'language_id' => $this->bigInteger(20)->null(),
            'avatar_path' => $this->string(255),
            'avatar_base_url' => $this->string(255),
            'logged_at' => $this->integer()->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->createIndex('language_id', '{{%customer}}', 'language_id');
        $this->createIndex('status', '{{%customer}}', 'status');
    }

    public function safeDown()
    {
        $this->dropTable('{{%customer}}');
    }

}
