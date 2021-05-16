<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Activity */

$this->title = '创建活动';
//$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row"  style="font-family: 微软雅黑;background-color: #fbfbfb;padding:0 15px" >
<div class="activity-create">
   <div class="row" style="margin-bottom:0">
       <div class="col-sm-12 text-center">
    <h3 class="alert" style="color:#000000;"><?= Html::encode($this->title) ?></h3>
       </div>
   </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>