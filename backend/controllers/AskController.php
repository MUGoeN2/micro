<?php
namespace backend\controllers;


use common\models\Chat;
use common\models\Img;
use common\models\Shopcart;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dosamigos\qrcode\QrCode;
/**
 * Site controller
 */
class AskController extends Controller
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
        $this->layout="wide.php";

        return $this->render('index');
    }

    public function actionAsk($question){

        $uid=Yii::$app->user->id;
        $record=Chat::find()->where(['userId'=>$uid,'status'=>1])->orderBy('created_at DESC')->one();
        $count=0;
        $paid=Shopcart::find()->where(['userId'=>$uid,'status'=>1])->all();
        if(isset($paid))  $count=count($paid);

        if(isset($record)&&(time()-$record->created_at<60)){
            echo "asked";
        }else {
            $model = new Chat();
            $model->userId = $uid;
            $model->content = $question;
            $model->parent_id = 0;
            $model->to = 0;
            $model->status = 1;
            $model->weight=$count;
            $model->username = Yii::$app->user->identity->username;
            if ($model->save())
            {
                echo "yes";
            } else   {
                echo "no";
            }
        }

    }
    public function actionChat(){
        $query = Chat::find()->where(['status' => 1,'parent_id'=>0])->orderBy([ 'created_at' => SORT_DESC, 'weight' => SORT_DESC,]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->pageSize=5;
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('chat', [
            'models' => $models,
            'pages' => $pages,
        ]);

    }
    public function actionReply($content,$parent_id,$to){

        $chat=new Chat();
        $chat->content=$content;
        $chat->to=$to*1;
        $uid=Yii::$app->user->id;
        $chat->userId="admin".$uid;
        $chat->username=Yii::$app->user->identity->username;
        $chat->parent_id=$parent_id*1;
        if($chat->save()){
            $img=Img::find()->where(['uid'=>$chat->userId])->one();
            if(isset($img)) {$chat->res1=Yii::$app->request->baseUrl.$img->img_small;}
            else $chat->res1=Yii::$app->request->baseUrl.'\img\demo.png';
            $chat->created_at=date('Y-m-d h:i',$chat->created_at);
            $chat->res2=Chat::findOne(['id'=>$chat->to])->username;

            return \Yii::createObject([
                'class' => 'yii\web\Response',
                'format' => \yii\web\Response::FORMAT_JSON,
                'data' => [
                    'obj' => $chat,
                    'code' => 100,
                ],
            ]);
        }
        else{
//            p($chat->getErrors());
            echo "no";
            return false;
        }

    }

}
