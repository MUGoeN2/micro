<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'article_id',
            'article_name',
            'content:ntext',
//            'cate1',
        //    ['label'=>'分类',  'attribute' => 'name',  'value' => 'cate.name' ],//<=====加入这句
            ['label'=>'分类', 'attribute' => 'name', 'value' => 'cate.name','filter'=>Html::activeTextInput($searchModel, 'name',['class'=>'form-control']) ],
//             'cate2',
            ['label'=>'平台标记', 'attribute' => 'cate3' ],

            // 'cate4',
            // 'cate5',
            // 'weight',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'res1',
            // 'res2',
            // 'res3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
