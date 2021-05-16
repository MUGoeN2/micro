<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PaperLabelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paper Labels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paper-label-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Paper Label', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'paper_id',
            'label_id',
            'weight',
            'status',
            'created_at',
            // 'updated_at',
            // 'res1',
            // 'res2',
            // 'res3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
