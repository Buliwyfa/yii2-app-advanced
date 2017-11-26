<?php

use yii\db\Migration;

class m170822_224101_create_gallery_table extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gallery}}', [
            'id' => $this->bigPrimaryKey(20),
            'title' => $this->string(255)->notNull(),
            'tag' => $this->string(255)->notNull(),
            'language_id' => $this->bigInteger(20)->null(),
            'status' => "ENUM('active', 'inactive')",
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->createIndex('tag', '{{%gallery}}', 'tag');
        $this->createIndex('language_id', '{{%gallery}}', 'language_id');
        $this->createIndex('status', '{{%gallery}}', 'status');
    }

    public function safeDown()
    {
        $this->dropTable('{{%gallery}}');
    }

}
