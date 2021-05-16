<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\ActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activityId') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'host') ?>

    <?= $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'startTime') ?>

    <?php // echo $form->field($model, 'endTime') ?>

    <?php // echo $form->field($model, 'addressPro') ?>

    <?php // echo $form->field($model, 'addressCity') ?>

    <?php // echo $form->field($model, 'addressDistrict') ?>

    <?php // echo $form->field($model, 'addressDetail') ?>

    <?php // echo $form->field($model, 'limit') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'topic') ?>

    <?php // echo $form->field($model, 'form') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'res1') ?>

    <?php // echo $form->field($model, 'res2') ?>

    <?php // echo $form->field($model, 'label') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
