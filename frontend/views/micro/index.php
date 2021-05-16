<style>
    .item-box img{
        width:  280px;
        height: 280px;
    }
    .item-box{
        height: 280px;
        padding: 0!important;
        border-right: 4px #fff solid;
        margin-bottom: 4px;
    }
    .recommend-infobox-style{
        position: absolute;
        height: 90px;
        top: 190px;
    }
    .infobox-up, .infobox-down{
        background-color: #f0f0f0;
        height: 140px;
    }
    .infobox-up{
        border-bottom:2px #fff solid; ;
    }
    .infobox-down{
        border-top:2px #fff solid; ;
    }
    .item-cate-title{
        font-size: 26px;
        line-height: 40px;
        padding-bottom: 5px;
        margin:8px 15px;
        font-weight: 100;
        color:#dad5d5;
        border-bottom:1px #dad5d5 solid;
    }
    .item-title{
        color:#333;
        font-size: 19px;
        line-height: 35px;
        margin:8px 15px;
        font-family: "Helvetica Neue Light", "HelveticaNeue-Light", "Helvetica Neue", Calibri, Helvetica, Arial, sans-serif;
    }
    .item-desc{
        color:#999;
        font-size: 12px;
        line-height: 15px;
        padding:0 15px;
        margin-bottom: 10px;
    }
    .color-grey{
        color: #f0f0f0;
    }
    .color-grey-d{
        color: #c0c0c0;
    }
    .color-white{
        color: #fff;
    }
    .bg-grey{
        background-color: rgba(0,0,0,0.2);
    }
    .bg-grey-d{
        background-color: rgba(0,0,0,0.4);
    }
    .table td{
        border-color: rgba(0,0,0,0)!important;
        padding: 2px 4px !important;
    }
    .part-title{
        line-height: 60px;
    }
    .more{
        cursor:pointer;
    }
</style>
<div class="wrap" style="width: 100%;margin: auto;">
    <?php echo $this->render('lunbo')?>
    <!--    <div class="jumbotron">-->
    <!--        <h1>Hello, world!</h1>-->
    <!--        <p>...</p>-->
    <!--        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>-->
    <!--    </div>-->
</div>
<div class="container" style="min-height: 100%;">
    <div id="cate-1" class="row">
        <div class="col-md-12" style="height: 60px;margin-top: 25px">
            <h4 class="text-center part-title" style="border-top: 1px solid #ededed;">
            <span style="position:absolute;top:-25px;left:44%;background-color:#fff;padding: 5px 15px">
                <?php echo $cate_1['name']?>
            </span>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 cate-1-box">
            <?php if(isset($arr_1[0])){?>
                <div class="col-xs-3 item-box">
                    <img class="lazy" src="<?php echo Yii::$app->request->baseUrl.'/img/placeholder.png'; ?>" data-original="<?php echo Yii::$app->request->baseUrl.$arr_1[0]['pic']?>">
                </div>
            <?php }?>

            <?php if(isset($arr_1[0])){?>
            <div class="col-xs-3 item-box">
                <div class=" infobox-up text-left">
                    <div class="arrow-left-1"></div>
                    <div class="arrow-left-2"></div>
                    <span class="item-cate-title"><?php echo $arr_1[0]['cate']?></span>
                    <br>
                    <span class="item-title"><?php echo $arr_1[0]['title']?></span>
                    <br>
                    <span class="item-desc"><?php echo $arr_1[0]['desc']?></span>
                </div>
                <?php  if(!isset($arr_1[1])) echo "</div>";?>
                <?php } ?>
                <?php if(isset($arr_1[1])){?>
                    <div class=" infobox-down text-right">
                        <div class="arrow-right-1"></div>
                        <div class="arrow-right-2"></div>
                        <span class="item-cate-title"><?php echo $arr_1[1]['cate']?></span>
                        <br>
                        <span class="item-title"><?php echo $arr_1[1]['title']?></span>
                        <br>
                        <span class="color-grey-d item-desc"><?php echo $arr_1[1]['desc']?> </span>
                    </div>
                <?php }?>
            </div>
            <?php if(isset($arr_1[1])){?>
                <div class="col-xs-3 item-box">
                    <img class="lazy" src="<?php echo Yii::$app->request->baseUrl.'/img/placeholder.png'; ?>" data-original="<?php echo Yii::$app->request->baseUrl.$arr_1[1]['pic']?>" data-baiduimageplus-ignore="1">
                </div>
            <?php }?>
            <?php if(isset($arr_1[2])){?>
                <div class="col-xs-3 item-box">
                    <img class="lazy" src="<?php echo Yii::$app->request->baseUrl.'/img/placeholder.png'; ?>" data-original="<?php echo Yii::$app->request->baseUrl.$arr_1[2]['pic']?>" data-baiduimageplus-ignore="1">
                    <div class="recommend-infobox-style">
                        <table class="table table-bordered">
                            <tr>
                                <td class="bg-grey color-grey" style="width: 50px;font-size: 18px"><?php echo $arr_1[2]['cate']?></td>
                                <td class="bg-grey-d">
                                    <p class="color-white" style="font-size: 16px"><?php echo $arr_1[2]['title']?></p>
                                    <p class="color-grey-d" style="font-size: 12px"><?php echo $arr_1[2]['desc']?> </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php }?>
            <?php if(isset($arr_1[3])){?>
                <div class="col-xs-3 item-box">
                    <img class="lazy" src="<?php echo Yii::$app->request->baseUrl.'/img/placeholder.png'; ?>" data-original="<?php echo Yii::$app->request->baseUrl.$arr_1[3]['pic']?>" data-baiduimageplus-ignore="1">
                    <div class="recommend-infobox-style">
                        <table class="table table-bordered">
                            <tr>
                                <td class="bg-grey color-grey" style="width: 50px;font-size: 18px"><?php echo $arr_1[3]['cate']?></td>
                                <td class="bg-grey-d">
                                    <p class="color-white" style="font-size: 16px"><?php echo $arr_1[3]['title']?></p>
                                    <p class="color-grey-d" style="font-size: 12px"><?php echo $arr_1[3]['desc']?> </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php }?>
            <?php if(isset($arr_1[4])){?>
                <div class="col-xs-3 item-box">
                    <img class="lazy" src="<?php echo Yii::$app->request->baseUrl.'/img/placeholder.png'; ?>" data-original="<?php echo Yii::$app->request->baseUrl.$arr_1[4]['pic'] ?>" data-baiduimageplus-ignore="1">
                </div>
            <?php }?>

            <?php if(isset($arr_1[4])){?>
            <div class="col-xs-3 item-box">
                <div class="infobox-up text-left">
                    <div class="arrow-left-1"></div>
                    <div class="arrow-left-2"></div>
                    <span class="item-cate-title"><?php echo $arr_1[4]['cate']?></span>
                    <br>
                    <span class="item-title"><?php echo $arr_1[4]['title']?></span>
                    <br>
                    <span class="item-desc"><?php echo $arr_1[4]['desc']?></span>
                </div>
                <?php if(!isset($arr_1[5])) echo "</div>"; ?>
                <?php }?>

                <?php if(isset($arr_1[5])){?>
                <div class="infobox-down text-right">
                    <div class="arrow-right-1"></div>
                    <div class="arrow-right-2"></div>
                    <span class="item-cate-title"><?php echo $arr_1[5]['cate']?></span>
                    <br>
                    <span class="item-title"><?php echo $arr_1[5]['title']?></span>
                    <br>
                    <span class="color-grey-d item-desc"><?php echo $arr_1[5]['desc']?> </span>
                </div>
            </div>
        <?php }?>


            <?php if(isset($arr_1[5])){?>
                <div class="col-xs-3 item-box">
                    <img class="lazy" src="<?php echo Yii::$app->request->baseUrl.'/img/placeholder.png'; ?>" data-original="<?php echo Yii::$app->request->baseUrl.$arr_1[5]['pic']  ?>" data-baiduimageplus-ignore="1">
                </div>
            <?php }?>
        </div>
        <div class="col-xs-6 col-xs-offset-3 text-center" style="margin-top: 20px">
        <span class="more" style="line-height: 50px;width: 100%;padding:10px 160px;background-color: #f6f6f6">
        点击加载更多
        </span>
        </div>
    </div>
    <div  id="cate-2"  class="row">
        <div class="col-md-12" style="height: 60px;margin-top: 35px">
            <h4 class="text-center part-title" style="border-top: 1px solid #ededed;">
                <span style="position:absolute;top:-25px;left:44%;background-color:#fff;padding: 5px 15px"> 产品类型二 </span>
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="background-color: #f9f9f9;padding: 15px">
            <div class="row">
                <?php if(isset($arr_2)){
                    foreach($arr_2 as $v) {
                        if(!empty($v)){
                            ?>
                            <div class="col-xs-3">
                                <div class="thumbnail">
                                    <img class="lazy" src="<?php echo Yii::$app->request->baseUrl.'/img/placeholder.png'; ?>" data-original="<?php echo Yii::$app->request->baseUrl.$v['pic']?>" alt="..." width="100%">
                                    <div class="caption" style="height: 140px;overflow: hidden">
                                        <h4><?php echo $v['title']?></h4>
                                        <p><?php echo $v['desc']?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <div  id="cate-3" class="row">
        <div class="col-md-12" style="height: 60px;margin-top: 35px">
            <h4 class="text-center part-title" style="border-top: 1px solid #ededed;">
                <span style="position:absolute;top:-25px;left:44%;background-color:#fff;padding: 5px 15px"> 产品类型三 </span>
            </h4>
        </div>
    </div>

    <?php    if(isset($arr_3)){ ?>
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-tabs item-cate-3-list" role="tablist">
                    <?php
                    $i=0;
                    foreach($arr_3 as $v) {
                        if(!empty($v)){
                            $i++;
                            ?>
                            <li role="presentation" <?php if($i==1) echo 'class="active"'?> id="banner-local"><a type="button"><img class="lazy" src="<?php echo Yii::$app->request->baseUrl.'/img/placeholder.png'; ?>" data-original="<?php echo Yii::$app->request->baseUrl.$v['pic']?>" alt="..." data-title="<?php echo $v['title']?>" data-desc="<?php echo $v['desc']?>" class="img-rounded" width="80px"></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-xs-12">
                <div style="border: 1px solid #CCCCCC;border-top:none">
                    <div class="row"  style="padding: 15px;">
                        <div class="col-xs-4 cate3-img">
                            <!--                    <img class="lazy" src="<?php echo Yii::$app->request->baseUrl.'/img/placeholder.png'; ?>" data-original="" alt="..." class="img-rounded" width="100%">-->
                        </div>
                        <div class="col-xs-8">
                            <h3 class="cate3-title"></h3>
                            <p class="cate3-desc"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php   } ?>
</div>
<script>
    $(function(){
        var page=1;
        var cate_1_pageCount=<?php echo $cate_1_pageCount;?>;
        var cate="<?php echo $cate_1['name']?>";
        $('.more').click(function(){
            page++;
            if(page>cate_1_pageCount){
                $(this).html('没有了');
                return false;
            }
            $.get('more',{cate:cate,page:page},function(data){
                console.log(data);
                if(data!="nothing")
                    $('.cate-1-box').append(data);
            })
        });
        $(document).ready(function(){
            show_one();
        });
        $('.item-cate-3-list img').click(function(){
            $(this).parent().parent().siblings().removeClass('active');
            $(this).parent().parent().addClass('active');
            show_one();
        })
    });
    function show_one(){
        var img=$('.item-cate-3-list .active').find('img');
        var src=img.attr('data-original');
        var title=img.attr('data-title');
        var desc=img.attr('data-desc');
        $('.cate3-img').html('<img src="'+src+'" alt="..." class="img-rounded" width="100%">');
        $('.cate3-title').html(title);
        $('.cate3-desc').html(desc);
    }
</script>
<br>
<br>
<br>
<style>
    .arrow-left-1{
        width: 0;
        height: 0;
        border-top: 12px solid transparent;
        border-left: 12px solid ;
        border-right: 12px solid ;
        border-bottom: 12px solid transparent;
        position: absolute;
        margin-left: -27px;
        margin-top: 15%;
        border-top-color: rgba(0,0,0,0);
        border-left-color: rgba(0,0,0,0);
        border-right-color: #fff;
        border-bottom-color: rgba(0,0,0,0);
    }
    .arrow-left-2{
        width: 0;
        height: 0;
        border-top: 12px solid transparent;
        border-left: 12px solid ;
        border-right: 12px solid ;
        border-bottom: 12px solid transparent;
        position: absolute;
        margin-left: -24px;
        margin-top: 15%;
        border-top-color: rgba(0,0,0,0);
        border-left-color: rgba(0,0,0,0);
        border-right-color: #f0f0f0;
        border-bottom-color: rgba(0,0,0,0);
    }
    .arrow-right-1{
        width: 0;
        height: 0;
        border-top: 12px solid transparent;
        border-left: 12px solid ;
        border-right: 12px solid ;
        border-bottom: 12px solid transparent;
        position: absolute;
        right:-27px;
        margin-top: 15%;
        border-top-color: rgba(0,0,0,0);
        border-left-color: #fff;
        border-right-color: rgba(0,0,0,0);
        border-bottom-color: rgba(0,0,0,0);
        z-index: 2;
    }
    .arrow-right-2{
        width: 0;
        height: 0;
        border-top: 12px solid transparent;
        border-left: 12px solid ;
        border-right: 12px solid ;
        border-bottom: 12px solid transparent;
        position: absolute;
        right:-24px;
        margin-top: 15%;
        border-top-color: rgba(0,0,0,0);
        border-left-color: #f0f0f0;
        border-right-color: rgba(0,0,0,0);
        border-bottom-color: rgba(0,0,0,0);
        z-index: 3;
    }
</style>