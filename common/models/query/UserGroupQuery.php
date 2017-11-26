<?php

namespace common\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\domain\UserGroup]].
 *
 * @see \common\models\domain\UserGroup
 */
class UserGroupQuery extends ActiveQuery
{

    /**
     * @inheritdoc
     * @return \common\models\domain\UserGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\domain\UserGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
