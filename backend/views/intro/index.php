<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\IntroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Intros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intro-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Intro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'showId',
            'name',
            'cate',
            'pic',
            // 'piece1',
            // 'piece2',
            // 'piece3',
            // 'piece4',
            // 'piece5',
            // 'piece6',
            // 'status',
            // 'weight',
            // 'created_at',
            // 'updated_at',
            // 'res1',
            // 'res2',
            // 'res3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
