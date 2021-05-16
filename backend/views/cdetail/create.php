<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CepingDetail */

$this->title = 'Create Ceping Detail';
$this->params['breadcrumbs'][] = ['label' => 'Ceping Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
