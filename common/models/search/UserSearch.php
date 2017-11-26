<?php

namespace common\models\search;

use common\models\domain\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{

    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['username', 'string', 'min' => 1, 'max' => 255],
            ['email', 'string', 'min' => 1, 'max' => 255],
            ['email', 'email'],
            ['gender', 'in', 'range' => [User::GENDER_MALE, User::GENDER_FEMALE]],
            ['status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_INACTIVE]],
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
        $query = User::find();

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

        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }

}