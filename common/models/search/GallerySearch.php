<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\domain\Gallery;

/**
 * GallerySearch represents the model behind the search form about `common\models\domain\Gallery`.
 */
class GallerySearch extends Gallery
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'language_id'], 'integer'],
            [['title', 'tag', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Gallery::find();
        $query->onlyAllowedLanguage();

        $query->joinWith('language');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'language_id' => $this->language_id,
            'status' => $this->status,
            'tag' => $this->tag,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

}
