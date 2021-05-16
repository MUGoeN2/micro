<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CepingSubject */

$this->title = 'Create Ceping Subject';
$this->params['breadcrumbs'][] = ['label' => 'Ceping Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ceping-subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
