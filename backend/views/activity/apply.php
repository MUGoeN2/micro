<?php
use yii\bootstrap\ActiveForm;

use yii\helpers\Html;
//use yii\widgets\ActiveForm;

//use dosamigos\datetimepicker\DateTimePicker;
//use yii\helpers\ArrayHelper;

?>
<style>
    .btn-danger{
        background-color: #fa2943;
    }
    .btn-danger :hover{
        background-color: #e80b26;
    }
</style>
<script>$(function(){
        $('#duanxin').click(function(){
            alert(1);
//                                $.ajax({
//            url:'index.php?route=activity/duanxin',
//            type : 'post',
//            data : {
//                id:'zan'
//            },
////            dataType : 'json',
////            contentType : 'application/x-www-form-urlencoded',
////            async : false,
//            success : function(data) {
////                 alert(data);
//            },
//            error : function() {
//                alert("wrong");
//            }
//        });
        });
    });

</script>
<div class="activity-form" style="font-family: 微软雅黑">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-5',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]);?>

    <div class="row" >
        <div class="col-md-6 col-md-offset-3">
            <div class="hidden">
                <?= $form->field($activityBaoming, 'activity_id')->textInput(['value' => $activityInfo->activityId]) ?>
            </div>
            <div class="hidden">
                <?= $form->field($activityBaoming, 'uid')->textInput() ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?= $form->field($activityBaoming, 'realname')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?= $form->field($activityBaoming, 'tel')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group required">
                <label class="control-label col-sm-3" for="yanzheng">验证码</label>
                <div class="col-sm-5">
                    <input type="text" id="yanzheng" class="form-control" name="yanzheng" placeholder="输入验证码">
                    <div class="help-block help-block-error "></div>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-danger" id="duanxin" style="width: 100%">获取手机验证码</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group ">
                <div class="col-sm-5 col-sm-offset-3">
                    <button type="submit" class="btn btn-danger" style="width: 25%">报名</button>
                    <button type="button" class="btn btn-default quit"  style="width: 25%;margin-left: 5%">取消</button>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>