<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CepingReport */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ceping Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'level',
            'name',
            'content:ntext',
            'paperId',
            'containTag',
            'removeTag',
            'content_1:ntext',
            'content1_tag',
            'content_2:ntext',
            'content2_tag',
            'content_3:ntext',
            'content3_tag',
            'content_4:ntext',
            'content4_tag',
            'content_5:ntext',
            'content5_tag',
            'weight',
            'status',
            'created_at',
            'updated_at',
            'res1',
            'res2',
            'res3',
        ],
    ]) ?>

</div>
