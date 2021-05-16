<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cate', 'kind', 'read', 'weight', 'status', 'created_at', 'updated_at'], 'integer'],
            [['uid', 'username', 'article_id', 'time', 'pic','file', 'title', 'brief', 'content', 'res1', 'res2', 'res3'], 'safe'],
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
        $query = Article::find();

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
            'cate' => $this->cate,
            'kind' => $this->kind,
            'read' => $this->read,
            'weight' => $this->weight,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'article_id', $this->article_id])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'res1', $this->res1])
            ->andFilterWhere(['like', 'res2', $this->res2])
            ->andFilterWhere(['like', 'res3', $this->res3]);

        return $dataProvider;
    }
}
