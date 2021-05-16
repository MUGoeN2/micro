<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CepingReportResearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ceping Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ceping Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'level',
            'name',
            'content:ntext',
            'paperId',
            // 'containTag',
            // 'removeTag',
            // 'content_1:ntext',
            // 'content1_tag',
            // 'content_2:ntext',
            // 'content2_tag',
            // 'content_3:ntext',
            // 'content3_tag',
            // 'content_4:ntext',
            // 'content4_tag',
            // 'content_5:ntext',
            // 'content5_tag',
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
