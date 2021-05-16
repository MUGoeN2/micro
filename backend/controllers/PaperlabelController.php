<?php

namespace backend\controllers;

use common\models\CepingLabel;
use common\models\CepingPaper;
use common\models\CepingSubject;
use common\models\LabelCate;
use Yii;
use common\models\PaperLabel;
use common\models\search\PaperLabelSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaperlabelController implements the CRUD actions for PaperLabel model.
 */
class PaperlabelController extends Controller
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
     * Lists all PaperLabel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaperLabelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaperLabel model.
     * @param integer $paper_id
     * @param string $label_id
     * @return mixed
     */
    public function actionView($paper_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($paper_id),
        ]);
    }



    public function actionAdd()
    {

        $model = new CepingPaper();
        if($model->load(Yii::$app->request->post())){
               $model->paperId=rand(100,999).date('md').rand(100,999);
            if ($model->save()) {                                //取名成功则跳转到第二步
                return $this->redirect(['create', 'paper_name' => $model->paper_name, 'paper_id' =>$model->paperId]);
            }
            else {
                return $this->render('add', [
                    'model' => $model,
                ]);
            }

        }
        else {
            return $this->render('add', [
                         'model' => $model,
            ]);
        }
    }
    public function actionUpdate_paper($paper_id)
    {

        $model =CepingPaper::find()->where(['paperId'=>$paper_id])->one();
        if($model->load(Yii::$app->request->post())){
            if ($model->save()) {                                //取名成功则跳转到第二步
                return $this->redirect(['cepinglabel/admin']);
            }
            else {
                return $this->render('add', [
                    'model' => $model,
                ]);
            }

        }
        else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new PaperLabel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($paper_name,$paper_id)
    {

        if(isset($_POST['sub']))
        {
            foreach($_POST['Paper'] as  $key=>$v){
                $model = new PaperLabel();
                $model->paper_id=date('Ymdhi',time());
                $model->label_id="$key";
                if(!$model->save()){
                    p($model->getErrors());
                }else{
                    $this->redirect(['paperlabel/view','paper_id'=>$model->paper_id]);
                }
            }
        }

        $model=new LabelCate(); //新建试卷 试题对应表 然而并没有什么卵用只是利用了一下ActiveForm 的级联级下拉菜单
                                //创建试题成功后 去试卷中排序等 csubject/order
        return $this->render('create', [
                'model' => $model,
                'paper_name'=>$paper_name,
                'paper_id'=>$paper_id

        ]);
    }


    public  function  actionListlabel($cate){
        $countBranches = CepingLabel::find()
            ->where(['res1' => $cate])->andWhere(['parent_id'=>'0'])
            ->count();
        $branches = CepingLabel::find()
            ->where(['res1' => $cate])->andWhere(['parent_id'=>'0'])
            ->all();
        if ($countBranches > 0) {

                echo "<table class='table table-bordered' id='tags_table' >";
                echo "<tr>";
                $a=0;
            foreach ($branches as $branch) {
                    $a++;
                    echo "<td id='".$branch->id."'>#".$branch->id."、"."$branch->label_name</td>";
                    if($a%2==0) {  echo "</tr><tr>"; }
                }
                echo "</tr>";
                echo "</table>";

        } else {
            echo "无";
        }
    }


    public  function  actionSearch($content){
        $countBranches = CepingLabel::find()
            ->where(['like' ,'label_name',$content])->andWhere(['parent_id'=>'0'])
            ->count();
        $branches = CepingLabel::find()
            ->where(['like' ,'label_name',$content])->andWhere(['parent_id'=>'0'])
            ->all();
        if ($countBranches > 0) {

            echo "<table class='table table-bordered' id='tags_table' >";
            echo "<tr>";
            $a=0;
            foreach ($branches as $branch) {
                $a++;
                echo "<td id='".$branch->id."'>#".$branch->id."、"."$branch->label_name</td>";
                if($a%2==0) {  echo "</tr><tr>"; }
            }
            echo "</tr>";
            echo "</table>";

        } else {
            echo "无";
        }
    }
    /**
     * Updates an existing PaperLabel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $paper_id
     * @param string $label_id
     * @return mixed
     */
    public  function  actionSave_a($str,$paper_id){ //将选择好的试题组卷
     if(!empty($str)){
          $arr=explode('@$@',$str);

         foreach($arr as $v){
             if($v){

                 $labelMess=CepingLabel::findOne($v);

                 $checkExsit=CepingSubject::find()->where(['label_id'=>$labelMess->id,'paperId'=>$paper_id])->one();
           //      p($checkExsit);die;
                if(empty($checkExsit)){   //检查这个试卷的这道题是否存在  如果存在停止 返回yes
                                            //检查这个试卷的这道题是不存在 新建一个
                 $model=new CepingSubject();
                 $model->label_name=$labelMess->label_name;
                 $model->label_id="$labelMess->id";
                 $model->paperId="$paper_id";
                 $model->status=1;
                 if($model->save()){

                     $labelMess=CepingLabel::find()->where(['parent_id'=>$v])->orderBy('created_at')->all();
                     foreach($labelMess as $m){
                         $model_label=new CepingSubject();
                         $model_label->label_name=$m->label_name;
                         $model_label->label_id="$m->id";
                         $model_label->parent_id="$v";
                         $model_label->paperId="$paper_id";
                         $model_label->status=1;
                         if(!$model_label->save()) echo "no";
                     }
                 } else   echo "no";
             }
             }
         }
         echo "yes";
     }
    }

    public  function  actionSave_b($paper_id){

        $model=CepingSubject::find()->where(['paperId'=>$paper_id])->all();

      //  p($model);die;
        return $this->render('saveb',['model'=>$model]);
    }

    public function actionUpdate($paper_id)
    {
//        $model = $this->findModel($paper_id, $label_id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'paper_id' => $model->paper_id, 'label_id' => $model->label_id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }

        $paper_checked=PaperLabel::find()->where(['paper_id'=>$paper_id])->orderBy('label_id')->all();
        $paper_check=array();
        foreach($paper_checked as $v){
            $paper_check[]=$v->label_id;
        }

        if(isset($_POST['sub']))
        {
            // p($_POST);die;
            foreach($_POST['Paper'] as  $key=>$v){
                $model = new PaperLabel();
                $model->paper_id=date('m-d h:i',time());
                $model->label_id="$key";
                if(!$model->save()){
                    p($model->getErrors());
                };
            }
        }
        $labelModels=CepingLabel::find()->where(['question'=>"0"])->all();



        return $this->render('update', [
            //    'model' => $model,
            'labelModels' => $labelModels,
            //       $labelModels
            'paper_check'=>$paper_check,
        ]);





    }

    /**
     * Deletes an existing PaperLabel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $paper_id
     * @param string $label_id
     * @return mixed
     */
    public function actionDelete($paper_id, $label_id)
    {
        $this->findModel($paper_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PaperLabel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $paper_id
     * @param string $label_id
     * @return PaperLabel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($paper_id)
    {
        $model= PaperLabel::find()->where(['paper_id' =>$paper_id])->orderBy('label_id ASC')->all();
        if (!empty($model)) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
