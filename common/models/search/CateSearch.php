<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cate;

/**
 * CateSearch represents the model behind the search form about `common\models\Cate`.
 */
class CateSearch extends Cate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'level','kind', 'parent_id', 'weight', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'pic', 'custom'], 'safe'],
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
        $query = Cate::find();

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
            'level' => $this->level,
            'kind' => $this->kind,
            'parent_id' => $this->parent_id,
            'weight' => $this->weight,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'custom', $this->custom]);

        return $dataProvider;
    }
}
