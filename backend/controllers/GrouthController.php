<?php
namespace backend\controllers;

use common\models\Article;
use common\models\Chat;
use common\models\Shopcart;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dosamigos\qrcode\QrCode;
/**
 * Site controller
 */
class GrouthController extends Controller
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
        $this->layout="wide.php";
        if(isset($_POST['more'])) echo json_encode("ok");
        return $this->render('index');
    }


    public  function actionResult(){
        return $this->render('result');
    }
    public  function actionAbout(){
        $content='';
        $article=Article::find()->where(['like','article_name',"公司资料"])->one();
        if(!empty($article))  $content=$article->content;
        return $this->render('about',['content'=>$content]);
    }
    public  function actionClick($name){
        $content='';
        $article=Article::find()->where(['like','article_name',$name])->one();
        if(!empty($article))  $content=$article->content;

        return $content;
    }




}
