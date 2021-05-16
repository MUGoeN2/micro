<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

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
            'article_id',
            'article_name',
            'content:ntext',
            'cate1',
            'cate2',
            'cate3',
            'cate4',
            'cate5',
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
