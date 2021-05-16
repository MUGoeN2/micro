<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserMess as UserMessModel;

/**
 * UserMess represents the model behind the search form about `common\models\UserMess`.
 */
class UserMess extends UserMessModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'role', 'age', 'weight', 'create_at', 'updated_at'], 'integer'],
            [['position', 'email', 'username', 'pic', 'sex', 'wechat', 'address', 'experience', 'education', 'res1', 'res2', 'res3'], 'safe'],
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
        $query = UserMessModel::find();

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
            'role' => $this->role,
            'age' => $this->age,
            'weight' => $this->weight,
            'create_at' => $this->create_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'wechat', $this->wechat])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'res1', $this->res1])
            ->andFilterWhere(['like', 'res2', $this->res2])
            ->andFilterWhere(['like', 'res3', $this->res3]);

        return $dataProvider;
    }
}
