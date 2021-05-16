<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CepingLabel */

$this->title = 'Create Ceping Label';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-label-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
