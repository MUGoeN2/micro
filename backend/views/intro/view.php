<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Intro */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Intros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intro-view">

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
            'showId',
            'name',
            'cate',
            'pic',
            'piece1',
            'piece2',
            'piece3',
            'piece4',
            'piece5',
            'piece6',
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
