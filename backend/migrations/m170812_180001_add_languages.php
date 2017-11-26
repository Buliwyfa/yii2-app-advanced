<?php

use yii\db\Migration;

class m170812_180001_add_languages extends Migration
{

    public function safeUp()
    {
        $this->insert('{{%language}}', ['name' => 'English', 'native_name' => 'English', 'code_iso_639_1' => 'en', 'code_iso_language' => 'en-US', 'created_at' => time()]);
        $this->insert('{{%language}}', ['name' => 'Portuguese', 'native_name' => 'Português', 'code_iso_639_1' => 'pt', 'code_iso_language' => 'pt-BR', 'created_at' => time()]);
    }

    public function safeDown()
    {
        $this->delete('{{%language}}', ['code_iso_language' => 'en-US']);
        $this->delete('{{%language}}', ['code_iso_language' => 'pt-BR']);
    }

}
