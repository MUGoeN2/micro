<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$content=<<<js
var check_out='<div class="help-block help-block-error ">手机验证码错误。</div>';
$.post('tel-content?tel='+$("#signupform-tel").val()+'&content='+$(this).val(),function(data){
//alert(data);
if(data==1){
$('#signupform-status').attr('value',1);
$('.field-signupform-duanxin').attr('class','form-group field-signupform-duanxin required has-success');
$("#short-input").parent().find('.help-block').remove();
}
else {
$('.field-signupform-duanxin').attr('class','form-group field-signupform-duanxin required has-error');
$("#short-input").parent().append(check_out);
}
});
js;

$send=<<<js
var countdown=60;
$.post('short-mess?tel='+$("#signupform-tel").val(),function(data){
//alert(data);
if(data=='yes') alert('短信已发出请注意查收！');
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

$check=<<<js
if($("#signupform-status").val()==''){
var check_out='<div class="help-block help-block-error ">手机验证码错误。</div>';
var parent=$("#short-input").parent();
var error=parent.find('.help-block-error');
//alert(error.length);
if(error.length==0)
{     parent.append(check_out);
      $('.field-signupform-duanxin').attr('class','form-group field-signupform-duanxin required has-error');
}
}
js;

?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'form-signup',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-9',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-5  col-md-offset-3 col-xs-12">
            <?php $username=time().mt_rand(1000,9999) ?>
            <div class="hidden">
                <?= $form->field($model, 'username')->textInput(['value'=>$username]) ?>
                <?= $form->field($model, 'status')->textInput(['value'=>'']) ?>
            </div>
            <?= $form->field($model, 'tel') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5  col-md-offset-3 col-xs-12">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5  col-md-offset-3 col-xs-12">
            <?php  echo $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
//                'captchaAction'=>'site/captcha',
//         'template' => '<div>{input}{image}</div>',
                'template' => "<div class='row'><div class='col-xs-7'>{input}</div><div class='col-xs-5'>{image}</div></div>",
                'imageOptions' => ['alt' => '验证码'],
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5  col-md-offset-3 col-xs-12">
            <div class="form-group field-signupform-duanxin required">
                <label class="control-label col-sm-3" for="signupform-duanxin"></label>
                <div class="col-xs-5">
                    <?php echo  Html::input('text','duanxin','',['class'=>"form-control",'onchange'=>$content,'id'=>'short-input']);?>
                </div>
                <div class="col-xs-4">
                    <?php echo  Html::button('获取短信验证码', ['onclick' =>"$send",'class'=>'btn btn-default send']);?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-5 col-xs-offset-3">
            <div class="form-group">
                <div class="control-label col-xs-3"></div>
                <div class="control-label col-xs-9">
                    <?= Html::submitButton('Signup', ['onclick'=>$check,'class' => 'btn btn-primary pull-left', 'name' => 'signup-button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


