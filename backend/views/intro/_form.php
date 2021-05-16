<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Img;

/* @var $this yii\web\View */
/* @var $model common\models\Intro */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="intro-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-10">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 hidden">
            <?= $form->field($model, 'showId')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <!--            <label class="control-label text-right" for="intro-pic">图片</label>-->
        <div class="col-md-6">
            <?php
            $timestamp=time();
            $image=false;
            $result=Img::find()->where(['type_id'=>$model->showId])->one();
            if($result) $image=$result->img_small;
            echo $form->field($model, 'pic')->widget(\kartik\file\FileInput::classname(), [
                'name' => 'Intro[pic]',
                'options'=>[
                    'accept' => 'image/*',
                    'multiple'=>false,
                ],
                'pluginOptions' => [
                    'uploadUrl' => \yii\helpers\Url::to(['intro/upload']),
                    'uploadExtraData' => [
                        'type_id'=>$model->showId,
                        'timestamp' => $timestamp,
                        'maxFileCount' => 1
                    ],
                    'initialPreview'=>[
                        Html::img($image?Yii::$app->request->baseUrl.$image:'demo.png', ['class'=>'file-preview-image', 'alt'=>'头像', 'title'=>'头像']),
                    ],
                    'initialCaption'=>"尺寸400X250",
                    'overwriteInitial'=>true
                ]
            ]);
            ?>

        </div>


    </div>
    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'cate')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ArticleCate::find()->all(),'id','name'),
                [
                    'prompt'=>'请选一类',
                ]
            )?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'weight')->textInput() ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'piece1')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'piece2')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'piece3')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'piece4')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'piece5')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'piece6')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
</div>




<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>


