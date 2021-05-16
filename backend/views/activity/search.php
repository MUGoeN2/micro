<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建活动', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'activityId',
            'title',
            'pic',
            // 'level',
            // 'startTime',
            // 'endTime',
            // 'addressPro',
            // 'addressCity',
            // 'addressDistrict',
            // 'addressDetail',
            // 'limit',
            // 'content:ntext',
            // 'topic',
            // 'form',
            // 'weight',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'res1',
            // 'res2',
            // 'label',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>