<?php

namespace backend\controllers;

use Yii;
use common\models\ShopCards;
use common\models\search\ShopCardsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CardsController implements the CRUD actions for ShopCards model.
 */
class CardsController extends Controller
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
     * Lists all ShopCards models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopCardsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShopCards model.
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
     * Creates a new ShopCards model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (Yii::$app->request->post()) {
            $post=Yii::$app->request->post();
            $num=$post['num'];
            for($i=0;$i<$num;$i++){
                $model = new ShopCards();
                $model->card_id=rand(1000,9999).date('mdhi').rand(1000,9999);
                $model->card_name=$post['name'];
                $model->save();
            }
            return $this->redirect(['site/admin']);
        } else {
            return $this->render('create');
        }
    }
    public function  actionDel(){
        if (Yii::$app->request->post()){
            $post=Yii::$app->request->post();
            if($post['del']=="确认清空"){
                ShopCards::deleteAll();
                return $this->redirect(['site/admin']);
            }
        }
        return $this->render('del');
    }

    /**
     * Updates an existing ShopCards model.
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
     * Deletes an existing ShopCards model.
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
     * Finds the ShopCards model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopCards the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopCards::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
