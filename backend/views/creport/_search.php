<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CepingReportResearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ceping-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'paperId') ?>

    <?php // echo $form->field($model, 'containTag') ?>

    <?php // echo $form->field($model, 'removeTag') ?>

    <?php // echo $form->field($model, 'content_1') ?>

    <?php // echo $form->field($model, 'content1_tag') ?>

    <?php // echo $form->field($model, 'content_2') ?>

    <?php // echo $form->field($model, 'content2_tag') ?>

    <?php // echo $form->field($model, 'content_3') ?>

    <?php // echo $form->field($model, 'content3_tag') ?>

    <?php // echo $form->field($model, 'content_4') ?>

    <?php // echo $form->field($model, 'content4_tag') ?>

    <?php // echo $form->field($model, 'content_5') ?>

    <?php // echo $form->field($model, 'content5_tag') ?>

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
