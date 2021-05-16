<?php
use \yii\helpers\Url;
use \common\models\CepingSubject;

$this->title = '试卷浏览';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <h5 class="text-center">欢迎：<?php  echo Yii::$app->user->identity->username; ?>&#12288;&#12288;
        <!--        --><?php //if(Yii::app()->user->name!='Guest'){?>
        <!--            <a href="--><?php // echo Yii::app()->createUrl('site/out'); ?><!--">退出</a>-->
        <!--        --><?php //}else{?>
        <!--            <a href="--><?php // echo Yii::app()->createUrl('site/login'); ?><!--">登录</a>-->
        <!--        --><?php //}?>
    </h5>
</div>
<div class="row">
    <div class="col-md-12">
        <p class="well"><small  style='color:#ee44bb'>(带#号数字为题库中数据id)</small></p>
    </div>
    <div class="col-md-6">
        <div class="alert alert-info">题目列表 </div>
        <?php   foreach($model as $v){

            echo "<table class='table table-bordered'><tr><th>$v->rank 、 $v->label_name<span class='pull-right'>(#$v->id)</span> ";

            echo "</th></tr>";

            echo "</table>";
        } ?>

    </div>
    <div class="col-md-6" style="border-right: 1px solid #c7c7c7">
        <div class="alert alert-info">详细列表</div>

        <?php   foreach($model as $v){

            echo "<table class='table table-bordered'><tr><th>$v->rank 、 $v->label_name<span class='pull-right'>(#$v->id)</span> </th></tr>";
            $result=CepingSubject::find()->where(['parent_id'=>"$v->label_id",'paperId'=> $v->paperId])->all();

            foreach($result as $m){
                echo  "<tr><td> &#12288;  $m->label_name &#12288;(#$m->id)";
                if(!empty($m->foreign_id))
                {   $result_more=\common\models\CepingSubject::find()->where(['rank'=>$m->foreign_id])->one();
                    echo "<span class='pull-right' style='color:#ee44bb'>跳转到：".$result_more->rank ."</span>";
                }
                echo "</td></tr>";

                  }
            echo "</table>";
        } ?>



<!---->
<!--                <table class="table table-bordered hidden">-->
<!--                    --><?php //  foreach($model as $v){ ?>
<!---->
<!--                    --><?php //if(empty($v->parent_id)){ ?>
<!--                </table>-->
<!--                <table class="table table-bordered">-->
<!--                    --><?php //echo "<tr><th>$v->rank 、$v->label_name<span class='pull-right'>(#$v->id)</span> </th></tr>"; ?>
<!---->
<!--                    --><?php //}else{
//                        $result=\common\models\CepingSubject::findOne($v->foreign_id);
//                        ?>
<!---->
<!--                        <tr><td>--><?php //echo $v->label_name." <small>(#".$v->id.")</small>";  if($v->foreign_id) echo "<span class='pull-right' style='color:#ee44bb'>跳转到：".$result->rank."</span>"; ?><!--</td></tr>-->
<!---->
<!--                    --><?php //   } } ?>
<!--                </table>-->
        <?php   echo \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
        ]);?>
    </div>

    <div class="col-md-6 hidden">
        <div class="alert alert-info">试题筛选</div>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'label_id',
                'label_name',
                'parent_id',
                'paperId',
                'foreign_id',
//            'status',
                // 'weight',
                // 'created_at',
                // 'updated_at',
                'res1',
                // 'res2',
                // 'rank',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

</div>
