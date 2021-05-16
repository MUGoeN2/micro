<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $cate
 * @property string $url
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
         return [
            [['cate', 'url','pic'], 'required'],
            [['cate','weight'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['url'], 'url', 'message' => '请输入正确url地址(形如 http://www.baidu.com/)'],
            [['url'], 'string', 'max' => 200],
            [['pic'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '描述',
            'cate' => '种类',
            'url' => '链接地址',
            'pic' => '图片',
            'weight' => '权值',
        ];
    }
}
