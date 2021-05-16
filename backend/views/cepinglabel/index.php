<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CepingLabelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ceping Labels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-label-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ceping Label', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'label_id',
            'label_name',
            'parent_id',

//            'status',
            // 'weight',
            // 'created_at',
            // 'updated_at',
//             'res1',
            // 'res2',
            // 'res3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
