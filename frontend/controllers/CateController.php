<?php

namespace frontend\controllers;

use Yii;
use common\models\Cate;
use common\models\search\CateSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CateController implements the CRUD actions for Cate model.
 */
class CateController extends Controller
{
    public $layout="manage.php";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['index','login','logout', 'signup', 'add-user'],
                'rules' => [
                    [
//                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    /**
     * Lists all Cate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cate model.
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
     * Creates a new Cate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $level=isset($_GET['level']) ? $_GET['level'] : 2;
        $model = new Cate();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'level' => $level,
            ]);
        }
    }
    /**
     * Updates an existing Cate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $level=$model->level;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'level' => $level,
            ]);
        }
    }
    public function actionUp($id)
    {
        //一级分类则置顶  二级分类则在同类中置顶
        $top=Cate::find()->where(['id'=>$id])->orderBy('weight DESC')->one();
        if($top->parent_id !=0 )  $top=Cate::find()->where(['parent_id'=>$top->parent_id])->orderBy('weight DESC')->one();
        if($top->weight==0) $top->weight=1;
        $weight=$top->weight+1;//新顶的文章比权值最大的多 1
        $model=Cate::find()->where(['id'=>$id])->one();
        $model->weight=$weight;
        $model->save();
        $this->redirect(['index']);
    }
    /**
     * Deletes an existing Cate model.
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
     * Finds the Cate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
