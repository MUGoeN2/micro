<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ShopCards */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-cards-view">

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
            'card_id',
            'card_name',
            'status',
            'weight',
            'created_at',
            'updated_at',
            'res1',
            'res2',
        ],
    ]) ?>

</div>
