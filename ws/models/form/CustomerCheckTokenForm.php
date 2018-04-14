<?php

namespace frontend\models\form;

use Yii;
use yii\base\Model;

/**
 * Customer check token form
 */
class CustomerCheckTokenForm extends Model
{

    public $token;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['token', 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'token' => Yii::t('common', 'Model.Token'),
        ];
    }

    /**
     * Extract customer data from token
     */
    public function extractData()
    {

    }
}
