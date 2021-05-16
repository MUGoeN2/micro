<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '试卷取名 ';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = '试卷取名';

?>
<div class="row">
    <div class="col-md-12 text-center">
        <h4 class="well" style='color:#ee44bb'>第一步——给试卷取一个名字</h4>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6">
        <?= $form->field($model, 'paper_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'weight')->textInput(['maxlength' => true,'palceholder'=>'权重']) ?>
<!--        --><?php //echo $form->field($model, 'weight')->dropDownList(array(''=>'选择试卷类型','1'=>'免费版','2'=>'收费版','3'=>'专业版','4'=>'其他'))?>
  <p><small>提示：只允许数字，权重最大的试卷将作为网站默认试题</small></p>
    </div>
    <div class="hidden">
        <?= $form->field($model, 'paperId')->textInput() ?>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

