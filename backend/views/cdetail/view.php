<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CepingDetail */

$this->title = $model->userId;
$this->params['breadcrumbs'][] = ['label' => 'Ceping Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'userId' => $model->userId, 'subjectId' => $model->subjectId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'userId' => $model->userId, 'subjectId' => $model->subjectId], [
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
            'userId',
            'subjectId',
            'score',
        ],
    ]) ?>

</div>
