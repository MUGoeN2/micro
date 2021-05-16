<?php

namespace backend\controllers;

use common\models\CepingDetail;
use Yii;
use common\models\CepingSubject;
use common\models\search\CepingSubjectSearch;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CsubjectController implements the CRUD actions for CepingSubject model.
 */
class CsubjectController extends Controller
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
     * Lists all CepingSubject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CepingSubjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CepingSubject model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CepingSubject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CepingSubject();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CepingSubject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

      //  p($id);die;
        $model = $this->findModel($id);
    //    p($model);die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CepingSubject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CepingSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CepingSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CepingSubject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionTest($paperId) {
        $question = CepingSubject::find()->where(['rank'=>'1','paperId'=>$paperId,'status'=>1])->one();
        $count=CepingSubject::find()->where(['parent_id'=>null,'status'=>1,'paperId'=>$paperId])->count();//->where(['status'=>1])->all()
      //p($question);die;
        $answers = CepingSubject::find()->where(['parent_id'=>$question->label_id,'status'=>1,'paperId'=>$paperId])->all();
     //   p($answers);die;
        return $this->render('test',[
            'question'=> $question,
            'answers'=>$answers,
            'count'=>$count,
            'paperId'=>$paperId
        ]);
    }
    public function actionPrevious($paperId) {
        $uid=Yii::$app->user->id;
      //  $time=time();
        $record = CepingDetail::find()->where(['userId'=>$uid,'paperId'=>$paperId,'status'=>1])->orderBy('updated_at DESC')->one();
      //  p($record);die;
        $record->status=0;
        $record->save();


        //detail表中subjectId为 题序号
        $question=CepingSubject::find()->where(['rank'=>$record->subjectId,'paperId'=>$paperId])->one();
       // p($record);die;
        $answers = CepingSubject::find()->where(['parent_id'=>$question->label_id,'paperId'=>$paperId])->all();
        return \Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'data' => [
                'question' => $question,
                'answers' => $answers
            ],
        ]);
    }
    public function actionNext($subjectId, $answerId,$paperId) {   //题目和选项的label_id，试卷号

    //    p($subjectId);p($answerId);p($paperId);die;

        //create detail
     //   $userId = 110103;
        $userId = Yii::$app->user->id;
//        $label = $answer->label;

        if($detail=CepingDetail::find()->where(['userId'=>$userId,'subjectId'=>$subjectId,'paperId'=>$paperId])->one()){
            $detail->label = $answerId;
            $detail->status = 1;
            $detailSaveResult =$detail->save();
        }else{
            $detail = new CepingDetail();
            $detail->userId = $userId;
            $detail->paperId = $paperId;
            $detail->subjectId = $subjectId;    //detail表中subjectId为 题序号
            $detail->label = $answerId;
            $detail->status = 1;
            $detailSaveResult = $detail->save();
        }

        //create or update result
//        if($detailSaveResult) {
//                $result = new CepingResult();
//                $result->userId = $userId;
//            $result->label_id = $userId;
//            $result->label_name= $userId;
//                $result->totalScore = $label;
//               $resultSaveResult = $result->save();
//        }
        //通过选择的答案编号 和 试卷编号 找到此条label
        $answer = CepingSubject::find()->where(['label_id'=>$answerId,'paperId'=>$paperId])->one();
        //通过此条label的parent_id属性找到 父标签对象
        $parent=CepingSubject::find()->where(['label_id'=>$answer->parent_id,'paperId'=>$paperId])->one();

      //  p($parent);die;
        if($detailSaveResult) {
            if(empty($answer->foreign_id)) {
                //如果此条答案没有跳转 则使用父对象rank+1 作为跳转编号
                $answer->foreign_id = $parent->rank*1 + 1;
                //    p($answer->foreign_id);
                //如果有foreign_id 则通过foreign_id跳转id找到下道题的对象
                    $next = CepingSubject::find()->where(['rank'=>$answer->foreign_id,'paperId'=>$paperId])->one();
            }else   $next = CepingSubject::find()->where(['rank'=>$answer->foreign_id,'paperId'=>$paperId])->one();

       //    p($next);
            //通过下道题的对象编号 找到此题的选项
            $nextAnswer = CepingSubject::find()->where(['parent_id'=>$next->label_id,'paperId'=>$paperId])->all();
        // p($nextAnswer);die; //
            $sub_next = CepingSubject::find()->where(['rank'=>($next->rank + 1),'paperId'=>$paperId])->one();

            if($sub_next) {
                $end = false;
            } else {
                $end = true;
            }
            return \Yii::createObject([
                'class' => 'yii\web\Response',
                'format' => \yii\web\Response::FORMAT_JSON,
                'data' => [
                    'next' => $next,
                    'nextAnswer' => $nextAnswer,
                    'end' => $end
                ],
            ]);
        }
        else return false;
    }
    public function actionResult($subjectId, $answerId, $paperId){

        $userId = Yii::$app->user->id;

            $detail = new CepingDetail();
            $detail->userId = $userId;
            $detail->paperId = $paperId;
            $detail->subjectId = $subjectId;
            $detail->label = $answerId;
            $detail->status = 1;
            $detail->save();

        return $this->redirect(['creport/init', 'paperId'=>$paperId]);
    }
    public  function actionShow($paperId){
        $connection = \Yii::$app->db;
        //c_ceping_label 题库
        //  $sql='SELECT * FROM `c_ceping_label` WHERE `paperId`='.$paperId.' ORDER BY `c_ceping_label`.`label_id`*1 ASC';
        //c_ceping_subject 试卷
        $sql='SELECT * FROM `c_ceping_label` WHERE `paperId`='.$paperId.' ORDER BY `c_ceping_label`.`label_id`*1 ASC';

        $command = $connection->createCommand($sql);
        $model = $command->queryAll();
//p($model);die;
        //  $model=CepingSubject::find()->where(['paperId'=>$paperId])->orderBy('id')->all();

        return $this->render('show',['model'=>$model]);
    }
    public  function actionShowpaper($paperId){

        $query = CepingSubject::find()->where(['paperId' => $paperId,'parent_id'=>null])->orderBy('rank');//->orderBy('rank')
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->pageSize=200;
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $searchModel = new CepingSubjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('showpaper',['model'=>$models, 'dataProvider' => $dataProvider,'searchModel'=>$searchModel, 'pages' => $pages,]);
    }
    public function actionOrder($paper_name,$paper_id){

        //获取刚刚选好的试题 排序 选择跳转等操作
        $model=CepingSubject::find()->where(['paperId' => $paper_id,'parent_id'=>null])->orderBy('rank ASC')->all();
        $count=CepingSubject::find()->where(['paperId' => $paper_id,'parent_id'=>null])->count();
        //p($count);die;
        return $this->render('order',['model'=>$model,'paper_name'=>$paper_name,'count'=>$count,'paper_id'=>$paper_id]);

    }
    public function actionSave_order($arr,$arr_jump,$paper_id){
   // p($arr);

        $arr=json_decode($arr);
        $arr_jump=json_decode($arr_jump);
      //  p($arr);die;
        foreach($arr as $v){
            if($v){
            $array=explode('@a@',$v);  //找出这个id的题   将他的rank 赋值为weight权重  用来排序
            $model=CepingSubject::find()->where(['id'=>$array[0],'paperId'=>$paper_id])->one();
            $model->rank="$array[1]";   //用rank再带 weight
            if(!$model->save()) echo "no";
        }
        }
        foreach($arr_jump as $v){
            if($v){
            $array=explode('@a@',$v);  //找出这套题rank为$array[1]的题  将此题的id赋值给选项的foreign_id
                $checkModel=CepingSubject::find()->where(['rank'=>"$array[1]",'paperId'=>$paper_id])->one();
                $model=CepingSubject::find()->where(['id'=>$array[0],'paperId'=>$paper_id])->one();

            $model->foreign_id="$checkModel->rank";
            if(!$model->save()) echo "no";
        }
        }
        echo "yes";
    }


}
