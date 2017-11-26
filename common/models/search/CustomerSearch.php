<?php

namespace common\models\search;

use common\models\domain\Customer;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CustomerSearch extends Customer
{

    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['email', 'string', 'min' => 1, 'max' => 255],
            ['email', 'email'],
            [['first_name', 'last_name'], 'string', 'min' => 1, 'max' => 50],
            ['gender', 'in', 'range' => [Customer::GENDER_MALE, Customer::GENDER_FEMALE]],
            ['status', 'in', 'range' => [Customer::STATUS_ACTIVE, Customer::STATUS_INACTIVE]],
            ['avatar_path', 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Customer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'email' => $this->email,
            'gender' => $this->gender,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name]);
        $query->andFilterWhere(['like', 'last_name', $this->last_name]);

        return $dataProvider;
    }

}