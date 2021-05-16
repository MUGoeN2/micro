<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CepingLabel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ceping Labels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-label-view">

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
            'label_id',
            'label_name',
            'paperId',
            'status',
            'weight',
            'created_at',
            'updated_at',
            'res1',
            'res2',
            'res3',
        ],
    ]) ?>

</div>
