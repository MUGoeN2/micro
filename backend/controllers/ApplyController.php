<?php
namespace backend\controllers;


use common\models\Apply;
use common\models\OpenFront;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dosamigos\qrcode\QrCode;
/**
 * Site controller
 */
class ApplyController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout="admin.php";
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
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Apply::find()->orderBy('created_at DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }
    public function actionSended()
    {
        $query = Apply::find()->where(['status'=>1])->orderBy('created_at DESC');//标记为1 已发出
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('sended', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }
    public function actionReady()
    {
        $query = Apply::find()->where(['status'=>0,'res2'=>''])->orderBy('created_at DESC'); //标记为0 且没有注册
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('sended', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }
    public  function actionAllow($tel,$id){
        $num=rand(10,99).date('d').rand(10,99);
         $text="【Growthmemo】恭喜！您的内测申请已通过，内测码为".$num."。如非本人操作，请忽略本短信";
        // $text="【Growthmemo】恭喜！您的内测申请已通过，内测码为".$num."。如非本人操作，请忽略本短信";

        $apply=Apply::find()->where(['id'=>$id])->one();
        $apply->status=1;
        $apply->res1=$num;
        if($apply->save()){
            if(Yii::$app->smser->send($tel, $text))
                echo "yes";
            else echo"no";
        }else // p($apply->getErrors());
                echo"no";
    }
    public function actionControl()
    {
        $this->layout="admin.php";
        return $this->render('control');
    }
    public function actionOpen()
    {
        $open=OpenFront::find()->one();
        $open->switch=1;
        if($open->save()) echo "yes";
        else echo "no";
    }
    public function actionClose()
    {
        $open=OpenFront::find()->one();
        $open->switch=0;
        if($open->save()) echo "yes";
        else echo "no";

    }
}
