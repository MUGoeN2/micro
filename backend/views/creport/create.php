<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CepingReport */

$this->title = '报告设置 ';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = '报告设置';
?>
<div class="ceping-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
