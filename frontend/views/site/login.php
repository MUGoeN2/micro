<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$checkTel=<<<js
var check_out='<span style="color:#ee2352">手机号码误。</span>';
var tel = $(this).val(); //获取手机号
var telReg = !!tel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
//如果手机号码不能通过验证
if(telReg == true){
  $("#tel-border").attr('class','form-group field-loginform-tel required has-success');
$.post('tel-validate?tel='+$(this).val(),function(data){
  //alert(data);
if(data==1){
  $('.tel-error span').text('');
  $('.tel-error').hide();
  $('#sub').removeAttr('disabled');
  $('#sub').text('登录');
  $('#login-form').attr('action',"login");
  $('#short-input').hide();
  $('.send').hide();
  $('.message-error').hide();
}
else {
  var html='<div class="col-md-12"> <div class="form-group invite" >' +
           '<input type="text" class="form-control invite-input" name="invite" placeholder="输入邀请码"></div></div>' +
           '<p class="col-md-12 invite-error"><span style="color: #a94442" ></span> </p>';
   $('#row-invite').html(html); //邀请码
   $('.tel-error span').html('');
 //  $('.tel-error').show();
  $('#login-form').attr('action',"signup");
  $('#sub').removeAttr('disabled');
  $('#sub').text('注册');
  $('#short-input').show();
  $('.send').show();
  $('.message-error').show();
 }
 });
 }
else{
    $("#tel-border").attr('class','form-group field-loginform-tel required has-error');
    $('.tel-error span').html('手机号码有误。');
    $('.tel-error').show();
}

js;
$send=<<<js
var countdown=60;
$.post('short-mess?tel='+$("#tel-input").val(),function(data){
//alert(data);
if(data=="yes")
alert('短信已发出请注意查收！');
if(data=="no")
alert('短信验证发送失败！');
});
settime();
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
$content=<<<js
var check_out='<span style="color:#ee2352">手机验证码错误。</span>';
$.post('tel-content?tel='+$("#tel-input").val()+'&content='+$(this).val(),function(data){
//alert(data);
if(data==1){
   $("#duanxin-border").removeClass('has-error');
   $("#duanxin-border").addClass('has-success');
   $('.message-error span').text('');
   $('.message-error span').attr('check','true');

}
else {
   $("#duanxin-border").removeClass('has-success');
   $("#duanxin-border").addClass('has-error');
   $('.message-error span').text('验证码错误');
   $('.message-error span').attr('check','false');
}
});
js;
$check_sub=<<<js
var tel = $('#tel-input').val(); //获取手机号
var telReg = !!tel.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
if(telReg != true){
 $('.tel-error span').text('手机号码有误');
 return false;
}
  var short=$('.message-error span').attr('check');
  var invite=$('.invite-error span').attr('check');//邀请码
  var text=$(this).text();
  var check_all=true;
 if(short!="true"&&text=='注册'){  //邀请码
  //alert(1);
   $("#duanxin-border").addClass('has-error');
   $('.message-error span').text('验证码错误');
   check_all= false;
 }
  if(text=='注册'&&invite!="true"){  //邀请码
 // alert(2);
   $(".invite").addClass('has-error');
   $('.invite-error span').html('验证码错误');
   check_all= false;
 }
 if(check_all==false) return false;
js;
?>
<script>
    $(document).on('change','.invite-input',function(){  //邀请码
        var code=$(this).val();
        var tel = $('#tel-input').val(); //获取手机号
        $.post('invite?code='+code+'&tel='+tel,function(data){
       //     alert(data);
        if(data=="yes"){
            $('.invite-error span').attr('check','true');
            $(".invite").removeClass('has-error');
            $(".invite").addClass('has-success');
            $('.invite-error').hide();
        }else{
            $(".invite-error span").html('邀请码错误或已使用');
            $(".invite").removeClass('has-success');
            $(".invite").addClass('has-error');
            $('.invite-error span').attr('check','false');
            $('.invite-error').show();
        }
        });
    })
</script>

<div class="site-login" >
    <div class="row" style="background-color: #f6f6f6;">
        <div class="col-md-4 col-md-offset-4" style="background-color: #fff">
            <br>
            <p style="color:#fff;font-size: x-large;background-color:#0d74a6;padding: 15px;border-radius: 5px">登录GrowthMemo</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <br>

            <div class="row" id="row-tel">
                <div class="col-md-12">
                    <div class="form-group field-loginform-tel" id="tel-border">
                        <?php echo  Html::input('text','LoginForm[tel]','',['class'=>"form-control",'onchange'=>$checkTel,'id'=>'tel-input','placeholder'=>'手机号码']);?>
                    </div>
                </div>
                <div class="col-md-12 tel-error">
                    <span style="color: #a94442" ></span>
                </div>
            </div>

            <div  id="row-password">
                <?php echo $form->field($model, 'password')->passwordInput(['placeholder'=>'输入密码']) ?>
            </div>
            <div class="row"  id="row-invite">
                <div class="col-md-12 invite-error"><span style="color: #a94442" ></span> </div>
            </div>

            <div class="row">
                <div class="col-lg-6" >
                    <div id="duanxin-border" class="form-group field-loginform-duanxin">
                        <?php echo  Html::input('text','duanxin','',['class'=>"form-control",'onchange'=>$content,'id'=>'short-input','style'=>'display:none','placeholder'=>'短信验证码']);?>
                    </div>
                </div>

                <div class="col-lg-6">
                    <?php echo  Html::button('获取短信验证码', ['onclick' =>"$send",'class'=>'btn btn-default send','style'=>'display:none']);?>
                </div>
                <p class="col-lg-12 message-error" >
                    <span style="color: #a94442"></span>
                </p>
            </div>

            <div class="checkbox">
                <label for="loginform-rememberme">
                    <input type="hidden" name="LoginForm[rememberMe]" value="0">
                    <input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked="">
                    记住我
                </label>
            </div>
            <!--            --><?php //echo  $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                如果忘记密码，可点击重置 <?= Html::a('重置密码', ['site/reset']) ?>.
            </div>

            <div class="form-group text-center" style="padding:0 10%">
                <?= Html::submitButton('登录/注册', ['onclick' =>"$check_sub",'class' => 'btn btn-primary btn-block','id'=>'sub','disabled'=>'true']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
