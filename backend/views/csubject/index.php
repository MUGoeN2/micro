<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CepingSubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ceping Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-subject-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ceping Subject', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'text',
            'parent_id',
            'foreign_id',
            'score',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
