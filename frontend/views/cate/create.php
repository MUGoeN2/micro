<?php

use yii\helpers\Html;


/* @var $this yii\web\View */


$this->title = '新建栏目';
$this->params['breadcrumbs'][] = ['label' => '栏目类型', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cate-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p class="well">说明：一级栏目的栏目，二级栏目需要选择栏目
    <?php //if(!empty($model->getErrors())) p($model->getErrors());?>
    </p>
    <?php
    if(empty($level)) echo "请选择栏目等级";
    else{
        $model->level=$level;
        if($level == 2) echo $this->render('_form_2', [
            'model' => $model,
        ]);
        if($level == 1) echo $this->render('_form_1', [
            'model' => $model,
        ]);
    }
     ?>

</div>
