<?php

namespace backend\controllers;

use common\models\CepingDetail;
use common\models\CepingLabel;
use common\models\CepingResult;
use common\models\CepingSubject;
use common\models\ReportCate;
use common\models\Shopcart;
use Yii;
use common\models\CepingReport;
use common\models\CepingReportResearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CreportController implements the CRUD actions for CepingReport model.
 */
class CreportController extends Controller
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
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
//                'config' => [
//                    "imageUrlPrefix"  => "http://www.baidu.com",//图片访问路径前缀
//                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}" //上传保存路径
//                ],
            ]
        ];
    }
    /**
     * Lists all CepingReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CepingReportResearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CepingReport model.
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
     * Creates a new CepingReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CepingReport();
//        if(Yii::$app->request->post()){
//            p(Yii::$app->request->post());die;
//        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            // p($model->getErrors());
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionGettags($paper_id){
        $labels=\common\models\CepingSubject::find()->where(['paperId'=>$paper_id,'res3'=>null])->all();

        echo "<table class='table table-bordered'   style='text-align:center;margin-top: 20px' >";
        //  echo "<tr><th>选择包含标签</th></tr>";
        echo "<tr>";
        $a=0;
        foreach($labels as $v){
            $a++;
            echo "<td >$v->id</td>";
            if($a%20==0) {  echo "</tr><tr>"; }
        }
        echo "</tr>";
        echo "</table>";
    }
    /**
     * Updates an existing CepingReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing CepingReport model.
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
     * Finds the CepingReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CepingReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = CepingReport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionListlabel($paperId){

        $countBranches = CepingSubject::find()
            ->where(['paperId' => $paperId])
            ->count();

        $branches = CepingSubject::find()
            ->where(['paperId' => $paperId])
            ->all();

        if ($countBranches) {
            echo "<option>全部</option>";
            foreach ($branches as $branche) {

                if($branche->parent_id) echo "<option id='" . $branche->label_id . "'>" .'&#12288; '.$branche->label_name . "&#12288;&#12288;(".$branche->label_id.")</option>";
                else echo "<option id='" . $branche->label_id . "'>" . $branche->rank.'、'. $branche->label_name . "</option>";
            }

        } else {
            echo "<option>全部</option>";
        }

    }

    public function actionList()
    {
        $model=CepingReport::find()->all();
        return $this->render('list',['model'=>$model]);
    }


    public function actionInit($paperId) {

        $this->layout="wide.php";
        $userId = Yii::$app->user->id;
        $reports = CepingReport::find()->all();
        $details = CepingDetail::find()->where(['userId'=>$userId,'paperId'=>$paperId])->all();
        //  p($details);die;
        $product_id=rand(1000,9999).date('YmdHis').rand(1000,9999);

        $finalReport = array();

        foreach($reports as $report) {  //循环已有报告
            //
            $removeFlag = false;
            $containFlag = false;
            $removes = explode("@", $report->removeTag);   //取出报告排除标签
            $contains = explode("@", $report->containTag);  //取出报告包含标签
//            p($removes);
//            p($contains);
//            die;
            foreach ($details as $detail) {                //循环用户答题标签
                $label = $detail->label;
                foreach($removes as $remove) {              //循环报告排除标签
                    if($label == $remove) {                 //包含排除标签就跳转到下一个报告
                        $removeFlag = true;
                        break;
                    }
                }

                if($removeFlag) {                             //包含排除标签就跳转到下一个报告
                    break;
                }

                foreach($contains as $contain) {               //循环报告包含标签
                    if($label == $contain) {
                        $containFlag = true;
                    }
                }
            }
            if(!$removeFlag && $containFlag) {                 //判断无 排除标签  有包含标签则选择该报告
                $finalReport[] = $report;

                $record=new CepingResult;                       //保存此用户报告记录
                $record->userId=$userId;
                $record->paper_id=$paperId;
                $record->report_id="$report->id";
                $record->report_name=$report->name;
                $record->status=1;
                $record->name="我的测评";
                $record->product_id=$product_id;    //此报告的商品号
                $record->save();
//                if(!$record->save())
//                {p($record->getErrors());die;}
            }
        }
        // echo count($finalReport);die;
        if(count($finalReport) > 0) {    //判断数组是否有报告
            return $this->redirect(['product','paper_id'=>$paperId,'product_id'=>$product_id]);
        } else {
            return false;
        }

    }
    public function actionSummary(){

        return $this->render('summary');
    }
    public function actionDetail($paper_id,$level,$name,$product_id){  //点击某大类标题 或了解详细处理action
        $this->layout="wide.php";
        $uid=Yii::$app->user->id;
        $result=\common\models\Shopcart::find()->where(['uid'=>$uid,'product_id'=>$product_id,'status'=>1])->one();
        if(empty($result)){    //没有支付 则停止继续执行
            return false;
        }
        //已支付则查询并显示
        $finalReport=CepingReport::find()->where(['paperId'=>$paper_id,'status'=>1])->andWhere(['like','level',$level])->all();
        $showReport='';
        if(!empty($name))
            $showReport=CepingReport::find()->where(['paperId'=>$paper_id,'name'=>$name,'status'=>1])->andWhere(['like','level',$level])->one();
        // p($finalReport);die;
        return $this->render('detail',[
            'finalReport'=>$finalReport,
            'paper_id'=>$paper_id,
            'showReport'=>$showReport,
            'product_id'=>$product_id
        ]);
    }
    public  function actionResult_back($paper_id,$product_id){   //收费版展示
        $this->layout="wide.php";

        $uid=Yii::$app->user->id;
        //再次监测是否收费
        $pay_record=Shopcart::find()->where(['uid'=>$uid,'product_id'=>$product_id])->one();
        $finalReport=array();
        if(!empty($pay_record)&&$pay_record->status==1){   //如果已经支付 查询此product_id的报告用于展示

            $reports=CepingResult::find()->where(['paper_id'=>$paper_id,'userId'=>$uid,'status'=>1,'product_id'=>$product_id])->all();
            foreach($reports as $v){
                $finalReport[]=CepingReport::find()->where(['id'=>$v->report_id])->one();
            }
            return $this->render('result',['finalReport'=>$finalReport,'paper_id'=>$paper_id,'product_id'=>$product_id]);
        }else{   //未支付 返回失败
            return false;
        }
    }
    public  function actionProduct($paper_id,$product_id){
        return $this->render('product',['paper_id'=>$paper_id,'product_id'=>$product_id]);
    }

    public  function actionFree($paper_id,$product_id){ //免费版展示
        $this->layout="wide.php";

        $uid=Yii::$app->user->id;
        $finalReport=array();
        $reports=CepingResult::find()->where(['paper_id'=>$paper_id,'userId'=>$uid,'status'=>1,'product_id'=>$product_id])->all();
        foreach($reports as $v){
            $finalReport[]=CepingReport::find()->where(['id'=>$v->report_id])->one();
        }
        return $this->render('free',['finalReport'=>$finalReport,'paper_id'=>$paper_id,'product_id'=>$product_id]);
    }

}
