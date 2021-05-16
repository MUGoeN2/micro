<?php

namespace backend\controllers;

use common\models\Img;
use Yii;
use common\models\Intro;
use common\models\search\IntroSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IntroController implements the CRUD actions for Intro model.
 */
class IntroController extends Controller
{
    public $layout="admin.php";
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
     * Lists all Intro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IntroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Intro model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Intro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Intro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->showId=rand(1000,9999).date('md',time()).rand(1000,9999);
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Intro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Intro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Intro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Intro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Intro::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionUpload()
    {
        if (isset($_POST['timestamp'])) {
//          return json_encode("没有上传文件");
            $targetFolder = Yii::$app->basePath.'/web/uploads/intro/' . date('Ymd');
            $cate='pic';

            if(!file_exists($targetFolder)) {
                $dir=$targetFolder;  $mode=0777;
                mkdir($dir, $mode);
            }
            if (!empty($_FILES)) {
//              p($_FILES);die;
                $tempFile = $_FILES['Intro']['tmp_name'][$cate];
                $fileParts = pathinfo($_FILES['Intro']['name'][$cate]);
                $extension = $fileParts['extension'];
                $random = time() . rand(1000, 9999);
                $randName = $random . "." . $extension;
                $targetFile = rtrim($targetFolder, '/') . '/' . $randName;
                $fileTypes = array('jpg', 'jpeg', 'gif', 'png');

                $uploadfile_path = '/uploads/intro/' . date('Ymd') . '/' . $randName;
                $uploadfile_path_small = '/uploads/intro/' . date('Ymd') . '/small' . $randName;

                $callback['url'] = $uploadfile_path;
                $callback['url_small'] = $uploadfile_path_small;
                $callback['filename'] = $fileParts['filename'];
                $callback['randName'] = $random;
                if (in_array($fileParts['extension'], $fileTypes)) {
                    move_uploaded_file($tempFile, $targetFile);
//              p(111111);die;
                    self::Savepic($callback['url'],$callback['url_small'],Yii::$app->user->id,$_POST['type_id']); //更新数据库中img_samll字段

                    return json_encode("上传成功");
                } else {
                    return json_encode('不能上传后缀为' . $fileParts['extension'] . '文件');
                }
            } else {
                return json_encode("没有上传文件");
            }
        }
        else   return json_encode("没有上传文件");

    }
    public function Savepic($url,$url_small,$id,$type_id)
    {


        if(\yii\imagine\Image::thumbnail(Yii::$app->basePath.'/web'.$url, 230, 230)
            ->save(Yii::$app->basePath.'/web'.$url_small, ['quality' => 100])){

            if($img=Img::find()->where(['type_id'=>$type_id])->one()){
                $img->img_big=$url;
                $img->img_small=$url;
                $img->save();
                return true;
            }
            else{
                $img=new Img;
                $img->uid=$id;
                $img->type=1;
                $img->type_id=$type_id;
                $img->img_big=$url;
                $img->img_small=$url;
                $img->save();
                return true;
            }
        }
        else    return false;

    }
}
