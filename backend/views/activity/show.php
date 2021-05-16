<style>
    #applyForm .form-control{
        margin-bottom: 20px;;
    }
    .activity-about{
        color:#acacac;
    }
</style>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\UserMessage;
use yii\helpers\Url;
use common\models\ActivityCollect;
?>
<?php $image1=Yii::$app->request->baseUrl."/assets/images/person/person_back.png"?>
<?php $image2=Yii::$app->request->baseUrl."/assets/images/person/head_example.png"?>
<?php \yii\helpers\Url::remember(['activity/show', 'id' => $activityInfo->activityId]); ?>
<script>
    $(function(){
            $('.ask-login').click(function(){
                var login='<a href="<?php echo \yii\helpers\Url::to(['site/login'])?>" class="btn btn-success" style="width:80px;margin-right:30px">登录</a>';
                var regist='<a href="<?php echo \yii\helpers\Url::to(['site/signup'])?>" class="btn btn-default">注册</a>';
                var content=login+' '+regist;
                $('#myModalLabel').text('请先登录 或 注册');
                $('#tip-content').html(content);
                $("#ready").click();
            });

            $(window).ready(function(){
                <?php if(isset($_GET['success'])&&$_GET['success']=='no'){  ?>
                $('#tip-content').text('报名失败，或已经过名');
                $("#ready").click();
                <?php }?>
                <?php if(isset($_GET['success'])&&$_GET['success']=='yes'){  ?>
                $('#tip-content').text('报名成功！');
                $("#ready").click();
                <?php }?>
            });


        });

</script>
<?php
$xx=<<<html
 $.post('auto-apply?id= $activityInfo->activityId',function(data){alert(data); });
html;
?>

<?php
$shoucang=<<<html
 $.post('shoucang?id= $activityInfo->activityId',function(data){alert(data); });
html;
?>
<div class="row" style="margin-top: 20px;font-family: 微软雅黑">
    <div class="col-md-6" style="padding: 2%;">
        <img src="<?php echo $image1; ?>" width="100%" >
    </div>

    <div class="col-md-6"  style="padding: 2%;border-right: solid 1px #f6f6f6">
        <h3><strong><?php echo $activityInfo->title ?></strong></h3>
        <div style="padding-top: 15px">
            <p><span class="activity-about"><span class="glyphicon glyphicon-time"></span> &#12288;开始时间：</span><?php echo $activityInfo->startTime ?></p>
            <p><span class="activity-about"><span class="glyphicon glyphicon-map-marker"></span> &#12288;活动地址：</span><?php echo $activityInfo->addressPro. $activityInfo->addressCity. $activityInfo->addressDistrict; ?></p>
            <p><span class="activity-about"><span class="glyphicon glyphicon-user"></span> &#12288;人数限制：</span><?php echo $activityInfo->limit ?></p>
        </div>
        <h4><strong>主办方：&#12288;<img src="<?php  echo $image2//echo $activityInfo->host ?>" width="50px" class="img-circle">包家鹏</strong></h4>

        <div class="row">

            <?php if(!empty($userMess)&&empty($userMess->realname)){ //p($userMess) ?>
                <div class="col-md-4 col-xs-6">
                    <a class="btn btn-danger" style="width: 120px" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">aa报名参加</a>
                </div>
                <div class="col-md-4 col-xs-6">
                    <?php echo  Html::button('<span class="glyphicon glyphicon-star" aria-hidden="true"></span> 收藏&nbsp;<span class="choucang_num"> '.ActivityCollect::find()->where(['activity_id'=>$activityInfo->activityId])->count().' </span>', ['onclick' =>"$shoucang",'class'=>'btn btn-default']);?>
                </div>
            <?php   }
            else if(isset($userMess->realname)&&$userMess->realname!=null){   ?>
                <div class="col-md-4 col-xs-6">
                    <?php    echo  Html::button('bb报名参加', ['onclick' =>"$xx",'class'=>'btn btn-danger','style'=>"width: 120px"]);?>
                </div>
                <div class="col-md-4 col-xs-6">
                    <button type="button" class="btn btn-default shoucang">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span> 收藏&nbsp;
                        <span class="choucang_num"><?php echo 123 ?></span>
                    </button>
                </div>
                <?php
            }else{ ?>
                <div class="col-md-4 col-xs-6">
                    <a class="btn btn-danger ask-login" style="width: 120px">cc报名参加</a>
                </div>
                <div class="col-md-4 col-xs-6">
                    <button type="button" class="btn btn-default ask-login">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span> 收藏&nbsp;
                        <span class="choucang_num"><?php echo 123 ?></span>
                    </button>
                </div>
            <?php }?>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col-md-4 col-md-offset-8 col-xs-6 col-xs-offset-6 jiathis_style_24x24">
                <a class="jiathis_button_qzone"></a>
                <a class="jiathis_button_tsina"></a>
                <a class="jiathis_button_tqq"></a>
                <a class="jiathis_button_weixin"></a>
                <a class="jiathis_button_douban"></a>
                <!--                    <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>-->
                <!--                    <a class="jiathis_counter_style"></a>-->
                <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
            </div>
        </div>
    </div>
</div><!--/.row1-->
<?php  if(!empty($userMess)){ ?>
<div class="row"> <!--row2-->
    <div class="col-md-12">
        <div class="collapse" <?php  if(!$userMess->realname){  echo 'id="collapseExample"';  } ?> >
            <div class="well" >
                <div class="row" id="applyForm">
                    <div class="col-md-12">
                        <p style="font-size:20px;color:#fa2943;">报名:<small class="pull-right" style="color:#fa2943;" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">x</small></p>
                    </div>
                    <div class="row">
                        <?php
                        echo $this->render('apply_logined',['activityInfo'=>$activityInfo,'activityBaoming'=>$activityBaoming,'userMess'=>$userMess]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="row">
            <div class="col-md-12">
                <p style="font-size:20px;padding:10px 0;color:#fa2943;border-bottom:1px solid #e4e4e4">活动内容</p>
                <?php echo $activityInfo->content?>
            </div>
        </div>
    </div>
</div>
<!--row2-->

<?php echo $this->render('tip'); ?>


