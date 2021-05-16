<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserMessage;

/**
 * UserMessageSearch represents the model behind the search form about `common\models\UserMessage`.
 */
class UserMessageSearch extends UserMessage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'user_type', 'tel'], 'integer'],
            [['username', 'nickname', 'pic', 'pic_small', 'email', 'realname', 'birthday', 'provience', 'city', 'district', 'address_detail', 'identity', 'identity_front', 'identity_back', 'drive', 'drive_front', 'drive_back', 'brief', 'intro', 'show', 'reserve1', 'reserve2', 'reserve3'], 'safe'],
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
        $query = UserMessage::find();

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
            'user_type' => $this->user_type,
            'tel' => $this->tel,
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'pic_small', $this->pic_small])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'realname', $this->realname])
            ->andFilterWhere(['like', 'provience', $this->provience])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'address_detail', $this->address_detail])
            ->andFilterWhere(['like', 'identity', $this->identity])
            ->andFilterWhere(['like', 'identity_front', $this->identity_front])
            ->andFilterWhere(['like', 'identity_back', $this->identity_back])
            ->andFilterWhere(['like', 'drive', $this->drive])
            ->andFilterWhere(['like', 'drive_front', $this->drive_front])
            ->andFilterWhere(['like', 'drive_back', $this->drive_back])
            ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'show', $this->show])
            ->andFilterWhere(['like', 'reserve1', $this->reserve1])
            ->andFilterWhere(['like', 'reserve2', $this->reserve2])
            ->andFilterWhere(['like', 'reserve3', $this->reserve3]);

        return $dataProvider;
    }
}
