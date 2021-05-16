<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->activityId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->activityId], [
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
            'activityId',
            'title',
            'uid',
            'pic',
            'level',
            'startTime',
            'endTime',
            'addressPro',
            'addressCity',
            'addressDistrict',
            'addressDetail',
            'limit',
            'content:ntext',
            'topic',
            'form',
            'weight',
            'status',
            'created_at',
            'updated_at',
            'applyTime',
            'res2',
            'label',
        ],
    ]) ?>

</div>
