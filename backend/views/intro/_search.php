<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\IntroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="intro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'showId') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'cate') ?>

    <?= $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'piece1') ?>

    <?php // echo $form->field($model, 'piece2') ?>

    <?php // echo $form->field($model, 'piece3') ?>

    <?php // echo $form->field($model, 'piece4') ?>

    <?php // echo $form->field($model, 'piece5') ?>

    <?php // echo $form->field($model, 'piece6') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'weight') ?>

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
