<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%img}}".
 *
 * @property string $id
 * @property string $img_id
 * @property string $uid
 * @property integer $type
 * @property string $cate
 * @property string $src_id
 * @property string $img_big
 * @property string $img_small
 * @property integer $status
 * @property integer $weight
 * @property string $created_at
 * @property string $updated_at
 * @property integer $res1
 * @property string $res2
 * @property string $res3
 */
class Img extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%img}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img_id','uid', 'type', 'src_id'], 'required'],
            [['type',  'status', 'weight', 'created_at', 'updated_at', 'res1'], 'integer'],
            [['uid'], 'string', 'max' => 20],
            [['cate','src_id','img_id',], 'string', 'max' => 32],
            [['img_big', 'img_small', 'res2', 'res3'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_id' => 'img_id',
            'uid' => 'Uid',
            'type' => 'Type',
            'cate' => 'Cate',
            'src_id' => 'Src ID',
            'img_big' => 'Img Big',
            'img_small' => 'Img Small',
            'status' => 'Status',
            'weight' => 'Weight',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'res1' => 'Res1',
            'res2' => 'Res2',
            'res3' => 'Res3',
        ];
    }
}
