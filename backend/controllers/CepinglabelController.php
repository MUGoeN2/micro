<?php

namespace backend\controllers;

use common\models\CepingPaper;
use common\models\CepingSubject;
use common\models\search\CepingSubjectSearch;
use Yii;
use common\models\CepingLabel;
use common\models\search\CepingLabelSearch;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CepinglabelController implements the CRUD actions for CepingLabel model.
 */
class CepinglabelController extends Controller
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
     * Lists all CepingLabel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CepingLabelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CepingLabel model.
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
     * Creates a new CepingLabel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CepingLabel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CepingLabel model.
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
     * Deletes an existing CepingLabel model.
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
     * Finds the CepingLabel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CepingLabel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CepingLabel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public  function actionAdmin(){

        return $this->render('admin');

    }

    public  function actionAdd(){    //添加试题

        if(isset($_POST['sub'])){
  //p($_POST);die;
            $arr=explode('@',$_POST['answer']);
            $i=1;
            $Label_question=new CepingLabel;
            $Label_question->label_name=$_POST['main'];
            $Label_question->parent_id=0;
            $Label_question->res1=$_POST['cate'];  //res1 分类
            if($Label_question->save()){  //保存题干成功
                $Label_question->label_id="$Label_question->id";
                $Label_question->save();
                foreach($arr as $v){
                    $Label_answer=new CepingLabel;
                    $Label_answer->label_name=$v;
                    $Label_answer->parent_id="$Label_question->id";
                    $Label_answer->label_id=$Label_question->id.'.'.$i;
                    $Label_answer->res1=$_POST['cate'];
                    if($Label_answer->save()){//保存对应答案成功
                        $i++;
                    }
//                 else p($Label_answer->getErrors());
                 //  else return false;
                }
                return $this->redirect(['cepinglabel/showone','id'=>$Label_question->id,'cate'=>$Label_question->res1]);
            }  else return false;
            //else p($Label_question->getErrors());
        }else
        return $this->render('add');
    }

    public  function actionPaper(){
         $model=CepingPaper::find()->all();

        return $this->render('paper',['model'=>$model]);
    }
    public  function actionPal(){  //选择试卷添加试题
         $model=CepingPaper::find()->all();
        return $this->render('pal',['model'=>$model]);
    }
    public  function actionShowall(){
//        $connection = \Yii::$app->db;
//         //c_ceping_label 题库     查看题库
//        $sql='SELECT * FROM `c_ceping_label`  ORDER BY `c_ceping_label`.`label_id`*1 ASC';
//        $command = $connection->createCommand($sql);
//        $model = $command->queryAll();
         $query = CepingLabel::find()->where(['status' => null]);
         $countQuery = clone $query;
         $pages = new Pagination(['totalCount' => $countQuery->count()]);
         $pages->pageSize=20;
         $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $searchModel = new CepingLabelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('showall',['model'=>$models, 'dataProvider' => $dataProvider,'searchModel'=>$searchModel, 'pages' => $pages,]);
    }

    public  function actionShowone($id,$cate){

         $model=CepingLabel::find()->where(['id'=>$id,'res1'=>$cate])->orWhere(['parent_id'=>$id])->orderBy('id')->all();
 // p($model);die;
        return $this->render('showone',['model'=>$model]);
    }




}
