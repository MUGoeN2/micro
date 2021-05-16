<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CepingSubject */

$this->title = 'Update Ceping Subject: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ceping Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ceping-subject-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
