<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'article_id') ?>

    <?= $form->field($model, 'article_name') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'cate1') ?>

    <?php // echo $form->field($model, 'cate2') ?>

    <?php // echo $form->field($model, 'cate3') ?>

    <?php // echo $form->field($model, 'cate4') ?>

    <?php // echo $form->field($model, 'cate5') ?>

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
