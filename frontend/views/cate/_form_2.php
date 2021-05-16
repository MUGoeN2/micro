<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\cate */
/* @var $form yii\widgets\ActiveForm */
$model->parent_id=0;
?>

<div class="item-cate-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'kind')->dropDownList(array('资讯类','介绍类'),
                [
                    'prompt'=>'请选择',
                ]
            )  ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Cate::find()->where(['level'=>1])->all(),'id','name'),
                [
//                    'prompt'=>'请选择',
                ]
            ) ?>
        </div>
    </div>
    <div class="row hidden">
        <div class="col-md-12">
            <br>
            <?php echo $form->field($model,'custom')->textInput(['maxlength' => true])?>
        </div>
    </div>
    <div class="row hidden">
        <div class="col-md-10 col-md-offset-1">
            <?= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row hidden">
        <?= $form->field($model, 'level')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
