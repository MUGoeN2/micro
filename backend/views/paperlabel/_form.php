<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PaperLabel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paper-label-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'paper_id')->textInput() ?>

    <?= $form->field($model, 'label_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'res1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'res2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'res3')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
