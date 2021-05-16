<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%item}}".
 *
 * @property integer $id
 * @property string $item_id
 * @property string $cate
 * @property string $title
 * @property string $pic
 * @property string $pic_src
 * @property string $desc
 * @property integer $weight
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'title', 'cate'], 'required'],
            [['desc'], 'string'],
            [['weight', 'status', 'created_at', 'updated_at'], 'integer'],
            [['item_id',  'cate','title'], 'string', 'max' => 64],
            [['pic', 'pic_src'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'title' => 'Title',
            'cate' => '类型',
            'pic' => 'Pic',
            'pic_src' => 'Pic Src',
            'desc' => 'Desc',
            'weight' => 'Weight',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
