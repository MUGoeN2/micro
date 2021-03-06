<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\widgets;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = '联系我们';
?>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                  <?= $form->field($model, 'name') ?>
                  <?= $form->field($model, 'email') ?>
                  <?= $form->field($model, 'subject') ?>
                   <?= $form->field($model, 'body') ?>
                  <?php  echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div>{input}{image}</div>',
//                    'template' => "{input}{image}",
                    'imageOptions' => ['alt' => '验证码'],
                   ]);

                ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
