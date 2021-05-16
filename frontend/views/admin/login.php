<?php
use yii\bootstrap\ActiveForm;
?>
<div class="site-login" >
    <div class="container">
    <div class="row" style="background-color: #f6f6f6;">
        <div class="col-md-4 col-md-offset-4" style="background-color: #fff">
            <br>
            <p style="color:#fff;font-size: x-large;background-color:#0d74a6;padding: 15px;border-radius: 5px">登录</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <br>
            <div class="row" id="row-username">
                <div class="col-md-12">
                    <?php echo $form->field($model, 'username')->textInput(['placeholder'=>'输入密码']) ?>
                </div>
            </div>
            <div  id="row-password">
                <?php echo $form->field($model, 'password')->passwordInput(['placeholder'=>'输入密码']) ?>
            </div>
            <div class="row"  id="row-invite">
                <div class="col-md-12 invite-error"><span style="color: #a94442" ></span> </div>
            </div>
            <div class="checkbox">
                <label for="loginform-rememberme">
                    <input type="hidden" name="LoginForm[rememberMe]" value="0">
                    <input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked="">
                    记住我
                </label>
            </div>
            <div class="form-group text-center" style="padding:0 10%">
                <?= \yii\helpers\Html::submitButton('登录', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
</div>