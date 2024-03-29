<?php

namespace common\models\query;

use common\models\domain\Group;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\domain\Group]].
 *
 * @see \common\models\domain\Group
 */
class GroupQuery extends ActiveQuery
{

    public function active()
    {
        return $this->andWhere('[[status]]', ['status' => Group::STATUS_ACTIVE]);
    }

    public function orderByName()
    {
        return $this->addOrderBy('[[name]] ASC');
    }

    /**
     * @inheritdoc
     * @return \common\models\domain\Group[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\domain\Group|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
