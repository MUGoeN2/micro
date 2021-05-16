<?php

use yii\helpers\Html;


use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ShopCards */

$this->title = 'Create Shop Cards';
$this->params['breadcrumbs'][] = ['label' => 'Shop Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-cards-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php


    /* @var $this yii\web\View */
    /* @var $model common\models\ShopCards */
    /* @var $form yii\widgets\ActiveForm */
    ?>

    <div class="shop-cards-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-6">
                <input type="number" class="form-control" placeholder="输入创建个数" name="num" min="1" max="10000">

            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="备注" name="name" >
            </div>
            <hr>
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('确定', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>


    </div>

</div>
