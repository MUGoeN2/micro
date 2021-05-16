<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Item;

/**
 * ItemSearch represents the model behind the search form about `common\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'weight', 'cate', 'status', 'created_at', 'updated_at'], 'integer'],
            [['item_id', 'title', 'pic', 'pic_src', 'desc', 'cate'], 'safe'],
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
        $query = Item::find();

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
             'weight' => $this->weight,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'item_id', $this->item_id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'cate', $this->cate])
            ->andFilterWhere(['like', 'pic_src', $this->pic_src])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
