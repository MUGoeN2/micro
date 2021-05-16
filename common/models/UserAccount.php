<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_account}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $role
 * @property string $username
 * @property integer $tel
 * @property integer $score
 * @property integer $coin
 * @property integer $zan
 * @property integer $level
 * @property integer $status
 * @property integer $reserve1
 * @property integer $reserve2
 * @property integer $reserve3
 * @property integer $reserve4
 */
class UserAccount extends \yii\db\ActiveRecord    //用户账号表   其他数据
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_account}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'username', 'tel'], 'required'],
            [['uid', 'tel'], 'integer'],
            [['username'], 'string', 'max' => 40],
            [['username'], 'unique'],
            [['uid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户ID',
            'uid' => 'Uid',
            'role' => '用户类型',
            'username' => '用户名',
            'tel' => '电话',
            'score' => '积分',
            'coin' => '牛币',
            'zan' => '赞',
            'level' => '等级',
            'status' => 'Status',
            'reserve1' => '预留1',
            'reserve2' => '预留2',
            'reserve3' => '预留3',
            'reserve4' => '预留4',
        ];
    }
}
