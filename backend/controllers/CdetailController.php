<?php

namespace backend\controllers;

use Yii;
use common\models\CepingDetail;
use common\models\search\CepingDetailSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CdetailController implements the CRUD actions for CepingDetail model.
 */
class CdetailController extends Controller
{
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
     * Lists all CepingDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CepingDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CepingDetail model.
     * @param string $userId
     * @param string $subjectId
     * @return mixed
     */
    public function actionView($userId, $subjectId)
    {
        return $this->render('view', [
            'model' => $this->findModel($userId, $subjectId),
        ]);
    }

    /**
     * Creates a new CepingDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CepingDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userId' => $model->userId, 'subjectId' => $model->subjectId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CepingDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $userId
     * @param string $subjectId
     * @return mixed
     */
    public function actionUpdate($userId, $subjectId)
    {
        $model = $this->findModel($userId, $subjectId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userId' => $model->userId, 'subjectId' => $model->subjectId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CepingDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $userId
     * @param string $subjectId
     * @return mixed
     */
    public function actionDelete($userId, $subjectId)
    {
        $this->findModel($userId, $subjectId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CepingDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $userId
     * @param string $subjectId
     * @return CepingDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($userId, $subjectId)
    {
        if (($model = CepingDetail::findOne(['userId' => $userId, 'subjectId' => $subjectId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
