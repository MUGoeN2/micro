<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CepingDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ceping Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ceping Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'userId',
            'subjectId',
            'score',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
