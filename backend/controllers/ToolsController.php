<?php
namespace backend\controllers;

use common\models\Article;
use common\models\ArticleCate;
use common\models\ArticleCate1;
use common\models\ArticleCate2;
use common\models\ArticleCate3;
use common\models\Chat;
use common\models\Intro;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * Site controller
 */
class ToolsController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout='meno.php';
    public function behaviors()
    {
        return [

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //  $model1=ArticleCate1::find()->all();
     //   $model1=ArticleCate2::find()->all();   //二级类查找
        $model_a=ArticleCate::find()->where(['parent_cate'=>'1'])->all();   //查找所有分类
        $model_b=ArticleCate::find()->where(['parent_cate'=>'2'])->all();   //查找所有分类
     //   $model2=Article::find()->all();        //文章查找


        return $this->render('index',['model_a'=>$model_a,'model_b'=>$model_b]);
    }
    public  function actionList($cate2,$cate3,$article_id){

        $cate=ArticleCate::find()->where(['parent_cate'=>2])->all(); //取工具导航用于遍历分类

        if($cate3==2){             //如果平台标记2  就是平台列表显示
          //  $model2=Intro::find()->where(['cate'=>$cate2])->all();
            $model = Intro::find()->where(['status' => NULL,'cate'=>$cate2]);
            if(isset($_GET['label'])){
                $model->andWhere(['like','name',$_GET['label']]);
            }
            $countQuery = clone $model;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $pages->pageSize=3;
            $models = $model->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

            return $this->render('xlist', [
                'cate'=>$cate,
                'models' => $models,
                'pages' => $pages,
            ]);
        }
        else{                 //如果平台标记1  就是文章显示
            $article=Article::find()->where(['article_id'=>$article_id])->one();
            return $this->render('list',['cate'=>$cate,'article'=>$article]);
        }

    }

//    public  function actionXlist($name) {
//
//        $model1=ArticleCate3::find()->where(['parent_cate'=>6])->all();
//        $model2=Article::find()->all();
//
//        $query = Intro::find()->where(['status' => NULL])->andWhere(['LIKE','cate',"$name"]);
//        $countQuery = clone $query;
//        $pages = new Pagination(['totalCount' => $countQuery->count()]);
//        $pages->pageSize=2;
//        $models = $query->offset($pages->offset)
//            ->limit($pages->limit)
//            ->all();
//
//        return $this->render('Xlist',[
//            'model1'=>$model1,
//            'model2'=>$model2,
//            'models' => $models,
//            'pages' => $pages,]);
//    }

   public  function actionGet($article_id){

       $article=Article::find()->where(['article_id'=>$article_id])->one();
       echo $article->content;
   }




}
