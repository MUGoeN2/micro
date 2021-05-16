<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
    <div class="col-md-6">
        <div class="shop-cards-form">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <hr>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="输入确认清空" name="del">
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?= Html::submitButton('确定', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>