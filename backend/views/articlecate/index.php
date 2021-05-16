<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ArticleCateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-cate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'parent_cate',
            'cate',
//            'type',
            // 'weight',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'res1',
            // 'res2',
            // 'res3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
<div class="row">
    <div class="col-md-12">
        <p class="well" style="background-color: #fff">
            分类规则：<br>
            1、ID为每个分类的唯一标识，不论是否有子类<br>
            2、父级分类为0表示为顶级分类<br>
            3、父级分类非零数字表示父级分类的ID<br>
            4、文章/平台标志   1表示文章  2表示平台<br>
        </p>
    </div>
</div>
