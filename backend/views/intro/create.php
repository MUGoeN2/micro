<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Intro */

$this->title = 'Create Intro';
$this->params['breadcrumbs'][] = ['label' => 'Intros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intro-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
