<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%cate}}".
 *
 * @property integer $id
 * @property integer $level
 * @property integer $kind
 * @property string $name
 * @property integer $parent_id
 * @property string $pic
 * @property string $custom
 * @property integer $weight
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Cate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cate}}';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level','kind', 'parent_id', 'weight', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'parent_id','kind',], 'required'],
            [['custom'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['pic'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => '分类等级',
            'kind' => '属性',
            'name' => '名称',
            'parent_id' => '父级分类',
            'pic' => '图片',
            'custom' => '自定义',
            'weight' => 'Weight',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public  function get_cate_model($id){  //找到第一个子分类 如果没有子分类返回本分类
        $model=\common\models\Cate::find()->where(['id'=>$id])->one();
        if($model -> parent_id == 0) $cate_model=\common\models\Cate::find()->where(['parent_id'=>$id])->orderBy('weight DESC')->one();
        else $cate_model=$model;
        if(!empty($cate_model)) return $cate_model;
        else return "";
    }
    public  function get_parent_model($id){ //找到父级分类 如果没有父级分类返回本分类
        $cate=\common\models\Cate::find()->where(['id'=>$id])->one();
        if($cate->parent_id !=0 ) $parent_cate=\common\models\Cate::find()->where(['id'=>$cate->parent_id])->one();
        else $parent_cate=$cate;
        if(!empty($parent_cate)) return $parent_cate;
        else return "";
    }
    public  function get_children_model($id){  //找到兄弟级分类
        $children_cate=\common\models\Cate::find()->where(['parent_id'=>$id])->one();
        if(!empty($children_cate)) return $children_cate;
        else return "";
    }
    public  function get_bro_models($id){
        $cate=\common\models\Cate::find()->where(['id'=>$id])->one();
        if($cate->parent_id !=0 )
            $bro_cate=\common\models\Cate::find()->where(['parent_id'=>$cate->parent_id])->all();
        else   $bro_cate=\common\models\Cate::find()->where(['parent_id'=>$id])->all();
        if(!empty($bro_cate)) return $bro_cate;
        else return "";
    }
    public  function get_cate_models($id){
        $cate=\common\models\Cate::find()->where(['id'=>$id])->one();
        $models=\common\models\Cate::find()->where(['parent_id'=>$cate->parent_id])->all();
        if(!empty($models))  return $models;
        else return "";
    }
}
