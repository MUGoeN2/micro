<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShopCards */

$this->title = 'Update Shop Cards: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-cards-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
