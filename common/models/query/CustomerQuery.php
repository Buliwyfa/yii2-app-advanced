<?php

namespace common\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\domain\Customer]].
 *
 * @see \common\models\domain\Customer
 */
class CustomerQuery extends ActiveQuery
{

    public function id($id)
    {
        return $this->andWhere('[[id]] = :id', ['id' => $id]);
    }

    /**
     * @inheritdoc
     * @return \common\models\domain\Customer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\domain\Customer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
