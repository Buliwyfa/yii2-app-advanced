<?php

use common\models\domain\Content;
use yii\db\Migration;

class m170818_042022_add_contents extends Migration
{

    public function safeUp()
    {
        // about content
        $this->insert('{{%content}}', [
            'title' => 'About us',
            'tag' => Content::TAG_ABOUT_US,
            'content' => 'Insert content <a href="/admin/content">here</a>.',
            'language_id' => 0,
            'status' => Content::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        // privacy content
        $this->insert('{{%content}}', [
            'title' => 'Privacy policy',
            'tag' => Content::TAG_PRIVACY_POLICY,
            'content' => 'Insert content <a href="/admin/content">here</a>.',
            'language_id' => 0,
            'status' => Content::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        // terms content
        $this->insert('{{%content}}', [
            'title' => 'Terms of use',
            'tag' => Content::TAG_TERMS_OF_USE,
            'content' => 'Insert content <a href="/admin/content">here</a>.',
            'language_id' => 0,
            'status' => Content::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%content}}', ['tag' => Content::TAG_ABOUT_US]);
        $this->delete('{{%content}}', ['tag' => Content::TAG_PRIVACY_POLICY]);
        $this->delete('{{%content}}', ['tag' => Content::TAG_TERMS_OF_USE]);
    }

}
