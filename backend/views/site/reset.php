<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;

$send=<<<js
var countdown=60;
$.post('short-mess?tel='+$("#resetpassform-tel").val(),function(data){
alert(data);
if(data=='yes') settime();
 });
function settime(){
    if (countdown == 0) {
        $('.send').attr("disabled",false);
        $('.send').text("免费获取验证码");
        countdown = 60;
        return;
    } else {
         $('.send').attr("disabled", true);
         $('.send').text("重新发送(" + countdown + ")");
        countdown--;
    }
setTimeout(function() {
    settime() }
    ,1000)
    }

js;
?>
<style>
    .control-label{
        display:none;
    }
    .row{
        font-family:'微软雅黑';
        margin: 3px 0;;
    }

</style>


<?php $form = ActiveForm::begin(['id' => 'reset-pass-form']); ?>
<div class="row">
    <div class="col-md-4  col-md-offset-4 col-xs-12 text-center">
        <p style="color:#fff;font-size:20px;background-color:#0d74a6;padding: 10px;border-radius: 5px">重置密码</p>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4  col-md-offset-4 col-xs-12 ">
        <?= $form->field($model, 'tel')->textInput(['placeholder'=>'输入手机号码']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2  col-md-offset-4 col-xs-6" >
        <?= $form->field($model, 'short_mess') ?>
    </div>
    <div class="col-md-2  col-xs-6" >
        <?php echo  Html::button('获取短信验证', ['onclick' =>"$send",'class'=>'btn btn-default btn-block send']);?>
    </div>
</div>
<div class="row">
    <div class="col-md-4  col-md-offset-4 col-xs-12 " >
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4  col-md-offset-4 col-xs-12 ">
        <?= $form->field($model, 're_password')->passwordInput() ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4  col-md-offset-4 col-xs-12 ">
        <div class="form-group">
            <?= Html::submitButton('保存密码', ['class' => 'btn btn-primary btn-block','name'=>'sub']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


