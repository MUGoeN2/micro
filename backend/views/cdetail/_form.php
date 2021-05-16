<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CepingDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ceping-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subjectId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'score')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
