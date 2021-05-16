<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_mess}}".
 *
 * @property string $id
 * @property string $uid
 * @property integer $role
 * @property string $position
 * @property string $email
 * @property string $username
 * @property string $pic
 * @property string $sex
 * @property integer $age
 * @property string $wechat
 * @property string $address
 * @property string $experience
 * @property string $education
 * @property integer $weight
 * @property string $create_at
 * @property string $updated_at
 * @property string $res1
 * @property string $res2
 * @property string $res3
 */
class UserMess extends \yii\db\ActiveRecord    //用户详细信息表
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_mess}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid', 'role', 'weight', 'create_at', 'updated_at'], 'integer'],
            [['position','age', 'pic', 'res1', 'res2', 'res3'], 'string', 'max' => 80],
            [['email', 'username', 'wechat'], 'string', 'max' => 40],
            [['position', 'pic', 'res1', 'res2', 'res3'], 'string', 'max' => 80],
            [['email', 'age', 'wechat', 'addressPro', 'addressCity', 'addressDistrict'], 'string', 'max' => 40],
            [['sex'], 'string', 'max' => 6],
            [['address'], 'string', 'max' => 200],
            [['experience', 'education'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'role' => '角色',
            'position' => '职位',
            'email' => 'Email',
            'username' => '用户名',
            'pic' => '头像',
            'sex' => '性别',
            'age' => '出生日期',
            'wechat' => '微信号',
            'addressPro' => 'Address Pro',
            'addressCity' => 'Address City',
            'addressDistrict' => 'Address District',
            'address' => '地址',
            'experience' => '职业经历',
            'education' => '教育经历',
            'weight' => '权重',
            'create_at' => 'Create At',
            'updated_at' => 'Updated At',
            'res1' => 'Res1',
            'res2' => 'Res2',
            'res3' => 'Res3',
        ];
    }
    public function getRelationImg()
    {
        return $this->hasOne(Img::className(), ['uid' => 'id']);
    }
}
