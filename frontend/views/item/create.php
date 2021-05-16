<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Item */

$this->title = '添加产品';
$this->params['breadcrumbs'][] = ['label' => '产品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->item_id=rand(1000,9999).date('md').rand(1000,9999);
?>
<div class="item-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
