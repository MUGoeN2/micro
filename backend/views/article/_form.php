<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12">
        <?= $form->field($model, 'article_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-4">
        <?php echo $form->field($model, 'cate1')->dropDownList(ArrayHelper::map(\common\models\ArticleCate::find()->where(['parent_cate'=>0])->all(),'id','name'),
            [
                'prompt'=>'请选一类',
                'onchange'=>'
                   $.post("listcate2?&cate1='.'"+$(this).val(),function(data){
                       $("select#article-cate2").html(data);
                   });',
            ]
        )?>
    </div>

    <div class="col-lg-4">
        <?php echo $form->field($model, 'cate2')->dropDownList(ArrayHelper::map(\common\models\ArticleCate::find()->all(),'id','name'),
            [
                'prompt'=>'请选一类',
//                'onchange'=>'
//                   $.post("listcate3?&cate2='.'"+$(this).val(),function(data){
//                       $("select#article-cate3").html(data);
//                   });',
            ]
        )?>
    </div>

    <div class="col-lg-4">
        <?php echo $form->field($model, 'cate3')->dropDownList(array(''=>'请选择','1'=>'文章','2'=>'平台列表'))?>
    </div>

    <div class="col-lg-12" >
        <?php echo $form->field($model,'content')->widget('kucha\ueditor\UEditor',[
            'clientOptions' => [
                //编辑区域大小
                'initialFrameHeight' => '200',
                //设置语言
                'lang' =>'zh-cn', //中文为 zh-cn
                //定制菜单
            ]
        ]);?>
    </div>





    <div class="hidden">

        <?= $form->field($model, 'cate4')->textInput() ?>

        <?= $form->field($model, 'cate5')->textInput() ?>

        <?= $form->field($model, 'weight')->textInput() ?>

        <?= $form->field($model, 'status')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'res1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'res2')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'res3')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-12" >
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
