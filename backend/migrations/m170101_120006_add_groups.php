<?php

use common\models\domain\Group;
use yii\db\Migration;

class m170101_120006_add_groups extends Migration
{

    public function safeUp()
    {
        $this->insert('{{%group}}', [
            'id' => 1,
            'name' => 'Group.Name.BasicAccess',
            'status' => Group::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%group}}', ['id' => 1]);
    }

}
