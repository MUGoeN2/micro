<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cate */

$this->title = '更新分类: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if(empty($level)) echo "请选择分类等级";
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
