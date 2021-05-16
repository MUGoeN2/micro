<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property integer $cate
 * @property integer $kind
 * @property string $uid
 * @property string $username
 * @property string $article_id
 * @property string $time
 * @property string $pic
 * @property string $file
 * @property string $title
 * @property string $brief
 * @property string $content
 * @property integer $read
 * @property integer $weight
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $res1
 * @property string $res2
 * @property string $res3
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
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
            [['uid', 'article_id', 'title', 'brief'], 'required'],
            [['cate','kind', 'read', 'weight', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['uid'], 'string', 'max' => 20],
            [['username', 'article_id', 'time'], 'string', 'max' => 40],
            [['pic','file', 'res1', 'res2', 'res3'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 100],
            [['brief'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cate' => '栏目',
            'kind' => '文章类型',
            'uid' => '作者ID',
            'username' => '作者用户名',
            'article_id' => '文章ID',
            'time' => '时间',
            'pic' => '文章配图',
            'file' => '文件',
            'title' => '标题',
            'brief' => '摘要',
            'content' => '文章内容',
            'read' => '阅读量',
            'weight' => 'Weight',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'res1' => 'Res1',
            'res2' => 'Res2',
            'res3' => 'Res3',
        ];
    }
    public  function get_cate_model($article_id){
        $article=Article::find()->where(['article_id'=>$article_id])->one();
        $model=\common\models\Cate::find()->where(['id'=>$article->cate])->one();
        if(!empty($model)) return $model;
        else return "";
    }
    public  function get_parent_model($article_id){
        $article=Article::find()->where(['article_id'=>$article_id])->one();
        $cate=\common\models\Cate::find()->where(['id'=>$article->cate])->one();
        $parent_cate=\common\models\Cate::find()->where(['id'=>$cate->parent_id])->one();
        if(!empty($parent_cate)) return $parent_cate;
        else return "";
    }
    public  function get_cate_models($article_id){
        $article=Article::find()->where(['article_id'=>$article_id])->one();
        $cate=\common\models\Cate::find()->where(['id'=>$article->cate])->one();
        $models=\common\models\Cate::find()->where(['parent_id'=>$cate->parent_id])->all();
        if(!empty($models))  return $models;
        else return "";
    }
}
