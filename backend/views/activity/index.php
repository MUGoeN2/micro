<style>
    .row{
        font-family:'微软雅黑';
    }
    .backColor{
        /*background-color:#79393b;*/
        /*background-color:rgba(0,0,0,0.3);*/
        /*position: absolute;*/
        /*margin-right: 15px;*/
    }
</style>
<?php
use yii\helpers\Url;
$image1=Yii::$app->request->baseUrl."/assets/images/lunbo/case11.png";
$this->title = '牛事';
?>
<?php $image1=Yii::$app->request->baseUrl."/uploads/haibao/test/1.png"?>
<?php $image2=Yii::$app->request->baseUrl."/assets/images/person/head_example.png"?>

<script>
    $(function(){
        $(".haibao").hover(function(){
//            $(this).parent().parent().attr('style','background-color:#');
            $(this).parent().parent().find('.btn-default').attr('class','btn btn-danger');
        },function(){
            $(this).parent().parent().find('.btn-danger').attr('class','btn btn-default');
        });
        $(".xiao_haibao").hover(function(){
            $(this).parent().find('.btn-default').attr('class','btn btn-danger btn-xs');
        },function(){
            $(this).parent().find('.btn-danger').attr('class','btn btn-default btn-xs');
        });
        $(window).ready(function(){
//            var haibao=$(".haibao");
//            var haibao_height=haibao.height();
//            var haibao_width=haibao.width();
//                haibao.parent().find('.backColor').height(haibao_height);
//                haibao.parent().find('.backColor').width(haibao_width);

//            var xiao_haibao=$(".xiao_haibao");
//            var xiao_haibao_height=xiao_haibao.height();
//            var xiao_haibao_width=haibao.width();
//            xiao_haibao.parent().find('.backColor').height(xiao_haibao_height);
//            xiao_haibao.parent().find('.backColor').width(xiao_haibao_width);
        });
    });
</script>

<div style="font-family:'微软雅黑';">
    <?php echo $this->render('lunbo') ?>
</div>
<hr style="height: 1px"/>
<div class="row">
    <div class="col-md-12">
        <span style="font-size: 24px;">官方活动</span>
        <span class="pull-right">换一批</span>
    </div>
    <?php foreach($model1 as $v){ ?>
        <div class="col-md-3 ">
            <div class="row" style="padding:0 15px;">
                <div class="backColor" >
<!--                    <div style="padding-top:60%;color:#fff;text-align: center">ddddddddd</div>-->
                </div>
                <a class="haibao" href="<?php echo Url::to(['show','id'=>$v->activityId])?>"><img  src="<?php  echo Yii::$app->request->baseUrl.$v->relationImg->img_small; ?>" width="100%" ></a>
            </div>
            <div class="row" style="margin-top: 5px;padding:0 15px">
                <h4><?php echo  $v->title ?></h4>
            </div>
            <div class="row" style="margin-top: 5px;padding:0 15px">
                <ul class="list-inline relate">
                    <li style="text-align: left"><span class="glyphicon glyphicon-calendar"></span><?php echo  date('m-d h:i',strtotime($v->startTime)) ?></li>
                    <li style="padding-left: 15%;"><span class="glyphicon glyphicon-star"></span>100</li>
                    <li><span class="glyphicon glyphicon-user"></span>100</li>
                </ul>
            </div>
            <div class="row" style="margin-top: 5px;padding:0 15px">
                <img src="<?php echo  Yii::$app->request->baseUrl.$v->relationUserMessage->pic_small ?>"  class="img-circle" width="30px">
                <span><?php echo $v->relationUserMessage->username ?></span>
                <span class="pull-right">
                    <button type="button" class="btn btn-default">我要报名</button>
                </span>
            </div>
        </div>
    <?php }?>
</div>

<hr style="height: 30px"/>
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <span style="font-size: 24px;">强力推荐</span>
                <span class="pull-right">换一批</span>
            </div>
            <?php foreach($model2 as $v){ ?>
                <div class="col-md-4">
                    <div class="row text-center">
                        <div class="backColor" style="margin-left:15px">
<!--                            <div style="padding-top:60%;color:#fff;text-align: center">ddddddddd</div>-->
                        </div>
                        <img class="haibao" src="<?php  echo Yii::$app->request->baseUrl.$v->relationImg->img_small; ?>" width="90%">
                    </div>
                    <div class="row" style="margin-top: 5px;padding:0 15px">
                        <h4><?php echo  $v->title ?></h4>
                    </div>
                    <div class="row" style="margin-top: 5px;padding:0 15px">
                        <ul class="list-inline relate">
                            <li style="text-align: left"><span class="glyphicon glyphicon-calendar"></span><?php echo  date('m-d h:i',strtotime($v->startTime)) ?></li>
                            <li style="padding-left: 15%;"><span class="glyphicon glyphicon-star"></span>100</li>
                            <li><span class="glyphicon glyphicon-user"></span>100</li>
                        </ul>
                    </div>
                    <div class="row" style="margin-top: 5px;padding:0 15px">
                        <img src="<?php echo  Yii::$app->request->baseUrl.$v->relationUserMessage->pic_small ?>"  class="img-circle" width="30px">
                        <span><?php echo $v->relationUserMessage->username ?></span>
                          <span class="pull-right">
                    <button type="button" class="btn btn-default">我要报名</button>
                           </span>
                    </div>
                </div>
            <?php }?>
        </div>
        <hr style="height: 30px"/>
        <div class="row">
<!--            <div class="col-md-12">-->
<!--                <span style="font-size: 24px;">即将开始</span>-->
<!--                <span class="pull-right">换一批</span>-->
<!--            </div>-->
            <div class="col-md-6">
                <div class="row">
                    <?php foreach($model3 as $v){ ?>
                    <div class=" col-md-6" style="margin-bottom: 5px;padding-right: 5px">
                        <a class="xiao_haibao" href="<?php echo Url::to(['show','id'=>$v->activityId])?>"><img  src="<?php echo  Yii::$app->request->baseUrl.$v->relationImg->img_small ?>"  width="100%" height="120px"></a>
                        <p><?php echo  $v->title ?><span class="pull-right"><button type="button" class="btn btn-default btn-xs">报名</button></span></p>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-md-6" >
                <ul class="list-group">
                    <?php foreach($model4 as $v){ ?>
                    <li class="list-group-item" style="height:75px">
                        <h4><?php echo  $v->title ?></h4>
                        <h5 class="text-right">查看详情</h5>
                    </li>
                    <?php  }?>
                </ul>

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row" >
            <div class="col-md-12" style="height:24px;margin-bottom: 8px">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group text-center" role="group">
                        <span class="btn btn-default">最新</span>
                    </div>
                    <div class="btn-group" role="group">
                        <span  class="btn btn-default">最热</span>
                    </div>
                </div>
            </div>
            <?php foreach($model5 as $v){ ?>
                <div class="col-md-12">
                    <div class="media" style="border:1px solid #f3f3f3;padding:8px 4px">
                        <div class="media-left" style="width: 50%;padding: 0;">
                            <a class="xiao_haibao" href="<?php echo Url::to(['show','id'=>$v->activityId])?>">
                                <img class="media-object" src="<?php echo  Yii::$app->request->baseUrl.$v->relationImg->img_small ?>" alt="..." width="100%" height="80px">
                            </a>
                        </div>
                        <div class="media-body" style="width: 50%;padding-left:10px;height:80px;">
                            <h6 class="media-heading" style="height:50px;padding-top: 8px"><?php echo  $v->title ?></h6>
                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                <div class="btn-group text-center" role="group">
                                    <span class="glyphicon glyphicon-star"></span>100
                                </div>
                                <div class="btn-group" role="group">
                                    <span class="glyphicon glyphicon-user"></span>100
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            <?php }?>
        </div>
    </div>
</div>

<hr style="height: 30px"/>
<div class="row">
    <div class="col-md-12">
        <span style="font-size: 24px;">强力推荐</span>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <?php foreach($model6 as $v){ ?>
                    <div class="col-md-12" style="margin-bottom: 10px;padding-right: 5px">
                       <img class="xiao_haibao" src="<?php echo  Yii::$app->request->baseUrl.$v->relationImg->img_small ?>" width="100%" height="200px">
                        <p><?php echo  $v->title ?><span class="pull-right"><button type="button" class="btn btn-default btn-xs">报名</button></span></p>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 10px">
                        <img class="xiao_haibao"  src="<?php  echo $image1; ?>" width="100%"   height="200px">
                        <p>这个活动的标题<span class="pull-right"><button type="button" class="btn btn-default btn-xs">报名</button></span></p>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 5px;">
                        <img class="xiao_haibao"  src="<?php  echo $image1; ?>" width="100%" height="200px">
                        <p>这个活动的标题<span class="pull-right"><button type="button" class="btn btn-default btn-xs">报名</button></span></p>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 5px;" >
                        <img class="xiao_haibao"  src="<?php  echo $image1; ?>" width="100%" height="200px">
                        <p>这个活动的标题<span class="pull-right"><button type="button" class="btn btn-default btn-xs">报名</button></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row"><?php foreach($model6 as $v){ ?>
            <div class="col-md-12" style="margin-bottom: 10px">
                <img class="xiao_haibao"  src="<?php echo  Yii::$app->request->baseUrl.$v->relationImg->img_small ?>" width="100%"  height="200px">
                <p>这个活动的标题<span class="pull-right"><button type="button" class="btn btn-default btn-xs">报名</button></span></p>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<hr style="height: 30px"/>
<div class="row">
    <div class="col-md-12">
        <span style="font-size: 24px;">合作单位</span>
    </div>
    <?php for($i=0;$i<8;$i++){?>
        <div class="col-md-2" style="margin-bottom: 10px"><img src="<?php  echo $image1; ?>" width="100%"  height="30px"> </div>
    <?php  }?>
</div>

