<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $image1=Yii::$app->request->baseUrl."/assets/images/person/person_back.png"?>
<?php $image2=Yii::$app->request->baseUrl."/assets/images/person/head_example.png"?>
<?php \yii\helpers\Url::remember(['activity/show', 'id' => $model->article_id]); ?>

<style>
    .share-list li span{
        font-size: 36px;;
    }
</style>
<script>
    $(function(){
        var src_id= '<?php echo $model->article_id?>';
        var type= 2;
        $(document).ready(function(){  //获取数据
            var query_num='<?php echo \yii\helpers\Url::to(['operate/check-num'])?>?type='+type+'&src_id='+src_id;
            $.post(query_num,function(data){
//  alert(data);
                if(data && data!='no'){
                    d=data.obj;
                    var read_num=d.read;
                    var zan_num=d.zan;
                    $('.read-num').text(read_num);
                    $('.zan-num').text(zan_num);
                }
            });
            setTimeout(function(){
                var record_read='<?php echo \yii\helpers\Url::to(['operate/record-read'])?>?type='+type+'&src_id='+src_id;
                $.post(record_read,function(data){
                    return true;
                });
            },5000);
        });
    });
</script>


<div class="container">
    <div class="row"  style="padding:0 5%;color: #515151;font-size: 22px">
        <div class="col-md-12">
            <h4>首页 > <a href="<?php echo Url::to(['article/show'])?>">牛文</a> > 文章</h4>
        </div>
    </div>
    <div class="row" >
        <div class="col-md-12">
            <!--            文章标题-->
            <div class="text-center" style="font-size: 38px;color: #161718"><?php echo $model->title ?></div>

            <!--            标题下面的内容-->
            <div class="row text-center">
                <ul class="list-inline" style="line-height: 60px;color: #cccccc">
                    <li>&#12288;<?php  echo $model->time ?></li>
                    <li>&#12288; <?php echo $model->author('35px','35px','img-circle','')?> </li>
                    <li><?php echo $model->relationUser->username;?></li>
                    <li>&#12288;</li>
                    <li><span class="iconfont icon-yueduliang"></span>&#12288;(<span class="read-num">0</span>)</li>
                    <li>赞&#12288;<span class="iconfont icon-zan1 zan" data-src_id="<?php echo $model->article_id ?>" data-type='2'></span>&#12288;(<span class="zan-num">0</span>)</li>
                </ul>
            </div>
            <!--      分享-->
            <?php
            $siteUrl="http://www.niuhonghong.cn/article/detail?article_id=".$model->article_id;
            $siteTitle=$model->title;
            $brief=$model->brief;
            $pic="http://www.niuhonghong.cn/".Yii::$app->request->baseUrl.$model->pic;
            ?>
            <div class="row text-center">
                <ul class="list-inline share-list" data-site="<?php echo $siteUrl ?>" data-title="<?php echo $siteTitle ?>" data-pic="<?php echo $pic ?>" data-summery="<?php echo $brief ?>" >
                    <li><a  href="http://www.jiathis.com/send/?webid=tsina&url=<?php echo $siteUrl ?>&title=<?php echo $siteTitle ?>&pic=<?php echo $pic ?>&summary=<?php echo $brief ?>"><span class="iconfont icon-xinlangweibo" data-id="tsina"></span></a></li>
                    <li><a  href="http://www.jiathis.com/send/?webid=weixin&url=<?php echo $siteUrl ?>&title=<?php echo $siteTitle ?>&pic=<?php echo $pic ?>&summary=<?php echo $brief ?>"><span class="iconfont icon-weixin"  data-id="weixin"></span></a></li>
                    <li><a  href="http://www.jiathis.com/send/?webid=qzone&url=<?php echo $siteUrl ?>&title=<?php echo $siteTitle ?>&pic=<?php echo $pic ?>&summary=<?php echo $brief ?>"><span class="iconfont icon-qzone" data-id="qzone"></span></a></li>
                    <li><a  href="http://www.jiathis.com/share" class=" jiathis jiathis_txt jtico jtico_jiathis" target="_blank"><span class="iconfont icon-jiahao" data-id="more"></span></a></li>
                </ul>
            </div>
            <!--            简介pc-->
            <div class="row">
                <div class="col-md-12 text-center"  style="margin-top:10px;margin-bottom:10px ">
                    <ul class="list-inline" style="font-size:15px;color: #a2a2a2;">
                        <?php $arr=explode('@',$model->tag);foreach($arr as $label){
                            if(!empty($label)){ ?>
                                <li class="tag" style="color:#5bb9ff;border: 1px #d4d4d4 solid;border-radius: 15px;padding:2px 15px;margin: 0 8px"><?php if(!empty($label))echo $label;?></li>
                            <?php     }
                        }   ?>
                    </ul>
                </div>
            </div>
            <div class="row visible-lg"  style="padding:0 5%">
                <div class="col-md-12" style="font-size:18px;color:#705e5e">
                    <div class="bg-gray" style="padding:40px 40px;">
                        <p>&#12288;&#12288;<?php echo  mb_substr($model->brief,0,160,'utf-8');  ?></p>
                    </div>
                </div>
            </div>
            <!--            简介手机端-->
            <div class="row visible-xs">
                <div class="col-md-12" style="font-size:15px;color:#705e5e">
                    <div class="well">
                        <p>&#12288;&#12288;<?php echo  mb_substr($model->brief,0,80,'utf-8');  ?></p>
                    </div>
                </div>
            </div>
            <!--            正文-->
            <div class="row"  style="padding:20px 5%">
                <div class="col-md-12" style="color: #7c7c7c">
                    <?php echo  $model->content;  ?>
                </div>
            </div>
            <!--          收藏分享-->
            <div class="row" style="padding:0 5%">
                <?php echo $this->render('detail_bottom',['before'=>$before,'after'=>$after,'model'=>$model]);?>
            </div>
            <div class="row" style="padding:0 5%">
                <!--广告-->
                <div class="col-md-12">
                    <img src="<?php echo
                    $image1=Yii::$app->request->baseUrl."/assets/images/niuwen/img/ad_detail.png"
                    ?>" width="100%" height="300px">
                </div>
                <div class="col-md-12">
                    <?php echo $this->render('detail_comment',['article_id'=>$model->article_id,'article_uid'=>$model->uid,'comments'=>$comments]);?>
                </div>
                <div class="col-md-12">
                    <h3>相关推荐</h3>
                </div>
                <div class="col-md-12">
                    <?php echo $this->render('related',['tag'=>$model->tag]);?>
                </div>
            </div>
        </div>
    </div>
</div>


