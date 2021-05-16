<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'article_id') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'brief') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'read') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'res1') ?>

    <?php // echo $form->field($model, 'res2') ?>

    <?php // echo $form->field($model, 'res3') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
