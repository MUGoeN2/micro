<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArticleCate;

/**
 * ArticleCateSearch represents the model behind the search form about `common\models\ArticleCate`.
 */
class ArticleCateSearch extends ArticleCate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_cate', 'cate', 'type', 'weight', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'res1', 'res2', 'res3'], 'safe'],
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
        $query = ArticleCate::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_cate' => $this->parent_cate,
            'cate' => $this->cate,
            'type' => $this->type,
            'weight' => $this->weight,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'res1', $this->res1])
            ->andFilterWhere(['like', 'res2', $this->res2])
            ->andFilterWhere(['like', 'res3', $this->res3]);

        return $dataProvider;
    }
}
