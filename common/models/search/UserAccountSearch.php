<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserAccount;

/**
 * UserAccountSearch represents the model behind the search form about `common\models\UserAccount`.
 */
class UserAccountSearch extends UserAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'tel', 'score', 'coin', 'zan', 'level', 'status', 'reserve1', 'reserve2', 'reserve3', 'reserve4'], 'integer'],
            [['role', 'username'], 'safe'],
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
        $query = UserAccount::find();

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
            'uid' => $this->uid,
            'tel' => $this->tel,
            'score' => $this->score,
            'coin' => $this->coin,
            'zan' => $this->zan,
            'level' => $this->level,
            'status' => $this->status,
            'reserve1' => $this->reserve1,
            'reserve2' => $this->reserve2,
            'reserve3' => $this->reserve3,
            'reserve4' => $this->reserve4,
        ]);

        $query->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
