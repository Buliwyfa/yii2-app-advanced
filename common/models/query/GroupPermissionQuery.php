<?php

namespace common\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\domain\GroupPermission]].
 *
 * @see \common\models\domain\GroupPermission
 */
class GroupPermissionQuery extends ActiveQuery
{

    /**
     * @inheritdoc
     * @return \common\models\domain\GroupPermission[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\domain\GroupPermission|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
